<script>
var admin_field_number_validate_js_message1='<?php echo $language['admin_field_number_validate_js_message1']; ?>';
</script>
<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_number_th']; ?></th>
        <td>
            <table class="table1">
            	<tr>
                    <td><?php echo $language['admin_field_number_item1']; ?></td>
                    <td>
                    	<label><input type="radio" name="set[field_type]" value="smallint"/> smallint</label>
                    	<label><input type="radio" name="set[field_type]" value="int" checked=""/> int</label>
                    	<label><input type="radio" name="set[field_type]" value="mediumint"/> mediumint</label>
                    	<label><input type="radio" name="set[field_type]" value="decimal"/> decimal</label>
                    </td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item2']; ?></td>
                    <td><input type="text"  name="set[num_integer]" class="w100 num_integer" value="6"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item3']; ?></td>
                    <td><input type="text"   name="set[num_decimal]" class="w100 num_decimal" value="2"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_number_item4']; ?></td>
                    <td><input type="text"   name="set[size]" class="w100 num_size" value="300"/></td>
                </tr>
                <tr>
                    <td><?php echo $language['admin_field_number_item5']; ?></td>
                    <td><input type="text" name="set[default]" class="w200"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>