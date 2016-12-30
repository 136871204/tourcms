<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="Description" content="<?php echo C("description");?>" />
	<meta name="keywords" content="<?php echo C("keywords");?>" />
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta name="applicable-device" content="pc,mobile">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimum-scale=1,user-scalable=0;" />
	<title>【H.I.S.旅游网】日本旅游_日本旅游网_日本旅游线路_日本旅游团_日本自助游_日本团队游_日本当地游</title>
	<meta name="Description" content="H.I.S.旅游网为您提供日本旅游线路,日本旅游景点,日本自由行,日本跟团游,日本半自助游,日本团队游等多种价格查询。" />
	<meta name="keywords" content="日本机票,日本打折机票,日本机票预订,日本特价酒店,日本酒店预订,日本自由行,日本当地导游,日本飞机票查询,日本航班查询,日本旅游度假,京都,大阪,福冈,冲绳" />

	<link rel="icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/import.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.transitions.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.carousel.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.theme.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/list.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/mobile.css">
    <script type='text/javascript' src='http://www.his.com/zh/ZHPHP/zhphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
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

	<!--[if lt IE 9]>
	<script src="http://www.his.com/template/v1/common/scripts/html5.js"></script>
	<script src="http://www.his.com/template/v1/common/scripts/respond.min.js"></script>
	<![endif]-->
</head>
<body id="index">
	<div class="loading_section"></div>
	<!-- 头部 -->
        <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if($webid == 1){?>
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!--头部 -->
<header id="header" class="pc_header">
	<div class="wrapper fix header_header">
		<h1>
            <a href="/">
                <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">-->
                <?php if(B2BLOGIN){?>
				<img src="http://www.his.com/template/v1/common/images/logo_03.gif" width="96" height="38" alt="">
                <?php }else{?>
				<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">
                <?php }?>
            </a>
        </h1>
		<!-- 支店选择 -->
		<div class="select_shop">
			<a class="btn_01" href="/">中国</a>
			<i class="arrow"></i>
			<div class="select_shop_detail">
				<div class="select_shop_arrow"></div>
				<ul class="select_shop_list">
                    <li class="on"><a href="/">中国</a></li>
                    <li><a href="/beijing">北京站</a></li>
                    <li><a href="/shanghai">上海站</a></li>
                    <li><a href="/other">其他站</a></li>
				</ul>
				
			</div>
		</div>
		<!-- //支店选择 -->
		<!-- 搜索 -->
		<div class="search_area">
			<form action="index.php" method="get" id="headersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<div class="search_border fix">
					<input type="text" name="keyword" id=""/>
					<a class="search_btn" href="javascript:void(0);" onclick="btn_search('headersearch')"></a>
				</div>
				<div class="search_spread">
					<div class="search_histroy">
						<span class="title">
							您的搜索历史
						</span>
                        
						<div class="search_histroy_content">
                            <?php if(!empty($searchkeword)){?>
							<ul>
                                <?php $zh["list"]["keywords"]["total"]=0;if(isset($searchkeword) && !empty($searchkeword)):$_id_keywords=0;$_index_keywords=0;$lastkeywords=min(1000,count($searchkeword));
$zh["list"]["keywords"]["first"]=true;
$zh["list"]["keywords"]["last"]=false;
$_total_keywords=ceil($lastkeywords/1);$zh["list"]["keywords"]["total"]=$_total_keywords;
$_data_keywords = array_slice($searchkeword,0,$lastkeywords);
if(count($_data_keywords)==0):echo "";
else:
foreach($_data_keywords as $key=>$keywords):
if(($_id_keywords)%1==0):$_id_keywords++;else:$_id_keywords++;continue;endif;
$zh["list"]["keywords"]["index"]=++$_index_keywords;
if($_index_keywords>=$_total_keywords):$zh["list"]["keywords"]["last"]=true;endif;?>

								<li><a href="<?php echo getSearchKeyUrl($keywords);?>"><?php echo $keywords;?></a></li>
                                <?php $zh["list"]["keywords"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
							</ul>
							<a class="clear_recorder" href="#">清除搜索记录</a>
                            <?php  }else{ ?>
                            暂无搜索记录
                            <?php }?>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- //搜索 -->
		<div class="header_right">

		</div>
	</div>
    <p class="osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月2日</span> <span>春节：2017年1月27日～2017年2月2日</span></p>
	<nav id="nav" <?php if(B2BLOGIN){?>class="agent_logined"<?php }?>>
		<div class="wrapper">
			<ul class="fix banner">
                <li><a href="/">首页</a></li>
                <li><a href="/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
                <li><a href="/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
                <!--<li><a href="/lines/all-3-0-0-0-0-0-0-156">自由行</a></li>-->
                <li><a href="/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
                <li ><a href="/jrpass.html">日本铁路周游券</a></li>
			</ul>
            
			<ul class="fix angent_login_area">
                <?php if(B2BLOGIN){?>
				<li class="logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><div class="exit_area"><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></div></li>
                <?php }else{?>
				<li class="login"><a href="/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                <?php }?>
			</ul>
            
		</div>
	</nav>

</header>
<!-- //头部 -->

<!-- 移动端头部 -->
<header class="mobile_header">
	<h1>
        <a href="/" alt="h.i.s">
            <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">-->
            <?php if(B2BLOGIN){?>
			<img src="http://www.his.com/template/v1/common/images/logo_03.gif" alt="">
            <?php }else{?>
			<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">
            <?php }?>
        </a>
    </h1>
	<div class="m_select_shop">
		<span class="m_ss_ttl">中国</span>
		<div class="m_ss_content">
			<div class="arrow-up"></div>
			<div class="m_ss_content_s">
				<ul>
					<li class="on"><a href="/">中国</a></li>
					<li><a href="/beijing">北京站</a></li>
					<li><a href="/shanghai">上海站</a></li>
					<li><a href="/other">其他站</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="m_search_area">
        <form action="index.php" method="get" id="spheadersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<input type="text" name="keyword" id=""/>
			<a href="javascript:void(0);" class="m_search_button" onclick="btn_search('spheadersearch')"></a>
		</form>
	</div>
		
	<div class="m_menu_area">
		<a class="m_menu_btn" href="javascript:void(0);">menu</a>
		<div class="m_menu_content close">
			<div class="m_menu_ttl">
				<span class="m_menu_logo"><img src="http://www.his.com/template/v1/common/images/mobile/logo_01.png" alt=""></span>
				
				<a href="javascript:void(0);" class="menu_close"></a>
			</div>
			<div class="m_menu_detail">
				<nav class="page_nage">
					<ul>
                        <?php if(B2BLOGIN){?>
						<li class="a_logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></li>
                        <?php }else{?>
						<li class="a_login"><a href="/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                        <?php }?>
						<li><a href="/">首页</a></li>
						<li><a href="/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
						<li><a href="/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
						<li><a href="/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
						<li><a href="/jrpass.html">日本铁路周游券</a></li>
					</ul>
				</nav>
				<nav class="contact_nav">
					<ul>
				
						
					</ul>
				</nav>
			</div>

		</div>
	</div>
</header>
<p class="m_osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月2日</span> <span>春节：2017年1月27日～2017年2月2日</span></p>
<!-- //移动端头部
<?php  }elseif($webid == 2){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 头部 -->
<header id="header" class="pc_header">
	<div class="wrapper fix header_header">
		<h1>
            <a href="/shanghai/">
                <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">-->
                <?php if(B2BLOGIN){?>
				<img src="http://www.his.com/template/v1/common/images/logo_03.gif" width="96" height="38" alt="">
                <?php }else{?>
				<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">
                <?php }?>
            </a>
        </h1>
		<!-- 支店选择 -->
		<div class="select_shop">
			<a class="btn_01" href="/shanghai">上海站</a>
			<i class="arrow"></i>
			<div class="select_shop_detail">
				<div class="select_shop_arrow"></div>
				<ul class="select_shop_list">
                    <li><a href="/">中国</a></li>
                    <li><a href="/beijing">北京站</a></li>
                    <li class="on"><a href="/shanghai">上海站</a></li>
                    <li><a href="/other">其他站</a></li>
				</ul>
				
			</div>
		</div>
		<!-- //支店选择 -->
		<!-- 搜索 -->
		<div class="search_area">
			<form action="/shanghai/index.php" method="get" id="headersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<div class="search_border fix">
					<input type="text" name="keyword" id="">
					<a class="search_btn" href="javascript:void(0);" onclick="btn_search('headersearch')"></a>
				</div>
				<div class="search_spread">
					<div class="search_histroy">
						<span class="title">
							您的搜索历史
						</span>
						<div class="search_histroy_content">
                            <?php if(!empty($searchkeword)){?>
							<ul>
                                <?php $zh["list"]["keywords"]["total"]=0;if(isset($searchkeword) && !empty($searchkeword)):$_id_keywords=0;$_index_keywords=0;$lastkeywords=min(1000,count($searchkeword));
$zh["list"]["keywords"]["first"]=true;
$zh["list"]["keywords"]["last"]=false;
$_total_keywords=ceil($lastkeywords/1);$zh["list"]["keywords"]["total"]=$_total_keywords;
$_data_keywords = array_slice($searchkeword,0,$lastkeywords);
if(count($_data_keywords)==0):echo "";
else:
foreach($_data_keywords as $key=>$keywords):
if(($_id_keywords)%1==0):$_id_keywords++;else:$_id_keywords++;continue;endif;
$zh["list"]["keywords"]["index"]=++$_index_keywords;
if($_index_keywords>=$_total_keywords):$zh["list"]["keywords"]["last"]=true;endif;?>

								<li><a href="<?php echo getSearchKeyUrl($keywords);?>"><?php echo $keywords;?></a></li>
                                <?php $zh["list"]["keywords"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
							</ul>
							<a class="clear_recorder" href="#">清除搜索记录</a>
                            <?php  }else{ ?>
                            暂无搜索记录
                            <?php }?>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- //搜索 -->
		<div class="header_right">
			
		</div>
	</div>
    <p class="osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月3日</span> <span>春节：2017年1月27日～2017年2月2日</span>
	<nav id="nav" <?php if(B2BLOGIN){?>class="agent_logined"<?php }?>>
		<div class="wrapper">
			<ul class="fix banner">
                <li><a href="/shanghai/">首页</a></li>
                <li><a href="/shanghai/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
                <!--<li><a href="/shanghai/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>-->
                <!--<li><a href="/lines/all-3-0-0-0-0-0-0-156">自由行</a></li>-->
                <li><a href="/shanghai/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
                <li ><a href="/shanghai/jrpass.html">日本铁路周游券</a></li>
			</ul>
            
			<ul class="fix angent_login_area">
                <?php if(B2BLOGIN){?>                
				<li class="logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><div class="exit_area"><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></div></li>
                <?php }else{?>
				<li class="login"><a href="/shanghai/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                <?php }?>
			</ul>
            
		</div>
	</nav>

</header>
<!-- //头部 -->


<!-- 移动端头部 -->
<header class="mobile_header">
	<h1>
        <a href="/shanghai/" alt="h.i.s">
            <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">-->
            <?php if(B2BLOGIN){?>
			<img src="http://www.his.com/template/v1/common/images/logo_03.gif" alt="">
            <?php }else{?>
			<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">
            <?php }?>
        </a>
    </h1>

	<div class="m_select_shop">
		<span class="m_ss_ttl">上海站</span>
		<div class="m_ss_content">
			<div class="arrow-up"></div>
			<div class="m_ss_content_s">
				<ul>
					<li><a href="/">中国</a></li>
					<li><a href="/beijing">北京站</a></li>
					<li class="on"><a href="/shanghai">上海站</a></li>
					<li><a href="/other">其他站</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="m_search_area">
        <form action="index.php" method="get" id="spheadersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<input type="text" name="keyword" id=""/>
			<a href="javascript:void(0);" class="m_search_button" onclick="btn_search('spheadersearch')"></a>
		</form>
	</div>
		
	<div class="m_menu_area">
		<a class="m_menu_btn" href="javascript:void(0);">menu</a>
		<div class="m_menu_content close">
			<div class="m_menu_ttl">
				<span class="m_menu_logo"><img src="http://www.his.com/template/v1/common/images/mobile/logo_01.png" alt=""></span>
				
				<a href="javascript:void(0);" class="menu_close"></a>
			</div>
			<div class="m_menu_detail">
				<nav class="page_nage">
					<ul>
                        <?php if(B2BLOGIN){?>
						<li class="a_logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></li>
                        <?php }else{?>
						<li class="a_login"><a href="/shanghai/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                        <?php }?>
						<li><a href="/shanghai/">首页</a></li>
						<li><a href="/shanghai/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
						<!--<li><a href="/shanghai/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>-->
						<li><a href="/shanghai/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
						<li><a href="/shanghai/jrpass.html">日本铁路周游券</a></li>
					</ul>
				</nav>
				<nav class="contact_nav">
					<ul>

						
					</ul>
				</nav>
			</div>

		</div>
	</div>
</header>
<p class="m_osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月3日</span> <span>春节：2017年1月27日～2017年2月2日</span></p>
<!-- //移动端头部 -->
<?php  }elseif($webid == 3){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 头部 -->
<header id="header" class="pc_header">
	<div class="wrapper fix header_header">
		<h1>
            <a href="/beijing/">
                <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">-->
                <?php if(B2BLOGIN){?>
				<img src="http://www.his.com/template/v1/common/images/logo_03.gif" width="96" height="38" alt="">
                <?php }else{?>
				<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">
                <?php }?>
            </a>
        </h1>
		<!-- 支店选择 -->
		<div class="select_shop">
			<a class="btn_01" href="/beijing">北京站</a>
			<i class="arrow"></i>
			<div class="select_shop_detail">
				<div class="select_shop_arrow"></div>
				<ul class="select_shop_list">
                    <li><a href="/">中国</a></li>
                    <li class="on"><a href="/beijing">北京站</a></li>
                    <li><a href="/shanghai">上海站</a></li>
                    <li><a href="/other">其他站</a></li>
				</ul>
				
			</div>
		</div>
		<!-- //支店选择 -->
		<!-- 搜索 -->
		<div class="search_area">
			<form action="/beijing/index.php" method="get" id="headersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<div class="search_border fix">
					<input type="text" name="keyword" id="">
					<a class="search_btn" href="javascript:void(0);" onclick="btn_search('headersearch')"></a>
				</div>
				<div class="search_spread">
					<div class="search_histroy">
						<span class="title">
							您的搜索历史
						</span>
						<div class="search_histroy_content">
                            <?php if(!empty($searchkeword)){?>
							<ul>
                                <?php $zh["list"]["keywords"]["total"]=0;if(isset($searchkeword) && !empty($searchkeword)):$_id_keywords=0;$_index_keywords=0;$lastkeywords=min(1000,count($searchkeword));
$zh["list"]["keywords"]["first"]=true;
$zh["list"]["keywords"]["last"]=false;
$_total_keywords=ceil($lastkeywords/1);$zh["list"]["keywords"]["total"]=$_total_keywords;
$_data_keywords = array_slice($searchkeword,0,$lastkeywords);
if(count($_data_keywords)==0):echo "";
else:
foreach($_data_keywords as $key=>$keywords):
if(($_id_keywords)%1==0):$_id_keywords++;else:$_id_keywords++;continue;endif;
$zh["list"]["keywords"]["index"]=++$_index_keywords;
if($_index_keywords>=$_total_keywords):$zh["list"]["keywords"]["last"]=true;endif;?>

								<li><a href="<?php echo getSearchKeyUrl($keywords);?>"><?php echo $keywords;?></a></li>
                                <?php $zh["list"]["keywords"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
							</ul>
							<a class="clear_recorder" href="#">清除搜索记录</a>
                            <?php  }else{ ?>
                            暂无搜索记录
                            <?php }?>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- //搜索 -->
		<div class="header_right">
			
		</div>
	</div>
    <p class="osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月2日</span> <span>春节：2017年1月27日～2017年2月2日</span></p>
	<nav id="nav" <?php if(B2BLOGIN){?>class="agent_logined"<?php }?>>
		<div class="wrapper">
			<ul class="fix banner">
                <li><a href="/beijing/">首页</a></li>
                <li><a href="/beijing/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
                <li><a href="/beijing/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
                <li><a href="/beijing/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
                <li ><a href="/beijing/jrpass.html">日本铁路周游券</a></li>
			</ul>
            
			<ul class="fix angent_login_area">
                <?php if(B2BLOGIN){?>                
				<li class="logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><div class="exit_area"><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></div></li>
                <?php }else{?>
				<li class="login"><a href="/beijing/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                <?php }?>
			</ul>
            
		</div>
	</nav>

</header>
<!-- //头部 -->
<!-- 移动端头部 -->
<header class="mobile_header">
	<h1>
        <a href="/beijing/" alt="h.i.s">
            <?php if(B2BLOGIN){?>
			<img src="http://www.his.com/template/v1/common/images/logo_03.gif" alt="">
            <?php }else{?>
			<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">
            <?php }?>
        </a>
    </h1>

	<div class="m_select_shop">
		<span class="m_ss_ttl">北京站</span>
		<div class="m_ss_content">
			<div class="arrow-up"></div>
			<div class="m_ss_content_s">
				<ul>
					<li><a href="/">中国</a></li>
					<li class="on"><a href="/beijing">北京站</a></li>
					<li><a href="/shanghai">上海站</a></li>
					<li><a href="/other">其他站</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="m_search_area">
		<form action="index.php" method="get" id="spheadersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<input type="text" name="keyword" id=""/>
			<a href="javascript:void(0);" class="m_search_button" onclick="btn_search('spheadersearch')"></a>
		</form>
	</div>
		
	<div class="m_menu_area">
		<a class="m_menu_btn" href="javascript:void(0);">menu</a>
		<div class="m_menu_content close">
			<div class="m_menu_ttl">
				<span class="m_menu_logo"><img src="http://www.his.com/template/v1/common/images/mobile/logo_01.png" alt=""></span>
				
				<a href="javascript:void(0);" class="menu_close"></a>
			</div>
			<div class="m_menu_detail">
				<nav class="page_nage">
					<ul>
                        <?php if(B2BLOGIN){?>
						<li class="a_logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></li>
                        <?php }else{?>
						<li class="a_login"><a href="/beijing/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                        <?php }?>
						<li><a href="/beijing/">首页</a></li>
						<li><a href="/beijing/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
						<li><a href="/beijing/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
						<li><a href="/beijing/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
						<li><a href="/beijing/jrpass.html">日本铁路周游券</a></li>
					</ul>
				</nav>
				<nav class="contact_nav">
					<ul>
						
					</ul>
				</nav>
			</div>

		</div>
	</div>
</header>
<p class="m_osls_txt">2017年元旦&amp;春节放假安排通知<br/><span>元旦：2016年12月31日～2017年1月2日</span> <span>春节：2017年1月27日～2017年2月2日</span></p>
<!-- //移动端头部 -->
<?php  }elseif($webid == 6){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 头部 -->
<header id="header" class="pc_header">
	<div class="wrapper fix header_header">
		<h1>
            <a href="/other/">
                <!--<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">-->
                <?php if(B2BLOGIN){?>
				<img src="http://www.his.com/template/v1/common/images/logo_03.gif" width="96" height="38" alt="">
                <?php }else{?>
				<img src="http://www.his.com/template/v1/common/images/logo_01.gif" width="96" height="38" alt="">
                <?php }?>
            </a>
        </h1>
		<!-- 支店选择 -->
		<div class="select_shop">
			<a class="btn_01" href="/other">其他站</a>
			<i class="arrow"></i>
			<div class="select_shop_detail">
				<div class="select_shop_arrow"></div>
				<ul class="select_shop_list">
                    <li><a href="/">中国</a></li>
                    <li><a href="/beijing">北京站</a></li>
                    <li><a href="/shanghai">上海站</a></li>
                    <li class="on"><a href="/other">其他站</a></li>
				</ul>
				
			</div>
		</div>
		<!-- //支店选择 -->
		<!-- 搜索 -->
		<div class="search_area">
			<form action="/other/index.php" method="get" id="headersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<div class="search_border fix">
					<input type="text" name="keyword" id="">
					<a class="search_btn" href="javascript:void(0);" onclick="btn_search('headersearch')"></a>
				</div>
				<div class="search_spread">
					<div class="search_histroy">
						<span class="title">
							您的搜索历史
						</span>
						<div class="search_histroy_content">
                            <?php if(!empty($searchkeword)){?>
							<ul>
                                <?php $zh["list"]["keywords"]["total"]=0;if(isset($searchkeword) && !empty($searchkeword)):$_id_keywords=0;$_index_keywords=0;$lastkeywords=min(1000,count($searchkeword));
$zh["list"]["keywords"]["first"]=true;
$zh["list"]["keywords"]["last"]=false;
$_total_keywords=ceil($lastkeywords/1);$zh["list"]["keywords"]["total"]=$_total_keywords;
$_data_keywords = array_slice($searchkeword,0,$lastkeywords);
if(count($_data_keywords)==0):echo "";
else:
foreach($_data_keywords as $key=>$keywords):
if(($_id_keywords)%1==0):$_id_keywords++;else:$_id_keywords++;continue;endif;
$zh["list"]["keywords"]["index"]=++$_index_keywords;
if($_index_keywords>=$_total_keywords):$zh["list"]["keywords"]["last"]=true;endif;?>

								<li><a href="<?php echo getSearchKeyUrl($keywords);?>"><?php echo $keywords;?></a></li>
                                <?php $zh["list"]["keywords"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
							</ul>
							<a class="clear_recorder" href="#">清除搜索记录</a>
                            <?php  }else{ ?>
                            暂无搜索记录
                            <?php }?>
						</div>
					</div>
				</div>
			</form>
		</div>
		<!-- //搜索 -->
		<div class="header_right">
			
		</div>
	</div>
	<nav id="nav" <?php if(B2BLOGIN){?>class="agent_logined"<?php }?>>
		<div class="wrapper">
			<ul class="fix banner">
                <li><a href="/other/">首页</a></li>
                <li><a href="/other/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
                <li><a href="/other/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
                <li><a href="/lines/all-3-0-0-0-0-0-0-156">自由行</a></li>
                <li><a href="/other/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
                <li ><a href="/other/jrpass.html">日本铁路周游券</a></li>
			</ul>
            
			<ul class="fix angent_login_area">
                <?php if(B2BLOGIN){?>                
				<li class="logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><div class="exit_area"><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></div></li>
                <?php }else{?>
				<li class="login"><a href="/other/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                <?php }?>
			</ul>
            
		</div>
	</nav>

</header>
<!-- //头部 -->
<!-- 移动端头部 -->
<header class="mobile_header">
	<h1>
        <a href="/other/" alt="h.i.s">
            <?php if(B2BLOGIN){?>
			<img src="http://www.his.com/template/v1/common/images/logo_03.gif" alt="">
            <?php }else{?>
			<img src="http://www.his.com/template/v1/common/images/logo_01.gif" alt="">
            <?php }?>
        </a>
    </h1>

	<div class="m_select_shop">
		<span class="m_ss_ttl">其他站</span>
		<div class="m_ss_content">
			<div class="arrow-up"></div>
			<div class="m_ss_content_s">
				<ul>
					<li><a href="/">中国</a></li>
					<li><a href="/shanghai">上海站</a></li>
					<li><a href="/beijing">北京站</a></li>
					<li class="on"><a href="/other">其他站</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="m_search_area">
		<form action="index.php" method="get" id="spheadersearch">
                <input type="hidden" name="a" value="Index"/>
                <input type="hidden" name="m" value="coloudsearch"/>
                <input type="hidden" name="c" value="Search"/>
				<input type="text" name="keyword" id=""/>
			<a href="javascript:void(0);" class="m_search_button" onclick="btn_search('spheadersearch')"></a>
		</form>
	</div>
		
	<div class="m_menu_area">
		<a class="m_menu_btn" href="javascript:void(0);">menu</a>
		<div class="m_menu_content close">
			<div class="m_menu_ttl">
				<span class="m_menu_logo"><img src="http://www.his.com/template/v1/common/images/mobile/logo_01.png" alt=""></span>
				
				<a href="javascript:void(0);" class="menu_close"></a>
			</div>
			<div class="m_menu_detail">
				<nav class="page_nage">
					<ul>
                        <?php if(B2BLOGIN){?>
						<li class="a_logined"><span>您好，<?php echo $_SESSION["b2busername"];?></span><a href="/index.php?a=Index&c=B2b&m=logout">退出</a></li>
                        <?php }else{?>
						<li class="a_login"><a href="/other/index.php?a=Index&c=B2b&m=login">代理商登录</a></li>
                        <?php }?>
						<li><a href="/other/">首页</a></li>
						<li><a href="/other/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
						<li><a href="/other/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
						<li><a href="/other/jrpass.html">日本铁路周游券</a></li>
					</ul>
				</nav>
				<nav class="contact_nav">
					<ul>

						
					</ul>
				</nav>
			</div>

		</div>
	</div>
</header>
<!-- //移动端头部 -->
<?php }?>

	<!-- //头部 -->
	<!-- 中间内容 -->
	<div id="content">
		<div class="main_content">
            <form id="dingfrm" action="?a=index&c=booking&m=index&dopost=savebooking" method="post">            
			<div class="wrapper" style="position: relative;">
				<!-- 路径 -->
				<div class="path">
					<a href="/">首页</a> &gt; <span class="stepnav">填写订单</span>
				</div>
				<!-- //路径 -->
				<div class="step_area">
					<ol class="fix">
						<li class="on"><div><i>1</i><span>填写订单</span></div></li>
						<li><div><i>2</i><span>确认订单</span></div></li>
						<li><div><i>3</i><span>预订成功</span></div></li>
					</ol>
					<span class="line"></span>
				</div>
                <div class="order_area fix" style="position: relative;">
					<div class="left_content">
						<section class="order_block order_block_border_01">
							<h2 class="order_ttl"><strong>产品信息</strong><span>（产品编号：<?php echo $lineinfo['lineseries'];?>）</span></h2>
                            <input type="hidden" name="lineseries" value="<?php echo $lineinfo['lineseries'];?>" />
							<div class="order_content">
                                
                                <input type="hidden" name="title" value="<?php echo $lineinfo['title'];?>" />
                                <input type="hidden" name="suitname" value="<?php echo $lineinfo['suitname'];?>" />
                                <input type="hidden" name="startcity" value="<?php echo $lineinfo['startcity'];?>" />
                                <input type="hidden" name="adultprice" value="<?php echo $lineinfo['price'];?>" />
                                <input type="hidden" name="childprice" value="<?php echo $lineinfo['childprice'];?>" />
                                <input type="hidden" name="oldprice" value="<?php echo $lineinfo['oldprice'];?>" />
                                
								<table class="order_info_table">
									<tbody>
										<tr>
											<th>产品名称</th>
											<td>
                                                <a href="<?php echo $urlroot;?>/lines/detail/<?php echo $lineinfo['id'];?>.html"><?php echo $lineinfo['title'];?></a>
                                            </td>
										</tr>
										<tr>
											<th>产品类型</th>
											<td>
                                                <?php echo $lineinfo['suitname'];?>
                                            </td>
										</tr>
										<tr>
											<th>出发日期</th>
											<td>
                                                <select onchange="changeday(this);" name="day">
                                                    <?php $zh["list"]["d"]["total"]=0;if(isset($day) && !empty($day)):$_id_d=0;$_index_d=0;$lastd=min(1000,count($day));
$zh["list"]["d"]["first"]=true;
$zh["list"]["d"]["last"]=false;
$_total_d=ceil($lastd/1);$zh["list"]["d"]["total"]=$_total_d;
$_data_d = array_slice($day,0,$lastd);
if(count($_data_d)==0):echo "";
else:
foreach($_data_d as $key=>$d):
if(($_id_d)%1==0):$_id_d++;else:$_id_d++;continue;endif;
$zh["list"]["d"]["index"]=++$_index_d;
if($_index_d>=$_total_d):$zh["list"]["d"]["last"]=true;endif;?>

                                                    <option <?php if(date('Y-m-d',$d['day']) == $lineinfo['usedate']){?>selected='selected'<?php }?> value="<?php echo date('Y-m-d',$d['day']);?>"><?php echo date('Y-m-d',$d['day']);?>(周<?php echo getWeekDay(date('w',$d['day']));?>)</option>
                                                    <?php $zh["list"]["d"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
                                                </select>
                                            </td>
										</tr>
										<tr>
											<th>出发城市</th>
											<td>
                                                <?php echo $lineinfo['startcity'];?>
                                            </td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>
						<section class="order_block">
							<h2 class="order_ttl"><strong>预订人数</strong></h2>
							<div class="order_content order_content_style_01">
								<table class="order_person_table">
									<thead>
										<tr>
											<th>类型</th>
											<th>单价</th>
											<th>购买数量</th>
											<th>金额</th>
										</tr>
									</thead>
									<tbody>
                                        <?php if(empty($lineinfo['hasadult'])){?>
                                        <tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>									
											<th>成人</th>
											<td>&yen;<?php echo $lineinfo['price'];?></td>
											<td>
												<div class="person_machine">
													<input class="min" type="button" value="-">
                                                    <input type="text" data="1" class="gm_num num" id="adultnum" name="adultnum" readonly value="<?php echo $lineinfo['dingnum'];?>" />
													<input class="plus" type="button" value="+">
												</div>
											</td>
											<td>&yen;<span class="adulttotalprice"></span></td>
										</tr>
                                        
                                        <?php if(empty($lineinfo['haschild'])){?>
                                        <tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>									
											<th>儿童</th>
											<td>&yen;<?php echo $lineinfo['childprice'];?></td>
											<td>
												<div class="person_machine">
													<input class="min" type="button" value="-">
                                                    <input type="text" data="2" class="gm_num num" id="childnum" name="childnum" readonly value="<?php echo $lineinfo['childnum'];?>" />
													<input class="plus" type="button" value="+">
												</div>
											</td>
											<td>&yen;<span class="childtotalprice"></span></td>
										</tr>
                                        
                                        <?php if(empty($lineinfo['hasold'])){?>
                                        <tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>									
											<th>婴儿</th>
											<td>&yen;<?php echo $lineinfo['oldprice'];?></td>
											<td>
												<div class="person_machine">
													<input class="min" type="button" value="-">
                                                    <input type="text" data="3" class="gm_num num" id="oldnum" name="oldnum" readonly value="<?php echo $lineinfo['oldnum'];?>" />
													<input class="plus" type="button" value="+">
												</div>
											</td>
											<td>&yen;<span class="oldtotalprice"></span></td>
										</tr>
                                        
									</tbody>
								</table>
							</div>
						</section>
						<section class="order_block">
							<h2 class="order_ttl"><strong>预订人信息</strong></h2>
							<div class="order_content">
								<table class="order_person_info_table table_style_01">
									<tbody>
										<tr>
											<th>预订联系人<span class="tb_imp">（必填）</span><span class="tb_imp err_linkman"></span></th>
											<th>联系手机<span class="tb_imp">（必填）</span><span class="tb_imp err_linktel"></span></th>
										</tr>
										<tr>
											<td>
                                                <input type="text" name="linkman" id="linkman" class="sex_input" value="<?php echo $lineinfo['linkman'];?>" />
                                                <input type="radio" name="linksex" id="male" value="1" checked><label for="male">男</label><input type="radio" name="linksex" id="female" value="2"/><label for="female">女</label></td>
											<td>
                                                <input type="text" class="msg_text" name="linktel" id="linktel" value="<?php echo $lineinfo['linktel'];?>" />
											</td>
										</tr>
										<tr>
											<th>邮箱<span class="tb_imp">（必填）</span><span class="tb_imp err_linkemail"></span></th>
											<th>处理支店<span class="tb_imp">（必填）</span><span class="tb_imp err_handleshop"></span></th>
										</tr>
										<tr>
											<td>
												<input type="text" class="msg_text" name="linkemail" id="linkemail" value="<?php echo $lineinfo['linkemail'];?>" />
											</td>
											<td>
                                                <select id="handleshop" name="handleshop" onchange="changeshop(this);">
                                                    <?php if($lineinfo['webid']==2){?>
                                                    <option value="1" selected="selected"><?php echo $lineinfo['shopname'];?></option>
                                                    <?php  }elseif($lineinfo['webid']==3){ ?>
                                                    <option value="2" selected="selected"><?php echo $lineinfo['shopname'];?></option>
                                                    <?php  }else{ ?>
													<option value="">请选择</option>
                                                    <?php if(is_array($handleshop)):?><?php $index=0; ?><?php  foreach($handleshop as $shopK=>$shopD){ ?>
                                                        <option class="handle_select" value="<?php echo $shopK;?>" <?php if($lineinfo['shopname'] == $shopD){?>selected='selected'<?php }?>><?php echo $shopD;?></option>
                                                    <?php $index++; ?><?php }?><?php endif;?>
                                                    <?php }?>
                                                    <!--
                                                    <?php if(is_array($handleshop)):?><?php $index=0; ?><?php  foreach($handleshop as $shopK=>$shopD){ ?>
                                                        <option class="handle_select" value="<?php echo $shopK;?>" <?php if($lineinfo['shopname'] == $shopD){?>selected='selected'<?php }?>><?php echo $shopD;?></option>
                                                    <?php $index++; ?><?php }?><?php endif;?>
                                                    -->
                                                </select>
											</td>
										</tr>
                                        <script>/*
                                            $(function(){
                                                var handle_select = $(".handle_select");
                                                var flagshow;
                                                handle_select.hide();
                                                handle_select.each(function(i){
                                                    var flag = $(this).attr("selected");
                                                    if(flag == "selected"){
                                                        $(this).show();
                                                        flagshow = 1;
                                                    }
                                                })
                                                if( typeof(flagshow) == "undefined" ){
                                                    handle_select.show();
                                                }
                                            })*/
                                        </script>
										<tr>
											<th colspan="2">订单留言</th>
										</tr>
										<tr>
											<td colspan="2">
                                                <textarea class="msg_area" name="remarkinfo" cols="30" rows="10"></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>
                        
                        <h3 class="order_ttl"><strong>成人游客</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer1">
							
						</section>
                        
                        <h3 class="order_ttl"><strong>儿童游客（2-12周岁）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer2">
							
						</section>
                        
                        <h3 class="order_ttl"><strong>婴儿游客（2周岁以下）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer3">
							
						</section>
                        
						<div class="order_all">
							<span class="ttl">订单金额：<strong class="price_one">￥<span class="totalprice"></span></strong></span>                            
                            <a class="btn_03 btnsave" href="javascript:void(0);">确认订单</a>
						</div>

					</div>
					<div class="right_content fixed_right">
						<section class="order_detail">
							<div class="img"><img src="http://www.his.com/template/v1/lines/images/right_list_img_01.jpg" width="238" height="116" alt=""></div>
							<div class="txt">
								<p class="ttl">
									<strong><?php echo $lineinfo['linename'];?></strong>
									<span><?php echo $lineinfo['suitname'];?></span>
								</p>
								<table class="order_detail_table">
									<tbody>
                                        <?php if(empty($lineinfo['hasadult'])){?>
										<tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>
											<th>成人</th>
											<td><?php echo $lineinfo['price'];?> <span class="equals">X <span class="adulttotalnum"><?php echo $lineinfo['dingnum'];?></span></span></td>
											<td class="adulttotalprice"></td>
										</tr>
                                        
                                        <?php if(empty($lineinfo['haschild'])){?>
										<tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>
											<th>儿童</th>
											<td><?php echo $lineinfo['childprice'];?> <span class="equals">X <span class="childtotalnum"><?php echo $lineinfo['childnum'];?></span></span></td>
											<td class="childtotalprice"></td>
										</tr>
                                        
                                        <?php if(empty($lineinfo['hasold'])){?>
										<tr style="display: none;">
                                        <?php  }else{ ?>
                                        <tr>
                                        <?php }?>
											<th>婴儿</th>
											<td><?php echo $lineinfo['oldprice'];?> <span class="equals">X <span class="oldtotalnum"><?php echo $lineinfo['oldnum'];?></span></span></td>
											<td class="oldtotalprice"></td>
										</tr>
									</tbody>
								</table>
								<div class="price_one">
									订单金额：<strong>￥<span class="totalprice2"></span></strong>
								</div>
                                <a class="btn_03 btnsave" href="javascript:void(0);">确认订单</a>
                                <a class="btn_03 btnsaveorder" style="display: none;" href="javascript:void(0);">立即预订</a>
                                <div class="tj_order_btn">
                                    <input type="hidden" id="adultprice" value="<?php echo $lineinfo['price'];?>"/>
                                    <input type="hidden" id="childprice" value="<?php echo $lineinfo['childprice'];?>"/>
                                    <input type="hidden" id="oldprice" value="<?php echo $lineinfo['oldprice'];?>"/>
                                    <input type="hidden" name="dingjin" value="<?php echo $lineinfo['dingjin'];?>"/>
                                    <input type="hidden" name="productautoid" value="<?php echo $lineinfo['id'];?>"/>
                                    <input type="hidden" name="productaid" value="<?php echo $lineinfo['aid'];?>"/>
                                    <input type="hidden" name="productname" value="<?php echo $lineinfo['title'];?>"/>
                                    <input type="hidden" name="suitid" id="suitid" value="<?php echo $lineinfo['suitid'];?>"/>
                                    <input type="hidden" name="usedate" value="<?php echo $lineinfo['usedate'];?>"/>
                                    <input type="hidden" name="totalprice" id="totalprice" value="" />
                                </div>
							</div>
						</section>
						<!--<p class="simple_hotline"><img src="http://www.his.com/template/v1/common/images/ico/ico_hotline_02.png" alt=""><?php echo $lineinfo['shopname'];?>：<?php echo $lineinfo['hotlinetel'];?> </p>-->
                        <div class="hotline_block">
                           <p class="ttl"><img src="http://www.his.com/template/v1/common/images/detail/hotline_ttl.png" width="101" height="28" alt="咨询热线"></p>
                           <p class="support"><span>产品提供：</span><strong><?php echo $lineinfo['shopname'];?></strong></p>
                           <div class="hotline_intro">
                            <div>
                                <?php if($lineinfo['webid'] == '6'){?>
                                    <?php echo $lineinfo['hotlinetel'];?>
                                <?php  }else{ ?>
                                    <?php echo $lists['histel'][$lineinfo['webid']];?>
                                <?php }?>
                            </div>
                            <?php echo $handleshopjobtime;?>
                           </div>
                          </div>
					</div>
				</div>
			</div>
            </form>
		</div>

	</div>
	<!-- //中间内容 -->
	<!-- 底部 -->
        <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if($webid == 1){?>
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 底部 -->
<footer id="footer">
	<div class="wrapper fix">
		<dl class="footer_sitemap">
			<dt><span>网站地图</span></dt>
			<dd>
				<ul>
					<li><a href="/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
					<li><a href="/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
					<li><a href="/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
					<li><a href="/jrpass.html">JR RAIL Pass</a></li>
					<!--<li class="blank"><a href="http://vacation.his-china.com/cn/Contents/index.aspx?Mode=Hotels&lang=cn">国际机票</a></li>-->
				</ul>
			</dd>
		</dl>
		<dl class="footer_abouthis">
			<dt><span>关于MetaPhase.</span></dt>
			<dd>
				<ul>
					<li><a href="/company.html">公司简介</a></li>
					<li><a href="/contact.html">联系我们</a></li>
					<li><a href="/law.html">法律声明</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_hb">
			<dt><span>合作伙伴</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_link">
			<dt><span>友情链接</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp/">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="share_link">
			<dt><span>Meta.支店</span></dt>
			<dd>
				<ul>
					<li>
						<a href="/beijing">北京总部</a>
						
					</li>
					<li>
						<a href="/shanghai">上海支店</a>
						
					</li>
					<li>
						<a href="/other">成都支店</a>
						
					</li>
					<li>
						<a href="/other">广州支店</a>
						
					</li>
					<li>
						<a href="/other">青岛支店</a>
						
					</li>
					<li>
						<a href="/other">大连支店</a>
						
					</li>
					<li>
						<a href="/other">苏州支店</a>
						
					</li>
				</ul>
			</dd>
		</dl>
		<div class="footer_right_area fix">
			<div class="txt">

			</div>
		</div>
	</div>
    <div class="copyright">
    </div>
</footer>
<!-- //底部 -->
<script src="http://www.his.com/template/v1/common/scripts/scrolltopcontrol.js" type="text/javascript"></script>
<?php  }elseif($webid == 2){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 底部 -->
<footer id="footer">
	<div class="wrapper fix">
		<dl class="footer_sitemap">
			<dt><span>网站地图</span></dt>
			<dd>
				<ul>
					<li><a href="/shanghai/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
					<li><a href="/shanghai/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
					<li><a href="/shanghai/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
					<li><a href="/shanghai/jrpass.html">JR RAIL Pass</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_abouthis">
			<dt><span>关于metaphase.</span></dt>
			<dd>
				<ul>
					<li><a href="/shanghai/company.html">公司简介</a></li>
					<li><a href="/shanghai/contact.html">联系我们</a></li>
					<li><a href="/shanghai/law.html">法律声明</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_hb">
			<dt><span>合作伙伴</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_link">
			<dt><span>友情链接</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="share_link">
			<dt><span>Meta.支店</span></dt>
			<dd>
				<ul>
					<li>
						<a href="/beijing">北京总部</a>
						
					</li>
					<li>
						<a href="/shanghai">上海支店</a>
						
					</li>
					<li>
						<a href="/other">成都支店</a>
						
					</li>
					<li>
						<a href="/other">广州支店</a>
						
					</li>
					<li>
						<a href="/other">青岛支店</a>
						
					</li>
					<li>
						<a href="/other">大连支店</a>
						
					</li>
					<li>
						<a href="/other">苏州支店</a>
						
					</li>
				</ul>
			</dd>
		</dl>
		<div class="footer_right_area fix">
			
		</div>
	</div>
    <div class="copyright">

    </div>
</footer>
<!-- //底部 -->
<script src="http://www.his.com/template/v1/common/scripts/scrolltopcontrol_sh.js" type="text/javascript"></script>
<?php  }elseif($webid == 3){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 底部 -->
<footer id="footer">
	<div class="wrapper fix">
		<dl class="footer_sitemap">
			<dt><span>网站地图</span></dt>
			<dd>
				<ul>
					<li><a href="/beijing/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
					<li><a href="/beijing/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
					<li><a href="/beijing/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
					<li><a href="/beijing/jrpass.html">JR RAIL Pass</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_abouthis">
			<dt><span>关于Metaphase.</span></dt>
			<dd>
				<ul>
					<li><a href="/beijing/company.html">公司简介</a></li>
					<li><a href="/beijing/contact.html">联系我们</a></li>
					<li><a href="/beijing/law.html">法律声明</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_hb">
			<dt><span>合作伙伴</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_link">
			<dt><span>友情链接</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="share_link">
			<dt><span>Meta.支店</span></dt>
			<dd>
				<ul>
					<li>
						<a href="/beijing">北京总部</a>
						
					</li>
					<li>
						<a href="/shanghai">上海支店</a>
						
					</li>
					<li>
						<a href="/other">成都支店</a>
						
					</li>
					<li>
						<a href="/other">广州支店</a>
						
					</li>
					<li>
						<a href="/other">青岛支店</a>
						
					</li>
					<li>
						<a href="/other">大连支店</a>
						
					</li>
					<li>
						<a href="/other">苏州支店</a>
						
					</li>
				</ul>
			</dd>
		</dl>
		<div class="footer_right_area fix">
			
		</div>
	</div>
    <div class="copyright">

    </div>
</footer>
<!-- //底部 -->
<script src="http://www.his.com/template/v1/common/scripts/scrolltopcontrol_bj.js" type="text/javascript"></script>
<?php  }elseif($webid == 6){ ?> 
    <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!-- 底部 -->
<footer id="footer">
	<div class="wrapper fix">
		<dl class="footer_sitemap">
			<dt><span>网站地图</span></dt>
			<dd>
				<ul>
					<li><a href="/other/lines/riben-1-0-0-0-0-0-0-0">日本旅游</a></li>
					<li><a href="/other/lines/qitaguoji-2-0-0-0-0-0-0-0">其他国际旅游</a></li>
					<li><a href="/other/lines/all-3-0-0-0-0-0-0-157">当地游</a></li>
					<li><a href="/other/jrpass.html">JR RAIL Pass</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_abouthis">
			<dt><span>关于Meta.</span></dt>
			<dd>
				<ul>
					<li><a href="/other/company.html">公司简介</a></li>
					<li><a href="/other/contact.html">联系我们</a></li>
					<li><a href="/other/law.html">法律声明</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_hb">
			<dt><span>合作伙伴</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="footer_link">
			<dt><span>友情链接</span></dt>
			<dd>
				<ul>
					<li><a target="_blank" href="http://www.metaphase.co.jp">metaphase</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="share_link">
			<dt><span>Meta支店</span></dt>
			<dd>
				<ul>
					<li>
						<a href="/beijing">北京总部</a>
						
					</li>
					<li>
						<a href="/shanghai">上海支店</a>
						
					</li>
					<li>
						<a href="/other">成都支店</a>
						
					</li>
					<li>
						<a href="/other">广州支店</a>
						
					</li>
					<li>
						<a href="/other">青岛支店</a>
						
					</li>
					<li>
						<a href="/other">大连支店</a>
						
					</li>
					<li>
						<a href="/other">苏州支店</a>
						
					</li>
				</ul>
			</dd>
		</dl>
		<div class="footer_right_area fix">
			
		</div>
	</div>
    <div class="copyright">

    </div>
</footer>
<!-- //底部 -->
<script src="http://www.his.com/template/v1/common/scripts/scrolltopcontrol_other.js" type="text/javascript"></script>  
<?php }?>

<!-- 百度统计 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?2ad08b63ae0f1d236b9be590b7f72063";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
	<!-- //底部 -->

	<script src="http://www.his.com/template/v1/common/scripts/jsloader.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/placeHolder.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/order.js" type="text/javascript"></script>
    <script>
    
        $(function(){            
            
            //统计价格
            booking.countPrice();
            //人数添加事件
            $(".person_machine").find('.plus').click(function(){
                var data = $(this).parents('.person_machine').find('.num').attr("data");
                var txt = $(this).parents('.person_machine').find('.num');
                txt.val(Number(txt.val())+1);
                var cn = Number(txt.val());
                if(cn>6){
                  txt.val(6);
                  alert('最大6位');
                }
                booking.countPrice();
                booking.addTourer();
                textclear();
            
                //隐藏游客信息
                tourerhidden();
            })
            //人数减少事件
             $(".person_machine").find('.min').click(function(){
                var data = $(this).parents('.person_machine').find('.num').attr("data");
                var txt = $(this).parents('.person_machine').find('.num');
                var n = Number(txt.val())-1;
                n = n<0 ? 0 : n;
                txt.val(n);
                booking.countPrice();
                booking.removeTourer(data);
            
                //隐藏游客信息
                tourerhidden();
             })
               
            //联系人隐藏
            /*$("#tourerlist").click(function(){
                $("#tourer").toggle();
            })*/

            //添加联系人
            booking.addTourer();
            textclear();
            
            //隐藏游客信息
            tourerhidden();
            
            //下订单
            $(".btnsaveorder").live("click",function(){
               var err;
               err = FormCheck();
               if( err == "error" ){
                    return;
               }
               
               $(".loading_section").css("display","block");
               $.ajax({
                    url:METH+"&dopost=savebooking",
                    type:"post",
                    data:$("#dingfrm").serialize(),
                    success:function(result){
                        //alert(result);
                        if( result == "false" ){
                            alert("网络繁忙，请稍后再试！");
                        }else if( result == "true" ){
                            window.location.href = CONTROL+"&m=success";
                        }else{
                            var msg = jQuery.parseJSON(result);
                            var msgtitle='';
                            for(var x in msg){
                                if(msgtitle == ''){
                                    msgtitle = x;
                                }
                                $(".err_"+x).html(msg[x]);
                                setTimeout('$(".err_'+x+'").html("")',5000);
                            }
                            toposition("err_"+ msgtitle);
                        }
                        $(".loading_section").css("display","none");
                    }
               })
            })
            
            //下订单 确认
            $(".btnsave").click(function(){
               var err;
               err = FormCheck();
               if( err == "error" ){
                    return;
               }
               
               $.ajax({
                    url:METH+"&dopost=save",
                    type:"post",
                    data:$("#dingfrm").serialize(),
                    success:function(result){
                        $(".btnsave").hide();
                        $(".btnsaveorder").show();
                        //$(".confirmback").show();
                        
                        $(".step_area li").removeClass("on").eq(1).addClass("on");
                        $(".stepnav").html("确认订单");
                        
                        $(".left_content").hide();
                        $(".order_area").addClass("confirm_area");
                        $(".order_area").append(result);
                        //$(".wrapper").find("input").css("border","none");
                        //$("#content .wrapper").find("input").attr("disabled","disabled").addClass("no_border");
                        //$("#content .wrapper").find("select").attr("disabled","disabled");
                        //$("#content .wrapper").find("textarea").attr("disabled","disabled").addClass("no_border");
                        $('html,body').animate({scrollTop:0}, 0);
                        //setTimeout('$(".loading_section").css("display","none")',200);
                    }
               })
            })
            
            //下订单 返回
            $(".confirmback").live("click",function(){

                $(".btnsave").show();
                $(".btnsaveorder").hide();
                $(".step_area li").removeClass("on").eq(0).addClass("on");
               
                $(".stepnav").html("填写订单");
                $(".comfirm_content").remove();
                $(".order_area").removeClass("confirm_area");
                $(".left_content").show();
                
                //$(".wrapper").find("input").removeAttr("disabled").removeClass("no_border");
                //$(".wrapper").find("select").removeAttr("disabled");
                //$(".wrapper").find("textarea").removeAttr("disabled").removeClass("no_border");
                $('html,body').animate({scrollTop:0}, 0);
            })
           
        });
    
        var booking = {
            countPrice:function(){
                var childnum = Number($("#childnum").val());
                var adultnum = Number($("#adultnum").val());
                var oldnum = Number($("#oldnum").val());
                
                var childprice = $("#childprice").val();
                var adultprice = $("#adultprice").val();
                var oldprice = $("#oldprice").val();
                
                childtotalprice = childnum * childprice;
                adulttotalprice = adultnum * adultprice;
                oldtotalprice = oldnum * oldprice;
                totalprice = childtotalprice + adulttotalprice + oldtotalprice;
                
                $('.childtotalprice').html(childtotalprice);
                $('.adulttotalprice').html(adulttotalprice);
                $('.oldtotalprice').html(oldtotalprice);
                
                $('.adulttotalnum').html(adultnum);
                $('.childtotalnum').html(childnum);
                $('.oldtotalnum').html(oldnum);
                //alert(totalprice);
                $('.totalprice').html(totalprice);
                $('.totalprice2').html(totalprice);
                $('#totalprice').val(totalprice);
                $('.payprice').html(totalprice);
            },
            addTourer:function(){
                var childnum = Number($("#childnum").val());
                var adultnum = Number($("#adultnum").val());
                var oldnum = Number($("#oldnum").val());
                var totalnum = childnum+adultnum+oldnum;
                var $info = '';
                for(ptype=1;ptype<=3;ptype++){
                    switch(ptype)
                        {
                        case 1:
                          var listnum = adultnum;
                          break;
                        case 2:
                          var listnum = childnum;
                          break;
                        case 3:
                          var listnum = oldnum;
                          break;
                        }
                    var hasnum = $('#tourer'+ptype).find('.msg_list').length+1;
                
                    for(i=hasnum;i<=listnum;i++){
                        $info = '<div class="one_person_order msg_list">';
                        if(ptype=="1"){
                            $info +='   <h2 class="order_ttl"><strong>成人'+i+'</strong></h2>';
                        }else if(ptype=="2"){
                            $info +='   <h2 class="order_ttl"><strong>儿童'+i+'</strong></h2>';
                        }else if(ptype=="3"){
                            $info +='   <h2 class="order_ttl"><strong>婴儿'+i+'</strong></h2>';
                        }                        
                        $info +='   <div class="order_content">';
                        $info +='       <table class="table_style_01">';
                        $info +='       <tbody>';
                        $info +='           <tr><th>姓名<span class="tb_imp">（必填）</span><span class="tb_imp err_tourername'+ptype+i+'"></span></th></tr>';
                        $info +='           <tr><td>';
                        $info +='                   <input class="sex_input" type="text" name="tourername'+ptype+i+'" id="tourname'+ptype+i+'">';
                        $info +='                   <input type="radio" name="tourersex'+ptype+i+'" id="male'+ptype+i+'" value="1" checked><label for="male'+ptype+i+'">男</label>';
                        $info +='                   <input type="radio" name="tourersex'+ptype+i+'" id="female'+ptype+i+'" value="2"><label for="female'+ptype+i+'">女</label>';
                        $info +='           </td></tr>';
                        $info +='           <tr><th>姓名拼音<span class="tb_imp">（必填）</span><span class="tb_imp err_pinyin'+ptype+i+'"></span></th></tr>';
                        $info +='           <tr><td>';
                        $info +='                   <input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp'+ptype+i+'" id="tourerfnamealp'+ptype+i+'" style="margin-right:65px;">';
                        $info +='                   <input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp'+ptype+i+'" id="tourerlnamealp'+ptype+i+'">';
                        $info +='           </td></tr>';
                        $info +='           <tr><th>出生日期</th></tr>';
                        $info +='           <tr><td>';
                        $info +='                   <input class="date_input date_yy" type="text" name="tourerbirthdayy'+ptype+i+'" id="tourerbirthdayy'+ptype+i+'" style="margin-right: 46px;">';
                        $info +='                   <input class="date_input date_mm" type="text" name="tourerbirthdaym'+ptype+i+'" id="tourerbirthdaym'+ptype+i+'" style="margin-right: 46px;">';
                        $info +='                   <input class="date_input date_dd" type="text" name="tourerbirthdayd'+ptype+i+'" id="tourerbirthdayd'+ptype+i+'">';
                        $info +='           </td></tr>';
                        //if(ptype == '1'){
                            $info +='           <tr><th>护照号</th></tr>';
                            $info +='           <tr><td><input type="text" name="tourerpassbook'+ptype+i+'" class="text_msg tourname" id="tourerpassbook'+ptype+i+'" /></td></tr>';
                            $info +='           <tr><th>护照有效期</th></tr>';
                            $info +='           <tr><td>';
                            $info +='                   <input class="date_input date_yy" type="text" name="tourereffectivey'+ptype+i+'" id="tourereffectivey'+ptype+i+'" style="margin-right: 46px;">';
                            $info +='                   <input class="date_input date_mm" type="text" name="tourereffectivem'+ptype+i+'" id="tourereffectivem'+ptype+i+'" style="margin-right: 46px;">';
                            $info +='                   <input class="date_input date_dd" type="text" name="tourereffectived'+ptype+i+'" id="tourereffectived'+ptype+i+'">';
                            $info +='           </td></tr>';
                        //}
                        
                        $info +='       </tbody>';                    
                        $info +='       </table>'
                        $info +='   </div>';
                        $info +='<input type="hidden" name="tourerptype'+ptype+i+'" value="'+ptype+'">';
                        $info +='</div>';
                        $("#tourer"+ptype).append($info);
                    }
                }
            },
            removeTourer:function(data){
                $('#tourer'+data).find('.msg_list').last().remove();
            }
        }
        
        //更改日期
        function changeday(ob){
            var lineid = <?php echo $lineinfo['id'];?>;
            var suitid = <?php echo $lineinfo['suitid'];?>;
            var usedate = $(ob).val();
            var adultnum = <?php echo $lineinfo['dingnum'];?>;
        	var childnum = <?php echo $lineinfo['childnum'];?>;
            var oldnum = <?php echo $lineinfo['oldnum'];?>;
            
            window.location.href = WEB+"?a=index&c=booking&m=index&lineid="+lineid+"&suitid="+suitid+"&usedate="+usedate+"&oldnum="+oldnum+"&adultnum="+adultnum+"&childnum="+childnum;
        }
        
        //更改支店以及时间
        function changeshop(ob){
            var shopid = $(ob).val();
            
            switch(shopid){
                case "1":
                    var newshopname = "上海支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周六：</th><td>09:30~18:00</td></tr></tbody></table>";
                    var tel="021-3331-2136";
                    break;
                case "2":
                    var newshopname = "北京总部";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:00~18:00</td></tr></tbody></table>";
                    var tel="010-6539-1864";
                    break;
                case "3":
                    var newshopname = "成都支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:00~18:00</td></tr></tbody></table>";
                    var tel="028-8620-3718";
                    break;
                case "4":
                    var newshopname = "广州支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:30~18:30</td></tr><tr><th>周六：</th><td>09:30~15:30</td></tr></tbody></table>";
                    var tel="020-3877-3580";
                    break;
                case "5":
                    var newshopname = "青岛支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:00~18:00</td></tr><tr><th>周六：</th><td>10:00~16:00</td></tr></tbody></table>";
                    var tel="0532-66777288";
                    break;
                case "6":
                    var newshopname = "大连支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:00~18:00</td></tr><tr><th>周六：</th><td>10:00~16:00</td></tr></tbody></table>";
                    var tel="0411-3980-5766";
                    break;
                case "7":
                    var newshopname = "苏州支店";
                    var newjobtime = "<table><tbody><tr><th>周一至周五：</th><td>09:30~17:30</td></tr></tbody></table>";
                    var tel="";
                    break;
                default:
                    var newshopname = "<?php echo $lineinfo['shopname'];?>";
                    var newjobtime = "<?php echo $handleshopjobtime;?>";
                    var tel="<?php echo $lineinfo['hotlinetel'];?>";
                    break;                
            }
            var out = "<div>"+tel+"</div>"+newjobtime;
            $(".support strong").html(newshopname);
            //$(".hotline_intro table").html(newjobtime);
            $(".hotline_intro").html(out);
        }
        
        function tourerhidden(){
            for(i=1;i<=3;i++){
                var num = $("#tourer" + i +" .one_person_order").length;
                if( num < 1){
                    $("#tourer"+i).prev("h3").hide();
                }else{
                    $("#tourer"+i).prev("h3").show();
                }
            }            
        }
    
    </script>
    
    <script type="text/javascript">
    var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
    document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F2ad08b63ae0f1d236b9be590b7f72063' type='text/javascript'%3E%3C/script%3E"));
    </script>
</body>
</html>