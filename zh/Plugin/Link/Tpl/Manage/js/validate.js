$(function () {
    $('form').validate({
        webname: {
            rule: {
                required: true
            },
            error: {
                required: 'サイト名称は必須'
            },
            success: '入力が正しい'
        },
        url: {
            rule: {
                required: true,
                regexp:/^http/i
            },
            error: {
                required: 'サイトURLは必須',
                regexp:'サイトURLは正しくない'
            },
            success: '入力が正しい'
        },
        email: {
            rule: {
                email:true
            },
            error: {
                email:'メールアドレスは正しくない'
            },
            success: '入力が正しい'
        },
        qq: {
            rule: {
                regexp:/^\d+$/
            },
            error: {
                regexp:'QQ入力エラー'
            },
            success: '入力が正しい'
        }
    })
})