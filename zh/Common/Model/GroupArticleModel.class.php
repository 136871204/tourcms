<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class GroupArticleModel extends ViewModel {
    public $table = "goods_article";
    
    
    
    /**
     * 保存某商品的关联文章
     * @param   int     $goods_id
     * @return  void
     */
    public function handle_goods_article($goods_id)
    {
        $sql = "UPDATE " .  $this->tableFull . " SET " .
                " goods_id = '$goods_id' " .
                " WHERE goods_id = '0'" .
                " AND admin_id = '$_SESSION[uid]'";
        M()->exe($sql);
    }

    
    
}
?>