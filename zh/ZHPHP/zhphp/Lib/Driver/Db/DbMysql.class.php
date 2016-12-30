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
 * Mysql数据库驱动类
 * @package     Db
 * @subpackage  Driver
 * @author      周鸿 <136871204@qq.com>
 */
class DbMysql extends Db 
{
    
    //是否连接
    static protected $isConnect = false;
    public $link = null; //数据库连接
    
    function connectDb()
    {
        //如果没有连接状态下
        if (!(self::$isConnect)) {
            //'DB_PCONNECT'    => false,//数据库持久链接
            /*
            mysql_pconnect() 函数打开一个到 MySQL 服务器的持久连接。
            mysql_pconnect() 和 mysql_connect() 非常相似，但有两个主要区别：
            当连接的时候本函数将先尝试寻找一个在同一个主机上用同样的用户名和密码已经打开的（持久）连接，如果找到，
            则返回此连接标识而不打开新连接。
            其次，当脚本执行完毕后到 SQL 服务器的连接不会被关闭，此连接将保持打开以备以后使用（mysql_close() 
            不会关闭由 mysql_pconnect() 建立的连接）。
            */
            if(C('DB_PCONNECT')){
            	$link = mysql_pconnect(C("DB_HOST"), C("DB_USER"), C("DB_PASSWORD"),true);
			}else{
				$link = mysql_connect(C("DB_HOST"), C("DB_USER"), C("DB_PASSWORD"),true,131072);
			}
            //如果没有链接成功 返回false
            if (!$link) {
                return false;
            } else {
                //设置连接对象
                self::$isConnect = $link;
                self::setCharts();
            }
        }
        $this->link = self::$isConnect;
        mysql_select_db(C("DB_DATABASE"), $this->link);
        return true;
    }
    
    /**
     * 设置字符集
     */
    static private function setCharts()
    {
        $character = C("DB_CHARSET");
        $sql = "SET character_set_connection=$character,character_set_results=$character,character_set_client=binary";
        mysql_query($sql, self::$isConnect);
    }
    
    //获得最后插入的ID号
    public function getInsertId()
    {
        return mysql_insert_id($this->link);
    }
    
    //获得受影响的行数
    public function getAffectedRows()
    {
        return mysql_affected_rows($this->link);
    }
    
    //遍历结果集(根据INSERT_ID)
    protected function fetch()
    {
        //mysql_fetch_assoc() 函数从结果集中取得一行作为关联数组。
        //返回根据从结果集取得的行生成的关联数组，如果没有更多行，则返回 false。
        $res = mysql_fetch_assoc($this->lastquery);
        //如果没有数据的话
        if (!$res) {
            //释放结果集
            $this->resultFree();
        }
        //返回关联数组
        return $res;
    }
    
    //数据安全处理
    public function escapeString($str)
    {
        if ($this->link) {
            //mysql_real_escape_string() 函数转义 SQL 语句中使用的字符串中的特殊字符。
            // 	string:必需。规定要转义的字符串。
            //connection:可选。规定 MySQL 连接。如果未规定，则使用上一个连接。
            return mysql_real_escape_string($str,$this->link);
        } else {
            //mysql_escape_string — 转义一个字符串用于 mysql_query 
            return mysql_escape_string($str);
        }
    }
    
    //执行SQL没有返回值
    public function exe($sql){
        //查询参数初始化
        $this->optInit();
        //将SQL添加到调试DEBUG
        $this->debug($sql);
        //判断链接状态
        //is_resource — 检测变量是否为资源类型 
        is_resource($this->link) or $this->connect($this->table);
        //mysql_query() 函数执行一条 MySQL 查询。
        //mysql_query() 仅对 SELECT，SHOW，EXPLAIN 或 DESCRIBE 语句返回一个资源标识符，如果查询执行不正确则返回 FALSE。
        $this->lastquery = mysql_query($sql, $this->link);
        if ($this->lastquery) {
            //自增id
            //mysql_insert_id() 函数返回上一步 INSERT 操作产生的 ID。
            //mysql_insert_id() 返回给定的 connection 中上一步 INSERT 查询中产生的 AUTO_INCREMENT 的 ID 号。
            //如果上一查询没有产生 AUTO_INCREMENT 的 ID，则 mysql_insert_id() 返回 0。
            $insert_id = mysql_insert_id($this->link);
            //返回产生的AUTO_INCREMENT的id,没有返回true 说明查询语句的成功
            return $insert_id ? $insert_id : true;
        }else {
            //DB父类的错误处理方法调用
            $this->error(mysql_error($this->link) . "\t" . $sql);
            return false;
        }
    }
    
    
    
    //发送查询 返回数组
    public function query($sql){
        //'CACHE_SELECT_TIME'    => -1,  //SQL SELECT查询缓存时间 -1为不缓存 0为永久缓存
        $cache_time = $this->cacheTime ? $this->cacheTime : intval(C("CACHE_SELECT_TIME"));
        //cacheName=取得
        $cacheName = $sql . APP . CONTROL . METHOD;
        if ($cache_time >= 0) {
            //缓存处理
            $result = S($cacheName, FALSE, null, array("Driver" => "file", "dir" => CACHE_PATH, "zip" => false));
            //如果有查询到结果的话
            if ($result) {
               //查询参数初始化
                $this->optInit();
                return $result;
            }
        }
        //SQL发送失败
        if (!$this->exe($sql)){
             return false;
        }
        //数据list数组初始化
        $list = array();
        while (($res = $this->fetch()) != false) {
            $list [] = $res;
        }
        //如果需要缓冲  并且 'CACHE_SELECT_LENGTH'=> 30, //缓存最大条数
        if ($cache_time >= 0 && count($list) <= C("CACHE_SELECT_LENGTH")) {
            //缓存处理
            S($cacheName, $list, $cache_time, array("Driver" => "file", "dir" => CACHE_PATH, "zip" => false));
        }
        return is_array($list) && !empty($list) ? $list : NULL;
    }
    
    
    
    
    
    //释放结果集
    protected function resultFree()
    {
        //如果释放最后的sql语句
        if (isset($this->lastquery)) {
            //mysql_free_result() 函数释放结果内存。
            mysql_free_result($this->lastquery);
        }
        //让自己的结果为空
        $this->result = null;
    }
    
    // 获得MYSQL版本信息
    public function getVersion()
    {
        is_resource($this->link) or $this->connect($this->table);
        return preg_replace("/[a-z-]/i", "", mysql_get_server_info());
    }

    //开启事务处理
    public function beginTrans()
    {
        mysql_query("START AUTOCOMMIT=0");
    }

    //提供一个事务
    public function commit()
    {
        mysql_query("COMMIT", $this->link);
    }

    //回滚事务
    public function rollback()
    {
        mysql_query("ROLLBACK", $this->link);
    }

    // 释放连接资源
    public function close()
    {
        if (is_resource($this->link)) {
            mysql_close($this->link);
            self::$isConnect = null;
            $this->link = null;
        }
    }

    //析构函数  释放连接资源
    public function __destruct()
    {
        $this->close();
    }
    
}
?>