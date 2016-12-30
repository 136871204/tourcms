//表单验证
$(function () {
    $("form").validate({
        //验证规则
        title: {
            rule: {
                required: true
            },
            error: {
                required: admin_node_js_check_message1
            }
        }
    })
})

//更改列表排序
function update_order() {
    var data = $("[name*='list_order']").serialize();
    $.post(CONTROL + "&m=update_order", data, function (data) {
        if (data.state == 1) {
            $.dialog({
                "message": data.message,
                "type": "success",
                "close_handler": function () {
                    location.href = URL;
                }
            });
        } else {
            $.dialog({
                "message": admin_node_js_update_order_error1,
                "type": "error"
            });
        }
    }, 'json')
}


































