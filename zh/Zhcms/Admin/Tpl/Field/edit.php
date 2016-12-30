<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_field_edit_page_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script type="text/javascript">
            
            var admin_field_js_validate_message1='{$zh.language.admin_field_js_validate_message1}';
            var admin_field_js_validate_message2='{$zh.language.admin_field_js_validate_message2}';
            var admin_field_js_validate_message3='{$zh.language.admin_field_js_validate_message3}';
            var admin_field_js_validate_message4='{$zh.language.admin_field_js_validate_message4}';
            var admin_field_js_validate_message5='{$zh.language.admin_field_js_validate_message5}';
            var admin_field_js_update_cache_message1='{$zh.language.admin_field_js_update_cache_message1}';
            var admin_field_js_update_cache_message2='{$zh.language.admin_field_js_update_cache_message2}';
            var admin_field_js_del_field_message1='{$zh.language.admin_field_js_del_field_message1}';
            var admin_field_js_del_field_message2='{$zh.language.admin_field_js_del_field_message2}';
		</script>
</head>
<body>
<form action="{|U:'edit'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index,array('mid'=>$_GET['mid'])}');">
    <div class="wrap">
    	<input type="hidden" name="fid" value="{$zh.get.fid}"/>
     	<input type="hidden" name="mid" value="{$zh.get.mid}"/>
     	<input type="hidden" name="field_type" value="{$field.field_type}"/>
     	<input type="hidden" name="table_name" value="{$field.table_name}"/>	
        <div class="menu_list">
            <ul>
                <li><a href="{|U:'Model/index'}">{$zh.language.admin_field_edit_page_tab1}</a></li>
                <li><a href="{|U('index',array('mid'=>$field['mid']))}">{$zh.language.admin_field_edit_page_tab2}</a></li>
                <li><a href="javascript:;" class="action">{$zh.language.admin_field_edit_page_tab3}</a></li>
            </ul>
        </div>
        <div class="title-header">
            {$zh.language.admin_field_edit_page_form_title}
        </div>
       
        <table class="table1">
            <tr>
                <th class="w400">Model</th>
                <td>
                    {$model_name}
                </td>
            </tr>
            <tr>
						<th> {$zh.language.admin_field_edit_page_form_item3}<span class="star">*</span><span class="notice">{$zh.language.admin_field_edit_page_form_item3_message1}</span></th>
						<td>
						<input type="text" name="title" class="w200" value="{$field.title}"/>
						</td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item5} </th>
						<td>
							<textarea name="tips" class="w400 h80">{$field.tips}</textarea>
						</td>
					</tr>
            
        </table>
        <div class="field_tpl">
            <?php 
            $language=L();
            require APP_PATH . 'Data/Field/' . $field['field_type'] . '/form_edit.inc.php'; 
            
            ?>
        </div>
        
        <table class="table1">
					<tr>
						<th class="w400"> {$zh.language.admin_field_edit_page_form_item6} <span class="notice">{$zh.language.admin_field_edit_page_form_item6_message1}</span></th>
						<td>
						<input type="text" name="css" class="w250" value="{$field.css}"/>
						</td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item7} <span class="notice">{$zh.language.admin_field_edit_page_form_item7_message1}</span></th>
						<td> Min：
						<input type="text" name="minlength" class="w50" value="{$field.minlength}"/>
						Max：
						<input type="text" name="maxlength" class="w50" value="{$field.maxlength}"/>
						</td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item8} <span class="notice">{$zh.language.admin_field_edit_page_form_item8_message1}</span></th>
						<td>
						<input type="text" name="validate" class="w250 input_validation" value="{$field.validate}"/>
						<select id="field_check">
							<option value="">{$zh.language.admin_field_edit_page_form_item8_option1}</option>
							<option value="/^[0-9.-]+$/">{$zh.language.admin_field_edit_page_form_item8_option2}</option>
							<option value="/^[0-9-]+$/">{$zh.language.admin_field_edit_page_form_item8_option3}</option>
							<option value="/^[a-z]+$/i">{$zh.language.admin_field_edit_page_form_item8_option4}</option>
							<option value="/^[0-9a-z]+$/i">{$zh.language.admin_field_edit_page_form_item8_option5}</option>
							<option value="/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/">{$zh.language.admin_field_edit_page_form_item8_option6}</option>
							<option value="/^[0-9]{5,20}$/">{$zh.language.admin_field_edit_page_form_item8_option7}</option>
							<option value="/^http:\/\//">{$zh.language.admin_field_edit_page_form_item8_option8}</option>
							<option value="/^(1)[0-9]{10}$/">{$zh.language.admin_field_edit_page_form_item8_option9}</option>
							<option value="/^[0-9-]{6,13}$/">{$zh.language.admin_field_edit_page_form_item8_option10}</option>
							<option value="/^[0-9]{6}$/">{$zh.language.admin_field_edit_page_form_item8_option11}</option>
						</select><span id="zh_validation"></span></td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item9} <span class="notice">{$zh.language.admin_field_edit_page_form_item9_message1}</span></th>
						<td><label>
							<input type="radio" name="required" value="1" <if value="$field.required eq 1">checked=""</if>/>
							YES</label><label>
							<input type="radio" name="required" value="0" <if value="$field.required eq 0">checked=""</if>/>
							NO</label></td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item10} <span class="notice">{$zh.language.admin_field_edit_page_form_item10_message1}</span></th>
						<td>
						<input type="text" name="error" class="w300" value="{$field.error}"/>
						</td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item11} </th>
						<td><label>
							<input type="radio" name="isunique" value="1" <if value="$field.isunique eq 1">checked=""</if>/>
							YES</label><label>
							<input type="radio" name="isunique" value="0" <if value="$field.isunique eq 0">checked=""</if>/>
							NO</label></td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item12} <span class="notice">{$zh.language.admin_field_edit_page_form_item12_message1}</span></th>
						<td><label>
							<input type="radio" name="isbase" value="1" <if value="$field.isbase eq 1">checked=""</if>/>
							YES</label><label>
							<input type="radio" name="isbase" value="0" <if value="$field.isbase eq 0">checked=""</if>/>
							NO</label></td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item13} </th>
						<td><label>
							<input type="radio" name="issearch" value="1" <if value="$field.issearch eq 1">checked=""</if>/>
							YES</label><label>
							<input type="radio" name="issearch" value="0" <if value="$field.issearch eq 0">checked=""</if>/>
							NO</label></td>
					</tr>
					<tr>
						<th> {$zh.language.admin_field_edit_page_form_item14}</th>
						<td><label>
							<input type="radio" name="isadd" value="1" <if value="$field.isadd eq 1">checked=""</if>/>
							YES</label><label>
							<input type="radio" name="isadd" value="0" <if value="$field.isadd eq 0">checked=""</if>/>
							NO</label></td>
					</tr>
				</table>
                <br /><br /><br /><br /><br />
    </div>      
    <div class="position-bottom">
        <input type="submit" value="{$zh.language.admin_field_edit_page_form_submit}" class="zh-success"/>
    </div>
</form>
</body>
</html>