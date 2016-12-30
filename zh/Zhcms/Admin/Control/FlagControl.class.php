<?php

/**
 * 内容属性管理
 * Class ContentControl
 * @author 周鸿 <136871204@qq.com>
 */
class FlagControl extends AuthControl {
	//模型
	private $_db;
	//模型mid
	private $_mid;

	public function __init() {
		$modelCache = cache('model');
		$this -> _mid = Q('mid', 0, 'intval');
		if (empty($this -> _mid) || !key_exists($this -> _mid, $modelCache)) {
			$this -> error('Model存在しない');
		}
		$this -> _db = new FlagModel($this -> _mid);
	}

	//属性列表
	public function index() {
		$this -> assign("model", cache('model'));
		$this -> assign('flag', cache($this -> _mid, false, FLAG_CACHE_PATH));
		$this -> display();
	}

	//删除属性
	public function del() {
		$index = Q('number');
		if (empty($index)) {
			$this -> error('パラメータエラー');
		}
		if ($this -> _db -> delFlag($index)) {
			$this -> success('削除成功');
		} else {
			$this -> error($this -> _db -> error);
		}
	}

	//修改属性
	public function edit() {
		if (empty($_POST) || !isset($_POST['flag']) || empty($_POST['flag'])) {
			$this -> error('パラメータエラー');
		}
		if ($this -> _db -> editFlag($this -> _mid, $_POST['flag'])) {
			$this -> success('修正成功');
		} else {
			$this -> error($this -> _db -> error);
		}
	}

	//添加属性
	public function add() {
		if (IS_POST) {
			if (empty($_POST['value'])) {
				$this -> error('属性名は必須');
			}
			if ($this -> _db -> addFlag($_POST['value'])) {
				$this -> success('新規成功');
			} else {
				$this -> error($this -> _db -> error);
			}
		} else {
			$this -> display();
		}
	}

	/**
	 * 更新缓存
	 */
	public function updateCache() {
		if ($this -> _db -> updateCache()) {
			$this -> success('キャッシュ更新成功');
		}
	}

}
