<?php

/**
 * 模型字段管理
 * Class ModelControl
 */
class FieldControl extends AuthControl {
	//模型mid
	private $_mid;
	//模型缓存
	private $_model;

	//构造函数
	public function __init() {
		//模型mid
		$this -> _mid = Q("mid", 0, "intval");
		//验证模型mid
		if (!$this -> _mid) {
			$this -> error(L('admin_field_control_init_error1'));
		}
		//模型缓存
		$this -> _model = cache("model");
	}

	//字段列表
	public function index() {
		
		//不允许删除字段
		$this -> assign('noallowdelete', ModelFieldModel::$NoAllowDelete);
		//不允许禁用字段
		$this -> assign('noallowforbidden', ModelFieldModel::$NoAllowForbidden);
		$fieldCache = cache($this -> _mid, false, FIELD_CACHE_PATH);
		$this -> field = $fieldCache;
		$this -> display();
	}

	//更新字段排序
	public function updateSort() {
		$orders = Q("fieldsort");
		if ($orders) {
			$model =new ModelFieldModel($this->_mid);
			foreach ($orders as $k => $v) {
				$model -> join(null) -> save(array("fid" => $k, "fieldsort" => $v));
			}
			$model -> updateCache(intval($_GET['mid']));
			$this -> _ajax(1, L('admin_field_control_update_sort_success1'));
		} else {
			$this -> _ajax(0, $model -> error);
		}
	}

	//添加字段
	public function add() {
		if (IS_POST) {
			$post = $_POST;
			if (empty($post)) {
				$this -> error(L('admin_field_control_add_error1'));
			}
			$fieldModel = new ModelFieldModel($this->_mid);
			if ($fieldModel -> addField($post)) {
				$this -> success(L('admin_field_control_add_success1'));
			}
		} else {
			//不允许删除字段
			$this -> assign('noallowhide', ModelFieldModel::$NoAllowHide);
			$this -> model = $this -> _model[$this -> _mid];
			$this -> display();
		}
	}

	/**
	 * 修改字段
	 */
	public function edit() {
		$fieldModel =new ModelFieldModel($this->_mid);
		$mid = Q('mid', 0, 'intval');
		$fid = Q('fid', 0, 'intval');
        
		if (!$fid) {
			$this -> error(L('admin_field_control_edit_error1'));
		}
		if (IS_POST) {
			$post = $_POST;
			if (empty($post)) {
				$this -> error(L('admin_field_control_edit_error2'));
			}
			if ($fieldModel -> editField($post)) {
				$this -> success(L('admin_field_control_edit_success1'));
			}
		} else {
			$fieldCache = cache($mid, false, FIELD_CACHE_PATH);
			$modelCache = cache('model');
			$field_name = M('field') -> where(array('fid' => $fid)) -> getField('field_name');
			$field = $fieldCache[$field_name];
			$this -> field = $field;
			$this -> model_name = $modelCache[$mid]['model_name'];
			//不允许删除字段
			$this -> assign('noallowhide', ModelFieldModel::$NoAllowHide);
			$this -> display();
		}
	}

	//验证字段是否已经存在
	public function field_is_exists() {
		$field_name = Q('field_name');
		$table = $this -> _model[Q('mid')]['table_name'];
		$state = M() -> fieldExists($field_name, $table) ? 0 : 1;
		if ($state) {
			$state = M() -> fieldExists($field_name, $table . '_data') ? 0 : 1;
		}
		$this -> ajax($state);
	}

	//选择字段类型模板
	public function get_field_tpl() {
	   //echo APP.DS.CONTROL.DS.$_SESSION['language'];die;
	    C('language',APP.DS.CONTROL.DS.$_SESSION['language']);
        $language=L();
		//模板类型如add edit
		$tpl_type = Q("post.tpl_type");
		//字段类型如input textarea
		$field_type = Q("post.field_type");
		$this -> assign('field_type',$field_type) ;
		ob_start();
		require APP_PATH . "Data/Field/{$field_type}/form_{$tpl_type}.inc.php";
		echo ob_get_clean();
		exit;
	}

	/**
	 * 删除字段
	 */
	public function del() {
		$fid = Q('fid');
		if ($fid) {
			$fieldModel = new ModelFieldModel($this->_mid);
			if ($fieldModel -> delField())
				$this -> _ajax(1, L('admin_field_control_del_success1'));
		} else {
			$this -> _ajax(0, $this -> _db -> error);
		}
	}

	//更新字段缓存
	public function updateCache() {
		$mid = Q('mid', 0, 'intval');
		if (!$mid) {
			$this -> _ajax(0, L('admin_field_control_update_cache_error1'));
		}
		$fieldModel = new ModelFieldModel($this->_mid);
		if ($fieldModel -> updateCache($mid)) {
			$this -> _ajax(1, L('admin_field_control_update_cache_success1'));
		} else {
			$this -> _ajax(0, $fieldModel -> error);
		}
	}

	//禁用字段
	public function forbidden() {
		$field_state = Q('field_state', 1, 'intval');
		$fid = Q('fid', 1, 'intval');
		$db = M('field');
		$db -> save(array('fid' => $fid, 'field_state' => $field_state));
		$this->updateCache();
		$this -> success(L('admin_field_control_forbidden_success1'));
	}

}
