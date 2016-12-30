<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class GoodsCatModel extends ViewModel {
    public $table = "goods_cat";
    
    
    /**
     * 获得所有扩展分类属于指定分类的所有商品ID
     *
     * @access  public
     * @param   string $cat_id     分类查询字符串
     * @return  string
     */
    function get_extension_goods($cats)
    {
        $extension_goods_array = '';
        $sql = 'SELECT goods_id FROM ' . $this->tableFull . " AS g WHERE $cats";
        $extension_goods_array = M()->getCol($sql,'goods_id');
        return db_create_in($extension_goods_array, 'g.goods_id');
    }



    /**
     * 保存某商品的扩展分类
     * @param   int     $goods_id   商品编号
     * @param   array   $cat_list   分类编号数组
     * @return  void
     */
    public function handle_other_cat($goods_id, $cat_list)
    {
        /* 查询现有的扩展分类 */
        $sql = "SELECT cat_id FROM " . $this->tableFull .
                " WHERE goods_id = '$goods_id'";
        $exist_list = M()->getCol($sql,'cat_id');
        if($exist_list==false){
            $exist_list=array();
        }
        /* 删除不再有的分类 */
        $delete_list = array_diff($exist_list, $cat_list);
        if ($delete_list)
        {
            $sql = "DELETE FROM " . $this->tableFull .
                    " WHERE goods_id = '$goods_id' " .
                    "AND cat_id " . db_create_in($delete_list);
            M()->exe($sql);
        }
    
        /* 添加新加的分类 */
        $add_list = array_diff($cat_list, $exist_list, array(0));
        foreach ($add_list AS $cat_id)
        {
            // 插入记录
            $sql = "INSERT INTO " . $this->tableFull .
                    " (goods_id, cat_id) " .
                    "VALUES ('$goods_id', '$cat_id')";
                    //echo $sql.'<br/>';
            M()->exe($sql);
        }
    }

}
?>