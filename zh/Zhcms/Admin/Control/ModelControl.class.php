<?php

/**
 * 内容模型管理模块
 * Class ModelControl
 * @author 周鸿 <136871204@qq.com>
 */
class ModelControl extends AuthControl {
	/**
	 * 模型列表
	 */
	public function index() {
		$this -> assign('model',cache("model"));
		$this -> display();
	}

	/**
	 * 验证模型是否存在
	 */
	public function check_model() {
		$Model = M("model");
		if (isset($_POST['tablename'])) {
			if (!$Model -> find("tablename='{$_POST['tablename']}'")) {
				$this -> ajax(1);
			}
		}
	}

	/**
	 * 更新缓存
	 */
	public function updateCache() {
		$Model = K("Model");
		if ($Model -> updateCache()) {
			$this -> success( L('admin_model_control_update_cache_success'));
		} else {
			$this -> error($Model -> error);
		}
	}

	/**
	 * 删除模型
	 */
	public function del() {
		$mid = Q('mid', 0, 'intval');
		//验证栏目
		$categoryModel = M('category');
		if ($categoryModel -> find(array('mid' => $mid))) {
			$this -> error( L('admin_model_control_del_error'));
		}
		$ModelDb = K("Model");
		if ($ModelDb -> delModel($mid)) {
			$this -> success(L('admin_model_control_del_success'));
		} else {
			$this -> error( $ModelDb -> error);
		}
	}

	/**
	 * 添加模型
	 */
	public function add() {
		if (IS_POST) {
			$Model = K("Model");
			if ($Model -> addModel($_POST)) {
				$this -> success( L('admin_model_control_add_success'));
			} else {
				$this -> error( $Model -> error);
			}
		} else {
			$this -> display();
		}
	}

	/**
	 * 编辑模型
	 */
	public function edit() {
		$mid = Q('mid', 0, 'intval');
		if (!$mid) {
			$this -> error( L('admin_model_control_edit_error'));
		}
		if (IS_POST) {
			$Model = K("Model");
			//异步提交返回信息
			if ($Model -> editModel($_POST)) {
				$this -> success( L('admin_model_control_edit_success'));
			}else{
				$this->error($Model->error);
			}
		} else {
			$ModelCache = cache('model');
			$this -> field = $ModelCache[$mid];
			$this -> display();
		}
	}

	//Ajax验证模型名是否存在
	public function checkModelName() {
		$mid = Q('mid',0,'intval');
		$Model =M('model');
		if ($mid) {
			//编辑时验证模型名
			if (!$Model -> find(array("model_name" => $_POST['model_name'], "mid" => array("neq" => $mid)))) {
				$this -> ajax(1);
			}
		} else {
			//添加时验证模型名
			if (!$Model -> find(array("model_name" => $_POST['model_name']))) {
				$this -> ajax(1);
			}
		}
		$this -> ajax(0);
	}

	//Ajax验证模型表名是否已经存在
	public function checkTableName() {
		$Model =M('model');
		if (!$Model -> tableExists($_POST['table_name'])) {
			$this -> ajax(1);
		}
		$this -> ajax(0);
	}

}
