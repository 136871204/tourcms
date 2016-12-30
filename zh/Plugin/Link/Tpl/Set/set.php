<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Plugin配置</title>
    <zhjs/>
    <css file="__GROUP__/static/css/common.css"/>
    <js file="__CONTROL_TPL__/js/set.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=index">リンク一覧</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=audit">審査請求</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=add">リンク新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=add">カテゴリ新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=index">カテゴリ管理</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Set&m=set" class="action">Plugin配置</a></li>
        </ul>
    </div>
    <form action="" method="post" class="zh-form" enctype="multipart/form-data">
        <div class="title-header">サイト情報</div>
        <table class="table1">
            <tr>
                <th class="w150">サイト名称</th>
                <td>
                    <input type="text" name="webname" value="{$field.webname}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">サイトURL</th>
                <td>
                    <input type="text" name="url" value="{$field.url}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">マスタメールアドレス</th>
                <td>
                    <input type="text" name="email" value="{$field.email}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">連絡QQ</th>
                <td>
                    <input type="text" name="qq" value="{$field.qq}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">LOGO</th>
                <td>
                    <input type="file" name="logo"/>
                    <img src="__ROOT__/{$field.logo}" alt="サイトLOGO" class="h50"/>
                </td>
            </tr>
            <tr>
                <th>申請説明</th>
                <td>
                    <textarea name="comment" class="w400 h120">{$field.comment}</textarea>
                </td>
            </tr>
        </table>
        <div class="title-header">申請配置</div>
        <table class="table1">
            <tr>
                <th class="w100">申請オーポン</th>
                <td>
                    <label><input type="radio" name="allow" value="1" <if value="$field.allow eq 1">checked="checked"</if>/> YES</label>
                    <label><input type="radio" name="allow" value="0" <if value="$field.allow eq 0">checked="checked"</if>/> NO</label>
                </td>
            </tr>
            <tr>
                <th class="w100">検証番号オーポン</th>
                <td>
                    <label><input type="radio" name="code" value="1" <if value="$field.code eq 1">checked="checked"</if>/> YES</label>
                    <label><input type="radio" name="code" value="0" <if value="$field.code eq 0">checked="checked"</if>/> NO</label>
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