$(function () {
    $('form').validate({
        type_name: {
            rule: {
                required: true
            },
            error: {
                required: 'カテゴリ名称は必須'
            },
            success: '入力正しい'
        }
    })
})