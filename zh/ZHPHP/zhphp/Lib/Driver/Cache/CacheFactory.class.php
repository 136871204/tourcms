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
 * 缓存驱动工厂
 * @package     Cache
 * @author      周鸿 <136871204@qq.com>
 */
final class CacheFactory
{
    public static $cacheFactory = null; //静态工厂实例
    protected $cacheList = array(); //驱动链接组
    
    /**
     * 构造函数
     */

    private function __construct()
    {

    }
    
    /**
     * 返回工厂实例，单例模式
     */
    public static function factory($options){
        //传入参数不是数组的话  就 初始化空数组
        $options = is_array($options) ? $options : array();
        //只实例化一个对象
        if (is_null(self::$cacheFactory)) {
            self::$cacheFactory = new CacheFactory();
        }
        //如果有传入driver就使用传入的driver,不然使用配置文集中的dirver
        //'CACHE_TYPE'   => 'file',//类型:file memcache redis
        $driver = isset($options['driver']) ? $options['driver'] : C("CACHE_TYPE");
        //静态缓存实例名称(生成序列字符串)
        $driverName = md5_d($options);
        //对象实例存在
        if (isset(self::$cacheFactory->cacheList[$driverName])) {
            return self::$cacheFactory->cacheList[$driverName];
        }
        $class = 'Cache' . ucwords(strtolower($driver)); //缓存驱动
        //如果不存在这个缓存驱动的处理类
        if(!class_exists($class)){
            //重新加载
            $classFile = ZHPHP_DRIVER_PATH . 'Cache/' . $class . '.class.php'; //加载驱动类库文件
            if (!require_cache($classFile)) {
                halt("缓存类型指定错误，不存在缓存驱动文件:" . $classFile);
            }
        }
        $cacheObj = new $class($options);
        self::$cacheFactory->cacheList[$driverName] = $cacheObj;
        return self::$cacheFactory->cacheList[$driverName];
    }
}
?>