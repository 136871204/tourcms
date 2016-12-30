<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * debug调式处理类
 * @package     Core
 * @author      周鸿 <136871204@qq.com>
 */
final class Debug{
    //信息内容
    static $info = array();
    //运行时间
    static $runtime;
    //运行内存占用
    static $memory;
    //内存峰值
    static $memory_peak;
    //所有发送的SQL语句
    static $sqlExeArr = array();
    //编译模板
    static $tpl = array();
    //缓存记录
    static $cache=array("write_s"=>0,"write_f"=>0,"read_s"=>0,"read_f"=>0);
    /**
     * 项目调试开始
     * @access public
     * @param type $start   起始
     * @return void
     */
    static public function start($start)
    {
        self::$runtime[$start] = microtime(true);
        if (function_exists("memory_get_usage")) {
            self::$memory[$start] = memory_get_usage();
        }
        //memory_get_peak_usage — 返回分配给 PHP 内存的峰值
        if (function_exists("memory_get_peak_usage")) {
            //如果函数存在的话，就设置$memory_peak[$start]是false
            self::$memory_peak[$start] = false;
        }
    }
    
    /**
     * 运行时间
     * @param string $start 起始标记
     * @param string $end   结束标记
     * @param int $decimals 小数位
     * @return void
     * @throws exceptionZH
     */
    static public function runtime($start, $end = '', $decimals = 4)
    {
        //如果没有设置【APP_START】开始时间
        if (!isset(self::$runtime[$start])) {
            throw new ZhException('没有设置调试开始点：' . $start);
        }
        //如果【APP_END】应用结束没有设定电话
        if (empty(self::$runtime[$end])) {
            //当前时间设置到【APP_END】
            self::$runtime[$end] = microtime(true);
            //number_format(number,decimals,decimalpoint,separator)
            //函数通过千位分组来格式化数字。
            //decimals:可选。规定多少个小数。如果设置了该参数，则使用点号 (.) 作为小数点来格式化数字。
            return number_format(self::$runtime[$end] - self::$runtime[$start], $decimals);
        }
    }
    
    /**
     * 项目运行内存峰值
     * @access public
     * @param string $start   起始标记
     * @param string $end     结束标记
     * @return int
     */
    static public function memory_perk($start, $end = ''){
        echo self::$memory_peak[$start];
        //如果没有设置过self::$memory_peak[$start]的话
        if (!isset(self::$memory_peak[$start]))
            return mt_rand(200000, 1000000);//mt_rand() 使用 Mersenne Twister 算法返回随机整数。
        //如果传入$end不是空的话
        if (!empty($end)){
             //memory_get_peak_usage — 返回分配给 PHP 内存的峰值
             self::$memory_peak[$end] = memory_get_peak_usage();
        }
        //返回最大内存峰值
        return max(self::$memory_peak[$start], self::$memory_peak[$end]);
    }
    
    /**
     * 显示调试信息
     * @access public
     * @param string $start   起始标记
     * @param string $end     结束标记
     * @return void
     */
    static public function show($start, $end){
        $debug = array();
        $debug['file'] = require_cache();
        $debug['runtime'] = self::runtime($start, $end);
        $debug['memory'] = number_format(self::memory_perk($start, $end) / 1000, 0) . " KB";
       // p($debug);
        require ZHPHP_TPL_PATH . '/debug.php';
    }
}