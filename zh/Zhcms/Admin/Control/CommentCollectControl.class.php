<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class CommentCollectControl extends AuthControl {
    protected $db;
    
    public function __init() {

	}
    

	public function comment() {
	    $db_prefix=C("DB_PREFIX");
        $goods_id   = intval($_REQUEST['goods_id']);
        $sql        = "SELECT * FROM " . $db_prefix.'goods' . " WHERE goods_id = '$goods_id'";
        $goods      = M()->getRowSql($sql);
        $goods_name = $goods['goods_name'];
        $this->assign('goods_id', $goods_id);
        $this->assign('goods_name', $goods_name);
        $this->display();
	}
    
    public function comment_preview (){
        $goods_id              = intval($_REQUEST['goods_id']);
        $taourl                = $_POST['taourl'];
        $keywords              = $_POST['keyword'];
        $max_num               = $_POST['maxNum'];
        $GetNum                = $_POST['GetNum'];
        $goods_name             = $_POST['goods_name'];
        $_SESSION['TimeSplit'] = $_POST['TimeSplit'];
        if (empty($taourl)) {
            $this -> error("淘宝商品地址不能为空");
            exit;
        }
        if (stristr($taourl, ".taobao.com")) {
            $GetGoods_ID    = $this->GetGoodsID($taourl);
            $Getselerdid_tb = $this->Getselerdid_tb("http://a.m.taobao.com/i$GetGoods_ID.htm?v=1");          
            $reviews_url="http://rate.taobao.com/feedRateList.htm?callback=jsonp_reviews_list&userNumId=$Getselerdid_tb&auctionNumId=$GetGoods_ID&showContent=1&ismore=0&siteID=4";
            
        } else {
            
            $GetGoods_ID = $this->GetGoodsID($taourl);
            $selerdid    = $this->Getselerdid($taourl);
            $reviews_url = "http://rate.tmall.com/list_detail_rate.htm?itemId=$GetGoods_ID&spuId=0&sellerId=$selerdid&order=1";
        }
        $page = $GetNum;
        for ($i = 1; $i <= $page; $i++) {
            $pageContents = '';
            if (stristr($taourl, ".taobao.com")) {
                $reviews_url  = str_replace('currentPageNum', '', $reviews_url);
                $reviews_url  = $reviews_url . "&currentPageNum=$i";
            }else{
                $reviews_url  = str_replace('currentPage', '', $reviews_url);
                $reviews_url  = $reviews_url . "&currentPage=$i";
            }
            $pageContents = file_get_contents($reviews_url);
            $pageContents = iconv('GB2312', 'UTF-8', $pageContents);

            if (stristr($taourl, ".taobao.com")) {
                preg_match_all('/,\"content\"\:\"(.*?)\",\"/i', $pageContents, $match1);
                preg_match_all('/nick\"\:\"(.*?)\",\"/i', $pageContents, $match2);
                preg_match_all('/date\"\:\"(.*?)\",\"/i', $pageContents, $match3);
            }else{
                preg_match_all('/,\"rateContent\"\:\"(.*?)\",\"/i', $pageContents, $match1);
                preg_match_all('/displayUserNick\"\:\"(.*?)\",\"/i', $pageContents, $match2);
                preg_match_all('/rateDate\"\:\"(.*?)\",\"/i', $pageContents, $match3);
            }
            
            $comment_list[] = $match1[1];
            $user_list[]    = $match2[1];
            $dateList[]     = $match3[1];
        
        }
        $comment_list_temp = array();
        $user_list_temp    = array();
        $dateList_temp     = array();
        foreach ($comment_list as $key => $val) {
            foreach ($val as $k => $v) {
                $comment_list_temp[$user_list[$key][$k]] = $v;
                $dateList_temp[$user_list[$key][$k]]     = $dateList[$key][$k];
            }
        }
        $comment_list = $comment_list_temp;
        $dateList     = $dateList_temp;
        $comments     = array();
        $i            = 0;
        foreach ($comment_list as $key => $val) {
            if ($i >= $max_num) {
                continue;
            }
            if (!empty($keywords)) {
                if (strpos($val, $keywords) == false) {
                    continue;
                }
            }
            $comments[$key]['comment_type'] = 0;
            $comments[$key]['id_value']     = $goods_id;
            $comments[$key]['email']        = '';
            $comments[$key]['user_name']    = $key;
            $comments[$key]['content']      = $val;
            $rank                           = mt_rand(4, 5);
            $comments[$key]['comment_rank'] = $rank;
            if (isset($dateList[$key])) {
                $time = strtotime(str_replace('.', '-', $dateList[$key]));
            } else {
                $time = gmtime();
            }
            $time                          = $time - 87591;
            $comments[$key]['add_time']    = $time;
            $comments[$key]['ip_address']  = real_ip();
            $comments[$key]['status']      = 1;
            $comments[$key]['parent_id']   = 0;
            $comments[$key]['user_id']     = 0;
            $comments[$key]['goods_name']  = "$goods_name";
            $comments[$key]['format_time'] = local_date('Y-m-d H:i:s', $time);
            $comments[$key]['id']          = $i;
            $i++;
        }
        $arrdata['result'] = 'success';
        $arrdata['data']   = $comments;
        $arrdata['count']  = count($comments);
        if ($arrdata['result'] == 'error') {
            exit($arrdata['data']);
        }
        if ($arrdata['result'] == 'success') {
            $_SESSION['comment_arrdata'] = $arrdata;
            $this->assign('comment_list', $arrdata['data']);
        }
        
        $this->assign('goods_id', $goods_id);
        
        $this->display();
        //echo $reviews_url;die;
        
    }
    
    public function comment_batch_import(){
        $db_prefix=C("DB_PREFIX");
        $ids        = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : array();
        $auto_clear = empty($_POST['auto_clear']) ? 0 : $_POST['auto_clear'];
        if ($auto_clear == 1) {
            $sql    = "DELETE FROM " . $db_prefix.'ec_comment' . " WHERE id_value=" . $_GET['goods_id'];
            $result = M()->exe($sql);
        }
        $arrdata = $_SESSION['comment_arrdata'];
        if ($arrdata['result'] == 'error') {
            exit($arrdata['data']);
        }
        if ($arrdata['result'] == 'success') {
            $array_name = array();
            $sql        = "SELECT distinct user_name FROM " . $db_prefix.'ec_comment' . " WHERE id_value=" . $_GET['goods_id'];
            $names      = M()->getAll($sql);
            for ($i = 0; $i < count($names); $i++) {
                $array_name[] = $names[$i]['user_name'];
            }
            foreach ($arrdata['data'] as $comment) {
                if (in_array($comment['id'], $ids)) {
                    $user_name = $comment['user_name'];
                    if (in_array($user_name, $array_name)) {
                        continue;
                    }
                    date_default_timezone_set(TIME_ZONE);
                    $comment_type = $comment['comment_type'];
                    $id_value     = $comment['id_value'];
                    $email        = $comment['email'];
                    $user_name    = $_POST['user_name'][$comment['id']];
                    $content      = $_POST['content'][$comment['id']];
                    $comment_rank = $_POST['comment_rank'][$comment['id']];
                    $ttt          = $_POST['add_time'][$comment['id']];
                    $rr           = strtotime($ttt);
                    $add_time     = $rr;
                    $ip_address   = $comment['ip_address'];
                    $status       = $_POST['is_show'][$comment['id']];
                    $parent_id    = $comment['parent_id'];
                    $user_id      = $comment['user_id'];
                    $goods_id     = $_POST['goods_id'];
                    $buy_num      = $_POST['buy_num'];
                    $buy_time     = $_POST['buy_time'];
                    $password     = time();
                    $reg_date     = strtotime($_POST['add_time'][$comment['id']]) - 30 * 24 * 3600;
                    $ip           = '';
                    if ($this->check_user($user_name) == true) {
                        $user_name = $user_name . "_" . time();
                    }
                    $sql = "INSERT INTO " . $db_prefix.'ec_comment' . "
                            (comment_type, 
                            id_value, 
                            email, 
                            user_name, 
                            content, 
                            comment_rank, 
                            add_time, 
                            ip_address, 
                            status, 
                            parent_id, 
                            user_id) VALUES " . "
                            ('" . $comment_type . "', 
                            '" . $id_value . "', 
                            '$email', 
                            '$user_name', 
                            '" . $content . "', 
                            '" . $comment_rank . "', 
                            '" . $add_time . "', 
                            '" . $ip_address . "', 
                            '$status', 
                            '$parent_id', 
                            '$user_id')";
                    M()->exe($sql);
                    M()->exe('INSERT INTO ' . $db_prefix."user" . "
                                (`email`, `nickname`, `password`, `regtime`, `logintime`, `lastip`) VALUES 
                                ('$email', '$user_name', '$password', '$reg_date', '$reg_date', '$ip')");
                    $userid          = M()->getOne("SELECT uid FROM " . $db_prefix."user" . " WHERE nickname = '" . $user_name . "'",'uid');
                    $order_sn        = $this->get_order_sn();
                    $order_status    = 5;
                    $shipping_status = 2;
                    $pay_status      = 2;
                    $addtime         = strtotime($_POST['add_time'][$comment['id']]);
                    $pay_time        = strtotime($_POST['add_time'][$comment['id']]) - ($buy_time * 24 * 3600);
                    $goods_number    = rand(1, $buy_num);
                    $goods_info      = M()->getRowSql("SELECT goods_name,goods_sn,market_price,shop_price FROM " . $db_prefix."goods" . " WHERE goods_id = " . $goods_id);
                    $xxc             = $addtime - $_SESSION['TimeSplit'];
                    M()->exe('INSERT INTO ' . $db_prefix."order_info" . "
                    (`order_sn`, `user_id`, `order_status`, `shipping_status`, `pay_status`, `add_time`, `pay_time`) VALUES 
                    ('$order_sn', '$userid', '$order_status', '$shipping_status', '$pay_status', '$xxc', '$pay_time')");
                     $orderid = M()->getOne("SELECT order_id FROM " . $db_prefix."order_info" . " WHERE order_sn = '" . $order_sn . "'",'order_id');
                     M()->exe('INSERT INTO ' . $db_prefix."order_goods" . "
                     (`order_id`, `goods_id`, `goods_name`, `goods_sn`, `goods_number`, `market_price`, `goods_price`, 
                     `send_number`, `is_real`) VALUES 
                     ('$orderid', '$goods_id', '" . $goods_info['goods_name'] . "', '" . $goods_info['goods_sn'] . "', '$goods_number', 
                     " . $goods_info['market_price'] . ", " . $goods_info['shop_price'] . ", '$goods_number', 1)");
                }
            }
        }
        unset($_SESSION['comment_arrdata']);
        $this->success('操作成功',U('Admin/Goods/index'));
    }
    
    
    
    public function check_user($user_name)
    {
        $db_prefix=C("DB_PREFIX");
        $sql = "SELECT uid FROM " . $db_prefix."user" . " WHERE nickname='$user_name'";
        $row = M()->getOne($sql,'uid');
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    public function get_order_sn()
    {
        mt_srand((double) microtime() * 1000000);
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }
    
    public function  GetGoodsID($Url)
    {
        $b = (explode("&", $Url));
        foreach ($b as $v) {
            if (stristr($v, "id=")) {
                $str = $v . ">";
                ereg("id=(.*)>", $str, $c);
                $reslt = $c[1];
                return $reslt;
                break;
            }
        }
    }
    
    public function Getselerdid_tb($Url)
    {
        
        $tb_content = file_get_contents($Url);
        //p($tb_content);die;
        ereg("data-sellerid=\"(.*)\" data-catid", $tb_content, $c);
        return $c[1];
        
        /*
        $tb_content = file_get_contents($Url);
        ereg("shop-15-15.png(.*)>进入店铺</a>", $tb_content, $c);
        ereg("http://(.*).m.taobao.com", $c[0], $a);
        $tb_content = file_get_contents($a[0]);
        ereg("name=\"suid\" value=\"(.*)\"/>", $tb_content, $d);
        $aa = (explode("\"/>", $d[1]));
        return $aa[0];*/
    }
        
    public function Getselerdid($Url)
    {

        $tmall_content = file_get_contents($Url);
        ereg("sellerId:\"(.*)\",shopId:", $tmall_content, $c);
        return $c[1];
    }
    

	

	

	
    
    
}
