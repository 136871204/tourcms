<?php
// .-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 136871204@qq.com
// | Copyright (c) 2014, 136871204@qq.com All Rights Reserved.
// |-----------------------------------------------------------------------------------

/**
 * ZHPHP框架入口文件
 * 在应用入口引入zhphp.php即可运行框架
 * @package zhphp
 * @supackage core
 * @author 周鸿 <136871204@qq.com>
 */
 //版本号
 define('ZHPHP_VERSION', '2014-05-28');
 //如果没有定义DEBUG 就默认false
 defined("DEBUG")   or define("DEBUG", FALSE);
 //如果没有定义 【应用组所在的目录】
if (!defined('GROUP_PATH')){
    //设置【应用所在的目录】在跟目录
    defined('APP_PATH') or define('APP_PATH', './');
}
//如果没有定义【Temp 目录】
if(!defined('TEMP_PATH')){
    if(defined('APP_PATH')){//如果已经定义了【应用所在的目录】
        //设置【Temp 目录】=【应用所在的目录】.Temp/
        define('TEMP_PATH', APP_PATH. 'Temp/');
    }else{//如果没有定义【应用所在的目录】
        //设置【Temp 目录】=【应用组所在的目录】.Temp/
        define('TEMP_PATH', GROUP_PATH. 'Temp/');
    }
}
//如果没有定义【编译文件名】就默认为 ~boot.php
defined("TEMP_NAME")    or define("TEMP_NAME",'~boot.php');
//定义【编译文件】全路径
defined('TEMP_FILE')    or define('TEMP_FILE',TEMP_PATH.TEMP_NAME);
//加载核心编译文件
//如果现在不是debug 并且 编译文件已经存在话
if (!DEBUG and is_file(TEMP_FILE)) {
    //导入编译文件，TODO：编译文件生成为确认
    require TEMP_FILE;
}else{
    //框架的当前根路径设定（D:/wamp/www/zhphp/zhphp/）
    define('ZHPHP_PATH', str_replace('\\','/',dirname(__FILE__)) . '/');
    //加载Boot.class.php
    require ZHPHP_PATH . 'Lib/Core/Boot.class.php';
    Boot::run();
}