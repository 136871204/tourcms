<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class GoodsTypeModel extends ViewModel {
    public $table = "goods_type";
    
    
    /**
     * 获得指定的商品类型下所有的属性分组
     *
     * @param   integer     $cat_id     商品类型ID
     *
     * @return  array
     */
    function get_attr_groups($cat_id)
    {
        $result=$this->where(" cat_id = $cat_id ")->field(array("attr_group"))->find();
        $grp = str_replace("\r", '', $result['attr_group']);
    
        if ($grp)
        {
            return explode("\n", $grp);
        }
        else
        {
            return array();
        }
    }

    /**
     * 获得商品类型的列表
     *
     * @access  public
     * @param   integer     $selected   选定的类型编号
     * @return  string
     */
    function goods_type_list($selected){
        $result=$this->where("enabled = 1")->field(array("cat_id","cat_name"))->All();
        $lst = '';
        if(!empty($result)){
            foreach($result as $key=>$value){
                $lst .= "<option value='$value[cat_id]'";
                $lst .= ($selected == $value['cat_id']) ? ' selected="true"' : '';
                $lst .= '>' . htmlspecialchars($value['cat_name']). '</option>';
            }
        }
        return $lst;
    }

}
?>