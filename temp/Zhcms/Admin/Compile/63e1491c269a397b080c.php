<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>预览画面</title>
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
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/TourOrder/js/js.js"></script>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/TourOrder/css/css.css"/>
    
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/common.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.hotkeys.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/msgbox/msgbox.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/extjs/ext-all.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/extjs/locale/ext-lang-zh_CN.js"></script>
    <link type="text/css" href="http://www.his.com/Static/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="http://www.his.com/Static/tour/css/common.css" rel="stylesheet"/>
     <link type="text/css" href="http://www.his.com/Static/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="http://www.his.com/Static/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>
    <script>
    window.SITEURL =  "http://www.his.com/index.php";
    window.PUBLICURL ="/newtravel/public/";
    window.WEBLIST =  <?php echo json_encode(array_merge(TourCommon::getWebList())); ?> 
    $(function(){
        $.hotkeys.add('f', function(){parent.window.showIndex(); });
    })
    </script>
    
    <link type="text/css" href="http://www.his.com/Static/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/plist.css" rel="stylesheet"/>   
    <link type="text/css" href="http://www.his.com/Static/tour/css/order.css" rel="stylesheet"/>
    

</head>
<body  style="background-color: #fff">
    <style>
        .out-box-con .list_dl dt {
            text-align: left;
        }
    </style>
 <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd><?php echo $lists["status"][$info['status']]?></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">备注：</dt>
            <dd style="height: auto"><?php echo nl2br($info['admin_note']);?></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">产品名称：</dt>
            <dd>
                 <?php echo $info['productname'];?>
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">出发日期：</dt>
            <dd><?php echo $info['usedate'];?></dd>
        </dl>
        <?php if($info['dingnum'] > 0){?>
        <dl class="list_dl">
            <dt class="wid_90">人数(成人)：</dt>
            <dd><?php echo $info['dingnum'];?></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">价格(成人)：</dt>
            <dd><?php echo $info['price'];?></dd>
        </dl>
        <?php }?>
        
        <?php if($info['childnum'] > 0){?>
            <dl class="list_dl">
                <dt class="wid_90">儿童数量：</dt>
                <dd><?php echo $info['childnum'];?></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">儿童价格：</dt>
                <dd><?php echo $info['childprice'];?></dd>
            </dl>
        <?php }?>
        
        <?php if($info['oldnum'] > 0){?>
            <dl class="list_dl">
                <dt class="wid_90">婴儿数量：</dt>
                <dd><?php echo $info['oldnum'];?></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">婴儿价格：</dt>
                <dd><?php echo $info['oldprice'];?></dd>
            </dl>
        <?php }?>

        <dl class="list_dl">
            <dt class="wid_90">联系人姓名：</dt>
            <dd><?php echo $info['linkman'];?></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系人性别：</dt>
            <dd><?php if($info['linksex']=='1'){?>男<?php  }else{ ?>女<?php }?></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd><?php echo $info['linktel'];?></dd>
        </dl>
        <?php if(isset($tourer)){?>
            <?php if(is_array($tourer)):?><?php $index=0; ?><?php  foreach($tourer as $r){ ?>
        <dl class="list_dl">
            <dt class="wid_90"><?php if($r['ptype']=='1'){?>成人<?php  }elseif($r['ptype']=='2'){ ?>儿童<?php  }elseif($r['ptype']=='3'){ ?>婴儿<?php }?>游客<?php echo $n;?>：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名：<?php echo $r['tourername'];?></li>
                    <li>性别：<?php if($info['sex']=='1'){?>男<?php  }else{ ?>女<?php }?></li>
                    <li>姓名拼音：<?php echo $r['fnamealp'];?>-<?php echo $r["lnamealp"];?></li>
                    <?php if($r['birthdayy']){?><li>出生日期：<?php echo $r['birthdayy'];?>-<?php echo $r['birthdaym'];?>-<?php echo $r['birthdayd'];?></li><?php }?>
                    <?php if($r['passbook']){?><li>护照号：<?php echo $r['passbook'];?></li><?php }?>
                    <?php if($r['effectivey']){?><li>护照有效期：<?php echo $r['effectivey'];?>-<?php echo $r['effectivem'];?>-<?php echo $r['effectived'];?></li><?php }?>
                </ul>

            </dd>
        </dl>
            <?php $index++; ?><?php }?><?php endif;?>
        <?php }?>
        <dl class="list_dl">
            <dt class="wid_90">留言：</dt>
            <dd style="height: auto"><?php echo nl2br($info['remark']);?></dd>
        </dl>
    </div>
   </form>
   
   
   <a href="javascript:window.print();" target="_self" class="zh-success">打印</a>
   
</body>
</html>