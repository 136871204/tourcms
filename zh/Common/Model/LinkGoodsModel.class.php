<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LinkGoodsModel extends ViewModel {
    public $table = "link_goods";
    
    /**
     * 保存某商品的关联商品
     * @param   int     $goods_id
     * @return  void
     */
    public function handle_link_goods($goods_id)
    {
        $sql = "UPDATE " . $this->tableFull . " SET " .
                " goods_id = '$goods_id' " .
                " WHERE goods_id = '0'" .
                " AND admin_id = '$_SESSION[uid]'";
        M()->exe($sql);
    
        $sql = "UPDATE " . $this->tableFull . " SET " .
                " link_goods_id = '$goods_id' " .
                " WHERE link_goods_id = '0'" .
                " AND admin_id = '$_SESSION[uid]'";
        M()->exe($sql);
    }
}
?>