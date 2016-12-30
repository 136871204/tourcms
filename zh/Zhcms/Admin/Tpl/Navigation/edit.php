<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>ナビ修正</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<form action="{|U:'edit'}" method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
    <input type="hidden" name="nid" value="{$field.nid}"/>
    <div class="wrap">
        <div class="menu_list">
            <ul>
                <li><a href="{|U:'index'}">ナビ一覧</a></li>
                <li><a href="javascript:;" class="action">ナビ修正</a></li>
                <li><a href="javascript:zh_ajax('{|U:update_cache}');">キャッシュ更新</a></li>
            </ul>
        </div>
        <div class="title-header">ナビ修正</div>
        <table class="table1">
            <tr>
                <td class="w100">上级:</td>
                <td>
                    <select name="pid">
                        <option value="0"> == 1級のナビ == </option>
                        <list from="$nav" name="n">
                            <option value="{$n.nid}" <if value="$n.nid==$field.pid">selected="selected"</if>>{$n._name}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <td>ナビ:</td>
                <td>
                    <input type="text" name="title" class="w200" value="{$field.title}"/>
                </td>
            </tr>
            <tr>
                <td>リンクUrl:</td>
                <td>
                    <input type="text" name="url" class="w300" value="{$field.url}"/>
                </td>
            </tr>
            <tr>
                <td class="w100">開ける方式</td>
                <td>
                    <select name="target">
                        <option value="1" <if value="$field.target==1">selected="selected"</if>>現在ウィンドウ  _self </option>
                        <option value="2" <if value="$field.target==2">selected="selected"</if>>新ウィンドウ  _blank </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>状态:</td>
                <td>
                    <label><input type="radio" name="state" value="1" <if value="$field.state==1">checked="checked"</if>> 表示</label>
                    <label><input type="radio" name="state" value="0" <if value="$field.state==0">checked="checked"</if>> 隠す</label>
                </td>
            </tr>
        </table>
    </div>
    <div class="position-bottom">
        <input type="submit" class="zh-success" value="確認"/>
    </div>
</form>
</body>
</html>