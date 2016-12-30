<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class GroupGoodsModel extends ViewModel {
    public $table = "group_goods";
    
    /**
     * 保存某商品的配件
     * @param   int     $goods_id
     * @return  void
     */
    public function handle_group_goods($goods_id)
    {
        $sql = "UPDATE " . $this->tableFull . " SET " .
                " parent_id = '$goods_id' " .
                " WHERE parent_id = '0'" .
                " AND admin_id = '$_SESSION[uid]'";
        M()->exe($sql);
    }
    
    
}
?>