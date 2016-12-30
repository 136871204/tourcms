<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品ブランド管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">商品ブランド一覧</a></li>
            <li><a href="javascript:;" class="action">商品ブランド修正</a></li>
        </ul>
    </div>
    <div class="title-header">商品ブランド修正</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}')">
        <input type="hidden" name="brand_id" value="{$field.brand_id}"/>
        <table class="table1">
            <tr>
                <th class="w100">名称</th>
                <td>
                    <input type="text" name="brand_name" class="w300" value="{$field.brand_name}" required=""/>
                </td>
            </tr>

            <tr>
                <th class="w100">ホームページ</th>
                <td>
                    <input type="text" name="site_url" class="w600"  value="{$field.site_url}" />
                </td>
            </tr>
            <tr>
                <th class="w100">LOGO画像</th>
                <td>
                    <input id='brand_logo' type='text' name='brand_logo'  value='{$field.brand_logo}' src='{$field.brand_logo}' class="w300 images" onmouseover='view_image(this)'/>
                    <button class='zh-cancel-small' onclick='file_upload({"id":"brand_logo","type":"image","dir":"brand","num":1,"name":"brand_logo","filetype":"jpg,png,gif,jpeg","upload_img_max_width":"800","upload_img_max_height":"800"})' type='button'>画像アップロード</button>&nbsp;&nbsp;
                    <button class='zh-cancel-small' onclick='remove_upload_one_img(this)' type='button'>取り除く</button> 
                </td>
            </tr>
            <tr>
                <th class="w100">紹介</th>
                <td>
                    <textarea  name="brand_desc" cols="60" rows="4"  >{$field.brand_desc}</textarea>
                </td>
            </tr>
            <tr>
                <th class="w100">ソート</th>
                <td>
                    <input type="text" name="sort_order" class="w300" value="{$field.sort_order}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">表示</th>
                <td>
                    <input type="radio" name="is_show" value="1"  <if value="$field.is_show==1">checked="checked"</if>/> 表示する
                    <input type="radio" name="is_show" value="0"   <if value="$field.is_show==0">checked="checked"</if> /> 表示しない
                </td>
            </tr>

        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>