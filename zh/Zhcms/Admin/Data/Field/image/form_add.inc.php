<script>
var admin_field_image_validate_js_message1='<?php echo $language['admin_field_image_validate_js_message1']; ?>';
var admin_field_image_validate_js_message2='<?php echo $language['admin_field_image_validate_js_message2']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_image_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_image_item1']; ?></td>
                    <td>
                        <label><input type="text" class="w100 image_height" name="set[upload_img_max_width]" value="800"/> </label>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_image_item2']; ?></td>
                    <td>
                        <label><input type="text"  class="w100 image_width" name="set[upload_img_max_height]" value="800"/> </label>
                    </td>
                </tr>
                <tr>
                    <td class="w100">图片生成方式</td>
                    <td>
                        <label><input type="radio" name="set[thumb_type]" value="1"/>固定宽度,高度自增</label>
                        <label><input type="radio" name="set[thumb_type]" value="2"/>固定高度,宽度自增</label>
                        <label><input type="radio" name="set[thumb_type]" value="3"/>固定宽度,高度裁切</label>
                        <label><input type="radio" name="set[thumb_type]" value="4"/>固定高度,宽度裁切</label>
                        <label><input type="radio" name="set[thumb_type]" value="5" checked="checked"/>缩放最大边</label>
                        <label><input type="radio" name="set[thumb_type]" value="6"/>自动裁切图片</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>