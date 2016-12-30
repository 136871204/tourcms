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
                        <if value="$lineKind.name eq $lineKinds['lineattr']['name']">
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
            <li><a href="{|U:'attr',array('webid'=>$_GET['webid'])}">{$currentKindName}列表</a></li>
            <li><a href="javascript:;" class="action">添加{$currentKindName}</a></li>
        </ul>
    </div>
    <div class="title-header">{$currentKindName}信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:attr,array('webid'=>$_GET['webid'])}');">
        <input type="hidden" name="webid" value="{$zh.get.webid}"/>
        <table class="table1">

            <tr>
                <th class="w100">属性名称</th>
                <td>
                    <input type="text" name="attrname" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">上级分类:</th>
                <td>
                    <select name="pid">
                        <option value="0">顶级分类</option>
                        {$select}
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">排序</th>
                <td>
                    <input type="text" name="displayorder" class="w50" value="9999" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">显示</th>
                <td>
                    <input type="radio" name="isopen" value="1" checked="checked" /> 显示
                    <input type="radio" name="isopen" value="0"  /> 不显示
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