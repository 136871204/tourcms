<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>{$zh.language.admin_model_index_page_title}</title>
		<zhjs/>
	</head>
	<body>
		<div class="wrap">
			<div class="menu_list">
				<ul>
					<li>
						<a href="{|U:'index'}" class="action">
							{$zh.language.admin_model_index_page_tab1}
						</a>
					</li>
					<li>
						<a href="{|U:'add'}">
							{$zh.language.admin_model_index_page_tab2}
						</a>
					</li>
					<li>
						<a href="javascript:;" onclick="zh_ajax('{|U:updateCache}')">
							{$zh.language.admin_model_index_page_tab3}
						</a>
					</li>
				</ul>
			</div>
			<div class="content">
				<table class="table2 table-title">
					<thead>
						<tr>
							<td class="w30">{$zh.language.admin_model_index_page_table_col_header1}</td>
							<td>{$zh.language.admin_model_index_page_table_col_header2}</td>
							<td class="w100">{$zh.language.admin_model_index_page_table_col_header3}</td>
							<td class="w100">{$zh.language.admin_model_index_page_table_col_header4}</td>
							<td class="w30">{$zh.language.admin_model_index_page_table_col_header5}</td>
							<td class="w150">{$zh.language.admin_model_index_page_table_col_header6}</td>
						</tr>
					</thead>
					<tbody>
						<list from="$model" name="m">
							<tr>
								<td>{$m.mid}</td>
								<td>{$m.model_name}</td>
								<td>
								<if value='$m.is_system eq 1'>
									<font color="red">√</font>
									<else>
									<font color="blue">×</font>
								</if></td>
								<td>{$m.table_name}</td>
								<td>
								<if value="$m['enable']">
									NO
									<else>
										OFF
								</if></td>
								<td>
								<a href="{|U:'Field/index',array('mid'=>$m['mid'])}">
									{$zh.language.admin_model_index_page_table_operator_field}
								</a> |
								<if value="$m.is_system==1">
									{$zh.language.admin_model_index_page_table_operator_edit}
									<else>
										<a href="{|U:'edit',array('mid'=>$m['mid'])}">
											{$zh.language.admin_model_index_page_table_operator_edit}
										</a>
								</if> |
								<if value="$m.is_system==1 || in_array($m['table_name'],$forbidDelete)">
									{$zh.language.admin_model_index_page_table_operator_del}
									<else>
										<a href="javascript:zh_confirm('{$zh.language.admin_model_index_page_table_operator_confirm_del}',function(){zh_ajax('{|U:'del'}', {mid: {$m.mid}})})">
											{$zh.language.admin_model_index_page_table_operator_del}
										</a>
								</if></td>
							</tr>
						</list>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>