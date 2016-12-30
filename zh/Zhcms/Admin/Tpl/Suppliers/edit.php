<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>编辑供货商</title>
    <zhjs/>

</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">供货商列表</a></li>
            <li><a href="javascript:;" class="action">编辑供货商</a></li>
        </ul>
    </div>
    <div class="title-header">供货商信息</div>
    <form action="{|U:'edit'}" method="post" class="zh-form"  onsubmit="return zh_submit(this,'{|U:index}')">
        <input type="hidden" name="id" value="{$suppliers.suppliers_id}" />
        <table class="table1">
            <tr>
                <th class="w100">供货商名称</th>
                <td>
                    <input type="text" name="suppliers_name" class="w300" maxlength="60" value="{$suppliers.suppliers_name}" />
                </td>
            </tr>
            <tr>
                <th class="w100">供货商描述</th>
                <td>
                    <textarea  name="suppliers_desc" cols="60" rows="4"  >{$suppliers.suppliers_desc}</textarea>

                </td>
            </tr>
            <tr>
                <th class="w100">负责该供货商的管理员：</th>
                <td>
                    <list from="$suppliers.admin_list" name="admin">
                        <input type="checkbox" name="admins[]" value="{$admin.uid}" <if value='$admin.type eq "this" '> checked="checked"</if>  />
                        {$admin.username}
                        <if value='$admin.type eq "other" '> 
                        (*)
                        </if>
                    </list>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="确认"/>
        </div>
    </form>
</div>
</body>
</html>