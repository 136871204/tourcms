//添加属性验证
$(function () {
    $("form").validate({
        //验证规则
        flagname: {
            rule: {
                required: true
            },
            error: {
                required: "属性名は必須"
            }
        },
        title: {
            rule: {
                required: true
            },
            error: {
                required: "属性タイトルは必須"
            }
        }
    })
})