<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>线路分类管理</title>
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
                <li><a href="{|U:'attr'}" class="action">{$currentKindName}列表</a></li>
                <li><a href="{|U:'attr_add',array('webid'=>$_GET['webid'])}">添加{$currentKindName}</a></li>
        </ul>
    </div>
    <table class="table2 zh-form"   id="list-table">
        <thead>
        <tr>
            <td>属性</td>
            <td>是否开启</td>
            <td>排序</td>
            <td>操作</td>
        </tr>
        </thead>
        <list from="$list_info" name="info">
            <tr  align="center" class="{$info.level}" id="{$info.level}_{$info.id}" >
                <td  align="left" class="first-cell" >
                <if value="$info.is_leaf neq 1" >
                    <img src="__STATIC__/image/menu_minus.gif" id="icon_{$info.level}_{$info.id}" width="9" height="9" border="0" style="margin-left:{$info.level}em" onclick="rowClicked(this)" />
                <else>
                    <img src="__STATIC__/image/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:{$info.level}em" />
                </if>
                {$info.attrname}
                </td>
                <td >
                    <if value="$info.isopen eq 1" >
                        <img src="__STATIC__/image/yes.gif" />
                    <else>
                        <img src="__STATIC__/image/no.gif" />
                    </if>
                </td>
                <td >{$info.displayorder}</td>
                <td  >
                    <a href="{|U:'attr_add',array('pid'=>$info['id'],'webid'=>$_GET['webid'])}">
						添加子目的地
				    </a>|
                    <a href="{|U:'attr_edit',array('id'=>$info['id'],'webid'=>$_GET['webid'])}">
				        修改
				    </a>|
                    <a href="javascript:if(confirm('确定删除吗？'))zh_ajax('{|U:attr_del}',{id:{$info.id},webid:{$_GET['webid']}})">
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