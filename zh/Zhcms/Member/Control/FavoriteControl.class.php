<?php
/**
 * 收藏夹管理
 * Class FavoriteControl
 */
class FavoriteControl extends MemberAuthControl {
	//列表
	public function index() {
		$Model = K('Favorite');
		$where = C('DB_PREFIX') . 'favorite.uid=' . $_SESSION['uid'];
		$count = $Model -> join() -> where($where) -> count();
		$page = new Page($count, 10);
        //TODO:收藏修正
        $result=$Model -> where($where) -> limit($page -> limit()) -> all();
        foreach($result as $key => $value){
            $modelCache = cache('model');
			$table = $modelCache[$value['mid']]['table_name'];
            $aid=$value['aid'];
            $contentResutlt=M($table)->where(" aid = {$aid} ")->find();
            $result[$key]['content']=$contentResutlt;
           // echo $contentResutl['title'].'<br/>';
           // echo $table;
        }
        //$this -> data = $Model -> where($where) -> limit($page -> limit()) -> all();
        $this -> data=$result;
		
		$this -> page = $page -> show();
		$this -> count = $count;
		$this -> display();
	}

	//删除收藏
	public function del() {
		$Model = M('favorite');
		$fid = Q('fid', 0, 'intval');
		if ($Model -> del($fid)) {
			$this -> success('削除成功');
		}
	}

}
