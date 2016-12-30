<!DOCTYPE html>
<html>
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
            <li><a href="javascript:;" class="action">站点添加</a></li>
            
        </ul>
    </div>
    <div class="title-header">站点信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <table class="table1">
            <tr>
                <th class="w100">站点名称</th>
                <td>
                    <input type="text" name="webname" class="w300" required=""/>
                </td>
            </tr>

            <tr>
                <th class="w100">站点地址</th>
                <td>
                    <input type="text" name="weburl" class="w600"/>
                </td>
            </tr>
            <tr>
                <th class="w100">是否主站</th>
                <td>
                    <input type="radio" name="is_main" value="0"  checked="checked"/> 主站
                    <input type="radio" name="is_main" value="1" /> 子站
                </td>
            </tr>
            <tr>
                <th class="w100">网站根目录</th>
                <td>
                    <input type="text" name="webroot" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">网站前缀</th>
                <td>
                    <input type="text" name="webprefix" class="w300"/>
                </td>
            </tr>
            <tr>
                <th class="w100">排序</th>
                <td>
                    <input type="text" name="displayorder" class="w300"/>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="确认" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>