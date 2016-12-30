<?php

/**
 * 文章管理
 * Class ContentControl
 */
class ContentControl extends MemberAuthControl {
	//栏目缓存
	private $_category;
	//模型缓存
	private $_model;
	//模型mid
	private $_mid;
	//栏目cid
	private $_cid;
	private $ContentAccess;

	//构造函数
	public function __init() {
		$this -> _model = cache("model", false);
		$this -> _category = cache("category", false);
		$this -> _mid = Q('mid', null, 'intval');
		$this -> _cid = Q("cid", null, "intval");
		$this -> _aid = Q("aid", null, "intval");

		if ($this -> _mid && !isset($this -> _model[$this -> _mid])) {
			$this -> error("Modelは存在しない！");
		}
		if ($this -> _cid && !isset($this -> _category[$this -> _cid])) {
			$this -> error("カテゴリは存在しない！");
		}
		$this->ContentAccess = K('ContentAccess');
	}

	//文章列表
	public function index() {
		$ContentModel = ContentViewModel::getInstance($this -> _mid);
		$where = "uid=" . $_SESSION['uid'];
		$page = new Page($ContentModel -> join('category') -> where($where) -> count(), 15);
		$data = $ContentModel -> join('category') -> where($where) -> limit($page -> limit()) -> order(array("arc_sort" => "ASC", 'aid' => "DESC")) -> all();
		$this -> assign('data', $data);
		$this -> display();
	}

	//发表文章前选择栏目
	public function selectCategory() {
		$categoryCache = cache('category');
		$category = array();
		foreach ($categoryCache as $cat) {
			//去除单文章
			if($cat['cattype']==4)continue;
			if ($cat['mid'] == $this -> _mid) {
				$category[] = $cat;
			}
		}
		$this -> assign("category", $category);
		$this -> display();
	}

	//发表文章
	public function add() {
		if(!$this->ContentAccess->isAdd($this->_cid)){
			$this->error('操作権限がない<script>setTimeout(function(){window.close();},1000)</script>');
		}
		if (IS_POST) {
			$mid = $this->_category[$this->_cid]['mid'];
			$ContentModel = new Content($mid);
			if ($aid = $ContentModel -> add($_POST)) {
				$this -> success('発表成功！');
			} else {
				$this -> error($ContentModel -> error);
			}
		} else {
			if (!$this -> _cid) {
				$this -> error('カテゴリは必須');
			}
			$category = $this -> _category[$this -> _cid];
			$_REQUEST['mid'] = $mid = $category['mid'];
			if ($category['cattype'] != 1) {
				$this -> error('今のカテゴリは文章発表できません');
			}
			//获取分配字段
			$form = K('ContentForm');
			$this -> form = $form -> get();
			//分配验证规则
			$this -> formValidate = $form -> formValidate;
			$this -> display();
		}
	}

	//修改文章
	public function edit() {
		if(!$this->ContentAccess->isEdit($this->_cid)){
			$this->error('操作権限がない<script>setTimeout(function(){window.close();},1000)</script>');
		}
		$aid = Q('aid', 0, 'intval');
		if (!$aid) {
			$this -> error('文章は存在しない');
		}
		$mid = $this->_category[$this->_cid]['mid'];
		$ContentModel = new Content($mid);
		$result = $ContentModel -> find($aid);
		if ($result['uid'] != $_SESSION['uid']) {
			$this -> error('修正権限がない');
		}
		if (IS_POST) {
			if ($ContentModel -> edit($_POST)) {
				$this -> success('発表成功！');
			} else {
				$this -> error($ContentModel -> error);
			}
		} else {
			$aid = Q('aid', 0, 'intval');
			if (!$aid) {
				$this -> error('パラメータエラー');
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

	/**
	 * 删除文章
	 */
	public function del() {
		if(!$this->ContentAccess->isDel($this->_cid)){
			$this->error('操作権限がない');
		}
		$aid = Q('aid', 0, 'intval');
		if (!$aid) {
			$this -> error('文章は存在しない');
		}
		$ContentModel = new Content($this -> _mid);
		$result = $ContentModel -> find($aid);
		if ($result['uid'] != $_SESSION['uid']) {
			$this -> error('削除権限がない');
		}
		if ($ContentModel -> del($aid)) {
			$this -> success('削除成功');
		} else {
			$this -> error('aidパラメータエラー');
		}
	}

}
