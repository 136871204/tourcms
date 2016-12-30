//表单验证
$(function () {
    $("form").validate({
    	mid: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message1
            }
        },
        catname: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message2
            },
            message:admin_category_add_edit_js_form_message3
        },
        catdir: {
            rule: {
                required: true,
                ajax:{url:CONTROL+'&m=check_category_dir',field:['cid']}
            },
            error: {
                required: admin_category_add_edit_js_form_message4,
                ajax:admin_category_add_edit_js_form_message5
            },
            message:admin_category_add_edit_js_form_message6
        },
        index_tpl: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message7
            },
            message:admin_category_add_edit_js_form_message8
        },
        list_tpl: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message9
            },
            message:admin_category_add_edit_js_form_message10
        },
        arc_tpl: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message11
            },
            message:admin_category_add_edit_js_form_message12
        },
        cat_html_url: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message13
            },
            message:admin_category_add_edit_js_form_message14
        },
        cat_redirecturl: {
            rule: {
                regexp:/^http:\/\//
            },
            error: {
                regexp: admin_category_add_edit_js_form_message15
            },
            message:admin_category_add_edit_js_form_message16
        },
        arc_html_url: {
            rule: {
                required: true
            },
            error: {
                required: admin_category_add_edit_js_form_message17
            },
            message:admin_category_add_edit_js_form_message18
        },
        add_reward: {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_category_add_edit_js_form_message19,
                regexp: admin_category_add_edit_js_form_message20
            },
            message:admin_category_add_edit_js_form_message21

        },
        show_credits: {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: admin_category_add_edit_js_form_message22,
                regexp: admin_category_add_edit_js_form_message23
            },
            message:admin_category_add_edit_js_form_message24

        },
        repeat_charge_day: {
            rule: {
                required: true,
                regexp: /^[1-9]+$/
            },
            error: {
                required: admin_category_add_edit_js_form_message25,
                regexp: admin_category_add_edit_js_form_message26
            },
            message:admin_category_add_edit_js_form_message27

        }
    })
})
//获得静态目录(将目录名转为拼音)
$(function () {
    $("[name='catname']").blur(function () {
        //栏目类型不为外部链接时获取
        if ($("[name='cattype']:checked").val() != 3) {
            //栏目名
            $catname = $.trim($("[name='catname']").val())
            //静态目录名
            $catdir = $.trim($("[name='catdir']").val());
            //静态目录名为空时获得
            if (!$catdir && $catname) {
                $.post(CONTROL + "&m=dir_to_pinyin", {catname: $(this).val()}, function (data) {
                    $("[name='catdir']").val(data);
                })
            }
        }
    })
})


/**
 * 权限全选复选框
 * @param type
 */
function select_access_checkbox(obj) {
    var state = !$(obj).attr('selected');
    $(obj).attr('selected', state);
    $(obj).parents('tr').eq(0).find('input').attr('checked', state);
}

/**
 * 更换模板
 * @param input_id
 */
function select_template(name) {
	$.modal({
		title : admin_category_add_edit_js_select_template_message1,
		button_cancel : admin_category_add_edit_js_select_template_message2,
		width : 650,
		height : 400,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + APP + '&c=TemplateSelect&m=select_tpl&name=' + name + '"></iframe>'
	});
}

/**
 * 关闭模板选择窗口
 */
function close_select_template() {
	$.removeModal();
}























