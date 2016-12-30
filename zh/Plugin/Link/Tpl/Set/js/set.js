$(function () {
    $('form').validate({
        webname: {
            rule: {
                required: true
            },
            error: {
                required: 'サイト名称は必須'
            },
            success: '入力正しい'
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
            success: '入力正しい'
        },
        email: {
            rule: {
                required: true,
                email:true
            },
            error: {
                required: 'メールアドレスは必須',
                email:'メールアドレスはただしくない'
            },
            success: '入力正しい'
        },
        qq: {
            rule: {
                required: true,
                regexp:/^\d+$/
            },
            error: {
                required: '連絡QQは必須',
                regexp:'QQは正しくない'
            },
            success: '入力正しい'
        }
    })
})