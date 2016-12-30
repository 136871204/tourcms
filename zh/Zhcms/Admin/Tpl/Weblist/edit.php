<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>站点管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">站点列表</a></li>
            <li><a href="javascript:;" class="action">修改站点</a></li>
            
        </ul>
    </div>
    <div class="title-header">站点信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
        <input type="hidden" name="id" value="{$field.id}"/>
        <table class="table1">
            <tr>
                <th class="w100">站点名称</th>
                <td>
                    <input type="text" name="webname" class="w300" required="" value="{$field.webname}"/>
                </td>
            </tr>

            <tr>
                <th class="w100">站点地址</th>
                <td>
                    <input type="text" name="weburl" class="w600"  value="{$field.weburl}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">是否主站</th>
                <td>
                    <input type="radio" name="is_main" value="0"  <if value="$field.is_main==0">checked="checked"</if>/> 主站
                    <input type="radio" name="is_main" value="1" <if value="$field.is_main==1">checked="checked"</if>/> 子站
                </td>
            </tr>
            <tr>
                <th class="w100">网站根目录</th>
                <td>
                    <input type="text" name="webroot" class="w300" required=""  value="{$field.webroot}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">网站前缀</th>
                <td>
                    <input type="text" name="webprefix" class="w300"  value="{$field.webprefix}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">排序</th>
                <td>
                    <input type="text" name="displayorder" class="w300" value="{$field.displayorder}"/>
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