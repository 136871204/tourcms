<?php
/**
 * 密码处理
 */
class PasswordControl extends Control {
	//找回密码
	public function findPassword() {
		$this -> display();
	}

	//发送邮件
	public function sendEmail() {
		$email = Q('email');
		if (!$email) {
			$this->error('メールアドレス入力してください');
		} else {
			$Model = M('user');
			$user = $Model -> where(array('email' => $email)) -> find();
			if (!$user) {
				$this -> error('アカウントが存在しない');
			} else {
				$data=array();
				$data['uid']=$user['uid'];
				$data['code'] = substr(md5(mt_rand(1,1000).time()),0,8);
				$newPassword = substr(md5(mt_rand(1,1000).time()),0,6);
				$data['password'] = md5($newPassword.$data['code']);
				$Model->save($data);
				$emailCon = "貴方「".C('WEB_NAME')."」の新しいパスワードは：{$newPassword}，登録してパスワードすぐに修正することを進めます!!!";
				$state = Mail::send($email, $user['username'], C('WEBNAME'), $emailCon);
				if ($state) {
					$message = "次のメールアドレス：" . $email . 'にパスワード再設置するメールを送信しました<br/>このメールで新しいパスワードを見てください';
				} else {
					$masterEmail = C('EMAIL');
					$message = "メール送信失敗，管理者と連絡してください<a href='mailto:{$masterEmail}'>{$masterEmail}</a>";
				}
			}
		}
		$this->assign('message',$message);
		$this -> display();
	}

}
?>
