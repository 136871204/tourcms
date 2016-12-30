<?php

/**
 * 内容管理
 * Class ContentControl
 * @author 周鸿 <136871204@qq.com>
 */
class ContentControl extends AuthControl {
	private $_category, $_model, $_cid, $_mid;
	private $ContentAccess;
	public function __init() {
		$this -> _category = cache('category');
		$this -> _model = cache('model');
		$this -> _cid = Q('cid', 0, 'intval');
		$this -> _mid = Q('mid', 0, 'intval');
		if ($this -> _cid) {
			if (!isset($this -> _category[$this -> _cid])) {
				$this -> error(L('admin_content_control_init_error'));
			}
		}
		$this->ContentAccess = K('ContentAccess');
	}

	//内容栏目选择页
	public function index() {
		$this -> display();
	}
	//异步获得目录树，内容左侧目录列表
	public function ajaxCategoryZtree() {
		$category = array();
		if (!empty($this -> _category)) {
			foreach ($this->_category as $n => $cat) {
				$data = array();
				//过滤掉外部链接栏目
                //cattype 1 栏目,2 封面,3 外部链接,4 单文章
				if ($cat['cattype'] != 3) {
					//单文章栏目
					if ($cat['cattype'] == 4) {
						$link = __WEB__ . "?a=Admin&c=Content&m=single&cid={$cat['cid']}&mid={$cat['mid']}";
						$url = "javascript:zh_open_window(\"$link\")";
					} else if ($cat['cattype'] == 1) {
					   //content_state 文章状态 1 已审核 0 未审核
						$url = U('content', array('cid' => $cat['cid'], 'mid' => $cat['mid'], 'content_state' => 1));
					} else {
						$url = 'javascript:;';
					}
					$data['id'] = $cat['cid'];
					$data['pId'] = $cat['pid'];
					$data['url'] = $url;
					$data['target'] = 'content';
					$data['open'] = true;
					$data['name'] = $cat['catname'];
					$category[] = $data;
				}
			}
		}
		$this -> ajax($category);
	}
	//内容列表
	public function content() {
		if (empty($this -> _mid)) {
			$this -> error(L('admin_content_control_content_error1'));
		}
		$ContentModel = ContentViewModel::getInstance($this -> _mid);
		//文章状态
		//content_state 文章状态 1 已审核 0 未审核
        $content_state = Q('get.content_state', 1, 'intval');
		$where = array();
		$where[] = $ContentModel -> tableFull . ".content_state=$content_state";
		//按时间搜索
		$search_begin_time = Q('post.search_begin_time', null, 'strtotime');
		if ($search_begin_time) {
			$where[] = "addtime>=$search_begin_time";
		}
		//按flag搜索
		if ($flag = Q('flag')) {
			$where[] = "find_in_set('$flag',flag)";
		}
		//按字段类型
		if (isset($_POST['search_type']) && !empty($_POST['search_type']) && !empty($_POST['search_keyword'])) {
			$search_keyword = $_POST['search_keyword'];
			switch(strtolower($_POST['search_type'])) {
				case 1 :
					//标题
					$where[] = "title LIKE '%$search_keyword%'";
					break;
				case 2 :
					$where[] = "description LIKE '%$search_keyword%'";
					//简介
					break;
				case 3 :
					//用户名
					$where[] = "username ='$search_keyword'";
					break;
				case 4 :
                    //TODO:在选择用户uid的时候，uid如果输入不是数字的话 会报错，之后在js这里可以处理
					//用户uid
					$where[] = $ContentModel -> tableFull . ".uid =$search_keyword";
					break;
			}
		}
		$search_end_time = Q('post.search_end_time', null, 'strtotime');
		if ($search_end_time) {
			$where[] = "addtime<=$search_end_time";
		}
        
        if($this -> _mid==8 
            || $this -> _mid==9
            ||  $this -> _mid==10
            ||  $this -> _mid==11
        ){
            if(isset($_GET['webid']) && !empty($_GET['webid'])){
                $webid = $_GET['webid'];
                $where[] = "webid = '$webid'";
            }
            
        }
        
		$where[] = C('DB_PREFIX') . "category.cid=" . $this -> _cid;
        //p($where);die;
		$page = new Page($ContentModel -> join('user,category') -> where($where) -> count(), 15);
		$data = $ContentModel -> join('user,category') -> where($where) -> limit($page -> limit()) -> order(array("arc_sort" => "ASC", 'aid' => "DESC")) -> all();
		$this -> assign('data', $data);
		$flagCache = cache($this -> _mid, false, FLAG_CACHE_PATH);
		$this -> assign('flag', $flagCache);
		$this -> assign('page', $page -> show());
		$this -> display();
	}

	//单文章管理
	public function single() {
		$cid = Q('cid',0,'intval');
		$ContentModel = ContentModel::getInstance($this -> _mid);
		$content = $ContentModel -> where(array('cid' =>$cid)) -> find();
		if ($content) {
			$_REQUEST['aid'] = $content['aid'];
			$this -> edit($_POST);
		} else {
			$this -> add();
		}
	}

	//添加文章
	public function add() {
	   
		if(!$this->ContentAccess->isAdd($this->_cid)){
			$this->error(L('admin_content_control_add_error1').'<script>setTimeout(function(){window.close();},1000)</script>');
		}
        
		if (IS_POST) {
			$ContentModel = new Content($this -> _mid);
            
			if ($ContentModel -> add($_POST)) {
			 
				$this -> success(L('admin_content_control_add_success1'));
			} else {
				$this -> error($ContentModel -> error);
			}
		} else {
			//获取分配字段
			$form = K('ContentForm');
            
			$this -> form = $form -> get();
            
			//分配验证规则
			$this -> formValidate = $form -> formValidate;
			$this -> display('add.php');
		}
	}

	//修改文章
	public function edit() {
		if(!$this->ContentAccess->isEdit($this->_cid)){
			$this->error(L('admin_content_control_edit_error1').'<script>setTimeout(function(){window.close();},1000)</script>');
		}
		if (!isset($this -> _model[$this -> _mid])) {
			$this -> error(L('admin_content_control_edit_error2'));
		}
		if (IS_POST) {
		  
          //p($_POST);die;
			$ContentModel = new Content($this -> _mid);
			if ($ContentModel -> edit($_POST)) {
				$this -> success(L('admin_content_control_edit_success1'));
			} else {
				$this -> error($ContentModel -> error);
			}
		} else {
			$aid = Q('aid', 0, 'intval');
			if (!$aid) {
				$this -> error(L('admin_content_control_edit_error3'));
			}
			$ContentModel = ContentModel::getInstance($this -> _mid);
			$editData = $ContentModel -> find($aid);
			//获取分配字段
			$form = K('ContentForm');
			$this -> assign('form', $form -> get($editData));
			//分配验证规则
			$this -> assign('formValidate', $form -> formValidate);
			$this -> assign('editData', $editData);
			$this -> display('edit.php');
		}
	}

	//删除文章
	public function del() {
		if(!$this->ContentAccess->isDel($this->_cid)){
			$this->error(L('admin_content_control_del_error1'));
		}
		$aid = Q('aid', 0);
		if ($aid) {
			$ContentModel = new Content($this -> _mid);
			if ($ContentModel -> del($aid)) {
				$this -> success(L('admin_content_control_del_success1'));
			} else {
				$this -> error($ContentModel -> error);
			}
		} else {
			$this -> error(L('admin_content_control_del_error2'));
		}
	}
	//排序
	public function order() {
		if(!$this->ContentAccess->isOrder($this->_cid)){
			$this->error(L('admin_content_control_order_error1'));
		}
		$arc_order = Q('arc_order');
		if (!empty($arc_order) && is_array($arc_order)) {
			$ContentModel = ContentModel::getInstance($this -> _mid);
			foreach ($arc_order as $aid => $order) {
				$ContentModel -> join(null) -> save(array('aid' => $aid, 'arc_sort' => $order));
			}
		}
		$this -> success(L('admin_content_control_order_success1'));
	}

	//审核文章
	public function audit() {
		if(!$this->ContentAccess->isAudit($this->_cid)){
			$this->error(L('admin_content_control_audit_error1'));
		}
		$content_state = Q('content_state', 0, 'intval');
		$aids = Q('aid');
		if (!empty($aids) && is_array($aids)) {
			$ContentModel = ContentModel::getInstance($this -> _mid);
			foreach ($aids as $aid) {
				$ContentModel -> save(array('aid' => $aid, 'content_state' => $content_state));
			}
		}
		$this -> success(L('admin_content_control_audit_success1'));
	}

	//移动文章
	public function move() {
		if(!$this->ContentAccess->isMove($this->_cid)){
			$this->error(L('admin_content_control_move_error1'));
		}
		if (IS_POST) {
			$ContentModel = ContentModel::getInstance($this -> _mid);
			//移动方式  1 从指定ID  2 从指定栏目
			$from_type = Q("post.from_type", NULL, "intval");
			//目标栏目cid
			$to_cid = Q("post.to_cid", NULL, 'intval');
			if ($to_cid) {
				switch ($from_type) {
					case 1 :
						//移动aid
						$aid = Q("post.aid", NULL, "trim");
						$aid = explode("|", $aid);
						if ($aid && is_array($aid)) {
							foreach ($aid as $id) {
								if (is_numeric($id))
									$ContentModel -> join(null) -> save(array("aid" => $id, "cid" => $to_cid));
							}
						}
						break;
					case 2 :
						//来源栏目cid
						$from_cid = Q("post.from_cid", NULL, 'intval');
						if ($from_cid) {
							foreach ($from_cid as $d) {
								if (is_numeric($d))
									$ContentModel -> join(null) -> where("cid=$d") -> save(array("cid" => $to_cid));
							}
						}
						break;
				}
			}
			$this -> success(L('admin_content_control_move_success1'));
		} else {
			$category = array();
			foreach ($this->_category as $n => $v) {
				//排除非本模型或外部链接类型栏目或单文章栏目
				if ($v['mid'] != $this -> _mid || $v['cattype'] == 3 || $v['cattype'] == 4) {
					continue;
				}
				$selected = '';
				if ($this -> _cid == $v['cid']) {
					$v['selected'] = "selected";
				}
				//非本栏目模型关闭
				if ($v['cattype'] != 1) {
					$v['disabled'] = 'disabled';
				}
				$category[$n] = $v;
			}
			$this -> category = $category;
			$this -> display();
		}
	}

}
