<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class BonusControl extends AuthControl {
    protected $db;
    
    public function __init() {
		//$this -> db = K("Brand");
	}
    
	//ブランド一覧
	public function index() {
        $list=$this->get_type_list();
       
        $page = new Page($list['record_count'],$list['page_size']);
       // $this -> page = $page -> show();
        $this->assign('page',    $page -> show());
        $this->assign('type_list',    $list['item']);
        $this->assign('filter',       $list['filter']);
        $this->assign('record_count', $list['record_count']);
        $this->assign('page_count',   $list['page_count']);
    
		$this -> display();
	}
    
    public function add(){
        $db_prefix=C('DB_PREFIX');
        $adminLogModel=K("AdminLog");
        if (IS_POST) {
            /* 去掉红包类型名称前后的空格 */
            $type_name   = !empty($_POST['type_name']) ? trim($_POST['type_name']) : '';
            /* 初始化变量 */
            $type_id     = !empty($_POST['type_id'])    ? intval($_POST['type_id'])    : 0;
            $min_amount  = !empty($_POST['min_amount']) ? intval($_POST['min_amount']) : 0;
            /* 检查类型是否有重复 */
            $sql = "SELECT COUNT(*) FROM " .$db_prefix.'bonus_type'. " WHERE type_name='$type_name'";
            if (M()->getOne($sql,'COUNT(*)') > 0)
            {
                $this -> error('红包类型已经存在');
            }
            /* 获得日期信息 */
            $send_startdate = local_strtotime($_POST['send_start_date']);
            $send_enddate   = local_strtotime($_POST['send_end_date']);
            $use_startdate  = local_strtotime($_POST['use_start_date']);
            $use_enddate    = local_strtotime($_POST['use_end_date']);
            
            /* 插入数据库。 */
            $sql = "INSERT INTO ".$db_prefix.'bonus_type'." (type_name, type_money,send_start_date,send_end_date,use_start_date,use_end_date,send_type,min_amount,min_goods_amount)
            VALUES ('$type_name',
                    '$_POST[type_money]',
                    '$send_startdate',
                    '$send_enddate',
                    '$use_startdate',
                    '$use_enddate',
                    '$_POST[send_type]',
                    '$min_amount','" . floatval($_POST['min_goods_amount']) . "')";

            M()->exe($sql);
            
            $adminLogModel->admin_log($_POST['type_name'], '添加', '红包类型');
            $this -> success("添加成功！");
        }else{
            $next_month = local_strtotime('+1 months');
            $bonus_arr['send_start_date']   = local_date('Y-m-d');
            $bonus_arr['use_start_date']    = local_date('Y-m-d');
            $bonus_arr['send_end_date']     = local_date('Y-m-d', $next_month);
            $bonus_arr['use_end_date']      = local_date('Y-m-d', $next_month);
            $this->assign('bonus_arr',    $bonus_arr);
            $this -> display();
        }
    }
    
    public function edit(){
        $db_prefix=C('DB_PREFIX');
        $adminLogModel=K("AdminLog");
        if (IS_POST) {
            /* 获得日期信息 */
            $send_startdate = local_strtotime($_POST['send_start_date']);
            $send_enddate   = local_strtotime($_POST['send_end_date']);
            $use_startdate  = local_strtotime($_POST['use_start_date']);
            $use_enddate    = local_strtotime($_POST['use_end_date']);
            
            /* 对数据的处理 */
            $type_name   = !empty($_POST['type_name'])  ? trim($_POST['type_name'])    : '';
            $type_id     = !empty($_POST['type_id'])    ? intval($_POST['type_id'])    : 0;
            $min_amount  = !empty($_POST['min_amount']) ? intval($_POST['min_amount']) : 0;
            
            $sql = "UPDATE " .$db_prefix.'bonus_type'. " SET ".
                   "type_name       = '$type_name', ".
                   "type_money      = '$_POST[type_money]', ".
                   "send_start_date = '$send_startdate', ".
                   "send_end_date   = '$send_enddate', ".
                   "use_start_date  = '$use_startdate', ".
                   "use_end_date    = '$use_enddate', ".
                   "send_type       = '$_POST[send_type]', ".
                   "min_amount      = '$min_amount', " .
                   "min_goods_amount = '" . floatval($_POST['min_goods_amount']) . "' ".
                   "WHERE type_id   = '$type_id'";
            M()->exe($sql);
            $adminLogModel->admin_log($_POST['type_name'], '修改', '红包类型');
            $this -> success("修改成功！");
        }else{
            /* 获取红包类型数据 */
            $type_id = !empty($_GET['type_id']) ? intval($_GET['type_id']) : 0;
            $bonus_arr = M()->getRowSql("SELECT * FROM " .$db_prefix.'bonus_type'. " WHERE type_id = '$type_id'");
            $bonus_arr['send_start_date']   = local_date('Y-m-d', $bonus_arr['send_start_date']);
            $bonus_arr['send_end_date']     = local_date('Y-m-d', $bonus_arr['send_end_date']);
            $bonus_arr['use_start_date']    = local_date('Y-m-d', $bonus_arr['use_start_date']);
            $bonus_arr['use_end_date']      = local_date('Y-m-d', $bonus_arr['use_end_date']);
            $this->assign('bonus_arr',   $bonus_arr);
            $this -> display();
        }
    }
    
    public function send_by_user(){
        //echo 'aaa';die;
        $ecUserRankModel=K('EcUserRank');
        $mailTemplatesModel=K('MailTemplates');
        $bonusTypeModel=K('BonusType');
        $db_prefix=C('DB_PREFIX');
        $user_list  = array();
        $start      = empty($_REQUEST['start']) ? 0 : intval($_REQUEST['start']);
        $limit      = empty($_REQUEST['limit']) ? 2 : intval($_REQUEST['limit']);
        $validated_email = empty($_REQUEST['validated_email']) ? 0 : intval($_REQUEST['validated_email']);
        $send_count = 0;
        if (isset($_REQUEST['send_rank']))
        {
            /* 按会员等级来发放红包 */
            $rank_id = intval($_REQUEST['rank_id']);
            if ($rank_id > 0)
            {
                $sql = "SELECT min_points, max_points, special_rank FROM " . $db_prefix.'ec_user_rank' . "  WHERE rank_id = '$rank_id'";
                $row = M()->getRowSql($sql);
                if ($row['special_rank'])
                {
                    /* 特殊会员组处理 */
                    $sql = 'SELECT COUNT(*) FROM ' . $db_prefix.'user'. " WHERE user_rank = '$rank_id'";
                    $send_count = M()->getOne($sql,'COUNT(*)');
                    if($validated_email)
                    {
                        $sql = 'SELECT uid, email, username 	 FROM ' . $db_prefix.'user'.
                                " WHERE user_rank = '$rank_id' AND user_state = 1".
                                " LIMIT $start, $limit";
                    }
                    else
                    {
                         $sql = 'SELECT uid, email, username 	 FROM ' . $db_prefix.'user'.
                                    " WHERE user_rank = '$rank_id'".
                                    " LIMIT $start, $limit";
                    }
                }else{
                    $sql = 'SELECT COUNT(*) FROM ' . $db_prefix.'user'.
                        " WHERE rank_points >= " . intval($row['min_points']) . " AND rank_points < " . intval($row['max_points']);
                    $send_count = M()->getOne($sql,'COUNT(*)');
                    if($validated_email)
                    {
                        $sql = 'SELECT uid, email, username 	 FROM ' . $db_prefix.'user'.
                            " WHERE rank_points >= " . intval($row['min_points']) . " AND rank_points < " . intval($row['max_points']) .
                            " AND user_state = 1 LIMIT $start, $limit";
                    }
                    else
                    {
                         $sql = 'SELECT uid, email, username 	 FROM ' . $db_prefix.'user'.
                            " WHERE rank_points >= " . intval($row['min_points']) . " AND rank_points < " . intval($row['max_points']) .
                            " LIMIT $start, $limit";
                    }
                }
                //echo $sql;die;
                $user_list = M()->getAll($sql);
                //p($user_list);
                $count = count($user_list);
            }
        }elseif (isset($_REQUEST['send_user']))
        {
            echo 'TODO: send_user';die;
        }
        /* 发送红包 */
        $loop       = 0;
        $bonus_type = $bonusTypeModel->bonus_type_info($_REQUEST['id']);
       
        $tpl = $mailTemplatesModel->get_mail_template('send_bonus');
        $today = local_date(C('ec_date_format'));
        if(!empty($user_list)){
            foreach ($user_list AS $key => $val)
            {
                /* 发送邮件通知 */
                $this->assign('username',    $val['username']);
                $this->assign('shop_name',    C('ec_shop_name'));
                $this->assign('send_date',    $today);
                $this->assign('sent_date',    $today);
                $this->assign('count',        1);
                $this->assign('money',        price_format($bonus_type['type_money']));

                $content= $this -> view->contentCompile('str:' . $tpl['template_content']);
                
                if ($this->add_to_maillist($val['username'], $val['email'], $tpl['template_subject'], $content, $tpl['is_html'])){
                    // 向会员红包表录入数据 
                    $sql = "INSERT INTO " . $db_prefix.'user_bonus' .
                            "(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed) " .
                            "VALUES ('".$_REQUEST['id']."', 0, '$val[uid]', 0, 0, " .BONUS_MAIL_SUCCEED. ")";
                    M()->exe($sql);
                }else{
                    // 邮件发送失败，更新数据库 
                    $sql = "INSERT INTO " . $db_prefix.'user_bonus' .
                            "(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed) " .
                            "VALUES ('".$_REQUEST['id']."', 0, '$val[uid]', 0, 0, " .BONUS_MAIL_FAIL. ")";
                    M()->exe($sql);
                }
                if ($loop >= $limit)
                {
                    break;
                }else
                {
                    $loop++;
                }
            } 
            if ($send_count > ($start + $limit))
            {
                $href =U('Admin/Bonus/send_by_user',array('start'=>($start+$limit),'limit'=>$limit,'id'=>$_REQUEST['id']));
                if (isset($_REQUEST['send_rank']))
                {
                    $href .= "&send_rank=1&rank_id=$rank_id";
                }
                if (isset($_REQUEST['send_user']))
                {
                    echo 'TODO,send_user';die;
                    //$href .= "&send_user=1&user=" . implode(',', $user_array);
                }   
               //echo  $href;die;
                $this -> success(sprintf('共發送了 %d 個紅包。', $count),$href,2); 
                //die;
            }else{
                $href =U('Admin/Bonus/index');
                $this -> success(sprintf('共發送了 %d 個紅包。', $count),$href,2);
               // die;
            }
        }else{

            $this -> success(sprintf('共發送了 %d 個紅包。', 0));
            //die;
        }
    }
    
    public function send(){
        $ecUserRankModel=K('EcUserRank');
        $mailTemplatesModel=K('MailTemplates');
        $bonusTypeModel=K('BonusType');
        $db_prefix=C('DB_PREFIX');
        if (IS_POST) {
            
            if ($_REQUEST['act'] == 'send_by_user')
            {
                
            }
            
        }else{
            /* 取得参数 */
            $id = !empty($_REQUEST['id'])  ? intval($_REQUEST['id'])  : '';
            
            if ($_REQUEST['send_by'] == SEND_BY_USER)
            {
                $this->assign('id',           $id);
                $this->assign('ranklist',     $ecUserRankModel->get_rank_list());
                
                $this->display('bonus_by_user');
            }
        }
        
        
    }
    
    public function add_to_maillist($username, $email, $subject, $content, $is_html)
    {
        $db_prefix=C('DB_PREFIX');
        $time = time();
        $content = addslashes($content);
        $template_id = M()->getOne("SELECT template_id FROM " . $db_prefix.'mail_templates' . " WHERE template_code = 'send_bonus'",'template_id');
        $sql = "INSERT INTO "  . $db_prefix.'email_sendlist' . " ( email, template_id, email_content, pri, last_send) VALUES ('$email', $template_id, '$content', 1, '$time')";
        M()->exe($sql);
        return true;
    }
	
    public function get_type_list()
    {
        $db_prefix=C('DB_PREFIX');
        /* 获得所有红包类型的发放数量 */
        $sql = "SELECT bonus_type_id, COUNT(*) AS sent_count".
                " FROM " .$db_prefix.'user_bonus' .
                " GROUP BY bonus_type_id";
        $res = M()->query($sql);
        $sent_arr = array();
        if(!empty($res)){
            foreach($res as $key=>$val){
                $sent_arr[$val['bonus_type_id']] = $val['sent_count'];
            }
        }
        /* 获得所有红包类型的发放数量 */
        $sql = "SELECT bonus_type_id, COUNT(*) AS used_count".
                " FROM " .$db_prefix.'user_bonus' .
                " WHERE used_time > 0".
                " GROUP BY bonus_type_id";
        $res = M()->query($sql);
        
        $used_arr = array();
        if(!empty($res)){
            foreach($res as $key=>$val){
                $used_arr[$val['bonus_type_id']] = $val['used_count'];
            }
        }
        
        $result = get_filter();
        //p($result);
        if ($result === false)
        {
            /* 查询条件 */
            $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'type_id' : trim($_REQUEST['sort_by']);
            $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
            
            $sql = "SELECT COUNT(*) FROM ".$db_prefix.'bonus_type';
            $filter['record_count'] = M()->getOne($sql,'COUNT(*)');
            
            /* 分页大小 */
            $filter = page_and_size($filter);
        
            $sql = "SELECT * FROM " .$db_prefix.'bonus_type'. " ORDER BY $filter[sort_by] $filter[sort_order]";

            set_filter($filter, $sql);
        
        }else{
            $sql    = $result['sql'];
            $filter = $result['filter'];
        }
        
        $arr = array();
        $res = M()->selectLimit($sql, $filter['page_size'], $filter['start']);
        
        $textArr=array();
        $textArr['send_by'][SEND_BY_USER] = '按用户发放';
        $textArr['send_by'][SEND_BY_GOODS] = '按商品发放';
        $textArr['send_by'][SEND_BY_ORDER] = '按订单金额发放';
        $textArr['send_by'][SEND_BY_PRINT] = '线下发放的红包';
        
        if(!empty($res)){
            foreach($res as $key=>$val){
                $val['send_by'] = $textArr['send_by'][$val['send_type']];
                $val['send_count'] = isset($sent_arr[$val['type_id']]) ? $sent_arr[$val['type_id']] : 0;
                $val['use_count'] = isset($used_arr[$val['type_id']]) ? $used_arr[$val['type_id']] : 0;
        
                $arr[] = $val;
            }
        }
        $arr = array('item' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count'],'page_size'=>$filter['page_size']);
        return $arr;
    }
    
    
}
