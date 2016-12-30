<?php
/**
 * 管理员管理模块
 * Class AdministratorControl
 * @author 周鸿 <136871204@qq.com>
 */
class AdministratorControl extends AuthControl{
    
    private $_db;

    public function __init() {
		$this -> _db = K("User");
        $this -> selectlan=getEnableLan();
	}
    
    //验证用户是否存在(添加管理员时验证)
	public function check_username() {
		$username = Q("post.username");
		echo $this -> _db -> join() -> find("username='$username'") ? 0 : 1;
		exit ;
	}

	//验证邮箱
	public function check_email() {
		$email = Q("post.email");
		if ($uid = Q('uid')) {
			$this -> _db -> where("uid<>$uid");
		}
		echo $this -> _db -> join() -> find("email='$email'") ? 0 : 1;
		exit ;
	}
    
    //管理员列表
	public function index() {
		$WEBMASTER=C('WEB_MASTER');
		$data = $this -> _db -> order("uid ASC") -> where("admin=1 AND username<>'$WEBMASTER'") -> all();
		$this -> assign('data', $data);
		$this -> display();
	}
    
    //添加管理员
	public function add() {
		if (IS_POST) {
		   //user_state 1 正常 0 锁定
			$_POST['user_state']=1;
			if ($this -> _db -> addUser($_POST)) {
				$this -> success(L('admin_administrator_control_add_success'));
			} else {
				$this -> error($this -> _db -> error);
			}
		} else {
			$this -> role = M("role") -> where('admin=1 AND system=0 ') -> order("rid DESC") -> all();
			$this -> display();
		}
	}
    
    /**
	 * 修改管理员
	 */
	public function edit() {
		if (IS_POST) {
			$uid = Q('uid', 0, 'intval');
			if (!$uid) {
				$this -> error(L('admin_administrator_control_edit_error1'));
			}
			$_POST['uid']=$uid;
			if ($this -> _db -> editUser($_POST)) {
				$this -> success(L('admin_administrator_control_edit_success'));
			} else {
				$this -> error($this -> _db -> error);
			}
		} else {
			$uid = Q("request.uid", null, "intval");
			if ($uid) {
				//会员信息
				$this -> field = $this -> _db -> find($uid);
				$this -> role = $this -> _db -> table("role") -> where('admin=1 AND system=0') -> order("rid DESC") -> all();
				$this -> display();
			}
		}
	}
    
    //删除管理员
	public function del() {
		$uid = Q("POST.uid", null, "intval");
		if ($uid) {
			if ($this -> _db -> delUser($uid)) {
				$this -> success(L('admin_administrator_control_del_success'));
			}
		} else {
			$this -> error(L('admin_administrator_control_del_error1'));
		}
	}
    
}
?>