<?php

/**
 * 取得某模板某库设置的数量
 * @param   string      $template   模板名，如index
 * @param   string      $library    库名，如recommend_best
 * @param   int         $def_num    默认数量：如果没有设置模板，显示的数量
 * @return  int         数量
 */
function get_library_number($library, $template = null)
{
    $db_prefix=C('DB_PREFIX');
    global $page_libs;
    if (empty($template))
    {
        $template =CONTROL;
    }
    $template = addslashes($template);
    static $lib_list = array();
    p($lib_list);die;
    /* 如果没有该模板的信息，取得该模板的信息 */
    if (!isset($lib_list[$template]))
    {
        $lib_list[$template] = array();
        $sql = "SELECT library, number FROM " . $db_prefix.'template' .
                " WHERE theme = '" . $GLOBALS['_CFG']['template'] . "'" .
                " AND filename = '$template' AND remarks='' ";
    }
    echo $template;die;
}

/**
 * 调用调查内容
 *
 * @access  public
 * @param   integer $id   调查的编号
 * @return  array
 */
function get_vote($id = '')
{
    $db_prefix=C('DB_PREFIX');
    /* 随机取得一个调查的主题 */
    if (empty($id))
    {
        $time = gmtime();
        $sql = 'SELECT vote_id, vote_name, can_multi, vote_count, RAND() AS rnd' .
               ' FROM ' . $db_prefix.'vote' .
               " WHERE start_time <= '$time' AND end_time >= '$time' ".
               ' ORDER BY rnd LIMIT 1';
    }
    else
    {
        $sql = 'SELECT vote_id, vote_name, can_multi, vote_count' .
               ' FROM ' . $db_prefix.'vote'.
               " WHERE vote_id = '$id'";
    }
    $vote_arr = M()->getRowSql($sql);
    if ($vote_arr !== false && !empty($vote_arr))
    {
        /* 通过调查的ID,查询调查选项 */
        $sql_option = 'SELECT v.*, o.option_id, o.vote_id, o.option_name, o.option_count ' .
                      'FROM ' . $db_prefix.'vote' . ' AS v, ' .
                            $db_prefix.'vote_option' . ' AS o ' .
                      "WHERE 
                      o.vote_id = v.vote_id AND 
                      o.vote_id = '$vote_arr[vote_id]' ORDER BY o.option_order ASC, o.option_id DESC";
        $res = M()->getAll($sql_option);
        /* 总票数 */
        $sql = 'SELECT SUM(option_count) AS all_option FROM ' . $db_prefix.'vote_option' .
               " WHERE vote_id = '" . $vote_arr['vote_id'] . "' GROUP BY vote_id";
        $option_num = M()->getOne($sql,'all_option');
        
        $arr = array();
        $count = 100;
        foreach ($res AS $idx => $row)
        {
            if ($option_num > 0 && $idx == count($res) - 1)
            {
                $percent = $count;
            }else
            {
                $percent = ($row['vote_count'] > 0 && $option_num > 0) ? round(($row['option_count'] / $option_num) * 100) : 0;

                $count -= $percent;
            }
            $arr[$row['vote_id']]['options'][$row['option_id']]['percent'] = $percent;

            $arr[$row['vote_id']]['vote_id']    = $row['vote_id'];
            $arr[$row['vote_id']]['vote_name']  = $row['vote_name'];
            $arr[$row['vote_id']]['can_multi']  = $row['can_multi'];
            $arr[$row['vote_id']]['vote_count'] = $row['vote_count'];

            $arr[$row['vote_id']]['options'][$row['option_id']]['option_id']    = $row['option_id'];
            $arr[$row['vote_id']]['options'][$row['option_id']]['option_name']  = $row['option_name'];
            $arr[$row['vote_id']]['options'][$row['option_id']]['option_count'] = $row['option_count'];
            
        }
        $vote_arr['vote_id'] = (!empty($vote_arr['vote_id'])) ? $vote_arr['vote_id'] : '';
        $vote = array('id' => $vote_arr['vote_id'], 'content' => $arr);
        return $vote;
    }
}


/**
 * 保存过滤条件
 * @param   array   $filter     过滤条件
 * @param   string  $sql        查询语句
 * @param   string  $param_str  参数字符串，由list函数的参数组成
 */
function set_filter($filter, $sql, $param_str = '')
{
    $filterfile = basename(PHP_SELF, '.php');
    if ($param_str)
    {
        $filterfile .= $param_str;
    }
    setcookie('ZHCMS[lastfilterfile]', sprintf('%X', crc32($filterfile)), time() + 600);
    setcookie('ZHCMS[lastfilter]',     urlencode(serialize($filter)), time() + 600);
    setcookie('ZHCMS[lastfiltersql]',  base64_encode($sql), time() + 600);
}

/**
 * 取得上次的过滤条件
 * @param   string  $param_str  参数字符串，由list函数的参数组成
 * @return  如果有，返回array('filter' => $filter, 'sql' => $sql)；否则返回false
 */
function get_filter($param_str = '')
{
    $filterfile = basename(PHP_SELF, '.php');
    if ($param_str)
    {
        $filterfile .= $param_str;
    }
    echo sprintf('%X', crc32($filterfile));
    //p($_COOKIE);
    if (isset($_GET['uselastfilter']) && isset($_COOKIE['ZHCMS']['lastfilterfile'])
        && $_COOKIE['ZHCMS']['lastfilterfile'] == sprintf('%X', crc32($filterfile)))
    {
        return array(
            'filter' => unserialize(urldecode($_COOKIE['ZHCMS']['lastfilter'])),
            'sql'    => base64_decode($_COOKIE['ZHCMS']['lastfiltersql'])
        );
    }
    else
    {
        return false;
    }
}

function assign_template($controller,$ctype = '', $catlist = array())
{
    //global $this;
    //p($controller);die;
    $controller->assign('navigator_list',        get_navigator($ctype, $catlist));  //自定义导航栏
}


/**
 * 取得自定义导航栏列表
 * @param   string      $type    位置，如top、bottom、middle
 * @return  array         列表
 */
function get_navigator($ctype = '', $catlist = array())
{
    $db_prefix=C('DB_PREFIX');
    $sql = 'SELECT * FROM '. $db_prefix.'nav' . '
            WHERE ifshow = \'1\' ORDER BY type, vieworder';
    $res = M()->query($sql);
    $cur_url = substr(strrchr($_SERVER['REQUEST_URI'],'/'),1);
    //if (intval($GLOBALS['_CFG']['rewrite']))
    if (0)
    {
        echo 'TODO:get_navigator的rewrote的功能没有测试';
        if(strpos($cur_url, '-'))
        {
            preg_match('/([a-z]*)-([0-9]*)/',$cur_url,$matches);
            $cur_url = $matches[1].'.php?id='.$matches[2];
        }
    }
    else
    {
        $cur_url = substr(strrchr($_SERVER['REQUEST_URI'],'/'),1);
    }
    $noindex = false;
    $active = 0;
    $navlist = array(
        'top' => array(),
        'middle' => array(),
        'bottom' => array()
    );
    foreach($res as $key => $val){
        $navlist[$val['type']][] = array(
            'name'      =>  $val['name'],
            'opennew'   =>  $val['opennew'],
            'url'       =>  $val['url'],
            'ctype'     =>  $val['ctype'],
            'cid'       =>  $val['cid'],
            );
    }
    
    /*遍历自定义是否存在currentPage*/
    foreach($navlist['middle'] as $k=>$v)
    {
        if(empty($ctype)){
            $condition=(strpos($cur_url, $v['url']) === 0) ;
        }else{
            $condition=(strpos($cur_url, $v['url']) === 0 && strlen($cur_url) == strlen($v['url']));
        }
        
        if ($condition)
        {
            $navlist['middle'][$k]['active'] = 1;
            $noindex = true;
            $active += 1;
        }
    }
    if(!empty($ctype) && $active < 1)
    {
        foreach($catlist as $key => $val)
        {
            foreach($navlist['middle'] as $k=>$v)
            {
                if(!empty($v['ctype']) && $v['ctype'] == $ctype && $v['cid'] == $val && $active < 1)
                {
                    $navlist['middle'][$k]['active'] = 1;
                    $noindex = true;
                    $active += 1;
                }
            }
        }
    }

    if ($noindex == false) {
        $navlist['config']['index'] = 1;
    }

    return $navlist;
    
}

/**
 *  获取用户信息数组
 *
 * @access  public
 * @param
 *
 * @return array        $user       用户信息数组
 */
function get_user_info($id=0)
{
    $db_prefix=C('DB_PREFIX');
    if ($id == 0)
    {
        $id = $_SESSION['uid'];
    }
    $time = date('Y-m-d');
    $sql  = 'SELECT u.uid, u.email, u.username, u.user_money, u.pay_points'.
            ' FROM ' .$db_prefix.'user'. ' AS u ' .
            " WHERE u.user_id = '$id'";
    $user = M()->getRowSql($sql);
    $bonus = get_user_bonus($id);

    $user['username']    = $user['username'];
    $user['user_points'] = $user['pay_points'] . $GLOBALS['_CFG']['integral_name'];
    $user['user_money']  = price_format($user['user_money'], false);
    $user['user_bonus']  = price_format($bonus['bonus_value'], false);

    return $user;
}

/**
 * 查询会员的红包金额
 *
 * @access  public
 * @param   integer     $user_id
 * @return  void
 */
function get_user_bonus($user_id = 0)
{
    $db_prefix=C('DB_PREFIX');
    if ($user_id == 0)
    {
        $user_id = $_SESSION['uid'];
    }

    $sql = "SELECT SUM(bt.type_money) AS bonus_value, COUNT(*) AS bonus_count ".
            "FROM " .$db_prefix.'user_bonus'. " AS ub, ".
                $db_prefix.'bonus_type' . " AS bt ".
            "WHERE ub.user_id = '$user_id' AND ub.bonus_type_id = bt.type_id AND ub.order_id = 0";
    $row = M()->getRowSql($sql);

    return $row;
}

/**
 * 更新用户SESSION,COOKIE及登录时间、登录次数。
 *
 * @access  public
 * @return  void
 */
function update_user_info()
{
    $db_prefix=C('DB_PREFIX');
    if (!isset($_SESSION['uid']) || !$_SESSION['uid'])
    {
        return false;
    }
    echo __FILE__.'update_user_info';die;
    /* 查询会员信息 */
    $time = date('Y-m-d');
    $sql = 'SELECT u.user_money,u.email, u.pay_points, u.user_rank, u.rank_points, '.
            ' IFNULL(b.type_money, 0) AS user_bonus, u.last_login, u.last_ip'.
            ' FROM ' .$db_prefix.'user'. ' AS u ' .
            ' LEFT JOIN ' .$db_prefix.'user_bonus'. ' AS ub'.
            ' ON ub.user_id = u.uid AND ub.used_time = 0 ' .
            ' LEFT JOIN ' .$db_prefix.'bonus_type'. ' AS b'.
            " ON b.type_id = ub.bonus_type_id AND b.use_start_date <= '$time' AND b.use_end_date >= '$time' ".
            " WHERE u.user_id = '$_SESSION[uid]'";
}


/**
 * 生成链接后缀
 */
function list_link_postfix()
{
    return 'uselastfilter=1';
}



/**
 * 生成过滤条件：用于 get_goodslist 和 get_goods_list
 * @param   object  $filter
 * @return  string
 */
function get_where_sql($filter)
{
    $time = date('Y-m-d');

    $where  = isset($filter->is_delete) && $filter->is_delete == '1' ?
        ' WHERE is_delete = 1 ' : ' WHERE is_delete = 0 ';
    $where .= (isset($filter->real_goods) && ($filter->real_goods > -1)) ? ' AND is_real = ' . intval($filter->real_goods) : '';
    $where .= isset($filter->cat_id) && $filter->cat_id > 0 ? ' AND ' . get_children($filter->cat_id) : '';
    $where .= isset($filter->brand_id) && $filter->brand_id > 0 ? " AND brand_id = '" . $filter->brand_id . "'" : '';
    $where .= isset($filter->intro_type) && $filter->intro_type != '0' ? ' AND ' . $filter->intro_type . " = '1'" : '';
    $where .= isset($filter->intro_type) && $filter->intro_type == 'is_promote' ?
        " AND promote_start_date <= '$time' AND promote_end_date >= '$time' " : '';
    $where .= isset($filter->keyword) && trim($filter->keyword) != '' ?
        " AND (goods_name LIKE '%" . mysql_like_quote($filter->keyword) . "%' OR goods_sn LIKE '%" . mysql_like_quote($filter->keyword) . "%' OR goods_id LIKE '%" . mysql_like_quote($filter->keyword) . "%') " : '';
    $where .= isset($filter->suppliers_id) && trim($filter->suppliers_id) != '' ?
        " AND (suppliers_id = '" . $filter->suppliers_id . "') " : '';

    $where .= isset($filter->in_ids) ? ' AND goods_id ' . db_create_in($filter->in_ids) : '';
    $where .= isset($filter->exclude) ? ' AND goods_id NOT ' . db_create_in($filter->exclude) : '';
    $where .= isset($filter->stock_warning) ? ' AND goods_number <= warn_number' : '';

    return $where;
}


/**
 * 分页的信息加入条件的数组
 *
 * @access  public
 * @return  array
 */
function page_and_size($filter)
{
    if (isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0)
    {
        $filter['page_size'] = intval($_REQUEST['page_size']);
    }
    elseif (isset($_COOKIE['ZHCMS']['page_size']) && intval($_COOKIE['ZHCMS']['page_size']) > 0)
    {
        $filter['page_size'] = intval($_COOKIE['ZHCMS']['page_size']);
    }
    else
    {
        $filter['page_size'] = C('PAGE_SHOW_ROW');
    }
//$filter['page_size']=2;
    /* 每页显示 */
    $filter['page'] = (empty($_REQUEST['page']) || intval($_REQUEST['page']) <= 0) ? 1 : intval($_REQUEST['page']);

    /* page 总数 */
    $filter['page_count'] = (!empty($filter['record_count']) && $filter['record_count'] > 0) ? ceil($filter['record_count'] / $filter['page_size']) : 1;

    /* 边界处理 */
    if ($filter['page'] > $filter['page_count'])
    {
        $filter['page'] = $filter['page_count'];
    }

    $filter['start'] = ($filter['page'] - 1) * $filter['page_size'];

    return $filter;
}

/**
 * 创建一个JSON格式的错误信息
 *
 * @access  public
 * @param   string  $msg
 * @return  void
 */
function make_json_error($msg)
{
    make_json_response('', 1, $msg);
}


/**
 *
 *
 * @access  public
 * @param
 * @return  void
 */
function make_json_result($content, $message='', $append=array())
{
    make_json_response($content, 0, $message, $append);
}



/**
 * 创建一个JSON格式的数据
 *
 * @access  public
 * @param   string      $content
 * @param   integer     $error
 * @param   string      $message
 * @param   array       $append
 * @return  void
 */
function make_json_response($content='', $error="0", $message='', $append=array())
{
    //include_once(ROOT_PATH . 'includes/cls_json.php');

    //$json = new JSON;

    $res = array('error' => $error, 'message' => $message, 'content' => $content);

    if (!empty($append))
    {
        foreach ($append AS $key => $val)
        {
            $res[$key] = $val;
        }
    }

    $val = json_encode($res); //$json->encode($res);

    exit($val);
}

/**
 * 生成编辑器
 * @param   string  input_name  输入框名称
 * @param   string  input_value 输入框值
 */
function create_html_editor($input_name, $input_value = '')
{

    $editor = new FCKeditor($input_name);

    $editor->BasePath   = __ZHPHP_EXTEND__.'/Org/fckeditor/';
    $editor->ToolbarSet = 'Normal';
    $editor->Width      = '100%';
    $editor->Height     = '320';
    $editor->Value      = $input_value;
    $FCKeditor = $editor->CreateHtml();
    return $FCKeditor;
    
}



