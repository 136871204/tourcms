<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineSuitPriceModel extends ViewModel {
    public $table = "line_suit_price";
    
    public function getMinPrice($suitid,$field='adultprice')
	{
		$time=time();
        $sql="select min($field) as minprice from ".$this->tableFull." where  day>$time and suitid=$suitid";
		$result=M()->query($sql);
		return $result[0]['minprice'];
	}
    
    
}
?>