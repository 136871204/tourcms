<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineModel extends ViewModel {
    public $table = "line";
    
    public function deleteClear($lineid)
    {
        $lineSuitModel=K('LineSuit');
        $suits=$lineSuitModel->where(" lineid={$lineid} ")->All();
        if(!empty($suits)){
            foreach($suits as $suit)
            {
                $lineSuitModel->deleteClear($suit['id']);
            }
        }
        $this->del($lineid);
    }
    
    /*
    * 更新最低报价
    * */
    public  function updateMinPrice($lineid)
    {
        $db_prefix=C("DB_PREFIX");
	    $newtime = time();
        $sql = "SELECT 
                    MIN(adultprice) as price 
                FROM 
                    ".$db_prefix."line_suit_price AS a inner join
                    ".$db_prefix."line_suit AS b on   a.suitid =b.id
                WHERE a.lineid='$lineid' and a.adultprice>0 and a.day>=$newtime and b.suittype='b2c'";
        $ar = M()->query($sql);
        $price = $ar[0]['price'] ? $ar[0]['price'] : 0;
        
        $sql = "SELECT 
                    MIN(adultprice) as price 
                FROM 
                    ".$db_prefix."line_suit_price AS a inner join
                    ".$db_prefix."line_suit AS b on   a.suitid =b.id
                WHERE a.lineid='$lineid' and a.adultprice>0 and a.day>=$newtime and b.suittype='b2b'";
        $ar = M()->query($sql);
        $b2bprice = $ar[0]['price'] ? $ar[0]['price'] : 0;
        //echo $b2bprice;die;
        
        $model = $this->find($lineid);
        $model['lineprice'] = $price;
        $model['b2blineprice'] = $b2bprice;
        $this->update($model);
        
        
        
        $this->updateMindayMaxday($lineid);

    }
   
    public function updateMindayMaxday($lineid){
        $db_prefix=C("DB_PREFIX");
        $sql = "select 
                    min(a.day) as minday,max(a.day) as maxday 
                from ".$db_prefix."line_suit_price AS a inner join
                     ".$db_prefix."line_suit AS b on   a.suitid =b.id
                where a.lineid='$lineid' and b.suittype='b2c' ";
        $row = M()->getOneRow($sql);
        
        $sql = "select 
                    min(a.day) as minday,max(a.day) as maxday 
                from ".$db_prefix."line_suit_price AS a inner join
                     ".$db_prefix."line_suit AS b on   a.suitid =b.id
                where a.lineid='$lineid' and b.suittype='b2b' ";
        $row1 = M()->getOneRow($sql);
        
        $model = $this->find($lineid);
        $model['minday'] = $row['minday'];
        $model['maxday'] = $row['maxday'];
        $model['b2bminday'] = $row1['minday'];
        $model['b2bmaxday'] = $row1['maxday'];
        //$model['expire'] = $row['maxday'];
        
        $this->update($model);
        
    
    }
    

   
   //线路信息
    public function getStandardInfo($aid)
    {
    	$db_prefix=C("DB_PREFIX");
    	$sql="select * from ".$db_prefix."line where id=$aid";
        $row=M()->GetOneRow($sql);
    	return $row;	
    } 
    
}
?>