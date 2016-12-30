<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>出发地</title>
    <zhjs/>
    <js file="__STATIC__/js/utils.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">出发地列表</a></li>
            <li><a href="javascript:;" class="action">修改出发地</a></li>
        </ul>
    </div>
    <div class="title-header">出发地情报</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <input type="hidden" name="id" value="{$info.id}" />
        <input type="hidden" name="old_cityname" value="{$info.cityname}" />
        <table class="table1">
            <tr>
                <th class="w100">目的地:</th>
                <td>
                    <input type="text" name="cityname" class="w300" required="" value="{$info.cityname|htmlspecialchars:@@}"/>
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
                <th class="w100">排序:</th>
                <td>
                    <input type="text" name='displayorder' <if value="$info.displayorder"> value='{$info.displayorder}' <else> value="9999" </if>  class="w300" />
                </td>
            </tr>
            <tr>
                <th class="w100">是否开启:</th>
                <td>
                    <input type="radio" name="isopen" value="1" <if value="$info.isopen neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="isopen" value="0" <if value="$info.isopen eq 0"> checked="true" </if> /> 否
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


</script>
</body>
</html>