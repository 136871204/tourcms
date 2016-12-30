<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>リンク新規</title>
    <css file="__GROUP__/static/css/common.css"/>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/validate.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=index">リンク一覧</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=audit">審査請求</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=add" class="action">リンク新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=add">カテゴリ新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=index">カテゴリ管理</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Set&m=set">Plugin配置</a></li>
        </ul>
    </div>
    <form action="" method="post" class="zh-form" enctype="multipart/form-data">
        <div class="title-header">リンク新規</div>
        <table class="table1">
            <tr>
                <th class="w150">サイト名称<span class="star">*</span> </th>
                <td>
                    <input type="text" name="webname" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">サイトURL<span class="star">*</span></th>
                <td>
                    <input type="text" name="url" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">カテゴリ</th>
                <td>
                    <select name="tid">
                        <list from="$type" name="t">
                            <option value="{$t.tid}">{$t.type_name}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">マスタメールアドレス</th>
                <td>
                    <input type="text" name="email" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">連絡QQ</th>
                <td>
                    <input type="text" name="qq" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">LOGO</th>
                <td>
                    <input type="file" name="logo"/>
                    <span class="message">イメージリンクなら、LOGO画像をアップしてください</span>
                </td>
            </tr>
            <tr>
                <th>サイト紹介</th>
                <td>
                    <textarea name="comment" class="w400 h120"></textarea>
                </td>
            </tr>
            <tr>
                <th class="w100">審査済み</th>
                <td>
                    <label><input type="radio" name="state" value="1" checked="checked"/> YES</label>
                    <label><input type="radio" name="state" value="0"/> NO</label>
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