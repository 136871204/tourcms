<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{$zh.language.admin_plugin_uninstall_page_title}</title>
    <zhjs/>
    <js file="__ROOT__/zh/Zhcms/Admin/Tpl/Index/js/menu.js"/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li>
                <a href="__CONTROL__&m=plugin_list">{$zh.language.admin_plugin_uninstall_page_tab1}</a>
            </li>
            <li>
                <a class="action" href="javascript:;">{$zh.language.admin_plugin_uninstall_page_tab2}</a>
            </li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_plugin_uninstall_page_form_header}</div>
    <form method="post" onsubmit="return false">
        <input type="hidden" name="plugin" value="{$field.plugin}"/>
        <table class="table1 zh-form">
            <tr>
                <th class="w150">{$zh.language.admin_plugin_uninstall_page_form_item1}</th>
                <td>{$field.name}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item2}</th>
                <td>{$field.version}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item3}</th>
                <td>{$field.team}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item4}</th>
                <td>{$field.pubdate}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item5}</th>
                <td>{$field.web}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item6}</th>
                <td>{$field.email}</td>
            </tr>
            <tr>
                <th>{$zh.language.admin_plugin_uninstall_page_form_item7}</th>
                <td>
                    <label>
                        <input type="radio" name="del_dir" value="0" checked="checked"/> {$zh.language.admin_plugin_uninstall_page_form_item7_message1}
                    </label>
                    <label>
                        <input type="radio" name="del_dir" value="1"/> {$zh.language.admin_plugin_uninstall_page_form_item7_message2}
                    </label>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="{$zh.language.admin_plugin_uninstall_page_form_submit}" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>