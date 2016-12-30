<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class StartplaceControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Startplace");
	}
    

	public function index() {
        $list=$this -> db->getList(0,0,false);
        $this->list_info=$list;
        $this -> display();
	}
    
    //添加
	public function add() {
        if (IS_POST) {
            $db_prefix=C("DB_PREFIX");
            /* 初始化变量 */
            $info['id']       = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $info['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $info['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $info['cityname']     = !empty($_POST['cityname'])     ? trim($_POST['cityname'])     : '';
            $info['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            if($this -> db ->exists($info['cityname'],$info['pid']))
            {
                $this -> error("同级别下不能有重复的分类名称！");
            }

            if($id=$this -> db->insert($info)){
                $this -> db->updateCache();
                $this -> success("添加成功！");
            }else{
                $this -> success("添加失败！");
            }
        }else{
            $pid = Q("pid",0, "intval");
            $select=$this -> db->getList(0,$pid,true);
            $info=array('isopen' => 1);

            $this->info=$info;
            $this->select=$select;

            $this -> display();  
        }
	}
    
    //修改
    public function edit(){
        $db_prefix=C("DB_PREFIX");
        if (IS_POST) {
            
             /* 初始化变量 */
            $id              = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $old_cityname        = $_POST['old_cityname'];
            $info['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $info['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $info['cityname']     = !empty($_POST['cityname'])     ? trim($_POST['cityname'])     : '';
            $info['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            /* 判断分类名是否重复 */
            if ($info['cityname'] != $old_cityname)
            {
                if ($this -> db ->exists($info['cityname'],$info['pid'], $id))
                {
                    $this -> error("同级别下不能有重复的分类名称！");
                }
            }

            /* 判断上级目录是否合法 */
            $children = array_keys($this -> db->getList($id, 0, false));     // 获得当前分类的所有下级分类
            if (in_array($info['pid'], $children))
            {
                $this -> error("上级目录不合法");
            }
            if( $this -> db->where(" id = '$id' ")->update($info)){
                $this -> db->updateCache();
                $this -> success("修改成功！");
            }else{
                $this -> error("修改失败");
            }
        }else{
            $id = intval($_REQUEST['id']);
            $info = $this->db->where(" id='$id' ")->getRow();

            $this->info=$info;
            $this->select=$this -> db->getList(0,$info['pid'],true);

    	    $this -> display();
        }
        
        
    }
   
    public function del(){

        $db_prefix=C("DB_PREFIX");
        /* 初始化分类ID并取得分类名称 */
        $id   = Q('id',0,'intval');
        $name = M()->getOne('SELECT cityname FROM ' .$db_prefix.'startplace'. " WHERE id='$id'",'cityname');
        /* 当前分类下是否有子分类 */
        $count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'startplace'. " WHERE pid='$id'",'COUNT(*)');
        /* 当前分类下是否存在商品 */
        //TODO之后完成
        //$goods_count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'goods'. " WHERE cat_id='$cat_id'",'COUNT(*)');
        /* 如果不存在下级子分类和商品，则删除之 */
        //if ($cat_count == 0 && $goods_count == 0){
        if ($count == 0){
            /* 删除分类 */
            $sql = 'DELETE FROM ' .$db_prefix.'startplace'. " WHERE id = '$id'";
            if (M()->exe($sql)){
                $this -> db->updateCache();
                $this -> success("删除成功！");
            }else{
                $this -> success("删除失败！");
            }
            
        }else{
           // $this -> error("有下级菜单或者有商品存在");
            $this -> error("有下级菜单存在");
        }
    } 

    
    
}
