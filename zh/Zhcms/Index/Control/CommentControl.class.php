<?php
/**
 * 评论
 * Class CommonControl
 * @author 周鸿<136871204@qq.com>
 */
class CommentControl extends CommonControl {
	//显示文章评论
	public function show() {
		$cid = Q('cid', 0, 'intval');
		$aid = Q('aid', 0, 'intval');
		$Model = K('Comment');
		$where = "comment_state=1 AND cid={$cid} AND aid=$aid";
		$count = $Model -> join() -> where($where) -> where("pid=0 ") -> count();
		$page = new Page($count, 15);
		$data = array();
		if ($count) {
			//获得1级回复的id
			$result = $Model -> where($where) -> where("pid=0 ") -> limit($page -> limit()) -> order("comment_id desc") -> getField('comment_id', true);
			
            $comment_id = implode(',', $result);
			$data = $Model -> where("comment_state=1 AND (comment_id IN ($comment_id) OR reply_comment_id IN ($comment_id))") -> order("comment_id desc") -> all();
			
            //设置头像(没有头像的用户使用默认头像)
			foreach ($data as $n => $d) {
				if (empty($d['icon'])) {
					$data[$n]['icon'] = __ROOT__ . "/data/image/user/50-gray.png";
				} else {
					$data[$n]['icon'] = __ROOT__ . '/' . $d['icon'];
				}
			}
		}
		//获得多层
		$data = Data::channelLevel($data, 0, '', 'comment_id');
        //p($data);
		$this -> assign('page', $page -> show());
		$this -> assign('data', $data);
		$con = $this -> fetch('index.php');
		if (Q('page')) {
		  //echo "document.write('<div id=\"zhcomment\">" . preg_replace('@\r|\n@mi', '', addslashes($con)) . "</div>')";
			echo $con;
		} else {
			echo "document.write('<div id=\"zhcomment\">" . preg_replace('@\r|\n@mi', '', addslashes($con)) . "</div>')";
		}
		exit ;
	}

	//添加评论
	public function addComment() {
		$Model = K('Comment');
		$ModelCache= cache('model');
		$mid = Q('mid',0,'intval');
		$cid = Q('cid', 0, 'intval');
		$aid = Q('aid', 0, 'intval');
		if (!session("uid")) {
			$this -> _ajax('nologin', 'ログインしていない');
		}
		//-验证评论发表间隔时间
		Q('session.comment_send_time', 0, 'intval');
		//间隔时间小于配置项
		if (!IN_ADMIN && Q('session.comment_send_time') + C('comment_step_time') > time()) {
			$_time = Q('session.comment_send_time') + C('comment_step_time') - time();
			$step = $_time / 60 > 1 ? intval($_time / 60) . '分' : $_time . '秒';
			$this -> error('' . $step . '後発表してください');
		}
		$content=Q('content');
		if (!$content) {
			$this -> error('評論内容は必須');
		}
		$state = $Model -> where("cid={$cid} && aid={$aid} && " . C("DB_PREFIX") . "comment.uid=" . session('uid')) 
						-> where("content='$content'") -> order("comment_id DESC") -> find();
		if ($state) {
			$this -> error('重複内容を発表しないでください');
		}
		//添加积分
		$reply_credits = intval(C('reply_credits'));
		$credits_msg = '';
		if ($reply_credits) {
		  //TODO:当前用户加分
			$sql = "UPDATE " . C('DB_PREFIX') . 'user AS u SET credits=credits+' . $reply_credits.' where u.uid='.session('uid');
			M() -> exe($sql);
			$_SESSION['credits'] += $reply_credits;
			$credits_msg = '' . $reply_credits . '積分を取得';
		}
		//添加
		if ($comment_id = $Model -> addComment()) {
			//记录发表时间
			session('comment_send_time', time());
			//修改文章评论数
			M($ModelCache[$mid]['table_name']) -> inc('comment_num', 'aid=' . $aid);
			$comment_state = M('role')->where('rid='.$_SESSION['rid'])->getField('comment_state');
			if($comment_state == 1 || IN_ADMIN){
				$comment = $this -> getCommentHtml($comment_id);
				$msg =  'コメント成功！' . $credits_msg;
			}else{
				$comment='';
				$msg =  'コメント成功，審査号表示';
			}
			//添加动态
			$Message= mb_substr($content, 0, 30, 'utf-8');
			$DyMessge = "<a target='_blank' href='".__WEB__."?a=Index&c=Index&m=content&mid={$mid}&cid={$cid}&aid={$aid}'>".$Message."</a>";
			addDynamic($_SESSION['uid'],"コメントを発表: " . $DyMessge);
			//向文章作者发送系统消息
			$article = M($ModelCache[$mid]['table_name'])->where("aid=$aid")->find();
			$articleUrl = __WEB__."?a=Index&c=Index&m=content&mid={$mid}&cid={$cid}&aid={$aid}";
			$title = mb_substr($article['title'], 0,30,'utf-8');
			addSystemMessage($_SESSION['uid']," <a target='_blank' href='".$articleUrl."'>{$title}</a>新しいコメントがある");
			$this -> _ajax(1,$msg, $comment);
		} else {
			$this -> error('失敗しました');
		}
	}

	/**
	 * 获得刚刚发表的评论用于显示
	 * @param $comment_id 评论comment_id
	 * @return string
	 */
	public function getCommentHtml($comment_id) {
		$Model = K('Comment');
		$data = $Model-> find($comment_id);
		//设置头像
		if (empty($data['icon'])) {
			$data['icon'] = __ROOT__ . "/data/image/user/50.png";
		} else {
			$data['icon'] = __ROOT__ . '/' . $data['icon'];
		}
		$comment = <<<str
<li>
                    <div class="zh-comment-face">
                         <a href="?{$data['username']}"><img src="{$data['icon']}"/></a>
                    </div>
                    <div class="zh-comment-content">
                        {$data['content']}
                        <div class="zh-author-info">
                            <span class="zh-comment-author">
                                <a href="?{$data['username']}"> {$data['username']}</a>&nbsp;&nbsp;
                            </span>
                            先
                        </div>
                    </div>
</li>
str;
		return $comment;
	}
}
