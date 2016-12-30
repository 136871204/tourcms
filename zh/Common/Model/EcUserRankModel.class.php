<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class EcUserRankModel extends ViewModel {
    public $table = "ec_user_rank";
    
    
    
    /**
     * 取得会员等级列表
     * @return  array   会员等级列表
     */
    public function get_user_rank_list()
    {
        $sql = "SELECT * FROM " .$this->tableFull .
               " ORDER BY min_points";
    
        return $this->getAll($sql);
    }
    
    
    /**
     * 取得用户等级数组,按用户级别排序
     * @param   bool      $is_special      是否只显示特殊会员组
     * @return  array     rank_id=>rank_name
     */
    public function get_rank_list($is_special = false)
    {
        $rank_list = array();
        $sql = 'SELECT rank_id, rank_name, min_points FROM ' . $this->tableFull;
        if ($is_special)
        {
            $sql .= ' WHERE special_rank = 1';
        }
        $sql .= ' ORDER BY min_points';
    
        $res = $this->query($sql);
    
        if(!empty($res)){
            foreach($res as $key=>$val){
                $rank_list[$val['rank_id']] = $val['rank_name'];
            }
        }
        //p($rank_list);die;
        return $rank_list;
    }  
}
?>