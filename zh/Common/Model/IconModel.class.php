<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class IconModel extends ViewModel {
    public $table = "icon";
    
  
    public function getIconName($iconlist)
    {
        $arr = array();
        if(!empty($iconlist)){
            $icon_arr = explode(',',$iconlist);


            foreach($icon_arr as $v)
            {
                $result = $this->find($v);//::factory('icon',$v)->get('kind');
                $name=$result['kind'];
                array_push($arr,$name);
            }
        }
        
        return $arr;

    }
    
}
?>