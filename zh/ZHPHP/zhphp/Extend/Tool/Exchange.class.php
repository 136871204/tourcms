<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * 验证码类
 * @package     tools_class
 * @author      周鸿 <136871204@qq.com>
 */
class Exchange{
    var $table;
    var $db;
    var $id;
    var $name;
    var $error_msg;
    
     /**
     * 构造函数
     *
     * @access  public
     * @param   string       $table       数据库表名
     * @param   dbobject     $db          aodb的对象
     * @param   string       $id          数据表主键字段名
     * @param   string       $name        数据表重要段名
     *
     * @return void
     */
    function Exchange($table, &$db , $id, $name)
    {
        $this->table     = $table;
        $this->db        = &$db;
        $this->id        = $id;
        $this->name      = $name;
        $this->error_msg = '';
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
    function is_only($col, $name, $id = 0, $where='')
    {
        $sql = 'SELECT COUNT(*) FROM ' .$this->table. " WHERE $col = '$name'";
        $sql .= empty($id) ? '' : ' AND ' . $this->id . " <> '$id'";
        $sql .= empty($where) ? '' : ' AND ' .$where;

        return ($this->db->getOne($sql,'COUNT(*)') == 0);
    }
    
    /**
     * 返回指定名称记录再数据表中记录个数
     *
     * @access  public
     * @param   string      $col        字段名
     * @param   string      $name       字段内容
     *
     * @return   int        记录个数
     */
    function num($col, $name, $id = 0)
    {
        $sql = 'SELECT COUNT(*) FROM ' .$this->table. " WHERE $col = '$name'";
        $sql .= empty($id) ? '' : ' AND '. $this->id ." != '$id' ";

        return $this->db->getOne($sql,'COUNT(*)');
    }
    
    /**
     * 编辑某个字段
     *
     * @access  public
     * @param   string      $set        要更新集合如" col = '$name', value = '$value'"
     * @param   int         $id         要更新的记录编号
     *
     * @return bool     成功或失败
     */
    function edit($set, $id)
    {
        $sql = 'UPDATE ' . $this->table . ' SET ' . $set . " WHERE $this->id = '$id'";

        if ($this->db->exe($sql))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
    /**
     * 取得某个字段的值
     *
     * @access  public
     * @param   int     $id     记录编号
     * @param   string  $id     字段名
     *
     * @return string   取出的数据
     */
    function get_name($id, $name = '')
    {
        if (empty($name))
        {
            $name = $this->name;
        }

        $sql = "SELECT `$name` FROM " . $this->table . " WHERE $this->id = '$id'";

        return $this->db->getOne($sql,"$name");
    }
    
    /**
     * 删除条记录
     *
     * @access  public
     * @param   int         $id         记录编号
     *
     * @return bool
     */
    function drop($id)
    {
        $sql = 'DELETE FROM ' . $this->table . " WHERE $this->id = '$id'";

        return $this->db->exe($sql);
    }
    
}

?>