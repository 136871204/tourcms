<!DOCTYPE html>
<html>
<head>
    <title>資料修正</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <jcrop/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/user.css?ver=1.0"/>
    <js file="__CONTROL_TPL__/js/cropFace.js"/>
    <script type="text/javascript" src="__CONTROL_TPL__/uploadify/jquery.uploadify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/uploadify/uploadify.css"/>
    <zhcms/>
</head>
<body>
<load file="__TPL__/Public/block/top_menu.php"/>
<article class="center-block main">
<!--左侧导航start-->
<load file="__TPL__/Public/block/left_menu.php"/>
<!--左侧导航end-->
<section class="edit-user">
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#edit-base" data-toggle="tab">基本情報</a></li>
            <li><a href="#edit-password" data-toggle="tab">パスワード修正</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="edit-base">
                <form id="form_message" action="{|U:'edit_message'}" method="post"
                      onsubmit="return zh_submit(this,'{|U:'edit'}')">
                    <table>
                        <tr>
                            <th>
                                <img src="{$zh.session.icon150}" class="face"/>
                            </th>
                            <td class="field" colspan="2">
                                <textarea name="signature" style="height: 100px;" placeholder="サインを入力">{$field.signature}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>個性ドメイン</th>
                            <td class="field">
                                __ROOT__?<input type="text" name="domain" value="{$field.domain}"/>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="field">
                                <input type="submit" class="btn btn-primary" value="確認"/>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            
            <div class="tab-pane" id="edit-password">
                <form id="form_password" action="{|U:'edit_password'}" onsubmit="return zh_submit(this)">
                    <table>
                        <tr>
                            <th class="w200">今のパスワード</th>
                            <td class="field">
                                <input type="password" name="oldpassword"/>
                            </td>
                            <td class="w200">
                                <span id="zh_oldpassword"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>新しいパスワード</th>
                            <td class="field">
                                <input type="password" name="password"/>
                            </td>
                            <td>
                                <span id="zh_password"></span>
                            </td>
                        </tr>
                        <tr>
                            <th>パスワード再確認</th>
                            <td class="field">
                                <input type="password" name="passwordc"/>
                            </td>
                            <td>
                                <span id="zh_passwordc"></span>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="field">
                                <input type="submit" class="btn btn-primary" value="確認"/>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                </form>
                <script>
                    $("#form_message").validate({
                        domain: {
                            rule: {
                                required: true,
                                regexp:/[a-z0-9]/i,
                                ajax: CONTROL + '&m=check_domain'
                            },
                            error: {
                                required: "必須",
                                regexp:'アルファベットと数値で入力してください',
                                ajax: '個性ドメインはすでに使われている'
                            },
                            success: '入力正しい',
                            message:'アルファベット　或いは　数値で入力'
                        }
                    });
                    $("#form_password").validate({
                        oldpassword: {
                            rule: {
                                required:true,
                                ajax: CONTROL + '&m=check_password'
                            },
                            error: {
                                required:'必須',
                                ajax: '今のパスワードは正しくない'
                            },
                            success: '入力正しい'
                        },
                        password: {
                            rule: {
                                required:true,
                            },
                            error: {
                                required:'必須',
                            },
                            success: '入力正しい'
                        },
                        passwordc: {
                            rule: {
                                confirm: 'password'
                            },
                            error: {
                                confirm: '二回入力したパスワードは不一致'
                            }
                        }
                    })
                </script>
            </div>
        </div>
    </div>
</section>
</article>
<load file="__TPL__/Public/block/footer.php"/>
</body>
</html>