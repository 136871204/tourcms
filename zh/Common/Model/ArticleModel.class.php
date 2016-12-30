<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class ArticleModel extends ViewModel {
    public $table = "article";
    
    /* 取得文章关联商品 */
    public function get_article_goods($article_id)
    {
        $db_prefix=C("DB_PREFIX");
        $list = array();
        $sql  = 'SELECT g.goods_id, g.goods_name'.
                ' FROM ' . $db_prefix.'goods_article' . ' AS ga'.
                ' LEFT JOIN ' . $db_prefix.'goods' . ' AS g ON g.goods_id = ga.goods_id'.
                " WHERE ga.article_id = '$article_id'";
        $list = M()->getAll($sql);
    
        return $list;
    }
    
    
}
?>