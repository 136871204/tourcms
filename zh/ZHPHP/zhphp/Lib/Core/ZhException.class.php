<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * 异常处理类
 * @package     Core
 * @author      周鸿 <136871204@qq.com>
 */
 final class ZhException extends Exception{
    /**
     * 异常类型
     * @var string
     * @access private
     */
    private $type;

    // 是否存在多余调试信息
    private $extra;
    
    /**
     * 架构函数
     * @access public
     * @param string $message 异常信息
     */
    public function __construct($message, $code = 0, $extra = false)
    {
        parent::__construct($message, $code);
        $this->type = get_class($this);
        $this->extra = $extra;
    }
    
     /**
     * 异常输出 所有异常处理类均通过__toString方法输出错误
     * 每次异常都会写入系统日志
     * 该方法可以被子类重载
     * @access public
     * @return array
     */
    public function __toString()
    {
        $trace = $this->getTrace();
        $this->class = isset($trace[0]['class']) ? $trace[0]['class'] : '';
        $this->function = isset($trace[0]['function']) ? $trace[0]['function'] : '';
        $this->file = isset($trace[0]['file']) ? $trace[0]['file'] : '';
        $this->line = isset($trace[0]['line']) ? $trace[0]['line'] : '';
        $traceInfo = '';
        $time = date('y-m-d H:i:m');
        foreach ($trace as $t) {
            if (isset($t['file'])) {
                $traceInfo .= '[' . $time . '] ' . $t['file'] . ' (' . $t['line'] . ') ';
                if (isset($t['class'])) {
                    $traceInfo .= $t['class'] . $t['type'] . $t['function'];
                }
                $traceInfo .= "\n";
            }
        }
        $error['message'] = $this->message;
        $error['type'] = $this->type;
        $error['class'] = $this->class;
        $error['function'] = $this->function;
        $error['file'] = $this->file;
        $error['line'] = $this->line;
        $error['trace'] = $traceInfo;
        // 记录 Exception 日志
        //'LOG_EXCEPTION_RECORD' => TRUE, // 记录异常
        if (C('LOG_EXCEPTION_RECORD')) {
            Log::Write('(' . $this->type . ') ' . $this->message);
        }
        return $error;
    }
 }