<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_login_title}</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <script>
        $(function () {
            var error = '{$error}';
            if (error) {
                $("div#error_tips").show();
                $(".err_m").html(error);
                setTimeout(function(){ $("div#error_tips").hide()},5000);
            }
        })
    </script>
    <js file="__CONTROL_TPL__/Js/js.js"/>
</head>
<body>
<div class="header">
    <div class="links">
        <a href="__WEB__">{$zh.language.admin_login_top_link}</a> 
    </div>
</div>
<div class="main">
    <div class="pics">
    </div>
    <div class="login">
        <div class="title">
            {$zh.language.admin_login_from_title}
        </div>
        
        <div id="tips" class="tips"></div>
        <div class="web_login">
            <div class="login_form">
                <div id="error_tips">
                    <span class="error_logo"></span>
                    <span class="err_m">12dssfd</span>
                </div>
                <form action="{|U:'login'}" method="post" class="hd-form">
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="username" value="" autofocus='true' placeholder="{$zh.language.admin_login_from_id}"
                                   required="" AUTOCOMPLETE="off" />
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="password" name="password" placeholder="{$zh.language.admin_login_from_password}" required="" AUTOCOMPLETE="off" />
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="code" placeholder="{$zh.language.admin_login_from_code}" required=""/>
                        </div>
                    </div>

                    <div class="verifyimgArea">
                        <img src="{|U:'code'}" class="code" style="cursor: pointer;float:left;"
                             onclick="this.src='{|U:'code'}&'+Math.random()"/>
                        <a href="javascript:void(0);" onclick="$('.code').trigger('click')">{$zh.language.admin_login_from_tip}</a>
                    </div>
                    <div class="send">
                        <input type="submit" class="btn2" value="{$zh.language.admin_login_from_submit}"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<iframe name="checkLogin" style="display:none;"></iframe>
</body>
</html>