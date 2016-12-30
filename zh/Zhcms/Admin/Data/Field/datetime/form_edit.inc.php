<script type="text/javascript" src="<?php echo __TPL__;?>/Field/js/date.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400"><?php echo $language['admin_field_datetime_th']; ?></th>
        <td>
            <table class="table1">
                <tr>
                    <th class="w100"><?php echo $language['admin_field_datetime_item1']; ?></th>
                    <td>
                        <label><input type="radio" value="1" name="set[format]"  <?php if($field['set']['format']==1){?>checked="checked"<?php }?>/> <?php echo $language['admin_field_datetime_item1_option1']; ?><br/></label>
                        <label><input type="radio" value="0" name="set[format]"  <?php if($field['set']['format']=='0'){?>checked="checked"<?php }?>/> <?php echo $language['admin_field_datetime_item1_option2']; ?><br/></label>
                        <label><input type="radio" value="2" name="set[format]"  <?php if($field['set']['format']==2){?>checked="checked"<?php }?>/> <?php echo $language['admin_field_datetime_item1_option3']; ?></label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>