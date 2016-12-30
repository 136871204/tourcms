//表单验证
$(function () {
    $("form").validate({
        'set[options]': {//select选项
            rule: {
                required: true
            },
            error: {
                required: admin_field_box_validate_js_message1
            },
            message: admin_field_box_validate_js_message2
        },
        'set[default]': {//select默认值
            rule: {
                regexp: /^\d+$/
            },
            error: {
                regexp: admin_field_box_validate_js_message3
            }
        }
    })
})