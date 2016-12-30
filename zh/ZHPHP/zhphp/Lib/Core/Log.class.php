<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * 日志处理类
 * @package     Core
 * @author      周鸿 <136871204@qq.com>
 */
class Log{
    const FATAL = 'FATAL'; // 严重错误: 导致系统崩溃无法使用
    const ERROR = 'ERROR'; // 一般错误: 一般性错误
    const WARNING = 'WARNING'; // 警告性错误: 需要发出警告的错误
    const NOTICE = 'NOTICE'; // 通知: 程序可以运行但是还不够完美的错误
    const DEBUG = 'DEBUG'; // 调试: 调试信息
    const SQL = 'SQL'; // SQL：SQL语句 注意只在调试模式开启时有效
    
    //日志信息
    static $log = array();
    
    /**
     * 记录日志内容
     * @param $message 错误
     * @param string $level 级别
     * @param bool $record 是否记录
     */
    static public function record($message, $level = self::ERROR, $record = false)
    {
        if ($record || in_array($level, C('LOG_LEVEL'))) {
            self::$log[] = date("[ c ]") . "{$level}: {$message}\r\n";
        }
    }
    
    /**
     * 写入日志内容
     * @access public
     * @param string $message 日志内容
     * @param string $level 错误等级
     * @param int $type 处理方式
     * @param string $destination 日志文件
     * @param string $extraHeaders
     * @return void
     */
    static public function write($message, $level = self::ERROR, $type = 3, $destination = NULL, $extraHeaders = NULL)
    {
        //如果没有设置（目标日志文件）
        if (is_null($destination)) {
            //就存放在默认文件夹下
            $destination = ROOT_PATH.LOG_PATH . date("Y_m_d") . ".log";
        }
        //如果是个dir的话
        if (is_dir(ROOT_PATH.LOG_PATH)) {
            //error_log(error,type,destination,headers)     函数向服务器错误记录、文件或远程目标发送一个错误。
            /*
            type
            可选。规定错误记录的类型。
            可能的记录类型：
                0 - 默认。根据在 php.ini 文件中的 error_log 配置，错误被发送到服务器日志系统或文件。
                1 - 错误被发送到 destination 参数中的地址。只有该类型使用 headers 参数。
                2 - 通过 PHP debugging 连接来发送错误。该选项只在 PHP 3 中可用。
                3 - 错误发送到文件目标字符串。
            destination：可选。规定向何处发送错误消息。该参数的值依赖于 "type" 参数的值。
            headers：
            可选。只在 "type" 为 1 时使用。
            规定附加的头部，比如 From, Cc 以及 Bcc。由 CRLF (\r\n) 分隔。
            注释：在发送电子邮件时，必须包含 From 头部。可以在 php.ini 文件中或者通过此参数设置。
            */
            error_log(date("[ c ]") . "{$level}: {$message}\r\n", $type, $destination, $extraHeaders);
        }
    }
    
    /**
     * 存储日志内容
     * @access public
     * @param int $type 处理方式
     * @param string $destination 日志文件
     * @param type $extraHeaders 额外信息（发送邮件）
     * @return void
     */
    static public function save($type = 3, $destination = NULL, $extraHeaders = NULL)
    {
        //如果日志是空的话
        if (empty(self::$log)){
            //不做任何操作直接返回
            return;
        } 
        //如果【日志文件】是空的话
        if (is_null($destination)) {
            $destination = ROOT_PATH.LOG_PATH . date("Y_m_d") . ".log";
        }
        if (is_dir(ROOT_PATH.LOG_PATH)) {
            error_log(implode("", self::$log) . "\r\n", $type, $destination, $extraHeaders);
        }
        self::$log = array();
    }
}