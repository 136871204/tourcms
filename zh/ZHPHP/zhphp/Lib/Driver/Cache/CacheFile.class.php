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
 * 文件缓存类
 * @package     Cache
 * @subpackage  Driver
 * @author      周鸿 <136871204@qq.com>
 */
class CacheFile extends Cache
{
    /**
     * 构造函数
     * @access public
     * @param array $options 缓存选项必须为数组
     */
    public function __construct($options = array()){
        $this->options['dir'] = isset($options['dir']) ? rtrim($options['dir'], '/') : CACHE_PATH; //缓存目录
        $this->options['expire'] = isset($options['expire']) ? intval($options['expire']) : C("CACHE_TIME"); //缓存时间
        $this->options['prefix'] = isset($options['prefix']) ? $options['prefix'] : ''; //缓存前缀
        $this->options['length'] = isset($options['length']) ? $options['length'] : 0; //队列长度
        $this->options['zip'] = isset($options['zip']) ? $options['zip'] : false; //队列长度
        $this->options['save'] = isset($options['save']) ? $options['save'] : true; //记录缓存命中率
        $this->isConnect = is_dir($this->options['dir']) && is_writeable($this->options['dir']);
        //如果不能在目录
         if (!$this->isConnect) {
            //创建目录
            $this->createDir();
        }
    }
    
    /**
     * 创建目录
     * @access private
     */
    private function createDir()
    {
        //递归创建目录，成功的话，缓存【联接状态】设为true
        $this->isConnect = dir_create($this->options['dir']);
    }
    
    /**
     * 获得缓存文件
     * @access public
     * @param string $name 缓存数据KEY
     * @return string
     */
    protected function getCacheFile($name)
    {
        return $this->options['dir'] . '/' . $this->options['prefix'] . $name . ".php";
    }
    
    /**
     * 设置缓存
     * @access public
     * @param string $name  缓存名称
     * @param void $data    缓存数据
     * @param void $expire  缓存时间
     * @return boolean
     */
    public function set($name, $data, $expire = null){
        $cacheFile = $this->getCacheFile($name);
        //删除缓存
        if (is_null($data)) {
            if (is_file($cacheFile)) {
                return unlink($cacheFile);
            } else {
                return true;
            }
        }
        //缓存时间
        //sprintf() 函数把格式化的字符串写入一个变量中。
        //%d - 带符号十进制数
        $expire = sprintf("%010d", !is_null($expire) ? (int)$expire : $this->options['expire']);
        //缓存目录失效
        if (!$this->isConnect) {
            $this->createDir();
        }
        $data = serialize($data);
        //压缩数据
        //当我们说到压缩，我们可能会想到文件压缩，其实，字符串也是可以压缩的。PHP提供了 gzcompress() 和gzuncompress() 函数： 
        if ($this->options['zip'] && function_exists("gzcompress")) {
            $data = gzcompress($data, 6);
        }
        //缓存内容设置
        $data = "<?php\n//" . $expire . $data . "\n?>";
        //报错缓存文件
        $stat = file_put_contents($cacheFile, $data);
        //如果文件缓存成功
        if ($stat) {
            //如果缓存列队 > 0的话
            if ($this->options['length'] > 0) {
                //队列处理
                $this->queue($name);
            }
            //记录 缓存监控 写入成功++
            $this->record(1,1);
            return true;
        }else {
            //记录 缓存监控 写入失败++
            $this->record(1,0);
            return false;
        }
    }
    
    /**
     * 获得缓存数据
     * @access public
     * @param string $name 缓存KEY
     * @return bool|mixed|null
     */
    public function get($name){
        // 获得缓存文件
        $cacheFile = $this->getCacheFile($name);
        //缓存文件不存在
        if (!is_file($cacheFile)) {
            //$type 记录类型  1写入 2读取
            //$stat 状态  0失败 1成功
            $this->record(2,0);
            //返回空
            return null;
        }
        //读取文件内容
        $content = @file_get_contents($cacheFile);
        //如果文件内容不存在
        if (!$content) {
            //缓存监控 ，记录下读取失败
            $this->record(2,0);
            return null;
        }
        //缓存文件的 8位开始 10个数字取得
        $expire = intval(substr($content, 8, 10));
        //文件修改时间
        $mtime = filemtime($cacheFile);
        //缓存失效处理(有设置失效时间 && 已经失效的话)
        if ($expire > 0 && $mtime + $expire < time()) {
            //删除缓存文件
            @unlink($cacheFile);
            //缓存监控 ，记录下读取失败，返回false
            $this->record(2,0);
            return false;
        }
        //取得缓存的数据
        $data = substr($content, 18, -3);
        //缓存文件解压缩处理
        if ($this->options['zip'] && function_exists("gzuncompress")) {
            $data = gzuncompress($data);
        }
        //读取成功记录
        $this->record(2,1);
        //返回缓存数据
        return unserialize($data);
    }
    
    /**
     * 删除缓存
     * @access public
     * @param type $name  缓存KEY
     * @return type
     */
    public function del($name)
    {
        //获得缓存文件
        $cacheFile = $this->getCacheFile($name);
        //删除缓存文件
        return is_file($cacheFile) && unlink($cacheFile);
    }
    
    
    public function delAll($time = null)
    {
        foreach (glob($this->options['dir'] . '/*.*') as $file) {
            if (is_file($file)) {
                if ($time) {
                    (filemtime($file) + $time < time()) && unlink($file);
                } else {
                    unlink($file);
                }
            }
        }
        return true;
    }
    

}
?>