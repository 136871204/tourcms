<?php if (!defined("ZHPHP_PATH")) exit; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>属性新規</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <js file="__CONTROL_TPL__/js/add.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:index,array('mid'=>$_REQUEST['mid'])}">属性管理</a></li>
            <li><a href="javascript:;" class="action">属性新規</a></li>
        </ul>
    </div>
    <div class="title-header">属性新規</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index,array('mid'=>$_REQUEST['mid'])}');">
        <table class="table1">
            <tr>
                <th class="w100">属性名称</th>
                <td>
                    <input type="text" name="value" class="w200"/>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="確認"/>
        </div>
    </form>
</div>
</body>
</html>