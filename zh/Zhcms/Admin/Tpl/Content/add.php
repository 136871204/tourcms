<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>添加内容</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/addEdit.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<form action="{|U:add}" method="post" onsubmit="return false;" id="add" class="zh-form">
    <input type="hidden" name="mid" value="{$zh.get.mid}"/>
    <div class="wrap">
        <!--右侧缩略图区域-->
        <div class="content_right">
            <table class="table1">
            	<?php foreach($form['nobase'] as $field):?>
            	<tr>
            		<th>{$field['title']}</th>
            	</tr>
                <tr>
                    <td>
                       {$field['form']}
                    </td>
                </tr>
                <?php endforeach;?>
                <tr>
            		<th>公开状态</th>
            	</tr>
            	<tr>
                    <td>
                       <label><input type="radio" name="content_state" value="1" checked="">YES</label>
                       &nbsp;&nbsp;
                       <label><input type="radio" name="content_state" value="0" >NO</label>
                     </td>
                </tr>
            </table>
            <br /><br /><br /><br />
        </div>
        <div class="content_left">
            <div class="title-header">添加内容</div>
            <table class="table1">
            	<?php foreach($form['base'] as $field):?>
                <tr>
                    <th class="w80">
                    	{$field['title']}
                    <td>
                       {$field['form']}
                    </td>
                </tr>
                <?php endforeach;?>
                
            </table>
            <br /><br /><br /><br />
        </div>
    </div>
    <div class="position-bottom">
        <input type="submit" class="zh-success" value="确认"/>
        <input type="button" class="zh-cancel" onclick="zh_close_window()" value="关闭"/>
    </div>
</form>

<script type="text/javascript">
	$('form').validate({$formValidate});
</script>
</body>
</html>