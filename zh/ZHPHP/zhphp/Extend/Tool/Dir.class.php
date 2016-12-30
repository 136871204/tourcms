<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * 目录处理类
 * @package     tools_class
 * @author      周鸿 <136871204@qq.com>
 */
final class Dir{
    /**
     * @param string $dir_name 目录名
     * @return mixed|string
     */
    static public function dirPath($dir_name)
    {
        //调整传入dir_name
        $dirname = str_ireplace("\\", "/", $dir_name);
        return substr($dirname, "-1") == "/" ? $dirname : $dirname . "/";
    }
    
    /**
     * 遍历目录内容
     * @param string $dirName 目录名
     * @param string $exts 读取的文件扩展名
     * @param int $son 是否显示子目录
     * @param array $list
     * @return array
     */
    static public function tree($dirName = null, $exts = '', $son = 0, $list = array())
    {
        if (is_null($dirName)){
            //目录名传入空 返回本路径
            $dirName = '.';
        } 
        //调整传入dir_name
        $dirPath = self::dirPath($dirName);
        static $id = 0;
        //扩展名如果传入，并且是数组的话
        if (is_array($exts)){
            //合并成 ext1|ext2 形式
            $exts = implode("|", $exts);
        }
        //取得路径下全部文件，循环处理
        foreach (glob($dirPath . '*') as $v) {
            $id++;
            if (is_dir($v) || !$exts || preg_match("/\.($exts)/i", $v)) {
                $list [$id] ['name'] = basename($v);
                $list [$id] ['path'] = str_replace("\\", "/", realpath($v));
                $list [$id] ['type'] = filetype($v);
                $list [$id] ['filemtime'] = filemtime($v);
                //fileatime() 函数返回指定文件的上次访问时间。
                $list [$id] ['fileatime'] = fileatime($v);
                $list [$id] ['size'] = is_file($v) ? filesize($v) : self::get_dir_size($v);
                $list [$id] ['iswrite'] = is_writeable($v) ? 1 : 0;
                $list [$id] ['isread'] = is_readable($v) ? 1 : 0;
            }
            //如果需要显示目录，就递归
            if ($son) {
                if (is_dir($v)) {
                    $list = self::tree($v, $exts, $son = 1, $list);
                }
            }
        }
        return $list;
    }
    
    /**
     * 删除目录及文件，支持多层删除目录
     * @param string $dirName 目录名
     * @return bool
     */
    static public function del($dirName)
    {
        if (is_file($dirName)) {
            unlink($dirName);
            return true;
        }
        $dirPath = self::dirPath($dirName);
        
		if(!is_dir($dirPath))return true;
        foreach (glob($dirPath . "*") as $v) {
            is_dir($v) ? self::del($v) : unlink($v);
        }
        return @rmdir($dirName);
    }
    
    static public function get_dir_size($f)
    {
        $s = 0;
        foreach (glob($f . '/*') as $v) {
            $s += is_file($v) ? filesize($v) : self::get_dir_size($v);
        }
        return $s;
    }

    
    /**
     * 批量创建目录
     * @param $dirName 目录名数组
     * @param int $auth 权限
     * @return bool
     */
    static public function create($dirName, $auth = 0755){
        //调整传入dir_name
         $dirPath = self::dirPath($dirName);
         //如果已经是个路径，直接返回，退出下面处理
         if (is_dir($dirPath))
            return true;
         //利用/ 分割路径
         $dirs = explode('/', $dirPath);
         $dir = '';
         //批量创建目录
         foreach ($dirs as $v) {
            $dir .= $v . '/';
            if (is_dir($dir))
                continue;
            mkdir($dir, $auth);
        }
        //返回创建成功与否
        return is_dir($dirPath);
    }
    
    /**
     * 目录下创建安全文件
     * @param $dirName 操作目录
     * @param bool $recursive 为true会递归的对子目录也创建安全文件
     */
    static public function safeFile($dirName, $recursive = false)
    {
        //记录已经操作过的目录
        static $s = array();
        //得到框架下的安全文件index.html名字
        $file = ZHPHP_TPL_PATH . '/index.html';
        //如果不是目录 直接返回
        if (!is_dir($dirName)) return;
        ////调整传入dir_name
        $dirPath = self::dirPath($dirName);
        //如果这个目录下没有index.html ，就拷贝一份
        is_file($dirPath . 'index.html') || copy($file, $dirPath . 'index.html');
        //得到这个目录下所有文件
        foreach (glob($dirPath . "*") as $d) {
            //如果是个路径，并且，不在缓存$s中
            if (is_dir($d) && !in_array($d, $s)) {
                //在缓存中加入这个路径
                $s[] = $d;
                //继续在循环的目录下创建安全文件
                is_file($d . '/index.html') || copy($file, $d . '/index.html');
                //执行递归
                $recursive && self::safeFile($d);
            }
        }
    }
}

?>