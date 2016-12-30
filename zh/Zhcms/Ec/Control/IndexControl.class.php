<?php

/**
 * 网站前台
 * Class IndexControl
 * @author 周鸿 <136871204@qq.com>
 */
class IndexControl extends PublicControl {
	//网站首页
	public function index() {
	   $db_prefix=C('DB_PREFIX');
       //TODO:之后调整
        $_SESSION['user_id']     = 0;
            $_SESSION['user_name']   = '';
            $_SESSION['email']       = '';
            $_SESSION['user_rank']   = 0;
            $_SESSION['discount']    = 1.00;
       
       //
       
	   $goodsCategoryModel=K("GoodsCategory");
       $goodsModel=K("Goods");
	   if (isset($_SESSION['uid']) && $_SESSION['uid']> 0)
        {
            echo 'TODO:get_user_info没有测试到';
           $this->assign('user_info', get_user_info());
        }
        $this->assign('navigator_list',        get_navigator());
        $this->assign('category_list', $goodsCategoryModel->cat_list(0, 0, true,  2, false));
        
        $searchkeywords = array();
        $this->assign('searchkeywords', $searchkeywords);
        
        $this->assign('categories',     $goodsCategoryModel->get_categories_tree()); // 分类树
        $this->assign('top_goods',       $goodsModel->get_top10());           // 销售排行
        $this->assign('promotion_info',  get_promotion_info()); // 增加一个动态显示所有促销信息的标签栏
        $this->assign('invoice_list',    $this->index_get_invoice_query());  // 发货查询
        $this->assign('new_articles',    $this->index_get_new_articles());   // 最新文章
        //$smarty->assign('promotion_goods', get_promote_goods()); // 特价商品
        $this->assign('brand_list',      get_brands());
        $this->assign('shop_notice',     C('ec_shop_notice'));       // 商店公告
         
         /* 首页主广告设置 */
        $this->assign('index_ad',     C('ec_index_ad'));
         if (C('ec_index_ad') == 'cus')
         {
            $sql = 'SELECT ad_type, content, url FROM ' . $db_prefix."ad_custom" . ' WHERE ad_status = 1';
            $ad = M()->getRowSql($sql, true);
            $this->assign('ad', $ad);
         }
         define('SESS_ID', session_id());


       $this->display();
	}
    /**
     * 获得最新的文章列表。
     *
     * @access  private
     * @return  array
     */
    public function index_get_new_articles()
    {
        $db_prefix=C('DB_PREFIX');
        $sql = 'SELECT 
                    a.article_id, a.title, ac.cat_name, a.add_time, a.file_url, a.open_type, ac.cat_id, ac.cat_name ' .
            ' FROM ' . $db_prefix.'article' . ' AS a, ' .
                $db_prefix.'article_cat' . ' AS ac' .
            ' WHERE 
                a.is_open = 1 AND 
                a.cat_id = ac.cat_id AND 
                ac.cat_type = 1' .
            ' ORDER BY a.article_type DESC, a.add_time DESC LIMIT ' . C('ec_article_number');
        $res = M()->getAll($sql);
        $arr = array();
        if(!empty($res)){
            foreach ($res AS $idx => $row)
            {
                
                $arr[$idx]['id']          = $row['article_id'];
                $arr[$idx]['title']       = $row['title'];
                $arr[$idx]['short_title'] = C('ec_article_title_length') > 0 ?
                                                sub_str($row['title'], C('ec_article_title_length')) : $row['title'];
                $arr[$idx]['cat_name']    = $row['cat_name'];
                $arr[$idx]['add_time']    = local_date(C('ec_date_format'), $row['add_time']);
                $arr[$idx]['url']         = $row['open_type'] != 1 ?
                                                ec_build_uri('article', array('aid' => $row['article_id']), $row['title']) : trim($row['file_url']);
                $arr[$idx]['cat_url']     = ec_build_uri('article_cat', array('acid' => $row['cat_id']), $row['cat_name']);
            }
        }
        
    
        return $arr;
    }
    
    /**
     * 调用发货单查询
     *
     * @access  private
     * @return  array
     */
    public function index_get_invoice_query()
    {
        $db_prefix=C('DB_PREFIX');
        $sql = 'SELECT 
                    o.order_sn, o.invoice_no, s.shipping_code 
                FROM ' . $db_prefix.'order_info' . ' AS o' .
            ' LEFT JOIN ' . $db_prefix.'shipping' . ' AS s ON s.shipping_id = o.shipping_id' .
            " WHERE invoice_no > '' AND shipping_status = " . SS_SHIPPED .
            ' ORDER BY shipping_time DESC LIMIT 10';
        $all = M()->getAll($sql);
        
        if(!empty($all))
        {
            foreach ($all AS $key => $row)
            {
                $plugin = ROOT_PATH . 'includes/modules/shipping/' . $row['shipping_code'] . '.php';
        
                if (file_exists($plugin))
                {
                    include_once($plugin);
        
                    $shipping = new $row['shipping_code'];
                    $all[$key]['invoice_no'] = $shipping->query((string)$row['invoice_no']);
                }
            }
        }
        return $all;
    }
	
}
