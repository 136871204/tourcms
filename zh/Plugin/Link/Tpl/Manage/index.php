<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>リンク一覧</title>
    <zhjs/>
    <css file="__GROUP__/static/css/common.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=index" class="action">リンク一覧</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=audit">審査請求</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=add">リンク新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=add">カテゴリ新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=index">カテゴリ管理</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Set&m=set">Plugin配置</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">id</td>
            <td>サイト名称</td>
            <td class="w150">カテゴリ(tid)</td>
            <td class="w150">logo</td>
            <td class="w150">マスタメールアドレス</td>
            <td class="w150">マスタQQ</td>
            <td class="w100">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$link" name="l">
            <tr>
                <td>{$l.id}</td>
                <td>
                    <a href="{$l.url}" target="_blank">{$l.webname}</a>
                </td>
                <td>{$l.type_name}({$l.tid})</td>
                <td>
                    <if value="$l.logo" >
                    <img src="__ROOT__/{$l.logo}" class="h30"/>
                    </if>
                </td>
                <td>{$l.email}</td>
                <td>{$l.qq}</td>
                <td>
                    <a href="{$l.url}" target="_blank">閲覧</a> |
                    <a href="{|U:'edit',array('g'=>'Plugin','id'=>$l['id'])}">編集</a> |
                    <a href="{|U:'del',array('g'=>'Plugin','id'=>$l['id'])}">削除</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>