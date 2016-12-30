<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_group_add_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script>
    var admin_group_page_js_message1='{$zh.language.admin_group_page_js_message1}';
    var admin_group_page_js_message2='{$zh.language.admin_group_page_js_message2}';
    var admin_group_page_js_message3='{$zh.language.admin_group_page_js_message3}';
    var admin_group_page_js_message4='{$zh.language.admin_group_page_js_message4}';
    </script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">{$zh.language.admin_group_add_page_tab1}</a></li>
            <li><a href="javascript:;" class="action">{$zh.language.admin_group_add_page_tab2}</a></li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_group_add_page_form_header}</div>
    <form action="{|U:add}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <table class="table1">
            <tr>
                <th class="w150">{$zh.language.admin_group_add_page_form_item1}</th>
                <td>
                    <input type="text" name="rname" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_group_add_page_form_item2}&lt;</th>
                <td>
                    <input type="text" name="creditslower" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_group_add_page_form_item3}</th>
                <td>
                    <label>
                        <input type="radio" name="comment_state" value="1" /> YES
                    </label> 
                    <label>
                        <input type="radio" name="comment_state" value="0" checked="checked"/> NO
                    </label>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_group_add_page_form_item4}</th>
                <td>
                    <label>
                        <input type="radio" name="allowsendmessage" value="1"/>YES
                    </label> 
                    <label>
                        <input type="radio" name="allowsendmessage" value="0" checked="checked"/>NO
                    </label>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_group_add_page_form_item5}</th>
                <td>
                    <input type="text" name="title" class="w300"/>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="{$zh.language.admin_group_add_page_form_submit}" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>