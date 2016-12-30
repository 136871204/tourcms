<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
final class App
{
    /**
     * 运行应用
     * @access public
     * @reutrn mixed
     */
    public static function run(){
        //TODO:mysql的session处理方式以后测试
        /*
         'SESSION_TYPE'=>'mysql',// 必须留空
         'SESSION_OPTIONS'=>array(
         'host' =>'127.0.0.1',//Mysql 主机
         'port' =>3306,// 端口
         'user' =>'root',// 用户名
         'password' =>'',// 密码
         'database' =>'test',// 数据库
         'table' =>'hd_session',// 完整表名
         'expire' =>1440,//session 过期时间
         )
        */
        //session处理
        session(C("SESSION_OPTIONS"));
        //加载应用与事件处理类
        self::loadEventClass();
        //执行应用开始事件
        event("APP_START");
        //Debug Start
        DEBUG and Debug::start("APP_START");
        self::start();
        //Debug End
        DEBUG and Debug::show("APP_START", "APP_END");
        //日志记录
        Log::save();
        event("APP_END");
    }
    
    //加载应用与模块end事件类
    static private function loadEventClass(){
        //事件处理机制配置的【应用运行后】配置参数取得
        $app_end_event = C("app_event.app_end");
        //如果有配置参数的话
        if ($app_end_event) {
            //循环
            foreach ($app_end_event as $c) {
                //导入相应class
                ZHPHP::autoload($c . 'Event');
            }
        }
        //模块执行后
         $content_end_event = C("app_event.control_end");
        if ($content_end_event) {
            foreach ($content_end_event as $c) {
                ZHPHP::autoload($c . 'Event');
            }
        }
    }
    
    /**
     * 运行应用
     * @access private
     */
    static private function start(){
        //控制器实例
        $control = control(CONTROL);
        //控制器不存在
        if (!$control) {
            //应用组检测
            //如果是分组 && 应用组目录不存在的话
            if(IS_GROUP and !is_dir(GROUP_PATH.GROUP_NAME)){
                //跳转404，显示应用组不存在
                _404('应用组' . GROUP_PATH.GROUP_NAME . '不存在');
            }
            //应用检测
            if(!is_dir(APP_PATH)){
                _404('应用' . APP . '不存在');
            }
            //空控制器
            //访问的控制器不存在时，如果应用中存在EmptyControl.class.php 控制器，则调用
            //EmptyControl 控制器。
            //所以这里加上$control = Control("Empty");
            $control = Control("Empty");
            //如果要调用控制器，和控控制器都没有的话，就报错
            if (!$control) {
                _404('模块' . CONTROL .C("CONTROL_FIX") .'不存在');
            }
        }
        //执行动作
        try {
            //反射得到方法指针
            $method = new ReflectionMethod($control, METHOD);
            //如果方法是public的
            if ($method->isPublic()) {
                //调用这个方法
                $method->invoke($control);
            } else {
                //如果方法不是public 扔出反射异常
                throw new ReflectionException;
            }
        } catch (ReflectionException $e) {
            //手动调用__call函数，在control父类中被重写（Core/control.class.php）
            $method = new ReflectionMethod($control, '__call');
            $method->invokeArgs($control, array(METHOD, ''));
        }
    }
}
