$(function () {
    $('form').validate({
        tag: {
            rule: {
                required: true
            },
            error: {
                required: 'Tab内容は必須'
            },
            success: '入力正しい'
        },
        total: {
            rule: {
                required: true,
                regexp:/^\d+$/i
            },
            error: {
                required: '統計は空にできません',
                regexp:'統計は入力ミス'
            },
            success: '入力正しい'
        }
    })
})

