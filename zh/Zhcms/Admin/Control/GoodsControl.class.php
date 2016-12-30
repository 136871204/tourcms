<?php
/**
 * 商品类型
 * @author 周鸿 <136871204@qq.com>
 */
class GoodsControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Goods");
	}
    
	//商品类型一览
	public function index() {
	    $brandModel=K("Brand");
        $goodsCategoryModel=K("GoodsCategory");
        $suppliersModel=K("Suppliers");
        
        $cat_id = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
        $code   = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
        if(isset($_REQUEST['suppliers_id'])){
            if(empty($_REQUEST['suppliers_id'])){
                $suppliers_id='';
            }else{
                $suppliers_id=trim($_REQUEST['suppliers_id']);
            }
        }else{
            $suppliers_id='';
        }
        if(isset($_REQUEST['is_on_sale'])){
            if(empty($_REQUEST['is_on_sale']) && $_REQUEST['is_on_sale'] === 0){
                $is_on_sale='';
            }else{
                $is_on_sale=trim($_REQUEST['is_on_sale']);
            }
        }else{
            $is_on_sale='';
        }
        
        
        $handler_list = array();
        $handler_list['virtual_card'][] = array('url'=>'virtual_card.php?act=card', 'title'=>'查看虚拟卡信息', 'img'=>'icon_send_bonus.gif');
        $handler_list['virtual_card'][] = array('url'=>'virtual_card.php?act=replenish', 'title'=>'补货', 'img'=>'icon_add.gif');
        $handler_list['virtual_card'][] = array('url'=>'virtual_card.php?act=batch_card_add', 'title'=>'批量补货', 'img'=>'icon_output.gif');
        if ($_REQUEST['act'] == 'list' && isset($handler_list[$code]))
        {
            $this->add_handler=$handler_list[$code];
        }
        
        
        /* 供货商名 */
        $suppliers_list_name = $suppliersModel->suppliers_list_name();
        $suppliers_exists = 1;
        if (empty($suppliers_list_name))
        {
            $suppliers_exists = 0;
        }
        $this->is_on_sale=$is_on_sale;
        $this->suppliers_id=$suppliers_id;
        $this->suppliers_exists=$suppliers_exists;
        $this->suppliers_list_name=$suppliers_list_name;
        unset($suppliers_list_name, $suppliers_exists);
        
        /* 模板赋值 */
        //$action_link = ($_REQUEST['act'] == 'list') ? add_link($code) : array('href' => 'goods.php?act=list', 'text' => $_LANG['01_goods_list']);
        //$smarty->assign('action_link',  $action_link);
        $this->code=$code;
        $this->cat_list=$goodsCategoryModel->cat_list(0,$cat_id);
        $this->brand_list=$brandModel->get_brand_list();
        $this->intro_list=$this -> db ->get_intro_list();
        $this->list_type=$_REQUEST['act'] == 'list' ? 'goods' : 'trash';
        $use_storage=C('USE_STORAGE')==1 ? 1 : 0;
        $this->use_storage=$use_storage;
        
        
        
        /*商品检索*/
        $is_delete=$_REQUEST['act'] == 'list' ? 0 : 1;
        if($_REQUEST['act'] == 'list'){
            if($code == ''){
                $real_goods=1;
            }else{
                $real_goods=0;
            }
        }else{
            $real_goods=-1;
        }
        $where=$this -> db->goods_list_condition($is_delete,$real_goods);
        /* 记录总数 */
        $sql = "SELECT COUNT(*) FROM " .$this->db->tableFull. " AS g WHERE is_delete='$is_delete' $where";
        $count=M()->getOne($sql,'COUNT(*)');
        $page = new Page($count);
        $this -> page = $page -> show();
        $sql = "SELECT goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, sort_order, goods_number, integral, " .
                        " (promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today') AS is_promote ".
                        " FROM " . $this->db->tableFull . " AS g WHERE is_delete='$is_delete' $where" .
                        " LIMIT " . implode(",", $page -> limit());
        $goods_list=M()->getAll($sql);
        $this->goods_list=$goods_list;

        
        
        
        
        

        $this -> display();
	}
    
    //添加
	public function operator() {
	    $db_prefix=C('DB_PREFIX');
        $goodsModel = K("Goods");
        $memberPriceModel = K("MemberPrice");
        $volumePriceModel=K('VolumePrice');
        $goodsCatModel=K('GoodsCat');
        $linkGoodsModel=K('LinkGoods');
        $groupGoodsModel=K('GroupGoods');
        $groupArticleModel=K('GroupArticle');
        $attributeModel=K("Attribute");
        
        $adminLogModel=K("AdminLog");
        
        $ecs = new ECS(C('DB_DATABASE'), C('DB_PREFIX'));
        define('EC_DATA_DIR', $ecs->data_dir());
        define('EC_IMAGE_DIR', $ecs->image_dir());
        $image = new EcImage(C('bgcolor'));
	    if (IS_POST) {
	       
	       if($_POST['act'] == 'insert' || $_POST['act']=='update'){
	           
               
               
               $code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
               /* 是否处理缩略图 */
                $proc_thumb = (isset($GLOBALS['shop_id']) && $GLOBALS['shop_id'] > 0)? false : true;
                /* 检查货号是否重复 */
                if ($_POST['goods_sn'])
                {
                    $sql = "SELECT COUNT(*) FROM " . $db_prefix.'goods' .
                            " WHERE goods_sn = '$_POST[goods_sn]' AND is_delete = 0 AND goods_id <> '$_POST[goods_id]'";
                    if (M()->getOne($sql,'COUNT(*)') > 0)
                    {
                        $this -> error('您输入的货号已存在，请换一个');
                    }
                }
                
                /* 检查图片：如果有错误，检查尺寸是否超过最大值；否则，检查文件类型 */
                if (isset($_FILES['goods_img']['error'])){// php 4.2 版本才支持 error
                    // 最大上传文件大小
                    $php_maxsize = ini_get('upload_max_filesize');
                    $htm_maxsize = '2M';
                    
                    // 商品图片
                    if ($_FILES['goods_img']['error'] == 0)
                    {
                        
                        if (!$image->check_img_type($_FILES['goods_img']['type']))
                        {
                            $this -> error('商品图片格式不正确！');
                        }
                        
                    }
                    elseif ($_FILES['goods_img']['error'] == 1)
                    {
                        $this -> error('商品图片文件太大了（最大值：'.$php_maxsize.'），无法上传。');
                    }
                    elseif ($_FILES['goods_img']['error'] == 2)
                    {
                        $this -> error('商品图片文件太大了（最大值：'.$htm_maxsize.'），无法上传。');
                    }
                    
                    // 商品缩略图
                    if (isset($_FILES['goods_thumb'])){
                        if ($_FILES['goods_thumb']['error'] == 0)
                        {
                            if (!$image->check_img_type($_FILES['goods_thumb']['type']))
                            {
                                $this -> error('商品缩略图格式不正确！');
                            }
                        }
                        elseif ($_FILES['goods_thumb']['error'] == 1)
                        {
                            $this -> error('商品缩略图文件太大了（最大值：'.$php_maxsize.'），无法上传。');
                        }
                        elseif ($_FILES['goods_thumb']['error'] == 2)
                        {
                            $this -> error('商品缩略图文件太大了（最大值：'.$htm_maxsize.'），无法上传。');
                        }
                    }
                    
                    // 相册图片
                    foreach ($_FILES['img_url']['error'] AS $key => $value)
                    {
                        if ($value == 0)
                        {
                            if (!$image->check_img_type($_FILES['img_url']['type'][$key]))
                            {
                                $this -> error(sprintf('商品相册中第%s个图片格式不正确!', $key + 1));
                            }
                        }
                        elseif ($value == 1)
                        {
                            $this -> error(sprintf('商品相册中第%s个图片文件太大了（最大值：%s），无法上传。', $key + 1, $php_maxsize));
                        }
                        elseif ($_FILES['img_url']['error'] == 2)
                        {
                            $this -> error(sprintf('商品相册中第%s个图片文件太大了（最大值：%s），无法上传。', $key + 1, $htm_maxsize));
                        }
                    }
                    
                }
                /* 4.1版本 */
                else{
                    // 商品图片
                    if ($_FILES['goods_img']['tmp_name'] != 'none')
                    {
                        if (!$image->check_img_type($_FILES['goods_img']['type']))
                        {
            
                            $this -> error('商品图片格式不正确！');
                        }
                    }
                    // 商品缩略图
                    if (isset($_FILES['goods_thumb']))
                    {
                        if ($_FILES['goods_thumb']['tmp_name'] != 'none')
                        {
                            if (!$image->check_img_type($_FILES['goods_thumb']['type']))
                            {
                                $this -> error('商品缩略图格式不正确！');
                            }
                        }
                    }
                    // 相册图片
                    foreach ($_FILES['img_url']['tmp_name'] AS $key => $value)
                    {
                        if ($value != 'none')
                        {
                            if (!$image->check_img_type($_FILES['img_url']['type'][$key]))
                            {
                                $this -> error(sprintf('商品相册中第%s个图片格式不正确!', $key + 1));
                            }
                        }
                    }
                }
                /* 插入还是更新的标识 */
                $is_insert = $_POST['act'] == 'insert';
                /* 处理商品图片 */
                $goods_img        = '';  // 初始化商品图片
                $goods_thumb      = '';  // 初始化商品缩略图
                $original_img     = '';  // 初始化原始图片
                $old_original_img = '';  // 初始化原始图片旧图
                
                // 如果上传了商品图片，相应处理
                if (
                    ($_FILES['goods_img']['tmp_name'] != '' && $_FILES['goods_img']['tmp_name'] != 'none') or 
                    (
                        ($_POST['goods_img_url'] != '商品图片外部URL' && $_POST['goods_img_url'] != 'http://') && 
                        $is_url_goods_img = 1)
                    )
                {
                    if ($_REQUEST['goods_id'] > 0)
                    {
                        echo 'goods_id > 0';die;
                        /* 删除原来的图片文件 */
                        $sql = "SELECT goods_thumb, goods_img, original_img " .
                                " FROM " . $db_prefix.'goods' .
                                " WHERE goods_id = '$_REQUEST[goods_id]'";
                        $row = $db->getRowSql($sql);
                        if ($row['goods_thumb'] != '' && is_file(ROOT_PATH . $row['goods_thumb']))
                        {
                            @unlink(ROOT_PATH . $row['goods_thumb']);
                        }
                        if ($row['goods_img'] != '' && is_file(ROOT_PATH . $row['goods_img']))
                        {
                            @unlink(ROOT_PATH . $row['goods_img']);
                        }
                        if ($row['original_img'] != '' && is_file(ROOT_PATH . $row['original_img']))
                        {
                            /* 先不处理，以防止程序中途出错停止 */
                            //$old_original_img = $row['original_img']; //记录旧图路径
                        }
                        /* 清除原来商品图片 */
                        if ($proc_thumb === false)
                        {
                            get_image_path($_REQUEST[goods_id], $row['goods_img'], false, 'goods', true);
                            get_image_path($_REQUEST[goods_id], $row['goods_thumb'], true, 'goods', true);
                        }
                    }
                    //$is_url_goods_img = 1;
                    if (empty($is_url_goods_img))
                    {
                        $original_img   = $image->upload_image($_FILES['goods_img']); // 原始图片
                        
                    }elseif ($_POST['goods_img_url'])
                    {
                        
                        if(preg_match('/(.jpg|.png|.gif|.jpeg)$/',$_POST['goods_img_url']) && copy(trim($_POST['goods_img_url']), ROOT_PATH . 'temp/' . basename($_POST['goods_img_url'])))
                        {
                              $original_img = 'temp/' . basename($_POST['goods_img_url']);
                        }
                    }
                    
                    if ($original_img === false)
                    {
                        $this -> error($image->error_msg());
                    }
                    $goods_img      = $original_img;   // 商品图片
                    /* 复制一份相册图片 */
                    /* 添加判断是否自动生成相册图片 */
                    if(C('auto_generate_gallery')){
                        $img        = $original_img;   // 相册图片
                        $pos        = strpos(basename($img), '.');
                        $newname    = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);
                        //echo $img;die;
                        if (!copy(ROOT_PATH. $img, ROOT_PATH . $newname))
                        {
                            $this -> error('fail to copy file: ' . realpath(ROOT_PATH . $img));
                        }
                        $img        = $newname;
    
                        $gallery_img    = $img;
                        $gallery_thumb  = $img;
                    }
                    
                    //echo $proc_thumb;die;
                    // 如果系统支持GD，缩放商品图片，且给商品图片和相册图片加水印
                    if ($proc_thumb && $image->gd_version() > 0 && $image->check_img_function($_FILES['goods_img']['type']) || $is_url_goods_img)
                    {
                        if (empty($is_url_goods_img))
                        {
                            // 如果设置大小不为0，缩放图片
                            if (C('ec_image_width') != 0 || C('ec_image_height') != 0)
                            {
                                $goods_img = $image->make_thumb(ROOT_PATH. $goods_img , C('ec_image_width'), C('ec_image_height'));
                                if ($goods_img === false)
                                {
                                    $this -> error($image->error_msg());
                                }
                            }
                            /* 添加判断是否自动生成相册图片 */
                            if (C('auto_generate_gallery'))
                            {
                                $newname    = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);
                                if (!copy(ROOT_PATH . $img, ROOT_PATH . $newname))
                                {
                                    $this -> error('fail to copy file: ' . realpath(ROOT_PATH . $img));
                                }
                                $gallery_img        = $newname;
                            }
                            if(intval(C('ec_watermark_place')) > 0 && C('ec_watermark')!='' ){
                                if ($image->add_watermark(ROOT_PATH.$goods_img,'',ROOT_PATH.C('ec_watermark'), C('ec_watermark_place'),C('ec_watermark_alpha') ) === false)
                                {
                                    $this -> error($image->error_msg());
                                }
                                /* 添加判断是否自动生成相册图片 */
                                if (C('auto_generate_gallery'))
                                {
                                    if ($image->add_watermark(ROOT_PATH. $gallery_img,'',ROOT_PATH.C('ec_watermark'), C('ec_watermark_place'), C('ec_watermark_alpha')) === false)
                                    {
                                        $this -> error($image->error_msg());
                                    }
                                }
        
                            }
                            
                        }
                        // 相册缩略图
                        /* 添加判断是否自动生成相册图片 */
                        if (C('auto_generate_gallery'))
                        {
                            if (C('ec_image_width') != 0 || C('ec_image_height') != 0)
                            {
                                $gallery_thumb = $image->make_thumb(ROOT_PATH. $img, C('ec_image_width'),  C('ec_image_height'));
                                if ($gallery_thumb === false)
                                {
                                    $this -> error($image->error_msg());
                                }
                            }
                        }
                        
                    }
                    
                }
                
                
                // 是否上传商品缩略图
                if (isset($_FILES['goods_thumb']) && $_FILES['goods_thumb']['tmp_name'] != '' &&
                    isset($_FILES['goods_thumb']['tmp_name']) &&$_FILES['goods_thumb']['tmp_name'] != 'none')
                {
                         // 上传了，直接使用，原始大小
                        $goods_thumb = $image->upload_image($_FILES['goods_thumb']);
                        if ($goods_thumb === false)
                        {
                            $this -> error($image->error_msg());
                        }
                }
                else
                {
                    // 未上传，如果自动选择生成，且上传了商品图片，生成所略图
                    if ($proc_thumb && isset($_POST['auto_thumb']) && !empty($original_img))
                    {
                        // 如果设置缩略图大小不为0，生成缩略图
                        if (C('ec_image_width') != 0 || C('ec_image_height')  != 0)
                        {
                            $goods_thumb = $image->make_thumb(ROOT_PATH. $original_img,C('ec_image_width'), C('ec_image_height'));
                            if ($goods_thumb === false)
                            {
                                $this -> error($image->error_msg());
                            }
                        }
                        else
                        {
                            $goods_thumb = $original_img;
                        }
                    }
                }
                /* 删除下载的外链原图 */
                if (!empty($is_url_goods_img))
                {
                    unlink(ROOT_PATH . $original_img);
                    empty($newname) || unlink(ROOT_PATH . $newname);
                    $url_goods_img = $goods_img = $original_img = htmlspecialchars(trim($_POST['goods_img_url']));
                }
                /* 如果没有输入商品货号则自动生成一个商品货号 */
                if (empty($_POST['goods_sn']))
                {
                    $max_id     = $is_insert ? M()->getOne("SELECT MAX(goods_id) + 1 AS cnt FROM ".$db_prefix.'goods','cnt') : $_REQUEST['goods_id'];
                   // echo $max_id;die;
                    $goods_sn   = $goodsModel->generate_goods_sn($max_id);
                }
                else
                {
                    $goods_sn   = $_POST['goods_sn'];
                }
                /* 处理商品数据 */
                $shop_price = !empty($_POST['shop_price']) ? $_POST['shop_price'] : 0;
                $market_price = !empty($_POST['market_price']) ? $_POST['market_price'] : 0;
                $promote_price = !empty($_POST['promote_price']) ? floatval($_POST['promote_price'] ) : 0;
                $is_promote = empty($promote_price) ? 0 : 1;
                $promote_start_date = ($is_promote && !empty($_POST['promote_start_date'])) ? local_strtotime($_POST['promote_start_date']) : 0;
                $promote_end_date = ($is_promote && !empty($_POST['promote_end_date'])) ? local_strtotime($_POST['promote_end_date']) : 0;
                $goods_weight = !empty($_POST['goods_weight']) ? $_POST['goods_weight'] * $_POST['weight_unit'] : 0;
                $is_best = isset($_POST['is_best']) ? 1 : 0;
                $is_new = isset($_POST['is_new']) ? 1 : 0;
                $is_hot = isset($_POST['is_hot']) ? 1 : 0;
                $is_on_sale = isset($_POST['is_on_sale']) ? 1 : 0;
                $is_alone_sale = isset($_POST['is_alone_sale']) ? 1 : 0;
                $is_shipping = isset($_POST['is_shipping']) ? 1 : 0;
                $goods_number = isset($_POST['goods_number']) ? $_POST['goods_number'] : 0;
                $warn_number = isset($_POST['warn_number']) ? $_POST['warn_number'] : 0;
                $goods_type = isset($_POST['goods_type']) ? $_POST['goods_type'] : 0;
                $give_integral = isset($_POST['give_integral']) ? intval($_POST['give_integral']) : '-1';
                $rank_integral = isset($_POST['rank_integral']) ? intval($_POST['rank_integral']) : '-1';
                $suppliers_id = isset($_POST['suppliers_id']) ? intval($_POST['suppliers_id']) : '0';
                $goods_desc= isset($_POST['goods_desc']) ? $_POST['goods_desc'] : '';
                
                $goods_name_style = $_POST['goods_name_color'] . '+' . $_POST['goods_name_style'];

                $catgory_id = empty($_POST['cat_id']) ? '' : intval($_POST['cat_id']);
                $brand_id = empty($_POST['brand_id']) ? '' : intval($_POST['brand_id']);
            
            
                $goods_thumb = (empty($goods_thumb) && !empty($_POST['goods_thumb_url']) && $this->goods_parse_url($_POST['goods_thumb_url'])) ? htmlspecialchars(trim($_POST['goods_thumb_url'])) : $goods_thumb;
                $goods_thumb = (empty($goods_thumb) && isset($_POST['auto_thumb']))? $goods_img : $goods_thumb;
                
                /* 入库 */
                if ($is_insert){
                    if ($code == '')
                    {
                        $sql = "INSERT INTO " . $db_prefix.'goods' . " (goods_name, goods_name_style, goods_sn, " .
                        "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
                        "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
                        "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, " .
                        "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, rank_integral, suppliers_id)" .
                    "VALUES ('$_POST[goods_name]', '$goods_name_style', '$goods_sn', '$catgory_id', " .
                        "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
                        "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
                        "'$_POST[keywords]', '$_POST[goods_brief]', '$_POST[seller_note]', '$goods_weight', '$goods_number',".
                        " '$warn_number', '$_POST[integral]', '$give_integral', '$is_best', '$is_new', '$is_hot', '$is_on_sale', '$is_alone_sale', $is_shipping, ".
                        " '$goods_desc', '" . gmtime() . "', '". gmtime() ."', '$goods_type', '$rank_integral', '$suppliers_id')";
                        
                    }else{
                        $sql = "INSERT INTO " . $db_prefix.'goods' . " (goods_name, goods_name_style, goods_sn, " .
                        "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
                        "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
                        "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, is_real, " .
                        "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, extension_code, rank_integral)" .
                    "VALUES ('$_POST[goods_name]', '$goods_name_style', '$goods_sn', '$catgory_id', " .
                        "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
                        "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
                        "'$_POST[keywords]', '$_POST[goods_brief]', '$_POST[seller_note]', '$goods_weight', '$goods_number',".
                        " '$warn_number', '$_POST[integral]', '$give_integral', '$is_best', '$is_new', '$is_hot', 0, '$is_on_sale', '$is_alone_sale', $is_shipping, ".
                        " '$goods_desc', '" . gmtime() . "', '". gmtime() ."', '$goods_type', '$code', '$rank_integral')";
                        echo $sql;die;
                    }
                }else{
                    /* 如果有上传图片，删除原来的商品图 */
                    $sql = "SELECT goods_thumb, goods_img, original_img " .
                                " FROM " . $db_prefix.'goods' .
                                " WHERE goods_id = '$_REQUEST[goods_id]'";
                    $row = M()->getRowSql($sql);
                    if ($proc_thumb && $goods_img && $row['goods_img'] && !$this->goods_parse_url($row['goods_img']))
                    {
                        @unlink(ROOT_PATH . $row['goods_img']);
                        @unlink(ROOT_PATH . $row['original_img']);
                    }
                    if ($proc_thumb && $goods_thumb && $row['goods_thumb'] && !$this->goods_parse_url($row['goods_thumb']))
                    {
                        @unlink(ROOT_PATH . $row['goods_thumb']);
                    }
                    
                    $sql = "UPDATE " . $db_prefix.'goods' . " SET " .
                            "goods_name = '$_POST[goods_name]', " .
                            "goods_name_style = '$goods_name_style', " .
                            "goods_sn = '$goods_sn', " .
                            "cat_id = '$catgory_id', " .
                            "brand_id = '$brand_id', " .
                            "shop_price = '$shop_price', " .
                            "market_price = '$market_price', " .
                            "is_promote = '$is_promote', " .
                            "promote_price = '$promote_price', " .
                            "promote_start_date = '$promote_start_date', " .
                            "suppliers_id = '$suppliers_id', " .
                            "promote_end_date = '$promote_end_date', ";
            
                    /* 如果有上传图片，需要更新数据库 */
                    if ($goods_img)
                    {
                        $sql .= "goods_img = '$goods_img', original_img = '$original_img', ";
                    }
                    if ($goods_thumb)
                    {
                        $sql .= "goods_thumb = '$goods_thumb', ";
                    }
                    if ($code != '')
                    {
                        $sql .= "is_real=0, extension_code='$code', ";
                    }
                    $sql .= "keywords = '$_POST[keywords]', " .
                            "goods_brief = '$_POST[goods_brief]', " .
                            "seller_note = '$_POST[seller_note]', " .
                            "goods_weight = '$goods_weight'," .
                            "goods_number = '$goods_number', " .
                            "warn_number = '$warn_number', " .
                            "integral = '$_POST[integral]', " .
                            "give_integral = '$give_integral', " .
                            "rank_integral = '$rank_integral', " .
                            "is_best = '$is_best', " .
                            "is_new = '$is_new', " .
                            "is_hot = '$is_hot', " .
                            "is_on_sale = '$is_on_sale', " .
                            "is_alone_sale = '$is_alone_sale', " .
                            "is_shipping = '$is_shipping', " .
                            "goods_desc = '$goods_desc', " .
                            "last_update = '". gmtime() ."', ".
                            "goods_type = '$goods_type' " .
                            "WHERE goods_id = '$_REQUEST[goods_id]' LIMIT 1";
                }
                $insert_id=M()->exe($sql);
                //$insert_id=36;
                /* 商品编号 */
                $goods_id = $is_insert ? $insert_id : $_REQUEST['goods_id'];
                /* 记录日志 */
                if ($is_insert)
                {
                    $adminLogModel->admin_log($_POST['goods_name'],'添加','商品');
                }
                else
                {
                    $adminLogModel->admin_log($_POST['goods_name'],'编辑','商品');
                }
                //p($_POST);
                /* 处理属性 */
                if (
                        (isset($_POST['attr_id_list']) && isset($_POST['attr_value_list'])) || 
                        (empty($_POST['attr_id_list']) && empty($_POST['attr_value_list']))
                ){
                    // 取得原有的属性值
                    $goods_attr_list = array();
                    $keywords_arr = explode(" ", $_POST['keywords']);
                    //array_flip() 函数返回一个反转后的数组，如果同一值出现了多次，则最后一个键名将作为它的值，所有其他的键名都将丢失。
                    //如果原数组中的值的数据类型不是字符串或整数，函数将报错。
                    //$a=array(0=>"Dog",1=>"Cat",2=>"Horse");print_r(array_flip($a));
                    //Array ( [Dog] => 0 [Cat] => 1 [Horse] => 2 )
                    $keywords_arr = array_flip($keywords_arr);
                    if (isset($keywords_arr['']))
                    {
                        unset($keywords_arr['']);
                    }
                    $sql = "SELECT attr_id, attr_index FROM " . $db_prefix.'attribute' . " WHERE cat_id = '$goods_type'";
                    $attr_res = M()->query($sql);
                    $attr_list = array();
                    if(!empty($attr_res)){
                        foreach($attr_res as $attr_res_key => $attr_res_value){
                            $attr_list[$attr_res_value['attr_id']] = $attr_res_value['attr_index'];
                        }
                    }
                    $sql = "SELECT g.*, a.attr_type
                            FROM " . $db_prefix.'goods_attr' . " AS g
                                LEFT JOIN " . $db_prefix.'attribute' . " AS a
                                    ON a.attr_id = g.attr_id
                            WHERE g.goods_id = '$goods_id'";
                    $res = M()->query($sql);
                    //p($res);
                    if(!empty($res)){
                        foreach($res as $res_key => $res_value){
                             $goods_attr_list[$res_value['attr_id']][$res_value['attr_value']] = array('sign' => 'delete', 'goods_attr_id' => $res_value['goods_attr_id']);
                        }
                    }
                    // 循环现有的，根据原有的做相应处理
                    if(isset($_POST['attr_id_list'])){
                        foreach ($_POST['attr_id_list'] AS $key => $attr_id)
                        {
                            $attr_value = $_POST['attr_value_list'][$key];
                            $attr_price = $_POST['attr_price_list'][$key];
                            if (!empty($attr_value))
                            {
                                if (isset($goods_attr_list[$attr_id][$attr_value]))
                                {
                                    // 如果原来有，标记为更新
                                    $goods_attr_list[$attr_id][$attr_value]['sign'] = 'update';
                                    $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
                                }
                                else
                                {
                                    // 如果原来没有，标记为新增
                                    $goods_attr_list[$attr_id][$attr_value]['sign'] = 'insert';
                                    $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
                                }
                                $val_arr = explode(' ', $attr_value);
                                foreach ($val_arr AS $k => $v)
                                {
                                    if (!isset($keywords_arr[$v]) && $attr_list[$attr_id] == "1")
                                    {
                                        $keywords_arr[$v] = $v;
                                    }
                                }
                            }
                        }
                    }
                    $keywords = join(' ', array_flip($keywords_arr));
                   // echo $keywords;
                    //p($goods_attr_list);die;
                    $sql = "UPDATE " .$db_prefix.'goods'. " SET keywords = '$keywords' WHERE goods_id = '$goods_id' LIMIT 1";
                    M()->exe($sql);
                    /* 插入、更新、删除数据 */
                    foreach ($goods_attr_list as $attr_id => $attr_value_list)
                    {
                        foreach ($attr_value_list as $attr_value => $info)
                        {
                            if ($info['sign'] == 'insert')
                            {
                                $sql = "INSERT INTO " .$db_prefix.'goods_attr'. " 
                                    (attr_id, goods_id, attr_value, attr_price)".
                                    "VALUES ('$attr_id', '$goods_id', '$attr_value', '$info[attr_price]')";
                            }
                            elseif ($info['sign'] == 'update')
                            {
                                $sql = "UPDATE " .$db_prefix.'goods_attr'. " SET attr_price = '$info[attr_price]' WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
                            }
                            else
                            {
                                $sql = "DELETE FROM " .$db_prefix.'goods_attr'. " WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
                            }
                            M()->exe($sql);
                        }
                    }
                }
                    
                /* 处理会员价格 */
                if (isset($_POST['user_rank']) && isset($_POST['user_price']))
                {
                    $memberPriceModel->handle_member_price($goods_id, $_POST['user_rank'], $_POST['user_price']);
                }
                    
                /* 处理优惠价格 */
                if (isset($_POST['volume_number']) && isset($_POST['volume_price'])){
                    $temp_num = array_count_values($_POST['volume_number']);
                    foreach($temp_num as $v)
                    {
                        if ($v > 1)
                        {
                            /*优惠数量重复！
                            $this -> error('优惠数量重复！');
                            sys_msg($_LANG['volume_number_continuous'], 1, array(), false);*/
                            break;
                        }
                    }
                    $volumePriceModel->handle_volume_price($goods_id, $_POST['volume_number'], $_POST['volume_price']);
                }
                    
                /* 处理扩展分类 */
                if (isset($_POST['other_cat']))
                {
                    $goodsCatModel->handle_other_cat($goods_id, array_unique($_POST['other_cat']));
                }
                if ($is_insert)
                { 
                    /* 处理关联商品 */
                    $linkGoodsModel->handle_link_goods($goods_id);
            
                    /* 处理组合商品 */
                    $groupGoodsModel->handle_group_goods($goods_id);
            
                    /* 处理关联文章 */
                    $groupArticleModel->handle_goods_article($goods_id);
                }
                    //echo $original_img;die;
                /* 重新格式化图片名称 */
                $original_img = $goodsModel->reformat_image_name('goods', $goods_id, $original_img, 'source');
                $goods_img = $goodsModel->reformat_image_name('goods', $goods_id, $goods_img, 'goods');
                $goods_thumb = $goodsModel->reformat_image_name('goods_thumb', $goods_id, $goods_thumb, 'thumb');
                
                if ($goods_img !== false)
                {
                    M()->exe("UPDATE " . $db_prefix.'goods' . " SET goods_img = '$goods_img' WHERE goods_id='$goods_id'");
                }
                if ($original_img !== false)
                {
                   M()->exe("UPDATE " . $db_prefix.'goods' . " SET original_img = '$original_img' WHERE goods_id='$goods_id'");
                }
            
                if ($goods_thumb !== false)
                {
                    M()->exe("UPDATE " . $db_prefix.'goods' . " SET goods_thumb = '$goods_thumb' WHERE goods_id='$goods_id'");
                }
                   
                /* 如果有图片，把商品图片加入图片相册 */
                if (isset($img)){
                    /* 重新格式化图片名称 */
                    if (empty($is_url_goods_img)){
                        $img = $goodsModel->reformat_image_name('gallery', $goods_id, $img, 'source');
                        $gallery_img = $goodsModel->reformat_image_name('gallery', $goods_id, $gallery_img, 'goods');
                    }else
                    {
                        $img = $url_goods_img;
                        $gallery_img = $url_goods_img;
                    }
                    $gallery_thumb = $goodsModel->reformat_image_name('gallery_thumb', $goods_id, $gallery_thumb, 'thumb');
                    $sql = "INSERT INTO " . $db_prefix.'goods_gallery' . " (goods_id, img_url, img_desc, thumb_url, img_original) " .
                            "VALUES ('$goods_id', '$gallery_img', '', '$gallery_thumb', '$img')";
                    M()->exe($sql);
                }
                /* 处理相册图片 */
                $goodsModel->handle_gallery_image($goods_id, $_FILES['img_url'], $_POST['img_desc'], $_POST['img_file']);
                /* 编辑时处理相册图片描述 */
                if (!$is_insert && isset($_POST['old_img_desc']))
                {
                    foreach ($_POST['old_img_desc'] AS $img_id => $img_desc)
                    {
                        $sql = "UPDATE " . $db_prefix.'goods_gallery' . " SET img_desc = '$img_desc' WHERE img_id = '$img_id' LIMIT 1";
                        M()->exe($sql);
                    }
                }
                
                /* 不保留商品原图的时候删除原图 */
                if ($proc_thumb && !C('ec_retain_original_img') && !empty($original_img))
                {
                    M()->exe("UPDATE " . $db_prefix.'goods' . " SET original_img='' WHERE `goods_id`='{$goods_id}'");
                    M()->exe("UPDATE " . $db_prefix.'goods_gallery' . " SET img_original='' WHERE `goods_id`='{$goods_id}'");
                    @unlink(ROOT_PATH . $original_img);
                    @unlink(ROOT_PATH . $img);
                }
                /* 记录上一次选择的分类和品牌 */
                setcookie('ECSCP[last_choose]', $catgory_id . '|' . $brand_id, gmtime() + 86400);
                
                /* 提示页面 */
                $link = array();
                if ($goodsModel->check_goods_specifications_exist($goods_id))
                {
                    $link[0] = array('href' => 'goods.php?act=product_list&goods_id=' . $goods_id, 'text' => '货品');
                }
                if ($code == 'virtual_card')
                {
                    $link[1] = array('href' => 'virtual_card.php?act=replenish&goods_id=' . $goods_id, 'text' => '添加虚拟卡卡密');
                }
                if ($is_insert)
                {
                    $link[2] = $this->add_link($code);
                }        
                $link[3] = $this->list_link($is_insert, $code);
                for($i=0;$i<count($link);$i++)
                {
                   $key_array[]=$i;
                }
                krsort($link);
                $link = array_combine($key_array, $link);
                 
                $this->success($is_insert ? '添加商品成功' : '修改商品成功');
	       }else{
	           
	       }
	       
	       
	    }else{

    	    $ecUserRankModel=K("EcUserRank");
    	    $suppliersModel=K("Suppliers");
            $goodsCategoryModel=K("GoodsCategory");
            $goodsTypeModel=K("GoodsType");
            $brandModel=K("Brand");
            
            
            //echo ZHPHP_ORG_PATH.'fckeditor/fckeditor.php';die;
            //include_once(ZHPHP_ORG_PATH.'fckeditor/fckeditor.php'); // 包含 html editor 类文件
    	    $is_add = $_REQUEST['act'] == 'add'; // 添加还是编辑的标识
            $is_copy = $_REQUEST['act'] == 'copy'; //是否复制
            $code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
            $code=$code=='virual_card' ? 'virual_card': '';
            
            /* 供货商名 */
            $suppliers_list_name = $suppliersModel->suppliers_list_name();
            $suppliers_exists = 1;
            if (empty($suppliers_list_name))
            {
                $suppliers_exists = 0;
            }
            $this ->suppliers_exists=$suppliers_exists;
            $this ->suppliers_list_name=$suppliers_list_name;
            unset($suppliers_list_name, $suppliers_exists);
            
            /* 取得商品信息 */
            if ($is_add)
            {
                /* 默认值 */
                $last_choose = array(0, 0);
                if (!empty($_COOKIE['ECSCP']['last_choose']))
                {
                    $last_choose = explode('|', $_COOKIE['ECSCP']['last_choose']);
                }
                $goods = array(
                    'goods_id'      => 0,
                    'goods_desc'    => '',
                    'cat_id'        => $last_choose[0],
                    'brand_id'      => $last_choose[1],
                    'is_on_sale'    => '1',
                    'is_alone_sale' => '1',
                    'is_shipping' => '0',
                    'other_cat'     => array(), // 扩展分类
                    'goods_type'    => 0,       // 商品类型
                    'shop_price'    => 0,
                    'promote_price' => 0,
                    'market_price'  => 0,
                    'integral'      => 0,
                    'goods_number'  => C('DEFAULT_STORAGE'),
                    'warn_number'   => 1,
                    'promote_start_date' => local_date('Y-m-d'),
                    'promote_end_date'   => local_date('Y-m-d', local_strtotime('+1 month')),
                    'goods_weight'  => 0,
                    'give_integral' => -1,
                    'rank_integral' => -1
                );
                
                if ($code != '')
                {
                    $goods['goods_number'] = 0;
                }
                /* 关联商品 */
                $link_goods_list = array();
                $sql = "DELETE FROM " . $db_prefix.'link_goods' .
                    " WHERE (goods_id = 0 OR link_goods_id = 0)" .
                    " AND admin_id = '$_SESSION[uid]'";
                M()->exe($sql);
                
                /* 组合商品 */
                $group_goods_list = array();
                $sql = "DELETE FROM " . $db_prefix.'group_goods' .
                    " WHERE parent_id = 0 AND admin_id = '$_SESSION[uid]'";
                M()->exe($sql);
                    
                    
                /* 关联文章 */
                $goods_article_list = array();
                $sql = "DELETE FROM " . $db_prefix.'goods_article' .
                    " WHERE goods_id = 0 AND admin_id = '$_SESSION[uid]'";
                M()->exe($sql);
                
                /* 属性 */
                $sql = "DELETE FROM " . $db_prefix.'goods_attr' . " WHERE goods_id = 0";
                M()->exe($sql);
                    
                /* 图片列表 */
                $img_list = array();
            }else
            {
                /* 商品信息 */
                $sql = "SELECT * FROM " . $db_prefix.'goods' . " WHERE goods_id = '$_REQUEST[goods_id]'";
                $goods = M()->getRowSql($sql);
                /* 虚拟卡商品复制时, 将其库存置为0*/
                if ($is_copy && $code != '')
                {
                    $goods['goods_number'] = 0;
                }
                if (empty($goods) === true)
                {
                    /* 默认值 */
                    $goods = array(
                        'goods_id'      => 0,
                        'goods_desc'    => '',
                        'cat_id'        => 0,
                        'is_on_sale'    => '1',
                        'is_alone_sale' => '1',
                        'is_shipping' => '0',
                        'other_cat'     => array(), // 扩展分类
                        'goods_type'    => 0,       // 商品类型
                        'shop_price'    => 0,
                        'promote_price' => 0,
                        'market_price'  => 0,
                        'integral'      => 0,
                        'goods_number'  => 1,
                        'warn_number'   => 1,
                        'promote_start_date' => local_date('Y-m-d'),
                        'promote_end_date'   => local_date('Y-m-d', gmstr2tome('+1 month')),
                        'goods_weight'  => 0,
                        'give_integral' => -1,
                        'rank_integral' => -1
                    );
                }
                /* 获取商品类型存在规格的类型 */
                $specifications = $attributeModel->get_goods_type_specifications();
                $goods['specifications_id'] = $specifications[$goods['goods_type']];
                $_attribute =$goodsModel->get_goods_specifications_list($goods['goods_id']);
                $goods['_attribute'] = empty($_attribute) ? '' : 1;
                /* 根据商品重量的单位重新计算 */
                if ($goods['goods_weight'] > 0)
                {
                    $goods['goods_weight_by_unit'] = ($goods['goods_weight'] >= 1) ? $goods['goods_weight'] : ($goods['goods_weight'] / 0.001);
                }
                if (!empty($goods['goods_brief']))
                {
                    //$goods['goods_brief'] = trim_right($goods['goods_brief']);
                    $goods['goods_brief'] = $goods['goods_brief'];
                }
                if (!empty($goods['keywords']))
                {
                    //$goods['keywords']    = trim_right($goods['keywords']);
                    $goods['keywords']    = $goods['keywords'];
                }
                /* 如果不是促销，处理促销日期 */
                if (isset($goods['is_promote']) && $goods['is_promote'] == '0')
                {
                    unset($goods['promote_start_date']);
                    unset($goods['promote_end_date']);
                }
                else
                {
                    $goods['promote_start_date'] = local_date('Y-m-d', $goods['promote_start_date']);
                    $goods['promote_end_date'] = local_date('Y-m-d', $goods['promote_end_date']);
                }
                /* 如果是复制商品，处理 */
                if ($_REQUEST['act'] == 'copy'){
                    echo 'act==copy';die;
                }
                // 扩展分类
                $other_cat_list = array();
                $sql = "SELECT cat_id FROM " . $db_prefix.'goods_cat' . " WHERE goods_id = '$_REQUEST[goods_id]'";
                $goods['other_cat'] = M()->getCol($sql,'cat_id');
                foreach ($goods['other_cat'] AS $cat_id)
                {
                    $other_cat_list[$cat_id] = $goodsCategoryModel->cat_list(0, $cat_id);
                }
                $this->assign('other_cat_list', $other_cat_list);
                $link_goods_list    = $goodsModel->get_linked_goods($goods['goods_id']); // 关联商品
                $group_goods_list   = $goodsModel->get_group_goods($goods['goods_id']); // 配件
                $goods_article_list = $goodsModel->get_goods_articles($goods['goods_id']);   // 关联文章
                /* 商品图片路径 */
                if (isset($GLOBALS['shop_id']) && ($GLOBALS['shop_id'] > 10) && !empty($goods['original_img']))
                {
                    $goods['goods_img'] = get_image_path($_REQUEST['goods_id'], $goods['goods_img']);
                    $goods['goods_thumb'] = get_image_path($_REQUEST['goods_id'], $goods['goods_thumb'], true);
                }
                /* 图片列表 */
                $sql = "SELECT * FROM " . $db_prefix.'goods_gallery' . " WHERE goods_id = '$goods[goods_id]'";
                $img_list = M()->getAll($sql);
                /* 格式化相册图片路径 */
                if (isset($GLOBALS['shop_id']) && ($GLOBALS['shop_id'] > 0))
                {
                    foreach ($img_list as $key => $gallery_img)
                    {
                        $gallery_img[$key]['img_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], false, 'gallery');
                        $gallery_img[$key]['thumb_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], true, 'gallery');
                    }
                }
                else
                {
                    foreach ($img_list as $key => $gallery_img)
                    {
                        $gallery_img[$key]['thumb_url'] = ROOT_PATH . (empty($gallery_img['thumb_url']) ? $gallery_img['img_url'] : $gallery_img['thumb_url']);
                    }
                }
            }
            
            
            /*
            if ($code != '')
            {
                $goods['goods_number'] = 0;
            }
            // 扩展分类
            $other_cat_list = array();
            $temp_goods_id=empty($_REQUEST['goods_id']) ? '' : trim($_REQUEST['goods_id']);
            $sql = "SELECT cat_id FROM " . $db_prefix.'goods_cat' . " WHERE goods_id = '$temp_goods_id'";
            //$sql = "SELECT cat_id FROM " . $db_prefix.'goods_cat' . " WHERE goods_id = '8'";
            $goods['other_cat'] =M()->getCol($sql,'cat_id');
            if(!empty($goods['other_cat'])){
                foreach ($goods['other_cat'] AS $cat_id)
                {
                    $other_cat_list[$cat_id] = $goodsCategoryModel->cat_list(0, $cat_id);
                }
            }
            
            $this->assign('other_cat_list', $other_cat_list);*/
    
    
    
            /* 拆分商品名称样式 */
            $goods_name_style = explode('+', empty($goods['goods_name_style']) ? '+' : $goods['goods_name_style']);
            
            /* 创建 html editor */
            //$this->assign('FCKeditor', create_html_editor('goods_desc', $goods['goods_desc']));
            /* 模板赋值 */
            $this->assign('code',    $code);
            $this->assign('goods', $goods);
            $this->assign('goods_name_color', $goods_name_style[0]);
            $this->assign('goods_name_style', $goods_name_style[1]);
            $this->assign('cat_list', $goodsCategoryModel->cat_list(0, $goods['cat_id']));
            $this->assign('brand_list', $brandModel->get_brand_list());
            $this->assign('unit_list', $this->db->get_unit_list());
            $this->assign('user_rank_list', $ecUserRankModel->get_user_rank_list());
            $this->assign('weight_unit', $is_add ? '1' : ($goods['goods_weight'] >= 1 ? '1' : '0.001'));
            $this->assign('config_value',    C());
            $this->assign('form_act', $is_add ? 'insert' : ($_REQUEST['act'] == 'edit' ? 'update' : 'insert'));
            $this->font_styles=array('strong' => '加粗', 'em' => '斜体', 'u' => '下划线', 'strike' => '删除线');
            if ($_REQUEST['act'] == 'add' || $_REQUEST['act'] == 'edit')
            {
                $this->assign('is_add', true);
            }     
            if(!$is_add)
            {
                $this->assign('member_price_list', $memberPriceModel->get_member_price_list($_REQUEST['goods_id']));
            }
            $this->assign('link_goods_list', $link_goods_list);
            $this->assign('group_goods_list', $group_goods_list);
            $this->assign('goods_article_list', $goods_article_list);
            $this->assign('img_list', $img_list);
            $this->assign('goods_type_list', $goodsTypeModel->goods_type_list($goods['goods_type']));
            $this->assign('gd', gd_version());
            $this->assign('thumb_width', C('ec_thumb_width'));
            $this->assign('thumb_height', C('ec_thumb_height'));
            $this->assign('goods_attr_html', $this->db->build_attr_html($goods['goods_type'], $goods['goods_id']));
            //$this->assign('goods_attr_html', $this->db->build_attr_html('9', '32'));
            
            $volume_price_list = '';
            if(isset($_REQUEST['goods_id']))
            {
                $volume_price_list = $volumePriceModel->get_volume_price_list($_REQUEST['goods_id']);
            }
    
            //$volume_price_list = $volumePriceModel->get_volume_price_list('9');
            if (empty($volume_price_list))
            {
                $volume_price_list = array('0'=>array('number'=>'','price'=>''));
            }
            $this->assign('volume_price_list', $volume_price_list);
                            
            $this -> display();
	    }
	    
    }
        
    //修改
    public function edit(){
        
        
    }
   
    public function del(){
        
    } 
    
    public function drop_image()
    {
        $db_prefix=C("DB_PREFIX");
        $img_id = empty($_REQUEST['img_id']) ? 0 : intval($_REQUEST['img_id']);
        /* 删除图片文件 */
        $sql = "SELECT img_url, thumb_url, img_original " .
                " FROM " . $db_prefix.'goods_gallery' .
                " WHERE img_id = '$img_id'";
        $row = M()->getRowSql($sql);
        if ($row['img_url'] != '' && is_file(ROOT_PATH . $row['img_url']))
        {
            @unlink(ROOT_PATH . $row['img_url']);
        }
        if ($row['thumb_url'] != '' && is_file(ROOT_PATH . $row['thumb_url']))
        {
            @unlink(ROOT_PATH . $row['thumb_url']);
        }
        if ($row['img_original'] != '' && is_file(ROOT_PATH . $row['img_original']))
        {
            @unlink(ROOT_PATH . $row['img_original']);
        }
        /* 删除数据 */
        $sql = "DELETE FROM " . $db_prefix.'goods_gallery' . " WHERE img_id = '$img_id' LIMIT 1";
        M()->exe($sql);
        make_json_result($img_id);
    }
    
    public function show_image(){
        if (isset($GLOBALS['shop_id']) && $GLOBALS['shop_id'] > 0)
        {
            $img_url = $_GET['img_url'];
        }
        else
        {
            if (strpos($_GET['img_url'], 'http://') === 0)
            {
                $img_url = $_GET['img_url'];
            }
            else
            {
                $img_url = __ROOT__. '/'. $_GET['img_url'];
            }
        }
        $this->assign('img_url', $img_url);
        $this->display();
    }
    
    /**
     * 添加链接
     * @param   string  $extension_code 虚拟商品扩展代码，实体商品为空
     * @return  array('href' => $href, 'text' => $text)
     */
    public function add_link($extension_code = '')
    {
        $href = 'goods.php?act=add';
        if (!empty($extension_code))
        {
            $href .= '&extension_code=' . $extension_code;
        }
    
        if ($extension_code == 'virtual_card')
        {
            $text = '添加虚拟商品';
        }
        else
        {
            $text = '添加新商品';
        }
    
        return array('href' => $href, 'text' => $text);
    }
    
    
    /**
     * 列表链接
     * @param   bool    $is_add         是否添加（插入）
     * @param   string  $extension_code 虚拟商品扩展代码，实体商品为空
     * @return  array('href' => $href, 'text' => $text)
     */
    public function list_link($is_add = true, $extension_code = '')
    {
        $href = 'goods.php?act=list';
        if (!empty($extension_code))
        {
            $href .= '&extension_code=' . $extension_code;
        }
        if (!$is_add)
        {
            $href .= '&' . list_link_postfix();
        }
    
        if ($extension_code == 'virtual_card')
        {
            $text ='虚拟商品列表';
        }
        else
        {
            $text = '商品列表';
        }
    
        return array('href' => $href, 'text' => $text);
    }
    
    public function check_goods_sn(){
        $db_prefix=C("DB_PREFIX");
        $goods_id = intval($_REQUEST['goods_id']);
        $goods_sn = trim($_REQUEST['goods_sn']);
        if(!$this->db->is_only('goods_sn',$goods_sn,$goods_id)){
            make_json_error('序列号已经存在');
        }
        if(!empty($goods_sn))
        {
            $sql="SELECT goods_id FROM ". $db_prefix.'products'." WHERE product_sn='$goods_sn'";
            if(M()->getOne($sql,'goods_id'))
            {
                make_json_error('序列号已经存在');
            }
        }
        make_json_result('');
    }
	
    
    public function get_attr(){
        $goods_id   = empty($_GET['goods_id']) ? 0 : intval($_GET['goods_id']);
        $goods_type = empty($_GET['goods_type']) ? 0 : intval($_GET['goods_type']);
    
        $content    = $this->db->build_attr_html($goods_type, $goods_id);
        make_json_result($content);
        
    }

    public function get_goods_list(){
        $goodsModel = K("Goods");
        $json = new JSON;
        $filters = $json->decode($_GET['JSON']);
        $arr = $goodsModel->get_goods_list($filters);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $key => $val)
            {
                $opt[] = array('value' => $val['goods_id'],
                                'text' => $val['goods_name'],
                                'data' => $val['shop_price']);
            }
        }
        
    
        make_json_result($opt);
        
    }
    
    
    public function add_link_goods(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");
        $json = new JSON;
        
        $linked_array   = $json->decode($_GET['add_ids']);
        $linked_goods   = $json->decode($_GET['JSON']);
        $goods_id       = $linked_goods[0];
        $is_double      = $linked_goods[1] == true ? 0 : 1;
        
        foreach ($linked_array AS $val)
        {
            if ($is_double)
            {
                /* 双向关联 */
                $sql = "INSERT INTO " . $db_prefix.'link_goods' . " 
                        (goods_id, link_goods_id, is_double, admin_id) " .
                        "VALUES ('$val', '$goods_id', '$is_double', '$_SESSION[uid]')";
                M()->exe($sql);
            }
            $sql = "INSERT INTO " . $db_prefix.'link_goods' . " 
                    (goods_id, link_goods_id, is_double, admin_id) " .
                "VALUES ('$goods_id', '$val', '$is_double', '$_SESSION[uid]')";
            M()->exe($sql);
        }
        $linked_goods   = $goodsModel->get_linked_goods($goods_id);
        $options        = array();

        if(!empty($linked_goods)){
            foreach ($linked_goods AS $val)
            {
                $options[] = array('value'  => $val['goods_id'],
                                'text'      => $val['goods_name'],
                                'data'      => '');
            }
        }

        
        make_json_result($options);
    }
    
    public function drop_link_goods(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");
        $json = new JSON;
        $drop_goods     = $json->decode($_GET['drop_ids']);
        $drop_goods_ids = db_create_in($drop_goods);
        $linked_goods   = $json->decode($_GET['JSON']);
        $goods_id       = $linked_goods[0];
        $is_signle      = $linked_goods[1];
        if (!$is_signle)
        {
            $sql = "DELETE FROM " .$db_prefix.'link_goods' .
                    " WHERE link_goods_id = '$goods_id' AND goods_id " . $drop_goods_ids;
        }
        else
        {
            $sql = "UPDATE " .$db_prefix.'link_goods' . " SET is_double = 0 ".
                    " WHERE link_goods_id = '$goods_id' AND goods_id " . $drop_goods_ids;
        }
        if ($goods_id == 0)
        {
            $sql .= " AND admin_id = '$_SESSION[uid]'";
        }
        M()->exe($sql);
        $sql = "DELETE FROM " .$db_prefix.'link_goods' .
            " WHERE goods_id = '$goods_id' AND link_goods_id " . $drop_goods_ids;
        if ($goods_id == 0)
        {
            $sql .= " AND admin_id = '$_SESSION[uid]'";
        }
        M()->exe($sql);
        
        $linked_goods   = $goodsModel->get_linked_goods($goods_id);
        $options        = array();

        if(!empty($linked_goods)&&count($linked_goods)>0){
            foreach ($linked_goods AS $val)
            {
                $options[] = array('value'  => $val['goods_id'],
                                'text'      => $val['goods_name'],
                                'data'      => '');
            }
        }
        make_json_result($options);
    }
    
    public function add_group_goods(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");
        $json = new JSON;
        $fittings   = $json->decode($_GET['add_ids']);
        $arguments  = $json->decode($_GET['JSON']);
        $goods_id   = $arguments[0];
        $price      = $arguments[1];
        foreach ($fittings AS $val)
        {
            $sql = "INSERT INTO " . $db_prefix.'group_goods' . " 
                    (parent_id, goods_id, goods_price, admin_id) " .
                    "VALUES 
                    ('$goods_id', '$val', '$price', '$_SESSION[uid]')";
            M()->exe($sql);
        }
        
        $arr = $goodsModel->get_group_goods($goods_id);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $val)
            {
                $opt[] = array('value'      => $val['goods_id'],
                                'text'      => $val['goods_name'],
                                'data'      => '');
            }
        }
        make_json_result($opt);
        
    }
    
    public function drop_group_goods(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");

        $json = new JSON;
        $fittings   = $json->decode($_GET['drop_ids']);
        $arguments  = $json->decode($_GET['JSON']);
        $goods_id   = $arguments[0];
        $price      = $arguments[1];
        $sql = "DELETE FROM " .$db_prefix.'group_goods' .
            " WHERE parent_id='$goods_id' AND " .db_create_in($fittings, 'goods_id');
        if ($goods_id == 0)
        {
            $sql .= " AND admin_id = '$_SESSION[uid]'";
        }
        M()->exe($sql);
        $arr = $goodsModel->get_group_goods($goods_id);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $val)
            {
                $opt[] = array('value'      => $val['goods_id'],
                                'text'      => $val['goods_name'],
                                'data'      => '');
            }
        }
        make_json_result($opt);
    }
    
    
    public function get_article_list()
    {
        $db_prefix=C("DB_PREFIX");
        $json = new JSON;

        $filters =(array) $json->decode(json_str_iconv($_GET['JSON']));
        $where = " WHERE cat_id > 0 ";
        if (!empty($filters['title']))
        {
            $keyword  = trim($filters['title']);
            $where   .=  " AND title LIKE '%" . mysql_like_quote($keyword) . "%' ";
        }
        $sql        = 'SELECT article_id, title FROM ' .$db_prefix.'article'. $where.
                  'ORDER BY article_id DESC LIMIT 50';
        $res =M()->query($sql);
        $arr        = array();
        if(!empty($res)){
            foreach($res as $key=>$val){
                $arr[]  = array('value' => $val['article_id'], 'text' => $val['title'], 'data'=>'');
            }
        }
        
        make_json_result($arr);
    }
    
    public function add_goods_article(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");
        $json = new JSON;
        
        $articles   = $json->decode($_GET['add_ids']);
        $arguments  = $json->decode($_GET['JSON']);
        $goods_id   = $arguments[0];
        if(!empty($articles)){
            foreach ($articles AS $val)
            {
                $sql = "INSERT INTO " . $db_prefix.'goods_article' . " (goods_id, article_id, admin_id) " .
                        "VALUES ('$goods_id', '$val', '$_SESSION[uid]')";
                M()->exe($sql);
            }
        }
        $arr = $goodsModel->get_goods_articles($goods_id);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $val)
            {
                $opt[] = array('value'      => $val['article_id'],
                                'text'      => $val['title'],
                                'data'      => '');
            }
        }
        make_json_result($opt);
        
    }
    
    public function drop_goods_article(){
        $db_prefix=C("DB_PREFIX");
        $goodsModel = K("Goods");
        $json = new JSON;
        
        $articles   = $json->decode($_GET['drop_ids']);
        $arguments  = $json->decode($_GET['JSON']);
        $goods_id   = $arguments[0];
        
        $sql = "DELETE FROM " .$db_prefix.'goods_article' . " WHERE " 
                . db_create_in($articles, "article_id") . " AND goods_id = '$goods_id'";
        M()->exe($sql);
        
        $arr = $goodsModel->get_goods_articles($goods_id);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $val)
            {
                $opt[] = array('value'      => $val['article_id'],
                                'text'      => $val['title'],
                                'data'      => '');
            }
        }
        make_json_result($opt);
    }
    
    
    /**
     * 检查图片网址是否合法
     *
     * @param string $url 网址
     *
     * @return boolean
     */
    public function goods_parse_url($url)
    {
        $parse_url = @parse_url($url);
        return (!empty($parse_url['scheme']) && !empty($parse_url['host']));
    }
    
    
}
