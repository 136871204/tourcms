<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_role_index_page_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">{$zh.language.admin_role_index_page_tab_list}</a></li>
            <li><a href="{|U:'add'}">{$zh.language.admin_role_index_page_tab_add}</a></li>
             <li><a href="javascript:;" onclick="zh_ajax('{|U:updateCache}')">{$zh.language.admin_role_index_page_tab_cache}</a></li>
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
            <td class="w30">{$zh.language.admin_role_index_page_table_header_1}</td>
            <td class="w150">{$zh.language.admin_role_index_page_table_header_2}</td>
            <td>{$zh.language.admin_role_index_page_table_header_3}</td>
            <td class="w100">{$zh.language.admin_role_index_page_table_header_4}</td>
            <td class="w180">{$zh.language.admin_role_index_page_table_header_5}</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="d">
            <tr>
                <td>{$d.rid}</td>
                <td>{$d.rname}</td>
                <td>{$d.title}</td>
                <td>
                    <if value="$d.system">
                        <font color="red">√</font>
                        <else/>
                        <font color="blue">×</font>
                    </if>
                </td>
                <td>
                    <a href="{|U:'edit',array('rid'=>$d['rid'])}">{$zh.language.admin_role_index_page_table_button_edit}</a> |
                    <if value="$d.system eq 0">
                        <a href="javascript:confirm('{$zh.language.admin_role_index_page_confirm_delete}')?zh_ajax('{|U:del}',{rid:{$d.rid}}):void(0);">{$zh.language.admin_role_index_page_table_button_delete}</a>
                    <else>
                    	{$zh.language.admin_role_index_page_table_button_delete}
                    </if>
                     |
                    <if value="$d.rid eq 1">
                    	{$zh.language.admin_role_index_page_table_button_access}
                    <else>
                    	<a href="{|U:'Access/edit',array('rid'=>$d['rid'])}">{$zh.language.admin_role_index_page_table_button_access}</a>
                    </if>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>