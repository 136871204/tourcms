<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_model_add_page_title}</title>
    <zhjs/>
</head>
<body>
<form action="{|U:'add'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
    <div class="wrap">
        <div class="menu_list">
            <ul>
                <li><a href="{|U:'index'}">{$zh.language.admin_model_add_page_tab1}</a></li>
                <li><a href="javascript:;" class="action">{$zh.language.admin_model_add_page_tab2}</a></li>
            </ul>
        </div>
        <div class="title-header">{$zh.language.admin_model_add_page_hit}</div>
        <div class="help">
            <ul>
                <li>{$zh.language.admin_model_add_page_hit_message1}
                    <a href="http://www.metaphase.co.jp" target="_blank">zhphp.com</a>
                    {$zh.language.admin_model_add_page_hit_message2}
                </li>
            </ul>
        </div>
        <div class="title-header">
           	 {$zh.language.admin_model_add_page_form_header}
        </div>
        <div class="right_content">
            <table class="table1">
                <tr>
                    <th class="w100">{$zh.language.admin_model_add_page_form_item1}</th>
                    <td>
                        <input type="text" name="model_name" class="w200"/>
                    </td>
                </tr>
                <tr>
                    <th>{$zh.language.admin_model_add_page_form_item2}</th>
                    <td>
                        <input type="text" name="table_name" class="w200"/>
                    </td>
                </tr>
                <tr>
                    <th>{$zh.language.admin_model_add_page_form_item3}</th>
                    <td>
                        <textarea name="description" class="w350 h80"></textarea>
                    </td>
                </tr>
                </table>
        </div>
    </div>
    <div class="position-bottom">
        <input type="submit" value="{$zh.language.admin_model_add_page_form_submit}" class="zh-success"/>
    </div>
</form>
<script>
	$("form").validate({
		model_name:{
			rule:{required:true,ajax:{url:"{|U:'checkModelName'}"}},
			error:{
			 required:'{$zh.language.admin_model_add_page_js_check_message1}',
            ajax:'{$zh.language.admin_model_add_page_js_check_message2}'}
		},
		table_name:{
			rule:{required:true,regexp:/^[a-z0-9]{1,10}$/,ajax:{url:"{|U:'checkTableName'}"}},
			error:{
			 required:'{$zh.language.admin_model_add_page_js_check_message1}',
            regexp:'{$zh.language.admin_model_add_page_js_check_message3}',
            ajax:'{$zh.language.admin_model_add_page_js_check_message4}'}
		}
	});
</script>
</body>
</html>