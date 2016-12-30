<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title><?php echo L("admin_login_title");?></title>
    <script type='text/javascript' src='http://www.his.com/zh/ZHPHP/zhphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/css/zhjs.css' rel='stylesheet' media='screen'>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/zhjs.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/slide.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
HOST = '<?php echo $GLOBALS['user']['HOST'];?>';
ROOT = '<?php echo $GLOBALS['user']['ROOT'];?>';
WEB = '<?php echo $GLOBALS['user']['WEB'];?>';
URL = '<?php echo $GLOBALS['user']['URL'];?>';
ZHPHP = '<?php echo $GLOBALS['user']['ZHPHP'];?>';
ZHPHPDATA = '<?php echo $GLOBALS['user']['ZHPHPDATA'];?>';
ZHPHPTPL = '<?php echo $GLOBALS['user']['ZHPHPTPL'];?>';
ZHPHPEXTEND = '<?php echo $GLOBALS['user']['ZHPHPEXTEND'];?>';
APP = '<?php echo $GLOBALS['user']['APP'];?>';
CONTROL = '<?php echo $GLOBALS['user']['CONTROL'];?>';
METH = '<?php echo $GLOBALS['user']['METH'];?>';
GROUP = '<?php echo $GLOBALS['user']['GROUP'];?>';
TPL = '<?php echo $GLOBALS['user']['TPL'];?>';
CONTROLTPL = '<?php echo $GLOBALS['user']['CONTROLTPL'];?>';
STATIC = '<?php echo $GLOBALS['user']['STATIC'];?>';
PUBLIC = '<?php echo $GLOBALS['user']['PUBLIC'];?>';
HISTORY = '<?php echo $GLOBALS['user']['HISTORY'];?>';
TEMPLATE = '<?php echo $GLOBALS['user']['TEMPLATE'];?>';
ROOTURL = '<?php echo $GLOBALS['user']['ROOTURL'];?>';
WEBURL = '<?php echo $GLOBALS['user']['WEBURL'];?>';
CONTROLURL = '<?php echo $GLOBALS['user']['CONTROLURL'];?>';
PHPSELF = '<?php echo $GLOBALS['user']['PHPSELF'];?>';
</script>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/Login/css/css.css"/>
    <script>
        $(function () {
            var error = '<?php echo $error;?>';
            if (error) {
                $("div#error_tips").show();
                $(".err_m").html(error);
                setTimeout(function(){ $("div#error_tips").hide()},5000);
            }
        })
    </script>
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/Login/Js/js.js"></script>
</head>
<body>
<div class="header">
    <div class="links">
        <a href="http://www.his.com/index.php"><?php echo L("admin_login_top_link");?></a> 
    </div>
</div>
<div class="main">
    <div class="pics">
    </div>
    <div class="login">
        <div class="title">
            <?php echo L("admin_login_from_title");?>
        </div>
        
        <div id="tips" class="tips"></div>
        <div class="web_login">
            <div class="login_form">
                <div id="error_tips">
                    <span class="error_logo"></span>
                    <span class="err_m">12dssfd</span>
                </div>
                <form action="<?php echo U('login');?>" method="post" class="hd-form">
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="username" value="" autofocus='true' placeholder="<?php echo L("admin_login_from_id");?>"
                                   required="" AUTOCOMPLETE="off" />
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="password" name="password" placeholder="<?php echo L("admin_login_from_password");?>" required="" AUTOCOMPLETE="off" />
                        </div>
                    </div>
                    <div class="input">
                        <div class="inputOuter">
                            <input type="text" name="code" placeholder="<?php echo L("admin_login_from_code");?>" required=""/>
                        </div>
                    </div>

                    <div class="verifyimgArea">
                        <img src="<?php echo U('code');?>" class="code" style="cursor: pointer;float:left;"
                             onclick="this.src='<?php echo U('code');?>&'+Math.random()"/>
                        <a href="javascript:void(0);" onclick="$('.code').trigger('click')"><?php echo L("admin_login_from_tip");?></a>
                    </div>
                    <div class="send">
                        <input type="submit" class="btn2" value="<?php echo L("admin_login_from_submit");?>"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<iframe name="checkLogin" style="display:none;"></iframe>
</body>
</html>