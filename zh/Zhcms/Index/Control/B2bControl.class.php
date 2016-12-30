<?php

/**
 * 网站前台
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class B2bControl extends TripControl {
    
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
    
    //B2B登录
    public function login(){
        
        if(session("b2blogin")){
            go( U('Index/Index/index') );
        }
        
        if( IS_POST ){
            $b2busername = Q('b2busername');
            $b2bpassword = Q('b2bpassword');
            $code = Q('post.code', null, 'strtoupper');
            $http_referer = Q("http_referer","/");
            //print_r($_POST);p($_SESSION);die;
            if( preg_match("/booking/i",$http_referer) ){
                $http_referer = ROOT_URL.$this -> urlroot;
            }
            //echo $http_referer;
            $this->assign("http_referer",$http_referer);
            if (empty($code) || $code != $_SESSION['code']) {
				$this -> err = "验证码不对！";
                $this -> display('template/' . C('WEB_STYLE') . '/b2b/login.html');
				exit ;
			}
            if(empty($b2busername)){
                $this -> err = "b2b用户名不能为空！";
                $this -> display('template/' . C('WEB_STYLE') . '/b2b/login.html');
                exit;
            }
            if(empty($b2bpassword)){
                $this -> err = "b2b密码不能为空！";
                $this -> display('template/' . C('WEB_STYLE') . '/b2b/login.html');
                exit;
            }
            
            $b2buser = M('b2buser') -> where( array('b2busername'=>$b2busername) ) -> find();
            
            if( !$b2buser ){
                $this -> err = '用户不存在！';
                $this -> display("template/" . C('WEB_STYLE') . "/b2b/login.html");
                exit;
            }elseif ($b2buser['b2bpassword'] !== $b2bpassword) {
                $this -> err = '密码不正确！';
                $this -> display("template/" . C('WEB_STYLE') . "/b2b/login.html");
                exit;
			}else{
                $_SESSION['b2blogin']="1";
                $_SESSION['b2busername']=$b2busername;
    			unset($b2buser['$b2bpassword']);
    			unset($_SESSION['code']);
			}
            //echo $http_referer;die;
            header("Location:$http_referer" );
            
        }else{
            $this -> http_referer = empty($_SERVER['HTTP_REFERER']) ? "/" : $_SERVER['HTTP_REFERER'];
            $this -> display('template/' . C('WEB_STYLE') . '/b2b/login.html');
        }
        
    }
    
    //B2b logout
    public function logout(){
        unset($_SESSION['b2blogin']);
        $http_referer = empty($_SERVER['HTTP_REFERER']) ? ROOT_URL : $_SERVER['HTTP_REFERER'];
            
        if( preg_match("/booking/i",$http_referer) ){
            $http_referer = ROOT_URL.$this -> urlroot;
        }
        
        header("Location:$http_referer");
    }
    
    
	//网站首页
	public function b2b() {
	   $_SESSION['b2blogin']="1";
	}
    
    //网站首页
	public function b2c() {
	   unset($_SESSION['b2blogin']);
	}
    
}
