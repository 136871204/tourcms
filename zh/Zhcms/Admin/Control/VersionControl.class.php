<?php
class VersionControl extends Control {
	//JSONP 验证ZHCMS版本状态
	public function checkVersion() {
		C(require 'zh/Common/Config/version.php');
		$ServerVersion = str_replace('.', '', C('ZHCMS_VERSION'));
		$ClientVersion = str_replace('.', '', $_GET['version']);
		if ($ServerVersion > $ClientVersion) {
			$url = 'http://www.metaphase.co.jp';
			$message = "ZHCMS更新があり！最新バージョンは" . C('ZHCMS_VERSION') . "<br/>";
			$message .= "<a href='$url' target='_blank' style='color:red;font-size:14px;'>すぐ取得</a>";
			$data = array('state' => 1, 'message' => $message);
		} else {
			$data = array('state' => 0, 'message' => '貴方使われたのは再審のZHCMS');
		}
		$this -> ajax($data);
	}

}
