<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>会員新規</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/add.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">会員一覧</a></li>
            <li><a href="javascript:;" class="action">会員新規</a></li>
        </ul>
    </div>
    <div class="title-header">会員新規</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <table class="table1">
            <tr>
                <th class="w100">ユーザ名</th>
                <td>
                    <input type="text" name="username" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">会員グループ</th>
                <td>
                    <select name="rid">
                        <list from="$role" name="r">
                            <option value="{$r.rid}">{$r.rname}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">パスワード</th>
                <td>
                    <input type="password" name="password" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">確認パスワード</th>
                <td>
                    <input type="password" name="password_c" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">メールアドレス</th>
                <td>
                    <input type="text" name="email" class="w300"/>
                </td>
            </tr>
            <tr>
                <th class="w100">QQ</th>
                <td>
                    <input type="text" name="qq" class="w300"/>
                </td>
            </tr>
            <tr>
                <th class="w100">積分</th>
                <td>
                    <input type="text" name="credits" class="w300" value="{$zh.config.init_credits}" required=""/>
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