//表单验证
$(function () {
    $("form").validate({
        'set[input_width]': {//文本框宽度
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_files_validate_js_message1,
                regexp: admin_field_files_validate_js_message1
            },
            message: "px"
        },

        'set[num]': {//允许上传数量
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_files_validate_js_message1,
                regexp: admin_field_files_validate_js_message1
            },
            message: admin_field_files_validate_js_message2
        },
        'set[filetype]': {//允许上传数量
            rule: {
                required: true,
            },
            error: {
                required: admin_field_files_validate_js_message3,
            },
            message: admin_field_files_validate_js_message4
        },
        'set[down_credits]': {//下载金币数
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_files_validate_js_message1,
                regexp: admin_field_files_validate_js_message5
            },
            message: admin_field_files_validate_js_message2
        }
    })
})