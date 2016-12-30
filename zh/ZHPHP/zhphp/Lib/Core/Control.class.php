<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
if (!defined("ZHPHP_PATH"))
	exit('No direct script access allowed');
    
 /**
 * 控制器基类
 * @package     core
 * @author      周鸿 <136871204@qq.com>
 */
abstract class Control {
    /**
	 * 模板视图对象
	 * @var view
	 * @access private
	 */
	protected $view = null;
	//事件参数
	protected $options = array();
    
    /**
	 * 构造函数
	 */
    public function __construct() {
        event("CONTROL_START", $this -> options);
        //制作2个魔术方法
        //子类如果存在init方法，自动运行
		if (method_exists($this, "__init")) {
			$this -> __init();
		}
        //子类如果存在auto方法，自动运行
		if (method_exists($this, "__auto")) {
			$this -> __auto();
		}
    }
    
    /**
	 * 执行不存在的函数时会自动执行的魔术方法
	 * 编辑器上传时执行php脚本及ispost或_post等都会执行这个方法
	 * @access protected
	 * @param string $method 方法名
	 * @param mixed $args 方法参数
	 * @return mixed
	 */
	public function __call($method, $args) {
        //调用的方法不存在
        //strcasecmp() 函数比较两个字符串。
        //该函数是二进制安全的，且对大小写不敏感。
        //返回0 - 如果两个字符串相等
		if (strcasecmp($method, METHOD) == 0) {
            //执行插件如uploadify|ueditor|keditor
            if (alias_import($method)) {
                //TODO：调用插件的方法，以后测试
                echo __FILE__.'---'.__CLASS__.'---'.__METHOD__;
				require    alias_import($method);
			}  elseif (method_exists($this, "__empty")) {
				//执行空方法_empty
				$this -> __empty($args);
			} else {
				//方法不存在时抛出404错误页
				_404('模块中不存在方法' . $method);
			}
		}
	}
    
    /**
	 * 显示视图
	 * @access protected
	 * @param string $tplFile 模板文件
	 * @param null $cacheTime 缓存时间
	 * @param string $cachePath 缓存目录
	 * @param bool $stat 是否返回解析结果
	 * @param string $contentType 文件类型
	 * @param string $charset 字符集
	 * @param bool $show 是否显示
	 * @return mixed
	 */
	protected function display($tplFile = null, $cacheTime = null, $cachePath = null, $stat = false, $contentType = "text/html", $charset = "", $show = true) {
		//获得视图对象
        $this -> getViewObj();
		//执行视图对象中的display同名方法
		return $this -> view -> display($tplFile, $cacheTime, $cachePath, $contentType, $charset, $show);
	}
    
    /**
	 * 获得视图对象
	 * @access private
	 * @return void
	 */
	private function getViewObj() {
	   //如果还没有视图
		if (is_null($this -> view)) {
			//获得视图驱动含zh模板引擎与smarty引擎
			$this -> view = ViewFactory::factory();
		}
	}
    
    /**
	 * 分配变量
	 * @access protected
	 * @param mixed $name 变量名
	 * @param mixed $value 变量值
	 * @return mixed
	 */
	protected function assign($name, $value = null) {
	   //获得视图对象
	   $this -> getViewObj();
       return $this -> view -> assign($name, $value);
	}
    
    /**
	 * 魔术方法
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value) {
		$this -> assign($name, $value);
	}
    
    /**
	 * Ajax输出
	 * @param $data 数据
	 * @param string $type 数据类型 text html xml json
	 */
	protected function ajax($data, $type = "JSON") {
		$type = strtoupper($type);
		switch ($type) {
			case "HTML" :
			case "TEXT" :
				$_data = $data;
				break;
			case "XML" :
				//XML处理
                //TODO:XML处理之后在做
                echo __FILE__.'---'.__CLASS__.'----'.__METHOD__;die;
				//$_data = Xml::create($data, "root", "UTF-8");
				break;
			default :
				//JSON处理
				$_data = json_encode($data);
		}
		echo $_data;
		exit ;
	}
    
    /**
	 * 错误输出
	 * @param string $msg 提示内容
	 * @param string $url 跳转URL
	 * @param int $time 跳转时间
	 * @param null $tpl 模板文件
	 */
	protected function error($msg = '出错了', $url = NULL, $time = 2, $tpl = null) {
		$url = $url ? "window.location.href='" . U($url) . "'" : "window.history.back(-1);";
		$tpl = $tpl ? $tpl : strstr(C("TPL_ERROR"), '/') ? C("TPL_ERROR") : PUBLIC_PATH . C("TPL_ERROR");
		$this -> assign(array("msg" => $msg, 'url' => $url, 'time' => $time));
		$this -> display($tpl);
		exit ;
	}
    
    /**
	 * 成功
	 * @param string $msg 提示内容
	 * @param string $url 跳转URL
	 * @param int $time 跳转时间
	 * @param null $tpl 模板文件
	 */
	protected function success($msg = '操作成功', $url = NULL, $time = 2, $tpl = null) {
        $url = $url ? "window.location.href='" . U($url) . "'" : "window.history.back(-1);";
        $tpl = $tpl ? $tpl : strstr(C("TPL_SUCCESS"), '/') ? C("TPL_SUCCESS") : PUBLIC_PATH . C("TPL_SUCCESS");
        $this -> assign(array("msg" => $msg, 'url' => $url, 'time' => $time));
        $this -> display($tpl);
        exit ;
	}
    
    /**
	 * 生成静态
	 * @param string $htmlfile 文件名
	 * @param string $htmlpath 目录
	 * @param string $template 模板文件
	 */
	public function createHtml($htmlfile, $htmlpath = '', $template = '') {
	  
		$content = $this -> fetch($template);
		$htmlpath = empty($htmlpath) ? C('HTML_PATH'): $htmlpath;
         
		$file = $htmlpath . $htmlfile . '.html';
        //echo $file;die;
		$Storage = Storage::init();
		return $Storage -> save($file, $content);
	}
    
    /**
	 * 获得视图显示内容 用于生成静态或生成缓存文件
	 * @param string $tplFile 模板文件
	 * @param null $cacheTime 缓存时间
	 * @param string $cachePath 缓存目录
	 * @param string $contentType 文件类型
	 * @param string $charset 字符集
	 * @param bool $show 是否显示
	 * @return mixed
	 */
	protected function fetch($tplFile = null, $cacheTime = null, $cachePath = null, $contentType = "text/html", $charset = "", $show = true) {
		$this -> getViewObj();
		return $this -> view -> fetch($tplFile, $cacheTime, $cachePath, $contentType, $charset);
	}
    
    	/**
	 * 模板缓存是否过期
	 * @param string $cachePath 缓存目录
	 * @access protected
	 * @return mixed
	 */
	protected function isCache($cachePath = null) {
	    //func_get_args — Returns an array comprising a function's argument list
		$args = func_get_args();
		$this -> getViewObj();
		return call_user_func_array(array($this -> view, "isCache"), $args);
	}
}