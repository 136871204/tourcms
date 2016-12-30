//表单验证
$(function () {
    $("form").validate({
        'set[num_integer]': {//整数位数
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_number_validate_js_message1,
                regexp: admin_field_number_validate_js_message1
            }
        },
        'set[num_decimal]': {//小数位数
            rule: {
                regexp: /^\d+$/
            },
            error: {
                regexp: admin_field_number_validate_js_message1
            }
        },
        'set[size]': {//显示长度
            rule: {
                regexp: /^\d+$/
            },
            error: {
                regexp: admin_field_number_validate_js_message1
            },
            message: "px"
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