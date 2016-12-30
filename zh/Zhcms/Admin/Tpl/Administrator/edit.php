<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_administrator_edit_page_title}</title>
    <zhjs/>
    
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">{$zh.language.admin_administrator_edit_page_tab1}</a></li>
            <li><a href="javascript:;" class="action">{$zh.language.admin_administrator_edit_page_tab2}</a></li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_administrator_edit_page_table_header}</div>
    <form action="{|U:'edit'}" method="post" class="form-inline zh-form" onsubmit ="return zh_submit(this,'__CONTROL__')">
        <input type="hidden" name="uid" value="{$field.uid}"/>
        <table class="table1">
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item1}</th>
                <td>
                    {$field.username}
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item2}</th>
                <td>
                    <select name="rid">
                        <list from="$role" name="r">
                            <option value="{$r.rid}" <if value="$field.rid eq $r.rid">selected="selected"</if>>{$r.rname}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item3}</th>
                <td>
                    <input type="password" name="password" class="w200" value=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item4}</th>
                <td>
                    <input type="password" name="c_password" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item5}</th>
                <td>
                    <input type="text" name="email" value="{$field.email}" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item6}</th>
                <td>
                    <input type="text" name="credits" class="w200" value="{$field.credits}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_edit_page_table_item7}</th>
                <td>
                    <select name="language">
                        <foreach from="$selectlan" value="$lanv" key="$lank" >
                            <option value="{$lank}"
                            <if value="$field.language eq $lank">selected="selected"</if>
                            >
                            {$lanv}
                            </option>
                        </foreach>
                    </select>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="{$zh.language.admin_administrator_edit_page_form_submit}"/>
            <input type="button" class="zh-cancel" value="{$zh.language.admin_administrator_edit_page_form_cancel}" onclick="location.href='__CONTROL__'"/>
        </div>
    </form>
</div>
<script type="text/javascript" charset="utf-8">
    	$(function () {
    $("form").validate({
        email: {
            rule: {
                required: true,
                email: true
            },
            error: {
                required: '{$zh.language.admin_administrator_edit_page_js_check_error1}',
                email: "{$zh.language.admin_administrator_edit_page_js_check_error2}"
            }

        },
        password: {
            rule: {
                regexp: /^\w{5,}$/
            },
            error: {
                regexp: "{$zh.language.admin_administrator_edit_page_js_check_error4}"
            }
        },
        c_password: {
            rule: {
                confirm: "password"
            },
            error: {
                confirm: "{$zh.language.admin_administrator_edit_page_js_check_error5}"
            }
        },
        credits: {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: "{$zh.language.admin_administrator_edit_page_js_check_error6}",
                regexp: "{$zh.language.admin_administrator_edit_page_js_check_error7}"
            }
        }

    })
})
    </script>
</body>
</html>