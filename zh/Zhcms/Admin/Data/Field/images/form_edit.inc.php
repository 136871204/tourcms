<script>
var admin_field_images_validate_js_message1='<?php echo $language['admin_field_images_validate_js_message1']; ?>';
var admin_field_images_validate_js_message2='<?php echo $language['admin_field_images_validate_js_message2']; ?>';
var admin_field_images_validate_js_message3='<?php echo $language['admin_field_images_validate_js_message3']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/images/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_image_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_images_item1']; ?></td>
                    <td>
                        <label>
                            <input type="text" class="w100" name="set[upload_img_max_width]" value="<?php echo $field['set']['upload_img_max_width'];?>"/>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_images_item2']; ?></td>
                    <td>
                        <label>
                            <input type="text" class="w100" name="set[upload_img_max_height]" value="<?php echo $field['set']['upload_img_max_height'];?>"/>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_images_item3']; ?></td>
                    <td>
                        <input type="text" class="w100" name="set[num]" value="<?php echo $field['set']['num'];?>"/>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_images_item4']; ?></td>
                    <td>
                        <label><input type="radio" name="set[name_sort]" value="1" <?php if($field['set']['name_sort']=='1'){?>checked=""<?php }?>/>いいえ</label>
                        <label><input type="radio" name="set[name_sort]" value="2" <?php if($field['set']['name_sort']=='2'){?>checked=""<?php }?>/> はい</label>
                    </td>
                </tr>
                <tr>
                    <td class="w100">图片生成方式</td>
                    <td>
                        <label><input type="radio" name="set[thumb_type]" value="1" <?php if($field['set']['thumb_type']=='1'){?>checked=""<?php }?>/>固定宽度,高度自增</label>
                        <label><input type="radio" name="set[thumb_type]" value="2" <?php if($field['set']['thumb_type']=='2'){?>checked=""<?php }?>/>固定高度,宽度自增</label>
                        <label><input type="radio" name="set[thumb_type]" value="3" <?php if($field['set']['thumb_type']=='3'){?>checked=""<?php }?>/>固定宽度,高度裁切</label>
                        <label><input type="radio" name="set[thumb_type]" value="4" <?php if($field['set']['thumb_type']=='4'){?>checked=""<?php }?>/>固定高度,宽度裁切</label>
                        <label><input type="radio" name="set[thumb_type]" value="5" <?php if($field['set']['thumb_type']=='5'){?>checked=""<?php }?>/>缩放最大边</label>
                        <label><input type="radio" name="set[thumb_type]" value="6" <?php if($field['set']['thumb_type']=='6'){?>checked=""<?php }?>/>自动裁切图片</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>