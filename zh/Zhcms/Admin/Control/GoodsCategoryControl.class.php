<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class GoodsCategoryControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("GoodsCategory");
	}
    
	//商品类型一览
	public function index() {
        $cat_list=$this -> db->cat_list(0,0,false);
        //p($cat_list);die;
        $this->cat_info=$cat_list;
        $this -> display();
	}
    
    //添加
	public function add() {
        if (IS_POST) {
            $db_prefix=C("DB_PREFIX");
            /* 初始化变量 */
            $cat['cat_id']       = !empty($_POST['cat_id'])       ? intval($_POST['cat_id'])     : 0;
            $cat['parent_id']    = !empty($_POST['parent_id'])    ? intval($_POST['parent_id'])  : 0;
            $cat['sort_order']   = !empty($_POST['sort_order'])   ? intval($_POST['sort_order']) : 0;
            $cat['keywords']     = !empty($_POST['keywords'])     ? trim($_POST['keywords'])     : '';
            $cat['cat_desc']     = !empty($_POST['cat_desc'])     ? $_POST['cat_desc']           : '';
            $cat['measure_unit'] = !empty($_POST['measure_unit']) ? trim($_POST['measure_unit']) : '';
            $cat['cat_name']     = !empty($_POST['cat_name'])     ? trim($_POST['cat_name'])     : '';
            $cat['show_in_nav']  = !empty($_POST['show_in_nav'])  ? intval($_POST['show_in_nav']): 0;
            $cat['style']        = !empty($_POST['style'])        ? trim($_POST['style'])        : '';
            $cat['is_show']      = !empty($_POST['is_show'])      ? intval($_POST['is_show'])    : 0;
            $cat['grade']        = !empty($_POST['grade'])        ? intval($_POST['grade'])      : 0;
            $cat['filter_attr']  = !empty($_POST['filter_attr'])  ? implode(',', array_unique(array_diff($_POST['filter_attr'],array(0)))) : 0;
            $cat['cat_recommend']  = !empty($_POST['cat_recommend'])  ? $_POST['cat_recommend'] : array();
            if($this -> db ->cat_exists($cat['cat_name'],$cat['parent_id']))
            {
                $this -> error("同级别下不能有重复的分类名称！");
            }
            if($cat['grade'] > 10 || $cat['grade'] < 0)
            {
                $this -> error("价格区间数超过范围！");
            }
            /*$res=M()->getAll("SELECT recommend_type FROM zh_cat_recommend WHERE cat_id= 3");
            p($res);die;*/
            if($cat_id=$this -> db->insert($cat)){
                if($cat['show_in_nav'] == 1){
                    $vieworder = M()->getOne("SELECT max(vieworder) FROM ". $db_prefix.'nav' . " WHERE type = 'middle'",'max(vieworder)');
                    $vieworder += 2;
                    //显示在自定义导航栏中
                    $sql = "INSERT INTO " . $db_prefix.'nav' .
                            " (name,
                                ctype,
                                cid,
                                ifshow,
                                vieworder,
                                opennew,
                                url,
                                type)".
                            " VALUES('" . $cat['cat_name'] . "', 
                                    'c', 
                                    '".$cat_id."',
                                    '1',
                                    '$vieworder',
                                    '0', 
                                    '" . ec_build_uri('category', array('cid'=> $cat_id), $cat['cat_name']) . "',
                                    'middle')";
                    M()->exe($sql);
                }
                $catRecommendModel=K("CatRecommend");
                $catRecommendModel->insert_cat_recommend($cat['cat_recommend'], $cat_id);
                $adminLogModel=K("AdminLog");
                $adminLogModel->admin_log($_POST['cat_name'], '添加', '商品分类');
                $this -> success("添加成功！");
            }
            //echo 'aaa';die;
        }else{
            $attributeModel=K("Attribute");
            $goodsTypeModel=K("GoodsType");
            $cat_select=$this -> db->cat_list(0,0,true);
            $cat_info=array('is_show' => 1);
            $attr_list=$attributeModel->get_attr_list();
            $goods_type_list=$goodsTypeModel->goods_type_list(0);

            $this->cat_info=$cat_info;
            $this->cat_select=$cat_select;
            $this->attr_list=$attr_list;
            $this->goods_type_list=$goods_type_list;
            $this -> display();  
        }
	}
    
    //修改
    public function edit(){
        $attributeModel=K("Attribute");
        $goodsTypeModel=K("GoodsType");
        $catRecommendModel=K("CatRecommend");
        $adminLogModel=K("AdminLog");
        $db_prefix=C("DB_PREFIX");
        if (IS_POST) {
            
             /* 初始化变量 */
            $cat_id              = !empty($_POST['cat_id'])       ? intval($_POST['cat_id'])     : 0;
            $old_cat_name        = $_POST['old_cat_name'];
            $cat['parent_id']    = !empty($_POST['parent_id'])    ? intval($_POST['parent_id'])  : 0;
            $cat['sort_order']   = !empty($_POST['sort_order'])   ? intval($_POST['sort_order']) : 0;
            $cat['keywords']     = !empty($_POST['keywords'])     ? trim($_POST['keywords'])     : '';
            $cat['cat_desc']     = !empty($_POST['cat_desc'])     ? $_POST['cat_desc']           : '';
            $cat['measure_unit'] = !empty($_POST['measure_unit']) ? trim($_POST['measure_unit']) : '';
            $cat['cat_name']     = !empty($_POST['cat_name'])     ? trim($_POST['cat_name'])     : '';
            $cat['is_show']      = !empty($_POST['is_show'])      ? intval($_POST['is_show'])    : 0;
            $cat['show_in_nav']  = !empty($_POST['show_in_nav'])  ? intval($_POST['show_in_nav']): 0;
            $cat['style']        = !empty($_POST['style'])        ? trim($_POST['style'])        : '';
            $cat['grade']        = !empty($_POST['grade'])        ? intval($_POST['grade'])      : 0;
            $cat['filter_attr']  = !empty($_POST['filter_attr'])  ? implode(',', array_unique(array_diff($_POST['filter_attr'],array(0)))) : 0;
            $cat['cat_recommend']  = !empty($_POST['cat_recommend'])  ? $_POST['cat_recommend'] : array();
            /* 判断分类名是否重复 */
            if ($cat['cat_name'] != $old_cat_name)
            {
                if ($this -> db ->cat_exists($cat['cat_name'],$cat['parent_id'], $cat_id))
                {
                    $this -> error("同级别下不能有重复的分类名称！");
                }
            }
            /* 判断上级目录是否合法 */
            $children = array_keys($this -> db->cat_list($cat_id, 0, false));     // 获得当前分类的所有下级分类
            if (in_array($cat['parent_id'], $children))
            {
                $this -> error("上级目录不合法");
            }
            if($cat['grade'] > 10 || $cat['grade'] < 0)
            {
                /* 价格区间数超过范围 */
               $this -> error("价格区间数超过范围！");
            }
            $dat =$this->db->where(" cat_id = '$cat_id' ")->field(array('cat_name','show_in_nav'))->getRow();
            if( $this -> db->where(" cat_id = '$cat_id' ")->update($cat)){
                if($cat['cat_name'] != $dat['cat_name'])
                {
                    //如果分类名称发生了改变
                    $sql = "UPDATE " . $db_prefix.'nav' . " SET name = '" . $cat['cat_name'] . "' WHERE ctype = 'c' AND cid = '" . $cat_id . "' AND type = 'middle'";
                    M()->exe($sql);
                }
                if($cat['show_in_nav'] != $dat['show_in_nav'])
                {
                    //是否显示于导航栏发生了变化
                    if($cat['show_in_nav'] == 1)
                    {
                        //显示
                        $nid = M()->getOne("SELECT id FROM ". $db_prefix.'nav' . " WHERE ctype = 'c' AND cid = '" . $cat_id . "' AND type = 'middle'",'id');
                        if(empty($nid))
                        {
                            //不存在
                            $vieworder = M()->getOne("SELECT max(vieworder) FROM ". $db_prefix.'nav' . " WHERE type = 'middle'",'max(vieworder)');
                            $vieworder += 2;
                            $uri = ec_build_uri('category', array('cid'=> $cat_id), $cat['cat_name']);
                            $sql = "INSERT INTO " . $db_prefix.'nav' . 
                                    " (name,
                                        ctype,
                                        cid,
                                        ifshow,
                                        vieworder,
                                        opennew,
                                        url,
                                        type) VALUES('" . $cat['cat_name'] . "', 
                                                    'c', 
                                                    '$cat_id',
                                                    '1',
                                                    '$vieworder',
                                                    '0', 
                                                    '" . $uri . "',
                                                    'middle')";
                        }else{
                            $sql = "UPDATE " . $db_prefix.'nav' . 
                                    " SET ifshow = 1 
                                    WHERE 
                                        ctype = 'c' AND 
                                        cid = '" . $cat_id . "' AND 
                                        type = 'middle'";
                        }
                        M()->exe($sql);
                    }
                    else{
                        //去除
                        M()->exe("UPDATE " . $db_prefix.'nav' . " SET ifshow = 0 WHERE ctype = 'c' AND cid = '" . $cat_id . "' AND type = 'middle'");
                    }
                }
                //更新首页推荐
                $catRecommendModel->insert_cat_recommend($cat['cat_recommend'], $cat_id);
                $adminLogModel->admin_log($_POST['cat_name'], '修改', '商品分类');
                $this -> success("修改成功！");
            }else{
                $this -> error("修改失败");
            }
        }else{
            $cat_id = intval($_REQUEST['cat_id']);
            $cat_info = $this->db->where(" cat_id='$cat_id' ")->getRow();
            $attr_list = $attributeModel->get_attr_list();
            $filter_attr_list = array();
            if ($cat_info['filter_attr'])
            {
                $filter_attr = explode(",", $cat_info['filter_attr']);  //把多个筛选属性放到数组中
                foreach ($filter_attr AS $k => $v)
                {
                    $attr_cat_id = M()->getOne("SELECT cat_id FROM " . $db_prefix.'attribute' . " WHERE attr_id = '" . intval($v) . "'",'cat_id');
                    $filter_attr_list[$k]['goods_type_list'] = $goodsTypeModel->goods_type_list($attr_cat_id);  //取得每个属性的商品类型
                    $filter_attr_list[$k]['filter_attr'] = $v;
                    $attr_option = array();
        
                    foreach ($attr_list[$attr_cat_id] as $val)
                    {
                        $attr_option[key($val)] = current ($val);
                    }
        
                    $filter_attr_list[$k]['option'] = $attr_option;
                }
                $this->filter_attr_list=$filter_attr_list;
            }else
            {
                $attr_cat_id = 0;
            }
            //模板赋值 
            $this->attr_list=$attr_list;
            $this->attr_cat_id=$attr_cat_id;
            //分类是否存在首页推荐
            $res = M()->getAll("SELECT recommend_type FROM " . $db_prefix."cat_recommend" . " WHERE cat_id=" . $cat_id);
            if (!empty($res))
            {
                $cat_recommend = array();
                foreach($res as $data)
                {
                    $cat_recommend[$data['recommend_type']] = 1;
                }
                $this->cat_recommend=$cat_recommend;
            }
            $this->cat_info=$cat_info;
            $this->cat_select=$this -> db->cat_list(0,$cat_info['parent_id'],true);
            $this->goods_type_list=$goodsTypeModel->goods_type_list(0);
                  
    	    $this -> display();
        }
        
        
    }
   
    public function del(){
        $adminLogModel=K("AdminLog");
        $db_prefix=C("DB_PREFIX");
        /* 初始化分类ID并取得分类名称 */
        $cat_id   = Q('cat_id',0,'intval');
        $cat_name = M()->getOne('SELECT cat_name FROM ' .$db_prefix.'goods_category'. " WHERE cat_id='$cat_id'",'cat_name');
        /* 当前分类下是否有子分类 */
        $cat_count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'goods_category'. " WHERE parent_id='$cat_id'",'COUNT(*)');
        /* 当前分类下是否存在商品 */
        $goods_count = M()->getOne('SELECT COUNT(*) FROM ' .$db_prefix.'goods'. " WHERE cat_id='$cat_id'",'COUNT(*)');
        /* 如果不存在下级子分类和商品，则删除之 */
        if ($cat_count == 0 && $goods_count == 0){
            /* 删除分类 */
            $sql = 'DELETE FROM ' .$db_prefix.'goods_category'. " WHERE cat_id = '$cat_id'";
            if (M()->exe($sql)){
                M()->exe("DELETE FROM " . $db_prefix.'nav' . " WHERE ctype = 'c' AND cid = '" . $cat_id . "' AND type = 'middle'");
                $adminLogModel->admin_log($cat_name, '删除', '商品分类');
                $this -> success("删除成功！");
            }else{
                $this -> success("删除失败！");
            }
            
        }else{
            $this -> error("有下级菜单或者有商品存在");
        }
    } 
	
    public function add_category(){
        $parent_id = empty($_REQUEST['parent_id']) ? 0 : intval($_REQUEST['parent_id']);
        $category = empty($_REQUEST['cat']) ? '' : trim($_REQUEST['cat']);
        if($this -> db ->cat_exists($category,$parent_id))
        {
            make_json_error("分类已经存在");
        }
        else
        {
            $sql = "INSERT INTO " . $this -> db->tableFull . "(cat_name, parent_id, is_show)" .
               "VALUES ( '$category', '$parent_id', 1)";
            $category_id=M()->exe($sql);
            $arr = array("parent_id"=>$parent_id, "id"=>$category_id, "cat"=>$category);
            make_json_result($arr);
        }
    }
    
    
}
