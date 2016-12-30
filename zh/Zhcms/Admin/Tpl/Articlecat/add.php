<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>添加文章分类</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script>
    var sys_hold = "系统保留分类，不允许添加子分类";
    </script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">文章列表</a></li>
            <li><a href="javascript:;" class="action">添加文章分类</a></li>
        </ul>
    </div>
    <div class="title-header">添加文章信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');" name="theForm">
        <table class="table1">
            <tr>
                <th class="w100">文章分类名称:</th>
                <td>
                    <input type="text" name="cat_name" maxlength="60" class="w300" value="{$cat.cat_name|htmlspecialchars:@@}" />
                </td>
            </tr>
            <tr>
                <th>上级分类:</th>
                <td>
                    <select name="parent_id" onchange="catChanged()" <if value='$disabled'>disabled="disabled"</if> >
                        <option value="0">顶级分类</option>
                        {$cat_select}
                    </select>
                </td>
            </tr>
            <tr>
                <th>排序:</th>
                <td>
                    <input type="text" name='sort_order' <if value='$cat.sort_order' >value='{$cat.sort_order}'<else> value="50"</if> class="w150" />
                </td>
            </tr>
            <tr>
                <th>是否显示在导航栏:</th>
                <td>
                    <input type="radio" name="show_in_nav" value="1" <if value='{$cat.show_in_nav} neq 0' > checked="true"</if>/> YES
                    <input type="radio" name="show_in_nav" value="0" <if value='{$cat.show_in_nav} eq 0' > checked="true"</if> /> NO
                </td>
            </tr>
            <tr>
                <th>关键字:</th>
                <td>
                    <input type="text" name="keywords" maxlength="60" class="w500"  value="{$cat.keywords|htmlspecialchars:@@}" />
                    <br />
                    <span  id="goods_sn_notice">
                    *关键字为选填项，其目的在于方便外部搜索引擎搜索。
                    </span>
                </td>
            </tr>
            <tr>
                <th>描述:</th>
                <td>
                <textarea  name="cat_desc" cols="60" rows="4">{$cat.cat_desc|htmlspecialchars:@@}</textarea>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
<script>

/**
 * 选取上级分类时判断选定的分类是不是底层分类
 */
function catChanged()
{
    var obj = document.forms['theForm'].elements['parent_id'];
    cat_type = obj.options[obj.selectedIndex].getAttribute('cat_type');
    if (cat_type == undefined)
    {
        cat_type = 1;
    }
    if ((obj.selectedIndex > 0) && (cat_type == 2 || cat_type == 3 || cat_type == 5))
    {
        alert(sys_hold);
        obj.selectedIndex = 0;
        return false;
    }
    return true;
}
</script>
</body>
</html>