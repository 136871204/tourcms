<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8"/>
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta name="applicable-device" content="pc,mobile">
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimum-scale=1,user-scalable=0;" />
	<?php if($webid == 1){?>
     <title>中国站点标题</title>
     <meta name="description" content="中国站点标题描述" />
     <meta name="keywords" content="中国站点标题关键字" />
     <?php  }elseif($webid == 2){ ?> 
     <title>上海站点标题</title>
     <meta name="description" content="上海站点标题描述" />
     <meta name="keywords" content="上海站点标题关键字" />
     <?php  }elseif($webid == 3){ ?> 
     <title>北京站点标题</title>
     <meta name="description" content="北京站点标题描述" />
     <meta name="keywords" content="北京站点标题关键字" />
     <?php  }elseif($webid == 6){ ?> 
    <title>其他站点标题</title>
     <meta name="description" content="其他站点标题描述" />
     <meta name="keywords" content="其他站点标题关键字" />
    <?php }?>
	
	<link rel="icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="http://www.his.com/template/v1/favicon.ico" mce_href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/import.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.transitions.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.carousel.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/owl.theme.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/style.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/index.css">
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

    <?php if(!empty($rightBanner1)){?>
    <!-- 头部横穿banner -->
    <div class="cross_banner_area">
        <div class="cross_btn">
            <a href="javascript:void(0);"><img src="/<?php echo $rightBanner1['min_image'];?>" alt=""/></a>
        </div>
    </div>
    <div class="cross_banner_area long">
        <div class="cross_banner_content">
            <div class="bg"></div>
            
                <div class="cross_banner_detail">
                <a href="javascript:void(0);" class="close"></a>
                <p>
                    <?php if($rightBanner1['url']!=''){?>
                        <?php if($rightBanner1['new_window'] == 1){?>
                            <a target="_blank" href="<?php echo $rightBanner1['url'];?>">
                        <?php  }else{ ?>
                            <a href="<?php echo $rightBanner1['url'];?>">
                        <?php }?>
                    <?php }?>
                        <img src="/<?php echo $rightBanner1['main_image'];?>" alt=""/>
                    <?php if($rightBanner1['url']!=''){?>
                        </a>
                    <?php }?>
                </p>
            </div>
        
        </div>
    </div>
    <!-- //头部横穿banner -->
    <?php }?>
    
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
		<div class="index_banner">
			<div id="kv">
				<div id="kv_detail" class="kv_detail">
                    <?php if(is_array($mainBanner)):?><?php $index=0; ?><?php  foreach($mainBanner as $mb){ ?>
                        <div class="kv_item" style='height:290px;background-image:url(http://www.his.com/<?php echo $mb['main_image'];?>);'>
                        <?php if($mb['url']!=''){?>
                            <?php if($mb['new_window'] == 1){?>
                                <a target="_blank" href="<?php echo $mb['url'];?>"></a>
                            <?php  }else{ ?>
                                <a href="<?php echo $mb['url'];?>"></a>
                            <?php }?>
                        <?php }?>
                        </div>
                    <?php $index++; ?><?php }?><?php endif;?>
				</div>
			</div>
			
			<div id="mobile_kv">
				<div id="mobile_kv_detail" class="mobile_kv_detail">
                    <?php if(is_array($mainBanner)):?><?php $index=0; ?><?php  foreach($mainBanner as $mb){ ?>
                        <div class="item">
                        <?php if($mb['url']!=''){?>
                            <?php if($mb['new_window'] == 1){?>
                                <a target="_blank" href="<?php echo $mb['url'];?>"></a>
                            <?php  }else{ ?>
                                <a href="<?php echo $mb['url'];?>"></a>
                            <?php }?>
                        <?php }?>
                        <?php if(!empty($mb['mobile_image'])){?>
                        <img class="lazyOwl" data-src="http://www.his.com/<?php echo $mb['mobile_image'];?>" src="" alt=""/>
                        <?php  }else{ ?>
                        <img class="lazyOwl" data-src="http://www.his.com/<?php echo $mb['main_image'];?>" src="" alt=""/>
                        <?php }?>
                        </div>
                    <?php $index++; ?><?php }?><?php endif;?>
				</div>
			</div>

		</div>
		<!-- //轮播 -->
		<div class="main_content">
			<div class="wrapper fix">
				<div class="left_content">
                <?php if(is_array($topLineListDataList)):?><?php $index=0; ?><?php  foreach($topLineListDataList as $k=>$topLineListData){ ?>
                    <?php if($webid=='6' and empty($topLineListData['currentLineList'])){?><?php continue;?><?php }?>
					<div class="travel_content">
						<div class="travel_tab">
							<dl class="fix">
								<dt>
									<a href="javascript:void(0);"><?php echo $topLineListData['kindname'];?>旅游</a>
								</dt>
								<dd>
									<ul class="fix">
										<li class="on"><a href="">精选</a></li>
                                        <?php if(is_array($topLineListData['hotdest'])):?><?php $index=0; ?><?php  foreach($topLineListData['hotdest'] as $key=>$hotdest){ ?>
                                            <?php if(count($topLineListData['hotDestLineList'][$key]['lineList']) > 0){?>
                                            <li><a href=""><?php echo $hotdest['kindname'];?></a></li>
                                            <?php }?>
                                        <?php $index++; ?><?php }?><?php endif;?>
									</ul>
								</dd>
							</dl>
							<a href="<?php echo getSearchUrl($topLineListData['id'],'dest_id');?>" class="more">更多 &gt;&gt;</a>
						</div>
						<div class="travel_list_content">                        	
							<div class="travel_list_detail">
								<ul class="travel_list">
                                <?php if(is_array($topLineListData['currentLineList'])):?><?php $index=0; ?><?php  foreach($topLineListData['currentLineList'] as $key=>$currentLineList){ ?>
									<li>
										<a href="<?php echo $urlroot;?>/lines/detail/<?php echo $currentLineList['id'];?>.html">
                                        	<?php if($currentLineList['iconshow']){?>
											<div class="tag_area">
												<ul class="fix">
                                                	<?php echo $currentLineList['iconshow'];?>
												</ul>
											</div>
                                            <?php }?>

											<span class="img">
                                            <?php if(empty($currentLineList['linepic'])){?>
                                                <img src="http://www.his.com/template/v1/common/images/300x168_default.jpg" width="300" height="168" alt=""/>
                                            <?php  }else{ ?>
                                                <img src="http://www.his.com/<?php echo $currentLineList['linepic'];?>" width="300" height="168" alt=""/>
                                            <?php }?>
                                            </span>
											<dl>
												<dt class="main_intro heightLine-<?php echo $k;?>">
                                                	<?php if($currentLineList['holiday']){?>
                                                	<span class="holiday">[<?php echo $currentLineList['holiday'];?>]</span> 
                                                    <?php }?>
                                                    <?php echo $currentLineList['linename'];?>
                                                </dt>
												<dd class="sec_intro"><?php echo $currentLineList['sellpoint'];?></dd>
												<dd class="date_intro">
                                                	<?php if($currentLineList['showattrs']){?>
													<ul class="fix t_tag_list">
                                                    	<?php echo $currentLineList['showattrs'];?>
													</ul>
                                                    <?php }?>
													<span class="branch_store">[<?php echo $currentLineList['shopname'];?>]</span>
												</dd>
												<dd class="price_intro">
													<span class="cmot"><?php echo $currentLineList['startcity'];?>出发</span>
                                                    <?php if($currentLineList['storeprice'] != '0'){?>
													<del class="org">¥<?php echo $currentLineList['storeprice'];?></del>
                                                    <?php }?>
													<?php echo $currentLineList['price'];?>
												</dd>
											</dl>
										</a>
									</li>
                            	<?php $index++; ?><?php }?><?php endif;?>
								</ul>
							</div>
                            <?php if(is_array($topLineListData['hotDestLineList'])):?><?php $index=0; ?><?php  foreach($topLineListData['hotDestLineList'] as $hotDestLine){ ?>
                                <?php if(count($hotDestLine['lineList']) > 0){?>
                                <div class="travel_list_detail">
                                    <ul class="travel_list">
                                    <?php if(is_array($hotDestLine['lineList'])):?><?php $index=0; ?><?php  foreach($hotDestLine['lineList'] as $key=>$line){ ?>
                                        <li>
                                            <a href="<?php echo $urlroot;?>/lines/detail/<?php echo $line['id'];?>.html">
                                        	<?php if($line['iconshow']){?>
											<div class="tag_area">
												<ul class="fix">
                                                	<?php echo $line['iconshow'];?>
												</ul>
											</div>
                                            <?php }?>

											<span class="img">
                                            <?php if(empty($line['linepic'])){?>
                                                <img src="http://www.his.com/template/v1/common/images/300x168_default.jpg" width="300" height="168" alt=""/>
                                            <?php  }else{ ?>
                                                <img src="http://www.his.com/<?php echo $line['linepic'];?>" width="300" height="168" alt=""/>
                                            <?php }?>
                                            </span>
											<dl>
												<dt class="main_intro heightLine-<?php echo $k;?>">
                                                	<?php if($line['holiday']){?>
                                                	<span class="holiday">[<?php echo $line['holiday'];?>]</span> 
                                                    <?php }?>
                                                    <?php echo $line['linename'];?>
                                                </dt>
												<dd class="sec_intro"><?php echo $line['sellpoint'];?></dd>
												<dd class="date_intro">
                                                	<?php if($currentLineList['showattrs']){?>
													<ul class="fix t_tag_list">
                                                    	<?php echo $line['showattrs'];?>
													</ul>
                                                    <?php }?>
													<span class="branch_store">[<?php echo $line['shopname'];?>]</span>
												</dd>
												<dd class="price_intro">
													<span class="cmot"><?php echo $line['startcity'];?>出发</span>
                                                    <?php if($line['storeprice'] != '0'){?>
													<del class="org">¥<?php echo $line['storeprice'];?></del>
                                                    <?php }?>
													<?php echo $line['price'];?>
												</dd>
											</dl>
										</a>
                                        </li>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    </ul>
                                </div>
                                <?php }?>
                            <?php $index++; ?><?php }?><?php endif;?>
						</div>
					</div>
				<?php $index++; ?><?php }?><?php endif;?>
				</div>
				<aside class="right_content">
                <?php if(count($newLineList) !='0'){?>
					<dl class="aside_adv">
						<dt>
							<span>最新路线</span>
							<ul class="new_course_fun fix">
								<li><a id="imp_prev" class="up " href="javascript:void(0);"></a></li>
								<li><a id="imp_next" class="down " href="javascript:void(0);"></a></li>
							</ul>
						</dt>
						<dd>
							<div class="new_course">
								<div id="new_course_detail" class="new_course_detail">    							    
    							    <ul>
                                    <?php if(is_array($newLineList)):?><?php $index=0; ?><?php  foreach($newLineList as $newLine){ ?>
                                        <li>
        									<a href="<?php echo $urlroot;?>/lines/detail/<?php echo $newLine['id'];?>.html">
        										<span class="img">
                                                    <?php if(empty($newLine['linepic'])){?>
                                                    <img src="http://www.his.com/template/v1/common/images/60x60_default.jpg" width="60" height="60" alt=""/>
                                                    <?php  }else{ ?>
                                                    <img src="http://www.his.com/<?php echo $newLine['linepic'];?>" width="60" height="60" alt=""/>
                                                    <?php }?>
                                                </span>
                                                <span class="txt"><?php echo mb_substr($newLine['linename'],0,20,'utf-8');?>...</span>
        										<span class="ico_new"></span>
        									</a>
            							</li>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    </ul>
								</div>
							</div>
						</dd>
					</dl>
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
				</aside>
			</div>
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
    <script src="http://www.his.com/template/v1/common/scripts/height-line.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/jsloader.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/owl.carousel.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/jq_scroll.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/vmc.slider.full.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/index.js" type="text/javascript"></script>
	
	<script>
		$(function(){
			navBannerOn(0);
		});
	</script>
</body>
</html>