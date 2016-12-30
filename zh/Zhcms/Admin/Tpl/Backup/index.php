<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>データ還元</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/index.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}" class="action">バクアプ一覧</a></li>
            <li><a href="{|U:'backup'}">データバクアプ</a></li>
        </ul>
    </div>
    <form action="{|U:'delBackupDir'}" method="post" class="form-inline zh-form">
        <table class="table2">
            <thead>
            <tr>
                <td width="50">
                    <label><input type="checkbox" class="s_all_ck"/> 全て選択</label>
                </td>
                <td>バクアプディレクトリ</td>
                <td>バクアプ時間</td>
                <td>サイズ</td>
                <td width="150">操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$dir" name="d">
                <tr>
                    <td width="50">
                        <label><input type="checkbox" name="dir[]" value="{$d.name}"/></label>
                    </td>
                    <td>{$d.name}</td>
                    <td>{$d.filemtime|date:'Y-m-d h:i:s',@@}</td>
                    <td>{$d.size|get_size}</td>
                    <td>
                        <a href="{|U:'recovery',array('dir'=>$d['name'])}">還元</a> |
                        <a href="javascript:if(confirm('削除しますか？')){zh_ajax('{|U:del}',{dir:['{$d.name}']});}">削除</a>
                    </td>
                </tr>
            </list>
            </tbody>
        </table>
    </form>
</div>
<div class="position-bottom">
    <input type="button" class="zh-cancel" onclick="select_all('.table2')" value="全て選択"/>
    <input type="button" class="zh-cancel" onclick="reverse_select('.table2')" value="反选"/>
    <input type="button" class="zh-cancel" onclick="del_backup()" value="一括削除"/>
</div>
</body>
</html>