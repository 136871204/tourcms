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
 * 视图处理抽象工厂
 * @package     View
 * @author      周鸿 <136871204@qq.com>
 */
class ViewFactory
{

    public static $viewFactory = '';
	//静态工厂实例
	protected $driverList = array();
	//驱动链接组
    private function __construct() {

	}
    
    /**
	 * 返回工厂实例，单例模式
	 */
	public static function factory($driver = null) {
	   //只实例化一个对象
		if (self::$viewFactory == '') {
			self::$viewFactory = new viewFactory();
		}
        //如果没有传入视图引擎
        if (is_null($driver)) {
            //调用配置文件信息
            //'TPL_ENGINE'  => 'ZH',  //模板引擎 ZH,Smarty
			$driver = ucfirst(strtolower(C("TPL_ENGINE")));
		}
        //如果已经有设置过这个引擎的话
        if (isset(self::$viewFactory -> driverList[$driver])) {
            //直接返回当前引擎
            return self::$viewFactory -> driverList[$driver];
        }
        //获得数据库驱动接口
        self::$viewFactory -> getDriver($driver);
        //返回对应的驱动接口
        return self::$viewFactory -> driverList[$driver];
	}

    /**
	 * 获得数据库驱动接口
	 * @param string $driver 驱动
	 * @return bool
	 */
     public function getDriver($driver) {
        //如果已经有设置过这个引擎的话
        if (isset($this -> driverList[$driver])) {
            //直接返回当前引擎
			return $this -> driverList[$driver];
		}
        //根据传入driver名，取得处理类名
        $class = "View" . ucfirst($driver);
        //加载类文件（在类咩有加载过的时候）
		if (!class_exists($class, false)) {
			$classFile = ZHPHP_DRIVER_PATH . 'View/' . $class . '.class.php';
			if (!require_cache($classFile)) {
				DEBUG && halt($classFile . "不存在");
			}
		}
        //创建对象
        $this -> driverList[$driver] = new $class();
		//视图操作引擎对象
		return true;
     }
}
