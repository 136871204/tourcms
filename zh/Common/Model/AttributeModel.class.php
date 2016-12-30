<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class AttributeModel extends ViewModel {
    public $table = "attribute";
    
    
   /**
     * 获取商品类型中包含规格的类型列表
     *
     * @access  public
     * @return  array
     */
    function get_goods_type_specifications()
    {
        $db_prefix=C("DB_PREFIX");
        // 查询
        $sql = "SELECT DISTINCT cat_id
                FROM " .$db_prefix.'attribute'. "
                WHERE attr_type = 1";
        $row = M()->GetAll($sql);
    
        $return_arr = array();
        if (!empty($row))
        {
            foreach ($row as $value)
            {
                $return_arr[$value['cat_id']] = $value['cat_id'];
            }
        }
        return $return_arr;
    }

    
    /**
     * 更新属性的分组
     *
     * @param   integer     $cat_id     商品类型ID
     * @param   integer     $old_group
     * @param   integer     $new_group
     *
     * @return  void
     */
    function update_attribute_group($cat_id, $old_group, $new_group)
    {
        $data=array('attr_group'=>$new_group);
        $this->where(" cat_id='$cat_id' AND attr_group='$old_group' ")->update($data);
    }
    
    /**
     * 获取属性列表
     *
     * @access  public
     * @param
     *
     * @return void
     */
    public function get_attr_list()
    {
        $db_prefix=C("DB_PREFIX");
        
        $sql = "SELECT 
                    a.attr_id, 
                    a.cat_id, 
                    a.attr_name ".
               " FROM 
                " . $db_prefix.'attribute'. " AS a,  
                " .$db_prefix.'goods_type' . " AS c ".
               " WHERE  
                    a.cat_id = c.cat_id AND 
                    c.enabled = 1 ".
               " ORDER BY a.cat_id , a.sort_order";
    
        $arr  = $this->db->query($sql);
    
        $list = array();
    
        foreach ($arr as $val)
        {
            $list[$val['cat_id']][] = array($val['attr_id']=>$val['attr_name']);
        }
    
        return $list;
    }
    
    
}
?>