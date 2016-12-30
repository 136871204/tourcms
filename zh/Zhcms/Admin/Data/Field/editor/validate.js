//表单验证
$(function () {
    $("form").validate({
        'set[height]':{
            rule: {
                required: true,
                regexp:/^\d+$/
            },
            error: {
                required: admin_field_editor_validate_js_message1,
                regexp:admin_field_editor_validate_js_message2
            },
            message:"px"
        }
    })
})