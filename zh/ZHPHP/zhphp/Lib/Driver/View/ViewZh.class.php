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
 * ZHPHP模板引擎
 * @package     Session
 * @subpackage  Driver
 * @author      周鸿 <136871204@qq.com>
 */
final class ViewZh extends View {

    public $vars = array();
	//模板变量
	public $const = array();
	//系统常量如__WEB__$const['WEB'];
	public $tplFile = null;
	//模版文件
	public $compileFile = null;
    //模板内容
    public $compileContent=null;
	
    public function resetDefault(){
        $this->vars=array();
        $this->const=array();
        $this->tplFile=null;
        $this->compileFile=null;
        $this->compileContent=null;
        /*$this -> vars = array();
    	//模板变量
    	$this -> const = array();
    	//系统常量如__WEB__$const['WEB'];
    	$this -> tplFile = null;
    	//模版文件
    	$this -> compileFile = null;
        //模板内容
        $this -> compileContent=null;*/
    }
    
    /**
	 * 模板显示
	 * @param string $tplFile 模板文件
	 * @param string $cachePath 缓存目录
	 * @param null $cacheTime 缓存时间
	 * @param string $contentType 文件类型
	 * @param string $charset 字符集
	 * @param bool $show 是否显示
	 * @return bool|string
	 */
	public function display($tplFile = null, $cacheTime = null, $cachePath = null, $contentType = "text/html", $charset = "", $show = true) {
	    
        //p($_SERVER['REQUEST_URI']);
        //缓存文件名
		$cacheName = md5($_SERVER['REQUEST_URI']);
        //p($cacheName);
        //缓存时间(有传入用传入值，没有传入值就取得配置文件值)
        //'CACHE_TPL_TIME'  => -1, //模板缓存时间 -1为不缓存 0为永久缓存
		$cacheTime = is_numeric($cacheTime) ? $cacheTime : intval(C("CACHE_TPL_TIME"));
        //缓存路径(有传入用传入值，没有传入值就默认CACHE_PATH)
		$cachePath = $cachePath ? $cachePath : CACHE_PATH;
        
        //内容
		$content = null;
        if ($cacheTime >= 0) {
            $content = S($cacheName, false, $cacheTime, array("dir" => $cachePath, 'zip'=>false,"Driver" => "File"));
		}
        //缓存失效
		if (!$content) {
            //获得模板文件,
			$this -> tplFile = $this -> getTemplateFile($tplFile);
            //定义全局变量
			$this -> setGlobalsVars();
            //模板文件不存在
			if (!$this -> tplFile)
				return;
            //编译文件
			$this -> compileFile = COMPILE_PATH . substr(md5(APP . CONTROL . METHOD . $this -> tplFile), 0, 20) . '.php';
            //记录模板编译文件
			if (DEBUG) {
				Debug::$tpl[] = array(basename($this -> tplFile), $this -> compileFile);
			}
            //编译文件失效（不存在或过期）
			if ($this -> compileInvalid($tplFile)) {
				//执行编译
				$this -> compile();
			}
            $_CONFIG = C();
			$_LANGUAGE = L();
            
			//加载全局变量
			if (!empty($this -> vars)) {
				extract($this -> vars);
			}
            ob_start();
			include ($this -> compileFile);
            $content = ob_get_clean();
            //创建缓存
			if ($cacheTime >= 0) {
				//创建缓存目录
                is_dir(CACHE_PATH) || dir_create(CACHE_PATH);
                //写入缓存
                S($cacheName, $content, $cacheTime, array("dir" => $cachePath,'zip'=>false, "Driver" => "File"));
			}
            
		}
        //是否输出到浏览器, 传入false 为返回显示内容字符串
        if ($show) {
			$charset = strtoupper(C("CHARSET")) == 'UTF8' ? "UTF-8" : strtoupper(C("CHARSET"));
			if (!headers_sent()) {
				header("Content-type:" . $contentType . ';charset=' . $charset);
			}
			echo $content;
		} else {
			return $content;
		}
	}
    
    /**
	 * 获得编译文件内容
	 * @return string
	 */
	public function getCompileContent() {
		return file_get_contents($this -> compileFile);
	}
    

    /**
	 * 内容
	 */
    public function contentCompile($content="") {
        $this->compileContent=$content;
        $this -> compileFile = COMPILE_PATH . substr(md5(APP . CONTROL . METHOD ), 0, 20) . '.php';
		$compileObj = new ViewCompile($this);
		$phpContent=  $compileObj -> runContent();
        //加载全局变量
		if (!empty($this -> vars)) {
			extract($this -> vars);
		}
        ob_start();
			include ($this -> compileFile);
            $content = ob_get_clean();
            $this->resetDefault();
        return $content;
	}
    
    /**
	 * 编译模板
	 */
	public function compile() {
		//编译是否失效
		if (!$this -> compileInvalid())
			return;
		$compileObj = new ViewCompile($this);
		$compileObj -> run();
	}
    
    
    /**
	 * 编译是否失效
	 * @return bool true 失效
	 */
	private function compileInvalid() {
	    $tplFile = $this -> tplFile;
		$compileFile = $this -> compileFile;
        return DEBUG || !file_exists($compileFile) || //DEBUG模式下 || 模板不存在 || 有最新修改
        (filemtime($tplFile) > filemtime($compileFile));
		//编板有更新
	}
    
    //定义常量
	public function setGlobalsVars() {
	   //取得所有常量
		$constData = get_defined_constants(true);
        //循环用户定义常量
		foreach ($constData['user'] as $name => $value) {
		  //吧_去除
			$name = str_replace('_', '', $name);
            //赋值给全局变量
			$GLOBALS['user'][$name] = $value;
		}
	}
    
    /**
	 * 向模板中传入变量
	 * @param string $var 变量名
	 * @param mixed $value 变量值
	 * @return bool
	 */
	public function assign($var, $value) {
		if (is_array($var)) {
			foreach ($var as $k => $v) {
				if (is_string($k))
					$this -> vars[$k] = $v;
			}
		} else {
			$this -> vars[$var] = $value;
		}
	}
    
    /**
	 * 获得视图内容
	 */
	public function fetch($tplFile = null, $cacheTime = null, $cachePath = null, $contentType = "text/html", $charset = "") {
		return $this -> display($tplFile, $cacheTime, $cachePath, $contentType, $charset, false);
	}
    
    /**
	 * 验证缓存是否过期
	 * @param string $cachePath 缓存目录
	 * @return bool
	 */
	public function isCache($cachePath = null) {
		$cachePath = $cachePath ? $cachePath : CACHE_PATH;
		$cacheName = md5($_SERVER['REQUEST_URI']);
		return S($cacheName, false, null, array("dir" => $cachePath, "Driver" => "File")) ? true : false;
	}
}
