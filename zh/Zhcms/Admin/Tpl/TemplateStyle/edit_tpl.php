<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>テンプレート修正</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/edit_tpl.js"/>
</head>
<body>
<div class="wrap" style="bottom: 0px;">
    <div class="title-header">提示</div>
    <div class="help">
        <p>1 テンプレート修正して後、キャッシュ削除して、静態画面を再作成して後、効果が見えます</p>

        <p>2 テンプレート修正する前、バクアプしてください！</p>
    </div>
    <div class="title-header">テンプレート修正</div>
    <form action="{|U:add}" method="post" onsubmit="return false">
        <input type="hidden" name="file_path" value="{$field.file_path}" />
        <!--右侧缩略图区域-->
        <table class="table1 zh-form">
            <tr>
                <th class="w100">ファイル名</th>
                <td>
                    <input type="text" name="file_name" value="{$field.file_name}" class="w300"/>
                </td>
            </tr>
            <tr>
                <th class="w100">内容</th>
                <td>
                <!--修改模板bug,回车使用不了，在zhjs 中为了防止表单回车提交做了限制，所以出现这个问题，如何更好处理之后解决-->
                    <textarea name="content" style="width:80%;height:500px;">{$field.content}</textarea>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
            <input type="button" value="放棄" class="zh-cancel" onclick="zh_close_window('編集止めますか？')"/>
        </div>
    </form>
</div>
</body>
</html>