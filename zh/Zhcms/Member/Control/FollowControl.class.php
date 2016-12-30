<?php

/**
 * 粉丝与关注
 * Class FollowControl
 */
class FollowControl extends MemberAuthControl
{
    /**
     * 用户关注处理
     */
    public function follow()
    {
        $uid = Q('uid', 0, 'intval');
        if ($uid) {
        	$username = M('user')->where('uid='.$uid)->getField('username');
            $db = M('user_follow');
            $result = $db->where("uid={$uid} AND fans_uid={$_SESSION['uid']}")->find();
            if ($result) {
                //取消关注
                $db->where("uid={$uid} AND fans_uid={$_SESSION['uid']}")->del();
                $this->_ajax(1, array('message' => '注目取消成功', 'follow' => '注目'));
            } else {
                if ($db->add(array('uid' => $uid, 'fans_uid' => $_SESSION['uid']))) {
                	$Dlink = "<a target='_blank' href='?a=Member&c=Space&m=index&u={$uid}'>$username</a>";
					//============记录动态
					$UserDynamicModel = K('UserDynamic');
					$UserDynamicModel->addDynamic($_SESSION['uid'],'注目：'.$Dlink);
                    if ($db->where("uid={$_SESSION['uid']} AND fans_uid={$uid}")->find()) {
                        $this->_ajax(1, array('message' => '注目成功', 'follow' => 'お互い注目'));
                    } else {
                        $this->_ajax(1, array('message' => '注目成功', 'follow' => '注目済み'));
                    }
                } else {
                    $this->_ajax(0, '操作失敗');
                }
            }
        } else {
            $this->_ajax(0, 'パラメータエラー');
        }
    }

    /**
     * 粉丝列表
     */
    public function fans_list()
    {
        $db = V('user_follow');
        $db->view = array(
            'user' => array(
                'type' => INNER_JOIN,
                'on' => 'user.uid=user_follow.fans_uid'
            )
        );
        $pre = C("DB_PREFIX");
        $count = $db->where($pre . "user_follow.uid=" . $_SESSION['uid'])->count();
        $page = new Page($count, 9);
        $this->page = $page->show();
        $data = $db->limit($page->limit())->where($pre . "user_follow.uid=" . $_SESSION['uid'])->all();
        if (!empty($data)) {
            foreach ($data as $n => $d) {
                //我是否关注对方
                $r = $db->join()->where("fans_uid=" . $_SESSION['uid'] . " AND uid={$d['uid']}")->find();
                if ($r) {
                    $follow = 'お互い注目';
                } else {
                    $follow = '注目済み';
                }
                $data[$n]['follow'] = $follow;
            }
        }
        $this->data = $data;
        $this->display();
    }

    /**
     * 关注列表
     */
    public function follow_list()
    {
        $db = V('user_follow');
        $db->view = array(
            'user' => array(
                'type' => INNER_JOIN,
                'on' => 'user.uid=user_follow.uid'
            )
        );
        $pre = C("DB_PREFIX");
        $count = $db->where($pre . "user_follow.fans_uid=" . $_SESSION['uid'])->count();
        $page = new Page($count, 9);
        $this->page = $page->show();
        $data = $db->limit($page->limit())->where($pre . "user_follow.fans_uid=" . $_SESSION['uid'])->all();
        if (!empty($data)) {
            foreach ($data as $n => $d) {
                //对方是否关注我
                $r = $db->join()->where("uid=" . $_SESSION['uid'] . " AND fans_uid={$d['uid']}")->find();
                if ($r) {
                    $follow = 'お互い注目';
                } else {
                    $follow = '注目済み';
                }
                $data[$n]['follow'] = $follow;
            }
        }
        $this->data = $data;
        $this->display();
    }

}