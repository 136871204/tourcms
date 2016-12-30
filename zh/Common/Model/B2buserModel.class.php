<?php
/**
 * b2b用户管理模型
 * Class B2buserModel
 */
class B2buserModel extends ViewModel {
    public $table = "b2buser";
	//public $view = array("role" => array("type" => INNER_JOIN, "on" => "user.rid=role.rid"));
    
    public function __init(){
        
    }
    
    /**
	 * 添加帐号
	 */
	public function addB2bUser($data) {
	    if (empty($data['b2busername'])) {
			$this -> error = L('add_user_error1');
			return false;
		}
		if (empty($data['b2bpassword'])) {
			$this -> error = L('add_user_error2');
			return false;
		}
		
		$data['regtime'] = time();
        
        //设置用户头像
		if ($uid = $this -> add($data)) {
			return true;
		} else {
			$this -> error = L('add_user_error3');
			return false;
		}
	}
    
    /**
	 * 修改用户
	 */
	public function editB2bUser($data) {
		//修改密码
		/*if (!empty($data['password'])) {
			$data['code'] = $this -> getUserCode();
			$data['password'] = md5($data['password'] . $data['code']);
		}else{
			unset($data['password']);
		}
		*/
		$b2bid = intval($data['b2bid']);
		return $this -> where("b2bid={$b2bid}") -> save($data);
	}
    
    /**
	 * 删除用户
	 * @return mixed
	 */
	public function delUser($uid) {
		//删除评论与回复
		M('comment') -> where("uid=$uid") -> del();
		//删除用户表记录
		return $this -> del($uid);
	}
    
    /**
	 * 获取用户密码加密key
	 * @return string
	 */
	public function getUserCode() {
		return substr(md5(C("AUTH_KEY") . mt_rand() . time() . C('AUTH_KEY')), 0, 10);
	}
    
    /**
	 * 验证用户密码是否正确
	 * @param int uid 用户id
	 * @password 要比较的密码
	 */
	public function checkUserPassword($uid, $password) {
		$data = $this -> find($uid);
		if (!$uid) {
			$this -> error = L('check_user_password_error1');
			return false;
		}
		if (md5($password . $data['code']) != $data['password']) {
			return false;
		} else {
			return true;
		}

	}

}
?>