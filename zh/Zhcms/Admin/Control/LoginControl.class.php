<?php

/**
 * 登録処理
 * Class LoginControl
 * @author zh <136871204@qq.com>
 */
class LoginControl extends CommonControl{
    
    /**
	 * 登录页面显示验证码
	 * @access public
	 */
	public function code() {
	   //验证码配置
		C(array("CODE_BG_COLOR" => "#ffffff", 
            "CODE_LEN" => 4, 
            "CODE_FONT_SIZE" => 20, 
            "CODE_WIDTH" => 120, 
            "CODE_HEIGHT" => 35, ));
            //验证码取得
		$code = new Code();
		$code -> show();
	}
    
    function login(){
        if (IN_ADMIN) {
            go("Index/index");
            exit ;
        }else if(IS_POST) {
            $Model = K("User");
            $code = Q('post.code', null, 'strtoupper');
            $username = Q('username');
			$password = Q('post.password', null, '');
            if (empty($code) || $code != $_SESSION['code']) {
				$this -> error = L('admin_login_from_check_error1');
				$this -> display();
				exit ;
			}
            if (empty($username)) {
				$this -> error = L('admin_login_from_check_error2');
				$this -> display();
				exit ;
			}
            if (empty($password)) {
				$this -> error = L('admin_login_from_check_error3');
				$this -> display();
				exit ;
			}
            $user = $Model -> where(array('username' => $username)) -> find();
            
            if (!$user) {
				$this -> error = L('admin_login_from_check_error4');
				$this -> display();
				exit ;
			}
            if ($user['password'] !== md5($password . $user['code'])) {
				$this -> error(L('admin_login_from_check_error5'));
				$this -> display();
			}
            setcookie('login', 1, 0, '/');
			unset($user['password']);
			unset($user['code']);
            //是否为超级管理员
			$_SESSION = array_merge($_SESSION, $user);
            if (empty($user['icon'])) {
				$_SESSION['icon'] = __ROOT__ . '/data/image/user/250.png';
			} else {
				$_SESSION['icon'] = __ROOT__ . '/' . $user['icon'];
			}
            $_SESSION['icon250'] = $_SESSION['icon'];
			$_SESSION['icon150'] = str_replace(250, 150, $_SESSION['icon250']);
			$_SESSION['icon100'] = str_replace(250, 100, $_SESSION['icon250']);
			$_SESSION['icon50'] = str_replace(250, 50, $_SESSION['icon250']);
            $Model -> save(array('uid' => $user['uid'], 'logintime' => time(), 'lastip' => ip_get_client()));
            go("Index/index");
        } else {
			$this -> display();
		}
    }
    /**
	 * 退出
	 */
	public function out() {
		//清空SESSION
		session_unset();
		session_destroy();
		setcookie('login', '', 1, '/');
		echo "<script>
            window.top.location.href='" . U("login") . "';
        </script>";
		exit ;
	}

    
    
}
?>