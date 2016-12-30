<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LinePricelistModel extends ViewModel {
    public $table = "line_pricelist";
    
    //更新缓存
    function updateCache()
    {
        
        $data = $this->order('webid asc,lowerprice asc')->all();
        return cache("line_pricelist", $data);
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