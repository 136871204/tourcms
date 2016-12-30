<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>{$zh.language.admin_category_bulk_edit_page_title}</title>
	<zhjs/>
	<css file="__CONTROL_TPL__/css/css.css"/>
	<js file="__CONTROL_TPL__/js/js.js"/>
	<js file="__TPL__/Content/js/addEdit.js"/>
	<style type="text/css">
		div.wrap {
		  	padding-right: 0px;
		}
		div.wrap div.category {
		  	overflow: auto;
		}
		div.wrap div.category table th,
		div.wrap div.category table td {
		  	border-right: 1px solid #dcdcdc;
		}
	</style>
    <script>
    var admin_category_add_edit_js_form_message1='{$zh.language.admin_category_add_edit_js_form_message1}';
    var admin_category_add_edit_js_form_message2='{$zh.language.admin_category_add_edit_js_form_message2}';
    var admin_category_add_edit_js_form_message3='{$zh.language.admin_category_add_edit_js_form_message3}';
    var admin_category_add_edit_js_form_message4='{$zh.language.admin_category_add_edit_js_form_message4}';
    var admin_category_add_edit_js_form_message5='{$zh.language.admin_category_add_edit_js_form_message5}';
    var admin_category_add_edit_js_form_message6='{$zh.language.admin_category_add_edit_js_form_message6}';
    var admin_category_add_edit_js_form_message7='{$zh.language.admin_category_add_edit_js_form_message7}';
    var admin_category_add_edit_js_form_message8='{$zh.language.admin_category_add_edit_js_form_message8}';
    var admin_category_add_edit_js_form_message9='{$zh.language.admin_category_add_edit_js_form_message9}';
    var admin_category_add_edit_js_form_message10='{$zh.language.admin_category_add_edit_js_form_message10}';
    var admin_category_add_edit_js_form_message11='{$zh.language.admin_category_add_edit_js_form_message11}';
    var admin_category_add_edit_js_form_message12='{$zh.language.admin_category_add_edit_js_form_message12}';
    var admin_category_add_edit_js_form_message13='{$zh.language.admin_category_add_edit_js_form_message13}';
    var admin_category_add_edit_js_form_message14='{$zh.language.admin_category_add_edit_js_form_message14}';
    var admin_category_add_edit_js_form_message15='{$zh.language.admin_category_add_edit_js_form_message15}';
    var admin_category_add_edit_js_form_message16='{$zh.language.admin_category_add_edit_js_form_message16}';
    var admin_category_add_edit_js_form_message17='{$zh.language.admin_category_add_edit_js_form_message17}';
    var admin_category_add_edit_js_form_message18='{$zh.language.admin_category_add_edit_js_form_message18}';
    var admin_category_add_edit_js_form_message19='{$zh.language.admin_category_add_edit_js_form_message19}';
    var admin_category_add_edit_js_form_message20='{$zh.language.admin_category_add_edit_js_form_message20}';
    var admin_category_add_edit_js_form_message21='{$zh.language.admin_category_add_edit_js_form_message21}';
    var admin_category_add_edit_js_form_message22='{$zh.language.admin_category_add_edit_js_form_message22}';
    var admin_category_add_edit_js_form_message23='{$zh.language.admin_category_add_edit_js_form_message23}';
    var admin_category_add_edit_js_form_message24='{$zh.language.admin_category_add_edit_js_form_message24}';
    var admin_category_add_edit_js_form_message25='{$zh.language.admin_category_add_edit_js_form_message25}';
    var admin_category_add_edit_js_form_message26='{$zh.language.admin_category_add_edit_js_form_message26}';
    var admin_category_add_edit_js_form_message27='{$zh.language.admin_category_add_edit_js_form_message27}';
    var admin_category_add_edit_js_select_template_message1='{$zh.language.admin_category_add_edit_js_select_template_message1}';
    var admin_category_add_edit_js_select_template_message2='{$zh.language.admin_category_add_edit_js_select_template_message2}';
    </script>
</head>
<body>
	<div class="wrap">
		<div class="menu_list">
					<ul>
						<li>
							<a href="{|U:'Category/index'}">
								{$zh.language.admin_category_bulk_edit_page_tab1}
							</a>
						</li>
						<li>
							<a href="javascript:;" class="action">
								{$zh.language.admin_category_bulk_edit_page_tab2}
							</a>
						</li>
					</ul>
		</div>
		<div class="help">
			{$zh.language.admin_category_bulk_edit_page_form_hit}
		</div>
		<form action="{|U:'BulkEdit'}" class="zh-form" method="post" onsubmit="return zh_submit(this,'{|U:'Category/index'}');">
			<input type="hidden" name="BulkEdit" value="1" />
		<div class="title-header">{$zh.language.admin_category_bulk_edit_page_form_header_title}</div>
		<div class="category">
		<table>
			<tr>
		<list from="$data" name='field'>
			<td class="w300">
				<table class="table1 category" style="width:100%;">
					<tr>
						<th>{$zh.language.admin_category_bulk_edit_page_item1}</th>
					</tr>
					<tr>
						<td>
							<input type="hidden" name="cat[{$field.cid}][cid]" value="{$field.cid}"/>
							<input type="text" name="cat[{$field.cid}][catname]" value="{$field.catname}" class="w250"/>
						</td>
					</tr>
					<tr>
						<th>{$zh.language.admin_category_bulk_edit_page_item2}</th>
					</tr>
					<tr>
						<td>
							<input type="text" name="cat[{$field.cid}][catdir]" value="{$field.catdir}" class="w250"/>
						</td>
					</tr>
					<tr>
						<th>{$zh.language.admin_category_bulk_edit_page_item3}</th>
					</tr>
					<tr>
						<td>
							<label>
							     <input type="radio" name="cat[{$field.cid}][cat_url_type]" value="1" <if value="$field.cat_url_type==1">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item3_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cat[{$field.cid}][cat_url_type]" value="2" <if value="$field.cat_url_type==2">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item3_message2}
                                </label>
						</td>
					</tr>
					<tr>
						<th>{$zh.language.admin_category_bulk_edit_page_item4}</th>
					</tr>
					<tr>
						<td>
							 <label>
                                    <input type="radio" name="cat[{$field.cid}][arc_url_type]" value="1" <if value="$field.arc_url_type==1">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item4_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cat[{$field.cid}][arc_url_type]" value="2" <if value="$field.arc_url_type==2">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item4_message2}
                                </label>
						</td>
					</tr>
					<tr>
						<th>{$zh.language.admin_category_bulk_edit_page_item5}</th>
					</tr>
					<tr>
                            <td>
                                <label>
                                    <input type="radio" name="cat[{$field.cid}][cat_show]" value="1" <if value="$field.cat_show==1">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item5_message1}
                                </label>
                                <label>
                                    <input type="radio" name="cat[{$field.cid}][cat_show]" value="0" <if value="$field.cat_show==0">checked="checked"</if>/> {$zh.language.admin_category_bulk_edit_page_item5_message2}
                                </label>
                            </td>
                  	</tr>
                  	<tr>
                  		<th class="w100">{$zh.language.admin_category_bulk_edit_page_item6}</th>
                  	</tr>
                  	 <tr>
                            <td>
                                <input type="text" name="cat[{$field.cid}][index_tpl]" required="" class="w250" id="index_tpl{$field.cid}" value="{$field.index_tpl}"
                                       onclick="select_template('index_tpl{$field.cid}')" readonly="" onfocus="select_template('index_tpl{$field.cid}');"/>
                            </td>
                        </tr>
                        <tr>
                        	<th class="w100">{$zh.language.admin_category_bulk_edit_page_item7}</th
                        </tr>
                        <tr>

                            <td>
                                <input type="text" name="cat[{$field.cid}][list_tpl]" required="" id="list_tpl{$field.cid}" class="w250" value="{$field.list_tpl}"
                                       onclick="select_template('list_tpl{$field.cid}')" readonly="" onfocus="select_template('list_tpl{$field.cid}');"/>
                            </td>
                        </tr>
                        <tr>
                        	<th>{$zh.language.admin_category_bulk_edit_page_item8}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <input type="text" name="cat[{$field.cid}][arc_tpl]" required="" id="arc_tpl{$field.cid}" class="w250" value="{$field.arc_tpl}"
                                       onclick="select_template('arc_tpl{$field.cid}')" readonly="" onfocus="select_template('arc_tpl{$field.cid}');"/>
                            </td>
                        </tr>
                        <tr>
                        	<th class="w100">{$zh.language.admin_category_bulk_edit_page_item9}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <input type="text" name="cat[{$field.cid}][cat_html_url]" required="" class="w250" value="{$field.cat_html_url}"/>
                                <span id="zh_cat_html_url"></span>
                            </td>
                        </tr>
                        <tr>
                        	<th>{$zh.language.admin_category_bulk_edit_page_item10}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <input type="text" name="cat[{$field.cid}][arc_html_url]" required="" class="w250" value="{$field.arc_html_url}"/>
                                <span id="zh_arc_html_url"></span>
                            </td>
                        </tr>
                        
                        
                        <tr>
                        	<th>{$zh.language.admin_category_bulk_edit_page_item11}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <input type="text" name="cat[{$field.cid}][cat_keyworks]" value="{$field.cat_keyworks}" class="w250"/>
                            </td>
                        </tr>
                        <tr>
                        	<th>{$zh.language.admin_category_bulk_edit_page_item12}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <textarea name="cat[{$field.cid}][cat_description]" class="w250 h100">{$field.cat_description}</textarea>
                            </td>
                        </tr>
                        <tr>
                        	<th class="w100">{$zh.language.admin_category_bulk_edit_page_item13}</th>
                        </tr>
                        <tr>
                            
                            <td>
                                <input type="text" name="cat[{$field.cid}][cat_seo_title]" value="{$field.cat_seo_title}" class="w250"/>
                            </td>
                        </tr>
                        <tr>
                        	<th>{$zh.language.admin_category_bulk_edit_page_item14}</th>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="cat[{$field.cid}][cat_seo_description]" class="w250 h150">{$field.cat_seo_description}</textarea>
                            </td>
                        </tr>
				</table>
			</td>
		</list>
			</tr>
		</table>
		</div>
		<div class="position-bottom">
			<input type="submit" class="zh-success" value="{$zh.language.admin_category_bulk_edit_page_item15}"/>
		</div>
		</form>
	</div>
	<script type="text/javascript" charset="utf-8">
		$(function(){
			alert_div();
		})
		function alert_div(){
			var _h = $(window).height()-180;
			$("div.category").css({height:_h+'px'});
		}
		$(window).resize(function(){
			alert_div();
		})
		
		$(function(){
			$('input[type=radio]').dblclick(function(e){
				var tr_index =$($(this).parents('tr')).index();
				var label_index =$($(this).parent()).index();
				$("table.category").each(function(){
					$(this).find('tr').eq(tr_index).find('label').eq(label_index).find('input').attr('checked','checked');
				})
			})
			$('label').dblclick(function(e){
				var tr_index =$($(this).parents('tr')).index();
				var label_index =$(this).index();
				$("table.category").each(function(){
					$(this).find('tr').eq(tr_index).find('label').eq(label_index).find('input').attr('checked','checked');
				})
			})
		})
	</script>
</body>
</html>
