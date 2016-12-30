<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_personal_edit_password_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/edit_password.js"/>
    <script>
    var admin_personal_edit_password_js_error1='{$zh.language.admin_personal_edit_password_js_error1}';
    var admin_personal_edit_password_js_error2='{$zh.language.admin_personal_edit_password_js_error2}';
    var admin_personal_edit_password_js_error3='{$zh.language.admin_personal_edit_password_js_error3}';
    var admin_personal_edit_password_js_error4='{$zh.language.admin_personal_edit_password_js_error4}';
    var admin_personal_edit_password_js_error5='{$zh.language.admin_personal_edit_password_js_error5}';
    var admin_personal_edit_password_js_error6='{$zh.language.admin_personal_edit_password_js_error6}';
    </script>
</head>
<body>
<div class="wrap">
    <div class="title-header">{$zh.language.admin_personal_edit_password_page_tab1}</div>
    <form action="__METH__" method="post" onsubmit="return zh_submit(this)" class="zh-form">
        <table class="table1">
            <tr>
                <th class="w100">{$zh.language.admin_personal_edit_password_page_form_item1}</th>
                <td>
                    {$user.username}
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_personal_edit_password_page_form_item2}</th>
                <td>
                    <input type="password" name="old_password" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_personal_edit_password_page_form_item3}</th>
                <td>
                    <input type="password" name="password" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_personal_edit_password_page_form_item4}</th>
                <td>
                    <input type="password" name="passwordc" class="w200"/>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="{$zh.language.admin_personal_edit_password_page_form_submit}"/>
        </div>
    </form>
</div>
</body>
</html>