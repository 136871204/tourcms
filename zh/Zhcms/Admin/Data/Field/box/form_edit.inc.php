<script>
var admin_field_box_validate_js_message1='<?php echo $language['admin_field_box_validate_js_message1']; ?>';
var admin_field_box_validate_js_message2='<?php echo $language['admin_field_box_validate_js_message2']; ?>';
var admin_field_box_validate_js_message3='<?php echo $language['admin_field_box_validate_js_message3']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/box/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_box_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_box_item1']; ?></td>
                    <td>
                        <textarea name="set[options]" class="w300 h100"><?php echo $field['set']['options'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_box_item2']; ?></td>
                    <td>
                    	<label><input type="radio" name="set[form_type]" value="radio" <?php if($field['set']['form_type']=='radio'){?>checked=""<?php }?>/> <?php echo $language['admin_field_box_item2_option1']; ?></label>
                        <label><input type="radio" name="set[form_type]" value="checkbox" <?php if($field['set']['form_type']=='checkbox'){?>checked=""<?php }?>/> <?php echo $language['admin_field_box_item2_option2']; ?></label>
                        <label><input type="radio" name="set[form_type]" value="select" <?php if($field['set']['form_type']=='select'){?>checked=""<?php }?>/> <?php echo $language['admin_field_box_item2_option3']; ?></label>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_box_item3']; ?></td>
                    <td><input type="text" name="set[default]" class="w100 select_default" value="<?php echo $field['set']['default'];?>"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>