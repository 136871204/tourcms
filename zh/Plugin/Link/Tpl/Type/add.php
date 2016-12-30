<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>カテゴリ新規</title>
    <zhjs/>
    <css file="__GROUP__/static/css/common.css"/>
    <js file="__CONTROL_TPL__/js/add_validate.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=index">リンク一覧</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=audit">審査請求</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=add">リンク新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=add" class="action">カテゴリ新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=index">カテゴリ管理</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Set&m=set">Plugin配置</a></li>
        </ul>
    </div>
    <form action="" method="post" class="zh-form" enctype="multipart/form-data" onsubmit="return zh_submit(this,'{|U:index,array('g'=>'Plugin')}')">
        <div class="title-header">カテゴリ新規</div>
        <table class="table1">
            <tr>
                <th class="w100">カテゴリ名称</th>
                <td>
                    <input type="text" name="type_name" class="w200"/>
                </td>
            </tr>

        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>