<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>目的地</title>
    <zhjs/>
    <js file="__STATIC__/js/utils.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">目的地列表</a></li>
            <li><a href="javascript:;" class="action">修改目的地</a></li>
        </ul>
    </div>
    <div class="title-header">目的地情报</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <input type="hidden" name="id" value="{$dest_info.id}" />
        <input type="hidden" name="old_kindname" value="{$dest_info.kindname}" />
        <table class="table1">
            <tr>
                <th class="w100">目的地:</th>
                <td>
                    <input type="text" name="kindname" class="w300" required="" value="{$dest_info.kindname|htmlspecialchars:@@}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">上级分类:</th>
                <td>
                    <select name="pid">
                        <option value="0">顶级分类</option>
                        {$dest_select}
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">排序:</th>
                <td>
                    <input type="text" name='displayorder' <if value="$dest_info.displayorder"> value='{$dest_info.displayorder}' <else> value="9999" </if>  class="w300" />
                </td>
            </tr>
            <tr>
                <th class="w100">是否开启:</th>
                <td>
                    <input type="radio" name="isopen" value="1" <if value="$dest_info.isopen neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="isopen" value="0" <if value="$dest_info.isopen eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <th class="w100">首页显示:</th>
                <td>
                    <input type="radio" name="isnav" value="1" <if value="$dest_info.isnav neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="isnav" value="0" <if value="$dest_info.isnav eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <th class="w100">是否热门:</th>
                <td>
                    <input type="radio" name="ishot" value="1" <if value="$dest_info.ishot neq 0"> checked="true" </if>/> 是
                    <input type="radio" name="ishot" value="0" <if value="$dest_info.ishot eq 0"> checked="true" </if> /> 否
                </td>
            </tr>
            <tr>
                <th>关键字:</th>
                <td>
                     <input type="text" name="keyword" value='{$dest_info.keyword}' class="w300">
                </td>
            </tr>
            <tr>
                <th>目的地描述:</th>
                <td>
                    <textarea name='description' rows="6" cols="48">{$dest_info.description}</textarea>
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