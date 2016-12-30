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
    <style>
    .wrap td.first-cell {
        font-weight: bold;
        padding-left: 10px;
    }
    </style>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">出发地列表</a></li>
            <li><a href="<?php echo U('add');?>">出发地添加</a></li>
        </ul>
    </div>
    <table class="table2 zh-form"  id="list-table">
        <thead>
        <tr >
            <td >出发地</td>
            <td>是否开启</td>
            <td >排序</td>
            <td>操作</td>
        </tr>
        </thead>
        <?php $zh["list"]["info"]["total"]=0;if(isset($list_info) && !empty($list_info)):$_id_info=0;$_index_info=0;$lastinfo=min(1000,count($list_info));
$zh["list"]["info"]["first"]=true;
$zh["list"]["info"]["last"]=false;
$_total_info=ceil($lastinfo/1);$zh["list"]["info"]["total"]=$_total_info;
$_data_info = array_slice($list_info,0,$lastinfo);
if(count($_data_info)==0):echo "";
else:
foreach($_data_info as $key=>$info):
if(($_id_info)%1==0):$_id_info++;else:$_id_info++;continue;endif;
$zh["list"]["info"]["index"]=++$_index_info;
if($_index_info>=$_total_info):$zh["list"]["info"]["last"]=true;endif;?>

            <tr  align="center" class="<?php echo $info['level'];?>" id="<?php echo $info['level'];?>_<?php echo $info['id'];?>" >
                <td  align="left" class="first-cell" >
                <?php if($info['is_leaf'] <> 1){?>
                    <img src="http://www.his.com/Static/image/menu_minus.gif" id="icon_<?php echo $info['level'];?>_<?php echo $info['id'];?>" width="9" height="9" border="0" style="margin-left:<?php echo $info['level'];?>em" onclick="rowClicked(this)" />
                <?php  }else{ ?>
                    <img src="http://www.his.com/Static/image/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:<?php echo $info['level'];?>em" />
                <?php }?>
                <?php echo $info['cityname'];?>
                </td>
                <td >
                    <?php if($info['isopen'] == 1){?>
                        <img src="http://www.his.com/Static/image/yes.gif" />
                    <?php  }else{ ?>
                        <img src="http://www.his.com/Static/image/no.gif" />
                    <?php }?>
                </td>
                <td ><?php echo $info['displayorder'];?></td>
                <td style="text-align: right;"  >
                    <?php if($info['level'] <> 1){?>
                    <a href="<?php echo U('add',array('pid'=>$info['id']));?>">
						添加子目的地
				    </a>|
                    <?php }?>
                    
                    <a href="<?php echo U('edit',array('id'=>$info['id']));?>">
				        修改
				    </a>|
                    <a href="javascript:if(confirm('确定删除吗？'))zh_ajax('<?php echo U(del);?>',{id:<?php echo $info['id'];?>})">
				        删除
				    </a>
                </td>
            </tr>
        <?php $zh["list"]["info"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
    </table>
    <div class="h60"></div>
</div>
<script>


var imgPlus = new Image();
imgPlus.src = "http://www.his.com/Static/image/menu_plus.gif";
/**
 * 折叠分类列表
 */
function rowClicked(obj)
{
    // 当前图像
    img = obj;
    // 取得上二级tr>td>img对象
    obj = obj.parentNode.parentNode;
    // 整个分类列表表格
    var tbl = document.getElementById("list-table");
    // 当前分类级别
    var lvl = parseInt(obj.className);
    // 是否找到元素
    var fnd = false;
    var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;
    // 遍历所有的分类
    for (i = 0; i < tbl.rows.length; i++){
        var row = tbl.rows[i];
        if (row == obj)
        {
            // 找到当前行
            fnd = true;
            //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
        }
        else
        {
            if (fnd == true)
            {
                var cur = parseInt(row.className);
                var icon = 'icon_' + row.id;
                if (cur > lvl)
                {
                    row.style.display = sub_display;
                    if (sub_display != 'none')
                    {
                        var iconimg = document.getElementById(icon);
                        iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                    } 
                }
                else
                {
                    fnd = false;
                    break;
                }
            }
        }
    }
    for (i = 0; i < obj.cells[0].childNodes.length; i++)
    {
        var imgObj = obj.cells[0].childNodes[i];
        if (imgObj.tagName == "IMG" && imgObj.src != 'http://www.his.com/Static/image/menu_arrow.gif')
        {
            imgObj.src = (imgObj.src == imgPlus.src) ? 'http://www.his.com/Static/image/menu_minus.gif' : imgPlus.src;
        }
    }
}
</script>
</body>
</html>