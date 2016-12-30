<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品类型管理</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">商品类型一览</a></li>
            <li><a href="javascript:;" class="action">新建商品类型</a></li>
        </ul>
    </div>
    <div class="title-header">商品类型情报</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <table class="table1">
            <tr>
                <th class="w100">商品类型名称</th>
                <td>
                    <input type="text" name="cat_name" class="w300" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">状态</th>
                <td>
                    <input type="radio" name="enabled" value="0" />&nbsp;禁用&nbsp;
                    <input type="radio" name="enabled" value="1" checked="" />&nbsp;启用&nbsp;
                </td>
            </tr>
            <tr>
                <th class="w100">属性分组</th>
                <td>
                    <textarea name="attr_group" rows="5" cols="40"></textarea>
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