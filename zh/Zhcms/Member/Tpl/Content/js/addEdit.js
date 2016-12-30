//添加或修改文章
$(function() {
	$("form").submit(function() {
		//验证内容
		if ($("#hd_content").length > 0 && !UE.getEditor('hd_content').hasContents()) {
			alert('内容は必須');
			return false;
		}
		//表单验证
		if ($(this).is_validate()) {
			var _post = $(this).serialize();
			dialog_message("発表中...", 30);
			$.ajax({
				type : "POST",
				url : METH,
				dataType : "JSON",
				cache : false,
				data : _post,
				success : function(data) {
					//关闭提示框
					dialog_message(false);
					if (data.state == 1) {
						$.modal({
							width : 250,
							height : 160,
							button : true,
							title : 'メッセージ',
							button_success : "操作続き",
							button_cancel : "窓を閉じる",
							message : data.message,
							type : "success",
							success : function() {
								if (window.opener) {
									window.opener.location.reload();
								}
								window.location.reload();
							},
							cancel : function() {
								if (window.opener) {
									window.opener.location.reload();
								}
								window.close();
							}
						})
					} else {//错误
						$.dialog({
							message : data.message,
							type : "error"
						});
					}
				},
				error : function() {
					$.dialog({
						message : "操作タイムアウト，後で再試してください",
						type : "error"
					});
				}
			})
		}
		return false;
	})
})
//表单验证
//$(function() {
//	$("form").validate({
//		title : {
//			rule : {
//				required : true
//			},
//			error : {
//				required : "标题不能为空"
//			}
//		},
//		tag : {
//			rule : {
//				required : true
//			},
//			error : {
//				required : "标签不能为空"
//			},
//			message : '用逗号分隔'
//		},
//		read_credits : {
//			rule : {
//				required : true,
//				regexp : /^\d+$/
//			},
//			error : {
//				required : "阅读积分不能为空",
//				regexp : '必须为数字'
//			}
//		}
//	})
//})
