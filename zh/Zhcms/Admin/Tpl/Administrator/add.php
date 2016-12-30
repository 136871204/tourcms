<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_administrator_add_page_title}</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">{$zh.language.admin_administrator_add_page_tab1}</a></li>
            <li><a href="javascript:;" class="action">{$zh.language.admin_administrator_add_page_tab2}</a></li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_administrator_add_page_table_header}</div>
    <form action="{|U:'add'}" method="post" class="form-inline zh-form" onsubmit="return zh_submit(this,'__CONTROL__')">
        <input type="hidden" name="admin" value="1"/>
        <table class="table1">
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item1}</th>
                <td>
                    <input type="text" name="username" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item2}</th>
                <td>
                    <select name="rid">
                        <list from="$role" name="r">
                            <option value="{$r.rid}">{$r.rname}</option>
                        </list>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item3}</th>
                <td>
                    <input type="password" name="password" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item4}</th>
                <td>
                    <input type="password" name="c_password" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item5}</th>
                <td>
                    <input type="text" name="email" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item6}</th>
                <td>
                    <input type="text" name="credits" class="w200" value="{$zh.config.init_credits}"/>
                </td>
            </tr>
            <tr>
                <th class="w100">{$zh.language.admin_administrator_add_page_table_item7}</th>
                <td>
                    <select name="language">
                        <foreach from="$selectlan" value="$lanv" key="$lank" >
                            <option value="{$lank}">
                            {$lanv}
                            </option>
                        </foreach>
                    </select>
                </td>
            </tr>
        </table>
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="{$zh.language.admin_administrator_add_page_form_submit}"/>
            <input type="button" class="zh-cancel" value="{$zh.language.admin_administrator_add_page_form_cancel}" onclick="location.href='__CONTROL__'"/>
        </div>
    </form>
</div>
<script type="text/javascript" charset="utf-8">
	$("form").validate({
        //验证规则
        username: {
            rule: {
                required: true,
                ajax: {url: CONTROL + '&m=check_username', field: ['uid']}
            },
            error: {
                required: "{$zh.language.admin_administrator_add_page_js_check_error1}",
                ajax: '{$zh.language.admin_administrator_add_page_js_check_error2}'
            }
        },
        email: {
            rule: {
                required: true,
                email: true
            },
            error: {
                required: '{$zh.language.admin_administrator_add_page_js_check_error3}',
                email: "{$zh.language.admin_administrator_add_page_js_check_error4}"
            }

        },
        password: {
            rule: {
                required: true,
                regexp: /^\w{5,}$/
            },
            error: {
                required: "{$zh.language.admin_administrator_add_page_js_check_error6}",
                regexp: "{$zh.language.admin_administrator_add_page_js_check_error7}"
            }
        },
        c_password: {
            rule: {
                required: true,
                confirm: "password"
            },
            error: {
                required: "{$zh.language.admin_administrator_add_page_js_check_error8}",
                confirm: "{$zh.language.admin_administrator_add_page_js_check_error9}"
            }
        },
        credits: {
            rule: {
                required: true,
                regexp: /^\d+$/
            },
            error: {
                required: "{$zh.language.admin_administrator_add_page_js_check_error10}",
                regexp: "{$zh.language.admin_administrator_add_page_js_check_error11}"
            }
        }
    })
</script>
</body>
</html>