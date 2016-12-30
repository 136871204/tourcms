$(function () {
    $("form").validate({
        'rname': {
            rule: {
                required: true,
                ajax: {url: CONTROL + '&m=check_role', field: ['rid']}
            },
            error: {
                required: admin_group_page_js_message1,
                ajax: admin_group_page_js_message2
            }
        },
        'creditslower': {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_group_page_js_message3,
                regexp: admin_group_page_js_message4
            }
        }
    })
})