$(function() {
	$("form").validate({
		email : {
			rule : {
				required : true,
				email : true,
				ajax : {
					url : CONTROL + "&m=check_email",
					field : ['uid']
				}
			},
			error : {
				required : admin_personal_edit_info_js_error1,
				email : admin_personal_edit_info_js_error2,
				ajax : admin_personal_edit_info_js_error3
			}
		}
	})
})