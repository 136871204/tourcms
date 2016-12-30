<?php
/**
 * 调用购物车信息
 *
 * @access  public
 * @return  string
 */
function insert_cart_info()
{
    $db_prefix=C('DB_PREFIX');
    $sql = 'SELECT SUM(goods_number) AS number, SUM(goods_price * goods_number) AS amount' .
           ' FROM ' . $db_prefix.'cart' .
           " WHERE session_id = '" . SESS_ID . "' AND rec_type = '" . CART_GENERAL_GOODS . "'";
    $row = M()->GetRowSql($sql);
   // p($row);die;
    $number=empty($row['number'])?0:intval($row['number']);
    $number=empty($row['amount'])?0:floatval($row['number']);
    /*if ($row)
    {
        $number = intval($row['number']);
        $amount = floatval($row['amount']);
    }
    else
    {
        $number = 0;
        $amount = 0;
    }*/

    $str = sprintf('您的购物车中有 %d 件商品，总计金额 %s。', $number, price_format($amount, false));

    return '<a href="flow.php" title="' . '查看购物车' . '">' . $str . '</a>';
}


/**
 * 调用在线调查信息
 *
 * @access  public
 * @return  string
 */
function insert_vote()
{
    $vote = get_vote();
    $file = ROOT_PATH.'template/'.C('WEB_STYLE') . '/ec/library/vote.lbi';
    //echo $file;

    $view = new ViewZh();
    
    if (!empty($vote))
    {
        $view->assign('vote_id',     $vote['id']);
        $view->assign('vote',        $vote['content']);
    }
   
    return $view->fetch($file);

}