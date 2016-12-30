<?php
/**
 * 角色
 * Class RoleModel
 * @author 周鸿 <136871204@qq.com>
 */
class RoleModel extends Model {
    public $table = 'role';
    
    public function __init(){
        C('language','Model'.DS.'Role'.DS.$_SESSION['language']);
    }
    
    //添加角色
	public function addRole($data) {
        $rname = $data['rname'];
		if (empty($data['rname'])) {
			$this -> error = L('add_role_error1');
            return false;
		}
        if ($this -> where(array('rname' => $rname)) -> find()) {
			$this -> error = L('add_role_error2');
			return false;
		}
        if ($this -> add($data)) {
			$this -> updateCache();
			return true;
		} else {
			return false;
		}
	}
    
    //添加角色
	public function editRole($data) {
		$rname = $data['rname'];
		if (empty($data['rname'])) {
			$this -> error = L('edit_role_error1');
            return false;
		}
		if ($this -> where("rname='$rname' AND rid!={$data['rid']}") -> find()) {
			$this -> error = L('edit_role_error2');
			return false;
		}
		if ($this -> save($data)) {
			$this -> updateCache();
			return true;
		} else {
			return false;
		}
	}
    
    //删除用户
	public function delRole($rid) {
        $usercount=M("user")->where(array('rid' => $rid))->count();
        if($usercount>0){
            $this->error = L('del_role_error1');
            return false;
        }else{
            if ($this->del($rid)) {
                return $this->updateCache();
            }else{
                $this->error = L('del_role_error2');
                return false;
            }
        }
        
	}
    
    //更新缓存
	public function updateCache() {
		$role = $this -> all();
		if (!cache('role', $role)) {
			$this -> error = L('update_cache_error1');
			return false;
		} else {
			return true;
		}
	}

}
?>