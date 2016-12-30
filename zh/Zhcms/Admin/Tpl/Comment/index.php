<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>コメント管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index',array('comment_state'=>1)}"
                <if value="$zh.get.comment_state==1">class="action"</if>
                >審査済み</a></li>
           <li><a href="{|U:'index',array('comment_state'=>0)}"
                <if value="$zh.get.comment_state==0">class="action"</if>
                >未審査</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">
                <input type="checkbox" id="select_all"/>
            </td>
            <td class="w30">comment_id</td>
            <td>コメント内容</td>
            <td class="w50">状態</td>
            <td class="w100">uid</td>
            <td class="w100">発表時間</td>
        </tr>
        </thead>
        <list from="$data" name="d">
            <tr>
                <td><input type="checkbox" name="comment_id[]" value="{$d.comment_id}"/></td>
                <td>{$d.comment_id}</td>
                <td>
                    {$d.content}
                </td>
                <td>
                    <if value="$d.comment_state==1">審査済み<else/>未審査</if>
                </td>
                <td>
                    {$d.uid}
                </td>
                <td>{$d.pubtime|date:"Y-m-d",@@}</td>
            </tr>
        </list>
    </table>
    <div class="page1">
        {$page}
    </div>
</div>

<div class="position-bottom">
    <input type="button" class="zh-cancel" value="全て選択" onclick="select_all('.table2')"/>
    <input type="button" class="zh-cancel" value="反选" onclick="reverse_select('.table2')"/>
    <input type="button" class="zh-cancel" onclick="del()" value="一括削除"/>
    <input type="button" class="zh-cancel" onclick="audit(1)" value="審査"/>
    <input type="button" class="zh-cancel" onclick="audit(0)" value="審査取り消し"/>
</div>
</body>
</html>