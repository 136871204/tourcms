<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_exterior_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item1']; ?></td>
                    <td><input type="text" name="set[table]" class="w100 textarea_width" /></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item2']; ?></td>
                    <td><input type="text" name="set[pk]" class="w100 textarea_width" /></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item3']; ?></td>
                    <td><input type="text" name="set[showf]" class="w100 textarea_width" /></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item4']; ?></td>
                    <td><input type="text" name="set[showt]" class="w100 textarea_width" /></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item5']; ?></td>
                    <td><input type="text" name="set[wherestr]" class="w100 textarea_width" /></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_exterior_item6']; ?></td>
                    <td>
                        <label><input type="radio" name="set[select_type]" value="multiple" checked="checked"/> <?php echo $language['admin_field_exterior_item6_option1']; ?></label>
                        <label><input type="radio" name="set[select_type]" value="single"/><?php echo $language['admin_field_exterior_item6_option2']; ?></label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>