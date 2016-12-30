<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class MainnavModel extends ViewModel {
    public $table = "mainnav";
    
    
     /**
	 * 添加
	 */
	public function addMainnav($data) {
	    if (empty($data['shortname'])) {
			$this -> error = '导航名称必须输入';
			return false;
		}
		if ($id = $this -> add($data)) {
			return true;
		} else {
			$this -> error = '添加失败';
			return false;
		}
	}
    
    public function editMainnav($data) {
        
		$id = intval($data['id']);
		return $this -> where("id={$id}") -> save($data);
	}
    
    
    
    
    
}
?>