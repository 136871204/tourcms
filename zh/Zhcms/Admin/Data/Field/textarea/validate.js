//表单验证
$(function () {
    $("form").validate({
        'set[width]': {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_textarea_validate_js_message1,
                regexp: admin_field_textarea_validate_js_message1
            }, message: "px"
        },
        'set[height]': {//验证规则
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_textarea_validate_js_message1,
                regexp: admin_field_textarea_validate_js_message1
            }, message: "px"
        },
        'set[validation]': {//验证规则
            rule: {
                regexp: /^\/.+\/$/
            },
            error: {
                regexp: "正規表現を入力してください。"
            }
        }
    })
})