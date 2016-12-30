<script>
var admin_field_textarea_validate_js_message1='<?php echo $language['admin_field_textarea_validate_js_message1']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_textarea_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_textarea_item1']; ?></td>
                    <td><input type="text" name="set[width]" class="w100 textarea_width" value="500"/> </td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_textarea_item2']; ?></td>
                    <td><input type="text" name="set[height]" class="w100 textarea_height" value="100"/> </td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_textarea_item3']; ?></td>
                    <td><textarea class="w300 h60" name="set[default]"></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>