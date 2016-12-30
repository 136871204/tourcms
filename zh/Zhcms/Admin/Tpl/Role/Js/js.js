//表单验证 添加管理员
$(function () {
    $("form").validate({
        //验证规则
        rname: {
            rule: {
                required: true,
                ajax: {url: CONTROL + "&m=check_role", field: ["rid"]}
            },
            error: {
                required: admin_role_js_check_message1,
                ajax: admin_role_js_check_message2
            }
        }
    })
})




















