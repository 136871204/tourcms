$(function () {
    $("form").validate({
        username: {
            rule: {
                required: true, 
                ajax: {url: CONTROL + "&m=check_username", field: ['uid']}
            },
            error: {
                required: "ユーザ名は必須",
                ajax: 'ユーザ名はすでに存在している'
            }
        },
        password: {
            rule: {
                regexp: /^\w{5,}$/
            },
            error: {
                regexp: 'パスワードを5文字以上してください'
            }
        },
        'password_c': {
            rule: {
                confirm: 'password'
            },
            error: {
                confirm: '二回入力したパスワードが不一致'
            }
        },
        credits: {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: "積分は必須",
                regexp: "積分が数値でお願いします"
            }
        },
        email: {
            rule: {
            	required: true, 
                email: true,
                ajax: {url: CONTROL + "&m=check_email",field:['uid']}
            },
            error: {
            	required: "メールアドレスは必須",
                email: 'メールアドレスは正しくない',
                ajax: 'メールアドレスはすでに存在している'
            }
        }
    })
})