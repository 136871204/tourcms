<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class IconControl extends AuthControl {
    protected $db;
    
    private $product_arr=array(
            1=>'line',
            2=>'hotel',
            3=>'car',
            4=>'article',
            5=>'spot',
            6=>'photo',
            8=>'visa',
            11=>'jieban',
            13=>'tuan'
        );
        
        
    public function __init() {
		$this -> db = K("Icon");
	}
    
	public function ajax_iconlist()
    {
        $list=$this -> db->where(' webid = 1 ')->All();
	   echo json_encode($list);exit;
    }
    
    public function ajax_seticon(){
        $typeid=Q('typeid');
        $productid=Q('productid');
        $icons=Q('icons');
        
        $is_success='ok';
        $productid_arr=explode('_',$productid);
        //p($productid_arr);
        foreach($productid_arr as $k=>$v)
        {
            if(!empty($v)){
                $table = $typeid>13 ? 'model_archive' : $this->product_arr[$typeid];
                $model=M($table)->find($v);//ORM::factory($table,$v);
                if($model['id'])
                {
                    $model['iconlist']=$icons;
                    if(!M($table)->save($model))
    				   $is_success='no';
                }
            }
            
        }
        echo $is_success;exit;
    }
    
}
