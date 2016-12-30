<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品分类</title>
    <zhjs/>
    <js file="__STATIC__/js/utils.js"/>
    <style>
    .wrap td.first-cell {
        font-weight: bold;
        padding-left: 10px;
    }
    </style>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">商品分类一览</a></li>
            <li><a href="{|U:'add'}">添加分类</a></li>
        </ul>
    </div>
    <table class="table2 zh-form"  id="list-table">
        <thead>
        <tr >
            <td>分类名称</td>
            <td>商品数量</td>
            <td>数量单位</td>
            <td>导航栏</td>
            <td>是否显示</td>
            <td>价格分级</td>
            <td>排序</td>
            <td>操作</td>
        </tr>
        </thead>
        <list from="$cat_info" name="cat">
            <tr  align="center" class="{$cat.level}" id="{$cat.level}_{$cat.cat_id}" >
                <td  align="left" class="first-cell" >
                <if value="$cat.is_leaf neq 1" >
                    <img src="__STATIC__/image/menu_minus.gif" id="icon_{$cat.level}_{$cat.cat_id}" width="9" height="9" border="0" style="margin-left:{$cat.level}em" onclick="rowClicked(this)" />
                <else>
                    <img src="__STATIC__/image/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:{$cat.level}em" />
                </if>
                {$cat.cat_name}
                </td>
                <td width="10%">{$cat.goods_num}</td>
                <td width="10%">{$cat.measure_unit}</td>
                <td width="10%">
                    <if value="$cat.show_in_nav eq '1'" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td width="10%">
                    <if value="$cat.is_show eq '1'" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td>{$cat.grade}</td>
                <td width="10%" align="right">{$cat.sort_order}</td>
                <td width="24%" align="center">
                    
                    <a href="{|U:'edit',array('cat_id'=>$cat['cat_id'])}">
				        修改
				    </a>|
                    <a href="javascript:if(confirm('确定删除吗？'))zh_ajax('{|U:del}',{cat_id:{$cat.cat_id}})">
				        删除
				    </a>
                </td>
            </tr>
        </list>
    </table>
    <div class="h60"></div>
</div>
<script>


var imgPlus = new Image();
imgPlus.src = "__STATIC__/image/menu_plus.gif";
/**
 * 折叠分类列表
 */
function rowClicked(obj)
{
    // 当前图像
    img = obj;
    // 取得上二级tr>td>img对象
    obj = obj.parentNode.parentNode;
    // 整个分类列表表格
    var tbl = document.getElementById("list-table");
    // 当前分类级别
    var lvl = parseInt(obj.className);
    // 是否找到元素
    var fnd = false;
    var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;
    // 遍历所有的分类
    for (i = 0; i < tbl.rows.length; i++){
        var row = tbl.rows[i];
        if (row == obj)
        {
            // 找到当前行
            fnd = true;
            //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
        }
        else
        {
            if (fnd == true)
            {
                var cur = parseInt(row.className);
                var icon = 'icon_' + row.id;
                if (cur > lvl)
                {
                    row.style.display = sub_display;
                    if (sub_display != 'none')
                    {
                        var iconimg = document.getElementById(icon);
                        iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                    } 
                }
                else
                {
                    fnd = false;
                    break;
                }
            }
        }
    }
    for (i = 0; i < obj.cells[0].childNodes.length; i++)
    {
        var imgObj = obj.cells[0].childNodes[i];
        if (imgObj.tagName == "IMG" && imgObj.src != '__STATIC__/image/menu_arrow.gif')
        {
            imgObj.src = (imgObj.src == imgPlus.src) ? '__STATIC__/image/menu_minus.gif' : imgPlus.src;
        }
    }
}
</script>
</body>
</html>