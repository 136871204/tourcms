<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>{$zh.language.admin_content_content_page_title}</title>
		<zhjs/>
		<js file="__CONTROL_TPL__/js/content.js"/>
		<css file="__CONTROL_TPL__/css/css.css"/>
	</head>
	<body>
		<div class="wrap">
			<form action="{|U:'content'}" class="zh-form" method="get">
				<input type="hidden" name="m" value="content"/>
                <input type="hidden" name="c" value="content"/>
                <input type="hidden" name="a" value="admin"/>
				<input type="hidden" name="mid" value="{$zh.get.mid}"/>
				<input type="hidden" name="cid" value="{$zh.get.cid}"/>
				<input type="hidden" name="state" value="{$zh.get.state}"/>
				<div class="search">
					{$zh.language.admin_content_content_page_form_item1}：
					<input id="begin_time" placeholder="{$zh.language.admin_content_content_page_form_item1_input1}" readonly="readonly" class="w80" type="text" value="" name="search_begin_time">
					<script>
						$('#begin_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					-
					<input id="end_time" placeholder="{$zh.language.admin_content_content_page_form_item1_input2}" readonly="readonly" class="w80" type="text" value="" name="search_end_time">
					<script>
						$('#end_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					&nbsp;&nbsp;&nbsp;
					<select name="flag" class="w100">
						<option selected="" value="">{$zh.language.admin_content_content_page_form_item2}</option>
						<list from="$flag" name="f">
							<option value="{$f}" <if value="$zh.get.flag eq $f">selected=''</if>>{$f}</option>
						</list>
					</select>
					&nbsp;&nbsp;&nbsp;
					<select name="search_type" class="w100">
						<option value="1" <if value="$zh.get.search_type eq 1">selected=''</if>>{$zh.language.admin_content_content_page_form_item3_option1}</option>
						<option value="2" <if value="$zh.get.search_type eq 2">selected=''</if>>{$zh.language.admin_content_content_page_form_item3_option2}</option>
						<option value="3" <if value="$zh.get.search_type eq 3">selected=''</if>>{$zh.language.admin_content_content_page_form_item3_option3}</option>
						<option value="4" <if value="$zh.get.search_type eq 4">selected=''</if>>{$zh.language.admin_content_content_page_form_item3_option4}</option>
					</select>&nbsp;&nbsp;&nbsp;
                    <if value='{$zh.get.mid} eq 8 ||  {$zh.get.mid} eq 9  ||  {$zh.get.mid} eq 10  ||  {$zh.get.mid} eq 11  ' >
                        <input  id="webid" name="webid" style="width:50px" class="" value="{$zh.get.webid}" type="text" />
                        <button class="zh-cancel-small" type="button"  onclick="select_exterior('weblist','id','webname','站点名称','','single','webid');">站点选择</button>                   
                        <br />
                    </if>
					{$zh.language.admin_content_content_page_form_item4}：
					<input class="w200" type="text" placeholder="{$zh.language.admin_content_content_page_form_item4_input_message}" value="{$zh.get.search_keyword}" name="search_keyword">
					<button class="zh-cancel" type="submit">
						{$zh.language.admin_content_content_page_form_search_btn}
					</button>
				</div>
			</form>
			<div class="menu_list">
				<ul>
					<li>
						<a href="{|U:'content',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'],'content_state'=>1)}"
						<if value="$zh.get.content_state==1">class="action"</if> >
							{$zh.language.admin_content_content_page_tab1}
						</a>
					</li>
					<li>
						<a href="{|U:'content',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'],'content_state'=>0)}"
						<if value="$zh.get.content_state==0">class="action"</if> >
							未公开
						</a>
					</li>
					<li>
						<a href="javascript:;" onclick="zh_open_window('{|U:add,array('cid'=>$_GET['cid'],'mid'=>$_GET['mid'])}')">
							{$zh.language.admin_content_content_page_tab3}
						</a>
					</li>
				</ul>
			</div>
			<table class="table2 zh-form">
				<thead>
					<tr>
						<td class="w30">
						<input type="checkbox" id="select_all"/>
						</td>
						<td class="w30">{$zh.language.admin_content_content_page_table_col_title1}</td>
						<td class="w30">{$zh.language.admin_content_content_page_table_col_title2}</td>
						<td class="w30">{$zh.language.admin_content_content_page_table_col_title3}</td>
						<td>{$zh.language.admin_content_content_page_table_col_title4}</td>
						<td class="w50">{$zh.language.admin_content_content_page_table_col_title5}</td>
						<td class="w100">{$zh.language.admin_content_content_page_table_col_title6}</td>
						<td class="w80">{$zh.language.admin_content_content_page_table_col_title7}</td>
						<td class="w120">{$zh.language.admin_content_content_page_table_col_title8}</td>
					</tr>
				</thead>
				<list from="$data" name="c">
					<tr>
						<td>
						<input type="checkbox" name="aid[]" value="{$c.aid}"/>
						</td>
						<td>{$c.aid}</td>
						<td>{$c.cid}</td>
						<td>
						<input type="text" class="w30" value="{$c.arc_sort}" name="arc_order[{$c.aid}]"/>
						</td>
						<td>
						<a href="{|U:'Index/Index/content',array('mid'=>$_GET['mid'],'cid'=>$_GET['cid'],'aid'=>$c['aid'])}" target="_blank">
							{$c.title}
						</a>
						<if value="$c.flag">
							<span style="color:#FF0000"> [{$c.flag}]</span>
						</if></td>
						<td>
						<if value="$c.content_state eq 1">
							{$zh.language.admin_content_content_page_table_show_message1}
							<else>
								{$zh.language.admin_content_content_page_table_show_message2}
						</if></td>
						<td>{$c.username}</td>
						<td>{$c.updatetime|date:"Y-m-d",@@}</td>
						<td>
						<a href="<?php echo Url::getContentUrl($c);?>" target="_blank">
							{$zh.language.admin_content_content_page_table_operator1}
						</a><span
						class="line">|</span>
						<a href="javascript:zh_open_window('{|U:edit,array('cid'=>$_GET['cid'],'mid'=>$_GET['mid'],'aid'=>$c['aid'])}')">{$zh.language.admin_content_content_page_table_operator2}
						</a><span class="line">|</span>
						<a href="javascript:" onclick="zh_confirm('{$zh.language.admin_content_content_page_table_confirm_del}',function(){zh_ajax('{|U:'del'}',{aid:{$c['aid']},cid:{$c['cid']},mid:{$c['mid']}})})">
							{$zh.language.admin_content_content_page_table_operator3}
						</a>
						</td>
					</tr>
				</list>
			</table>
			<div class="page1">
				{$page}
			</div>
		</div>

		<div class="position-bottom">
			<input type="button" class="zh-cancel" value="{$zh.language.admin_content_content_page_form_button1}" onclick="select_all('.table2')"/>
			<input type="button" class="zh-cancel" value="{$zh.language.admin_content_content_page_form_button2}" onclick="reverse_select('.table2')"/>
			<input type="button" class="zh-cancel" onclick="order({$zh.get.mid},{$zh.get.cid})" value="{$zh.language.admin_content_content_page_form_button3}"/>
			<input type="button" class="zh-cancel" onclick="del({$zh.get.mid},{$zh.get.cid})" value="{$zh.language.admin_content_content_page_form_button4}"/>
			<input type="button" class="zh-cancel" onclick="audit({$zh.get.mid},{$zh.get.cid},1)" value="批量公开"/>
			<input type="button" class="zh-cancel" onclick="audit({$zh.get.mid},{$zh.get.cid},0)" value="批量不公开"/>
		</div>

	</body>
</html>