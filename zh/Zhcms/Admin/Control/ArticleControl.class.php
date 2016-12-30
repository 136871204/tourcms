<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class ArticleControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("Article");
        
	}
    
    
    
	//ブランド一覧
	public function index() {
	    
        $db_prefix=C("DB_PREFIX");
        
        $filter = array();
        $filter['keyword']    = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
        $filter['cat_id'] = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
        
        $where = '';
        if (!empty($filter['keyword']))
        {
            $where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
        }
        if ($filter['cat_id'])
        {
            $where .= " AND a." . get_article_children($filter['cat_id']);
        }
        
         /* 文章总数 */
        $sql = 'SELECT 
                    COUNT(*) 
                FROM ' .
                    $db_prefix.'article'. ' AS a '.
                    'LEFT JOIN ' .
                    $db_prefix.'article_cat'. ' AS ac 
                    ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
        $count = M()->getOne($sql,'COUNT(*)');
        $page = new Page($count);       
	    $this -> page = $page -> show();
        
        /* 获取文章数据 */
        $sql = 'SELECT a.* , ac.cat_name '.
               'FROM ' .$db_prefix.'article'. ' AS a '.
               'LEFT JOIN ' .$db_prefix.'article_cat'. ' AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where." LIMIT " .implode(",", $page -> limit());
        $result=$this -> db->query($sql); 
     
        foreach($result as $key => &$value){
            $value['date'] = local_date(C('time_format'), $value['add_time']);
        }

        //p($result);die;
        $this->assign('article_list',    $result);
        $this->assign('cat_select',  article_cat_list(0));
		$this -> display();
	}
    
    public function add() {
        $goodsCategoryModel = K("GoodsCategory");
        $brandModel=K("Brand");
        $db_prefix=C("DB_PREFIX");
        $tempDb=M();
        /*初始化数据交换对象 */
        $exc   = new Exchange($db_prefix."article", $tempDb, 'article_id', 'title');
        /* 允许上传的文件类型 */
        $allow_file_types = '|GIF|JPG|PNG|BMP|SWF|DOC|XLS|PPT|MID|WAV|ZIP|RAR|PDF|CHM|RM|TXT|';
        if (IS_POST) {
            /*检查是否重复*/
            $is_only = $exc->is_only('title', $_POST['title'],0, " cat_id ='$_POST[article_cat]'");
            if (!$is_only)
            {
                $this -> error('同分类下，这个标题的文章已经存在');
            }
            /* 取得文件地址 */
            $file_url = '';
            
            if (
                (isset($_FILES['file']['error']) && $_FILES['file']['error'] == 0) || 
                (!isset($_FILES['file']['error']) && isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != 'none'))
            {
                // 检查文件格式
                if (!check_file_type($_FILES['file']['tmp_name'], $_FILES['file']['name'], $allow_file_types))
                {
                    $this->error("文件格式错误");
                }
                // 复制文件
                $res = $this->upload_article_file($_FILES['file']);
                if ($res != false)
                {
                    $file_url = $res;
                }
            }
            if ($file_url == '')
            {
                $file_url = $_POST['file_url'];
            }
            
            /* 计算文章打开方式 */
            if ($file_url == '')
            {
                $open_type = 0;
            }
            else
            {
                if(!isset($_POST['FCKeditor1'])){
                    $open_type=1;
                }else{
                    $_POST['FCKeditor1'] == '' ? 1 : 2;
                }
            }
            p($file_url);die;
            $add_time = gmtime();
            if (empty($_POST['cat_id']))
            {
                $_POST['cat_id'] = 0;
            }
            $sql = "INSERT INTO ".$db_prefix.'article'."
                    (title, cat_id, article_type, is_open, author, ".
                    "author_email, keywords, content, add_time, file_url, open_type, link, description) ".
                    "VALUES ('$_POST[title]', '$_POST[article_cat]', '$_POST[article_type]', '$_POST[is_open]', ".
                "'$_POST[author]', '$_POST[author_email]', '$_POST[keywords]', '$_POST[FCKeditor1]', ".
                "'$add_time', '$file_url', '$open_type', '$_POST[link_url]', '$_POST[description]')";
    
        }else{
            /*初始化*/
            $article = array();
            $article['is_open'] = 1;
            /* 取得分类、品牌 */
            $this->assign('goods_cat_list', $goodsCategoryModel->cat_list());
            $this->assign('brand_list',     $brandModel->get_brand_list());
            /* 清理关联商品 */
            $sql = "DELETE FROM " . $db_prefix.'goods_article' . " WHERE article_id = 0";
            M()->exe($sql);
            if (isset($_GET['id']))
            {
                $this->assign('cur_id',  $_GET['id']);
            }
            $this->assign('article',     $article);
            $this->assign('cat_select',  article_cat_list(0));
            $this -> display();
        }
        
        
    }
    
    /* 上传文件 */
    public function upload_article_file($upload)
    {
        if (!make_dir(C("UPLOAD_PATH")."/article"))
        {
            /* 创建目录失败 */
            return false;
        }
         //$EcImage->random_filename()
        $filename = EcImage::random_filename() . substr($upload['name'], strpos($upload['name'], '.'));
        $path     = C("UPLOAD_PATH") . "/article/" . $filename;
    
        if (move_upload_file($upload['tmp_name'], $path))
        {
            return C("UPLOAD_PATH") . "/article/" . $filename;
        }
        else
        {
            return false;
        }
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
        $json = new JSON;
        $add_ids = $json->decode($_GET['add_ids']);
        $args = $json->decode($_GET['JSON']);
        $article_id = $args[0];
        if ($article_id == 0)
        {
            $article_id = M()->getOne('SELECT MAX(article_id)+1 AS article_id FROM ' .$db_prefix.'article','article_id');
        }
        foreach ($add_ids AS $key => $val)
        {
            $sql = 'INSERT INTO ' . $db_prefix.'goods_article' . ' (goods_id, article_id) '.
                   "VALUES ('$val', '$article_id')";
            if(!M()->exe($sql)){
                make_json_error('已经存在');
            }
        }
        
        /* 重新载入 */
        $arr = $this -> db->get_article_goods($article_id);
        $opt = array();
        
        if(!empty($arr)){
            foreach ($arr AS $key => $val)
            {
                $opt[] = array('value'  => $val['goods_id'],
                                'text'  => $val['goods_name'],
                                'data'  => '');
            }
        }
        
        make_json_result($opt);
    }
	

    public function drop_link_goods(){
        $db_prefix=C("DB_PREFIX");
        $json = new JSON;
        $drop_goods     = $json->decode($_GET['drop_ids']);
        $arguments      = $json->decode($_GET['JSON']);
        $article_id     = $arguments[0];
        if ($article_id == 0)
        {
            $article_id = M()->getOne('SELECT MAX(article_id)+1 AS article_id FROM ' .$db_prefix.'article','article_id');
        }
        $sql = "DELETE FROM " . $db_prefix.'goods_article'.
            " WHERE article_id = '$article_id' AND goods_id " .db_create_in($drop_goods);
        M()->exe($sql) or make_json_error('删除goods_article数据失败');
        /* 重新载入 */
        $arr = $this -> db->get_article_goods($article_id);
        $opt = array();
        if(!empty($arr)){
            foreach ($arr AS $key => $val)
            {
                $opt[] = array('value'  => $val['goods_id'],
                                'text'  => $val['goods_name'],
                                'data'  => '');
            }
        }
        
    
        make_json_result($opt);
    }

	
    
    
}
