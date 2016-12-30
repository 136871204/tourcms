<?php
if (!defined("ZHPHP_PATH"))
    exit('No direct script access allowed');
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------

/**
 * Mysql数据库基类
 * @package     Db
 * @subpackage  Driver
 * @author      周鸿 <136871204@qq.com>
 */
abstract class Db implements DbInterface
{
    
    protected $table = NULL; //表名
    public $fieldArr; //字段数组
    public $lastQuery; //最后发送的查询结果集
    public $pri = null; //默认表主键
    public $opt = array(); //SQL 操作
    public $opt_old = array();
    public $lastSql; //最后发送的SQL
    public $error = NULL; //错误信息
    protected $cacheTime = NULL; //查询操作缓存时间单位秒
    protected $dbPrefix; //表前缀
    
    /**
     * 将eq等替换为标准的SQL语法
     * @var  array
     */
    protected $condition = array(
        "eq" => " = ", "neq" => " <> ",
        "gt" => " > ", "egt" => " >= ",
        "lt" => " < ", "elt" => " <= ",
    );
    
    /**
     * 数据库连接
     * 根据配置文件获得数据库连接对象
     * @param string $table
     * @return Object   连接对象
     */
    public function connect($table){
        //通过数据驱动如MYSQLI连接数据库
        if ($this->connectDb()) {
             if (!is_null($table)) {
                $this->dbPrefix = C("DB_PREFIX");
                $this->table($table);
                $this->table = $table;
                $this->pri = $this->opt['pri'];
                $this->fieldArr = $this->opt['fieldArr'];
                $this->optInit(); //初始始化WHERE等参数
             }else {
                $this->optInit();
            }
            return $this->link;
        }
        halt("数据库连接出错了请检查数据库配置");
    }
    
    /**
     * 初始化表字段与主键及发送字符集
     * @param string $tableName 表名
     */
    public function table($tableName)
    {
        if (is_null($tableName))
            return;
        //查询操作归位
        $this->optInit();
        $field = $this->getFields($tableName); //获得表结构信息设置字段及主键属性
        //表名设置
        $this->opt['table'] = $tableName;
        //主键名设置
        $this->opt['pri'] = isset($field['pri']) && !empty($field['pri']) ? $field['pri'] : '';
        //表字段信息设置
        $this->opt['fieldArr'] = $field['field'];
    }
    
    /**
     * 查询操作归位
     * @access public
     * @return void
     */
    public function optInit(){
         $this->opt_old = $this->opt;
         $this->cacheTime = NULL; //SELECT查询缓存时间
         $this->error = NULL;
         $opt = array(
            'table' => $this->table,
            'pri' => $this->pri,
            'field' => '*',
            'fieldArr' => $this->fieldArr,
            'where' => '',
            'like' => '',
            'group' => '',
            'having' => '',
            'order' => '',
            'limit' => '',
            'in' => '',
            'cache' => '',
            'filter_func' => array() //对数据进行过滤处理
        );
        $this->opt = array_merge($this->opt, $opt);
    }
    
    /**
     * 获得表字段
     * @access public
     * @param string $tableName 表名
     * @return type
     */
    public function getFields($tableName){
        $tableCache = $this->getCacheTable($tableName);
        $tableField = array();
        foreach ($tableCache as $v) {
            $tableField['field'][] = $v['field'];
            if ($v['key']) {
                $tableField['pri'] = $v['field'];
            }
        }
        return $tableField;
    }
    
    /**
     * 获得表结构缓存  如果不存在则生生表结构缓存
     * @access public
     * @param type $tableName
     * @return array    字段数组
     */
    private function getCacheTable($tableName){
        //字段缓存
        if (!DEBUG) {//不在debug模式下
            //TABLE_PATH:temp/Zhcms/Admin/Table/
            $cacheTableField = F($tableName, false, TABLE_PATH);
            //如果存在的话，直接返回结果
            if ($cacheTableField)
                return $cacheTableField;
        }   
        //获得表结构
        $tableinfo = $this->getTableFields($tableName);
        $fields = $tableinfo['fields'];
        //字段缓存
        if (!DEBUG) {//不是debug模式下进行缓存处理
            F($tableName, $fields, TABLE_PATH);
        }
        return $fields;
    }
    
    /**
     * 获得表结构及主键
     * 查询表结构获得所有字段信息，用于字段缓存
     * @access private
     * @param string $tableName
     * @return array
     */
    public function getTableFields($tableName){
        //sql文编辑
        $sql = "show columns from " . $tableName;
        //执行sql文
        $fields = $this->query($sql);
        //没有取得数据，报错
        if ($fields === false) {
            error("表{$tableName}不存在", false);
        }
        $n_fields = array();
        $f = array();
        foreach ($fields as $res) {
            $f ['field'] = $res ['Field'];
            $f ['type'] = $res ['Type'];
            $f ['null'] = $res ['Null'];
            $f ['field'] = $res ['Field'];
            $f ['key'] = ($res ['Key'] == "PRI" && $res['Extra']) || $res ['Key'] == "PRI";
            $f ['default'] = $res ['Default'];
            $f ['extra'] = $res ['Extra'];
            $n_fields [$res ['Field']] = $f;
        }
        //取得主键
        $pri = '';
        foreach ($n_fields as $v) {
            if ($v['key']) {
                $pri = $v['field'];
            }
        }
        $info = array();
        //所有字段
        $info['fields'] = $n_fields;
        //主键取得
        $info['primarykey'] = $pri;
        return $info;
    }
    
    /**
     * 将查询SQL压入调试数组 show语句不保存
     * @param void
     */
    protected function debug($sql)
    {
        $this->lastSql = $sql;
        //show语句不保存
        if (DEBUG && !preg_match("/^\s*show/i", $sql)) {
            Debug::$sqlExeArr[] = $sql; //压入一条成功发送SQL
        }
    }
    
    //错误处理
    protected function error($error)
    {
        $this->error = $error;
        if (DEBUG) {
            //DEBUG模式下，弹出报错画面
            error($this->error);
        } else {
            //否则写入 log
            log_write($this->error);
        }
    }
    
    /**
     * 查找记录
     * @param string $where
     * @return array|string
     */
    public function select($where){
        //没有表面报错
        if (empty($this->opt['table'])) {
            $this->error("没有可操作的数据表");
            return false;
        }
         //设置条件
        if (!empty($where))
            $this->where($where);
        $sql = 'SELECT ' . $this->opt['field'] . ' FROM ' . $this->opt['table'] .
            $this->opt['where'] . $this->opt['group'] . $this->opt['having'] .
            $this->opt['order'] . $this->opt['limit'];
            //echo $sql."<br/>";
        $data = $this->query($sql);
        return $data;
    }
    
    /**
     * 添加表前缀
     * @access public
     * @param string $sql
     * @return string   格式化后的SQL
     */
//    public function addTableFix($sql)
//    {
//        return preg_replace('@(\w+?\.[a-z]+?)@i', C('DB_PREFIX') . '\1', $sql);
//    }
    
    /**
     * SQL中的REPLACE方法，如果存在与插入记录相同的主键或unique字段进行更新操作
     * @param array $data
     * @param string $type
     * @return array|bool
     */
    public function insert($data, $type = 'INSERT'){
        $value = $this->formatField($data);
        if (empty($value)) {
            $this->error("没有任何数据用于 INSERT");
            return false;
        }else {
            $sql = $type . " INTO " . $this->opt['table'] . "(" . implode(',', $value['fields']) . ")" .
                "VALUES (" . implode(',', $value['values']) . ")";
            return $this->exe($sql);
        }
    }
    
    /**
     * 格式化SQL操作参数 字段加上标识符  值进行转义处理
     * @param array $vars 处理的数据
     * @return array
     */
    public function formatField($vars){
        //格式化的数据
        $data = array();
        foreach ($vars as $k => $v) {
            //校验字段与数据
            //传入的字段不存在 或者  传入的字段对应的值是数组的话就 不处理
            if (!$this->isField($k) || is_array($v)) {
                continue;
            }
            $data['fields'][] = "`" . $k . "`";
            $v = $this->escapeString($v);
            $data['values'][] =  "\"" . $v . "\"";
        }
        return $data;
    }
    
    
    //转义数据
//    private function addslashes_d($v)
//    {
//        return MAGIC_QUOTES_GPC ? $v : addslashes_d($v);
//    }

    /**
     * 更新数据
     * @access      public
     * @param  mixed $data
     * @return mixed
     */
    public function update($data){
        //验证条件
        //如果where条件是空
        if (empty($this->opt['where'])) {
            //如果主键有设定的话
            if (isset($data[$this->opt['pri']])) {
                //就添加where 主键 = 主键值
                $this->opt['where'] = " WHERE " . $this->opt['pri'] . " = " . intval($data[$this->opt['pri']]);
            }else {
                //主键都没有设置的话，报错
                $this->error('UPDATE更新语句必须输入条件');
                return false;
            }
        }
        //格式化SQL操作参数 字段加上标识符  值进行转义处理
        $data = $this->formatField($data);
        //没有数据返回false
        if (empty($data)) return false;
        //创建sql文
        $sql = "UPDATE " . $this->opt['table'] . " SET ";
        foreach ($data['fields'] as $n => $field) {
            if($data['values'][$n] == '"NULL"'){
                $sql .= $field . "=NULL,";
            }else{
                $sql .= $field . "=" . $data['values'][$n] . ',';
            }
            
        }
        $sql = trim($sql, ',') . $this->opt['where'] . $this->opt['limit'];
       //echo $sql;//die;
        return $this->exe($sql);
    }


    /**
     * 删除方法
     * @param $data
     * @return bool
     */
    public function delete($data = array())
    {
        $this->where($data);
        if (empty($this->opt['where'])) {
            $this->error("DELETE删除语句必须输入条件");
            return false;
        }
        $sql = "DELETE FROM " . $this->opt['table'] . $this->opt['where'] . $this->opt['limit'];
        return $this->exe($sql);
    }
    
    
    /**
     * count max min avg 共用方法
     * @param string $type 类型如count|avg
     * @param mixed $data 参数
     * @return mixed
     */
    private function statistics($type, $data)
    {
        //例如count->COUNT
        $type = strtoupper($type);
        if (empty($data)) {
            $field = " {$type}(" . $this->opt['pri'] . ") AS " . $this->opt['pri'];
        } else if (is_string($data)) {
            $s = explode("|", $data);
            $field = " {$type}(" . $s[0] . ")";
            $field .= isset($s[1]) ? ' AS ' . $s[1] : '';
        }
        $this->opt['field'] = $field;
    }
    
    
    
    
    //统计记录总数
    public function count($data)
    {
        if(empty($data))$data=' * ';
        $this->statistics(__FUNCTION__, $data);
        $result = $this->select("");
        return is_array($result) && !empty($result) ? intval(current($result[0])) : NULL;
    }
    
    
    //查找最大的值
    public function max($data)
    {
        $this->statistics(__FUNCTION__, $data);
        $result = $this->select("");
        return is_array($result) && !empty($result) ? current($result[0]) : NULL;
    }

    //查找最小的值
    public function min($data)
    {
        $this->statistics(__FUNCTION__, $data);
        $result = $this->select("");
        return is_array($result) && !empty($result) ? current($result[0]) : NULL;
    }
    
    //查找平均值
    public function avg($data)
    {
        $this->statistics(__FUNCTION__, $data);
        $result = $this->select("");
        return is_array($result) && !empty($result) ? current($result[0]) : NULL;
    }

    //SQL求合SUM计算
    public function sum($data)
    {
        $this->statistics(__FUNCTION__, $data);
        $result = $this->select("");
        return is_array($result) && !empty($result) ? current($result[0]) : NULL;
    }
    
    /**
     * 判断表名是否存在
     * @param $table 表名
     * @param bool $full 是否加表前缀
     * @return bool
     */
    public function isTable($table, $full = true)
    {
        //不为全表名时加表前缀
        if (!$full)
            $table = C('DB_PREFIX') . $table;
        $table = strtolower($table);
        $info = $this->query('show tables');
        foreach ($info as $n => $d) {
            if ($table == current($d)) {
                return true;
            }
        }
        return false;
    }
    
    /**
     * 过滤非法字段
     * @param mixed $opt
     * @return array
     */
    public function fieldFilter($opt)
    {
        if (empty($opt) || !is_array($opt))
            return null;
        $field = array();
        foreach ($opt as $k => $v) {
            if ($this->isField($k))
                $field[$k] = $v;
        }
        return $field;
    }
    
    
    /**
     * SQL查询条件
     * @param mixed $opt 链式操作中的WHERE参数
     * @return string
     */
    public function where($opt){
        
        //初始化where语句
        $where = '';        
        if (empty($opt)) {//如果传入参数是空，返回false
            return false;
        } else if (is_numeric($opt)) {//如果单纯传入个数字，设置主键=传入值
            $where .= ' ' . $this->opt['pri'] . "=$opt ";
        } else if (is_string($opt)) {//传入是一个字符串，比如***=*** AND ***=***,就直接设置这个字符串
            $where .= " $opt ";
        } else if (is_numeric(key($opt)) && is_numeric(current($opt))) {
            //如果传入 类似 array("1", "2", "3", "4")
            //where设置成 主键 in (传入数字数组)
            $where .= ' ' . $this->opt['pri'] . ' IN(' . implode(',', $opt) . ')';
        } else if (is_array($opt)) {
            //p($opt);die;
            foreach ($opt as $k => $v) {
                if (method_exists($this, $k)) {
                    $this->$k($v);
                }else if (is_array($v)) {
                    //例如array("model_name" => $_POST['model_name'], "mid" => array("neq" => $mid))
                     foreach ($v as $n => $m) {
                        if (isset($this->condition[$n])) {
                            $where .= " $k" . $this->condition[$n] . (is_numeric($m) ? $m : "'$m'");
                        } else if (in_array(strtoupper($m), array("OR", "AND"))) {
                            if (preg_match('@(OR|AND)\s*$@i', $where)) {
                                $where = substr($where, 0, -4);
                            }
                            $where .= strtoupper($m) . ' ';
                        } else {
                            if (is_numeric($m)) {
                                $where .= " $k in(" . implode(',', $v) . ") ";
                            } else {
                                $where .= " $k in('" . implode("','", $v) . "') ";
                            }
                            break;
                        }
                        if (!preg_match('@(or|and)\s*$@i', $where)) {
                            $where .= ' AND ';
                        }
                     }
                     if (!preg_match('@(or|and)\s*$@i', $where)) {
                        $where .= ' AND ';
                    }
                }else {
                    if (is_numeric($k) && in_array(strtoupper($v), array('OR', 'AND'))) {
                        if (preg_match('@(or|and)\s*$@i', $where)) {
                            $where = substr($where, 0, -4);
                        }
                        $where .= strtoupper($v) . ' ';
                    }else if (is_numeric($k) && is_string($v)) {
                        /*例如 $opt=
                        Array
                        (
                            [0] => zh_content.content_state=1
                            [1] => zh_category.cid=2
                        )
                        */
                        $where .= $v . ' AND ';
                    }else if (is_string($k)) {//key是字符串的话 就 让 $k =$v
                        $where .= (is_numeric($v) ? " $k=$v " : " $k='$v' ") . ' AND ';
                    }
                }
            }
        }
        //trim下where
        $where = trim($where);
        if (!empty($where)) {//where不是空的话
            if (empty($this->opt['where'])) {//如果现在的对象里面没有保存的where条件的话
                //就设置 where $where
                $this->opt['where'] = " WHERE $where";
            } elseif (!preg_match('@^\s*(or|and)@i', $where)) {
                //如果不是 or或者and 开头的话 就默认 and $where
                $this->opt['where'] .= ' AND ' . $where;
            }
        }
        //吧 or 或者 and 在最后的部分 删除
        $this->opt['where'] = preg_replace('@(or|and)\s*$@i', '', $this->opt['where']);
    }
    
    
    /**
     * in 语句
     * @param mixed $data 链式操作中的参数
     */
    public function in($data)
    {
        $in = '';
        if (!is_array($data)) {
            $in .= $this->opt['pri'] . " IN(" . $data . ") ";
        } else if (is_array($data) && !empty($data)) {
            if (is_string(key($data))) {
                $_v = current($data);
                if (!is_array($_v)) {
                    $in .= "" . key($data) . " IN({$_v}) ";
                } else if (is_string($_v[0])) {
                    $in .= " " . key($data) . " IN('" . implode("','", current($data)) . "') ";
                } else {
                    $in .= " " . key($data) . " IN(" . implode(",", current($data)) . ") ";
                }
            } else {
                $in .= $this->opt['pri'] . " IN(" . implode(",", $data) . ") ";
            }
        }
        if (empty($this->opt['where'])) {
            $this->opt['where'] = " WHERE $in ";
        } else if (!preg_match("@^\s*(or|and)@i", $in)) {
            $this->opt['where'] .= " AND " . $in;
        } else {
            $this->opt['where'] .= "  " . $in;
        }
    }
    
    /**
     * 字段集
     * @param type $data
     */
    public function field($data){
        if (is_string($data)) {
            //$db->field('uid,username|uu')->select();
            $data = explode(",", $data);
        }
        //SQL 操作参数字段如果是 *的话 就 设置 '' ,不然在当前
        $field = trim($this->opt['field']) == '*' ? '' : $this->opt['field'] . ',';
        foreach ($data as $d) {
            $a = explode("|", $d);
            $field .= trim($a[0]);
            $field .= isset($a[1]) ? ' AS ' . $a[1] . ',' : ',';
        }
        $this->opt['field'] = substr($field, 0, -1);
    }
    
    
    /**
     * 验证字段是否全法
     * @param $field 字段名
     * @return bool
     */
    protected function isField($field)
    {
        return is_string($field) && in_array($field, $this->opt['fieldArr']);
    }
    
    /**
     * limit 操作
     * @param mixed $data
     * @return type
     */
    public function limit($data)
    {
        $limit = '';
        if (is_array($data)) {
            //传入数据 例如：$db->limit(array(1,2))->all();
            $limit .= implode(",", $data);
        } else {
            //传入数据 例如：$db->limit(2)->order('uid desc')->all();
            $limit .= $this->opt['limit'] . " $data ";
        }
        $this->opt['limit'] = " LIMIT $limit ";
    }
    
    
    
    
    
     /**
     * SQL 排序 ORDER
     * @param type $data
     */
    public function order($data){
        $order = "";
        //$db->order('id desc')->all();
        if (is_string($data)) {
            $order .= $data;
        }else if (is_array($data)) {
            //$db->order(array('id'=>'asc'))->all();
            foreach ($data as $f => $t) {
                $order .= " $f $t,";
            }
            $order = substr($order, 0, -1);
        }
        if (empty($this->opt['order'])) {
            $this->opt['order'] = " ORDER BY $order ";
        } else {
            $this->opt['order'] .= "," . $order;
        }
    }
    
    /**
     * 分组操作
     * @param type $opt
     */
    public function group($opt)
    {
        $group = "";
        if (is_string($opt)) {
            $group .= $opt;
        } else if (is_array($opt)) {
            $group .= implode(",", $opt);
        }
        if (empty($this->opt['group'])) {
            $this->opt['group'] = " GROUP BY $group";
        } else {
            $this->opt['group'] .= ",$group ";
        }
    }
    
    /**
     * 分组条件having
     * @param type $opt
     */
    public function having($opt)
    {
        $having = "";
        if (is_string($opt)) {
            $having .= $opt;
        }
        if (empty($this->opt['having'])) {
            $this->opt['having'] = " HAVING $having";
        } else if (!preg_match("@^\s*(or|and)@i", $having)) {
            $this->opt['having'] .= " AND " . $having;
        } else {
            $this->opt['having'] .= " " . $having;
        }
    }
    
    /**
     * 获得最后一条SQL
     * @return type
     */
    public function getLastSql()
    {
        return $this->lastSql;
    }

    /**
     * 获得所有SQL语句
     * @return type
     */
    public function getAllSql()
    {
        return Debug::$sqlExeArr;
    }

    /**
     * 设置查询缓存时间
     * @param $time
     */
    public function cache($time = -1)
    {
        $this->cacheTime = is_numeric($time) ? $time : -1;
    }
    
    
    /**
     * 获得表信息
     * @param   string $table 数据库名
     * @return  array
     */
    public function getTableInfo($table)
    {
        $table = empty($table) ? null : $table; //表名
        $info = $this->query("SHOW TABLE STATUS FROM " . C("DB_DATABASE"));
        //p($info);die;
        $arr = array();
        $arr['total_size'] = 0; //总大小
        $arr['total_row'] = 0; //总条数
        foreach ($info as $k => $t) {
            if ($table) {
                if (!in_array($t['Name'], $table)) {
                    continue;
                }
            }
            $arr['table'][$t['Name']]['tablename'] = $t['Name'];
            $arr['table'][$t['Name']]['engine'] = $t['Engine'];
            $arr['table'][$t['Name']]['rows'] = $t['Rows'];
            $arr['table'][$t['Name']]['collation'] = $t['Collation'];
            $charset = $arr['table'][$t['Name']]['collation'] = $t['Collation'];
            $charset = explode("_", $charset);
            $arr['table'][$t['Name']]['charset'] = $charset[0];
            $arr['table'][$t['Name']]['datafree'] = $t['Data_free'];
            $arr['table'][$t['Name']]['size'] = $t['Data_free'] + $t['Data_length'];
            $info = $this->getTableFields($t['Name']);
            $arr['table'][$t['Name']]['field'] = $info['fields'];
            $arr['table'][$t['Name']]['primarykey'] = $info['primarykey'];
            $arr['table'][$t['Name']]['autoincrement'] = $t['Auto_increment'] ? $t['Auto_increment'] : '';
            $arr['total_size'] += $arr['table'][$t['Name']]['size'];
            $arr['total_row']++;
        }
        return empty($arr) ? false : $arr;
    }
    
    /**
     * 获得数据库或表大小
     */
    public function getSize($table)
    {
        $sql = "show table status from " . C("DB_DATABASE");
        $row = $this->query($sql);
        $size = 0;
        foreach ($row as $v) {
            if ($table) {
                $size += in_array(strtolower($v['Name']), $table) ? $v['Data_length'] + $v['Index_length'] : 0;
            }
        }
        return get_size($size);
    }
    
    
    
}
?>