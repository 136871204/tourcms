<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
final class ZHPHP{
    /**
     * 初始化应用
     */
    static public function init(){
       // p($_GET);
        //加载应用组配置
        if(IS_GROUP){
            //如果有配置文件，就优先读取这个配置文件
            is_file(COMMON_CONFIG_PATH . 'config.php')             and C(require(COMMON_CONFIG_PATH . 'config.php'));
            //如果有这个事件文件，就优先使用这里的事件配置文件
            is_file(COMMON_CONFIG_PATH . 'event.php')               and C('GROUP_EVENT', require COMMON_CONFIG_PATH . 'event.php');
            //别名文件优先使用group组里的
            is_file(COMMON_CONFIG_PATH . 'alias.php')               and alias_import(COMMON_CONFIG_PATH . 'alias.php');
            //多语言配置文件，优先读取组里面配置的文件
            is_file(COMMON_LANGUAGE_PATH . C('LANGUAGE') . '.php')  and L(require COMMON_LANGUAGE_PATH . C('LANGUAGE') . '.php');
        }
        //解析应用组获得应用（放在$_GET['g']和$_GET['a']）中
        IS_GROUP                                        and Route::group();
        if(!defined('GROUP_NAME') ){//如果没有设置应用组名
            //$_GET['g']有设置的话，  && $_GET['g']不是空的话
            if(isset($_GET[C('VAR_GROUP')]) &&!empty($_GET[C('VAR_GROUP')])){
                //GROUP_NAME常量设置
                define('GROUP_NAME',$_GET[C('VAR_GROUP')]);
            }else{
                //设置默认应用组名'DEFAULT_GROUP' => 'App', //默认应用组
                define('GROUP_NAME',C('DEFAULT_GROUP'));
            }
        }
        if(!defined('APP') ){//如果没有设置应用名
            //ucfirst(string)函数把字符串中的首字符转换为大写。
            if(IS_GROUP){//是分组的话
                //$_GET['a']的值复制给APP
                define('APP',ucfirst($_GET[C('VAR_APP')]));
            }else{
                //不是分组的话
                //substr(string,start,length)函数返回字符串的一部分。
                define('APP',ucfirst(basename(substr(APP_PATH, 0, -1))));
            }
        }
        IS_GROUP                                        and define('APP_PATH', GROUP_PATH . GROUP_NAME . '/' . APP . '/');
        //常量
        defined('CONTROL_PATH')                         or define('CONTROL_PATH', APP_PATH . 'Control/');
        defined('MODEL_PATH')                           or define('MODEL_PATH', APP_PATH . 'Model/');
        defined('CONFIG_PATH')                          or define('CONFIG_PATH', APP_PATH . 'Config/');
        defined('EVENT_PATH')                           or define('EVENT_PATH', APP_PATH . 'Event/');
        defined('LANGUAGE_PATH')                        or define('LANGUAGE_PATH', APP_PATH . 'Language/');
        defined('TAG_PATH')                             or define('TAG_PATH', APP_PATH . 'Tag/');
        defined('LIB_PATH')                             or define('LIB_PATH', APP_PATH . 'Lib/');
        
        defined('COMPILE_PATH')                         or define('COMPILE_PATH', TEMP_PATH . (IS_GROUP ? GROUP_NAME . '/' . APP . '/Compile/' : 'Compile/'));
        defined('CACHE_PATH')                           or define('CACHE_PATH', TEMP_PATH . (IS_GROUP ? GROUP_NAME . '/' . APP . '/Cache/' : 'Cache/'));
        defined('TABLE_PATH')                           or define('TABLE_PATH', TEMP_PATH . (IS_GROUP ? GROUP_NAME . '/' . APP . '/Table/' : 'Table/'));
        defined('LOG_PATH')                             or define('LOG_PATH', TEMP_PATH . 'Log/');
        //应用配置(各自应用的config,event,alias,language)最优先使用配置
        is_file(CONFIG_PATH . 'config.php')             and C(require(CONFIG_PATH . 'config.php'));
        is_file(CONFIG_PATH . 'event.php')              and C('APP_EVENT', require CONFIG_PATH . 'event.php');
        is_file(CONFIG_PATH . 'alias.php')              and alias_import(CONFIG_PATH . 'alias.php');
        is_file(LANGUAGE_PATH . C('LANGUAGE') . '.php') and L(require LANGUAGE_PATH . C('LANGUAGE') . '.php');
        //模板目录
        //'TPL_STYLE'=> '',  //风格
        $tpl_style = C('TPL_STYLE');
        //如果有设置模板风格，并且模板风格最后一个字符不是/的话
        if($tpl_style and substr($tpl_style,-1)!='/'){
            //最后加上 /
            $tpl_style.='/';
        }
        
        //如果没有定义模板目录的话(grouppath/App/Index/Tpl/)
        if(!defined('TPL_PATH')  ){
            //'TPL_PATH'  => '', //模板目录
            //如果配置文件里面设置了【模板目录】
            if(C('TPL_PATH')){
                //设置【模板目录】为【模板目录】.模板风格
                define('TPL_PATH', C('TPL_PATH').$tpl_style);
            }else{
                //没有配置的话,设置【模板目录】=APP_PATH.'Tpl/'.$tpl_style
                define('TPL_PATH', APP_PATH.'Tpl/'.$tpl_style);
            }
        }
        //定义public的path,public里面放模板文件
        defined('PUBLIC_PATH')                          or define('PUBLIC_PATH', TPL_PATH . 'Public/');
        //应用url解析并创建常量
        Route::app();
        //=========================环境配置
        date_default_timezone_set(C('DEFAULT_TIME_ZONE'));
        @ini_set('memory_limit',                        '128M');
        @ini_set('register_globals',                    'off');
        @ini_set('magic_quotes_runtime',                0);
        define('NOW',                                   $_SERVER['REQUEST_TIME']);
        define('NOW_MICROTIME',                         microtime(true));
        define('REQUEST_METHOD',                        $_SERVER['REQUEST_METHOD']);
        define('IS_GET',                                REQUEST_METHOD == 'GET' ? true : false);
        define('IS_POST',                               REQUEST_METHOD == 'POST' ? true : false);
        define('IS_PUT',                                REQUEST_METHOD == 'PUT' ? true : false);
        define('IS_AJAX',                               ajax_request());
        define('IS_DELETE',                             REQUEST_METHOD == 'DELETE' ? true : false);
        //注册自动载入函数
        spl_autoload_register(array(__CLASS__,          'autoload'));
        //set_error_handler() 函数设置用户自定义的错误处理函数。
        set_error_handler(array(__CLASS__,              'error'), E_ALL);
        //set_exception_handler() 函数设置用户自定义的异常处理函数。
        set_exception_handler(array(__CLASS__,          'exception'));
        //register_shutdown_function 的函数,可以让我们设置一个当执行关闭时可以被调用的另一个函数.
        //也就是说当我们的脚本执行完成或意外死掉导致PHP执行即将关闭时,我们的这个函数将会 被调用
        register_shutdown_function(array(__CLASS__,     'fatalError'));  
        ZHPHP::_appAutoLoad();
        //COOKIE安全处理
        if(!empty($_COOKIE)){
            foreach($_COOKIE as $name=>$v){
                $name = preg_replace('@[^0-9a-z]@', '', $name);
                $_COOKIE[$name]=$v;
            }
        }
    }
    
    /**
     * 自动加载应用文件
     */
    static private function _appAutoLoad()
    {
        //'AUTO_LOAD_FILE' => array(), //自动加载应用Lib目录或应用组Common/Lib目录下的文件
        //自动加载文件列表
        $files = C('AUTO_LOAD_FILE');
        //如果有设置 && 是array
        if (is_array($files) && !empty($files)) {
            //循环数组
            foreach ($files as $file) {
                //加载文件
                //优先自己组里面的，然后通用组里面的
                require_array(
                    array(
                        LIB_PATH . $file,
                        COMMON_LIB_PATH . $file
                    )
                ) || require_cache($file);
            }
        }
    }
    
    /**
     * 自动载入函数
     * @param string $className 类名
     * @access private
     * @return void
     */
    static public function autoload($className){
        $class = ucfirst($className) . '.class.php'; //类文件
       if (substr($className, -5) == 'Model') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . 'Model/' . $class,
                MODEL_PATH . $class,
                COMMON_MODEL_PATH . $class
            ))
            ) return;
        } elseif (substr($className, -7) == 'Control') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . $class,
                CONTROL_PATH . $class,
                COMMON_CONTROL_PATH . $class
            ))
            ) return;
        } elseif (substr($className, 0, 2) == 'Db') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . 'Db/' . $class
            ))
            ) return;
        } elseif (substr($className, 0, 5) == 'Cache') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . 'Cache/' . $class,
            ))
            ) return;
        } elseif (substr($className, 0, 4) == 'View') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . 'View/' . $class,
            ))
            ) return;
        } elseif (substr($className, -5) == 'Event') {
            if (require_array(array(
                EVENT_PATH . $class,
                COMMON_EVENT_PATH . $class
            ))
            ) return;
        } elseif (substr($className, -3) == 'Tag') {
            if (require_array(array(
                TAG_PATH . $class,
                COMMON_TAG_PATH . $class
            ))
            ) return;
        } elseif (substr($className, -7) == 'Storage') {
            if (require_array(array(
                ZHPHP_DRIVER_PATH . 'Storage/' . $class
            ))
            ) return;
        } elseif (alias_import($className)) {
            return;
        } elseif (require_array(array(
            LIB_PATH . $class,
            COMMON_LIB_PATH . $class,
            ZHPHP_CORE_PATH . $class,
            ZHPHP_EXTEND_PATH . $class,
            ZHPHP_EXTEND_PATH . '/Tool/' . $class
        ))
        ) {
            return;
        }
        $msg = "Class {$className} not found";
        Log::write($msg);
        halt($msg);
    }
    
    /**
     * 自定义异常理
     * @param $e
     */
    static public function exception($e)
    {
        halt($e->__toString());
    }
    
    //错误处理
    static public function error($errno, $error, $file, $line){
        switch ($errno) {
            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                ob_end_clean();
                $msg = $error. $file . " 第 $line 行.";
                //'LOG_RECORD'   => FALSE,  //记录日志 TODO:log处理以后再看
                if(C('LOG_RECORD')) {
                    Log::write("[$errno] " . $msg, Log::ERROR);
                }
                function_exists('halt') ? halt($msg) : exit('ERROR:' . $msg);
                break;
            case E_STRICT:
            case E_USER_WARNING:
            case E_USER_NOTICE:
            default:
                $errorStr = "[$errno] $error " . $file . " 第 $line 行.";
                trace($errorStr, 'NOTICE');
                //SHUT_NOTICE关闭提示信息
                if (DEBUG && C('SHOW_NOTICE'))
                    require ZHPHP_TPL_PATH . 'notice.html';
                break;
        }
    }
    
    
    
    //致命错误处理
    static public function fatalError()
    {
        if ($e = error_get_last()) {
            self::error($e['type'], $e['message'], $e['file'], $e['line']);
        }
    }
}