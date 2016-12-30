<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class BonusTypeModel extends ViewModel {
    public $table = "bonus_type";
    
    /**
     * 取得红包类型信息
     * @param   int     $bonus_type_id  红包类型id
     * @return  array
     */
    public function bonus_type_info($bonus_type_id)
    {
        $sql = "SELECT * FROM " . $this->tableFull .
                " WHERE type_id = '$bonus_type_id'";
    
        return $this->getRowSql($sql);
    }
        
    
    
}
?>