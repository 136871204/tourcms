<?php
//.-----------------------------------------------------------------------------------
// |  Software: [ZHPHP framework]
// |   Version: 2014.06
// |-----------------------------------------------------------------------------------
// |    Author: 周鸿 <136871204@qq.com>
// | Copyright (c) 2014, 周鸿 <136871204@qq.com>.All Rights Reserved.
// |-----------------------------------------------------------------------------------
/**
 * URL处理类
 * @package     Core
 * @author      周鸿 <136871204@qq.com>
 */
final class Route
{
    /**
     * 根据不同url处理方式，得到Url参数
     */
    static private function formatUrl(){
        //请求内容
        //'URL_TYPE'                      => 1,           //类型 1:PATHINFO模式 2:普通模式 3:兼容模式
        //'PATHINFO_VAR'                  => 'q',         //兼容模式get变量
        //URL类型是兼容模式 && $_GET里面有q参数的话
        if(C('URL_TYPE') == 3 && isset($_GET[C("PATHINFO_VAR")])){
            //URL的query是$_GET['q']
            $query = $_GET[C("PATHINFO_VAR")];
        }else if(C('URL_TYPE') == 1 && isset($_SERVER['PATH_INFO'])){
            //URL类型是PATHINFO模式 && $_SERVER['PATH_INFO']有设置的话
            $query = $_SERVER['PATH_INFO'];
        }else if(isset($_SERVER['PATH_INFO'])){
            // $_SERVER['PATH_INFO']有设置的话
            //echo 'aaa';
            $query = $_SERVER['PATH_INFO'];
        }else{
            //其他情况直接赋值QUERY_STRING
        	$query = $_SERVER['QUERY_STRING'];
        }
        
        /*if(empty($query)){
            $query=$_SERVER['QUERY_STRING'];
        }*/
        
        //p($_SERVER);
        //p($query);
        //分析路由 && 清除伪静态后缀
        //str_ireplace(find,replace,string,count) 函数使用一个字符串替换字符串中的另一些字符。
        //trim(string,charlist)函数从字符串的两端删除空白字符和其他预定义字符。
        $url = self::parseRoute(str_ireplace(C('PATHINFO_HTML'), '', trim($query, '/')));
        
        //拆分后的GET变量
        $gets = '';
        //URL类型是PATHINFO模式  或者 （URL类型是兼容模式 && $_GET['q']设置的话）
        if (C('URL_TYPE') == 1 || (C('URL_TYPE') == 3 && isset($_GET[C("PATHINFO_VAR")]))) {
            //'PATHINFO_DLI'                  => '/',         //URL分隔符 URL_TYPE为1、3时起效
            //把@=替换成/
            $url = str_replace(array('&', '='), C("PATHINFO_DLI"), $url);
        }else {//否则
            //解析URL
            //parse_str(string,array)函数把查询字符串解析到变量中。
            //parse_str("id=23&name=John%20Adams");例子
            parse_str($url, $gets);
            $_GET = array_merge($_GET, $gets);
        }
        //p($url);
        //如果有gets值的话  || $url是空的话
        if($gets || empty($url)){
            //返回空数组，主要是使用普通url，参数在$_GET中有了
            return array();
        }else{
            //分割$url的Pathinfo 变成数组返回
            return explode(C("PATHINFO_DLI"), $url);
        }
    }
    
    /**
     * 分析路由
     * @param string $query
     * @return mixed
     */
    static private function parseRoute($query){
        //'route' => array(),                             //路由规则
        //路由规则取得
        $route = C("ROUTE");
       // p($route);
        if (!$route or !is_array($route)){
            return $query;  
        } 
        
        //p($route);die;
        foreach ($route as $k => $v) {
            
            //正则路由
            if (preg_match("@^/.*/[isUx]*$@i", $k)) {
                //p($k);
                //p($query);
                //如果匹配URL地址
                if (preg_match($k, $query)) {
                    ;    
                    //echo __FILE__.'---'.__CLASS__.'---'.__METHOD__;
                    //元子组替换
                    $v = str_replace('#', '\\', $v);
                    /*p($k);
                    p($v);
                    p($query);*/
                    //匹配当前正则路由,url按正则替换
                    return preg_replace($k, $v, $query);
                }
                
                //下一个路由规则
                continue;
            }
            
            //非正则路由
            $search = array(
                '@(:year)@i',
                '@(:month)@i',
                '@(:day)@i',
                '@(:num)@i',
                '@(:any)@i',
                '@(:[a-z0-9]+\\\d)@i',
                '@(:[a-z0-9]+\\\w)@i',
                '@(:[a-z0-9]+)@i'
            );
            $replace = array(
                '\d{4}',
                '\d{1,2}',
                '\d{1,2}',
                '\d+',
                '.+',
                '\d+',
                '\w+',
                '([a-z0-9]+)'
            );
            //将:year等替换
            $base_preg = "@^" . preg_replace($search, $replace, $k) . "$@i";
             //不满足路由规则
            if (!preg_match($base_preg, $query)) {
                
                continue;
            }
            echo __FILE__.'---'.__CLASS__.'---'.__METHOD__;
        }
            
    }
    
    /**
     * 解析应用组获得应用
     * @access public
     */
    static public function group(){
        //根据不同url处理方式，得到Url参数
        $args = self::formatUrl();
         //应用组'VAR_GROUP'=> 'g',//应用组变量
        $g = C('VAR_GROUP');
        //$_GET里面已经设置了g的话
        if(isset($_GET[$g])){
            //什么都不做
        }else if($index = array_search($g,$args)){
            //比如PathInfo中 有 /index/g/for 有g存在的话
            //则设置$_GET['g']=for g/的后面一项
            $_GET[$g]=$args[$index+1];
        }
        //应用名
        //'VAR_APP' => 'a',//应用变量名，应用组模式有效
        $a = C("VAR_APP");
        //$_GET里面已经设置了a的话
        if (isset($_GET[$a])) {
            //什么都不做
        }elseif (isset($args[0])) {
            //如果PathInfo来传值 比如index/news/id
            //如果第一个参数==C("VAR_APP")
            if ($args[0] == $a) {
                //就设置 $_GET['a']应用名是 a后面的值
                $_GET[$a] = $args[1];
            } else {
                //其他情况设置path的第一值作为应用名
                $_GET[$a] = $args[0];
            }
        }else {
            //其他情况设置默认应用名
            //'DEFAULT_APP'=> 'index', //默认项目
            $_GET[$a] = C("DEFAULT_APP");
        }
    }
    
    /**
     * 解析应用
     */
    static public function app(){
        $args = self::formatUrl();
        
        //应用组模式时删除应用名变量
        if (IS_GROUP && !empty($args)) {
            //如果第一个参数==应用变量名，应用组模式有效
            //说明是 a/index形式 ，下面数组移除2个
            if ($args[0] == C("VAR_APP")) {
                //array_shift() 函数删除数组中的第一个元素，并返回被删除元素的值。
                array_shift($args);
                array_shift($args);
            } else {
                array_shift($args);
            }
        }
        //控制器，如果$_GET里面已经设置好了控制器
        if (isset($_GET[C("VAR_CONTROL")])) {
            //什么都不做
        }elseif (isset($args[0]) && !empty($args[0])) {//如果控制器暂位参数有设定值的话
            //'VAR_CONTROL'  => 'c', //模块变量
            //如果是模块变量的话，说明url是 c/222形式
            if ($args[0] == C("VAR_CONTROL")) {
                //给$_GET[c]==赋值控制器参数
                $_GET[C("VAR_CONTROL")] = $args[1];
                //移除控制器相关参数
                array_shift($args);
                array_shift($args);
            } else {
                //其他情况就默认，下一个参数是控制器名
                $_GET[C("VAR_CONTROL")] = $args[0];
                array_shift($args);
            }
        }else {
            //其他情况 就默认是配置里面的 默认模块
            //'DEFAULT_CONTROL'  => 'Index', //默认模块
            $_GET[C('VAR_CONTROL')] = C('DEFAULT_CONTROL');
        }
        
        //方法，处理方式和控制器一样
        if (isset($_GET[C("VAR_METHOD")])) {
        } elseif (isset($args[0]) && !empty($args[0])) {
            if ($args[0] == C("VAR_METHOD")) {
                $_GET[C("VAR_METHOD")] = $args[1];
                array_shift($args);
                array_shift($args);
            } else {
                $_GET[C("VAR_METHOD")] = $args[0];
                array_shift($args);
            }
        } else {
            $_GET[C('VAR_METHOD')] = C('DEFAULT_METHOD');
        }
        //以下划线分隔的模块名称改为pascal命名如zhphp_user=>ZHPhpUser
        //ucwords() 函数把字符串中每个单词的首字符转换为大写。
        $_GET[C('VAR_CONTROL')] = ucwords(@preg_replace('@_([a-z]?)@ei', 'strtoupper("\1")', $_GET[C('VAR_CONTROL')]));
        //获得$_GET数据
        //如果 $args还有数据的话
        if (!empty($args)) {
            //循环下面数据 来取得的GET数据
            $count = count($args);
            for ($i = 0; $i < $count;) {
                $_GET[$args [$i]] = isset($args [$i + 1]) ? $args [$i + 1] : '';
                $i += 2;
            }
        }
         //兼容模式删除其变量
        if (C('URL_TYPE') == 2) {
            //'PATHINFO_VAR'  => 'q', //兼容模式get变量
            unset($_GET[C('PATHINFO_VAR')]);
        }
        //把$GET和$REQUEST合并
        $_REQUEST=array_merge($_REQUEST,$_GET);
        //设置常量
        self::setConst();
    }
    
    /**
     * 设置常量
     */
    static private function setConst(){
        //域名
        $host = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        //'HTTPS'   => FALSE,   //基于https协议
        //前面加入协议头
        defined('__HOST__') or define("__HOST__", C("HTTPS") ? "https://" : "http://" .$host);
        //网站根-不含入口文件
        ///zhphp/index.php
        $script_file = rtrim($_SERVER['SCRIPT_NAME'],'/');
        //只得到文件目录 ，/zhphp
        $root = rtrim(dirname($script_file),'/');
        //例子：http://localhost:8099/zhphp
        defined('__ROOT__') or define("__ROOT__", __HOST__ . ($root=='/' || $root=='\\'?'':$root));
        //网站根-含入口文件
        defined('__WEB__') or define("__WEB__", __HOST__ . $_SERVER['SCRIPT_NAME']);
        //完整URL地址
        defined('__URL__') or define("__URL__", __HOST__ . '/' . trim($_SERVER['REQUEST_URI'],'/'));
        //框架目录相关URL
        defined('__ZHPHP__') or define("__ZHPHP__", __HOST__ . '/' . trim(str_ireplace(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), "", ZHPHP_PATH), '/'));
        defined('__ZHPHP_DATA__') or define("__ZHPHP_DATA__", __ZHPHP__ . '/Data');
        defined('__ZHPHP_TPL__') or define("__ZHPHP_TPL__", __ZHPHP__ . '/Lib/Tpl');
        defined('__ZHPHP_EXTEND__') or define("__ZHPHP_EXTEND__", __ZHPHP__ . '/Extend');
        //控制器
        defined('CONTROL') or define("CONTROL", ucwords($_GET[C('VAR_CONTROL')]));
        //方法
        defined('METHOD') or define("METHOD", $_GET[C('VAR_METHOD')]);
        // URL类型    1:pathinfo  2:普通模式  3:兼容模式
        switch (C("URL_TYPE")) {
            //普通模式
            case 2:
                defined('__APP__') or define("__APP__", __WEB__ . (IS_GROUP ? '?' . C('VAR_APP') . '=' . APP : ''));
                defined('__CONTROL__') or define("__CONTROL__", __APP__ . (IS_GROUP ? '&' . C('VAR_CONTROL') . '=' . CONTROL : '?c=' . CONTROL));
                defined('__METH__') or define("__METH__", __CONTROL__ . '&' . C('VAR_METHOD') . '=' . METHOD);
                break;
            //兼容模式
            case 3:
                defined('__APP__') or define("__APP__", __WEB__ . '?' . C("PATHINFO_VAR") . '=' . (IS_GROUP ? '/' . APP : ''));
                defined('__CONTROL__') or define("__CONTROL__", __APP__ . '/' . CONTROL);
                defined('__METH__') or define("__METH__", __CONTROL__ . '/' . METHOD);
                break;
            //pathinfo|rewrite
            case 1:
            default:
                defined('__APP__') or define("__APP__", __WEB__ . (IS_GROUP ? '/' . APP : ''));
                defined('__CONTROL__') or define("__CONTROL__", __APP__ . '/' . CONTROL);
                defined('__METH__') or define("__METH__", __CONTROL__ . '/' . METHOD);
                break;
        }
        if (defined("GROUP_PATH"))
            defined("__GROUP__") or define("__GROUP__", __ROOT__ . '/'.rtrim(GROUP_PATH,'/'));
        //网站根-Static目录
        defined("__TPL__") or define("__TPL__", __ROOT__  . '/'.rtrim(TPL_PATH,'/'));
        defined("__CONTROL_TPL__") or define("__CONTROL_TPL__", __TPL__  .'/'. CONTROL);
        defined("__STATIC__") or define("__STATIC__", __ROOT__ . '/Static');
        defined("__PUBLIC__") or define("__PUBLIC__", __TPL__ . '/Public');
        //历史页码
        $history= isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:null;
        define("__HISTORY__",$history);
    }
    
    /**
     * 将URL按路由规则进行处理
     * U()函数等使用
     * @access public
     * @param  string $url url字符串不含__WEB__.'?|/'
     * @return string
     */
    static public function toUrl($url){
        //a=Member&c=Space&m=index&u=zhcms4
        $route = C("route");
        //未定义路由规则
        if (!$route) {
            return $url;
        }
        foreach ($route as $routeKey => $routeVal) {
            //$config['ROUTE']['/^([0-9a-z]+)$/']	=	'a=Member&c=Space&m=index&u=#1';//个人主页
            $routeKey = trim($routeKey);
            //正则路由
            if (substr($routeKey, 0, 1) === '/') {
                $regGroup = array(); //识别正则路由中的原子组
                preg_match_all("@\(.*?\)@i", $routeKey, $regGroup, PREG_PATTERN_ORDER);
                //路由规则Value
                $searchRegExp = $routeVal;
                //将正则路由的Value中的值#1换成(\d+)等形式
                for ($i = 0, $total = count($regGroup[0]); $i < $total; $i++) {
                    $searchRegExp = str_replace('#' . ($i + 1), $regGroup[0][$i], $searchRegExp);
                }
                //URL参数
                $urlArgs = array();
                //当前URL是否满足本次路由规则，如果满意获得url参数（原子组）
                preg_match_all("@^" . $searchRegExp . "$@i", $url, $urlArgs, PREG_SET_ORDER);
                //满足路由规则
                if ($urlArgs) {
                    //清除路由中的/$与/正则边界
                    $routeUrl = trim(preg_replace(array('@/\^@', '@/[isUx]$@','@\$@'), array('','',''), $routeKey), '/');
                    /**
                     * 将路由规则中的(\d+)等形式替换为url中的具体值
                     * /admin(\d).html/   => admin1.html
                     */
                    foreach ($regGroup[0] as $k => $v) {
                        $v = preg_replace('@([\*\$\(\)\+\?\[\]\{\}\\\])@', '\\\$1', $v);
                        $routeUrl = preg_replace('@' . $v . '@', $urlArgs[0][$k + 1], $routeUrl, $count = 1);
                    }

                    return trim($routeUrl, '/');
                }
            }else{
                //获得如 "info/:city_:row" 中的:city与:row
                $routeGetVars = array();
                //普通路由处理
                preg_match_all('/:([a-z]*)/i', $routeKey, $routeGetVars, PREG_PATTERN_ORDER); //获得路由规则中以:开始的变量
                $getRouteUrl = $routeVal;
                switch (C("URL_TYPE")) {
                    case 1:
                        $getRouteUrl .= '/';
                        foreach ($routeGetVars[1] as $getK => $getV) {
                            $getRouteUrl .= $getV . '/(.*)/';
                        }
                        $getRouteUrl = '@' . trim($getRouteUrl, '/') . '@i';
                        break;
                    case 2:
                        $getRouteUrl .= '&';
                        foreach ($routeGetVars[1] as $getK => $getV) {
                            $getRouteUrl .= $getV . '=(.*)' . '&';
                        }
                        $getRouteUrl = '@' . trim($getRouteUrl, '&') . '@i';
                        break;
                }
                $getArgs = array();
                preg_match_all($getRouteUrl, $url, $getArgs, PREG_SET_ORDER);
                if ($getArgs) {
                    //去除路由中的传参数如:uid
                    $newUrl = $routeKey;
                    foreach ($routeGetVars[0] as $rk => $getName) {
                        $newUrl = str_replace($getName, $getArgs[0][$rk + 1], $newUrl);
                    }
                    return $newUrl;
                }
            }
           
        }
       return $url;
    }
}
