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
 * 数据库驱动工厂
 * @package     Model
 * @author      周鸿 <136871204@qq.com>
 */
final class DbFactory {
    
    public static $dbFactory = null; //静态工厂实例
    protected $driverList = array(); //驱动组
    
    
    /**
     * 构造函数
     */

    private function __construct()
    {

    }
    
    
     /**
     * 返回工厂实例，单例模式
     */
    public static function factory($driver = null, $tableName = null){
        //只实例化一个对象
        if (is_null(self::$dbFactory)) {
            self::$dbFactory = new dbFactory();
        }
        if (is_null($driver)) {
            //'DB_DRIVER'   => 'mysqli',    //数据库驱动
            $driver = ucfirst(strtolower(C("DB_DRIVER")));
        }
        if (is_null($tableName)) {
            $tableName = 'empty';
        }
        //数据库驱动存在并且数据库连接正常
        if (isset(self::$dbFactory->driverList[$tableName]) && self::$dbFactory->driverList[$tableName]->link) {
            return self::$dbFactory->driverList[$tableName];
        }
        //获得数据库驱动
        if (self::$dbFactory->getDriver($driver, $tableName)) {
            return self::$dbFactory->driverList[$tableName];
        } else {
            return false;
        }
    }
    
    /**
     * 获得数据库驱动接口
     * @param $driver 驱动
     * @param $tableName 表名
     */
    private function getDriver($driver, $tableName){
        //根据驱动名，得到驱动的类名
        $class = "Db" . $driver; //数据库驱动
        $classFile = ZHPHP_DRIVER_PATH . 'Db/Driver/' . $class . '.Tool.php'; //加载驱动类库文件
        require_cache($classFile);
        $this->driverList[$tableName] = new $class;
        $table = $tableName == 'empty' ? null : $tableName;
        return $this->driverList[$tableName]->connect($table);
    }
    
    /**
     * 释放连接驱动
     */
    private function close()
    {
        foreach ($this->driverList as $db) {
            $db->close();
        }
    }

    /**
     * 析构函数
     */
    function __destruct()
    {
        $this->close();
    }
    
}
?>