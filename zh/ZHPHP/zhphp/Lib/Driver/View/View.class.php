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
 * 视图处理抽象层
 * @package     View
 * @author      周鸿 <136871204@qq.com>
 */
abstract class View{
    
     /**
     * 获得模版文件
     */
    protected function getTemplateFile($file){
        //如果没有传入file值
        if (is_null($file))
        {   
            //就默认file是当前组tpl_path.当前控制器.当前方法
            $file = TPL_PATH . CONTROL . '/' . METHOD;
        } else if (!strstr($file, '/')) {
            //有传入值，并且传入值没有/，说明就是：当前组tpl_path.当前控制器.传入方法名
            $file = TPL_PATH . CONTROL . '/' . $file;
        }
        //添加模板后缀
        if (!preg_match('@\.[a-z]+$@', $file)){
            //'TPL_FIX'   => '.html',  //模版文件扩展名
             $file .= C('TPL_FIX');
        }
        //将目录全部转为小写
        if (is_file($file)) {
            //如果找到file的话 返回这个file
            return $file;
        } else {
            //模版文件不存在
            if (DEBUG)
                halt("模板不存在:$file");
            else
                return null;
        }
    }
	
}
