<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>文章分类列表</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script src='__STATIC__/js/utils.js'></script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">文章分类列表</a></li>
                <li><a href="{|U:'add'}">添加文章分类</a></li>
        </ul>
    </div>
    <table class="table2 zh-form"  id="list-table">
        <thead>
        <tr>
            <th >文章分类名称</th>
            <th >分类类型</th>
            <th>描述</th>
            <th>排序</th>
            <th>是否显示在导航栏</th>
            <th>操作</th>
        </tr>
        </thead>
        <list from="$articlecat" name="cat">
            <tr  align="center"  class="{$cat.level}" id="{$cat.level}_{$cat.cat_id}">
                <td align="left" class="first-cell nowrap" valign="top" >
                <if value="{$cat.is_leaf} neq 1">
                    <img src="__STATIC__/image/menu_minus.gif" id="icon_{$cat.level}_{$cat.cat_id}" width="9" height="9" border="0" style="margin-left:{$cat.level}em" onclick="rowClicked(this)" />
                <else>
                    <img src="__STATIC__/image/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:{$cat.level}em" />
                </if>
                <span>{$cat.cat_name|htmlspecialchars:@@}</span>
                </td>
                <td class="nowrap" valign="top">
                  {$cat.type_name|htmlspecialchars:@@}
                </td>
                <td align="left" valign="top">
                  {$cat.cat_desc|htmlspecialchars:@@}
                </td>
                <td width="10%" align="right" class="nowrap" valign="top">
                    {$cat.sort_order}
                </td>
                <td width="10%" class="nowrap" valign="top">
                <if value="{$cat.show_in_nav} eq 1">
                    <img src="__STATIC__/image/yes.gif" />
                <else>
                    <img src="__STATIC__/image/no.gif" />
                </if>
                </td>
                <td width="24%" align="right" class="nowrap" valign="top">
                    <a href="{|U:'edit',array('id'=>$cat['cat_id'])}">编辑</a>
                    <if value="{$cat.cat_type} neq 2 and {$cat.cat_type} neq 3 and {$cat.cat_type} neq 4">
                    | 
                     <a href="javascript:confirm('确定移除吗？')?zh_ajax('{|U:del}',{id:{$cat.cat_id}}):void(0);">移除</a>
                    </if>
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
  for (i = 0; i < tbl.rows.length; i++)
  {
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