<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class AttridControl extends AuthControl {
    //protected $db;
    public static $table_arr=array(
         1=>'line_attr',
         2=>'hotel_attr',
         3=>'car_attr',
         4=>'article_attr',
         5=>'spot_attr',
         6=>'photo_attr',
         11=>'jieban_attr',
         13=>'tuan_attr'
     );
     
     public static $product_arr=array(
         1=>'line',
         2=>'hotel',
         3=>'car',
         4=>'article',
         5=>'spot',
         6=>'photo',
         11=>'jieban',
         13=>'tuan'
     );
    
    public function __init() {
		//$this -> db = K("LineAttr");
	}
    
	public function ajax_attridlist()
    {
        $typeid  = Q('typeid');
        $list=self::getattridlist($typeid);
        echo json_encode($list);exit;
    }
    
    /*
	   根据typeid获取某个产品属性的列表 ，以json方式返回
	 */
	 public static function getattridlist($typeid)
     {
        
        
        $weblistModel = K("Weblist");
        $result=$weblistModel->All();
        $weblist = array();
        foreach ($result AS $row)
        {
            $weblist[$row['id']] = addslashes($row['webname']);
        }
        
        if($typeid==1){
            $db=K("LineAttr");
        }
        $w = $typeid > 13 ? " and typeid='$typeid'" : '';
        $list=$db->where("isopen=1 and pid=0 $w")->All();

        foreach($list as $k=>$v)
        {
             $list[$k]['webname']=$weblist[$v['webid']];
			 $list[$k]['children']=$db->where("pid={$v['id']} and isopen=1")->All();
        }
        return $list;
     }
     
     public function ajax_setattrid()
     {
         $typeid=Q('typeid');
    	 $productid=Q('productid');
    	 $attrids=Q('attrids');
         
         $attrtable = $typeid<13 ? self::$table_arr[$typeid] :  'model_attr';;//当前操作表
         $is_success='ok';
         $productid_arr=explode('_',$productid);
         if($attrids==''){
            foreach($productid_arr as $k=>$v){
                $table = $typeid>13 ? 'model_archive' : self::$product_arr[$typeid];
                $model=M($table)->find($v); //ORM::factory($table,$v);
    			if($model['id'])
    			{
    				$model['attrid']='';
    				if(!M($table)->save($model))
    				   $is_success='no';
    			}
            }
            echo $is_success;exit;
         }

        
        //找到父级id
        $attrids_arr = M($attrtable)->where("id in (".$attrids.")")->group('pid')->All();
        foreach ($attrids_arr as $key => $value) {
            $attrids .= ','.$value['pid']; 
        }
        
		
        foreach($productid_arr as $k=>$v)
		{
            $table = $typeid>13 ? 'model_archive' : self::$product_arr[$typeid];
			$model=M($table)->find($v); //ORM::factory($table,$v);
			if($model['id'])
			{
				$model['attrid']=$attrids;
				if(!M($table)->save($model))
				   $is_success='no';
			}
		}
        
        echo $is_success;exit;
     }
    
    
}
