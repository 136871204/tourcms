<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>テンプレート編集</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="title-header">提示</div>
    <div class="help">
        テンプレート修正する前、バクアプしてください！
    </div>
    <if value="$zh.get.dir_name">
        <a href="javascript:window.history.back();" class="hd-cancel" style="margin-bottom: 15px;">戻る</a>
    </if>
    <table class="table2">
        <thead>
        <tr>
            <td>ファイル名</td>
            <td>修正時間</td>
            <td>サイズ</td>
            <td class="w100">操作</td>
        </tr>
        </thead>
        <list from="$dirs" name="d">
            <tr>
                <td>{$d.name}</td>
                <td>{$d.filemtime|date:"Y-m-d H:i",@@}</td>
                <td>{$d.size|get_size}</td>
                <td>
                    <if value="$d.type=='dir'">
                        <a href="__METH__&dir_name={$d.path|urlencode}">入る</a>
                        <else>
                            <a href="javascript:;" onclick="zh_open_window('__CONTROL__&m=edit_tpl&file_path={$d.path|urlencode}')">修正</a>
                    </if>
                </td>
            </tr>
        </list>
    </table>
</div>
</body>
</html>