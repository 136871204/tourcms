<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>b2b用户添加画面</title>
    <zhjs/>
    <style>
    .b2buser{
        margin:20px 0 0 10px; font-weight: bold;
    }
    </style>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">b2b用户一览</a></li>
            <li><a href="javascript:;" class="action">添加b2b用户</a></li>
        </ul>
    </div>
    <div class="title-header">{$zh.language.admin_administrator_add_page_table_header}</div>
    <form action="{|U:'add'}" method="post" class="form-inline zh-form" onsubmit="return zh_submit(this,'__CONTROL__')">
        <div class="title b2buser">公司信息</div>
        <table class="table1">
            <tr>
                <th class="w100">省份</th>
                <td>
                    <input type="text" class="w200" name="province" />
                </td>
                <th class="w100">全称</th>
                <td>
                    <input type="text" class="w200" name="fullname" />
                </td>
            </tr>
            <tr>
                <th class="w100">地区</th>
                <td>
                    <input type="text" class="w200" name="addr" />
                </td>
                <th class="w100">简称</th>
                <td>
                    <input type="text" class="w200" name="simplename" />
                </td>
            </tr>
        </table>
        
        <div class="title b2buser">基本资料</div>
        <table class="table1">
            <tr>
                <th class="w100">b2b用户名：</th>
                <td>
                    <input type="text" name="b2busername" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">b2b密码：</th>
                <td>
                    <input type="password" name="b2bpassword" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">确定密码：</th>
                <td>
                    <input type="password" name="c_b2bpassword" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">法人代表：</th>
                <td>
                    <input type="text" name="legalrepresentative" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">姓名：</th>
                <td>
                    <input type="text" name="name" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">昵称：</th>
                <td>
                    <input type="text" name="nickname" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">性别：</th>
                <td>
                    <label><input type="radio" name="gender" value="1" checked="" />男</label>
                    <label><input type="radio" name="gender" value="2" />女</label>
                </td>
            </tr>
            <tr>
                <th class="w100">部门：</th>
                <td>
                    <input type="text" name="department" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">职位：</th>
                <td>
                    <input type="text" name="position" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">手机：</th>
                <td>
                    <input type="text" name="mobile" class="w200"/>&nbsp;手机号很重要，方便客服与您沟通联系！
                </td>
            </tr>
            <tr>
                <th class="w100">办公电话：</th>
                <td>
                    <input type="text" name="tel" class="w200"/>&nbsp;当业务繁忙时，固定电话或许能让我们更及时联系您！
                </td>
            </tr>
            <tr>
                <th class="w100">传真：</th>
                <td>
                    <input type="text" name="fax" class="w200"/>
                </td>
            </tr>
            <tr>
                <th class="w100">QQ号码：</th>
                <td>
                    <input type="text" name="qq" class="w200"/>&nbsp;当行程或签证所需材料变动时，QQ“飞鸽传输”相当重要！
                </td>
            </tr>
            <tr>
                <th class="w100">电子邮件：</th>
                <td>
                    <input type="text" name="email" class="w200" value=""/>&nbsp;当您出差或不方便记录时，Email会更高效的发挥作用！
                </td>
            </tr>
            <tr>
                <th class="w100">财务电话：</th>
                <td>
                    <input type="text" name="financetel" class="w200" value=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">备注：</th>
                <td>
                    <textarea name="remark"></textarea>
                </td>
            </tr>
        </table>
        <br /><br /><br /><br />
        <div class="position-bottom">
            <input type="submit" class="zh-success" value="确认"/>
            <input type="button" class="zh-cancel" value="取消" onclick="location.href='__CONTROL__'"/>
        </div>
    </form>
</div>
<script type="text/javascript" charset="utf-8">
	$("form").validate({
        //验证规则
        b2busername: {
            rule: {
                required: true,
                ajax: {url: CONTROL + '&m=check_username', field: ['b2bid']}
            },
            error: {
                required: "b2b用户名不能为空",
                ajax: '此用户名已被占用'
            }
        },
        b2bpassword: {
            rule: {
                required: true,
                regexp: /^\w{5,}$/
            },
            error: {
                required: "b2b密码不能为空",
                regexp: "密码不得少于5位数"
            }
        },
        c_b2bpassword: {
            rule: {
                required: true,
                confirm: "b2bpassword"
            },
            error: {
                required: "确定密码不能为空",
                confirm: "两次密码不一致"
            }
        },
        email: {
            rule: {
                email: true,
                ajax: {url: CONTROL + '&m=check_email'}
            },
            error: {
                email: "请输入正确的邮箱地址",
                ajax: '此邮箱已被占用'
            }

        }
    })
</script>
</body>
</html>