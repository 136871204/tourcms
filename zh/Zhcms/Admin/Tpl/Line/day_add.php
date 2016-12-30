<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>线路分类管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="content-nr">
        <div class="web-set">
            <dl>
                <dd>
                    <list from="$lineKinds" name="lineKind">
                        <if value="$lineKind.name eq $lineKinds['lineday']['name']">
                            <a class="on" href="{$lineKind.url}">
                        <else>
                            <a href="{$lineKind.url}">
                        </if>
                        {$lineKind.name}</a>
                    </list>
                </dd>
            </dl>
        </div>
    </div>
    <div class="menu_list" style="clear: both;">
        <ul>
            <li><a href="{|U:'day'}">{$currentKindName}列表</a></li>
            <li><a href="javascript:;" class="action">添加{$currentKindName}</a></li>
        </ul>
    </div>
    <div class="title-header">{$currentKindName}信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:day}');">
        <input type="hidden" name="webid" value="1" />
        <table class="table1">

    
            <tr>
                <th class="w100">天数（只能输入数字）</th>
                <td>
                    <input type="text" name="word" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">是否在前台显示</th>
                <td>
                    <input type="radio" name="isdisplay" value="1" checked="checked" /> 显示
                    <input type="radio" name="isdisplay" value="0"  /> 不显示
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