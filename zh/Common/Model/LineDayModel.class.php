<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineDayModel extends ViewModel {
    public $table = "line_day";
    
    //更新缓存
    function updateCache()
    {
        
        $data = $this->order('webid asc,word asc')->all();
        return cache("line_day", $data);
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