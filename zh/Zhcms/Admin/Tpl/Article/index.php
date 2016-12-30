<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>文章列表</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script src='__STATIC__/js/utils.js'></script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">文章列表</a></li>
                <li><a href="{|U:'add'}">添加新文章</a></li>
        </ul>
    </div>
    <form action="" class="zh-form" method="get">
                <input type="hidden" name="g" value="Zhcms"/>
                <input type="hidden" name="a" value="Admin"/>
                <input type="hidden" name="c" value="Article"/>
                <input type="hidden" name="m" value="index"/>
    <img src="__STATIC__/image/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <select name="cat_id" >
      <option value="0">全部分类</option>
        {$cat_select}
    </select>
    文章标题 <input type="text" name="keyword" id="keyword" />
    <input type="submit" value="搜索" class="button" />
    </form><br />
    <table class="table2 zh-form"  id="list-table">
        <thead>
        <tr>
            <th > 编号</th>
            <th >文章标题</th>
            <th>文章分类</th>
            <th>文章重要性</th>
            <th>是否显示</th>
            <th>添加日期</th>
            <th>操作</th>
        </tr>
        </thead>
        <list from="$article_list" name="list">
        <tr>
            <td>
                <span>
                    <input name="checkboxes[]" type="checkbox" value="{$list.article_id}" <if value='$list.cat_id <= 0' >disabled="true"</if>/>{$list.article_id}
                </span>
            </td>
            <td>
                <span>
                    {$list.title|htmlspecialchars:@@}
                </span>
            </td>
            <td align="left">
                <span>
                    <if value='$list.cat_id <= 0' >
                        保留
                    <else>
                        {$list.cat_name|htmlspecialchars:@@}
                    </if>
                </span>
            </td>
            <td align="center">
                <span>
                    <if value='$list.article_type eq 0'>
                    普通
                    <else>
                    置顶 
                    </if>
                </span>
            </td>
            <td align="center">
                <if value='$list.cat_id gt 0'>
                    <span>
                        <if value='$list.is_open eq 1'>
                            <img src="__STATIC__/image/yes.gif" />
                        <else>
                            <img src="__STATIC__/image/no.gif" />
                        </if>
                    </span>
                <else>
                    <img src="__STATIC__/image/yes.gif" alt="yes" />
                </if>
            </td>
            <td align="center"><span>{$list.date}</span></td>
            <td align="center" nowrap="true">
                <span>
                </span>
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