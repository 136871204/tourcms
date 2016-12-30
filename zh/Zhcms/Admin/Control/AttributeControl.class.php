<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class AttributeControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Attribute");
	}
    
	//商品类型一览
	public function index() {
        $goods_type = Q("goods_type",0, "intval");
        $goods_type_model=K("GoodsType");
        $goods_type_list=$goods_type_model->goods_type_list($goods_type);
        $db_prefix=C('DB_PREFIX');
        
        $where = (!empty($goods_type)) ? " WHERE a.cat_id = '$goods_type' " : '';
        $sql = "SELECT COUNT(*) as count FROM " . $db_prefix.'attribute' . " AS a $where";
        $result=$this -> db->query($sql);
        $count = $result[0]['count'];
        $page = new Page($count);
		$this -> page = $page -> show();
        
        /* 查询 */
        $sql = "SELECT a.*, t.cat_name " .
            " FROM " . $db_prefix.'attribute'. " AS a ".
            " LEFT JOIN " . $db_prefix.'goods_type' . " AS t ON a.cat_id = t.cat_id " . $where .
            " LIMIT " .implode(",", $page -> limit());
        $result=$this -> db->query($sql);
        if(!empty($result)){
            $attr_input_type_arr=getAttrInputTypeArray();
            foreach ($result AS $key => $val)
            {
                $result[$key]['attr_input_type_desc'] = $attr_input_type_arr[$val['attr_input_type']];
                $result[$key]['attr_values']      = str_replace("\n", ", ", $val['attr_values']);
            }
        }
        
        
        $this -> goods_type_list_option_html = $goods_type_list;
        $this->result=$result;
        $this -> display();
	}
    
    //添加
	public function add() {
		if (IS_POST) {
		  
		  if(!$this -> db->is_only('attr_name',$_POST['attr_name'],0," cat_id = '$_POST[cat_id]'")){
		      $this -> error("属性名重复");
		  }
          $cat_id = $_REQUEST['cat_id'];
          /* 取得属性信息 */
            $attr = array(
                'cat_id'          => $_POST['cat_id'],
                'attr_name'       => $_POST['attr_name'],
                'attr_index'      => $_POST['attr_index'],
                'attr_input_type' => $_POST['attr_input_type'],
                'is_linked'       => $_POST['is_linked'],
                'attr_values'     => isset($_POST['attr_values']) ? $_POST['attr_values'] : '',
                'attr_type'       => empty($_POST['attr_type']) ? '0' : intval($_POST['attr_type']),
                'attr_group'      => isset($_POST['attr_group']) ? intval($_POST['attr_group']) : 0
            );
          if( $this -> db->insert($attr)){
            $adminLogModel=K("AdminLog");
            $adminLogModel->admin_log($_POST['attr_name'],"添加","属性(attgribute)");
            $this -> success("添加成功！");
          }else{
            $this -> error("添加失败");
          }
		} else {
		    $goodsTypeModel = K("GoodsType");
            $goods_type = isset($_GET['goods_type']) ? intval($_GET['goods_type']) : 0;
            $attr = array(
                'attr_id' => 0,
                'cat_id' => $goods_type,
                'attr_name' => '',
                'attr_input_type' => 0,
                'attr_index'  => 0,
                'attr_values' => '',
                'attr_type' => 0,
                'is_linked' => 0,
            );
            $this->attr=$attr;
            $this->attr_groups=$goodsTypeModel->get_attr_groups($attr['cat_id']);

		    /* 取得商品分类列表 */
            $this->goods_type_list=$goodsTypeModel->goods_type_list($attr['cat_id']);
			$this -> display();
		}
	}
    
    public function getAttrGroups(){
        $goodsTypeModel = K("GoodsType");
        $cat_id = intval($_GET['cat_id']);
        
        $groups = $goodsTypeModel->get_attr_groups($cat_id);
        $this -> ajax($groups);
    }
    
    //修改
    public function edit(){
        if (IS_POST) {
            /* 检查名称是否重复 */
            $exclude = empty($_POST['attr_id']) ? 0 : intval($_POST['attr_id']);
            if(!$this -> db->is_only('attr_name',$_POST['attr_name'],$exclude," cat_id = '$_POST[cat_id]'")){
		      $this -> error("属性名重复");
            }
              $cat_id = $_REQUEST['cat_id'];
              /* 取得属性信息 */
                $attr = array(
                    'cat_id'          => $_POST['cat_id'],
                    'attr_name'       => $_POST['attr_name'],
                    'attr_index'      => $_POST['attr_index'],
                    'attr_input_type' => $_POST['attr_input_type'],
                    'is_linked'       => $_POST['is_linked'],
                    'attr_values'     => isset($_POST['attr_values']) ? $_POST['attr_values'] : '',
                    'attr_type'       => empty($_POST['attr_type']) ? '0' : intval($_POST['attr_type']),
                    'attr_group'      => isset($_POST['attr_group']) ? intval($_POST['attr_group']) : 0
                );
              if( $this -> db->where("attr_id = '$_POST[attr_id]'")->update($attr)){
                $adminLogModel=K("AdminLog");
                $adminLogModel->admin_log($_POST['attr_name'],"修改","属性(attgribute)");
                $this -> success("修改成功！");
              }else{
                $this -> error("修改失败");
              }
		} else {
		      $goodsTypeModel = K("GoodsType");
             $attr = $this->db->where("attr_id = '$_REQUEST[attr_id]'")->getRow();
             $this->attr=$attr;
             $this->attr_groups=$goodsTypeModel->get_attr_groups($attr['cat_id']);
		     /* 取得商品分类列表 */
             $this->goods_type_list=$goodsTypeModel->goods_type_list($attr['cat_id']);
		      $this -> display();
		}
    }
    
    public function del(){
        $id =Q('id',0,'intval');
        if($this->db->where(" attr_id='$id'")->del()){
            //TODO:goods_attr 删除数据未有完成
            $this -> success("删除成功");
        }else{
            $this -> error("删除失败");
        }
        
    }
   

	
    
    
}
