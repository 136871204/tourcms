<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class MemberPriceModel extends ViewModel {
    public $table = "member_price";
    
    
    /**
     * 取得某商品的会员价格列表
     * @param   int     $goods_id   商品编号
     * @return  array   会员价格列表 user_rank => user_price
     */
    public function get_member_price_list($goods_id)
    {
        /* 取得会员价格 */
        $price_list = array();
        $sql = "SELECT user_rank, user_price FROM " .$this->tableFull.
               " WHERE goods_id = '$goods_id'";
        $res = $this->query($sql);
        if(!empty($res)){
            foreach($res as $key=>$value)
            {
                $price_list[$value['user_rank']] = $value['user_price'];
            }
        }
        
        //p($price_list);die;
        return $price_list;
    }
    
    /**
     * 保存某商品的会员价格
     * @param   int     $goods_id   商品编号
     * @param   array   $rank_list  等级列表
     * @param   array   $price_list 价格列表
     * @return  void
     */
    function handle_member_price($goods_id, $rank_list, $price_list)
    {
        if(!empty($rank_list)){
            /* 循环处理每个会员等级 */
            foreach ($rank_list AS $key => $rank){
                /* 会员等级对应的价格 */
                $price = $price_list[$key];
                // 插入或更新记录
                $sql = "SELECT COUNT(*) FROM " . $this->tableFull .
                " WHERE goods_id = '$goods_id' AND user_rank = '$rank'";
                
                if ($this->getOne($sql,'COUNT(*)') > 0)
                {
                    /* 如果会员价格是小于0则删除原来价格，不是则更新为新的价格 */
                    if ($price < 0)
                    {
                        $sql = "DELETE FROM " . $this->tableFull .
                       " WHERE goods_id = '$goods_id' AND user_rank = '$rank' LIMIT 1";
                    }
                    else
                    {
                        $sql = "UPDATE " . $this->tableFull .
                       " SET user_price = '$price' " .
                       "WHERE goods_id = '$goods_id' " .
                       "AND user_rank = '$rank' LIMIT 1";
                    }
                }
                else
                {
                    if ($price == -1)
                    {
                        $sql = '';
                    }else
                    {
                        $sql = "INSERT INTO " . $this->tableFull . " (goods_id, user_rank, user_price) " .
                       "VALUES ('$goods_id', '$rank', '$price')";
                    }
                }
                if ($sql)
                {
                    //echo $sql.'<br/>';
                    M()->exe($sql);
                }
            }
        }
        
    }
    
}
?>