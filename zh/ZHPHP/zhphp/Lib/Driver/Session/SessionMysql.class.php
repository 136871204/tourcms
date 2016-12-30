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
 * mysql方式处理SESSION
 * @package     Session
 * @subpackage  Driver
 * @author      周鸿 <136871204@qq.com>
 */
class SessionMysql
{

    private $link; //Mysql数据库连接
    private $table; //SESSION表
    private $expire; //过期时间

    /**
     * 构造函数
     */
    public function __construct()
    {
    }

    //初始
    public function run()
    {
        $options = C("SESSION_OPTIONS");
        $this->table = $options['table']; //表
        $this->expire = $options['expire']; //过期时间
        $host = isset($options['host']) ? $options['host'] : C("DB_HOST");//DB_HOST
        $port = isset($options['port']) ? $options['port'] : C("DB_PORT");//DB_PORT
        $user = isset($options['user']) ? $options['user'] : C("DB_USER");//DB_USER
        $password = isset($options['password']) ? $options['password'] : C("DB_PASSWORD");//DB_PASSWARD
        $database = isset($options['database']) ? $options['database'] : C("DB_DATABASE");//DB_DATABASE
        $this->link = mysql_connect($host . ':' . $port, $user, $password); //连接Mysql
        $db = mysql_select_db($database, $this->link); //选择数据库
        if (!$this->link || !$db) return false;
        //'CHARSET'       => 'utf8',     //字符集
        mysql_query("SET NAMES " . str_replace("_", "", C("CHARSET"))); //字符集
        session_set_save_handler(
            array(&$this, "open"),
            array(&$this, "close"),
            array(&$this, "read"),
            array(&$this, "write"),
            array(&$this, "destroy"),
            array(&$this, "gc")
        );
    }

    /**
     * session_start()时执行
     * @return boolean
     */
    public function open()
    {
        return true;
    }

    /**
     * 读取SESSION 数据
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        $sql = "SELECT data FROM " . $this->table . " WHERE sessid='$id' ";
        $sql .= "AND atime>" . (NOW - $this->expire);$result = mysql_query($sql, $this->link);
        if ($result) {
            //mysql_fetch_assoc() 函数从结果集中取得一行作为关联数组。
            $data = mysql_fetch_assoc($result);
            return $data['data'];
        }
        return '';
    }

    /**
     * 写入SESSION
     * @param key $id key名称
     * @param mixed $data 数据
     * @return bool
     */
    public function write($id, $data)
    {
        $ip = ip_get_client();
        $sql = "REPLACE INTO " . $this->table . "(sessid,data,atime,ip) ";
        $sql .= "VALUES('$id','$data'," . NOW . ",'$ip')";
        mysql_query($sql, $this->link);
        return mysql_affected_rows($this->link) ? true : false;
    }

    /**
     * 卸载SESSION
     * @param type $id
     * @return type
     */
    public function destroy($id)
    {
        $sql = "DELETE FROM " . $this->table . " WHERE sessid='$id'";
        mysql_query($sql, $this->link);
        return mysql_affected_rows($this->link) ? true : false;
    }

    /**
     * SESSION垃圾处理
     * @return boolean
     */
    public function gc()
    {
        $sql = "DELETE FROM " . $this->table . " WHERE atime<" . (NOW - $this->expire);
        mysql_query($sql, $this->link);
    }


    //关闭SESSION
    public function close()
    {
        $this->gc();
        //关闭数据库连接
        mysql_close($this->link);
        return true;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}
