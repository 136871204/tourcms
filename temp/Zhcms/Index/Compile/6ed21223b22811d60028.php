<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
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
				<div class="wrapper fix">
					<!-- 路径 -->
						<div class="path">
							<a href="/">首页</a> <span><?php echo $pkname;?></span> <?php if($para1=='3'){?> &gt;<a href="<?php echo $urlroot;?>/lines/all-3-0-0-0-0-0-0-157">当地游</a><?php }?>
						</div>
						<!-- //路径 -->
					<!-- 左边 -->
					<div class="left_content">
						
						<!-- 筛选区域 -->
						<div class="filter_area">
							<div class="filter_area_main">
							<div class="one_filter">
								<span class="title">目的城市：</span>                                
                                <?php if(is_array($destlevel)):?><?php $index=0; ?><?php  foreach($destlevel as $key=>$dest){ ?>
                                    <?php if($key==1){?>
    								<ul class="fix ft_filter_line">
                                        <?php if($destid == 0){?>
    									<li class="on all">
                                        <?php  }else{ ?>
                                        <li class="all">
                                        <?php }?>
                                        <a href="<?php echo getSearchUrl(0,'dest_id');?>">全部</a></li>
                                        <?php if(is_array($dest)):?><?php $index=0; ?><?php  foreach($dest as $destt){ ?>
                                            <?php
                                            if(in_array($destt['id'],$tids)){
                                                ?>
                                                <li class="on">
                                                <?php
                                            }else{
                                                ?>
                                                <li>
                                                <?php
                                            }?>
                                            <a href="<?php echo getSearchUrl($destt['id'],'dest_id');?>"><?php echo $destt['kindname'];?></a></li>
                                        <?php $index++; ?><?php }?><?php endif;?>    
    								</ul>
                                    <?php  }elseif($key==2){ ?>
                                
    								<div class="sec_filter_line">
        								<ul class="fix">
                                        <?php if(is_array($dest)):?><?php $index=0; ?><?php  foreach($dest as $destt){ ?>                                
        									<?php
                                            if(in_array($destt['id'],$tids)){
                                                ?>
                                                <li class="on">
                                                <?php
                                            }else{
                                                ?>
                                                <li>
                                                <?php
                                            }?>
                                            <a href="<?php echo getSearchUrl($destt['id'],'dest_id');?>"><?php echo $destt['kindname'];?></a></li>
                                        <?php $index++; ?><?php }?><?php endif;?>
                                        </ul>
                                    </div>
                                    <?php  }elseif($key==3){ ?>
                                    
    								<div class="sec_filter_line">
        								<ul class="fix">
                                        <?php if(is_array($dest)):?><?php $index=0; ?><?php  foreach($dest as $destt){ ?>                                
        									<?php
                                            if(in_array($destt['id'],$tids)){
                                                ?>
                                                <li class="on">
                                                <?php
                                            }else{
                                                ?>
                                                <li>
                                                <?php
                                            }?>
                                            <a href="<?php echo getSearchUrl($destt['id'],'dest_id');?>"><?php echo $destt['kindname'];?></a></li>
                                        <?php $index++; ?><?php }?><?php endif;?>
                                        </ul>
                                    </div>
                                    
                                    <?php }?>
                                <?php $index++; ?><?php }?><?php endif;?>
                                <?php if(count($destlist) !='0'){?>
								<div class="third_filter_line">
								<ul class="fix">
                                <?php if(is_array($destlist)):?><?php $index=0; ?><?php  foreach($destlist as $destt){ ?>
                                    <?php
                                    if(in_array($destt['id'],$tids)){
                                        ?>
                                        <li class="on">
                                        <?php
                                    }else{
                                        ?>
                                        <li>
                                        <?php
                                    }?>
									<a href="<?php echo getSearchUrl($destt['id'],'dest_id');?>"><?php echo $destt['kindname'];?></a></li>
                                <?php $index++; ?><?php }?><?php endif;?>
                                </ul>
                                </div>
                                <?php }?>
									
								
							</div>
                            
                            <?php if(!empty($startplace)){?>
							<div class="one_filter">
								<span class="title">出发城市：</span>
								<ul class="fix">
                                    <?php if($_GET['startcity'] == 0){?>
                                    <li class="on all">
                                    <?php  }else{ ?>
                                    <li class="all">
                                    <?php }?>
									<a href="<?php echo getSearchUrl(0,'startcity');?>">全部</a></li>
                                    <?php if(is_array($startplace)):?><?php $index=0; ?><?php  foreach($startplace as $start){ ?>
                                        <?php if($_GET['startcity'] == $start['id']){?>
                                            <li class="on">
                                        <?php  }else{ ?>
                                            <li>
                                        <?php }?>
                                        <a  href="<?php echo getSearchUrl($start['id'],'startcity');?>"><?php echo $start['cityname'];?></a></li>
                                    <?php $index++; ?><?php }?><?php endif;?>                                    
								</ul>
							</div>
                            <?php }?>
                            
                            <?php if(!empty($dayResult)){?>
							<div class="one_filter more_filter_area">
								<span class="title">行程天数：</span>
								<ul class="fix">
                                    <?php if($_GET['day'] == 0){?>
                                    <li class="on all">
                                    <?php  }else{ ?>
                                    <li class="all">
                                    <?php }?>
									<a href="<?php echo getSearchUrl(0,'day');?>">全部</a></li>
                                    <?php if(is_array($dayResult)):?><?php $index=0; ?><?php  foreach($dayResult as $dayD){ ?>
                                        <?php if($_GET['day'] == $dayD['word']){?>
                                        <li class="on">
                                        <?php  }else{ ?>
                                        <li>
                                        <?php }?>
                                        <a href="<?php echo getSearchUrl($dayD['word'],'day');?>"><?php echo $dayD['title'];?></a></li>
                                    <?php $index++; ?><?php }?><?php endif;?>
								</ul>
							</div>
                            <?php }?>
                            
                            <div class="l_more_filter_area">
                            <?php if(is_array($attrGroupList)):?><?php $index=0; ?><?php  foreach($attrGroupList as $attrGroup){ ?>
                            <?php if(!empty($attrGroup['attrList'])){?>
                            <div class="one_filter">
								<span class="title"><?php echo $attrGroup['groupname'];?>：</span>
								<ul class="fix">
                                    <?php
                                    $attrids=$attrid;
                                    $attridArr=explode('_',$attrids);
                                    //p($attridArr);
                                    ?>
                                    <?php if($attrid == 0){?>
                                        <li class="on all">
                                    <?php  }else{ ?>
                                        <li class="all">
                                    <?php }?>
                                    <a href="<?php echo getSearchUrl(null,null,$attrGroup['attrid']);?>">全部</a></li>
                                    <?php if(is_array($attrGroup['attrList'])):?><?php $index=0; ?><?php  foreach($attrGroup['attrList'] as $attrD){ ?>
									<?php 
                                    
                                    if(in_array($attrD['attrid'],$attridArr)){
                                        ?>
                                        <li  class="on">
                                        <?php
                                    }else{
                                        ?>
                                        <li>
                                        <?php
                                    }
                                    ?>
									<a href="<?php echo getSearchUrl($attrD['attrid'],'attrid');?>"><?php echo $attrD['attrname'];?></a></li>
                                    <?php $index++; ?><?php }?><?php endif;?>
								</ul>
							</div>
                            <?php }?>
                            <?php $index++; ?><?php }?><?php endif;?>
                            
                            <?php if(!empty($priceResult)){?>
							<div class="one_filter">
								<span class="title">价格区间：</span>
								<ul class="fix">
                                    <?php if($_GET['priceid'] == 0){?>
									<li class="on all">
                                    <?php  }else{ ?>
                                    <li class="all">
                                    <?php }?>
                                    <a href="<?php echo getSearchUrl(0,'priceid');?>">全部</a></li>
                                    <?php if(is_array($priceResult)):?><?php $index=0; ?><?php  foreach($priceResult as $priceD){ ?>
                                        <?php if($_GET['priceid'] == $priceD['id']){?>
                                            <li class="on"  >
                                        <?php  }else{ ?>
                                            <li>
                                        <?php }?>
                                        <a href="<?php echo getSearchUrl($priceD['id'],'priceid');?>"><?php echo $priceD['title'];?></a></li>
                                    <?php $index++; ?><?php }?><?php endif;?>
								</ul>
							</div>
                            <?php }?>                            
                            </div>
								<a class="spread_list_filter on" href="javascript:void(0);">
									<span class="offtxt">展开更多筛选条件</span>
									<span class="ontxt">点击收起筛选条件</span>
								</a>
                            </div>
							<div class="final_filter">
								<span class="result"><strong><?php echo $count;?></strong> 条结果</span>
								<div class="result_select">
                                    <span class="close_all_btn"><a href="javascript:;" onclick="clearcondition();">清除条件</a></span>
									<span>您已经选择：</span>
									<div class="result_selected fix">
										<!-- <span>目的城市：东京<a href="javascript:void(0);"></a></span> -->
									</div>
								</div>
							</div>
							
						</div>
						<!-- //筛选区域 -->
						<!-- 排序区域 -->
						<div class="sort_area fix list_nav">
                            <a class="on" href="javascript:void(0);"  data-value="0" >综合</a>
							<a href="javascript:void(0);" data-value="1">推荐</a>
                            <?php if($sorttype=='2'){?>
                            <a id="prize_sort" class="prize down" href="javascript:void(0);" data-value="5">价格</a>
                            <?php  }elseif($sorttype=='5'){ ?>
                            <a id="prize_sort" class="prize up" href="javascript:void(0);" data-value="2">价格</a>
                            <?php  }else{ ?>
                            <a id="prize_sort" class="prize" href="javascript:void(0);" data-value="2">价格</a>
                            <?php }?>
							
							<a href="javascript:void(0);" data-value="3">销量</a>
							<a href="javascript:void(0);" data-value="4">人气</a>
						</div>
						<!-- //排序区域 -->
						<!-- 列表内容 -->
                        <?php if(count($lineList)!='0'){?>
						<div class="travel_list">
                            <?php if(is_array($lineList)):?><?php $index=0; ?><?php  foreach($lineList as $lineD){ ?>
                            <div class="travel_one">
								<div class="img">
                                    <?php if(empty($lineD['linepic'])){?>
                                        <img src="http://www.his.com/template/v1/common/images/210x118_default.jpg" width="210" height="118" alt=""/>
                                    <?php  }else{ ?>
                                        <img src="http://www.his.com/<?php echo $lineD['linepic'];?>" width="210" height="118" alt=""/>
                                    <?php }?>
                                    <ul class="fix">
                                        <?php echo $lineD['iconshow'];?>
                                    </ul>					
								</div>
								<div class="content">
									<div class="intro">
										<div class="main_intro">
                                            <?php if($lineD['holiday']!=''){?>
                                            <span class="holiday">[<?php echo $lineD['holiday'];?>]</span>
                                            <?php }?>
                                            <strong><?php echo $lineD['title'];?></strong>
                                            
										</div>
										<p class="date_intro"><span class="green"><?php echo $lineD['startcity'];?>出发</span> 出团日期：<?php echo $lineD['maxmindateshow'];?>  </p>
										<p class="sec_intro"><strong>特色：</strong><?php echo $lineD['sellpoint'];?></p>
										<p class="tag_intro">
											<ul class="fix t_tag_list">
                                                <?php echo $lineD['showattrs'];?>
											</ul>
										</p>
									</div>
									<div class="price">
                                        <?php echo $lineD['price'];?>
										<a class="btn_02" href="<?php echo $urlroot;?>/lines/detail/<?php echo $lineD['id'];?>.html">查看详情</a>
									</div>
								</div>
							</div>
                            <?php $index++; ?><?php }?><?php endif;?>
                        </div>
						<!-- //列表内容 -->
						<!-- 分页 -->
						<div class="page fix">
							<?php echo $page;?>
						</div>
						<!-- //分页 -->
                    <?php  }else{ ?>
                        <div class="list_no_result">非常抱歉，暂时没有开通相关的旅游线路！推荐一下</div>
                        <?php if(count($linelist_tj)!='0'){?>
                        <div class="travel_list">
                            <?php if(is_array($linelist_tj)):?><?php $index=0; ?><?php  foreach($linelist_tj as $lineD){ ?>
                            <div class="travel_one">
								<div class="img">
                                    <?php if(empty($lineD['linepic'])){?>
                                        <img src="http://www.his.com/template/v1/common/images/210x118_default.jpg" width="210" height="118" alt=""/>
                                    <?php  }else{ ?>
                                        <img src="http://www.his.com/<?php echo $lineD['linepic'];?>" width="210" height="118" alt=""/>
                                    <?php }?>									
								</div>
								<div class="content">
									<div class="intro">
										<div class="main_intro">
                                            <?php if($lineD['holiday']!=''){?>
                                            <span class="holiday">[<?php echo $lineD['holiday'];?>]</span>
                                            <?php }?>
                                            <strong><?php echo $lineD['title'];?></strong>
                                            <ul class="fix">
                                                <?php echo $lineD['iconshow'];?>
											</ul>
										</div>
										<p class="date_intro"><span class="green"><?php echo $lineD['startcity'];?>出发</span> 出团日期：<?php echo $lineD['maxmindateshow'];?>  </p>
										<p class="sec_intro"><strong>特色：</strong><?php echo $lineD['sellpoint'];?></p>
										<p class="tag_intro">
											<ul class="fix t_tag_list">
                                                <?php echo $lineD['showattrs'];?>
											</ul>
										</p>
									</div>
									<div class="price">
                                        <?php echo $lineD['price'];?>
										<a class="btn_02" href="<?php echo $urlroot;?>/lines/detail/<?php echo $lineD['id'];?>.html">查看详情</a>
									</div>
								</div>
							</div>
                            <?php $index++; ?><?php }?><?php endif;?>
                        </div>
                        <?php }?>                    
                    <?php }?>
					</div>
					<!-- //左边 -->
					<!-- 右边 -->                    
					<aside class="right_content">
                        <?php if(!empty($hotLineList)){?>
						<div class="travel_list_right">
							<dl>
								<dt>热门线路</dt>
                                <?php if(is_array($hotLineList)):?><?php $index=0; ?><?php  foreach($hotLineList as $hlineD){ ?>
                                <dd>
									<a href="<?php echo $urlroot;?>/lines/detail/<?php echo $hlineD['id'];?>.html">
										<span class="img">
                                            <?php if(empty($hlineD['linepic'])){?>
                                                <img src="http://www.his.com/template/v1/common/images/240x135_default.jpg" width="210" height="118" alt=""/>
                                            <?php  }else{ ?>
                                                <img src="http://www.his.com/<?php echo $hlineD['linepic'];?>" width="210" height="118" alt=""/>
                                            <?php }?>
                                        </span>
										<p class="intro"><?php echo mb_substr($hlineD['title'],0,16,'utf-8');?>...</p>
										<p class="sec_intro"><?php echo mb_substr($hlineD['sellpoint'],0,38,'utf-8');?>...</p>
										<div class="price">
											<span class="price_go"><?php echo $hlineD['startcity'];?>出发</span>
											<span class="price_show"><?php echo $hlineD['price'];?></span>
                                        </div>
									</a>
								</dd>
								<?php $index++; ?><?php }?><?php endif;?>
							</dl>
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
					</aside>
					<!-- //右边 -->
				</div>
			</div>
    <input type="hidden" id="para1" value="<?php echo $para1;?>"/>
    <input type="hidden" id="destid" value="<?php echo $destid;?>"/>
    <input type="hidden" id="attrid" value="<?php echo $attrid;?>" />
    <input type="hidden" id="priceid" value="<?php echo $priceid;?>" />
    <input type="hidden" id="day" value="<?php echo $day;?>" />
    <input type="hidden" id="sorttype" value="<?php echo $sorttype;?>"/>
    <input type="hidden" id="pinyin" value=""/>
    <input type="hidden" id="startcity" value="<?php echo $startcity;?>" />
    <input type="hidden" id="keyword" value=""/>

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
	<script src="http://www.his.com/template/v1/common/scripts/list.js" type="text/javascript"></script>
	<script src="http://www.his.com/template/v1/common/scripts/jquery.blockLink.js" type="text/javascript"></script>
	<script>
		$(function(){
		  
		    //js加link
            $('.travel_list > div.travel_one').blockLink();          
            
            var webid = '<?php echo $webid;?>';
            var param = '<?php echo $_GET['para1']; ?>';
            if( webid == '6'){
                if(param == '3')
                var param = '2';
            }
			navBannerOn(param);
            
            var startcity =$("#startcity").val();
            var para1=$("#para1").val();
            var day =$("#day").val();
            var priceid =$("#priceid").val();
            var attrid = $("#attrid").val();
            var sorttype = $("#sorttype").val();
            var destid = $("#destid").val();
            
            //目的地天数选中
            //search_item_selected("#destid_list","li",destid,'on');
            //线路天数选中
            //search_item_selected("#day_list","li",day,'on');
            //线路属性选中
            var attrArr = attrid.split('_');
            for(i=0;i<attrArr.length;i++)
            {
        	 
 	         //search_attr_selected(".attr_list","li",attrArr[i],'on'); 
            }
            //价格范围选中
            //search_item_selected("#price_list","li",priceid,'on');
            //出发地选中
            //search_item_selected("#startcity_list","li",startcity,'on');
            
            //排序状态选中
           $(".list_nav a").each(function(){
              var datavalue = $(this).attr('data-value');
        	  if(datavalue == sorttype){        	  
        	    $(this).addClass('on');
        	  }
        	  else{
        	    $(this).removeClass('on');
        	  }
           
           })
            
            //排序筛选
        	$(".list_nav a").click(function(){

        	   $(this).parent('div').find('a').removeClass('on');
        	   $(this).addClass('on');
        	   $("#sorttype").val($(this).attr('data-value'));
        	   Line.doSearch();
        	
        	})
		});
	</script>
    <script>
    var siteUrl = 'http://www.his.com';
    var urlroot = '<?php echo $urlroot;?>';
    var Line={
        doSearch:function(){
            var attrid=$("#attrid").val();
            var priceid=$("#priceid").val();
            var destid=$("#destid").val();
            var para1=$("#para1").val();
            var day = $("#day").val();
            var sorttype = $("#sorttype").val();
            var keyword = $("#keyword").val();
            var pinyin = $("#pinyin").val();
            var startcity = $("#startcity").val();
            keyword = keyword == '请输入目的地或线路名称' ? 0 : keyword;
            keyword = keyword==''  ? 0 : keyword;
            pinyin = pinyin=='' ? destid : pinyin;
            pinyin = pinyin==0 ? 'all' : pinyin;
            var url = siteUrl+urlroot+"/lines/"+pinyin+"-"+para1+"-0-"+day+"-"+priceid+"-"+sorttype+"-"+keyword+'-'+startcity+'-'+attrid;
            window.open(url,'_self');
            
        }
        
    }

    
    function  search_item_selected(contain,tag,realvalue,class1){
        var find = 0;
        $(contain).find(tag).each(function(){
				var datavalue = $(this).attr('data-value');
               // alert(datavalue);
				$(this).removeClass(class1);
				if(datavalue == realvalue) {
					$(this).addClass(class1)
                    find = 1;
				}
			
			})
            if(find==0){
                $(contain).find(tag).first().addClass(class1);
            }
            
    }
    
    function search_attr_selected(contain,tag,realvalue,class1){
        $(contain).each(function(){
			   $(this).find(tag).each(function(){
			        var datavalue = $(this).attr('data-value');
					
					if(datavalue == realvalue && realvalue!=0) {
						$('li:first',$(this).parent()).removeClass(class1);
						$(this).addClass(class1)
					}
			   
			   })
		        
		 
		 })
    }
    
    //条件清除
    function clearcondition(){
        var gourl = $(".ft_filter_line .all a").attr("href");
        window.location = gourl;
    }
    </script>
</body>
</html>