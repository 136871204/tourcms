<?php

/**
 * 栏目管理模型
 * Class CategoryModel
 * @author 周鸿 <136871204@qq.com>
 */
class CatRecommendModel extends Model {
	//表
	public $table = "cat_recommend";
	
    
    /**
     * 插入首页推荐扩展分类
     *
     * @access  public
     * @param   array   $recommend_type 推荐类型
     * @param   integer $cat_id     分类ID
     *
     * @return void
     */
    function insert_cat_recommend($recommend_type, $cat_id)
    {
        //检查分类是否为首页推荐
        if (!empty($recommend_type))
        {
            //取得之前的分类
            $recommend_res =$this->getAll("SELECT recommend_type FROM " . $this->tableFull. " WHERE cat_id=" . $cat_id);
            if (empty($recommend_res))
            {
                foreach($recommend_type as $data)
                {
                    $data = intval($data);
                    $this->exe("INSERT INTO " .  $this->tableFull . "(cat_id, recommend_type) VALUES ('$cat_id', '$data')");
                }
            }
            else
            {
                $old_data = array();
                foreach($recommend_res as $data)
                {
                    $old_data[] = $data['recommend_type'];
                }
                $delete_array = array_diff($old_data, $recommend_type);
                if (!empty($delete_array))
                {
                    $this->exe("DELETE FROM " . $this->tableFull  . " WHERE cat_id=$cat_id AND recommend_type " . db_create_in($delete_array));
                }
                $insert_array = array_diff($recommend_type, $old_data);
                if (!empty($insert_array))
                {
                    foreach($insert_array as $data)
                    {
                        $data = intval($data);
                        $this->exe("INSERT INTO " . $this->tableFull . "(cat_id, recommend_type) VALUES ('$cat_id', '$data')");
                    }
                }
            }
        }
        else
        {
            $this->exe("DELETE FROM ". $this->tableFull . " WHERE cat_id=" . $cat_id);
        }
    }
    
}
