<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta name="Description" content="<?php echo $seoinfo['description'];?>" />
	<meta name="keywords" content="<?php echo $seoinfo['keyword'];?>" />
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta name="applicable-device" content="pc,mobile">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimum-scale=1,user-scalable=0;" />
	<title><?php echo $seoinfo['title'];?></title>
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

    <link rel="icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/import.css">
	
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/jquery.ad-gallery.css">
	
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.transitions.css">
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.carousel.css">
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.theme.css">
    <link href="http://www.his.com/template/v1/common/css/calendar.css?v=2014.01" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/list.css">
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/mobile.css">
	<!--[if lt IE 9]>
	<script src="http://www.his.com/template/v1/common/scripts/html5.js"></script>
	<script src="http://www.his.com/template/v1/common/scripts/respond.min.js"></script>
	<![endif]-->
</head>
<body id="japan_travel">
	<!-- 头部 -->
		<!--#include virtual="/common/inc/header.lbi"-->
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
				<div class="wrapper fix" style="position: relative;">
						<!-- 路径 -->
						<div class="path">
							<a href="/">首页</a> <span><?php echo $pkname;?></span> &gt; <a href=""><?php echo $lineinfo['linename'];?></a>
						</div>
						<!-- //路径 -->
					<!-- 详细页面左侧 -->
					<div class="detail_left_content">

						<div id="mobile_detail_kv">
							
							<ul class="fix tag">
								<?php echo $lineinfo['iconshow'];?>
							</ul>
							<div id="md_kv" class="md_kv">
								<?php echo $lineinfo['photoHtml_mb'];?>
							</div>
						</div>

						<section class="travel_detail_sectiion">
							<h2 class="travel_name">
                                <?php if($lineinfo['holiday']!=''){?>
								<span class="holiday">[<?php echo $lineinfo['holiday'];?>]</span>
                                <?php }?>
								<span><?php echo $lineinfo['linename'];?></span>
							</h2>
							<p class="remark">
								<span class="number">编号<?php echo $lineinfo['linesn'];?>：</span>
								<span> [<?php echo $lineinfo['shopname'];?>] 提供相关服务</span>
							</p>
							<div class="fix">
								<div class="travel_detail_price">
									<div class="td_price_area">
                                        <?php if($lineinfo['storeprice']!='0'){?>
										<p class="tdp_area_price">
											<span class="price_txt_01">市场价：</span>
											<del class="price_txt_02">¥<?php echo $lineinfo['storeprice'];?>起</del>
										</p>
                                        <?php }?>
										<div class="tdp_area_price_now">
											<span class="price_txt_01">H.I.S. 价：</span>
											<?php echo $lineinfo['price'];?>
                                            <?php if($lineinfo['lineprice']){?>
                                                <?php if($lineinfo['baf'] == 0){?>
                                                <span class="price_set_intro">包含燃油费</span>
                                                <?php  }elseif($lineinfo['baf'] == 1){ ?>
                                                <span class="price_set_intro">不含燃油费</span>
                                                <?php }?>
                                            <?php }?>
											
										</div>
									</div>
									<div class="td_price_detail">
										<div class="mb5">
											<ul class="fix">
												<li>
													<span class="price_txt_01">出发地：</span>
													<span class="price_txt_02"><?php echo $lineinfo['startcity'];?></span>
												</li>
												<li>
													<span class="price_txt_01">出团日期：</span>
													<span class="price_txt_02"><?php echo $lineinfo['maxmindateshow'];?></span>
												</li>
												<li>
													<span class="price_txt_01">最少成团人数：</span>
													<span class="price_txt_02"><?php echo $lineinfo['corporationnum'];?>人</span>
												</li>
											</ul>
										</div>
										<div class="mb5">
											<ul class="fix">
                                                <?php if($lineinfo['transport']!=''){?>
												<li>
													<span class="price_txt_01">往返交通：</span>
													<span class="price_txt_02"><?php echo $lineinfo['transport'];?></span>
												</li>
                                                <?php }?>
												<li>
													<span class="price_txt_01">提前天数：</span>
													<span class="price_txt_02"><?php echo $lineinfo['linebefore'];?>天</span>
                                                    <input type="hidden" id="pagelinebefore" value="<?php echo $lineinfo['linebefore']; ?>" />
												</li>
											</ul>
										</div>
                                        <?php if($lineinfo['sellpoint']!=''){?>
										<p class="mb5">
											<span class="price_txt_01">特色：</span>
											<span class="price_txt_02"><?php echo $lineinfo['sellpoint'];?></span>
										</p>
                                        <?php }?>
									</div>
                                    <?php if($lineinfo['magrecommend']){?>
                                    <div class="mb10">
										<ul class="fix t_tag_list">
											<?php echo $lineinfo['magrecommendHtml'];?>
										</ul>
                                    </div>
                                    <?php }?>
                                    <?php if($lineinfo['shotcontent']){?>
									<div class="td_price_spec fix">
										<span class="manager_rec">产品推荐</span>
									</div>
									<div class="td_price_tag">
                                        <?php echo nl2br(html_entity_decode($lineinfo['shotcontent']));?>
									</div>
                                    <?php }?>
								</div>
								<!-- 左边小轮播部分 -->
								<div class="ad-gallery">
                                    <?php if($lineinfo['iconshow']!=''){?>
									<ul class="fix tag">
                                        <?php echo $lineinfo['iconshow'];?>
									</ul>
                                    <?php }?>
									<div class="ad-image-wrapper">
									</div>
									<div class="ad-controls">
									</div>
									<div class="ad-nav">
										<div class="ad-thumbs">
											<ul class="ad-thumb-list">                                            
                                                <?php echo $lineinfo['photoHtml'];?>												
											</ul>
										</div>
									</div>
								</div>
								<!-- //左边小轮播部分 -->
							</div>
							
						</section>
						<!-- 预订选择部分 -->
                        <?php if($lineinfo['lineprice']){?>
						<section class="booking_area">
                            <?php if($lineinfo['expire']<time()){?>
                            此产品已经过期
                            <div class="mb10 fix" style="display: none;">
                            <?php  }else{ ?>
                            <div class="mb10 fix">
                            <?php }?>
								<div class="booking_combo_change">
									<span>价格套餐</span>
									<ul class="price_combo fix tc_class">
                                        <?php if(is_array($linesuit)):?><?php $index=0; ?><?php  foreach($linesuit as $suit){ ?>
                                            <li><a href="javascript:;" data-suitid="<?php echo $suit['id'];?>"><?php echo $suit['suitname'];?></a></li>
                                        <?php $index++; ?><?php }?><?php endif;?>
									</ul>
								</div>
								<div class="booking_price">
									<strong class="price_one" style="display: none;">总价：¥ <span class="totalprice"></span>起</strong>
								</div>
							</div>
							<div class="fix">
								<div class="booking_select">
									<div class="bks_one">
										<span>出发日期</span>
										<select class="bks_one_price" name="st_select" id="date_list" onchange="changePrice();">
											<!-- <option value="">2015-10-15(周四)成人价 1600儿童价 1300婴儿价 1200家庭价</option> -->
										</select>
									</div>
									<div class="bks_one" id="adultcontain">
										<span>成人</span>
        								<select name="adultnum" id="adultnum" onchange="changePrice2();">
                                            <option value="0">0</option>
        									<option value="1" selected="selected">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
        								</select>
									</div>
									<div class="bks_one" id="childcontain">
										<span>儿童</span>
        								<select name="childnum" id="childnum" onchange="changePrice2();">
                                            <option value="0">0</option>
        									<option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
        								</select>
									</div>
									<div class="bks_one" id="oldcontain">
										<span>婴儿</span>
        								<select name="oldnum" id="oldnum" onchange="changePrice2();">
                                            <option value="0">0</option>
        									<option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
        								</select>
									</div>
									<div class="intro">
										<a href="javascript:void(0);">说明</a>
										<div class="intro_content">
											<div class="up_arrow"></div>
											<div class="intro_detail">
												<dl>
													<dt>儿童价标准：</dt>
													<dd>年龄2~12周岁（不含），不占床，服务标准同成人</dd>
													<dt>婴儿价标准：</dt>
													<dd>年龄2周岁以下（不含），不占床，服务标准同成人 </dd>
												</dl>
											</div>
										</div>
									</div>									
								</div>
								<a href="#" class="btn_03 firstorder" style="display: none;">立即预订</a>   
								
							</div>
						</section>
                        <?php }?>
                        <?php 
                         //if(IN_ADMIN){
                            ?> 
                            <!-- 日历部分 -->
						<section class="calendar_intro fix">
							<div class="ci_block">
								<div class="ci_block_arrow"></div>
								<div class="content">
									<dl class="fix">
										<dt>友情提示：</dt>
										<dd>
											<ul class="fix">
												<li><img src="http://www.his.com/template/v1/common/images/detail/ico_rest.png" alt=""><span>余位充足</span></li>
												<li><img src="http://www.his.com/template/v1/common/images/detail/ico_phone.png" alt=""><span>电话咨询</span></li>
											</ul>
										</dd>
									</dl>
								</div>
							</div>
							<div class="ci_txt">预订是以客服人员及时与您联系并完成订单为准，操作时可能出现满位情况敬请谅解。</div>
						</section>
                        <div id="calendar" class="tablelist column_int fix">
                    
                		
                        </div>
                        <!-- //日历部分 -->
                         <?php //}
                         ?>
						
						<!-- //预订选择部分 -->
						<section class="tour_intro">
							<nav class="tour_nav">
								<ul class="fix">
                                    <?php if(!empty($lineinfo['reserved1'])){?>
									<li class="on"><a href="javascript:void(0);">产品概要</a></li>
                                    <?php }?>
                                    <?php if(!empty($lineinfo['biaozhun']) or !empty($jieshoout)){?>
									<li><a href="javascript:void(0);">产品详情</a></li>
                                    <?php }?>
                                    <?php if(!empty($lineinfo['feeinclude']) or !empty($lineinfo['reserved2'])){?>
									<li><a href="javascript:void(0);">费用说明</a></li>
                                    <?php }?>
                                    <?php if(!empty($lineinfo['reserved3'])){?>
									<li><a href="javascript:void(0);">签证信息</a></li>
                                    <?php }?>
                                    <?php if(!empty($lineinfo['reserved4'])){?>
									<li><a href="javascript:void(0);">退改规则</a></li>
                                    <?php }?>
                                    <?php if(!empty($lineinfo['beizu'])){?>
									<li><a href="javascript:void(0);">注意事项</a></li>
                                    <?php }?>
									<li><a href="javascript:void(0);">如何预定</a></li>
                                    <?php if(!empty($lineinfo['linedoc'])){?>
									<li><a href="javascript:void(0);">附件下载</a></li>
                                    <?php }?>
								</ul>
                                <?php if($lineinfo['expire'] > time()){?>
								<a href="#" class="btn_03"  style="display: none;">立即预订</a>
                                <?php }?>
							</nav>
							<div class="tour_content" >
                                <?php if(!empty($lineinfo['reserved1'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">产品概要<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
										<?php echo html_entity_decode($lineinfo['reserved1']);?>
									</article>
								</section>
                                <?php }?>
                                
                                <?php if((!empty($lineinfo['biaozhun']) && $lineinfo['biaozhun_isstyle']=='1' ) or (!empty($lineinfo['biaozhun_detail']) && $lineinfo['biaozhun_isstyle']=='2') or !empty($jieshoout)){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">产品详情<a class="tour_switch min" href="javascript:void(0);"></a></h3>
                                    
									<article class="tour_txt">
                                        <!--
                                        <?php if(!empty($lineinfo['biaozhun'])){?>
    										<section class="plane_plan" style="margin-bottom: 20px;padding: 14px 26px;background: #f3f4f3;">
                                               <?php echo html_entity_decode($lineinfo['biaozhun']);?>
    										</section>
                                        <?php }?>
                                        -->
                                        <?php if($lineinfo['biaozhun_isstyle'] == '1' and !empty($lineinfo['biaozhun'])){?>
                                            <section class="plane_plan" style="margin-bottom: 20px;padding: 14px 26px;background: #f3f4f3;">
                                               <?php echo html_entity_decode($lineinfo['biaozhun']);?>
    										</section>
                                        <?php }?>
                                        <?php if($lineinfo['biaozhun_isstyle'] == '2' and !empty($lineinfo['biaozhun_detail'])){?>
                                            <!-- pc版 航班信息 -->
                                            <section class="plane_plan" style="margin-bottom: 20px;padding: 14px 26px;background: #f3f4f3;">
                                                <div style="display: table;width: 100%;">
                                                    <div style="display: table-row;color: #737880;">
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">航班信息</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">航空公司</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">航班号</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">起飞机场</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">起飞时间</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">到达机场</span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;">到达时间</span>
                                                    </div>
                                                    <?php if(is_array($lineinfo['biaozhun_detail'])):?><?php $index=0; ?><?php  foreach($lineinfo['biaozhun_detail'] as $key=>$detail){ ?>
                                                    <div style="display: table-row;color: #a1a8b3;">
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhuninfo$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhuncompany$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhunnum$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhunstartairport$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhunstarttime$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhunendairport$key"];?></span>
                                                        <span style="display: table-cell;padding: 0 10px;font-size: 14px;"><?php echo $detail["biaozhunendtime$key"];?></span>
                                                    </div>
                                                    <?php $index++; ?><?php }?><?php endif;?>
                                                </div>
                                            </section>
                                            <!-- end -->
                                            
                                            <!-- sp版 航班信息 -->
                                            <div class="fly_info_style fix">
                                                <h5>航班信息</h5>
                                                <div class="fly_info_block">
                                                    <?php if(is_array($lineinfo['biaozhun_detail'])):?><?php $index=0; ?><?php  foreach($lineinfo['biaozhun_detail'] as $key=>$detail){ ?>
                                                    <div class="fly_item">
                                                        <p><strong><?php echo $detail["biaozhuninfo$key"];?></strong></p>
                                                        <ul class="">
                                                            <li class="ft1"><?php echo $detail["biaozhuncompany$key"];?></li>
                                                            <li class="ft2"><?php echo $detail["biaozhunnum$key"];?></li>
                                                            <li class="ft3"><?php echo $detail["biaozhunstartairport$key"];?></li>
                                                            <li class="ft4"><?php echo $detail["biaozhunstarttime$key"];?></li>
                                                            <li class="ft5"><?php echo $detail["biaozhunendairport$key"];?></li>
                                                            <li class="ft6"><?php echo $detail["biaozhunendtime$key"];?></li>
                                                        </ul>
                                                    </div>
                                                    <?php $index++; ?><?php }?><?php endif;?>
                                                </div>
                                            </div>
                                            <!-- end -->
                                            
                                        <?php }?>
                                        
										<div class="tour_list_show">
                                            <?php if($lineinfo['isstyle']=='2' && !empty($jieshoout)){?>
    											<ul class="tour_day_list">
    												<?php echo $daysout;?>
    											</ul>
                                                <?php echo $jieshoout;?> 
                                            <?php  }else{ ?>
                                                <?php echo html_entity_decode($jieshoout);?>
                                            <?php }?> 
										</div>
                                        
									</article>
								</section>
                                <?php }?>
                                
                                <?php if(!empty($lineinfo['feeinclude']) or !empty($lineinfo['reserved2'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">费用说明<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
                                        <?php if(!empty($lineinfo['feeinclude'])){?>
                                            <div class="pay_ttl">费用包含</div>
                                            <div class="pay_content"><?php echo nl2br(html_entity_decode($lineinfo['feeinclude']));?></div>
                                        <?php }?>
										<?php if(!empty($lineinfo['reserved2'])){?>
                                            <div class="pay_ttl">费用不包含</div>
                                            <div class="pay_content"><?php echo nl2br(html_entity_decode($lineinfo['reserved2']));?></div>
                                        <?php }?>
									</article>
								</section>
                                <?php }?>
                                
                                <?php if(!empty($lineinfo['reserved3'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">签证信息<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
										<div>
											<?php echo nl2br(html_entity_decode($lineinfo['reserved3']));?>
										</div>
									</article>
								</section>
                                <?php }?>
                                
                                <?php if(!empty($lineinfo['reserved4'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">退改规则<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
										<div>
											<?php echo nl2br(html_entity_decode($lineinfo['reserved4']));?>
										</div>
									</article>
								</section>
                                <?php }?>
                                
                                <?php if(!empty($lineinfo['beizu'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">注意事项<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
										<div>
											<?php echo nl2br(html_entity_decode($lineinfo['beizu']));?>
										</div>
									</article>
								</section>
                                <?php }?>
                                
								<section class="tour_detail">
									<h3 class="tour_ttl">如何预定<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
                                        <?php if(!empty($lineinfo['payment'])){?>
                                        <div>
										  <?php echo html_entity_decode($lineinfo['payment']);?>
                                        </div>
                                        <?php  }else{ ?>
                                        <p class="center_img pc_img">
											<img width="940" height="220" src="http://www.his.com/template/v1/common/images/detail/order_step.gif">
										</p>
										<p class="center_img mobile_img">
											<img src="http://www.his.com/template/v1/common/images/detail/m_order_step.gif">
										</p>
                                        <?php }?>
									</article>
								</section>
                                
                                <?php if(!empty($lineinfo['linedoc'])){?>
								<section class="tour_detail">
									<h3 class="tour_ttl">附件下载<a class="tour_switch min" href="javascript:void(0);"></a></h3>
									<article class="tour_txt">
                                        <ul class="downloadicon fix">
                                            <?php echo $lineinfo['linedocHtml'];?>
                                        </ul>
									</article>
								</section>
                                <?php }?>
							</div>
						</section>
					</div>
                    
					<div class="detail_right_content">
						<div class="hotline_block">
							<p class="ttl"><img src="http://www.his.com/template/v1/lines/images/detail/hotline_ttl.png" width="101" height="28" alt="咨询热线"></p>
							
							<div class="hotline_intro">
								<div><?php echo $lineinfo['hotlinetel'];?></div>
								<?php echo $lists["jobtime"][$lineinfo['webid']];?>
							</div>
						</div>
                        
                        <?php if(!empty($hostLines)){?>
						<div class="hot_products_rec">
                            <p class="ttl">推荐产品</p>
							<ul>
                                <?php if(is_array($hostLines)):?><?php $index=0; ?><?php  foreach($hostLines as $hotlineD){ ?>
								<li>
									<a href="/lines/detail/<?php echo $hotlineD['id'];?>.html">
                                        <?php if($hotlineD['linepic']){?>
										<div class="img"><img src="http://www.his.com/<?php echo $hotlineD['linepic'];?>" width="60" height="60" alt=""/></div>
                                        <?php  }else{ ?>
                                        <div class="img"><img src="http://www.his.com/template/v1/common/images/60x60_default.jpg" width="60" height="60" alt=""/></div>
                                        <?php }?>
										<div class="txt">
                                            <span><?php echo mb_substr($hotlineD['linename'],0,20,'utf-8');?>...</span>
                                            <strong class="price_one">
                                                <?php if(B2BLOGIN){?>
                                                    <?php if($hotlineD['b2blineprice']=='0' or $hotlineD['b2blineprice'] == ''){?>电询<?php  }else{ ?>￥<?php echo $hotlineD['b2blineprice'];?>起<?php }?>
                                                <?php  }else{ ?>
                                                    <?php if($hotlineD['lineprice']=='0' or $hotlineD['lineprice'] == ''){?>电询<?php  }else{ ?>￥<?php echo $hotlineD['lineprice'];?>起<?php }?>
                                                <?php }?>
                                                
                                            </strong>
                                        </div>
									</a>
								</li>
                                <?php $index++; ?><?php }?><?php endif;?>
							</ul>
						</div>
                        <?php }?>
                        <?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(count($rightBanner1) !='0'||count($rightBanner2) !='0'){?>
<dl class="aside_adv">


    <?php if(is_array($rightBanner2)):?><?php $index=0; ?><?php  foreach($rightBanner2 as $rb2){ ?>
        <dd>
        <?php if($rb2['url']){?>
            <?php if($rb2['new_window'] == 1){?>
                <a target="_blank" href="<?php echo $rb2['url'];?>">
            <?php  }else{ ?>
                <a href="<?php echo $rb2['url'];?>">
            <?php }?>
            <img src="http://www.his.com/<?php echo $rb2['main_image'];?>" width="240" alt=""/></a>
        <?php  }else{ ?>
         	<img src="http://www.his.com/<?php echo $rb2['main_image'];?>" width="240" alt=""/>
        <?php }?>
        </dd>
    <?php $index++; ?><?php }?><?php endif;?>
</dl>
<?php }?>

<?php if(count($rightBanner3) !='0'){?>
<dl class="aside_adv">
	<dt>
		<span>HIS提供的链接</span>
	</dt>
    <?php if(is_array($rightBanner3)):?><?php $index=0; ?><?php  foreach($rightBanner3 as $rb3){ ?>
        <dd>
        <?php if($rb3['url']){?>
            <?php if($rb3['new_window'] == 1){?>
                <a target="_blank" href="<?php echo $rb3['url'];?>">
            <?php  }else{ ?>
                <a href="<?php echo $rb3['url'];?>">
            <?php }?>
            <img src="http://www.his.com/<?php echo $rb3['main_image'];?>" width="240" alt=""/></a>
        <?php  }else{ ?>
        	<img src="http://www.his.com/<?php echo $rb3['main_image'];?>" width="240" alt=""/>
        <?php }?>
        </dd>
    <?php $index++; ?><?php }?><?php endif;?>
</dl>
<?php }?>
					</div>
					<!-- //详细页面左侧 -->
				</div>
			</div>

	</div>
    <input type="hidden" id="lineid" value="<?php echo $lineinfo['id'];?>"/>
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
	<script src="http://www.his.com/template/v1/common/scripts/jquery.ad-gallery.min.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/detail.js" type="text/javascript"></script>
    <script src="http://www.his.com/template/v1/common/scripts/owl.carousel.js" type="text/javascript"></script>
    <script src="http://www.his.com/template/v1/common/scripts/calendar.js" type="text/javascript"></script>
    <script src="http://www.his.com/template/v1/common/scripts/GetCNDate.js" type="text/javascript"></script>
	<script>
		var evenSelect;
		if(IsPC()){
	        evenSelect = true; //是否启用两个日历框
	    }else{
	        evenSelect = false; 
	    }
        $(function(){
			//navBannerOn(1);
			var galleries = $('.ad-gallery').adGallery();
			//mobile版
           var ww = $(window).width();
           if(ww <= 767){//小于767时才触发
            var mkvItem = $("#md_kv").find(".item");
            if(mkvItem.length > 1){
             $("#md_kv").owlCarousel({
              items:1,
              singleItem:true,
              autoPlay:4000,
              lazyLoad:true,
              transitionStyle : "fade"
                 
             });
            }else{
             var thisSrc = mkvItem.find("img").attr("data-src");
             mkvItem.find("img").attr("src",thisSrc);
            }
           }
        			
            
            $(".tc_class a").click(function(){

                 var suitid = $(this).attr('data-suitid');
                 var lineid = $("#lineid").val();
                 //$(this).addClass('on').siblings().removeClass('on');
                 //$(this).parent("li").addClass('on').siblings().removeClass('on');
                 //alert(suitid);
                 getOptionList(suitid);
                 <?php 
                 //if(IN_ADMIN){
                    ?> 
                    //getCalendar(suitid,lineid);
                 <?php //}
                 ?>
                 //getCalendar(suitid,lineid);
        
             })
             
             var tsuit = $(".tc_class li");
            //var suitnow = $(".tc_class li.on").next();
            if( tsuit.length < 1){
                //noRecord=true;
                $(".booking_select").children().hide();
                $('.firstorder').hide();
                $('.price_one',$('.booking_price')).hide();
                $(".booking_select").html("<p class='txt'>当前线路无套餐</p>");
                 //getCalendar(suitid,lineid);
                //return;
            }else{
                $(".tc_class a").first().trigger('click');
            }
             
     
		});
        var currentCalendar;
        function changePrice(){
            //alert('a');
              /*if(!$("#date_list")){
                return ;
              }*/
              /*if(noRecord){
                 return ;
              }*/
              //alert($("#date_list"));
              //alert($("#date_list").val());
              if($("#date_list").val()==null){
                $('.price_one',$('.booking_price')).hide();
                $(".firstorder").hide();
                return;
              }else{
                $('.price_one',$('.booking_price')).show();
                $(".firstorder").show();
              }
              //alert($("#date_list").val());
              var datevalue = $("#date_list").val();//当前选择的日期
        	  var adultprice = $("#date_list").find("option:selected").attr("data-price"); //成人价格
        	  var childprice = $("#date_list").find("option:selected").attr("data-childprice");//儿童价格
              var oldprice = $("#date_list").find("option:selected").attr("data-oldprice");//婴儿价格
        	  var suitid = $(".tc_class a.on").attr('data-suitid');
        	  var lineid = $("#lineid").val();
        	  var adultnum = $("#adultnum").val();
        	  var childnum = $("#childnum").val();
              var oldnum = $("#oldnum").val();
              
              var adulttotalprice = adultnum * adultprice;
              var childtotalprice = childnum * childprice;
              var oldtotalprice = oldnum * oldprice;
              totalprice = childtotalprice + adulttotalprice + oldtotalprice;
              $('.totalprice').html(totalprice);
              //$(".firstorder").show();
              var id2=$('a',$('li.on',$(".tc_class"))).attr('data-suitid');
              //alert(id2);
              
              var datearr = datevalue.split('-');
              var yearstr=parseInt(datearr[0]);
              var monthstr=parseInt(datearr[1]);
              var daystr=parseInt(datearr[2]);
              if(currentCalendar){
                currentCalendar.reNew(document.getElementById('calendar'),id2,"",evenSelect,false,false,yearstr,monthstr,daystr,lineid);
                $("#calendar").find("td").children("div").removeClass("calendarsel");
                  //alert(datevalue);
                  $("div[datetime='"+datevalue+"']").addClass("calendarsel");
              }
              
              
              
            
        }
        function changePrice2(){
            /*if(!$("#date_list")){
                return ;
              }*/
            /*if(noRecord){
                 return ;
              }*/
              if($("#date_list").val()==null){
                $(".firstorder").hide();
                $('.price_one').hide();
                return;
              }else{
                $(".firstorder").show();
                $('.price_one').show();
              }
              var datevalue = $("#date_list").val();//当前选择的日期
        	  var adultprice = $("#date_list").find("option:selected").attr("data-price"); //成人价格
        	  var childprice = $("#date_list").find("option:selected").attr("data-childprice");//儿童价格
              var oldprice = $("#date_list").find("option:selected").attr("data-oldprice");//婴儿价格
        	  var suitid = $(".tc_class a.on").attr('data-suitid');
        	  var lineid = $("#lineid").val();
        	  var adultnum = $("#adultnum").val();
        	  var childnum = $("#childnum").val();
              var oldnum = $("#oldnum").val();
              
              var adulttotalprice = adultnum * adultprice;
              var childtotalprice = childnum * childprice;
              var oldtotalprice = oldnum * oldprice;
              totalprice = childtotalprice + adulttotalprice + oldtotalprice;
              $('.totalprice').html(totalprice);
              $(".firstorder").show();    
              //currentCalendar.reNew(document.getElementById('calendar'),suitid,"",true,false,false,'2016','5','1',lineid);
              
            
        }
        
        
        //var noRecord=false;
        function getOptionList(suitid)
        {
            noRecord=false;
            var lineid = $("#lineid").val();
            $.ajax({
             type:'POST',
             url:CONTROL+'&m=ajax_suitoption',
             dataType:'json',
             data:'dopost=getoptionlist&suitid='+suitid+'&lineid='+lineid,
             success:function(data){
                //alert(data.monthli)
                if( data.monthli == '' ){
                    /* 自动跳转到下一套餐
                    var suit = $(".tc_class li");
                    var suitnow = $(".tc_class li.on").next();
                    if( suitnow.length == '0' ){
                        $("#date_list").parent().html("暂无合适套餐");
                        return ;
                    }
                    var suitid = $("a",suitnow).attr('data-suitid');
                    getOptionList(suitid);
                    suitnow.trigger('click');
                    */
                    var suit = $(".tc_class li");
                    //var suitnow = $(".tc_class li.on").next();
                    if( suit.length <= 1){
                        //noRecord=true;
                        $(".booking_select").children().hide();
                        $('.firstorder').hide();
                        $('.price_one',$('.booking_price')).hide();
                        $(".booking_select").html("<p class='txt'>当前线路无库存</p>");
                        $("#calendar").html('');
                        $(".calendar_intro").hide();
                         //getCalendar(suitid,lineid);
                        return;
                    }
                    /*if( suitnow.length == '0' ){
                        $(".booking_select").children().hide();
                        $(".booking_select").append("<p class='txt'>当前套餐无库存，请选择其他套餐</p>");
                        return ;
                    }*/else{
                        //noRecord=true;
                        //$(".booking_select").html("当前套餐无库存，请选择其他套餐");
                        $(".booking_select").children().hide();
                        $('.firstorder').hide();
                         $('.price_one',$('.booking_price')).hide();
                        $(".booking_select").append("<p class='txt'>当前套餐无库存，请选择其他套餐</p>");
                        $("#calendar").html('');
                        $(".calendar_intro").hide();
                         //getCalendar(suitid,lineid);
                        return ;
                    }
                    
                }
                
                $(".booking_select p").empty();
                $(".booking_select").children().show();
                 $('.price_one',$('.booking_price')).show();
                $('.firstorder').show();
                $(".calendar_intro").show();
                 if(data)
                 {
                     $("#date_list").empty(); //先清空
                     $(data.monthli).appendTo($("#date_list"))
                    // $("#jifenbook").html(data.jifen.jifenbook);
                     //$("#jifentprice").html(data.jifen.jifentprice);

                     if(data.hasadult == '1'){
                         $('#adultcontain').show();
                     }
                     else
                     {
                         $('#adultcontain').hide();
                     }
                     if(data.haschild == '1'){
                         $('#childcontain').show();
                     }
                     else
                     {
                        //alert('aaa');
                         $('#childcontain').hide();
                     }
                     if(data.hasold == 1){
                         $('#oldcontain').show();
                     }
                     else
                     {
                         $('#oldcontain').hide();
                     }
                     
                     var str = $("#date_list").html();
                     
                    changePrice();
                    /*var suitid1 = $(this).attr('data-suitid');
                    var lineid1 = $("#lineid").val();*/
                    getCalendar(suitid,lineid);
                 }
             }
            })
            
        }
        
        //获取日历报价
         function getCalendar(suitid,lineid)
         {
    
             showCalendar('calendar',suitid,function(){$(".calendar:first").css("margin-right","18px")},lineid);
    //          var a = new Calendar();
			 // a.show(document.getElementById('calendar'),suitid,function(){$(".calendar:first").css("margin-right","18px")},lineid);
			 // a.reNew(document.getElementById('calendar'),suitid,"",true,false,false,"2016","5","01",lineid);

         }
        
        //订购 AddBy xie
        $(".btn_03").click(function(){
            var lineid = <?php echo $lineinfo['id'];?>;
            var suitid = $(".tc_class").find(".on").find("a").attr("data-suitid");
            var usedate = $("#date_list").val();;
            var adultnum = $("#adultnum").val();
        	var childnum = $("#childnum").val();
            var oldnum = $("#oldnum").val();
            var urlroot = "<?php echo $urlroot;?>";

            window.location.href = ROOT + urlroot +"/index.php?a=index&c=booking&m=index&lineid="+lineid+"&suitid="+suitid+"&usedate="+usedate+"&oldnum="+oldnum+"&adultnum="+adultnum+"&childnum="+childnum;
        })
        
        //日历点击预订
        function setBeginTime(year,month,day,price,childprice,lineid,suitid)
        {
            var lineid = <?php echo $lineinfo['id'];?>;
        	var usedate=year+"-"+pad(month,2)+"-"+pad(day,2);
            //$("#date_list[value='"+usedate+"']").attr('selected','selected');
            var sel = document.getElementById("date_list");
            for (var i = 0; i < sel.length; i++) {
                if (sel[i].value == usedate) {
                    //后台传过来的数据
                    sel[i].selected = true;
                }
            }
            changePrice2();
            $("#calendar").find("td").children("div").removeClass("calendarsel");
            $("div[datetime='"+usedate+"']").addClass("calendarsel");
            //var urlroot = "<?php echo $urlroot;?>";
            
            //window.location.href = ROOT + urlroot +"/index.php?a=index&c=booking&m=index&lineid="+lineid+"&suitid="+suitid+"&usedate="+usedate+"&oldnum=0&adultnum=1&childnum=0";
        	
        }

        
        function pad(num, n) {  
          var len = num.toString().length;  
            while(len < n) {  
                num = "0" + num;  
                len++;  
            }  
            return num;    
        }
        

        function fpMonth(){
        	var datevalue = $("#date_list").val();//当前选择的日期
        	var id2=$('a',$('li.on',$(".tc_class"))).attr('data-suitid');
        	var datearr = datevalue.split('-');
			var yearstr=parseInt(datearr[0]);
			var monthstr=parseInt(datearr[1]);
			var daystr=parseInt(datearr[2]);
			if(currentCalendar){
				currentCalendar.reNew(document.getElementById('calendar'),id2,"",evenSelect,false,false,yearstr,monthstr,daystr,lineid);
			}
        }
        

//alert(pad(3,2));
	</script>
</body>
</html>