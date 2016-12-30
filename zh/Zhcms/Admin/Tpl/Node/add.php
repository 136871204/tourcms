<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_node_add_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <script>
    var admin_node_js_check_message1='{$zh.language.admin_node_js_check_message1}';
    var admin_node_js_update_order_error1='{$zh.language.admin_node_js_update_order_error1}';
    </script>
</head>
<body>
<form action="{|U:'add'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
    <div class="wrap">
        <div class="menu_list">
            <ul>
                <li><a href="{|U:'index'}">{$zh.language.admin_node_add_page_tab1}</a></li>
                <li><a href="javascript:;" class="action">{$zh.language.admin_node_add_page_tab2}</a></li>
                <li><a href="javascript:zh_ajax('{|U:update_cache}');">{$zh.language.admin_node_add_page_tab3}</a></li>
            </ul>
        </div>
        <div class="title-header">{$zh.language.admin_node_add_page_table_header}</div>
        <table class="table1">
            <tr>
                <td class="w100">{$zh.language.admin_node_add_page_table_item1}:</td>
                <td>
                    <select name="pid">
                        <option value="0">{$zh.language.admin_node_add_page_table_item1_show1}</option>
                        <list from="$node" name="n">
                                <option value="{$n.nid}" <if value="$n.nid==$zh.get.pid">selected="selected"</if>>{$n._name}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item2}:</td>
                <td>
                    <input type="text" name="title" class="w200"/>
                </td>
            </tr>
            <tr>
                <td class="w100">{$zh.language.admin_node_add_page_table_item3}:</td>
                <td>
                    <input type="text" name="app" class="w200"/>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item4}:</td>
                <td>
                    <input type="text" name="control" class="w200"/>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item5}:</td>
                <td>
                    <input type="text" name="method" class="w200"/>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item6}:</td>
                <td>
                    <input type="text" name="param" class="w300"/>
                    <span class="message">例:cid=1&mid=2</span>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item7}:</td>
                <td>
                    <textarea name="comment" class="w350 h100"></textarea>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item8}:</td>
                <td>
                    <label><input type="radio" name="state" value="1" checked="checked"/> {$zh.language.admin_node_add_page_table_item8_show1}</label>
                    <label><input type="radio" name="state" value="0"/> {$zh.language.admin_node_add_page_table_item8_show2}</label>
                </td>
            </tr>
            <tr>
                <td>{$zh.language.admin_node_add_page_table_item9}:</td>
                <td>
                    <select name="type">
                        <option value="1">{$zh.language.admin_node_add_page_table_item9_show1}</option>
                        <option value="2">{$zh.language.admin_node_add_page_table_item9_show2}</option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <div class="position-bottom">
        <input type="submit" class="zh-success" value="{$zh.language.admin_node_add_page_form_submit}"/>
    </div>
</form>
</body>
</html>