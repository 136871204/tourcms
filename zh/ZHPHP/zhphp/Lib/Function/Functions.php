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
 * 系统核心函数库
 * @category    ZHPHP
 * @package     Lib
 * @subpackage  core
 * @author      周鸿 <136871204@qq.com>
 */
 
 


 
/**
 * 加载核心模型
 * @param String $table 表名
 * @param Boolean $full 是否为全表名
 * @return Object 返回模型对象
 */
function M($table = null, $full = null) {
	return new Model($table, $full);
}


/**
 * 生成扩展模型
 * @param $class 扩展类名
 * @param array $param __init()方法参数
 * @return mixed
 */
function K($class, $param = array()) {
	$class .= "Model";
	return new $class(null, null, null, $param);
}


/**
 * 载入或设置配置顶
 * @param string $name 配置名
 * @param string $value 配置值
 * @return bool|null
 */
function C($name = null, $value = null) {
    //全局缓存设置数据
	static $config = array();
    //如果没有传入name
	if (is_null($name)) {
        //返回config数据
		return $config;
	}
    //如果传入value 是数组的话
	if (is_array($value)) {
	    //将数组键名变成大写或小写
		$value = array_change_key_case_d($value);
	}
    //如果传入的配置名是 字符串的话
	if (is_string($name)) {
	    //把配置名转换小写
		$name = strtolower($name);
        //如果配置名中不含有 . 的话
		if (!strstr($name, '.')) {
			//获得配置
			if (is_null($value)) {
			     //如果已经缓存过这个配置 && 这个配置的值不是array
				if (isset($config[$name]) && !is_array($config[$name])) {
				    //将这个配置项的值trim一下
					$config[$name] = trim($config[$name]);
				}
                //返回这个配置项的值，如果没有配置的话，返回null
				return isset($config[$name]) ? $config[$name] : null;
			}
			//加载语言包
			if ($name == 'language') {
                
				is_file(COMMON_LANGUAGE_PATH . $value . '.php') and L(
				require COMMON_LANGUAGE_PATH . $value . '.php');
				//加载应用语言包
				is_file(LANGUAGE_PATH . $value . '.php') and L(
				require LANGUAGE_PATH . $value . '.php');
			}
            //如果已经有这个配置项了 && 这个配置项的值是array  && 传入的值也是array的话
            if( isset($config[$name]) && is_array($config[$name]) && is_array($value)){
                //合并数组
                $config[$name]= array_merge($config[$name], $value);
            }else{
                //否则直接赋值
                $config[$name]=$value;
            }
            //返回配置项的值
			return $config[$name];
		}
		//二维数组，二维数组用.来分割
		$name = array_change_key_case_d(explode(".", $name), 0);
        //如果传入value是空
		if (is_null($value)) {
		      //第一个参数的值来得到配置项
			return isset($config[$name[0]][$name[1]]) ? $config[$name[0]][$name[1]] : null;
		}
        //设置二维数组形式的配置值
		$config[$name[0]][$name[1]] = $value;
	}
    //如果传入name是 数组的话
	if (is_array($name)) {
	       //合并数组
		$config = array_merge($config, array_change_key_case_d($name, 0));
		return true;
	}
}

//加载语言处理
function L($name = null, $value = null) {
    //全局缓存设置数据
	static $languge = array();
    //如果没有传入name
	if (is_null($name)) {
	   //返回缓存数据
		return $languge;
	}
    //如果配置项是字符串
	if (is_string($name)) {
	   //配置项的key转换小写
		$name = strtolower($name);
        //如果配置项没有.的话
		if (!strstr($name, '.')) {
            //如果没有传入配置项的值的话
			if (is_null($value)){
			     //返回该配置项的值
			     return isset($languge[$name]) ? $languge[$name] : null;
		      }
			//有传入配置项的值，就更新后在返回	
			$languge[$name] = $value;
			return $languge[$name];
		}
		//二维数组，二维数组用.来分割
		$name = array_change_key_case_d(explode(".", $name), 0);
        //如果传入value是空
		if (is_null($value)) {
		    //第一个参数的值来得到配置项
			return isset($languge[$name[0]][$name[1]]) ? $languge[$name[0]][$name[1]] : null;
		}
        //设置二维数组形式的配置值
		$languge[$name[0]][$name[1]] = $value;
	}
    //如果传入name是 数组的话
	if (is_array($name)) {
	    //合并数组
		$languge = array_merge($languge, array_change_key_case_d($name));
		return true;
	}
}


/**
 * 快速缓存 以文件形式缓存
 * @param String $name 缓存KEY
 * @param bool $value 删除缓存
 * @param string $path 缓存目录
 * @return bool
 */
function F($name, $value = false, $path = CACHE_PATH) {
    //缓存数组初始化
    $_cache = array();
    //传入$path + 传入$name. '.php'
    $cacheFile = rtrim($path, '/') . '/' . $name . '.php';
    //echo $cacheFile;die;
    //如果传入【删除缓存】是null的话
    if (is_null($value)) {
        //有这个文件的话
        if (is_file($cacheFile)) {
            //删除缓存文件
            unlink($cacheFile);
			unset($_cache[$name]);
        }
        //返回
        return true;
    }
    //如果传入【删除缓存】是false的话
    if ($value === false) {
        //如果已经设置过这个缓存数据的话，直接返回
        if (isset($_cache[$name]))
			return $_cache[$name];
        //如果存在这个缓存文件的话，就加载后返回，
        return is_file($cacheFile) ?include $cacheFile : null;
    }
    //根据传入数据得到缓存php文件内容 compress:去空格，去除注释包括单行及多行注释
    $data = "<?php if(!defined('ZHPHP_PATH'))exit;\nreturn " . compress(var_export($value, true)) . ";\n?>";
    //没有路径 就 创建路径
    is_dir($path) || dir_create($path);
    //写入缓存文件，失败返回false
    if (!file_put_contents($cacheFile, $data)) {
		return false;
	}
    $_cache[$name] = $data;
	return true;
}

/**
 * 缓存处理
 * @param string $name 缓存名称
 * @param bool $value 缓存内容
 * @param null $expire 缓存时间
 * @param array $options 选项
 * <code>
 * array("Driver"=>"file","dir"=>"Cache","Driver"=>"memcache")
 * </code>
 * @return bool
 */
function S($name, $value = false, $expire = null, $options = array()) {
    //$cacheName, FALSE, null, array("Driver" => "file", "dir" => CACHE_PATH, "zip" => false)
    static $_data = array();
    //得到缓存处理类对象
	$cacheObj = Cache::init($options);
    //如果传入$value是空的话
    if (is_null($value)) {
        //删除缓存
		return $cacheObj -> del($name);
	}
    //缓存驱动取得
    $driver = isset($options['Driver']) ? $options['Driver'] : '';
    //缓存的key设定
    $key = $name . $driver;
    //如果传入$value 缓存内容 为false 的话
    if ($value === false) {
        //如果缓存数据有这个内容的话能
        if (isset($_data[$key])) {
            //缓存监控的【读取成功】数加1
            Debug::$cache['read_s']++;
            //返回这个内容
			return $_data[$key];
        }else {
			return $cacheObj -> get($name, $expire);
		}
       
    }
    $cacheObj -> set($name, $value, $expire);
    $_data[$key] = $value;
	return true;
}

/**
 * 获得视图模型
 * @param null $tableName 表名
 * @param null $full 带前缀
 * @return ViewModel
 */
function V($tableName = null, $full = null) {
	return new ViewModel($tableName, $full);
}


/**
 * 是否为AJAX提交
 * @return boolean
 */
function ajax_request() {
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		return true;
	return false;
}

/**
 * 打印输出数据
 * @param void $var
 */
function show($var) {
	if (is_bool($var)) {
		var_dump($var);
	} else if (is_null($var)) {
		var_dump(NULL);
	} else {
		echo "<pre style='padding:10px;border-radius:5px;background:#F5F5F5;border:1px solid #aaa;font-size:14px;line-height:18px;'>" . print_r($var, true) . "</pre>";
	}
}

/**
 * 打印输出数据|show的别名
 * @param void $var
 */
function p($var) {
	show($var);
}

/**
 * 跳转网址
 * @param string $url 跳转urlg
 * @param int $time 跳转时间
 * @param string $msg
 */
function go($url, $time = 0, $msg = '') {
    //转换跳转url
	$url = U($url);
    //headers_sent() 函数检查 HTTP 标头是否已被发送以及在哪里被发送。
    //一旦报头块已经发送，就不能使用 header() 函数 来发送其它的标头。使用此函数至少可以避免与 HTTP 标头有关的错误信息。
	if (!headers_sent()) {
        //HTTP 标头没有被发送，使用header来跳转页面
		$time == 0 ? header("Location:" . $url) : header("refresh:{$time};url={$url}");
		exit($msg);
	} else {
	    //HTTP 标头已经发送，使用meta的 refresh来跳转
		echo "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
		if ($time)
		exit($msg);
	}
}


/**
 * session处理
 * @param string|array $name 数组为初始session
 * @param string $value 值
 * @return mixed
 */
function session($name = '', $value = '') {
    if (is_array($name)) {
        //让session自动启动
        ini_set('session.auto_start', 0);
        if (isset($name['name'])){
            //如果传入数组有这只name的话 就让这个name作为session_name
            session_name($name['name']);
        }
        if (isset($_REQUEST[session_name()])){
            //如果request里面有session_name参数的话，就拿这个参数的值作为session_id
            session_id($_REQUEST[session_name()]);
        }
        if (isset($name['path'])){
            //如果传入name里面有path参数的话，就默认这个传入的值为save_path
            session_save_path($name['path']);
        }
        if (isset($name['domain'])){
            //传入参数有domain的话，就设置session的作用domain
            ini_set('session.cookie_domain', $name['domain']);
        }
        if (isset($name['expire'])){
            //设置session的有效期时间
            ini_set('session.gc_maxlifetime', $name['expire']);
        }	
        if (isset($name['use_trans_sid'])){
            //开启让PHP自动跨页传递session id。 
            ini_set('session.use_trans_sid', $name['use_trans_sid'] ? 1 : 0);
        }
		if (isset($name['use_cookies'])){
		      //essionid在客户端采用的存储方式，置1代表使用cookie记录客户端的sessionid，
            //同时，$_COOKIE变量里才会有$_COOKIE[‘PHPSESSIONID’]这个元素存在
            ini_set('session.use_cookies', $name['use_cookies'] ? 1 : 0);
        }
		if (isset($name['cache_limiter'])){
		    //指定会话页面所使用的缓冲控制方法：
            //当session_cache_limiter('private')时，用处是让表单history.go(-1)的时候，填写内容不丢失！就避免页面失效的警告！
            session_cache_limiter($name['cache_limiter']);
        }
		if (isset($name['cache_expire'])){
		  //和session_cache_limiter联合使用，设置有效期
		   session_cache_expire($name['cache_expire']);
        }
        if (isset($name['type']))
        {
            //设置SESSION_TYPE配置项
            //'SESSION_TYPE'   => '', //引擎:mysql,memcache,redis
            C('SESSION_TYPE', $name['type']);
        }
		if (C('SESSION_TYPE')) {
		      //更具session_type来确定 session处理类名
		    $class = 'Session' . ucwords(strtolower(C('SESSION_TYPE')));
            //导入session处理类的文件
            require_cache(ZHPHP_DRIVER_PATH . '/Session/' . $class . '.class.php');
            //new这个类
			$hander = new $class();
            //运行session处理类的run 来开启
			$hander -> run();
		}
        //自动开启SESSION
        //'SESSION_AUTO_START'=> TRUE,//自动开启SESSION
		if (C("SESSION_AUTO_START"))
			session_start();	
    }elseif ($value === '') {
        if ('[pause]' == $name) {// 暂停
			session_write_close();
		} elseif ('[start]' == $name) {//开启
			session_start();
		} elseif ('[destroy]' == $name) {//销毁
			$_SESSION = array();
			session_unset();
			session_destroy();
		} elseif ('[regenerate]' == $name) {//生成id
			session_regenerate_id();
		} elseif (0 === strpos($name, '?')) {// 检查session
			$name = substr($name, 1);
			return isset($_SESSION[$name]);
		} elseif (is_null($name)) {// 清空session
			$_SESSION = array();
		} else {
			return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
		}
    }elseif (is_null($value)) {// 删除session
        if (isset($_SESSION[$name]))
			unset($_SESSION[$name]);
    }elseif (is_null($name)) {
        $_SESSION = array();
		session_unset();
		session_destroy();
    } elseif ($name === '') {
        return $_SESSION;
    }else {//设置session
        $_SESSION[$name] = $value;
    }
}

/**
 * 执行事件中的所有处理程序
 * @param $name 事件名称
 * @param array $param 参数
 * return void
 */
function event($name, &$param = array()) {
    //框架核心事件加载 zhphp/config/event.php里面的配置项
	$core = C("CORE_EVENT." . $name);
    //应用组事件 组公用目录下的 config/event.php的配置
	$group = C("GROUP_EVENT." . $name);
    //应用事件 各自应用下的 event.php配置，
	$event = C("APP_EVENT." . $name);
    //三个时间配置值合并，优先顺序 $event>$group>$core
    if (is_array($group)) {
		if ($core) {
			$group = array_merge($core, $group);
		}
	} else {
		$group = $core;
	}
    if (is_array($group)) {
		if ($event) {
			$event = array_merge($group, $event);
		} else {
			$event = $group;
		}
	}
    //如果event有值的话，就循环执行
	if (is_array($event) && !empty($event)) {
		foreach ($event as $e) {
			E($e, $param);
		}
	}
    
}

/**
 * 执行单一事件处理程序
 * @param string $name 事件名称
 * @param null $params 事件参数
 */
function E($name, &$params = null) {
	$class = $name . "Event";
	$event = new $class;
	$event -> run($params);
}

/**
 * 实例化控制器并执行方法
 * @param $control 控制器
 * @param null $method 方法
 * @param array $args 参数
 * @return bool|mixed
 */
function control($class, $method = NULL, $args = array()) {
    //'CONTROL_FIX'  => 'Control', //控制器文件后缀
    //连接控制器class的后缀名
    $class = $class.C('CONTROL_FIX');
    //控制器文件的全路径
    $classfile =$class.'.class.php';
    //引入需要的控制器文件
    if (require_array(
        array(
            ZHPHP_CORE_PATH . $classfile, 
            CONTROL_PATH . $classfile, 
            COMMON_CONTROL_PATH . $classfile))) {
        //如果有这个类
        if (class_exists($class)) {
            //new这个类的对象
            $obj = new $class();
            //如果有传入方法名，并且有这个方法的话
            if ($method && method_exists($obj, $method)) {
                //调用方法和传入参数
				return call_user_func_array(array(&$obj, $method), $args);
			}
            return $obj;
        }
    }else{
        //如果导入相关文件没有的话，返回false
        return false;
    }
}

/**
 * HTTP状态信息设置
 * @param Number $code 状态码
 */
function set_http_state($code) {
	$state = array(200 => 'OK', // Success 2xx
	// Redirection 3xx
	301 => 'Moved Permanently', 302 => 'Moved Temporarily ',
	// Client Error 4xx
	400 => 'Bad Request', 403 => 'Forbidden', 404 => 'Not Found',
	// Server Error 5xx
	500 => 'Internal Server Error', 503 => 'Service Unavailable', );
	if (isset($state[$code])) {
		header('HTTP/1.1 ' . $code . ' ' . $state[$code]);
		header('Status:' . $code . ' ' . $state[$code]);
		//FastCGI模式
	}
}

/**
 * 获得客户端IP地址
 * @param int $type 类型
 * @return int
 */
function ip_get_client($type = 0) {
	$type = intval($type);
	$ip = '';
	//保存客户端IP地址
	if (isset($_SERVER)) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$ip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$ip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else {
			$ip = getenv("REMOTE_ADDR");
		}
	}
	$long = ip2long($ip);
	$clientIp = $long ? array($ip, $long) : array("0.0.0.0", 0);
	return $clientIp[$type];
}

/**
 * 类库导入
 * @param null $class 类名
 * @param null $base 目录
 * @param string $ext 扩展名
 * @return bool
 */
function import($class = null, $base = null, $ext = ".class.php") {
    //@.Class.Html
    //用/ 替换字符串中的 .
    $class = str_replace(".", "/", $class);
    //如果$base是空的话
    if (is_null($base)) {
        //根据/来分割数组
        $info = explode("/", $class);
        //如果info的第一位是@ || 第一位等于当前应用组
        if ($info[0] == '@' || APP == $info[0]) {
            //import('@.Class.Html')：加载当前应用Class/Html.class.php
            //当前应用组的目录路径
            $base = APP_PATH;
            //吧第一个点之前的字符串去除
			$class = substr_replace($class, '', 0, strlen($info[0]) + 1);
        }elseif ($info[0] == '@@') {
            //加载当前应用组Zhcms/Index/Config/Tag.class.php
            //import('@@.Hdcms.Index.Config.Tag')
			$base = GROUP_PATH;
			$class = substr_replace($class, '', 0, strlen($info[0]) + 1);
		}elseif (strtoupper($info[0]) == 'ZHPHP') {
		   //导入框架Extend/Tool 目录下Html.class.php 类
           //import('ZHPHP.Extend.Tool.Html')
			$base = dirname(substr_replace($class, ZHPHP_PATH, 0, 6));
			$class = basename($class);
		} elseif (in_array(strtoupper($info[0]), array("LIB", "ORG"))) {
			$base = APP_PATH;
		} else {
			//其它应用
			$base = APP_PATH . '../' . $info[0] . '/';
			$class = substr_replace($class, '', 0, strlen($info[0]) + 1);
		}
    }else {
		$base = str_replace('.', '/', $base);
	}
    //为$base路径补充完整，最后应该有/
    if (substr($base, -1) != '/')
        $base .= '/';
    //完整文件名取得
    $file = $base . $class . $ext;
   // echo $file;
    //如果还不存在要import的类
    if (!class_exists(basename($class), false)) {
        //加载这个类文件
		return require_cache($file);
	}
    return true;
}

/**
 * 用户定义常量
 * @param bool $view 是否显示
 * @param bool $tplConst 是否只获取__WEB__这样的常量
 * @return array
 */
function print_const($view = true, $tplConst = false) {
    //得到所有的常量
	$define = get_defined_constants(true);
    //得要用户定义的常量
	$const = $define['user'];
	if ($tplConst) {
		$const = array();
		foreach ($define['user'] as $k => $d) {
			if (preg_match('/^__/', $k)) {
				$const[$k] = $d;
			}
		}
	}
	if ($view) {
		p($const);
	} else {
		return $const;
	}
}

/**
 * 获取与设置请求参数
 * @param $var 参数如 Q("cid) Q("get.cid") Q("get.")
 * @param null $default 默认值 当变量不存在时的值
 * @param null $filter 过滤函数
 * @return array|null
 */
function Q($var, $default = null, $filter = null) {
    //拆分，支持get.id  或 id
	$var = explode(".", $var);
	if (count($var) == 1) {
	   //如果没有设定get. 或者post. 或者request. 的话 默认使用request
	   //array_unshift() 函数在数组开头插入一个或多个元素。
       /*
       $a=array("a"=>"Cat","b"=>"Dog");
        array_unshift($a,"Horse");
        Array ( [0] => Horse [a] => Cat [b] => Dog )
       */
		array_unshift($var, 'request');
	}
    $var[0] = strtolower($var[0]);
	//获得数据并执行相应的安全处理
	switch (strtolower($var[0])) {
		case 'get' :
			$data = &$_GET;
			break;
		case 'post' :
			$data = &$_POST;
			break;
		case 'request' :
			$data = &$_REQUEST;
			break;
		case 'files' :
			$data = &$_FILES;
			break;
		case 'session' :
			$data = &$_SESSION;
			break;
		case 'cookie' :
			$data = &$_COOKIE;
			break;
		case 'server' :
			$data = &$_SERVER;
			break;
		case 'globals' :
			$data = &$GLOBALS;
			break;
		default :
			throw_exception($var[0] . 'Q方法参数错误');
	}
    //没有执行参数如q("post.")时返回所有数据
	if (empty($var[1])) {
		return $data;
		//如果存在数据如$this->_get("page")，$_GET中存在page数据
	} else if (isset($data[$var[1]])) {
	   //要获得参数如$this->_get("page")中的page
		$value = $data[$var[1]];
        //对参数进行过滤的函数
        //'FILTER_FUNCTION' => array('htmlspecialchars','strip_tags'), //过滤函数会在Q(),date_format()等函数中使用
		$funcArr = is_null($filter) ? C("FILTER_FUNCTION") : $filter;
        //参数过滤函数
		if (is_string($funcArr) && !empty($funcArr)) {
			$funcArr = explode(",", $funcArr);
		}
        //是否存在过滤函数
		if (!empty($funcArr) && is_array($funcArr)) {
		   //对数据进行过滤处理
			foreach ($funcArr as $func) {
			     //过滤方法不存在 跳过
				if (!function_exists($func))
					continue;
                //array_map() 函数返回用户自定义函数作用后的数组。回调函数接受的参数数目应该和传递给 array_map()
                // 函数的数组数目一致。
				$value = is_array($value) ? array_map($func, $value) : $func($value);
			}
            $data[$var[1]] = $value;
			return $value;
		}
        return $value;
		//不存在值时返回第2个参数，例：$this->_get("page")当$_GET['page']不存在page时执行
	}else {
		$data[$var[1]] = $default;
		return $default;
	}

}


/**
 * 获得几天前，几小时前，几月前
 * @param int $time 时间戳
 * @param array $unit 时间单位
 * @return bool|string
 */
function date_before($time, $unit = null) {
	$time = intval($time);
	$unit = is_null($unit) ? array("年", "月", "星期", "天", "小时", "分钟", "秒") : $unit;
	switch (true) {
		case $time < (NOW - 31536000) :
			return floor((NOW - $time) / 31536000) . $unit[0] . '前';
		case $time < (NOW - 2592000) :
			return floor((NOW - $time) / 2592000) . $unit[1] . '前';
		case $time < (NOW - 604800) :
			return floor((NOW - $time) / 604800) . $unit[2] . '前';
		case $time < (NOW - 86400) :
			return floor((NOW - $time) / 86400) . $unit[3] . '前';
		case $time < (NOW - 3600) :
			return floor((NOW - $time) / 3600) . $unit[4] . '前';
		case $time < (NOW - 60) :
			return floor((NOW - $time) / 60) . $unit[5] . '前';
		default :
			return floor(NOW - $time) . $unit[6] . '前';
	}
}

/**
 * 获得变量值
 * @param string $varName 变量名
 * @param mixed $value 值
 * @return mixed
 */
function _default($varName, $value = "") {
	return isset($varName) && !empty($varName) ? $varName : $value;
}

/**
 * 对数组或字符串进行转义处理，数据可以是字符串或数组及对象
 * @param void $data
 * @return type
 */
function addslashes_d($data) {
	if (is_string($data)) {
		return addslashes($data);
	}
	if (is_numeric($data)) {
		return $data;
	}
	if (is_array($data)) {
		$var = array();
		foreach ($data as $k => $v) {
			if (is_array($v)) {
				$var[$k] = addslashes_d($v);
				continue;
			} else {
				$var[$k] = addslashes($v);
			}
		}
		return $var;
	}
}

 /**
 * URL过滤
 * @param   string  $url  参数字符串，一个urld地址,对url地址进行校正
 * @return  返回校正过的url;
 */
function sanitize_url($url , $check = 'http://')
{
    if (strpos( $url, $check ) === false)
    {
        $url = $check . $url;
    }
    return $url;
}


function isMobile()
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset ($_SERVER['HTTP_VIA']))
    {
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            );
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
    return false;
} 



/**
 * 获得游览器默认语言
 * 
 *
 * @return  string
 */
function getBrowserLang(){
    $returnLan="";
    $lang="";
    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
    }
    
    //只取前4位，这样只判断最优先的语言。
    if (preg_match("/zh-c/i", $lang))
        $returnLan="zh";
    else if (preg_match("/ja/i", $lang))
        $returnLan="ja";
    else
        $returnLan=C('LANGUAGE');
    return $returnLan;
} 

function getEnableLan(){
    return array(
                    "zh"=>"中文",
                    "ja"=>"日本語"
                );
}


function array_sort_images($images){
        $pathArrays=$images['path'];
        $altArrays=$images['alt'];
        for ($i = 1;$i < count($altArrays);$i++){
            for ($j = 0;$j < count($altArrays) - $i;$j++){
                if ($altArrays[$j] > $altArrays[$j + 1]){
                    $temp = $altArrays[$j];
                    $altArrays[$j] = $altArrays[$j + 1];
                    $altArrays[$j + 1] = $temp;    
                    
                    $tempValue = $pathArrays[$j];
                    $pathArrays[$j] = $pathArrays[$j + 1];
                    $pathArrays[$j + 1] = $tempValue;
                }
            }
        }
        $images['path']=$pathArrays;
        $images['alt']=$altArrays;
        
        return $images;
}

function html_options($arr)
    {
        $selected = $arr['selected'];

        if ($arr['options'])
        {
            $options = (array)$arr['options'];
        }
        elseif ($arr['output'])
        {
            if ($arr['values'])
            {
                foreach ($arr['output'] AS $key => $val)
                {
                    $options["{$arr[values][$key]}"] = $val;
                }
            }
            else
            {
                $options = array_values((array)$arr['output']);
            }
        }
        if ($options)
        {
            foreach ($options AS $key => $val)
            {
                $out .= $key == $selected ? "<option value=\"$key\" selected>$val</option>" : "<option value=\"$key\">$val</option>";
            }
        }

        return $out;
    }
    
    

/**
 * 获得用户的真实IP地址
 *
 * @access  public
 * @return  string
 */
function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}

     function buildInStr($itemList,$key,$split=','){
        $item_list_tmp = '';
        foreach ($itemList AS $item)
        {
            if ($item[$key] !== '')
            {
                $item_list_tmp .= $item_list_tmp ? "$split$item[$key]" : "$item[$key]";
            }
        }
        return $item_list_tmp;
    }
    
    function defaultv($value,$defaultValue){
        $p=empty($value)? $defaultValue : $value;
        return $p;
    }
    function escape($value){
        $p=htmlspecialchars($value);
        return $p;
    }
    
    
    
    /**
 * cookie处理
 * @param        $name   名称
 * @param string $value 值
 * @param mixed $option 选项
 * @return mixed
 */
function cookie($name, $value = '', $option = array())
{
    // 默认设置
    $config = array('prefix' => C('COOKIE_PREFIX'), // cookie 名称前缀
        'expire' => C('COOKIE_EXPIRE'), // cookie 保存时间
        'path' => C('COOKIE_PATH'), // cookie 保存路径
        'domain' => C('COOKIE_DOMAIN'), // cookie 有效域名
    );
    // 参数设置(会覆盖黙认设置)
    if (!empty($option)) {
        if (is_numeric($option))
            $option = array('expire' => $option);
        elseif (is_string($option))
            parse_str($option, $option);
        $config = array_merge($config, array_change_key_case($option));
    }
    // 清除指定前缀的所有cookie
    if (is_null($name)) {
        if (empty($_COOKIE)) return;
        // 要删除的cookie前缀，不指定则删除config设置的指定前缀
        $prefix = empty($value) ? $config['prefix'] : $value;
        if (!empty($prefix)) { // 如果前缀为空字符串将不作处理直接返回
            foreach ($_COOKIE as $key => $val) {
                if (0 === stripos($key, $prefix)) {
                    setcookie($key, '', time() - 3600, $config['path'], $config['domain']);
                    unset($_COOKIE[$key]);
                }
            }
        }
        return $_COOKIE;
    }
    $name = $config['prefix'] . $name;
    if ('' === $value) {
        // 获取指定Cookie
        return isset($_COOKIE[$name]) ? json_decode(MAGIC_QUOTES_GPC ? stripslashes($_COOKIE[$name]) : $_COOKIE[$name]) : null;
    } else {
        if (is_null($value)) {
            setcookie($name, '', time() - 3600, $config['path'], $config['domain']);
            unset($_COOKIE[$name]);
            // 删除指定cookie
        } else {
            // 设置cookie
            $value = json_encode($value);
            $expire = !empty($config['expire']) ? time() + intval($config['expire']) : 0;
            setcookie($name, $value, $expire, $config['path'], $config['domain']);
            $_COOKIE[$name] = $value;
        }
    }
}

/**
 *  生成一个用户自定义时区日期的GMT时间戳
 *
 * @access  public
 * @param   int     $hour
 * @param   int     $minute
 * @param   int     $second
 * @param   int     $month
 * @param   int     $day
 * @param   int     $year
 *
 * @return void
 */
function local_mktime($hour = NULL , $minute= NULL, $second = NULL,  $month = NULL,  $day = NULL,  $year = NULL)
{
    $timezone = isset($_SESSION['timezone']) ? $_SESSION['timezone'] : TIME_ZONE;

    /**
    * $time = mktime($hour, $minute, $second, $month, $day, $year) - date('Z') + (date('Z') - $timezone * 3600)
    * 先用mktime生成时间戳，再减去date('Z')转换为GMT时间，然后修正为用户自定义时间。以下是化简后结果
    **/
    $time = mktime($hour, $minute, $second, $month, $day, $year) - $timezone * 3600;

    return $time;
}

/**
 * 截取UTF-8编码下字符串的函数
 *
 * @param   string      $str        被截取的字符串
 * @param   int         $length     截取的长度
 * @param   bool        $append     是否附加省略号
 *
 * @return  string
 */
function sub_str($str, $length = 0, $append = true)
{
    $str = trim($str);
    $strlength = strlen($str);

    if ($length == 0 || $length >= $strlength)
    {
        return $str;
    }
    elseif ($length < 0)
    {
        $length = $strlength + $length;
        if ($length < 0)
        {
            $length = $strlength;
        }
    }

    if (function_exists('mb_substr'))
    {
        $newstr = mb_substr($str, 0, $length, C('CHARSET'));
    }
    elseif (function_exists('iconv_substr'))
    {
        $newstr = iconv_substr($str, 0, $length, C('CHARSET'));
    }
    else
    {
        //$newstr = trim_right(substr($str, 0, $length));
        $newstr = substr($str, 0, $length);
    }

    if ($append && $str != $newstr)
    {
        $newstr .= '...';
    }

    return $newstr;
}