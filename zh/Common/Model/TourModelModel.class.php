<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class TourModelModel extends ViewModel {
    public $table = "tour_model";
    
    /*
     * 获取当前模型名称
     * */
    public  function getModuleName($typeid)
    {
        $row =$this->find($typeid);
        return $row['modulename'];
    }
    
    
}
?>