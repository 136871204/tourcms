<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{$zh.language.admin_plugin_help_page_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/help.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li>
                <a href="{|U:'plugin_list'}">{$zh.language.admin_plugin_help_page_tab1}</a>
            </li>
            <li>
                <a class="action" href="javascript:;">{$zh.language.admin_plugin_help_page_tab2}</a>
            </li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_plugin_help_page_content_header}</div>
    <div class="help">
        {$help}
    </div>
</div>
</body>
</html>