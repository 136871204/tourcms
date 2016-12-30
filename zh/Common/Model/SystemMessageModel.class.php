<?php
/**
 * 系统消息
 * @author 周鸿<136871204@qq.com>
 */
class SystemMessageModel extends Model {
	public $table = 'system_message';
	//添加系统消息
	public function addSystemMessage($uid,$message) {
		$data = array('uid' => $uid, 'sendtime' => time(), 'message' => $message, 'state' => 0);
		return $this -> add($data);
	}

}
