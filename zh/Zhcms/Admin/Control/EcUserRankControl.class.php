<?php
/**
 * ブランド管理
 * @author 周鸿 <136871204@qq.com>
 */
class EcUserRankControl extends AuthControl {
    protected $db;
    
    public function __init() {
		$this -> db = K("EcUserRank");
	}
    
	//ブランド一覧
	public function index() {
	    $count = $this -> db -> count();
		$page = new Page($count);
		$this -> page = $page -> show();
		$ranks = $this -> db -> limit($page -> limit()) -> all();
        
        $this -> user_ranks = $ranks;
		$this -> display();
	}
    
    //添加
	public function add() {
	    $adminLogModel=K("AdminLog");
        
		if (IS_POST) {
            //p($_REQUEST);die;
            $special_rank =  isset($_POST['special_rank']) ? intval($_POST['special_rank']) : 0;
            $_POST['min_points'] = empty($_POST['min_points']) ? 0 : intval($_POST['min_points']);
            $_POST['max_points'] = empty($_POST['max_points']) ? 0 : intval($_POST['max_points']);
            if(!$this -> db->is_only('rank_name',trim($_POST['rank_name']))){
                $this -> error("会员等级名称重复");
            }
            
            /* 非特殊会员组检查积分的上下限是否合理 */
            if ($_POST['min_points'] >= $_POST['max_points'] && $special_rank == 0)
            {
                $this -> error("积分上限必须大于积分下限");

            }
            
            
            /* 特殊等级会员组不判断积分限制 */
            if ($special_rank == 0)
            {
                /* 检查下限制有无重复 */
                if (!$this -> db->is_only('min_points', intval($_POST['min_points'])))
                {
                    $this -> error("积分下限重复");
                }
            }   
            
            
            /* 特殊等级会员组不判断积分限制 */
            if ($special_rank == 0)
            {
                /* 检查上限有无重复 */
                if (!$this -> db->is_only('max_points', intval($_POST['max_points'])))
                {
                    $this -> error("积分上限重复");
                }
            }
            
            $sql = "INSERT INTO " .$this -> db->tableFull ."( ".
                    "rank_name, min_points, max_points, discount, special_rank, show_price".
                ") VALUES (".
                    "'$_POST[rank_name]', '" .intval($_POST['min_points']). "', '" .intval($_POST['max_points']). "', ".
                    "'$_POST[discount]', '$special_rank', '" .intval($_POST['show_price']). "')";
            $this -> db->exe($sql);
            $adminLogModel->admin_log(trim($_POST['rank_name']),"添加","EC会员等级(ec_user_rank)");
            $this -> success("添加成功");
		} else {
            $rank['rank_id']      = 0;
            $rank['rank_special'] = 0;
            $rank['show_price']   = 1;
            $rank['min_points']   = 0;
            $rank['max_points']   = 0;
            $rank['discount']     = 100;
            $this->rank=$rank;
			$this -> display();
		}
	}
    
    //修改
	public function edit() {
	    $adminLogModel=K("AdminLog");
		if (IS_POST) {
			$special_rank =  isset($_POST['special_rank']) ? intval($_POST['special_rank']) : 0;
            $_POST['min_points'] = empty($_POST['min_points']) ? 0 : intval($_POST['min_points']);
            $_POST['max_points'] = empty($_POST['max_points']) ? 0 : intval($_POST['max_points']);
            $_POST['rank_id'] = empty($_POST['rank_id']) ? 0 : intval($_POST['rank_id']);
            if(!$this -> db->is_only('rank_name',trim($_POST['rank_name']),$_POST['rank_id'])){
                $this -> error("会员等级名称重复");
            }
            
            /* 非特殊会员组检查积分的上下限是否合理 */
            if ($_POST['min_points'] >= $_POST['max_points'] && $special_rank == 0)
            {
                $this -> error("积分上限必须大于积分下限");

            }
            
            
            /* 特殊等级会员组不判断积分限制 */
            if ($special_rank == 0)
            {
                /* 检查下限制有无重复 */
                if (!$this -> db->is_only('min_points', intval($_POST['min_points']),$_POST['rank_id']))
                {
                    $this -> error("积分下限重复");
                }
            }   
            
            
            /* 特殊等级会员组不判断积分限制 */
            if ($special_rank == 0)
            {
                /* 检查上限有无重复 */
                if (!$this -> db->is_only('max_points', intval($_POST['max_points']),$_POST['rank_id']))
                {
                    $this -> error("积分上限重复");
                }
            }
            if($this->db->update())
            {
                $adminLogModel->admin_log(trim($_POST['rank_name']),"修改","EC会员等级(ec_user_rank)");
                $this -> success("修改成功");
                
            }else{
                $this -> success("修改失败");
            }
		} else {
			$rank_id = Q("rank_id",0, "intval");
			if ($rank_id) {
				$field = $this -> db-> find($rank_id);
				$this->assign('rank',$field);
				$this -> display();
			}
		}
	}
    
    //删除
	public function del() {
	    $adminLogModel=K("AdminLog");
		$rank_id = Q('rank_id', 0, 'intval');
        $result = $this -> db->where(array('rank_id' => $rank_id))->find();
        if(count($result)>0){
            if($this -> db ->del('rank_id = '.$rank_id)){
                $adminLogModel->admin_log(trim($result['rank_name']),"删除","EC会员等级(ec_user_rank)");
                $this -> success("削除成功");
            }else{
                $this -> error("削除失敗");
            }
        }else{
            $this -> error("削除失敗");
        }
	}
 


	

	

	
    
    
}
