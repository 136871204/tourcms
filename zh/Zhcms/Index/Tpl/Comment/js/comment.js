/**
 * 点击回复链接后显示回复文本框
 */
$(function () {
    $("a.comment-reply-link").click(function () {
        //隐藏所有回复框
        $("div.zh-comment-reply").hide();
        //显示当前回复框
        $(this).parents('li').eq(0).find('.zh-comment-reply').eq(0).show();
    })
    //隐藏回复框
    $("input.comment-cancel").click(function () {
        $(this).parents('div.zh-comment-reply').eq(0).hide();
    })
})
/**
 * 添加评论
 * @param obj form对象
 * @param comment_id 评论框id
 * @returns {boolean}
 */
function add_comment(obj, type) {
    //验证评论内容
    if (!is_login()) {
        login.show(obj);
    } else if ($.trim($(obj).find('[name=content]').val()) == '') {
        comment_alter(obj, '内容は必須');
    } else {
        var post_data = $(obj).serialize();
        $.post(WEB+'?a=Index&c=Comment&m=addComment', post_data, function (data) {
            if (data.state == 'nologin') {
                 login.show(obj);
            } else {
                //弹出信息
                comment_alter(obj, data.message);
                //添加回复
                if (data.state == 1) {
                    if (type == 'reply') {
                        $(obj).parents('li').eq(0).find('ul').eq(0).prepend(data.data);
                        //隐藏发表框
                        $(obj).parents('div.zh-comment-reply').eq(0).hide();
                        //清空文本框
                        $(obj).find('[name=content]').val('');
                    } else {
                        //评论
                        $('div.zh-comment-list ol').prepend(data.data);
                        //清空文本框
                        $(obj).find('[name=content]').val('');
                    }
                }
            }
        }, 'json')
    }
    return false;
}
/**
 * 提示信息
 * @param obj form对象
 * @param msg 信息内容
 */
function comment_alter(obj, msg) {
    var _div = $("div.comment_alter");
    //添加内容
    _div.html(msg);
    var _top = $(obj).offset().top;
    _div.css({top: _top}).show();
    setTimeout(function () {
        _div.fadeOut("slow");
    }, 1500);
}
/**
 * 点击分页获得列表数据
 */
$(function () {
    //TODO:返回第一页的时候有bug
    $("div.zh-comment div.page a").click(function () {
        var url = $(this).attr('href');
        $('#zhcomment').load(url);
        return false;
    })
})