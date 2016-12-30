$(function () {
    $("form").validate({
        //验证规则
        old_password: {
            rule: {
                required: true,
                ajax: {url:CONTROL + "&m=check_password"}
            },
            error: {
                required: admin_personal_edit_password_js_error1,
                ajax: admin_personal_edit_password_js_error2
            }
        },
        password: {
            rule: {
                required: true,
                regexp: /^\w{5,}$/
            },
            error: {
                required: admin_personal_edit_password_js_error3,
                regexp: admin_personal_edit_password_js_error4
            }
        },
        passwordc: {
            rule: {
                required: true,
                confirm: "password"
            },
            error: {
                required: admin_personal_edit_password_js_error5,
                confirm: admin_personal_edit_password_js_error6
            }
        }
    })
})