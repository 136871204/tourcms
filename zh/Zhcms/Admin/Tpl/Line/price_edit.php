<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
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
                        <if value="$lineKind.name eq $lineKinds['lineprice']['name']">
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
            <li><a href="{|U:'price'}">{$currentKindName}列表</a></li>
            <li><a href="javascript:;" class="action">修改{$currentKindName}</a></li>
        </ul>
    </div>
    <div class="title-header">{$currentKindName}信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:price}')">
        <input type="hidden" name="id" value="{$field.id}"/>
        <input type="hidden" name="webid" value="{$field.webid}" />
        <table class="table1">


            <tr>
                <th class="w100">最低价格</th>
                <td>
                    <input type="text" name="lowerprice" value="{$field.lowerprice}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">最高价格</th>
                <td>
                    <input type="text" name="highprice" value="{$field.highprice}" class="w200"/>
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