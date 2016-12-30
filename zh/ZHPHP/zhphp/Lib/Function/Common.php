<?php

/**
 * 根据配置文件的URL参数重新生成URL地址
 * @param String $pathinfo 访问url
 * @param array $args GET参数
 * <code>
 * $args = "nid=2&cid=1"
 * $args=array("nid"=>2,"cid"=>1)
 * </code>
 * @return string
 */
function U($pathinfo, $args = array()){
    //U('Member/Space/index',array('u'=>\$field['domain']));
    //复制给旧的url
    $_old_url =$pathinfo;
    //吧pathinfo前面的__WEB__  __ROOT__部分去除
	$pathinfo=str_ireplace(array(__WEB__,__ROOT__),'',$pathinfo);
    //如果匹配到https:// 或者 pathinfo是空的话，直接传入没有处理过的url
    if (preg_match("/^https?:\/\//i", $pathinfo) || empty($pathinfo))
        return $_old_url;
    //是否指定单入口
    $end = strpos($pathinfo, '.php');
    if ($end) {
        //如果有传入单路口就，吧单路口 比如index.php 部分和后面pathinfo部分分离
        //然后设置$web
        $web = __ROOT__ . '/' . trim(substr($pathinfo, 0, $end + 4),'/');
        $pathinfo = trim(substr($pathinfo, $end + 4),'/');
    } else {
        $web = __WEB__;
    }
    //参数$args为字符串时转数组
    if (is_string($args)) {
        parse_str($args, $args);
    }
    //$url = "http://www.electrictoolbox.com/php-extract-domain-from-full-url/";
    //$parts = parse_url($url); 
    /*
    Array
    (
    [scheme] => http
    [host] => www.electrictoolbox.com
    [path] => /php-extract-domain-from-full-url/
    ) 
    */
        
    $parseUrl = parse_url(trim($pathinfo, '/'));
        
    //如果分离出来没有path属性 返回出入url
    if(!isset($parseUrl['path']))return $_old_url;
    $path = trim($parseUrl['path'], '/');
    //解析字符串的?后参数 并与$args合并
    if (isset($parseUrl['query'])) {
        parse_str($parseUrl['query'], $query);
        $args = array_merge($query, $args);
    }
    //组合出索引数组  将?后参数与$args传参
    $gets = array();
    if (is_array($args)) {
        foreach ($args as $n => $q) {
            array_push($gets, $n);
            array_push($gets, $q);
        }
    }
    $vars = explode("/", $path);
    //入口文件类型
    $urlType = C("URL_TYPE"); //1 pathinfo 2 get
    switch ($urlType) {
        case 1:
            $root = $web . '/'; //入口位置
            break;
        case 2:
        default:
            $root = $web . '?';
            break;
    }
     //是否定义应用组
    $set_app_group = false;
    if (defined("GROUP_PATH")) {
        $set_app_group = true;
    }
    //组合出__WEB__后内容
    $data = array();
    switch (count($vars)) {
        case 2: //应用
            if ($set_app_group) {
                $data[] = C("VAR_APP");
                $data[] = APP;
            }
            $data[] = C("VAR_CONTROL");
            $data[] = array_shift($vars);
            $data[] = C("VAR_METHOD");
            $data[] = array_shift($vars);
            break;
        case 1: //方法
            if ($set_app_group) {
                $data[] = C("VAR_APP");
                $data[] = APP;
            }
            $data[] = C("VAR_CONTROL");
            $data[] = CONTROL;
            $data[] = C("VAR_METHOD");
            $data[] = array_shift($vars);
            break;
        default: //应用组及其他情况
            $data[] = C("VAR_APP");
            $data[] = array_shift($vars);
            $data[] = C("VAR_CONTROL");
            $data[] = array_shift($vars);
            $data[] = C("VAR_METHOD");
            $data[] = array_shift($vars);
            if (is_array($vars)) {
                foreach ($vars as $v) {
                    $data[] = $v;
                }
            }
    }
    //合并GET参数
    $varsAll = array_merge($data, $gets);
    $url = '';
    switch ($urlType) {
        case 1:
            foreach ($varsAll as $value) {
                $url .= C('PATHINFO_Dli') . $value;
            }
            $url = str_replace(array("/" . C("VAR_APP") . "/", "/" . C("VAR_CONTROL") . "/", "/" . C("VAR_METHOD") . "/"), "/", $url);
            $url = substr($url, 1);
            break;
        case 2:
        default:
            foreach ($varsAll as $k => $value) {
                if ($k % 2) {
                    $url .= '=' . $value;
                } else {
                    $url .= '&' . $value;
                }
            }
            $url = substr($url, 1);
            break;
    }
    $pathinfo_html = $urlType == 1 ? C("PATHINFO_HTML") : ''; //伪表态后缀如.html
    if (C("URL_REWRITE")) {
        $root = preg_replace('/\w+?\.php(\/|\?)?/i', '', $root);
    }
    //echo $url."<br/>";//die;
    return $root . Route::toUrl($url) . $pathinfo_html;
}


/**
 * 别名导入
 * @param string | array $name 别名
 * @param string $path 路径
 * @return bool
 */
function alias_import($name = null, $path = null)
{
    //require(ZHPHP_CORE_PATH . 'Alias.php')
    //函数内部静态变量声明
    static $_alias = array();
    //如果传入name是空 返回原来的全局别名数据
    if (is_null($name)){
        return $_alias;
    } 
    //传入name是字符串的话，把name转换小写
    if (is_string($name)){
        $name = strtolower($name);
    }
    
    if (is_array($name)) {//传入name是数组的话
        //array_change_key_case() 函数将数组的所有的 KEY 都转换为大写或小写。
        //传入数组数据和原来全局别名数据合并
        $_alias = array_merge($_alias, array_change_key_case($name));
        return true;
    } elseif (!is_null($path)) {//如果传入别名路径不是空的话
        //把传入的数据添加到别名数据中，返回给调用者
        return $_alias[$name] = $path;
    } elseif (isset($_alias[$name])) {
        //如果已经设置了别名，加载别名文件并缓存
        return require_cache($_alias[$name]);
    }
    return false;
}

/**
 * 加载文件并缓存
 * @param null $path 导入的文件
 * @return bool
 */
function require_cache($path = null)
{
    //全局文件列表缓存
    static $_files = array();
    //如果传入path是空。返回文件列表
    if (is_null($path)) return $_files;
    //缓存中存在  即代表文件已经加载  停止加载
    if (isset($_files[$path])) {
        return true;
    }
    //区分大小写的文件判断
    if (!file_exists_case($path)) {
        //没有文件不操作，返回false
        return false;
    }
    //引入文件
    require($path);
    //把这个引入过的文件加入全局变量，缓存
    $_files[$path] = true;
    return true;
}


/**
 * 区分大小写的判断文件判断
 * @param string $file 需要判断的文件
 * @return boolean
 */
function file_exists_case($file)
{
    //如果传入是个文件的话
    if (is_file($file)) {
        //windows环境下检测文件大小写，CHECK_FILE_CASE配置环境可以设置
        if (IS_WIN && C("CHECK_FILE_CASE")) {
            //realpath() 函数返回绝对路径。
            if (basename(realpath($file)) != basename($file)) {
                return false;
            }
        }
        return true;
    }
    return false;
}

/**
 * 将数组键名变成大写或小写
 * @param array $arr 数组
 * @param int $type 转换方式 1大写   0小写
 * @return array
 */
function array_change_key_case_d($arr, $type = 0)
{
    //根据传入type，设置转换方式，默认小写
    $function = $type ? 'strtoupper' : 'strtolower';
    $newArr = array(); //格式化后的数组
    //如果传入arr不是数组 || 是空值的话
    if (!is_array($arr) || empty($arr)){
        //返回 空数组
        return $newArr;
    }
    //循环传入数组
    foreach ($arr as $k => $v) {
        //对数据转换
        $k = $function($k);
        //如果数据还是数组的话
        if (is_array($v)) {
            //递归执行将数组键名变成大写或小写
            $newArr[$k] = array_change_key_case_d($v, $type);
        } else {
            //设置转换后数据
            $newArr[$k] = $v;
        }
    }
    //返回转换好的数据
    return $newArr;
}

/**
 * 导入文件数组
 */
function require_array($fileArr)
{
    //循环文件数组
    foreach ($fileArr as $file) {
        //如果文件存在就 && 加载文件放入缓存
        if (is_file($file) && require_cache($file)) 
            return true;
    }
    return false;
}

/**
 * trace记录
 * @param string $value 错误信息
 * @param string $level
 * @param bool $record
 * @return mixed
 */
function trace($value = '[ZHPHP]', $level = 'DEBUG', $record = false)
{
    //trace记录缓存
    static $_trace = array();
    //如果没有穿trace的话，就返回缓存的trace
    if ('[ZHPHP]' === $value) { // 获取trace信息
        return $_trace;
    } else {//其他情况
        //print_r() 显示关于一个变量的易于理解的信息。
        $info = ' : ' . print_r($value, true);
        //调试模式时处理ERROR类型
        if (DEBUG && 'ERROR' == $level) {
            throw_exception($info);
        }
        //如果缓存里面没有设置过
        if (!isset($_trace[$level])) {
            //在缓存里面添加这个trace
            $_trace[$level] = array();
        }
        //在缓存里面添加这个trace
        $_trace[$level][] = $info;
        
        if (IS_AJAX || $record) {
            Log::record($info, $level, $record);
        }
    }
}

/**
 * 返回错误类型
 * @param int $type
 * @return strings
 */
function FriendlyErrorType($type)
{
    switch ($type) {
        case E_ERROR: // 1 //
            return 'E_ERROR';
        case E_WARNING: // 2 //
            return 'E_WARNING';
        case E_PARSE: // 4 //
            return 'E_PARSE';
        case E_NOTICE: // 8 //
            return 'E_NOTICE';
        case E_CORE_ERROR: // 16 //
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: // 32 //
            return 'E_CORE_WARNING';
        case E_CORE_ERROR: // 64 //
            return 'E_COMPILE_ERROR';
        case E_CORE_WARNING: // 128 //
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: // 256 //
            return 'E_USER_ERROR';
        case E_USER_WARNING: // 512 //
            return 'E_USER_WARNING';
        case E_USER_NOTICE: // 1024 //
            return 'E_USER_NOTICE';
        case E_STRICT: // 2048 //
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: // 4096 //
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: // 8192 //
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: // 16384 //
            return 'E_USER_DEPRECATED';
    }
    return $type;
}

/**
 * 递归创建目录
 * @param string $dirName 目录
 * @param int $auth 权限
 * @return bool
 */
function dir_create($dirName, $auth = 0755)
{
    $dirName = str_replace("\\", "/", $dirName);
    $dirPath = rtrim($dirName, '/');
    if (is_dir($dirPath))
        return true;
    $dirs = explode('/', $dirPath);
    $dir = '';
    foreach ($dirs as $v) {
        $dir .= $v . '/';
        is_dir($dir) or @mkdir($dir, $auth, true);
    }
    return is_dir($dirPath);
}

/**
 * 错误中断
 * @param string | array $error 错误内容
 */
function halt($error){
    $e = array();
    //如果是debug模式
    if (DEBUG) {
        //$error不是数组
        if (!is_array($error)) {
            //PHP debug_backtrace() 函数生成一个 backtrace。
            //该函数返回一个关联数组。下面是可能返回的元素：
            $trace = debug_backtrace();
            $e['message'] = $error;
            $e['file'] = $trace[0]['file'];
            $e['line'] = $trace[0]['line'];
            $e['class'] = isset($trace[0]['class']) ? $trace[0]['class'] : "";
            $e['function'] = isset($trace[0]['function']) ? $trace[0]['function'] : "";
            ob_start();
            //debug_print_backtrace() 函数输出 backtrace。
            debug_print_backtrace();
            //ob_get_clean — 得到当前缓冲区的内容并删除当前输出缓。
            $e['trace'] = htmlspecialchars(ob_get_clean());
        } else {
            //如果是数组，说明已经设置过了
            $e = $error;
        }
    }else {
        //错误显示url
        //'ERROR_URL'   => '',//错误跳转URL
        if ($_url = C('ERROR_URL')) {//如果有配置过跳转的URL，就跳转到这个url
            go($_url);
        } else {
            //'ERROR_MESSAGE'   => '网站出错了，请稍候再试...', //关闭DEBUG显示的错误信息
            $e['message'] = C('ERROR_MESSAGE');
        }
    }
    //显示DEBUG模板，开启DEBUG显示trace
    require ZHPHP_TPL_PATH . 'halt.html';
    exit;
}

/**
 * 404错误
 * @param string $msg 提示信息
 * @param string $url 跳转url
 */
function _404($msg = "", $url = "")
{
    //如果是debug模式 就输出错误
    DEBUG && halt($msg);
    //写入日志
    Log::write($msg);
    //如果没有传入跳转url && 配置文件有设定404_URL
    //'404_URL' => '',    //404跳转url
    if (empty($url) or C("404_URL")) {
        //跳转页面设定成配置文件中的404画面
        $url = C("404_URL");
    }
    //$url有值的话跳转到url
    if ($url)
        go($url);
    else//HTTP状态信息设置
        set_http_state(404);
    exit;
}

/**
 * 错误中断
 * @param $error 错误内容
 */
function error($error)
{
    halt($error);
}


/**
 * 去空格，去除注释包括单行及多行注释
 * @param string $content 数据
 * @return string
 */
function compress($content){
    $str = ""; //合并后的字符串
    //token_get_all() parses the given source string into PHP language tokens using the Zend engine's lexical scanner.
    /*
    $tokens = token_get_all('<?php echo; ?>');  => array(
                                                  array(T_OPEN_TAG, '<?php'),
                                                  array(T_ECHO, 'echo'),
                                                  ';',
                                                  array(T_CLOSE_TAG, '?>') );
    */
    $data = token_get_all($content);
    $end = false; //没结束如$v = "zhphp"中的等号;
    for ($i = 0, $count = count($data); $i < $count; $i++) {
        if (is_string($data[$i])) {
            $end = false;
            $str .= $data[$i];
        } else {
            switch ($data[$i][0]) { //检测类型
                //忽略单行多行注释
                case T_COMMENT:
                case T_DOC_COMMENT:
                    break;
                //去除格
                case T_WHITESPACE:
                    if (!$end) {
                        $end = true;
                        $str .= " ";
                    }
                    break;
                //定界符开始
                case T_START_HEREDOC:
                    $str .= "<<<HDPHP\n";
                    break;
                //定界符结束
                case T_END_HEREDOC:
                    $str .= "HDPHP;\n";
                    //类似str;分号前换行情况
                    for ($m = $i + 1; $m < $count; $m++) {
                        if (is_string($data[$m]) && $data[$m] == ';') {
                            $i = $m;
                            break;
                        }
                        if ($data[$m] == T_CLOSE_TAG) {
                            break;
                        }
                    }
                    break;

                default:
                    $end = false;
                    $str .= $data[$i][1];
            }
        }
    }
    return $str;
}

/**
 * 生成序列字符串
 * @param $var
 * @return string
 */
function md5_d($var)
{
    return md5(serialize($var));
}

/**
 * 将错误记录到日志
 * @param $error 错误信息
 */
function log_write($error)
{
    $trace = debug_backtrace();
    $e['message'] = $error;
    $e['file'] = $trace[0]['file'];
    $e['line'] = $trace[0]['line'];
    $e['class'] = isset($trace[0]['class']) ? $trace[0]['class'] : "";
    $e['function'] = isset($trace[0]['function']) ? $trace[0]['function'] : "";
    $msg = ("[Error]" . $e['message'] . " [Time]" . date("y-m-d h:i") . " [File]" . $e['file'] . " [Line]" . $e['line']);
    //写入日志
    Log::write($msg);
}

/**
 * 抛出异常
 * @param string $msg 错误信息
 * @param string $type 异常类
 * @param int $code 编码
 * @throws
 */
function throw_exception($msg, $type = "ZhException", $code = 0)
{
    if (class_exists($type, false)) {
        throw new $type($msg, $code, true);
    } else {
        halt($msg);
    }
}

/**
 * 根据大小返回标准单位 KB  MB GB等
 */
function get_size($size, $decimals = 2)
{
    switch (true) {
        case $size >= pow(1024, 3):
            return round($size / pow(1024, 3), $decimals) . " GB";
        case $size >= pow(1024, 2):
            return round($size / pow(1024, 2), $decimals) . " MB";
        case $size >= pow(1024, 1):
            return round($size / pow(1024, 1), $decimals) . " KB";
        default:
            return $size . 'B';
    }
}


/**
 * 调用标签函数
 * @param $tag 标签名
 * @param array $attr 属性
 * @param string $content 内容
 * @return bool
 */
function tag($tag, $attr = array(), $content = "")
{
    //例如：tag("upload", $tag);
    $tag = "_" . $tag;
    //标签库类
    $tagClass = array();
    //加载扩展标签库
    //'TPL_TAGS'  => array(),//扩展标签,多个标签用逗号分隔
    //例如
    /*
    'TPL_TAGS' => array('HtmlTag')// 当前应用Tag 目录下HtmlTag 类
    'TPL_TAGS' => array('Admin.Tag.HtmlTag')// 应用Admin 目录Tag 目录下的
    HtmlTag 类
    */
    $tags = C('TPL_TAGS');
    //如果配置文件中存在标签定义
    if (!empty($tags) && is_array($tags)) {
        //加载其他模块或应用中的标签库
        foreach ($tags as $k) {
            //如果拆分后大于1的为其他模块或应用的标签定义
            $arr = explode('.', $k);
            if (import($k)) {
                //压入标签库类
                //array_pop() 函数删除数组中的最后一个元素。
                $tagClass[] = array_pop($arr);
            }
        }
    }
    //加载框架核心标签库
    $tagClass[] = 'ViewTag';
    foreach ($tagClass as $_class) {
        $obj = new $_class;
        if (method_exists($obj, $tag)) {
            return $obj->$tag($attr, $content);
        }
    }
    return false;
}

/**
 * 验证扩展是否加载
 * @param string $ext
 * @return bool
 */
function extension_exists($ext)
{
    $ext = strtolower($ext);
    $loaded_extensions = get_loaded_extensions();
    return in_array($ext, array_change_value_case($loaded_extensions, 0));
}

/**
 * 将数组中的值全部转为大写或小写
 * @param array $arr
 * @param int $type 类型 1值大写 0值小写
 * @return array
 */
function array_change_value_case($arr, $type = 0)
{
    $function = $type ? 'strtoupper' : 'strtolower';
    $newArr = array(); //格式化后的数组
    foreach ($arr as $k => $v) {
        if (is_array($v)) {
            $newArr[$k] = array_change_value_case($v, $type);
        } else {
            $newArr[$k] = $function($v);
        }
    }

    return $newArr;
}




