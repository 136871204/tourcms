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
 * 缓存处理类
 * 缓存驱动类均继承此类
 * @package     Cache
 * @author      周鸿 <136871204@qq.com>
 */
class Cache
{
    protected $isConnect = false; //联接状态
    protected $options = array(); //参数
    
    /**
     * 设置连接驱动
     * @param array $options 参数
     * @return obj
     */
    static public function init($options = array()){
         return CacheFactory::factory($options); //获得缓存操作对象
    }
    
    /**
     * @param int $type 记录类型  1写入 2读取
     * @param int $stat 状态  0失败 1成功
     */
    protected function record($type, $stat = 1)
    {
        //如果不在dubug状态 && SHOW_CACHE配置没有设置话 返回
        if (!DEBUG && !C("SHOW_CACHE")) return;
        //写入状态
        if ($type === 1) {
            //缓存监控的【写入成功，写入失败】数据更新
            $stat ? Debug::$cache['write_s']++ : Debug::$cache['write_f']++;
        } else {
            //缓存监控的【读取成功，读取失败】数据更新
            $stat ? Debug::$cache['read_s']++ : Debug::$cache['read_f']++;
        }
    }
    
    /**
     * 缓存队列
     * 缓存队列即设置可以缓存的最大数量，以先进先删除原则处理队列垃圾
     * @param $name key名称
     * @return mixed
     */
    protected function queue($name){
        static $drivers = array(
            "file" => "F"
        );
        //缓存驱动设置，默认 file驱动
        $driver = isset($this->options['Driver']) ? $this->options['Driver'] : 'file';
        $_queue = $drivers[$driver][0]("zhphp_queue");
        //如果列队不存在初始化列队
        if (!$_queue) {
            $_queue = array();
        }
        array_push($_queue, $name);
        $zhphp_queue = array_unique($_queue);
        //超过队列允许最大值
        if (count($zhphp_queue) > $this->options['length']) {
            $gc = array_shift($hdphp_queue);
            if ($gc)
                $this->del($gc);
        }
         return $drivers[$driver][0]("zhphp_queue", $zhphp_queue);
    }
}
?>