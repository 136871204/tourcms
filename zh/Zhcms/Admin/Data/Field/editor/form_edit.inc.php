<script>
var admin_field_editor_validate_js_message1='<?php echo $language['admin_field_editor_validate_js_message1']; ?>';
var admin_field_editor_validate_js_message2='<?php echo $language['admin_field_editor_validate_js_message2']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/editor/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_editor_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w60"><?php echo $language['admin_field_editor_item1']; ?></td>
                    <td><input type="text" name="set[height]" class="w100 editor_height" value="<?php echo $field['set']['height'];?>" class="w100"/> px</td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_editor_item2']; ?></td>
                    <td><textarea class="w300 h60" name="set[default]"><?php echo $field['set']['default'];?></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>