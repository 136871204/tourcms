//表单验证
$(function () {
    $("form").validate({
        'set[size]': {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: "表示の長さは必須",
                regexp: "数字を入力してください。"
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