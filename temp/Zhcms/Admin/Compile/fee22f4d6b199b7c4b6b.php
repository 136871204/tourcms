<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>出发地</title>
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
    <script type="text/javascript" src="http://www.his.com/Static/js/utils.js"></script>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="<?php echo U('index');?>">出发地列表</a></li>
            <li><a href="javascript:;" class="action">添加出发地</a></li>
        </ul>
    </div>
    <div class="title-header">出发地情报</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'<?php echo U(index);?>');">
        <table class="table1">
            <tr>
                <th class="w100">出发地:</th>
                <td>
                    <input type="text" name="cityname" class="w300" required="" value="<?php echo htmlspecialchars($info['cityname']);?>"/>
                </td>
            </tr>
            <tr>
                <th class="w100">上级分类:</th>
                <td>
                    <select name="pid">
                        <option value="0">顶级分类</option>
                        <?php echo $select;?>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="w100">排序:</th>
                <td>
                    <input type="text" name='displayorder' <?php if($info['displayorder']){?> value='<?php echo $info['displayorder'];?>' <?php  }else{ ?> value="9999" <?php }?>  class="w300" />
                </td>
            </tr>
            <tr>
                <th class="w100">是否开启:</th>
                <td>
                    <input type="radio" name="isopen" value="1" <?php if($info['isopen'] <> 0){?> checked="true" <?php }?>/> 是
                    <input type="radio" name="isopen" value="0" <?php if($info['isopen'] == 0){?> checked="true" <?php }?> /> 否
                </td>
            </tr>
            
        
        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
    <div class="h60"></div>
</div>
<script>


</script>
</body>
</html>