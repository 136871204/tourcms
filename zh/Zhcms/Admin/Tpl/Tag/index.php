<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>tag一覧</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}" class="action">tag一覧</a></li>
            <li><a href="{|U:'add'}">tag新規</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">
                <input type="checkbox" id="select_all"/>
            </td>
            <td class="w30">tid</td>
            <td>キーワード</td>
            <td class="w100">統計</td>
            <td class="w80">操作</td>
        </tr>
        </thead>
        <list from="$data" name="d">
            <tr>
                <td><input type="checkbox" name="tid[]" value="{$d.tid}"/></td>
                <td>{$d.tid}</td>
                <td>
                    <a href="{|U:edit,array('tid'=>$d['tid'])}">{$d.tag}</a>
                </td>
                <td>
                    {$d.total}
                </td>
                <td>
                    <a href="{|U:edit,array('tid'=>$d['tid'])}">編集</a>
                    <span class="line">|</span>
                    <a href="javascript:;" onclick="del({$d.tid})">削除</a>
                </td>
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
</div>
<script>
	//全选 or  反选
$(function () {
    //全选
    $("input#select_all").click(function () {
        $("[type='checkbox']").attr("checked", $(this).attr("checked") == "checked");
    })
})

//删除
function del(tid) {
    if (tid) {
        var data = {'tid[]': tid};
    } else {
        var data = $("[name*='tid']:checked").serialize();
    }
    if (!data) {
        alert("削除したいTabを選択");
        return;
    }
    if (confirm("Tag削除しますか?")) {
        zh_ajax(CONTROL + '&m=del', data);
    }
}
</script>
</body>
</html>