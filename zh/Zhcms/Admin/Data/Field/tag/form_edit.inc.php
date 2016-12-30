<script type="text/javascript" src="<?php echo __ROOT__;?>/zh/Zhcms/Admin/Data/Field/tag/validate.js"></script>
<table class="table1">
    <tr class="input action">
        <th class="w400">パラメータ</th>
        <td>
            <table class="table1">
                <tr>
                    <td class="w100">表示の長さ</td>
                    <td><input type="text" name="set[size]" class="w100 input_size" value="<?php echo $field['set']['size'];?>"/> px</td>
                </tr>
                <tr>
                    <td>デフォルトの値</td>
                    <td><input type="text" name="set[default]" class="w200" value="<?php echo $field['set']['default'];?>"/></td>
                </tr>
                <tr>
                    <td>パスワードかどうか</td>
                    <td>
                        <label><input type="radio" name="set[ispasswd]" value="1" <?php if($field['set']['ispasswd'] == 1){?>checked=""<?php }?>/> YES</label>
                        <label><input type="radio" name="set[ispasswd]" value="0" <?php if($field['set']['ispasswd'] == 0){?>checked=""<?php }?>/> NO</label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    
</table>