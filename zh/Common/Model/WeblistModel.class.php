<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class WeblistModel extends ViewModel {
    public $table = "weblist";
    
    /**
	 * 添加帐号
	 */
	public function addWeblist($data) {
	    if (empty($data['webname'])) {
			$this -> error = '网站名称必须输入';
			return false;
		}
		if ($bid = $this -> add($data)) {
			return true;
		} else {
			$this -> error = '站点添加失败';
			return false;
		}
	}
    
    public function editWeblist($data) {
		$id= intval($data['id']);
		return $this -> where("id={$id}") -> save($data);
	}
    
    
    //更新缓存
    function updateCache()
    {
        $data = $this->join(NULL)->order(array("displayorder" => "ASC",'id'=>'ASC'))->all();
        return cache("weblist", $data);
    }
    
     function __after_insert($data)
    {
        $this->updateCache($data);
    }

    function __after_update($data)
    {
        $this->updateCache($data);
    }

    function __after_delete($data)
    {
        $this->updateCache($data);
    }
    
    
}
?>