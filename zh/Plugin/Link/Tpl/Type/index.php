<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>カテゴリ管理</title>
    <zhjs/>
    <css file="__GROUP__/static/css/common.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=index">リンク一覧</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=audit">審査請求</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Manage&m=add">リンク新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=add">カテゴリ新規</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Type&m=index" class="action">カテゴリ管理</a></li>
            <li><a href="__WEB__?g=Plugin&a=Link&c=Set&m=set">Plugin配置</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">tid</td>
            <td>カテゴリ名称</td>
            <td class="w100">システム</td>
            <td class="w100">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$type" name="t">
            <tr>
                <td>{$t.tid}</td>
                <td>{$t.type_name}</td>
                <td>
                    <if value="$t.system eq 1">YES<else>NO</if>
                </td>
                <td>
                    <a href="{|U:'edit',array('g'=>'Plugin','tid'=>$t['tid'])}">編集</a>
                    <if value="$t.system==1">
                        <span style="color:#999;">削除</span>
                    <else/>
                        <a href="javascript:zh_ajax('{|U:'del',array('g'=>'Plugin')}',{tid:{$t.tid}});">削除</a>
                    </if>

                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>