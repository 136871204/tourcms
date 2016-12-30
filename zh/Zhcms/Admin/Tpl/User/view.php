<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>審査会員資料</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/edit.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">会員一覧</a></li>
            <li><a href="javascript:;" class="action">会員審査</a></li>
        </ul>
    </div>
    <div class="title-header">審査会員資料</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index,array('state'=>'0')}')">
        <input type="hidden" name="uid" value="{$field.uid}"/>
        <input type="hidden" name="state" value="0"/>
        <table class="table1">
            <tr>
                <th class="w100">ユーザ名</th>
                <td>
                    {$field.username}
                </td>
            </tr>
            <tr>
                <th class="w100">会員グループ</th>
                <td>
                    <select name="rid">
                        <list from="$role" name="r">
                            <option value="{$r.rid}"
                            <if value="$field.rid eq $r.rid">selected=""</if>
                            >{$r.rname}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">ネックネーム</th>
                <td>
                    {$field.nickname}
                </td>
            </tr>
            <tr>
                <th class="w100">ロック時間</th>
                <td>
                    {$field.lock_end_time|date:'Y/m/d',@@}
                </td>
            </tr>
            <tr>
                <th class="w100">メールアドレス</th>
                <td>
                    {$field.email}
                </td>
            </tr>
            <tr>
                <th class="w100">QQ</th>
                <td>
                    {$field.qq}
                </td>
            </tr>
            <tr>
                <th class="w100">積分</th>
                <td>
                    {$field.credits}
                </td>
            </tr>
            <tr>
                <th class="w100">審査</th>
                <td>
                    <label>
                        <input type="radio" name="user_state" value="1" <if value="$field.user_state==1">checked="checked"</if>/>　はい
                    </label> 
                    <label>
                        <input type="radio" name="user_state" value="0" <if value="$field.user_state==0">checked="checked"</if>/> いや
                    </label>
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