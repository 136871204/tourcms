<?php
/**
 * 短消息管理
 * Class MessageControl
 */
class MessageControl extends MemberAuthControl
{
    public $_db;

    public function __init()
    {
        $this->_db = K('Message');
    }

    //私信列表
    public function index()
    {
        $where = 'to_uid=' . $_SESSION['uid'];
        $sql = "SELECT count(distinct from_uid) AS c FROM " . C("DB_PREFIX") . "user_message AS um
                WHERE to_uid=" . $_SESSION['uid'] ." ORDER BY mid DESC";
        //echo $sql;die;
        $count = $this->_db->query($sql);
        $page = new Page($count[0]['c'], 10);
        //p($page->limit());die;
        $limitArr=$page->limit();
        //echo ''.$limitArr['limit'];die;
        //TODO这里的逻辑然后再调整
        $showSql="select t1.* from 
                    (
                        SELECT 
                            * 
                        FROM " . C("DB_PREFIX") . "user_message 
                            INNER JOIN " . C("DB_PREFIX") . "user 
                            ON " . C("DB_PREFIX") . "user.uid=" . C("DB_PREFIX") . "user_message.from_uid 
                        WHERE to_uid=" . $_SESSION['uid'] . " 
                        ORDER BY mid DESC 
                    ) AS t1  
                GROUP BY t1.from_uid  LIMIT  ".$limitArr['limit'];
        //echo $showSql;die;
        //$this->data = $this->_db->where($where)->limit($page->limit())->order("mid DESC")->group('from_uid')->all();
        //"select t1.* from (SELECT * FROM zh_user_message INNER JOIN zh_user ON zh_user.uid=zh_user_message.from_uid WHERE to_uid=1 ORDER BY mid DESC ) AS t1  GROUP BY t1.from_uid  LIMIT 0,10  ";
        //$this->data = $this->_db->where($where)->limit($page->limit())->order("user_message_state ,mid desc ")->all();
       $this->data = $this->_db->query($showSql);
        $this->page = $page->show();
        $this->count = $count;
        $this->display();
    }

    // 查看私信
    public function show()
    {
    	$Model =  K('Message');
        $from_uid = Q('from_uid', null, 'intval');
        if ($from_uid) {
            $uid= $_SESSION['uid'];
            $sql = "SELECT * FROM " . C("DB_PREFIX") . "user_message AS um
                WHERE (um.from_uid={$from_uid} AND um.to_uid={$uid}) or
                (um.from_uid={$uid} AND um.to_uid={$from_uid}) ORDER BY mid DESC
                ";
            $this->data = $this->_db->query($sql);
            //更改私信状态为已读
            $Model->where("from_uid={$from_uid} AND to_uid={$uid}")->save(array('user_message_state' => 1));
            $this->display();
        } else {
            $this->error('参数错误');
        }
    }

    //发送私信
    public function send()
    {
        $to_uid = Q('to_uid', null, 'intval');
        if (!isset($_SESSION['uid'])) {
            $this->_ajax(0, 'ログインして後操作してください');
        } else if ($to_uid == $_SESSION['uid']) {
            $this->_ajax(0, '自分にメッセージするのはできない　！');
        } else if (!$to_uid) {
            $this->_ajax(0, 'パラメータエラー');
        } else {
            $data = array(
                'from_uid' => $_SESSION['uid'],
                'to_uid' => $to_uid,
                'content' => Q('content'),
                'sendtime' => time()
            );
            $db = M('user_message');
            if ($db->add($data)) {
                $this->_ajax(1, 'メッセージ送信成功');
            } else {
                $this->_ajax(0, 'メッセージ送信失敗！');
            }
        }
    }
    //回复私信
    public function reply()
    {
        $_POST['from_uid'] = $_SESSION['uid'];
        $_POST['sendtime'] = time();
        if ($this->_db->add()) {
            $this->_ajax(1, '返事成功');
        } else {
            $this->_ajax(0, '返事失敗');
        }
    }
}