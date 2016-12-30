//表单验证
$(function () {
    $("form").validate({
        'set[size]': {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_input_validate_js_message1,
                regexp: admin_field_input_validate_js_message2
            }
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