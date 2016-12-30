/**
 * 会员登录处理类
 * @author 周鸿 <136871204@qq.com>
 */

var login = {
	/**
	 * 创建登录div
	 */
	create_element : function() {
		if ($("#login_window").length == 0) {
			var html =  '<div id="login_window">\
			<span id = "close_login_window" onclick="login.close()">x</span>\
			<div class="error-pop"></div>\
			<div class="login_title">\
			<a href="?a=Member&c=Login&m=reg">アカウントログイン</a>\
			<span>ログイン</span>\
			</div>\
			<div class="login_form">\
			<form id = "formLogin" method="post">\
			<div>\
			<input type = "text" name = "username" id = "username" class = "input-text"\
			style = "width: 100%; padding-left: 10px;" placeholder="ユーザ名/メール"/>\
			</div>\
			<div>\
			<input type = "password" name = "password" class = "input-text" id = "password"\
			style = "width: 100%; padding-left: 10px;" placeholder="パスワード"/>\
			</div>\
			<input type = "submit" class = "my-btn-submit" value="ログイン"/>\
			</form>\
			</div>\
			</div>\
			<div id="login_window_bg">\
			</div>';
			$("body").append(html);
		}
		//显示背景
		$("div#login_window_bg").show();
		//显示登录框
		$("div#login_window").show();
	},
    /**
     * 前台应用JS
     * @param formObj form对象
     */
	show : function(formObj) {
		//创建登录div
		this.create_element();
		//会员登录
		$("#formLogin").submit(function() {
			//隐藏信息提示div
			$('div.error-pop').hide();
			//验证用户名
			var url = WEB+'?a=Member&c=Login&m=ajax_login';
			$.post(url, $(this).serialize(), function(data) {
				if (data.state == 1) {
					login.close();
					zhcms_alert(data.message);
                    //提交表单
                    $(formObj).trigger('submit');
				} else {
					$('div.error-pop').show().html(data.message);
				}
			}, 'json')
			return false;
		})
	},
	/**
	 * 隐藏登录框
	 */
	close : function() {
		//隐藏背景
		$("div#login_window_bg").hide();
		//隐藏登录框
		$("div#login_window").hide();
	}
}
/**
 * 文章内容处理类
 * @type {{add_favorite: add_favorite}}
 */
var content = {
	/**
	 * 加入收藏
	 * @param mid
	 * @param cid
	 * @param aid
	 */
	addFavorite : function(mid, cid, aid) {
		$.post('index.php?a=Index&c=Index&m=addFavorite', {
			mid : mid,
			cid : cid,
			aid : aid
		}, function(data) {
			if (data.state == 1) {
				zhcms_alert(data.message);
			} else {
				zhcms_alert(data.message);
			}
		}, 'json');
	}
}

/**
 * 短消息处理类
 */
var message = {
	/**
	 * 显示信息窗口
	 * @param uid
	 * @param nickname
	 */
	show : function(to_uid, nickname) {		
		//未登录用户，弹出登录窗口
		if (!is_login('login')) {

			login.show();
			return false;
		}
		if ($("#zh_send_message").length == 0) {
            var html = '<div id="zh_send_message">\
            <form method="post" onsubmit="return message.send()">\
            <input type="hidden" name="to_uid" value=""/>\
            <div class="message_title">メッセージ</div>\
            <div class="message_content">\
            <table>\
                <tr>\
                    <td style="width:80px;">受取人：</td>\
                    <td><span id="nickname"></span></td>\
                </tr>\
                <tr>\
                    <td colspan="2">\
                        <textarea name="content" id="message_content"></textarea>\
                    </td>\
                </tr>\
            </table>\
            </div>\
            <div class="message_btn">\
                <input type="submit" class="message_submit" value="送信"/>\
                <button type="button" class="message_cancel" onclick="message.close()">閉じる</button>\
            </div>\
        </form>\
        </div>';
            //添加窗口
            $("body").append(html);
        }
        $("input[name='to_uid']").val(to_uid);
        $("#nickname").html(nickname);
        $("#zh_send_message").show();

	},
	send : function() {
		var url = ROOT + "/index.php?a=Member&c=Message&m=send";
		if ($.trim($('#message_content').val()) == '') {
			zhcms_alert('内容は必須');
			return false;
		}
		$.post(url, $('div#zh_send_message form').serialize(), function(data) {
			message.close();
			$('#message_content').val('');
			zhcms_alert(data.message);
		}, 'json');
		return false;
	},
	//关闭窗口
	close : function() {
		$("#zh_send_message").hide();
		$("#zh_send_message_bg").hide();
	}
}
/**
 *
 * @type {{follow: follow}}
 */
var user = {
	//缓存
	cache : {},
	/**
	 * 获得用户信息DIV
	 * @param uid 用户uid
	 */
	show : function(obj, uid) {
		//位置
		var _win_w = $(document).width();
		var _w = $(obj).width();
		var offset = $(obj).offset();
        
		var _top = offset.top - 20;
		var _left = offset.left;
		if (_left + _w + 330 > _win_w) {
			_left = _left - 330;
		} else {
			_left = _left + _w;
		}
		//提示信息div的id值
		var id = 'user_' + uid;
        
		//验证缓存
		if (user.cache[id]) {
			$("div#" + id).css({
				left : _left,
				top : _top
			});
			user.cache[id].show();
		} else {
			$('body').append('<div class="zh_user" id="' + id + '" style="position:absolute;width:330px;height:188px;"></div>');
			$("div#" + id).css({
				left : _left,
				top : _top
			});
			//缓存不存时，请求用户数据
			var url = WEB + '?a=Index&c=User&m=user&uid=' + uid;
			$.post(url, function(data) {
				if (data.state == 1) {
					$("div#" + id).append(data.message);
					user.cache[id] = $("div#" + id);
				}
			}, 'json');
		}
		//添加移除事件
		$(obj).mouseleave(function() {
			$('div.zh_user').hide();
		})
		$("div.zh_user").live('mouseenter', function() {
			$('div.zh_user').hide();
			$("div#" + id).show();
		})
		$("div.zh_user").live('mouseleave', function() {
			$('div.zh_user').hide();
		})
	},
	//用户关注处理类
	follow : function(obj, uid) {
		//未登录用户，弹出登录窗口
		if (!is_login()) {
			login.show();
		} else {
			var url = ROOT + '/index.php?a=Member&m=Follow&c=follow&uid=' + uid;
			$.post(url, function(data) {
				if (data.state == 1) {
					//关注 已关注
					$(obj).html(data.message.follow);
				} else {
					zhcms_alert(data.message);
				}

			}, 'json');
		}
	}
}
//ZHCMS提示信息
function zhcms_alert(message) {
	if ($("#zhcms_alert").length == 0) {
		var html =  ' <div id="zhcms_alert">\
		<div class="zhcms_alert_title">ヒント</div><div class="zhcms_alert_content">操作成功</div>\
		</div>';
		$('body').append(html);
	}
	$("#zhcms_alert .zhcms_alert_content").html(message);
	$("#zhcms_alert").show();
	setTimeout(function() {
		$("#zhcms_alert").hide();
	}, 1000);
}



//是否登录
function is_login() {
	return cookie.get('login')
}
/**
 * cookie操作类
 */
var cookie = {
	set : function(name, value, iDay) {
		var oDate = new Date();
		oDate.setDate(oDate.getDate() + iDay);
		document.cookie = name + '=' + value + ';expires=' + oDate;
	},
	get : function(name) {
		var arr = document.cookie.split('; ');
		for (var i = arr.length - 1; i >= 0; i--) {
			var arr2 = arr[i].split('=');
			if (arr2[0] === name) {
				return arr2[1];
			}
		}
		return '';
	},
	del : function(name) {
		cookie.setCookie(name, 1, -1);
	}
}

