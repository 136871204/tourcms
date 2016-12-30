<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>线路分类管理</title>
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
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/Line/js/js.js"></script>
</head>
<body>
<div class="wrap">
    <div class="content-nr">
        <div class="web-set">
            <dl>
                <dd>
                    <?php $zh["list"]["lineKind"]["total"]=0;if(isset($lineKinds) && !empty($lineKinds)):$_id_lineKind=0;$_index_lineKind=0;$lastlineKind=min(1000,count($lineKinds));
$zh["list"]["lineKind"]["first"]=true;
$zh["list"]["lineKind"]["last"]=false;
$_total_lineKind=ceil($lastlineKind/1);$zh["list"]["lineKind"]["total"]=$_total_lineKind;
$_data_lineKind = array_slice($lineKinds,0,$lastlineKind);
if(count($_data_lineKind)==0):echo "";
else:
foreach($_data_lineKind as $key=>$lineKind):
if(($_id_lineKind)%1==0):$_id_lineKind++;else:$_id_lineKind++;continue;endif;
$zh["list"]["lineKind"]["index"]=++$_index_lineKind;
if($_index_lineKind>=$_total_lineKind):$zh["list"]["lineKind"]["last"]=true;endif;?>

                        <?php if($lineKind['name'] == $lineKinds['lineattr']['name']){?>
                            <a class="on" href="<?php echo $lineKind['url'];?>">
                        <?php  }else{ ?>
                            <a href="<?php echo $lineKind['url'];?>">
                        <?php }?>
                        <?php echo $lineKind['name'];?></a>
                    <?php $zh["list"]["lineKind"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
                </dd>
            </dl>
        </div>
    </div>
    <div class="menu_list" style="clear: both;">
        <ul>
            <li><a href="<?php echo U('attr',array('webid'=>$_GET['webid']));?>"><?php echo $currentKindName;?>列表</a></li>
            <li><a href="javascript:;" class="action">添加<?php echo $currentKindName;?></a></li>
        </ul>
    </div>
    <div class="title-header"><?php echo $currentKindName;?>信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'<?php echo U(attr,array('webid'=>$_GET['webid']));?>');">
        <input type="hidden" name="webid" value="<?php echo $_GET['webid'];?>"/>
        <table class="table1">

            <tr>
                <th class="w100">属性名称</th>
                <td>
                    <input type="text" name="attrname" class="w300" required=""/>
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
                <th class="w100">排序</th>
                <td>
                    <input type="text" name="displayorder" class="w50" value="9999" required=""/>
                </td>
            </tr>
            <tr>
                <th class="w100">显示</th>
                <td>
                    <input type="radio" name="isopen" value="1" checked="checked" /> 显示
                    <input type="radio" name="isopen" value="0"  /> 不显示
                </td>
            </tr>
            

        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>