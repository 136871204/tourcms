<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="utf-8">
<title><% $product.product_name %>_<% $product.product_show_name %>_产品一览_骏河精机科技(上海)有限公司_骏河精机</title>
<!-- +++ local-meta +++ -->
<meta name="keywords" content="光学平台,调整平台,滑台,平移台,调整架,位移台,角位台,駿河精機,骏河精机,直线运动滑台,高精度滑台,直线滚珠导轨,水平面Z滑台,测角仪滑台,旋转滑台,测角仪,自动滑台,手动滑台,丝路咖精机">
<meta name="description" content="自动滑台 骏河精机科技是一家精密定位机电产品的领先制造商。确立了从生产到销售的一整套完备体系。对于来自工程师们的选型咨询以及售后支持，我们提供着全面周到的贴心服务。">
<meta name="author" content="">
<meta name="robots" content="index,follow,noodp,noydir">
<!-- +++ /local-meta +++ -->
<link href="/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link type="text/css" rel="stylesheet" href="/common/css/import.css">
<script type="text/javascript" src="/common/scripts/jsloader.js"></script>
<script type="text/javascript" src="/common/scripts/colorbox.js"></script>
<script type="text/javascript" src="/common/scripts/colorbox_set.js"></script>
<link type="text/css" rel="stylesheet" href="/common/css/colorbox.css">
<script>


</script>
<!--[if IE]>
<script src="/common/scripts/html5.js"></script>
<style type="text/css">
.pie{behavior:url(/common/scripts/PIE.htc);}
</style>
<![endif]-->
</head>
<body id="products">
<input type="hidden" id="pid" value="<% $vars.pid %>" />
<input type="hidden" id="cid" value="<% $vars.cid %>" />
<input type="hidden" id="ms" value="<% $vars.ms %>" />
<input type="hidden" id="sid" value="<% $vars.sid %>" />
<!-- Header Start -->
<% include_php file ="../../common/inc/header.lbi" %>
<% include_php file ="../../common/inc/navi.lbi" %>
<!--#include virtual="/common/inc/header.lbi"-->
<!--#include virtual="/common/inc/navi.lbi"-->
<!-- //Header End -->
<!--Contents start-->
<div id="contents">
  <div class="mainImg">
    <h2><span>产品一览</span></h2>
  </div>
  <div id="panel">
    <nav class="breadcrumbs"><a href="/">首页</a> &gt; <a href="/products">产品一览</a> &gt; <a href="/products/list/">精密定位滑台</a> &gt; <a href="/products/list/medium.php?cid=<% $vars.cid %>&ms=<% $vars.ms %>"><% $vars.tempproductclass %>(<% $vars.tempmovestyle %>)</a> &gt; 
    <a href="/products/list/small.php?cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>"><% $series.product_series_name %></a> &gt; <% $product.product_name %></nav>
    <div class="main">
      <h3 class="cmTtl"><strong><% $product.product_name %> 　　<% $product.product_show_name %></strong></h3>
      <%if $product.finish_flg == "1"%><p class="tRightMt"><img src="/common/images/dis_icon.gif" width="43" height="18" /></p><%/if%>
      <div class="productDetailedImg">
        <ul class="fix" >
        <li style="float: left;" ><img src="/common/tu-2/<% $product.product_big_img %>" width="268" alt=""/><br /><% $product.product_img_explain %></li>
        <% if $vars.appearance_size_imgmark == "1"%>
        <li style="float: left;" ><a href="javascript:;" class='colorboxInline' rel="#inline_example3"><img src="/common/tu-3/<% $product.appearance_size_img %>" width="250" alt=""/></a><br /><br /></li>
            <div class="disNone">
                <div id="inline_example3">
                    <p><img src="/common/tu-3/<% $product.appearance_size_img %>" alt=""></p>
                </div>
            </div> 
        <% else %>
        <li style="float: left;" ><a href="/contact/" target="_blank"><img src="/products/images/no_appearance_size_img.jpg" width="268" alt=""/></a></li>
        <% /if %>
        </ul>
        </div>
        
        <ul class="productcad">
            <li>CAD下载:</li>
        <% if $product.cad_img_2d == "1" %>
            <% if $memberlogin == "" %>
                <li><a onclick="javascript:alert('获取CAD需要登录会员');"><img src="../images/contact_2d.gif" alt="2D咨询"/></a></li>
            <% else %>
                <li><a href="/contact/" target="_blank"><img src="../images/contact_2d.gif" alt="2D咨询"/></a></li>
            <% /if %>
        <% else %>
            <% if $memberlogin == "" %>
                <li><a onclick="javascript:alert('登录会员即可免费下载');"><img src="../images/list_cad2d.gif" alt="2D咨询"/></a></li>
            <% else %>
                <li><a href="/common/cad2d_img/<%$product.cad_img_2d%>" onclick="recorddownload('3','<% $product.product_name %>');" target="_blank"><img src="../images/list_cad2d.gif" alt="2D下载"/></a></li>
            <% /if %>
        <% /if %>
        
        <% if $product.cad_img_3d == "1" %>
            <% if $memberlogin == "" %>
                <li><a onclick="javascript:alert('获取CAD需要登录会员');"><img src="../images/contact_3d.gif" alt="3D咨询"/></a></li>
            <% else %>
                <li><a href="/contact/" target="_blank"><img src="../images/contact_3d.gif" alt="3D咨询"/></a></li>
            <% /if %>
        <% else %>
            <% if $memberlogin == "" %>
                <li><a onclick="javascript:alert('登录会员即可免费下载');"><img src="../images/list_cad3d.gif" alt="3D下载"/></a></li>
            <% else %>
                <li><a href="/common/cad3d_img/<%$product.cad_img_3d%>" onclick="recorddownload('4','<% $product.product_name %>');" target="_blank"><img src="../images/list_cad3d.gif" alt="3D下载"/></a></li>
            <% /if %>
        <% /if %>
        </ul>

      <ul class="tableStyle2 fix">
        <li class="on"><a href="#">SPEC</a></li>
        <% if $vars.cid == "1" %>
        <li><a href="/products/list/small/<% $series.htmlfile %>" target="_blank">电气规格</a></li>
        <li><a href="/products/list/small/tj.php" target="_blank">推荐控制</a></li>
        <% /if %>
      </ul>
      <ul class="productOperating">
        <li class="comparebtnshow">
        <% if $compareflg=='0' %>
        <a onClick="compare('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=add');">
        <img width="110" height="29" src="../images/list_btn01.gif" alt=""/>
        </a>
        <% else %>
        <a onClick="compare('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=delete');">
        <img src="../images/list_btn02.gif" alt=""/>
        </a>
        <% /if %>
        </li>
    <% if $product.finish_flg == "1" %>
        <!--<li class="cardbtnshow">
            <img src="../images/list_btn03_dis.gif" alt=""/>
        </li>-->
    <% else %>
        <li class="cardbtnshow">
        <% if $cardcompareflg=='0' %>
        <a onClick="card('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=add');">
        <img width="110" height="29" src="../images/list_btn03.gif" alt=""/>
        </a>
        <% else %>
        <a onClick="card('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=delete');">
        <img width="110" height="29" src="../images/list_btn04.gif" alt=""/>
        </a>
        <% /if %>
        </li>
     <%/if%>
    <% if $memberlogin == "" %>
        <li><a onclick="unlogin2();"><img alt="产品咨询" src="../images/list_consult.gif" /></a></li>
    <% else %>
		<li><a href="/contact/product.php?pn=<%$product.product_name%>" target="_blank"><img alt="产品咨询" src="../images/list_consult.gif" /></a></li>
    <% /if %>
        
      </ul>
      <div class="productData">
        <table width="100%" border="1" cellspacing="0" cellpadding="0">
        <%foreach from=$productshowlists key=k item=value name=product_foo%>
          <% if $smarty.foreach.product_foo.index%2==0%> 
          <tr class="tableStyle3">
          <% else %>
          <tr class="tableStyle4">
          <% /if %>
            <th><%re_list_name list=$lists.test value=$k%></th>
            <td><% $value %></td>
          </tr>
        <% /foreach%>
        </table>
      </div>
      <ul class="tableStyle2 fix">
        <li class="on"><a href="#">SPEC</a></li>
        <% if $vars.cid == "1" %>
        <li><a href="/products/list/small/<% $series.htmlfile %>" target="_blank">电气规格</a></li>
        <li><a href="/products/list/small/tj.php" target="_blank">推荐控制</a></li>
        <% /if %>
      </ul>
      <ul class="productOperating mB20">
        <li class="comparebtnshow">
        <% if $compareflg=='0' %>
        <a onClick="compare('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=add');">
        <img width="110" height="29" src="../images/list_btn01.gif" alt=""/>
        </a>
        <% else %>
        <a onClick="compare('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=delete');">
        <img width="110" height="29" src="../images/list_btn02.gif" alt=""/>
        </a>
        <% /if %>
        </li>
    
    <% if $product.finish_flg == "1" %>
        <!--<li class="cardbtnshow">
            <img src="../images/list_btn03_dis.gif" alt=""/>
        </li>-->
    <% else %>
        <li class="cardbtnshow">
        <% if $cardcompareflg=='0' %>
        <a onClick="card('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=add');">
        <img width="110" height="29" src="../images/list_btn03.gif" alt=""/>
        </a>
        <% else %>
        <a onClick="card('cid=<% $vars.cid %>&ms=<% $vars.ms %>&sid=<% $vars.sid %>&pid=<% $vars.pid %>&mode=delete');">
        <img width="110" height="29" src="../images/list_btn04.gif" alt=""/>
        </a>
        <% /if %>
        </li>
     <%/if%>
    <% if $memberlogin == "" %>
        <li><a onclick="unlogin2();"><img alt="产品咨询" src="../images/list_consult.gif" /></a></li>
    <% else %>
		<li><a href="/contact/product.php?pn=<%$product.product_name%>" target="_blank"><img alt="产品咨询" src="../images/list_consult.gif" /></a></li>
    <% /if %>
      </ul>
      
        <% if $vars.cid == "1" %>
        <p class="mB20">超出记载台数，可以以短纳期方式对应，请与我们联系。</p>
        <% /if %>
		<p class="tCenter"><a href="/products/list/small.php?cid=<%$vars.cid%>&ms=<%$vars.ms%>&sid=<%$vars.sid%>"><img alt="返回一览" src="/common/images/btn_question01.gif"/></a></p>
    </div>
    <!-- //main End -->
    <aside class="sideInfo">
      
      <% include_php file ="../../common/inc/left_navi.lbi" %>
      <!-- //localNavi End -->
      <% include_php file ="../../common/inc/search.lbi" %>
      <!--#include virtual="/common/inc/ad.lbi"-->
    </aside>
    <!-- //sideInfo End -->
  </div>
  <!-- //pandel End -->
</div>
<!-- //Contents End -->
<!-- Footer Start -->
<% include_php file ="../../common/inc/footer.lbi" %>
<!--#include virtual="/common/inc/footer.lbi"-->
<!-- //Footer End -->
<script type="text/javascript" src="/common/scripts/ga.js"></script>
<script type="text/javascript" src="/common/scripts/suruga.js"></script>

<%php%>
if( RUN_MODE == "local" || RUN_MODE == "honban"){
<%/php%>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-THZ7TM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-THZ7TM');</script>
<!-- End Google Tag Manager -->
<%php%>
}
<%/php%>
</body>
</html>

