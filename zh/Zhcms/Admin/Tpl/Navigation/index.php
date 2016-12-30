<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>ナビ一覧</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">ナビ一覧</a></li>
            <li><a href="{|U:'add',array('pid'=>0)}">ナビ新規</a></li>
            <li><a href="javascript:zh_ajax('{|U:update_cache}');">キャッシュ更新</a></li>
        </ul>
    </div>
    <table class="table2 zh-form form-inline">
        <thead>
        <tr>
            <td class="w50">ソート</td>
            <td class="w50">nid</td>
            <td>ナビ名称</td>
            <td class="w50">状態</td>
            <td class="w150">操作</td>
        </tr>
        </thead>
        <list from="$navigation" name="n">
            <tr>
                <td>
                    <input type="text" class="w30" value="{$n.list_order}" name="list_order[{$n.nid}]"/>
                </td>
                <td>{$n.nid}</td>
                <td>{$n._name}</td>
                <td>
                    <if value="$n.state==1">
                        表示
                        <else>
                        非表示
                    </if>
                </td>
                <td style="text-align: right">
                    <if value="$n._level==3">
                        <span class="disabled">子ナビ新規  | </span>
                    <else>
                        <a href="{|U('add',array('pid'=>$n['nid']))}">子ナビ新規</a> |
                    </if>

                    <if value="$n.is_system==0">
                        <a href="{|U('edit',array('nid'=>$n['nid']))}">修正</a> |
                        <a href="javascript:zh_ajax('{|U:del}',{nid:{$n.nid}})">削除</a>
                    <else/>
                         <span class="disabled">修正 | </span>
                         <span class="disabled">削除</span>
                    </if>
                </td>
            </tr>
        </list>
    </table>
</div>
<div class="position-bottom">
    <input type="button" class="zh-success" value="ソート更新" onclick="update_order();"/>
</div>
</body>
</html>