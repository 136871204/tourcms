<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class VolumePriceModel extends ViewModel {
    public $table = "volume_price";
    
    
    
    /**
     * 保存某商品的优惠价格
     * @param   int     $goods_id    商品编号
     * @param   array   $number_list 优惠数量列表
     * @param   array   $price_list  价格列表
     * @return  void
     */
    function handle_volume_price($goods_id, $number_list, $price_list)
    {
        $sql = "DELETE FROM " . $this->tableFull .
               " WHERE price_type = '1' AND goods_id = '$goods_id'";
        M()->exe($sql);
    
    
        /* 循环处理每个优惠价格 */
        foreach ($price_list AS $key => $price)
        {
            /* 价格对应的数量上下限 */
            $volume_number = $number_list[$key];
    
            if (!empty($price))
            {
                $sql = "INSERT INTO " . $this->tableFull .
                       " (price_type, goods_id, volume_number, volume_price) " .
                       "VALUES ('1', '$goods_id', '$volume_number', '$price')";
                //       echo $sql.'<br/>';
                M()->exe($sql);
            }
        }
    }
    
    /**
     * 取得商品优惠价格列表
     *
     * @param   string  $goods_id    商品编号
     * @param   string  $price_type  价格类别(0为全店优惠比率，1为商品优惠价格，2为分类优惠比率)
     *
     * @return  优惠价格列表
     */
    function get_volume_price_list($goods_id, $price_type = '1')
    {
        $volume_price = array();
        $temp_index   = '0';
    
        $sql = "SELECT `volume_number` , `volume_price`".
               " FROM " .$this->tableFull. "".
               " WHERE `goods_id` = '" . $goods_id . "' AND `price_type` = '" . $price_type . "'".
               " ORDER BY `volume_number`";
    
        $res = $this->getAll($sql);
    
        foreach ($res as $k => $v)
        {
            $volume_price[$temp_index]                 = array();
            $volume_price[$temp_index]['number']       = $v['volume_number'];
            $volume_price[$temp_index]['price']        = $v['volume_price'];
            $volume_price[$temp_index]['format_price'] = price_format($v['volume_price']);
            $temp_index ++;
        }
        return $volume_price;
    }
    
}
?>