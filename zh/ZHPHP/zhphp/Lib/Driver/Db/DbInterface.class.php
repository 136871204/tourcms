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
 * 数据库操作接口
 * @package     Db
 * @author      周鸿 <136871204@qq.com>
 */
interface DbInterface
{
    
    public function connectDb(); //获得连接   参数为表名

    public function close(); //关闭数据库

    public function exe($sql); //发送没有返回值的sql

    public function query($sql); //有返回值的sql

    public function getInsertId(); //获得最后插入的id

    public function getAffectedRows(); //受影响的行数

    public function getVersion(); //获得版本

    public function beginTrans(); //自动提交模式true开启false关闭

    public function commit(); //提供一个事务

    public function rollback(); //回滚事务

    public function escapeString($str); //数据安全处理
    
    
}
?>