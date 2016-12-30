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
 * 基本模型处理类
 * @package     Model
 * @author      周鸿 <136871204@qq.com>
 */
class Model {
    public $tableFull = NULL;
	//全表名
	public $table = NULL;
	//不带前缀表名
	public $db = NULL;
	//数据库连接驱动
	public $error = NULL;
	//验证不通过的错误信息
	public $trigger = TRUE;
	//触发器,开启时执行__after_delete等方法
	public $joinTable = array();
	//要关联的表
	public $data = array();
	//增、改操作数据
	public $validate = array();
	//验证规则
	public $auto = array();
	//自动完成
	public $map = array();
	//字段映射
    
    
    /**
	 * 构造函数
	 * @param null $table 表名
	 * @param bool $full 是否为全表
	 * @param array $param 参数
	 * @param null $driver 驱动
	 */
	public function __construct($table = null, $full = false, $driver = null, $param = array()) {
	   //自定义构造函数 __init
	   if (method_exists($this, "__init")) {
			$this -> __init($param);
		}
        //获得连接驱动
		$this -> run($table, $full, $driver);
	}
    
    //获得连接驱动
	protected function run($table, $full = false, $driver = null) {
	   //初始化默认表
		$this -> getTable($table, $full);
        //获得数据库引擎
		$db = DbFactory::factory($driver, $this -> tableFull);
        if ($db) {
			$this -> db = $db;
		} else {//连接异常
			if (DEBUG) {
				error(mysqli_connect_error() . "数据库连接出错了请检查配置文件中的参数", false);
			} else {
				Log::write("数据库连接出错了请检查配置文件中的参数");
			}
		}
	}
    
    /**
     * 判断表中某字段是否重复，若重复则中止程序，并给出错误信息
     *
     * @access  public
     * @param   string  $col    字段名
     * @param   string  $name   字段值
     * @param   integer $id
     *
     * @return void
     */
    public function is_only($col, $name, $id = 0, $where='')
    {
        $sql = 'SELECT COUNT(*)  FROM ' .$this->tableFull. " WHERE $col = '$name'";
        $sql .= empty($id) ? '' : ' AND ' . $this->db->pri. " <> '$id'";
        $sql .= empty($where) ? '' : ' AND ' .$where;
        $result=$this->db->query($sql);
        return $result[0]['COUNT(*)'] == 0;
    }
    
    /**
	 * GROUP语句定义
	 */
	public function group($arg = array()) {
		if (empty($arg))
			return $this;
		$this -> db -> group($arg);
		return $this;
	}
    
    /**
	 * 删除记录
	 * 示例：$Db->del("uid=1");
	 */
	public function drop($id) {
	   $data=array(
            $this->db->pri=>$id
       );
	   return $this -> delete($data);
	}
    
    /**
	 * 删除记录
	 * 示例：$Db->del("uid=1");
	 */
	public function del($data = array()) {
		return $this -> delete($data);
	}
    
    /**
	 * 删除记录
	 * 示例：$Db->delete("uid=1");
	 */
	public function delete($data = array()) {
		$trigger = $this -> trigger;
		$this -> trigger = true;
		$trigger and $this -> __before_delete($data);
		$result = $this -> db -> delete($data);
		$this -> error = $this -> db -> error;
		$trigger and $this -> __after_delete($result);
		return $result;
	}
    
    /**
     * IN 语句定义
     * 示例：$Db->in(1,2,3)->all();
     */
    public function in($arg = array())
    {
        if (empty($arg)) return $this;
        $this->db->in($arg);
        return $this;
    }
    
    /**
	 * 删除表
	 * @param string $tableName 表名
	 */
	public function dropTable($tableName) {
		if ($this -> tableExists($tableName)) {
			return $this -> exe("DROP TABLE IF EXISTS `" . C('DB_PREFIX') . $tableName . "`");
		}
	}
    
    /**
	 * ORDER 语句定义
	 * 示例：$Db->order("id desc")->all();
	 */
	public function order($arg = array()) {
		if (empty($arg))
			return $this;
		$this -> db -> order($arg);
		return $this;
	}
    
    //设置关联模型
	public function join($table = FALSE) 
    {
		if (!$table) {
			$this -> joinTable = FALSE;
		} else if (is_string($table)) {
		      //$db->join('category,user');
			$this -> joinTable = explode(",", $table);
		} else if (is_array($table)) {
			$this -> joinTable = $table;
		}
		return $this;
	}
    
    /* 判断表是否存在
	 * @param string $table 表名
	 * @return bool
	 */
	public function tableExists($tableName) {
		$Model = M();
		$tableArr = $Model -> query("SHOW TABLES");
		foreach ($tableArr as $k => $table) {
			$tableTrue = $table['Tables_in_' . C('DB_DATABASE')];
			if (strtolower($tableTrue) == strtolower(C('DB_PREFIX') . $tableName)) {
				return true;
			}
		}
		return false;
	}
    
    /**
	 * 判断表中字段是否在存在
	 * @param string $fieldName 字段名
	 * @param string $table 表名(不带表前缀)
	 * @return bool
	 */
	public function fieldExists($fieldName, $table) {
		$Model = M();
		if (!$Model -> tableExists($table)) {
			$this -> error = '数据表不存在';
		} else {
			$field = $Model -> query("DESC " . C("DB_PREFIX") . $table);
			foreach ($field as $f) {
				if (strtolower($f['Field']) == strtolower($fieldName)) {
					return true;
				}
			}
			return false;
		}
	}
    
    /**
	 * 查找满足条件的所有记录(一维数组)
	 * 示例：$Db->getField("username")
	 */
	public function getField($field, $return_all = false) {
	   //设置字段
		$this -> field($field);
        $result = $this -> select();
		if ($result) { 
            //字段数组
			$field = explode(',', preg_replace('@\s@', '', $field));
            //如果有多个字段时，返回多维数组并且第一个字段值做为KEY使用
			if (count($field) > 1) {
			     $data = array();
				foreach ($result as $v) {
					$data[$v[$field[0]]] = $v;
				}
				return $data;
			}else if ($return_all) {
			
				//只有一个字段，且返回多条记录
				$data = array();
				foreach ($result as $v) {
					if (isset($v[$field[0]]))
						$data[] = $v[$field[0]];
				}
				return $data;
			} else {
				//只有一个字段，且返回一条记录
				return current($result[0]);
			}
		}else {
			return NULL;
		}
	}
    
    /**
	 * 执行一个SQL语句  有返回值
	 * 示例：$Db->query("select title,click,addtime from hd_news where uid=18");
	 */
	public function query($data = array()) {
		return $this -> db -> query($data);
	}
    
    /**
	 * 执行SQL语句
	 * @param void 传入SQL字符串
	 * @return type
	 */
	public function runSql($sql) {
		return $this -> exe($sql);
	}
    
    /**
	 * 执行一个SQL语句  没有有返回值
	 * 示例：$Db->exe("delete from hd_news where id=16");
	 */
	public function exe($sql) {
		return $this -> db -> exe($sql);
	}
    
    //设置操作表
	protected function getTable($table = null, $full = false) {
	   
	   if (!is_null($this -> tableFull)) {//如果有设置全表名，就用全表名
			$table = $this -> tableFull;
		}elseif (!is_null($this -> table)) {//如果有设置表名，就用表前缀+表名
			$table = C("DB_PREFIX") . $this -> table;
		} else if (is_null($table)) {
			$table = null;
		} elseif (!is_null($table)) {
			if ($full === true) {
				$table = $table;
			} else {
				$table = C("DB_PREFIX") . $table;
			}
		}else {
			$table = C("DB_PREFIX") . CONTROL;
		}
        $this -> tableFull = $table;
		$this -> table = preg_replace('@^\s*' . C("DB_PREFIX") . '@', '', $table);
	}
    
    
    /**
	 * SQL中的WHERE规则
	 * 示例：$Db->where("username like '%周鸿%')->count();
	 */
	public function where($args = array()) {
	   //传入参数不是空的话
		if (!empty($args)) {
		  //SQL查询条件
			$this -> db -> where($args);
		}
        //返回自己
		return $this;
	}
    
    /**
	 * 设置字段
	 * 示例：$Db->field("username,age")->limit(6)->all();
	 */
	public function field($field = array(), $check = true) {
	   if (empty($field))
			return $this;
        $this -> db -> field($field, $check);
        return $this;
	}
    
    /**
	 * 统计
	 */
	public function count($args = array()) {
		$result = $this -> db -> count($args);
		return $result;
	}
    
    /**
	 * 查找满足条件的一条记录
	 * 示例：$Db->find("id=188")
	 */
	public function find($data = array()) {
	    //LIMIT 语句定义
		$this -> limit(1);
		$result = $this -> select($data);
		return is_array($result) && isset($result[0]) ? $result[0] : $result;
	}
    
    
    
    /**
	 * 查找满足条件的所有记录
	 * 示例：$Db->select("age>20")
	 */
	public function select($args = array()) {
	   $trigger = $this -> trigger;
       $this -> trigger = true;
       //查询数据前前执行的方法
       $trigger and $this -> __before_select($arg);
       //查找记录
       $result = $this -> db -> select($args);
       //查询数据后执行的方法
       $trigger and $this -> __after_select($result);
       $this -> error = $this -> db -> error;
       return $result;
	}
    
    /**
	 * LIMIT 语句定义
	 * 示例：$Db->limit(10)->all("sex=1");
	 */
	public function limit($start = null, $end = null) {
	    //入错没有传入$start
	    if (is_null($start)) {
	        //什么都不设置
			return $this;
		} else if (!is_null($end)) {
		      //传入数据 例如：$db->limit = array(10,6);
			$limit = $start . "," . $end;
		} else {
			$limit = $start;
		}
        $this -> db -> limit($limit);
        return $this;
	}
    
    //插入数据
	public function add($data = array(), $type = 'INSERT') {
		return $this -> insert($data, $type);
	}
    
    //插入数据
	public function insert($data = array(), $type = "INSERT") {
	    $this -> data($data);
		$data = $this -> data;
		$this -> data = array();
		$trigger = $this -> trigger;
		$this -> trigger = true;
		$trigger and $this -> __before_insert($data);
        $result = $this -> db -> insert($data, $type);
		$this -> error = $this -> db -> error;
		$trigger and $this -> __after_insert($result);
		return $result;
	}
    
    //添加数据
	public function update($data = array()) {
	   $this -> data($data);
       $data = $this -> data;
       //查询数据处理得到后，吧model对象的数据初始化
       $this -> data = array();
       $trigger = $this -> trigger;
		$this -> trigger = true;
        //更新数据前执行的方法
		$trigger and $this -> __before_update($data);
        //没有任何数据用于UPDATE！报错
        if (empty($data)) {
			$this -> error = "没有任何数据用于UPDATE！";
			return false;
		}
        $result = $this -> db -> update($data);
        $this -> error = $this -> db -> error;
        //更新数据后执行的方法
        $trigger and $this -> __after_update($result);
        return $result;
	}
    
    /**
	 * 获得添加、插入数据
	 * @param array $data void
	 * @return array|null
	 */
	public function data($data = array()) {
	   //$data=array('uid'=>9,'username'=>' 郭富城');
       //echo $db->save($data);
	   if (is_array($data) && !empty($data)) {
			$this -> data = $data;
		} else if (empty($this -> data)) {//如果是空的话，就使用$_POST的值
            //$_POST=array('uid'=>9,'username'=>' 刘德华');
            //$db = M('user');
            //echo $db->update();
			$this -> data = $_POST;
		}
        //数据过滤
        foreach ($this->data as $key => $val) {
			if (MAGIC_QUOTES_GPC && is_string($val)) {
			     if($val == 'NULL' || $val == 'null'){
                    $this -> data[$key] = 'NULL';
			     }else{
			        $this -> data[$key] = stripslashes($val); 
			     }
				
			}
		}
        return $this;
	}
    
    /**
	 * 执行自动映射、自动验证、自动完成
	 * @param array $data 如果为空使用$_POST
	 * @return bool
	 */
	public function create($data = array()) {
	   //验证令牌
		if (!$this -> token()) {
			return false;
		}
        //获得数据
		$this -> data($data);
        //自动验证
		if (!$this -> validate()) {
			return false;
		}
        //自动完成
		$this -> auto();
        //字段映射
		$this -> map();
        return true;
	}
    
    /**
	 * 字段映射
	 */
	protected function map() {
	   //开发中将字段暴漏给前台用户会带来潜在的安全隐患
	   /*
       $db->map=array(
       'yonghu'=>'username',
       'mima'=>'password'
       )
       */
		if (empty($this -> map))
			return;
		$this -> data();
		foreach ($this->map as $k => $v) {
			//处理POST
			if (isset($this -> data[$k])) {
				$this -> data[$v] = $this -> data[$k];
				unset($this -> data[$k]);
			}
		}
	}
    
    //自动完成
	public function auto($data = array()) {
	    $this -> data($data);
		$_data = &$this -> data;
		$motion = $this -> getCurrentMethod();
        //array('begin_time','strtotime','function',2,1),
        /*
        表单字段名:            字段名
        方法名:               方法或函数名
        方法类型:             method:自定义的模型方法 function:函数 string:字符串(默认）
        验证条件:
                                1 有这个表单项就处理( 默认）
                                2 必须处理的表单
                                3 如果表单不为空才处理
        处理时机:
                                1 插入时处理
                                2 更新时处理
                                3 任何动作都进行处理( 默认）
        
        */
        foreach ($this->auto as $v) {
            //1 插入时处理  2 更新时处理  3 插入与更新都处理
			$type = isset($v[4]) ? $v[4] : 3;
			//是否处理  更新或插入
			if ($motion != $type && $type != 3) {
				continue;
			}
            //验证的表单名称
			$name = $v[0];
			//函数或方法
			$action = $v[1];
            //时间：1有这个表单项就处理  2 必须处理的表单项 3 如果表单不为空才处理
			$condition = isset($v[3]) ? $v[3] : 1;
            switch ($condition) {
				//有post这个变量就处理
				case 1 :
					if (!isset($_data[$name])) {
						continue 2;
					}
					break;
				// 必须处理
				case 2 :
					if (!isset($_data[$name]))
						$_data[$name] = '';
					break;
				//不为空验证
				case 3 :
					if (empty($_data[$name])) {
						continue 2;
					}
					break;
			}
            //处理类型 function函数  method模型方法 string字符串
            $handle = isset($v[2]) ? $v[2] : "string";
            $_data[$name] = isset($_data[$name]) ? $_data[$name] : NULL;
            switch (strtolower($handle)) {
				case "function" :
					if (function_exists($action)) {
						$_data[$name] = $action($_data[$name]);
					}
					break;
				case "method" :
					if (method_exists($this, $action)) {
						$_data[$name] = $this -> $action($_data[$name]);
					}
					break;
				case "string" :
					$_data[$name] = $action;
					break;
			}
        }
	}
    
    /**
	 * 临时更改操作表
	 * @param string $table 表名
	 * @param bool $full 是否带表前缀
	 * @return $this
	 */
	public function table($table, $full = FALSE) {
		if ($full !== TRUE) {
			$table = C("DB_PREFIX") . $table;
		}
		$this -> db -> table($table);
		$this -> join(FALSE);
		$this -> trigger(FALSE);
		return $this;
	}
    
    //触发器，是否执行__after_delete等魔术方法
	public function trigger($stat = FALSE) {
		$this -> trigger = $stat;
		return $this;
	}
    
    //字段验证
	public function validate($data = array()) {
	    $this -> data($data);
		//当前方法,//1 插入  2 更新
		$current_method = $this -> getCurrentMethod();
        $_data = &$this -> data;
		if (!is_array($this -> validate) || empty($this -> validate)) {
			return true;
		}
        /*
        $db->validate = array(
            array('username', 'nonull', ' 用户名不能为空',2,3)
            array('password','confirm:password2',' 两次密码不一致',2,3)
        );
        */
        foreach ($this->validate as $v) {
            //验证的表单名称
			$name = $v[0];
            //验证时机  1 插入时验证  2 更新时验证  3 插入与更新都验证
			$action = isset($v[4]) ? $v[4] : 3;
            //当前时机（插入、更新）不需要验证
			if (!in_array($action, array($current_method, 3))) {
				continue;
			}
            //1 为默认验证方式    
            //1. 有POST这个变量就验证
            //2.为必须验证
            //3.不为空验证
			$condition = isset($v[3]) ? $v[3] : 1;
            //错误提示
			$msg = $v[2];
            switch ($condition) {
                //有post这个变量就验证
				case 1 :
					if (!isset($_data[$name])) {
						continue 2;
					}
					break;
                // 必须验证
				case 2 :
					if (!isset($_data[$name])) {
						$this -> error = $msg;
						return false;
					}
					break;
                //不为空验证
				case 3 :
					if (!isset($_data[$name]) || empty($_data[$name])) {
						continue 2;
					}
					break;
            }
            if($_pos = strpos($v[1],':')){
				$func = substr($v[1],0,$_pos);
				$args = substr($v[1],$_pos+1);
			}else{
				$func = $v[1];
				$args='';
			}
            if (method_exists($this, $func)) {
                //function isadmin($name, $value, $msg, $arg) {
                $res = call_user_func_array(array($this, $func), array($name, $_data[$name], $msg, $args));
                if ($res === true) {
					continue;
				}
				$this -> error = $res;
				return false;
            } else if (function_exists($func)) {
                $res = $func($name, $_data[$name], $msg, $args);
                if ($res === true) {
					continue;
				}
				$this -> error = $res;
				return false;
            }else {
                $validate = new Validate();
                $func = '_' . $func;
                if (method_exists($validate, $func)) {
					$res = call_user_func_array(array($validate, $func), array($name, $_data[$name], $msg, $args));
					if ($res === true) {
						continue;
					}
					$this -> error = $res;
					return false;
				}
            }
        }
        return true;
	}
    
    //获得表信息
	public function getTableInfo($table = array()) {
		return $this -> db -> getTableInfo($table);
	}
    
    /**
	 * 优化表解决表碎片问题
	 * @param array $table 表
	 * @return bool
	 */
	public function optimize($table) {
		if (is_array($table) && !empty($table)) {
			foreach ($table as $t) {
				$this -> exe("OPTIMIZE TABLE `" . $t . "`");
			}
			return true;
		}
	}

	//修复数据表
	public function repair($table) {
		if (is_array($table) && !empty($table)) {
			foreach ($table as $t) {
				$this -> exe("REPAIR TABLE `" . $t . "`");
			}
			return true;
		}
	}
    
    /**
	 * 查找满足条件的所有记录
	 * 示例：$Db->all("age>20")
	 */
	public function all($args = array()) {
		return $this -> select($args);
	}
    
    
    //当前操作的方法
	protected function getCurrentMethod() {
		//1 插入  2 更新
		return isset($this -> data[$this -> db -> pri]) ? 2 : 1;
	}
    
    /**
	 * 字段值增加
	 * 示例：$Db->dec("price","id=20",188)
	 * 将id为20的记录的price字段值增加188
	 * @param $field 字段名
	 * @param $where 条件
	 * @param int $step 增加数
	 * @return mixed
	 */
	public function inc($field, $where, $step = 1) {
		$sql = "UPDATE " . $this -> db -> opt['table'] . " SET " . $field . '=' . $field . '+' . $step . " WHERE " . $where;
		return $this -> exe($sql);
	}
    
    /**
	 * 验证令牌
	 */
	public function token() {
	    //'TOKEN_ON'  => FALSE,//令牌状态
		if (C("TOKEN_ON") || isset($_POST[C("TOKEN_NAME")]) || isset($_GET[C("TOKEN_NAME")])) {
			if (!Token::check()) {
				$this -> error = '表单令牌错误';
				return false;
			}
		}
		return true;
	}
    
    /**
	 * 魔术方法  设置模型属性如表名字段名
	 * @param string $var 属性名
	 * @param mixed $value 值
	 */
	public function __set($var, $value) {
		//如果为模型方法时，执行模型方法如$this->where="id=1"
		$_var = strtolower($var);
		$property = array_keys($this -> db -> opt);
		if (in_array($_var, $property)) {
			$this -> $_var($value);
		} else {
			$this -> data[$var] = $value;
		}
	}
    
    //更新记录
	public function save($data = array()) {
		return $this -> update($data);
	}
    
    //添加数据前执行的方法
	public function __before_insert(&$data) {
	}

	//添加数据后执行的方法
	public function __after_insert($data) {
	}
    
    //删除数据前执行的方法
	public function __before_delete(&$data) {
	}

	//删除数据后执行的方法
	public function __after_delete($data) {
	}
    
    //更新数据后前执行的方法
	public function __before_update(&$data) {
	}

	//更新数据后执行的方法
	public function __after_update($data) {
	}
    
    //查询数据前前执行的方法
	public function __before_select(&$data) {
	}
    
    //查询数据后执行的方法
	public function __after_select($data) {
	}
    
    /**
	 * 查找满足条件的所有记录
	 * 示例：$Db->all("age>20")
	 */
	public function getRow($args = array()) {
	    $result=$this ->select($args);
        if(!empty($result)){
            return $result[0];
        }else{
            return null;
        }
	}
    
    
    /**
	 * 查找满足条件的所有记录
	 * 示例：$Db->all("age>20")
	 */
	public function getRowSql($sql, $limited = false) {
	   if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }
	    $result=$this ->query($sql);
        if(!empty($result)){
            return $result[0];
        }else{
            return null;
        }
	}
    
    public function getOne($sql,$field, $limited = false){
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }
        $res = $this->query($sql);
        if ($res !== NULL){
            //echo  $res[0];die;
            return $res[0][''.$field];
        }else{
            return false;
        }

    }
    
    public function getOneRow($sql, $limited = false){
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }
        $res = $this->query($sql);
        if ($res !== NULL){
            //echo  $res[0];die;
            return $res[0];
        }else{
            return false;
        }

    }
    
    public function getAll($sql){
        $res = $this->query($sql);
        if ($res !== NULL){
            //echo  $res[0];die;
            return $res;
        }else{
            return false;
        }
    }
    
    public function getCol($sql,$field)
    {
        $res = $this->query($sql);
        if ($res !== NULL)
        {
            $arr = array();
            //p($res);die;
            foreach($res as $k=>$v){
                $arr[]=$v[$field];
            }

            return $arr;
        }
        else
        {
            return false;
        }
    }
    
    public function getColSql($sql)
    {
        $res = $this->query($sql);
        if ($res !== NULL)
        {
            $arr = array();
            
            foreach($res as $k=>$v){
                $arr[]=$v[0];
            }

            return $arr;
        }
        else
        {
            return false;
        }
    }
    

    
    /* 仿真 Adodb 函数 */
    public function selectLimit($sql, $num, $start = 0)
    {
        if ($start == 0)
        {
            $sql .= ' LIMIT ' . $num;
        }
        else
        {
            $sql .= ' LIMIT ' . $start . ', ' . $num;
        }

        return $this->query($sql);
    }

    
    
    
}
?>