<script>
var admin_field_files_validate_js_message1='<?php echo $language['admin_field_files_validate_js_message1']; ?>';
var admin_field_files_validate_js_message2='<?php echo $language['admin_field_files_validate_js_message2']; ?>';
var admin_field_files_validate_js_message3='<?php echo $language['admin_field_files_validate_js_message3']; ?>';
var admin_field_files_validate_js_message4='<?php echo $language['admin_field_files_validate_js_message4']; ?>';
var admin_field_files_validate_js_message5='<?php echo $language['admin_field_files_validate_js_message5']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_files_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_files_item1']; ?></td>
                    <td>
                        <input type="text" class="w100" name="set[num]" value="10"/>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_files_item2']; ?></td>
                    <td>
                        <input type="text" class="w200" name="set[filetype]" value="zip,rar,doc,ppt"/>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>