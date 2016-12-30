<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/<?php echo $field_type;?>/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_treeselect_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100"><?php echo $language['admin_field_treeselect_item1']; ?></td>
                    <td><input type="text" name="set[table]" class="w100 textarea_width" value="<?php echo $field['set']['table'];?>"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_treeselect_item2']; ?></td>
                    <td><input type="text" name="set[title_field]" class="w100 textarea_width" value="<?php echo $field['set']['title_field'];?>"/></td>
                </tr>
                <tr>
                    <td class="w100"><?php echo $language['admin_field_treeselect_item3']; ?></td>
                    <td><input type="text" name="set[id_field]" class="w100 textarea_width" value="<?php echo $field['set']['id_field'];?>"/></td>
                </tr>
            </table>
        </td>
    </tr>
</table>