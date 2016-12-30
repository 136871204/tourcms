<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class ShopConfigControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("ShopConfig");
	}
    
	//商品类型一览
	public function index() {
	    include (COMMON_LANGUAGE_PATH . 'Model'.DS.'ShopConfig'.DS.$_SESSION['language'] . '.php');
	    $this-> lang=$_LANG;
	    $this->group_list=$this -> db->get_settings(null, array('5'));
        $this -> display();
	}
    
    //添加
	public function add() {
        
	}
    
    //修改
    public function edit(){
        
        
    }
   
    public function del(){
        
    } 
	

    
    
}
