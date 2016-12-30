<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class GoodsTypeControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("GoodsType");
	}
    
	//商品类型一览
	public function index() {
	    $count = $this -> db -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
        $db_prefix=C('DB_PREFIX');
        $sql = "SELECT t.*, COUNT(a.cat_id) AS attr_count ".
               "FROM ". $db_prefix.'goods_type'. " AS t ".
               "LEFT JOIN ". $db_prefix.'attribute'. " AS a ON a.cat_id=t.cat_id ".
               "GROUP BY t.cat_id " .
               'LIMIT '.implode(",", $page -> limit());
        $all=$this -> db->query($sql);
        if(!empty($all)){
            foreach ($all AS $key=>$val)
            {
                $all[$key]['attr_group'] = strtr($val['attr_group'], array("\r" => '', "\n" => ", "));
            }
        }
        
        $this -> all = $all;
        $this -> display();
	}
    
    //添加
	public function add() {
		if (IS_POST) {
            $goods_type['cat_name']   = sub_str($_POST['cat_name'], 60);
            $goods_type['attr_group'] = sub_str($_POST['attr_group'], 255);
            $goods_type['enabled']    = intval($_POST['enabled']);
            if($this -> db->insert($goods_type)){
                $this -> success("新建成功！");
            }else{
                $this -> error("新建失败");
            }
		} else {
			$this -> display();
		}
	}
    
    //修改
    public function edit(){
        if (IS_POST) {
            $goods_type['cat_name']   = sub_str($_POST['cat_name'], 60);
            $goods_type['attr_group'] = sub_str($_POST['attr_group'], 255);
            $goods_type['enabled']    = intval($_POST['enabled']);
            $cat_id                   = intval($_POST['cat_id']);
            $old_groups               = $this->db->get_attr_groups($cat_id);
            if ($this -> db->where(" cat_id='$cat_id' ")->update($goods_type)) {
                $attributeModel=K("Attribute");
                /* 对比原来的分组 */
                $new_groups = explode("\n", str_replace("\r", '', $goods_type['attr_group']));  // 新的分组
                foreach ($old_groups AS $key=>$val)
                {
                    $found = array_search($val, $new_groups);
                    if ($found === NULL || $found === false)
                    {
                        /* 老的分组没有在新的分组中找到 */
                        $attributeModel->update_attribute_group($cat_id, $key, 0);
                    }
                    else
                    {
                        /* 老的分组出现在新的分组中了 */
                        if ($key != $found)
                        {
                            $attributeModel->update_attribute_group($cat_id, $key, $found); // 但是分组的key变了,需要更新属性的分组
                        }
                    }
                }
				$this -> success("修改成功！");
			} else {
				$this -> error("修改失败！");
			}
		} else {
            $cat_id = Q("cat_id",0, "intval");
			if ($cat_id) {
				$field = $this -> db-> find($brand_id);
				$this->assign('field',$field);
				$this -> display();
			}
		}
    }
   
    public function del(){
        $adminLogModel=K('AdminLog');
        $attributeModel=K('Attribute');
        
        $id = Q('id',0,'intval');
        $nameResult=$this->db->where("cat_id = $id")->field('cat_name')->getRow();
        $name = $nameResult['cat_name'];
        
        if($this->db->drop($id)){
            $adminLogModel->admin_log($name,"删除","产品类型");
            
            /* 清除该类型下的所有属性 */
            $idResult=$attributeModel->where("cat_id = '$id'")->field('attr_id')->all();
            $idInStr=buildInStr($idResult,'attr_id');
            $attributeModel->in($idInStr)->del();
            
            //TODO:goods_attr 表格数据没有删除
            $this -> success("删除成功！");
        }else{
            $this -> error("删除失败！");
        }
    } 
	
    public function buildInStr($itemList,$key,$split=','){
        $item_list_tmp = '';
        foreach ($itemList AS $item)
        {
            if ($item[$key] !== '')
            {
                $item_list_tmp .= $item_list_tmp ? "$split$item[$key]" : "$item[$key]";
            }
        }
        return $item_list_tmp;
    }
    
    
}
