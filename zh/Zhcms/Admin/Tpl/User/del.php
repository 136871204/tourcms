<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>会員削除</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">会員一覧</a></li>
            <li><a href="javascript:;" class="action">会員削除</a></li>
        </ul>
    </div>
    <div class="title-header">会員削除</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
    	<input type="hidden" name="uid" value="{$field.uid}"/>
        <table class="table1">
            <tr>
                <th class="w100">ユーザ名</th>
                <td>
                    {$field.username}
                </td>
            </tr>
            <tr>
                <th class="w100">削除項目</th>
                <td>
                    <label><input type="checkbox" name="delcontent" checked=""/> 発表文章</label> 
                    <label><input type="checkbox" name="delcomment" checked=""/> コメント</label> 
                    <label><input type="checkbox" name="delupload" checked=""/> 添付ファイル</label> 
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