<?php
    //开启debug模式
    //define('DEBUG',true);
    //var_dump($_GET);
    date_default_timezone_set('PRC');
    define('TIME_ZONE','PRC');

    //应用组目录
    define("GROUP_PATH", 'zh/');
    //Temp目录
    define("TEMP_PATH", 'temp/');
    //导入框架
    require 'zh/ZHPHP/zhphp/zhphp.php';
    //http://ip.taobao.com/service/getIpInfo.php?ip=183.195.120.18