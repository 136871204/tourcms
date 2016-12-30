<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title><?php echo L("admin_index_index_page_title");?></title>
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
		<script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/Index/js/menu.js"></script>
		<script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/Index/js/quick_menu.js"></script>
		<link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/Index/css/css.css"/>
		<link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/Index/css/quick_menu.css"/>
	</head>
    <body>
        <div class="nav">
            <!--头部左侧导航-->
			<div class="top_menu">
                <?php $zh["list"]["m"]["total"]=0;if(isset($top_menu) && !empty($top_menu)):$_id_m=0;$_index_m=0;$lastm=min(1000,count($top_menu));
$zh["list"]["m"]["first"]=true;
$zh["list"]["m"]["last"]=false;
$_total_m=ceil($lastm/1);$zh["list"]["m"]["total"]=$_total_m;
$_data_m = array_slice($top_menu,0,$lastm);
if(count($_data_m)==0):echo "";
else:
foreach($_data_m as $key=>$m):
if(($_id_m)%1==0):$_id_m++;else:$_id_m++;continue;endif;
$zh["list"]["m"]["index"]=++$_index_m;
if($_index_m>=$_total_m):$zh["list"]["m"]["last"]=true;endif;?>

                    <a href="javascript:" nid="<?php echo $m['nid'];?>" onclick="get_left_menu(<?php echo $m['nid'];?>);" class="top_menu">
						<?php echo $m['title'];?>
					</a>
                <?php $zh["list"]["m"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
            </div>
            <!--头部左侧导航-->
			<!--头部右侧导航-->
            <div class="r_menu">
                <?php echo $_SESSION['rname'];?> : <?php echo $_SESSION['nickname'];?>
                <a href="<?php echo U('Login/out');?>" target="_self">
					[<?php echo L("admin_index_index_page_logout");?>]
				</a>
                <span>|</span>
                <a href="http://www.his.com/index.php" target="_blank">
					<?php echo L("admin_index_index_page_top_link");?>
				</a>
                <span>|</span>
                <a nid="999" href="javascript:;" onclick="get_content(this,999)" url="<?php echo U('Cache/index',array('begin'=>1));?>">
					<?php echo L("admin_index_index_page_cache_link");?>
				</a>
				
                
            </div>
            <!--头部右侧导航-->
        </div>
        <!--左侧导航-->
		<div class="main">
            <!--主体左侧导航-->
			<div class="left_menu"></div>
            <!--主体左侧导航-->
			<!--内容显示区域-->
			<div class="menu_nav">
                <div class="direction">
					<a href="#" class="left">
						<?php echo L("admin_index_index_page_left");?>
					</a>
					<a href="#" class="right">
						<?php echo L("admin_index_index_page_right");?>
					</a>
				</div>
                <div class="favorite_menu">
					<ul>
						<li class="action" nid="0" style="border-left:solid 1px #D8D8D8;">
							<a href="javascript:;" class="menu" nid="0">
								<?php echo L("admin_index_index_page_environment");?>
							</a>
						</li>
					</ul>
				</div>
            </div>
            <div class="top_content">
				<iframe src="<?php echo U('welcome');?>" nid="0" scrolling="auto" frameborder="0"
				style="height: 100%;width: 100%;"></iframe>
			</div>
            <!--内容显示区域-->
        </div>
        <div id="quick_menu">
			<div class="set">
				<a url="<?php echo U('setFavorite');?>" onclick="get_content(this,90001)" href="javascript:;" nid="90001">
					<?php echo L("admin_index_index_page_setting");?>
				</a>
			</div>
			<div
			style="float:left;width:1px;margin-right:5px;overflow: hidden;background: #999999;height:15px;margin-top:12px;"></div>
			<div class="bottom-menu">
				<?php $zh["list"]["f"]["total"]=0;if(isset($favorite_menu) && !empty($favorite_menu)):$_id_f=0;$_index_f=0;$lastf=min(1000,count($favorite_menu));
$zh["list"]["f"]["first"]=true;
$zh["list"]["f"]["last"]=false;
$_total_f=ceil($lastf/1);$zh["list"]["f"]["total"]=$_total_f;
$_data_f = array_slice($favorite_menu,0,$lastf);
if(count($_data_f)==0):echo "";
else:
foreach($_data_f as $key=>$f):
if(($_id_f)%1==0):$_id_f++;else:$_id_f++;continue;endif;
$zh["list"]["f"]["index"]=++$_index_f;
if($_index_f>=$_total_f):$zh["list"]["f"]["last"]=true;endif;?>

					<a url="?a=<?php echo $f['app'];?>&c=<?php echo $f['control'];?>&m=<?php echo $f['method'];?>&nid=<?php echo $f['nid'];?>"
					onclick="get_content(this,<?php echo $f['nid'];?>)" href="javascript:;" nid="<?php echo $f['nid'];?>">
						<?php echo $f['title'];?>
					</a>
				<?php $zh["list"]["f"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
			</div>
			<div class="quick-hide">
				<a href="javascript:quick_menu_hide();">
					<?php echo L("admin_index_index_page_hide");?>
				</a>
			</div>
		</div>
		<div id="show_quick_menu" onclick="show_quick_menu()">
			<?php echo L("admin_index_index_page_show");?>
		</div>
		<!--加载后触发第一个顶级菜单-->
		<script>
			$("a[nid=227]").trigger("click");
		</script>
		
	</body>
</html>