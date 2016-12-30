<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class DestinationsControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Destinations");
	}
    
	//商品类型一览
	public function index() {
        $dest_list=$this -> db->dest_list(0,0,false);
        $this->dest_info=$dest_list;
        $this -> display();
	}
    
    //添加
	public function add() {
        if (IS_POST) {
            $db_prefix=C("DB_PREFIX");
            /* 初始化变量 */
            $dest['id']       = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $dest['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $dest['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $dest['keyword']     = !empty($_POST['keyword'])     ? trim($_POST['keyword'])     : '';
            $dest['description']     = !empty($_POST['description'])     ? $_POST['description']           : '';
            $dest['kindname']     = !empty($_POST['kindname'])     ? trim($_POST['kindname'])     : '';
            $dest['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            $dest['isnav']  = !empty($_POST['isnav'])  ? intval($_POST['isnav']): 0;
            $dest['ishot']  = !empty($_POST['ishot'])  ? intval($_POST['ishot']): 0;
            if($this -> db ->dest_exists($dest['kindname'],$dest['pid']))
            {
                $this -> error("同级别下不能有重复的分类名称！");
            }

            if($dest_id=$this -> db->insert($dest)){
                $this -> success("添加成功！");
            }else{
                $this -> success("添加失败！");
            }
        }else{
            $pid = Q("pid",0, "intval");
            $dest_select=$this -> db->dest_list(0,$pid,true);
            $dest_info=array('isopen' => 1);

            $this->dest_info=$dest_info;
            $this->dest_select=$dest_select;

            $this -> display();  
        }
	}
    
    //修改
    public function edit(){
        $db_prefix=C("DB_PREFIX");
        if (IS_POST) {
            
             /* 初始化变量 */
            $id              = !empty($_POST['id'])       ? intval($_POST['id'])     : 0;
            $old_kindname        = $_POST['old_kindname'];
            $dest['pid']    = !empty($_POST['pid'])    ? intval($_POST['pid'])  : 0;
            $dest['displayorder']   = !empty($_POST['displayorder'])   ? intval($_POST['displayorder']) : 9999;
            $dest['keyword']     = !empty($_POST['keyword'])     ? trim($_POST['keyword'])     : '';
            $dest['description']     = !empty($_POST['description'])     ? $_POST['description']           : '';
            $dest['kindname']     = !empty($_POST['kindname'])     ? trim($_POST['kindname'])     : '';
            $dest['isopen']  = !empty($_POST['isopen'])  ? intval($_POST['isopen']): 0;
            $dest['isnav']  = !empty($_POST['isnav'])  ? intval($_POST['isnav']): 0;
            $dest['ishot']  = !empty($_POST['ishot'])  ? intval($_POST['ishot']): 0;
            /* 判断分类名是否重复 */
            if ($dest['kindname'] != $old_kindname)
            {
                if ($this -> db ->dest_exists($dest['kindname'],$dest['pid'], $id))
                {
                    $this -> error("同级别下不能有重复的分类名称！");
                }
            }

            /* 判断上级目录是否合法 */
            $children = array_keys($this -> db->dest_list($id, 0, false));     // 获得当前分类的所有下级分类
            if (in_array($dest['pid'], $children))
            {
                $this -> error("上级目录不合法");
            }
            if( $this -> db->where(" id = '$id' ")->update($dest)){
                $this -> success("修改成功！");
            }else{
                $this -> error("修改失败");
            }
        }else{
            $id = intval($_REQUEST['id']);
            $dest_info = $this->db->where(" id='$id' ")->getRow();

            $this->dest_info=$dest_info;
            $this->dest_select=$this -> db->dest_list(0,$dest_info['pid'],true);

    	    $this -> display();
        }
        
        
    }
   
    public function del(){
        $db_prefix=C("DB_PREFIX");
        
        /* 初始化分类ID并取得分类名称 */
        $id   = Q('id',0,'intval');
        $name = M()->getOne('SELECT kindname FROM ' .$db_prefix.'destinations'. " WHERE id='$id'",'kindname');
        /* 当前分类下是否有子分类 */
        $count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'destinations'. " WHERE pid='$id'",'COUNT(*)');
        /* 当前分类下是否存在商品 */
        //TODO之后完成
        //$goods_count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'goods'. " WHERE cat_id='$cat_id'",'COUNT(*)');
        /* 如果不存在下级子分类和商品，则删除之 */
        //if ($cat_count == 0 && $goods_count == 0){
        if ($count == 0){
            //echo 'aaa';die;
            /* 删除分类 */
            $sql = 'DELETE FROM ' .$db_prefix.'destinations'. " WHERE id = '$id'";
            if (M()->exe($sql)){
                $this -> success("删除成功！");
            }else{
                $this -> success("删除失败！");
            }
            
        }else{
           // $this -> error("有下级菜单或者有商品存在");
            $this -> error("有下级菜单存在");
        }
    } 
	
    public function ajax_getDestsetList(){
        $db_prefix=C("DB_PREFIX");
        $destinationsModel=K("Destinations");
        
        $pid=Q('pid');
		$keyword=Q('keyword');
		$pid=empty($pid)?0:$pid;
		$kindlist=Q('kindlist');
        
        
        if($keyword)
        {
            $sql="select 
                        id,kindname,pinyin 
                    from ".$db_prefix."destinations 
                    where 
                        kindname like '%{$keyword}%' and isopen=1  order by pinyin asc";
        }else{
            $sql="select 
                    id,kindname,pinyin 
                    from ".$db_prefix."destinations 
                    where pid=$pid and isopen=1  order by pinyin asc";
        }
        $destlist=M()->query($sql);
        if(!empty($destlist)){
            foreach($destlist as $key => $row)
            {
                $sql = "select count(*) as num from ".$db_prefix."destinations where pid='{$row['id']}' and isopen=1";
                $r = M()->query($sql);
                $destlist[$key]['childnum'] = $r[0]['num'];
            }
        }
        
        $new_arr=array();
        if($kindlist)
		{
			$_arr=explode(',',$kindlist);
			foreach($_arr as $k=>$v)
			{
                $_dest=$destinationsModel->where( " id = $v " )->All();
                if(isset($_dest[0])){
                    $_dest=$_dest[0];
                }
        
                //p($_dest);exit;
				if($_dest['id'])
				{
					$nv['id']=$_dest['id'];
					$nv['kindname']=$_dest['kindname'];
					$new_arr[]=$nv;
				}
			}
		}
        $dest_parents=$destinationsModel->getParents($pid);
        echo json_encode(array('nextlist'=>$destlist,'selected'=>$new_arr,'parents'=>$dest_parents));exit;
        //p($destlist);exit;
        //echo $sql;exit;
    }
    
    
    public function ajax_setdest(){
        $typeid=Q('typeid');
		$productid=Q('productid');
		$kindlist=Q('kindlist');
        
        if($typeid=='1'){
            $currentModel=K("Line");
        }
        
        $productid_arr=explode('_',$productid);
        $is_success='ok';
        foreach($productid_arr as $k=>$v){
            if($typeid<14) //是否是扩展模型
            {
                $model=$currentModel->find($v);
            }else
            {
                //$model=ORM::factory('model_archive',$v);
            }
            if($model['id'])
			{
				$model['kindlist']=$kindlist;
				if(!$currentModel->save($model))
				   $is_success='no';
			}
        }
        echo $is_success;exit;
        
        
    }
    
}
