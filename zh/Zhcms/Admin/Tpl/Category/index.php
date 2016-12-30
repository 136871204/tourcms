<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>{$zh.language.admin_category_index_page_title}</title>
		<zhjs/>
	</head>
	<body>
		<form action='{|U:'BulkEdit'}' method="post">
			<div class="wrap">
				<div class="menu_list">
					<ul>
						<li>
							<a href="{|U:index}" class="action">
								{$zh.language.admin_category_index_page_tab1}
							</a>
						</li>
						<li>
							<a href="{|U:'add'}">
								{$zh.language.admin_category_index_page_tab2}
							</a>
						</li>
						<li>
							<a href="javascript:zh_ajax('{|U:updateCache}')">
								{$zh.language.admin_category_index_page_tab3}
							</a>
						</li>
					</ul>
				</div>
				<table class="table2 zh-form">
					<thead>
						<tr>
							<td class="w30">
							<input type="checkbox" class="select_all"/>
							</td>
							<td class="w30">{$zh.language.admin_category_index_page_table_col_header1}</td>
							<td class="w50">{$zh.language.admin_category_index_page_table_col_header2}</td>
							<td>{$zh.language.admin_category_index_page_table_col_header3}</td>
							<td class="w100">{$zh.language.admin_category_index_page_table_col_header4}</td>
							<td class="w100">{$zh.language.admin_category_index_page_table_col_header5}</td>
							<td class="w180">{$zh.language.admin_category_index_page_table_col_header6}</td>
						</tr>
					</thead>
					<list from="$category" name="c">
						<tr>
							<td>
							<input type="checkbox" name="cid[]" value="{$c.cid}"/>
							</td>
							<td>{$c.cid}</td>
							<td>
							<input type="text" class="w30" value="{$c.catorder}" name="list_order[{$c.cid}]"/>
							</td>
							<td>{$c._name}</td>
							<td>{$c.cat_type_name}</td>
							<td>{$c.model_name}</td>
							<td>
							<a href="<?php echo Url::getCategoryUrl($c)?>" target="_blank">
								{$zh.language.admin_category_index_page_table_operator1}
							</a>
								<span class="line">|</span>
							<a href="{|U:'add',array('pid'=>$c['cid'],'mid'=>$c['mid'])}">
								{$zh.language.admin_category_index_page_table_operator2}
							</a>
								<span class="line">|</span>
							<a href="{|U:'edit',array('cid'=>$c['cid'])}">
								{$zh.language.admin_category_index_page_table_operator3}
							</a>
								<span class="line">|</span>
							<a href="javascript:zh_confirm('{$zh.language.admin_category_index_page_del_confirm}',function(){zh_ajax(CONTROL + '&m=del', {cid: {$c.cid},mid: {$c.mid}})})">
								{$zh.language.admin_category_index_page_table_operator4}
							</a></td>
						</tr>
					</list>
				</table>
                
				<div class="h60"></div>
			</div>
			<div class="position-bottom">
				<input type="button" class="zh-cancel" onclick="select_all(1)" value='{$zh.language.admin_category_index_page_form_button1}'/>
				<input type="button" class="zh-cancel" onclick="select_all(0)" value='{$zh.language.admin_category_index_page_form_button2}'/>
				<input type="button" class="zh-cancel" onclick="updateOrder()" value="{$zh.language.admin_category_index_page_form_button3}"/>
				<input type="button" class="zh-cancel" onclick="BulkEdit()" value="{$zh.language.admin_category_index_page_form_button4}"/>				
			</div>
		</form>
		<script>
			//更新排序
function updateOrder() {
    //栏目检测
    if ($("input[type='text']").length == 0) {
        alert('{$zh.language.admin_category_index_page_js_message1}');
        return false;
    }
    var post = $("input[type='text']").serialize();
    zh_ajax(CONTROL + '&m=updateOrder', post);
}
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
//指量编辑
function BulkEdit() {
    //栏目检测
    if ($("input[type='checkbox']:checked").length == 0) {
        alert('{$zh.language.admin_category_index_page_js_message1}');
        return false;
    }
   	$("form").trigger('submit');
}
		</script>
	</body>
</html>