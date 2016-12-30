<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class BrandModel extends ViewModel {
    public $table = "brand";
    
    
    public function get_brand_list(){
        $sql = 'SELECT brand_id, brand_name FROM ' . $this->tableFull . ' ORDER BY sort_order';
        $res=$this->getAll($sql);
        $brand_list = array();
        foreach ($res AS $row)
        {
            $brand_list[$row['brand_id']] = addslashes($row['brand_name']);
        }
    
        return $brand_list;
    }
    /**
	 * 添加帐号
	 */
	public function addBrand($data) {
	    if (empty($data['brand_name'])) {
			$this -> error = 'ブランド名称は必須';
			return false;
		}
        $data['site_url'] = sanitize_url( $data['site_url'] );
		if ($bid = $this -> add($data)) {
			return true;
		} else {
			$this -> error = 'ブランド登録失敗';
			return false;
		}
	}
    
    public function editBrand($data) {
		$data['site_url'] = sanitize_url( $data['site_url'] );
        
		$brand_id = intval($data['brand_id']);
		return $this -> where("brand_id={$brand_id}") -> save($data);
	}


    public function brand_exists($brand_name){
        $sql = "SELECT COUNT(*) FROM " .$this->tableFull.
        " WHERE brand_name = '" . $brand_name . "'";
        return (M()->getOne($sql,'COUNT(*)') > 0) ? true : false;
    }
    
    
    
}
?>