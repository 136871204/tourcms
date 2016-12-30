<?php
/**
 * 系统消息
 * Class SystemMessageControl
 * @author 周鸿 <136871204@qq.com>
 */
class SystemMessageControl extends MemberAuthControl
{

    //私信列表
    public function index()
    {
    	$Model = K('SystemMessage');
		//修改状态
		$Model -> join() -> where(array('uid'=>$_SESSION['uid'])) -> save(array('state' => 1));
		$count = $Model->where(array('uid'=>$_SESSION['uid']))->count();
        $page = new Page($count, 10);
        $this->data =$Model->where(array('uid'=>$_SESSION['uid']))->limit($page->limit())->order("mid DESC")->all();
        $this->page = $page->show();
        $this->display();
    }
}