<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品分类</title>
    <zhjs/>
    <js file="__STATIC__/js/utils.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">商品分类一览</a></li>
            <li><a href="javascript:;" class="action">修改分类</a></li>
        </ul>
    </div>
    <div class="title-header">商品分类情报</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <input type="hidden" name="cat_id" value="{$cat_info.cat_id}" />
        <input type="hidden" name="old_cat_name" value="{$cat_info.cat_name}" />
        <table class="table1">
            <tr>
                <th class="w100">分类名称:</th>
                <td>
                    <input type="text" name="cat_name" class="w300" required="" value="{$cat_info.cat_name|htmlspecialchars:@@}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">上级分类:</th>
                <td>
                    <select name="parent_id">
                        <option value="0">顶级分类</option>
                        {$cat_select}
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">数量单位:</th>
                <td>
                    <input type="text" name='measure_unit' value='{$cat_info.measure_unit}' class="w300" />
                </td>
            </tr>
            <tr>
                <th class="w100">排序:</th>
                <td>
                    <input type="text" name='sort_order' <if value="$c.sort_order"> value='{$cat_info.sort_order}' <else> value="50" </if>  class="w300" />
                </td>
            </tr>
            <tr>
                <th class="w100">是否显示:</th>
                <td>
                    <input type="radio" name="is_show" value="1" <if value="$cat_info.is_show neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="is_show" value="0" <if value="$cat_info.is_show eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <th class="w100">是否显示在导航栏:</th>
                <td>
                    <input type="radio" name="show_in_nav" value="1" <if value="$cat_info.show_in_nav neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="show_in_nav" value="0" <if value="$cat_info.show_in_nav eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <th class="w100">设置为首页推荐:</th>
                <td>
                    <input type="checkbox" name="cat_recommend[]" value="1" <if value="$cat_recommend[1] eq 1"> checked="true" </if> /> 精品
                    <input type="checkbox" name="cat_recommend[]" value="2" <if value="$cat_recommend[2] eq 1"> checked="true" </if>  /> 最新
                    <input type="checkbox" name="cat_recommend[]" value="3" <if value="$cat_recommend[3] eq 1"> checked="true" </if>  /> 热门
                </td>
            </tr>
            <tr>
                <th class="w100">筛选属性:</th>
                <td>
                    <script type="text/javascript">
                        var arr = new Array();
                        var sel_filter_attr = "请选择筛选属性";
                        <foreach from="$attr_list" value="$val" key="$att_cat_id">
                            arr[{$att_cat_id}] = new Array();
                            <foreach from="$val" value="$item" key="$i">
                                <foreach from="$item" value="$attr_val" key="$attr_id">
                                    arr[{$att_cat_id}][{$i}] = ["{$attr_val}", {$attr_id}];
                                </foreach>
                            </foreach>
                        </foreach>
                        
                        function changeCat(obj)
                      {
                        var key = obj.value;
                        var sel = window.ActiveXObject ? obj.parentNode.childNodes[4] : obj.parentNode.childNodes[5];
                        sel.length = 0;
                        sel.options[0] = new Option(sel_filter_attr, 0);
                        if (arr[key] == undefined)
                        {
                          return;
                        }
                        for (var i= 0; i < arr[key].length ;i++ )
                        {
                          sel.options[i+1] = new Option(arr[key][i][0], arr[key][i][1]);
                        }
            
                      }
                    </script>
                    <table width="100%" id="tbody-attr" align="center">
                        <if value="$attr_cat_id eq 0">
                        <tr>
                            <td> 
                                <a href="javascript:;" onclick="addFilterAttr(this)">[+]</a> 
                                <select onChange="changeCat(this)">
                                    <option value="0">请选择商品类型</option>
                                    {$goods_type_list}
                                </select>&nbsp;&nbsp;
                                <select name="filter_attr[]">
                                    <option value="0">请选择筛选属性</option>
                                </select>
                            </td>
                        </tr>
                        </if>
                        <foreach from="$filter_attr_list" value="$filter_attr">
                        <tr>
                            <td>
                                <if value="$index eq 0">
                                    <a href="javascript:;" onclick="addFilterAttr(this)">[+]</a>
                                <else>
                                    <a href="javascript:;" onclick="removeFilterAttr(this)">[-]&nbsp;</a>
                                </if>
                                <select onChange="changeCat(this)">
                                    <option value="0">请选择商品类型</option>
                                    {$filter_attr.goods_type_list}
                                </select>&nbsp;&nbsp;
                                <select name="filter_attr[]">
                                    <option value="0">请选择筛选属性</option>
                                    <html_options  options="{$filter_attr.option}" selected="{$filter_attr.filter_attr}">
                                </select><br />
                            </td>
                        </tr>
                        </foreach>
                    </table>
                </td>
            </tr>
            <tr>
                <th>价格区间个数:</th>
                <td>
                     <input type="text" name="grade" value="{$cat_info.grade|defaultv:@@,0}" class="w300" /> <br />
                </td>
            </tr>
            <tr>
                <th>分类的样式表文件:</th>
                <td>
                     <input type="text" name="style" value="{$cat_info.style|escape}" class="w300" /> <br />
                </td>
            </tr>
            <tr>
                <th>关键字:</th>
                <td>
                     <input type="text" name="keywords" value='{$cat_info.keywords}' class="w300">
                </td>
            </tr>
            <tr>
                <th>分类描述:</th>
                <td>
                    <textarea name='cat_desc' rows="6" cols="48">{$cat_info.cat_desc}</textarea>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
    <div class="h60"></div>
</div>
<script>

/**
 * 新增一个筛选属性
 */
function addFilterAttr(obj)
{
  var src = obj.parentNode.parentNode;
  var tbl = document.getElementById('tbody-attr');

  //var validator  = new Validator('theForm');
  var error=false;
  var filterAttr = document.getElementsByName("filter_attr[]");

  if (filterAttr[filterAttr.length-1].selectedIndex == 0)
  {
    error=true;
    alert('请选择筛选属性');
    //validator.addErrorMsg(filter_attr_not_selected);
  }
  
  for (i = 0; i < filterAttr.length; i++)
  {
    for (j = i + 1; j <filterAttr.length; j++)
    {
      if (filterAttr.item(i).value == filterAttr.item(j).value)
      {
        error=true;
        alert('筛选属性不可重复');
        //validator.addErrorMsg(filter_attr_not_repeated);
      } 
    } 
  }

  if (error)
  {
    return false;
  }

  var row  = tbl.insertRow(tbl.rows.length);
  var cell = row.insertCell(-1);
  cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addFilterAttr)(.*)(\[)(\+)/i, "$1removeFilterAttr$3$4-");
  filterAttr[filterAttr.length-1].selectedIndex = 0;
}

/**
 * 删除一个筛选属性
 */
function removeFilterAttr(obj)
{
  var row = rowindex(obj.parentNode.parentNode);
  var tbl = document.getElementById('tbody-attr');

  tbl.deleteRow(row);
}


</script>
</body>
</html>