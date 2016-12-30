<script>
var admin_field_number_validate_js_message1='<?php echo $language['admin_field_number_validate_js_message1']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/number/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_number_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item2']; ?></td>
                    <td><input type="text" name="set[num_integer]"  class="w100 num_integer" value="<?php echo $field['set']['num_integer'];?>"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item3']; ?></td>
                    <td><input type="text" name="set[num_decimal]" class="w100 num_decimal" value="<?php echo $field['set']['num_decimal'];?>"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item4']; ?></td>
                    <td><input type="text" name="set[size]" class="w100 num_size" value="<?php echo $field['set']['size'];?>"/> px</td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_number_item5']; ?></td>
                    <td><input type="text" name="set[default]" class="w200" value="<?php echo $field['set']['default'];?>"/></td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>