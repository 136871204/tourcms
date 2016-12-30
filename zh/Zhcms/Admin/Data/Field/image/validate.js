//表单验证
$(function () {
    $("form").validate({
        'set[upload_img_max_width]': {//图片最大宽度
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_image_validate_js_message1,
                regexp: admin_field_image_validate_js_message1
            },
            message: admin_field_image_validate_js_message2
        },
        'set[upload_img_max_height]': {//图片最大高度
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_field_image_validate_js_message1,
                regexp: admin_field_image_validate_js_message1
            },
            message: admin_field_image_validate_js_message2
        }
    })
})