<?php
//测试控制器类
class CommonControl extends Control{
    //构造函数
	public function __construct() {
	   //如果session里面有uid 就认为是is_login
		defined("IS_LOGIN")				or define("IS_LOGIN", isset($_SESSION['uid']));
        //是不是超级管理员
		defined('WEB_MASTER'	)		or define('WEB_MASTER',IS_LOGIN && strtolower(C("WEB_MASTER")) == strtolower($_SESSION['username']));
        //管理组
		defined("IN_ADMIN") 			or define("IN_ADMIN",WEB_MASTER || (isset($_SESSION['admin']) && $_SESSION['admin'] == 1));
		//user_state 1 正常 0 锁定
        defined('USER_STATE')			or define('USER_STATE',IS_LOGIN && $_SESSION['user_state']==1);
        //是否锁定
		defined("IS_LOCK")					or define("IS_LOCK", IS_LOGIN && ($_SESSION['lock_end_time']>time()));
		defined("ROOT_URL") 			or define('ROOT_URL',__ROOT__);
		defined("WEB_URL") 				or define('WEB_URL',__WEB__);
		defined("CONTROL_URL") 	or define('CONTROL_URL',__CONTROL__);
        $showLan=getBrowserLang();
        C('language',APP.DS.CONTROL.DS.$showLan);
        
        if (isset($_SERVER['PHP_SELF']))
        {
            define('PHP_SELF', __URL__);
        }
        else
        {
            define('PHP_SELF', __URL__);
        }
        
		parent::__construct();
	}
    
    /**
	 * 成功
	 * @param string $msg 提示内容
	 * @param string $url 跳转URL
	 * @param int $time 跳转时间
	 * @param null $tpl 模板文件
	 */
	protected function success($msg = '操作成功', $url = NULL, $time = 2, $tpl = null) {
		if (IS_AJAX) {
			$this -> _ajax(1, $msg);
		} else {
			parent::success($msg, $url, $time, $tpl);
		}
	}
    
    /**
	 * 错误输出
	 * @param string $msg 提示内容
	 * @param string $url 跳转URL
	 * @param int $time 跳转时间
	 * @param null $tpl 模板文件
	 */
	protected function error($msg = 'エラー', $url = NULL, $time = 2, $tpl = null) {
		if (IS_AJAX) {
			$this -> _ajax(0, $msg);
		} else {
			parent::error($msg, $url, $time, $tpl);
		}
	}
    
    
    /**
	 * Ajax异步
	 * @param $state
	 * @param $message
	 * @param $data
	 */
	protected function _ajax($state, $message, $data = array()) {
		$this -> ajax(array('state' => $state, 'message' => $message, 'data' => $data));
	}
}
?>