<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8"/>
	<meta name="Description" content="<?php echo C("description");?>" />
	<meta name="keywords" content="<?php echo C("keywords");?>" />
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="Cache-Control" content="no-transform" />
	<meta name="applicable-device" content="pc,mobile"/>
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,minimum-scale=1,user-scalable=0;" />
	<title>japan_travel</title>
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
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/import.css"/>
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/list.css"/>
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/base2.css"/>
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/jquery.ad-gallery.css"/>
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/mobile.css"/>

	<!--[if lt IE 9]>
	<script src="http://www.his.com/template/v1/common/scripts/html5.js"></script>
	<script src="http://www.his.com/template/v1/common/scripts/respond.min.js"></script>
	<![endif]-->
</head>
<body id="japan_travel">
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
            <div class="wrapper" style="position: relative;">
				<!-- 路径 -->
				<div class="path">
					<a href="/">首页</a> &gt; <span class="stepnav">预订成功</span>
				</div>
				<!-- //路径 -->
				<div class="step_area">
					<ol class="fix">
						<li><div><i>1</i><span>填写订单</span></div></li>
						<li><div><i>2</i><span>确认订单</span></div></li>
						<li class="on"><div><i>3</i><span>预订成功</span></div></li>
					</ol>
					<span class="line"></span>
				</div>
            </div>
        </div>
        <div class="no_result" style="padding: 200px 0;">预约成功，等待客服联系</div>
	</div>
    
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
</body>
</html>