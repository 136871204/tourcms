<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_administrator_index_page_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">{$zh.language.admin_administrator_index_page_tab1}</a></li>
            <li><a href="{|U:'add'}">{$zh.language.admin_administrator_index_page_tab2}</a></li>
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
            <td width="30">{$zh.language.admin_administrator_index_page_table_column_header1}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header2}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header3}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header4}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header5}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header6}</td>
            <td>{$zh.language.admin_administrator_index_page_table_column_header7}</td>
            <td width="100">{$zh.language.admin_administrator_index_page_table_column_header8}</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="a">
            <tr>
                <td width="30">{$a.uid}</td>
                <td>{$a.username}</td>
                <td>{$a.rname}</td>
                <td>{$a.lastip}</td>
                <td>{$a.logintime}</td>
                <td>{$a.nickname}</td>
                <td>{$a.email}</td>
                <td>
                    <a href="{|U:'edit',array('uid'=>$a['uid'])}">{$zh.language.admin_administrator_index_page_table_operator1}</a>|
                    <a href="javascript:confirm('{$zh.language.admin_administrator_index_page_confirm1}')?zh_ajax('{|U:'del'}',{'uid':{$a.uid}}):void(0);">{$zh.language.admin_administrator_index_page_table_operator2}</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>