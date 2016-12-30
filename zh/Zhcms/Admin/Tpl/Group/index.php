<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_group_index_page_title}</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">{$zh.language.admin_group_index_page_tab1}</a></li>
            <li><a href="{|U:'add'}">{$zh.language.admin_group_index_page_tab2}</a></li>
             <li><a href="javascript:;" onclick="zh_ajax('{|U:updateCache}')">{$zh.language.admin_group_index_page_tab3}</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">{$zh.language.admin_group_index_page_table_header1}</td>
            <td>{$zh.language.admin_group_index_page_table_header2}</td>
            <td class="w150">{$zh.language.admin_group_index_page_table_header3}</td>
            <td class="w150">{$zh.language.admin_group_index_page_table_header4}</td>
            <td class="w150">{$zh.language.admin_group_index_page_table_header5}</td>
            <td class="w150">{$zh.language.admin_group_index_page_table_header6}</td>
            <td class="w100">{$zh.language.admin_group_index_page_table_header7}</td>
        </tr>
        </thead>
        <list from="$data" name="d">
            <tr>
                <td>{$d.rid}</td>
                <td>
                    {$d.rname}
                </td>
                <td>
                    <if value="$d.system">
                        <font color="red">√</font>
                        <else/>
                       <font color="blue">×</font>
                    </if>
                </td>
                <td>{$d.creditslower}</td>

                <td>
                    <if value="$d.comment_state">
                        <font color="red">√</font>
                        <else/>
                        ×
                    </if>
                </td>
                <td><if value="$d.allowsendmessage">
                        <font color="red">√</font>
                        <else/>
                        ×
                    </if></td>
                <td>
                    <a href="{|U:'edit',array('rid'=>$d['rid'])}">{$zh.language.admin_group_index_page_table_operator_edit}</a>
                    <span class="line">|</span>
                    <if value="$d.system eq 1">
                    	<span>{$zh.language.admin_group_index_page_table_operator_del}</span>
                    <else>
                        <a href="javascript:if(confirm('{$zh.language.admin_group_index_page_confirm_del}'))zh_ajax('{|U:'del'}',{'rid':{$d['rid']}});">{$zh.language.admin_group_index_page_table_operator_del}</a>
                    </if>
                </td>
            </tr>
        </list>
    </table>
    <div class="h60"></div>
</div>
</body>
</html>