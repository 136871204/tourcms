<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_role_edit_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <script>
    var admin_role_js_check_message1='{$zh.language.admin_role_js_check_message1}';
    var admin_role_js_check_message2='{$zh.language.admin_role_js_check_message2}';
    </script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">{$zh.language.admin_role_edit_page_tab_list}</a></li>
            <li><a href="javascript:;" class="action">{$zh.language.admin_role_edit_page_tab_add}</a></li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_role_edit_page_form_title}</div>
    <form action="{|U:'edit'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
        <input type="hidden" name="rid" value="{$field.rid}"/>
        <input type="hidden" name="admin" value="1"/>
        <table class="table1">
            <tr>
                <th class="w100">{$zh.language.admin_role_edit_page_form_item1}</th>
                <td>
                    <input type="text" name="rname" value="{$field.rname}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_role_edit_page_form_item2}</th>
                <td>
                    <textarea name="title" class="w300 h100">{$field.title}</textarea>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="{$zh.language.admin_role_edit_page_form_submit}"/>
        </div>
    </form>
</div>
</body>
</html>