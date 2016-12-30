<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_attachment_index_page_title}</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
		<form action='{|U:'BulkDel'}' method="post" onsubmit="return zh_submit(this,'{|U:'index'}');">
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">{$zh.language.admin_attachment_index_page_tab1}</a></li>
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
        	<td class="w30">
				<input type="checkbox" class="select_all"/>
			</td>
            <td class="w50">{$zh.language.admin_attachment_index_page_table_col_header1}</td>
            <td class="w100">{$zh.language.admin_attachment_index_page_table_col_header2}</td>
            <td >{$zh.language.admin_attachment_index_page_table_col_header3}</td>
            <td>{$zh.language.admin_attachment_index_page_table_col_header4}</td>
            <td class="w200">{$zh.language.admin_attachment_index_page_table_col_header5}</td>
            <td class="w100">{$zh.language.admin_attachment_index_page_table_col_header6}</td>
            <td class="w50">{$zh.language.admin_attachment_index_page_table_col_header7}</td>
        </tr>
        </thead>
        <list from="$upload" name="u">
            <tr>
            	<td>
							<input type="checkbox" name="ids[]" value="{$u.id}"/>
				</td>
                <td>{$u.id}</td>
                <td>
                	<if value="$u.image">
	                	<a href="{$u.pic}" target="_blank">
	                    <img src="{$u.pic}" class="w60 h30" title="{$zh.language.admin_attachment_index_page_table_preview}" onmouseover="view_image(this)"/>
	                    </a>
	                <else>
	                    <img src="{$u.pic}" class="w60 h30" title="{$zh.language.admin_attachment_index_page_table_preview}" />
                    </if>
                </td>
                <td>
                    {$u.basename}
                </td>
                <td>
                    {$u.size|get_size}
                </td>
                <td>
                    {$u.uptime|date:"Y-m-d",@@}
                </td>
                <td>
                    {$u.username}
                </td>
                <td>
                    <a href="javascript:;"  onclick="zh_confirm('{$zh.language.admin_attachment_index_page_table_confirm_del}',function(){zh_ajax('{|U:'del'}',{id:{$u.id}})})">
                    {$zh.language.admin_attachment_index_page_table_operator1}
                    </a>
                </td>
            </tr>
        </list>
    </table>
    <div class="page1">
        {$page}
    </div>
    <div class="position-bottom">
				<input type="button" class="zh-cancel" onclick="select_all(1)" value='{$zh.language.admin_attachment_index_page_form_operator1}'/>
				<input type="button" class="zh-cancel" onclick="select_all(0)" value='{$zh.language.admin_attachment_index_page_form_operator2}'/>
				<input type="button" class="zh-cancel" onclick="BulkDel()" value="{$zh.language.admin_attachment_index_page_form_operator3}"/>				
	</div>
	
</div>
</form>
<script type="text/javascript" charset="utf-8">
	//点击input表单实现 全选或反选
$(function () {
    //全选
    $("input.select_all").click(function () {
        $("[type='checkbox']").attr("checked",$(this).attr('checked')=='checked');
    })
})
//全选复选框
function select_all(state){
	if(state==1){
		$("[type='checkbox']").attr("checked",state);
	}else{
		$("[type='checkbox']").attr("checked",function(){return !$(this).attr('checked')});
	}
}
//指量删除
function BulkDel() {
    //栏目检测
    if ($("input[type='checkbox']:checked").length == 0) {
        alert('{$zh.language.admin_attachment_index_page_js_message1}');
        return false;
    }
   	$("form").trigger('submit');
}
</script>
</body>
</html>