<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>目的地</title>
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
            <li><a href="javascript:;" class="action">目的地列表</a></li>
            <li><a href="{|U:'add'}">目的地添加</a></li>
        </ul>
    </div>
    <table class="table2 zh-form"  id="list-table">
        <thead>
        <tr >
            <td >目的地</td>
            <td>是否开启</td>
            <td>首页显示</td>
            <td>热门</td>
            <td >排序</td>
            <td>操作</td>
        </tr>
        </thead>
        <list from="$dest_info" name="dest">
            <tr  align="center" class="{$dest.level}" id="{$dest.level}_{$dest.id}" >
                <td  align="left" class="first-cell" >
                <if value="$dest.is_leaf neq 1" >
                    <img src="__STATIC__/image/menu_minus.gif" id="icon_{$dest.level}_{$dest.id}" width="9" height="9" border="0" style="margin-left:{$dest.level}em" onclick="rowClicked(this)" />
                <else>
                    <img src="__STATIC__/image/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:{$dest.level}em" />
                </if>
                {$dest.kindname}
                </td>
                <td >
                    <if value="$dest.isopen eq 1" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td >
                    <if value="$dest.isnav eq 1" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td >
                    <if value="$dest.ishot eq 1" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td >{$dest.displayorder}</td>
                <td  >
                    <a href="{|U:'add',array('pid'=>$dest['id'])}">
						添加子目的地
				    </a>|
                    <a href="{|U:'edit',array('id'=>$dest['id'])}">
				        修改
				    </a>|
                    <a href="javascript:if(confirm('确定删除吗？'))zh_ajax('{|U:del}',{id:{$dest.id}})">
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