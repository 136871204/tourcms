<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>キーワード編集</title>
    <zhjs/>
    <js file="__GROUP__/static/js/js.js"/>
    <js file="__CONTROL_TPL__/js/manage.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">キーワード一覧</a></li>
            <li><a href="javascript:;" class="action">キーワード編集</a></li>
        </ul>
    </div>
    <form action="{|U:'edit'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <input type="hidden" name="sid" value="{$field.sid}"/>
        <table class="table1">
            <tr>
                <th class="w100">キーワード</th>
                <td>
                    <input type="text" name="name" value="{$field.word}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">検索回数</th>
                <td>
                    <input type="text" name="total" value="{$field.total}" class="w200"/>
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