<script>
var admin_field_input_validate_js_message1='<?php echo $language['admin_field_input_validate_js_message1']; ?>';
var admin_field_input_validate_js_message2='<?php echo $language['admin_field_input_validate_js_message2']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>

<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_input_add_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_input_add_item1']; ?></td>
                    <td><input type="text" name="set[size]" class="w100 input_size" value="300"/> px</td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_input_add_item2']; ?></td>
                    <td><input type="text" name="set[default]" class="w200"/></td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_input_add_item3']; ?></td>
                    <td>
                        <label><input type="radio" name="set[ispasswd]" value="0" checked="checked"/> NO</label>
                        <label><input type="radio" name="set[ispasswd]" value="1"/> YES</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>

























