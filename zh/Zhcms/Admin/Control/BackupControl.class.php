<?php

/**
 * 数据库备份模块
 * Class BackupControl
 * @author 周鸿 <136871204@qq.com>
 */
class BackupControl extends AuthControl {
	/**
	 * 备份列表
	 */
	public function index() {
		$file = Dir::tree("./data/backup");
		$dir = array();
		foreach ($file as $f) {
			if (is_dir($f['path'])) {
				$dir[] = $f;
			}
		}
		$this -> assign("dir", $dir);
		$this -> display();
	}

	/**
	 * 执行数据备份
	 */
	public function backup_db() {
		$size = Q("size", 2000000, "intval");
		$table = Q("post.table");
		//备份表结构
		$structure = Q("post.structure", false);
		$result = Backup::backup(
                                array(
                                    "size" => $size, 
                                    "table" => $table, 
                                    "structure" => $structure, 
                                    "dir" => "./data/" . C("BACKUP_DIR") . '/' . date("Ymdhis")
                                )
                            );
		
		if ($result['state'] == 'success') {
			$this -> success($result['message'], U('index'));
		} else {
			$this -> success($result['message'], $result['url'],0.2);
		}
	}

	/**
	 * 配置数据备份
	 */
	public function backup() {
		Backup::clear();
		$this -> assign("table", M() -> getTableInfo());
		$this -> display();
	}

//	/**
//	 * 停止备份
//	 */
//	public function backup_stop() {
//		Backup::cancel();
//	}

	/**
	 * 还原数据
	 */
	public function recovery() {
	   
		//Backup::recovery("data/backup/" . Q("dir"));
        //p($_POST);
        //echo "data/backup/" . Q("dir");die;
        $result = Backup::recovery(array(
                                    "dir" => "data/backup/" . Q("dir")
                                ));
        if ($result['state'] == 'success') {
			$this -> success($result['message'], U('index'));
		} else {
			$this -> success($result['message'], $result['url'],0.2);
		}
	}

	/**
	 * 数据还原成功显示的信息
	 */
	public function recoverySuccess() {
		O("CacheControl", "all", array("type" => false));
		$this -> success("データ還元成功", "index", 1);
	}

	/**
	 * 备份完成
	 */
	public function backupSuccess() {
		$this -> success("バクアプ成功", "index", 1);
	}

	/**
	 * 优化表
	 */
	public function optimize() {
		if (!empty($_POST['table'])) {
			$table = $_POST['table'];
			M() -> optimize($table);
			$this -> ajax(array('state' => 1, 'message' => 'テーブル最適化成功'));
		}
	}

	/**
	 * 修复表
	 */
	public function repair() {
		if (!empty($_POST['table'])) {
			$table = $_POST['table'];
			M() -> repair($table);
			$this -> ajax(array('state' => 1, 'message' => 'テーブル修復成功'));
		}

	}

	/**
	 * 删除备份目录
	 */
	public function del() {
		$dir = $_POST['dir'];
		foreach ($dir as $d) {
			if (!Dir::del('./data/backup/' . $d)) {
				$this -> ajax(0);
			}
		}
		$this -> ajax(array('state' => 1, 'message' => '削除成功'));
	}

}
?>