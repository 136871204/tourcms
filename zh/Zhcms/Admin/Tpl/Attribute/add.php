<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>属性管理</title>
    <zhjs/>

</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Admin/GoodsType/Index'}">商品类型</a></li>
            <li><a href="{|U:'Index',array('goods_type'=>$_GET['goods_type'])}">属性列表</a></li>
            <li><a href="javascript:;" class="action">添加属性</a></li>
        </ul>
    </div>
    <div class="title-header">属性情报</div>
    <form action="{|U:add}" method="post" name="theForm" class="zh-form" onsubmit="return zh_submit(this,'{|U:index,array('goods_type'=>$_GET['goods_type'])}');">
        <table class="table1">
            <tr>
                <th class="w150">属性名称：</th>
                <td>
                    <input type="text" name="attr_name" class="w300" required="" value="{$attr.attr_name}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">所属商品类型：</th>
                <td>
                    <select name="cat_id" onchange="onChangeGoodsType(this.value)">
                      <option value="0">请选择...</option>
                        {$goods_type_list}
                      </select> 
                </td>
            </tr>
            <tr    id="attrGroups" style="display:none">
                <th class="w100">属性分组：</th>
                <td>
                    <select name="attr_group">
                        <if value="$attr_groups">
                            <html_options  options="$attr_groups" selected="{$attr.attr_group}">
                        </if>
                    </select>
                </td>
            </tr>
            <tr>
                <th>
                   能否进行检索：
                </th>
                <td>
                    <input type="radio" name="attr_index" value="0" <if value="$attr.attr_index eq 0"> checked="true" </if>  />
                   不需要检索
                  <input type="radio" name="attr_index" value="1" <if value="$attr.attr_index eq 1"> checked="true" </if>/>
                  关键字检索
                  <input type="radio" name="attr_index" value="2"  <if value="$attr.attr_index eq 2"> checked="true" </if>/>
                  范围检索 
                </td>
            </tr>
            <tr>
                <th>相同属性值的商品是否关联？</th>
                <td>
                    <input type="radio" name="is_linked" value="0" <if value="$attr.is_linked eq 0"> checked="true" </if> /> 否 
                    <input type="radio" name="is_linked" value="1" <if value="$attr.is_linked eq 1"> checked="true" </if> /> 是 
                </td>
            </tr>
            <tr>
                <th>属性是否可选</th>
                <td>
                    <input type="radio" name="attr_type" value="0" <if value="$attr.attr_type eq 0"> checked="true" </if>  />
                  唯一属性 
                  <input type="radio" name="attr_type" value="1" <if value="$attr.attr_type eq 1"> checked="true" </if>  />
                  单选属性
                  <input type="radio" name="attr_type" value="2" <if value="$attr.attr_type eq 2"> checked="true" </if>  />
                  复选属性
                </td>
            </tr>
            <tr>
                <th>该属性值的录入方式：</th>
                <td>
                    <input type="radio" name="attr_input_type" value="0" <if value="$attr.attr_input_type eq 0"> checked="true" </if>  onclick="radioClicked(0)"/>
                  手工录入 
                  <input type="radio" name="attr_input_type" value="1" <if value="$attr.attr_input_type eq 1"> checked="true" </if>  onclick="radioClicked(1)"/>
                   从下面的列表中选择（一行代表一个可选值）
                  <input type="radio" name="attr_input_type" value="2" <if value="$attr.attr_input_type eq 2"> checked="true" </if>  onclick="radioClicked(0)"/>
                  多行文本框
                </td>
            </tr>
            <tr>
                <th>可选值列表：</th>
                <td>
                    <textarea name="attr_values" cols="30" rows="5" >{$attr.attr_values}</textarea>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="确认" class="zh-success"/>
        </div>
    </form>
</div>
<script>
$(document).ready(function(){
    radioClicked({$attr.attr_input_type});
  onChangeGoodsType({$attr.cat_id});
});

/**
 * 点击类型按钮时切换选项的禁用状态
 */
function radioClicked(n)
{
  document.forms['theForm'].elements["attr_values"].disabled = n > 0 ? false : true;
}

/**
 * 改变商品类型的处理函数
 */
function onChangeGoodsType(catId)
{
    var ajaxurl=CONTROL +"&m=getAttrGroups&cat_id="+catId;
    $.ajax({
        type : "GET",
        url : ajaxurl,
        dataType : "JSON",
        success : function(data) {
            var row = document.getElementById('attrGroups');
            if (data.length == 0) {
                row.style.display = 'none';
            }else {
                row.style.display = document.all ? 'block' : 'table-row';
                var sel = document.forms['theForm'].elements['attr_group'];
                sel.length = 0;
                for (var i = 0; i < data.length; i++){
                    var opt = document.createElement('OPTION');
                    opt.value = i;
                    opt.text = data[i];
                    sel.options.add(opt);
                    if (i == '{$attr.attr_group}'){
                       opt.selected=true; 
                    }
                }
            }
        },
        error : function() {
			$.dialog({
                message : "請求タイムアウトでしばらくお待って再試行してください",
                type : "error"
            });		
        }
    })
  
}
</script>
</body>
</html>