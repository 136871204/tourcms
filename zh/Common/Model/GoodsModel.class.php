<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class GoodsModel extends ViewModel {
    public $table = "goods";
    
    /**
     * 取得推荐类型列表
     * @return  array   推荐类型列表
     */
    public function get_intro_list()
    {
        return array(
            'is_best'    => '精品',
            'is_new'     => '新品',
            'is_hot'     => '热销',
            'is_promote' => '特价',
            'all_type' => '全部推荐',
        );
    }
    
    /**
     * 取得重量单位列表
     * @return  array   重量单位列表
     */
    public function get_unit_list()
    {
        return array(
            '1'     => '千克',
            '0.001' => '克',
        );
    }
    
    
    /**
     * 获得促销商品
     *
     * @access  public
     * @return  array
     */
    function get_promote_goods($cats = '')
    {
        $db_prefix=C("DB_PREFIX");
        $time = gmtime();
        $order_type = C('recommend_order');
        echo __FILE__.'---'.__METHOD__;
        /* 取得促销lbi的数量限制 */
        //$num = get_library_number("recommend_promotion");
    }
    
    
    
    /**
     * 调用当前分类的销售排行榜
     *
     * @access  public
     * @param   string  $cats   查询的分类
     * @return  array
     */
    public function get_top10($cats = '')
    {
        $db_prefix=C("DB_PREFIX");
        $goodsCatModel=K("GoodsCat");
        $cats = get_children($cats);
        $where = !empty($cats) ? "AND ($cats OR " . $goodsCatModel->get_extension_goods($cats) . ") " : '';
        
        /* 排行统计的时间 */
        switch (C('ec_top10_time'))
        {
            case 1: // 一年
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 365 * 86400) . "'";
            break;
            case 2: // 半年
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 180 * 86400) . "'";
            break;
            case 3: // 三个月
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 90 * 86400) . "'";
            break;
            case 4: // 一个月
                $top10_time = "AND o.order_sn >= '" . date('Ymd', gmtime() - 30 * 86400) . "'";
            break;
            default:
                $top10_time = '';
        }
        $sql = 'SELECT 
                g.goods_id, g.goods_name, g.shop_price, g.goods_thumb, 
                SUM(og.goods_number) as goods_number ' .
                'FROM ' . $db_prefix.'goods' . ' AS g, ' .
                    $db_prefix.'order_info' . ' AS o, ' .
                    $db_prefix.'order_goods' . ' AS og ' .
           "WHERE 
                g.is_on_sale = 1 AND 
                g.is_alone_sale = 1 AND 
                g.is_delete = 0 
                $where $top10_time " ;
        //is_alone_sale 是否能单独销售，1，是；0，否；如果不能单独销售，则只能作为某商品的配件或者赠品销售
        //判断是否启用库存，库存数量是否大于0
        if (C('use_storage') == 1)
        {
            $sql .= " AND g.goods_number > 0 ";
        }
        $sql .= ' AND 
                    og.order_id = o.order_id AND 
                    og.goods_id = g.goods_id ' .
                    "AND 
                    (o.order_status = '" . OS_CONFIRMED .  "' OR o.order_status = '" . OS_SPLITED . "') " .
                    "AND 
                    (o.pay_status = '" . PS_PAYED . "' OR o.pay_status = '" . PS_PAYING . "') " .
                    "AND 
                    (o.shipping_status = '" . SS_SHIPPED . "' OR o.shipping_status = '" . SS_RECEIVED . "') " .
                    'GROUP BY 
                        g.goods_id 
                    ORDER BY 
                        goods_number DESC, g.goods_id DESC 
                    LIMIT ' . C('ec_top_number');
        $arr = M()->getAll($sql);
        for ($i = 0, $count = count($arr); $i < $count; $i++)
        {
            $arr[$i]['short_name'] = C('ec_goods_name_length') > 0 ?
                                        ec_sub_str($arr[$i]['goods_name'],  C('ec_goods_name_length')) : $arr[$i]['goods_name'];
            $arr[$i]['url']        = ec_build_uri('goods', array('gid' => $arr[$i]['goods_id']), $arr[$i]['goods_name']);
            $arr[$i]['thumb'] = get_image_path($arr[$i]['goods_id'], $arr[$i]['goods_thumb'],true);
            $arr[$i]['price'] = price_format($arr[$i]['shop_price']);
        }

        return $arr;
    }
        

    
    /**
     * 获得商品已添加的规格列表
     *
     * @access      public
     * @params      integer         $goods_id
     * @return      array
     */
    public function get_goods_specifications_list($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        if (empty($goods_id))
        {
            return array();  //$goods_id不能为空
        }
    
        $sql = "SELECT g.goods_attr_id, g.attr_value, g.attr_id, a.attr_name
                FROM " . $db_prefix.'goods_attr' . " AS g
                    LEFT JOIN " . $db_prefix.'attribute' . " AS a
                        ON a.attr_id = g.attr_id
                WHERE goods_id = '$goods_id'
                AND a.attr_type = 1
                ORDER BY g.attr_id ASC";
        $results = M()->getAll($sql);
    
        return $results;
    }

    
    
     /**
     * 检查单个商品是否存在规格
     *
     * @param   int        $goods_id          商品id
     * @return  bool                          true，存在；false，不存在
     */
    function check_goods_specifications_exist($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        $goods_id = intval($goods_id);
    
        $sql = "SELECT COUNT(a.attr_id)
                FROM " .$db_prefix.'attribute'. " AS a, " .$db_prefix.'goods'. " AS g
                WHERE a.cat_id = g.goods_type
                AND g.goods_id = '$goods_id'";
    
        $count = M()->getOne($sql,'COUNT(a.attr_id)');
    
        if ($count > 0)
        {
            return true;    //存在
        }
        else
        {
            return false;    //不存在
        }
    }
    
    
    /**
     * 保存某商品的相册图片
     * @param   int     $goods_id
     * @param   array   $image_files
     * @param   array   $image_descs
     * @return  void
     */
    function handle_gallery_image($goods_id, $image_files, $image_descs, $image_urls)
    {
        $db_prefix=C("DB_PREFIX");
        $image = new EcImage(C('bgcolor'));
        /* 是否处理缩略图 */
        $proc_thumb = (isset($GLOBALS['shop_id']) && $GLOBALS['shop_id'] > 0)? false : true;
        //p($image_files);die;
        foreach ($image_descs AS $key => $img_desc)
        {
            /* 是否成功上传 */
            $flag = false;
            if (isset($image_files['error']))
            {
                if ($image_files['error'][$key] == 0)
                {
                    $flag = true;
                }
            }else{
                if ($image_files['tmp_name'][$key] != 'none')
                {
                    $flag = true;
                }
            }
            if ($flag)
            {
                // 生成缩略图
                if ($proc_thumb)
                {
                    $thumb_url = $image->make_thumb($image_files['tmp_name'][$key], C('ec_image_width'), C('ec_image_height'));
                    $thumb_url = is_string($thumb_url) ? $thumb_url : '';
                }
                $upload = array(
                    'name' => $image_files['name'][$key],
                    'type' => $image_files['type'][$key],
                    'tmp_name' => $image_files['tmp_name'][$key],
                    'size' => $image_files['size'][$key],
                );
                if (isset($image_files['error']))
                {
                    $upload['error'] = $image_files['error'][$key];
                }
                $img_original = $image->upload_image($upload);
                if ($img_original === false)
                {
                    return $image->error_msg();
                }
                $img_url = $img_original;
                if (!$proc_thumb)
                {
                    $thumb_url = $img_original;
                }
                // 如果服务器支持GD 则添加水印
                if ($proc_thumb && gd_version() > 0){
                    $pos        = strpos(basename($img_original), '.');
                    $newname    = dirname($img_original) . '/' . $image->random_filename() . substr(basename($img_original), $pos);
                    copy(ROOT_PATH . $img_original, ROOT_PATH . $newname);
                    $img_url    = $newname;

                    $image->add_watermark(ROOT_PATH.$img_url,'',ROOT_PATH.C('ec_watermark'), C('ec_watermark_place'), C('ec_watermark_alpha'));
                }
                /* 重新格式化图片名称 */
                $img_original = $this->reformat_image_name('gallery', $goods_id, $img_original, 'source');
                $img_url = $this->reformat_image_name('gallery', $goods_id, $img_url, 'goods');
                $thumb_url = $this->reformat_image_name('gallery_thumb', $goods_id, $thumb_url, 'thumb');
                $sql = "INSERT INTO " . $db_prefix.'goods_gallery' . " 
                (goods_id, img_url, img_desc, thumb_url, img_original) " .
                    "VALUES ('$goods_id', '$img_url', '$img_desc', '$thumb_url', '$img_original')";
                    //echo $sql.'<br/>';
                M()->exe($sql);
                /* 不保留商品原图的时候删除原图 */
                if ($proc_thumb && !C('ec_retain_original_img')&& !empty($img_original))
                {
                    M()->exe("UPDATE " . $db_prefix.'goods_gallery' . " SET img_original='' WHERE `goods_id`='{$goods_id}'");
                    @unlink('../' . $img_original);
                }
            }else if (
                    !empty($image_urls[$key]) && 
                    ($image_urls[$key] != '或者输入外部图片链接地址') && 
                    ($image_urls[$key] != 'http://') && 
                    copy(trim($image_urls[$key]), ROOT_PATH . 'temp/' . basename($image_urls[$key]))
                    )
            {
                $image_url = trim($image_urls[$key]);
                //定义原图路径
                $down_img = ROOT_PATH . 'temp/' . basename($image_url);
                // 生成缩略图
                if ($proc_thumb)
                {
                    $thumb_url = $image->make_thumb($down_img, C('ec_image_width'), C('ec_image_height'));
                    $thumb_url = is_string($thumb_url) ? $thumb_url : '';
                    $thumb_url = $this->reformat_image_name('gallery_thumb', $goods_id, $thumb_url, 'thumb');
                }
                if (!$proc_thumb)
                {
                    $thumb_url = htmlspecialchars($image_url);
                }
                /* 重新格式化图片名称 */
                $img_url = $img_original = htmlspecialchars($image_url);
                $sql = "INSERT INTO " . $db_prefix.'goods_gallery' . " 
                    (goods_id, img_url, img_desc, thumb_url, img_original) " .
                        "VALUES ('$goods_id', '$img_url', '$img_desc', '$thumb_url', '$img_original')";
                M()->exe($sql);
    
                @unlink($down_img);
            }
        }
    }
    
    
    /**
     * 格式化商品图片名称（按目录存储）
     *
     */
    public function reformat_image_name($type, $goods_id, $source_img, $position='')
    {
        $rand_name = gmtime() . sprintf("%03d", mt_rand(1,999));
        $img_ext = substr($source_img, strrpos($source_img, '.'));
        $dir = 'images';
        if (defined('EC_IMAGE_DIR'))
        {
            $dir = EC_IMAGE_DIR;
        }
        $sub_dir = date('Ym', gmtime());
        if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir))
        {
            return false;
        }
        if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/source_img'))
        {
            return false;
        }
        if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/goods_img'))
        {
            return false;
        }
        if (!make_dir(ROOT_PATH.$dir.'/'.$sub_dir.'/thumb_img'))
        {
            return false;
        }
        switch($type)
        {
            case 'goods':
                $img_name = $goods_id . '_G_' . $rand_name;
                break;
            case 'goods_thumb':
                $img_name = $goods_id . '_thumb_G_' . $rand_name;
                break;
            case 'gallery':
                $img_name = $goods_id . '_P_' . $rand_name;
                break;
            case 'gallery_thumb':
                $img_name = $goods_id . '_thumb_P_' . $rand_name;
                break;
        }
        if ($position == 'source')
        {
            if ($this->move_image_file(ROOT_PATH.$source_img, ROOT_PATH.$dir.'/'.$sub_dir.'/source_img/'.$img_name.$img_ext))
            {
                return $dir.'/'.$sub_dir.'/source_img/'.$img_name.$img_ext;
            }
        }
        elseif ($position == 'thumb')
        {
            if ($this->move_image_file(ROOT_PATH.$source_img, ROOT_PATH.$dir.'/'.$sub_dir.'/thumb_img/'.$img_name.$img_ext))
            {
                return $dir.'/'.$sub_dir.'/thumb_img/'.$img_name.$img_ext;
            }
        }
        else
        {
            if ($this->move_image_file(ROOT_PATH.$source_img, ROOT_PATH.$dir.'/'.$sub_dir.'/goods_img/'.$img_name.$img_ext))
            {
                return $dir.'/'.$sub_dir.'/goods_img/'.$img_name.$img_ext;
            }
        }
        return false;
    }
    
    
    public function move_image_file($source, $dest)
    {
        if($source==ROOT_PATH){
            return ;
        }
        if (@copy($source, $dest))
        {
            @unlink($source);
            return true;
        }
        return false;
    }

    
    /**
     * 为某商品生成唯一的货号
     * @param   int     $goods_id   商品编号
     * @return  string  唯一的货号
     */
    function generate_goods_sn($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        $goods_sn = C('ec_sn_prefix') . str_repeat('0', 6 - strlen($goods_id)) . $goods_id;
    
        $sql = "SELECT goods_sn FROM " . $db_prefix.'goods' .
                " WHERE goods_sn LIKE '" . mysql_like_quote($goods_sn) . "%' AND goods_id <> '$goods_id' " .
                " ORDER BY LENGTH(goods_sn) DESC";
               // echo $sql;die;
        $sn_list = M()->getCol($sql,'goods_sn');
        if(!empty($sn_list)){
            if (in_array($goods_sn, $sn_list))
            {
                $max = pow(10, strlen($sn_list[0]) - strlen($goods_sn) + 1) - 1;
                $new_sn = $goods_sn . mt_rand(0, $max);
                while (in_array($new_sn, $sn_list))
                {
                    $new_sn = $goods_sn . mt_rand(0, $max);
                }
                $goods_sn = $new_sn;
            }
        }
        
    
        return $goods_sn;
    }
        
    
    /**
     * 获得商品的关联文章
     *
     * @access  public
     * @param   integer $goods_id
     * @return  array
     */
    public function get_goods_articles($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "SELECT g.article_id, a.title " .
                "FROM " .$db_prefix.'goods_article' . " AS g, " .
                    $db_prefix.'article' . " AS a " .
                "WHERE g.goods_id = '$goods_id' " .
                "AND g.article_id = a.article_id ";
        if ($goods_id == 0)
        {
            $sql .= " AND g.admin_id = '$_SESSION[uid]'";
        }
        $row =  M()->getAll($sql);
    
        return $row;
    }
    
    /**
     * 获得指定商品的配件
     *
     * @access  public
     * @param   integer $goods_id
     * @return  array
     */
    public function get_group_goods($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "SELECT gg.goods_id, CONCAT(g.goods_name, ' -- [', gg.goods_price, ']') AS goods_name " .
                "FROM " . $db_prefix.'group_goods' . " AS gg, " .
                    $db_prefix.'goods' . " AS g " .
                "WHERE gg.parent_id = '$goods_id' " .
                "AND gg.goods_id = g.goods_id ";
        if ($goods_id == 0)
        {
            $sql .= " AND gg.admin_id = '$_SESSION[uid]'";
        }
        $row = M()->getAll($sql);
    
        return $row;
    }

    
    /**
     * 获得指定商品相关的商品
     *
     * @access  public
     * @param   integer $goods_id
     * @return  array
     */
    public function get_linked_goods($goods_id)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "SELECT 
                    lg.link_goods_id AS goods_id, 
                    g.goods_name, 
                    lg.is_double " .
                "FROM " . $db_prefix.'link_goods' . " AS lg, " .
                    $db_prefix.'goods' . " AS g " .
                "WHERE lg.goods_id = '$goods_id' " .
                "AND lg.link_goods_id = g.goods_id ";
        if ($goods_id == 0)
        {
            $sql .= " AND lg.admin_id = '$_SESSION[uid]'";
        }
        $row = M()->getAll($sql);
        if(!empty($row)){
            foreach ($row AS $key => $val)
            {
                $linked_type = $val['is_double'] == 0 ? '单向关联' : '双向关联';
        
                $row[$key]['goods_name'] = $val['goods_name'] . " -- [$linked_type]";
        
                unset($row[$key]['is_double']);
            }
        }
        
    
        return $row;
    }

    

    
    /**
     * 获得商品列表
     *
     * @access  public
     * @params  integer $isdelete
     * @params  integer $real_goods
     * @params  integer $conditions
     * @return  array
     */
    public function goods_list($is_delete, $real_goods=1, $conditions = '')
    {
        /* 过滤条件 */
        $param_str = '-' . $is_delete . '-' . $real_goods;
        $result = false;
        if ($result === false)
        {
            $day = getdate();
            $today = local_mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']);
            
            $filter['cat_id']           = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
            $filter['intro_type']       = empty($_REQUEST['intro_type']) ? '' : trim($_REQUEST['intro_type']);
            $filter['is_promote']       = empty($_REQUEST['is_promote']) ? 0 : intval($_REQUEST['is_promote']);
            $filter['stock_warning']    = empty($_REQUEST['stock_warning']) ? 0 : intval($_REQUEST['stock_warning']);
            $filter['brand_id']         = empty($_REQUEST['brand_id']) ? 0 : intval($_REQUEST['brand_id']);
            $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
            $filter['suppliers_id'] = isset($_REQUEST['suppliers_id']) ? (empty($_REQUEST['suppliers_id']) ? '' : trim($_REQUEST['suppliers_id'])) : '';
            $filter['is_on_sale'] = isset($_REQUEST['is_on_sale']) ? ((empty($_REQUEST['is_on_sale']) && $_REQUEST['is_on_sale'] === 0) ? '' : trim($_REQUEST['is_on_sale'])) : '';
            if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
            {
                $filter['keyword'] = json_str_iconv($filter['keyword']);
            }
            $filter['sort_by']          = empty($_REQUEST['sort_by']) ? 'goods_id' : trim($_REQUEST['sort_by']);
            $filter['sort_order']       = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
            $filter['extension_code']   = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
            $filter['is_delete']        = $is_delete;
            $filter['real_goods']       = $real_goods;
   
            $where = $filter['cat_id'] > 0 ? " AND " . get_children($filter['cat_id']) : '';
            
            /* 推荐类型 */
            switch ($filter['intro_type'])
            {
                case 'is_best':
                    $where .= " AND is_best=1";
                    break;
                case 'is_hot':
                    $where .= ' AND is_hot=1';
                    break;
                case 'is_new':
                    $where .= ' AND is_new=1';
                    break;
                case 'is_promote':
                    $where .= " AND is_promote = 1 AND promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today'";
                    break;
                case 'all_type';
                    $where .= " AND (is_best=1 OR is_hot=1 OR is_new=1 OR (is_promote = 1 AND promote_price > 0 AND promote_start_date <= '" . $today . "' AND promote_end_date >= '" . $today . "'))";
            }
    
            /* 库存警告 */
            if ($filter['stock_warning'])
            {
                $where .= ' AND goods_number <= warn_number ';
            }
    
            /* 品牌 */
            if ($filter['brand_id'])
            {
                $where .= " AND brand_id='$filter[brand_id]'";
            }
    
            /* 扩展 */
            if ($filter['extension_code'])
            {
                $where .= " AND extension_code='$filter[extension_code]'";
            }
    
            /* 关键字 */
            if (!empty($filter['keyword']))
            {
                $where .= " AND (goods_sn LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR goods_name LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
            }
    
            if ($real_goods > -1)
            {
                $where .= " AND is_real='$real_goods'";
            }
    
            /* 上架 */
            if ($filter['is_on_sale'] !== '')
            {
                $where .= " AND (is_on_sale = '" . $filter['is_on_sale'] . "')";
            }
    
            /* 供货商 */
            if (!empty($filter['suppliers_id']))
            {
                $where .= " AND (suppliers_id = '" . $filter['suppliers_id'] . "')";
            }
    
            $where .= $conditions;
    
            /* 记录总数 */
            $sql = "SELECT COUNT(*) FROM " .$this->tableFull. " AS g WHERE is_delete='$is_delete' $where";
            //echo $sql;die;
            $filter['record_count'] = M()->getOne($sql,'COUNT(*)');
            //echo 'aaa';die;
            /* 分页大小 */
            $filter = page_and_size($filter);
            //p($filter);die;
            $sql = "SELECT goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, sort_order, goods_number, integral, " .
                        " (promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today') AS is_promote ".
                        " FROM " . $this->tableFull . " AS g WHERE is_delete='$is_delete' $where" .
                        " ORDER BY $filter[sort_by] $filter[sort_order] ".
                        " LIMIT " . $filter['start'] . ",$filter[page_size]";
            //echo $sql;
            $filter['keyword'] = stripslashes($filter['keyword']);
            //set_filter($filter, $sql, $param_str);
        }
        else
        {
            $sql    = $result['sql'];
            $filter = $result['filter'];
        }
        $row = M()->getAll($sql);
    
        return array('goods' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
    }

    /**
     * 获得商品列表
     *
     * @access  public
     * @params  integer $isdelete
     * @params  integer $real_goods
     * @params  integer $conditions
     * @return  array
     */
    public function goods_list_condition($is_delete, $real_goods=1, $conditions = '')
    {
            $day = getdate();
            $today = local_mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']);
            
            $filter['cat_id']           = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
            $filter['intro_type']       = empty($_REQUEST['intro_type']) ? '' : trim($_REQUEST['intro_type']);
            $filter['is_promote']       = empty($_REQUEST['is_promote']) ? 0 : intval($_REQUEST['is_promote']);
            $filter['stock_warning']    = empty($_REQUEST['stock_warning']) ? 0 : intval($_REQUEST['stock_warning']);
            $filter['brand_id']         = empty($_REQUEST['brand_id']) ? 0 : intval($_REQUEST['brand_id']);
            $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
            $filter['suppliers_id'] = isset($_REQUEST['suppliers_id']) ? (empty($_REQUEST['suppliers_id']) ? '' : trim($_REQUEST['suppliers_id'])) : '';
            $filter['is_on_sale'] = isset($_REQUEST['is_on_sale']) ? ((empty($_REQUEST['is_on_sale']) && $_REQUEST['is_on_sale'] === 0) ? '' : trim($_REQUEST['is_on_sale'])) : '';
            if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1)
            {
                $filter['keyword'] = json_str_iconv($filter['keyword']);
            }
            $filter['sort_by']          = empty($_REQUEST['sort_by']) ? 'goods_id' : trim($_REQUEST['sort_by']);
            $filter['sort_order']       = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
            $filter['extension_code']   = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
            $filter['is_delete']        = $is_delete;
            $filter['real_goods']       = $real_goods;
   
            $where = $filter['cat_id'] > 0 ? " AND " . get_children($filter['cat_id']) : '';
            
            /* 推荐类型 */
            switch ($filter['intro_type'])
            {
                case 'is_best':
                    $where .= " AND is_best=1";
                    break;
                case 'is_hot':
                    $where .= ' AND is_hot=1';
                    break;
                case 'is_new':
                    $where .= ' AND is_new=1';
                    break;
                case 'is_promote':
                    $where .= " AND is_promote = 1 AND promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today'";
                    break;
                case 'all_type';
                    $where .= " AND (is_best=1 OR is_hot=1 OR is_new=1 OR (is_promote = 1 AND promote_price > 0 AND promote_start_date <= '" . $today . "' AND promote_end_date >= '" . $today . "'))";
            }
    
            /* 库存警告 */
            if ($filter['stock_warning'])
            {
                $where .= ' AND goods_number <= warn_number ';
            }
    
            /* 品牌 */
            if ($filter['brand_id'])
            {
                $where .= " AND brand_id='$filter[brand_id]'";
            }
    
            /* 扩展 */
            if ($filter['extension_code'])
            {
                $where .= " AND extension_code='$filter[extension_code]'";
            }
    
            /* 关键字 */
            if (!empty($filter['keyword']))
            {
                $where .= " AND (goods_sn LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR goods_name LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
            }
    
            if ($real_goods > -1)
            {
                $where .= " AND is_real='$real_goods'";
            }
    
            /* 上架 */
            if ($filter['is_on_sale'] !== '')
            {
                $where .= " AND (is_on_sale = '" . $filter['is_on_sale'] . "')";
            }
    
            /* 供货商 */
            if (!empty($filter['suppliers_id']))
            {
                $where .= " AND (suppliers_id = '" . $filter['suppliers_id'] . "')";
            }
    
            $where .= $conditions;
            return $where;
        
    }
    
    /**
     * 根据属性数组创建属性的表单
     *
     * @access  public
     * @param   int     $cat_id     分类编号
     * @param   int     $goods_id   商品编号
     * @return  string
     */
    public function build_attr_html($cat_id, $goods_id = 0)
    {
        $attr = $this->get_attr_list($cat_id, $goods_id);
        $html = '<table width="100%" id="attrTable">';
        $spec = 0;
    
        foreach ($attr AS $key => $val)
        {
            $html .= "<tr><td class='label w150'>";
            if ($val['attr_type'] == 1 || $val['attr_type'] == 2)
            {
                $html .= ($spec != $val['attr_id']) ?
                    "<a href='javascript:;' onclick='addSpec(this)'>[+]</a>" :
                    "<a href='javascript:;' onclick='removeSpec(this)'>[-]</a>";
                $spec = $val['attr_id'];
            }
            $html .= "$val[attr_name]</td><td><input type='hidden' name='attr_id_list[]' value='$val[attr_id]' />";
            if ($val['attr_input_type'] == 0)
            {
                $html .= '<input name="attr_value_list[]" type="text" value="' .htmlspecialchars($val['attr_value']). '" size="40" /> ';
            }
            elseif ($val['attr_input_type'] == 2)
            {
                $html .= '<textarea name="attr_value_list[]" rows="3" cols="40">' .htmlspecialchars($val['attr_value']). '</textarea>';
            }
            else
            {
                $html .= '<select name="attr_value_list[]">';
                $html .= '<option value="">' .'请选择'. '</option>';
    
                $attr_values = explode("\n", $val['attr_values']);
    
                foreach ($attr_values AS $opt)
                {
                    $opt    = trim(htmlspecialchars($opt));
    
                    $html   .= ($val['attr_value'] != $opt) ?
                        '<option value="' . $opt . '">' . $opt . '</option>' :
                        '<option value="' . $opt . '" selected="selected">' . $opt . '</option>';
                }
                $html .= '</select> ';
            }
            $html .= ($val['attr_type'] == 1 || $val['attr_type'] == 2) ?
            '属性价格'.' <input type="text" name="attr_price_list[]" value="' . $val['attr_price'] . '" size="5" maxlength="10" />' :
            ' <input type="hidden" name="attr_price_list[]" value="0" />';

            $html .= '</td></tr>';
        }
        $html .= '</table>';
        return $html;
    }
        
    /**
     * 取得通用属性和某分类的属性，以及某商品的属性值
     * @param   int     $cat_id     分类编号
     * @param   int     $goods_id   商品编号
     * @return  array   规格与属性列表
     */
    public function get_attr_list($cat_id, $goods_id = 0)
    {
        $db_prefix=C('DB_PREFIX');
        if (empty($cat_id))
        {
            return array();
        }
    
        // 查询属性值及商品的属性值
        $sql = "SELECT a.attr_id, a.attr_name, a.attr_input_type, a.attr_type, a.attr_values, v.attr_value, v.attr_price ".
                "FROM " .$db_prefix.'attribute'. " AS a ".
                "LEFT JOIN " .$db_prefix.'goods_attr'. " AS v ".
                "ON v.attr_id = a.attr_id AND v.goods_id = '$goods_id' ".
                "WHERE a.cat_id = " . intval($cat_id) ." OR a.cat_id = 0 ".
                "ORDER BY a.sort_order, a.attr_type, a.attr_id, v.attr_price, v.goods_attr_id";
        $row = M()->getAll($sql);
    
        return $row;
    }
    
    /**
     * 取得商品列表：用于把商品添加到组合、关联类、赠品类
     * @param   object  $filters    过滤条件
     */
    public function get_goods_list($filter)
    {
        $db_prefix=C('DB_PREFIX');
        $filter->keyword = json_str_iconv($filter->keyword);
        $where = get_where_sql($filter); // 取得过滤条件
    
        /* 取得数据 */
        $sql = 'SELECT goods_id, goods_name, shop_price '.
               'FROM ' . $db_prefix.'goods' . ' AS g ' . $where .
               'LIMIT 50';
        $row = M()->getAll($sql);
    
        return $row;
    }
        

}
?>