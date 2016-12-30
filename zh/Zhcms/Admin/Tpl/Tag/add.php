<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>tag新規</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/addEdit.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">tag一覧</a></li>
            <li><a href="javascript:;" class="action">tag新規</a></li>
        </ul>
    </div>
    <div class="title-header">tag新規</div>
    <form action="{|U:'add'}" method="post" onsubmit="return zh_submit(this,'{|U:index}')" class="zh-form">
        <table class="table1">
            <tr>
                <th class="w100">tag内容</th>
                <td>
                    <input type="text" name="tag" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">統計</th>
                <td>
                    <input type="text" name="total" value="1" class="w200"/>
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