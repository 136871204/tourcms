<!DOCTYPE html>
<html>
<head>
    <title>EC演示</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/article-list.css?ver=1.0"/>
    <zhcms/>
    <link href="__STATIC__/ecimage/themes/default/style.css" rel="stylesheet" type="text/css" />
    <script src='__STATIC__/js/utils.js'></script>
        <script src='__STATIC__/js/transport.js'></script>
</head>
<body>

<script type="text/javascript">
var process_request = "正在处理您的请求...";
</script>
<div class="block clearfix">
    <div class="f_l"><a href="{|U:'ec/index/index'}" name="top"><img src="__STATIC__/ecimage/themes/default/images/logo.gif" /></a></div>
    <div class="f_r log">
        <ul>
        <li class="userInfo">
             <font id="ECS_MEMBERZONE">
                <div id="append_parent"></div>
                <if value="$user_info">
                    <font style="position:relative; top:10px;">
                    TODO:有会员的情况
                    </font>
                <else>
                    欢迎光临本店&nbsp;&nbsp;&nbsp;&nbsp;
                     <a href="user.php"><img src="__STATIC__/ecimage/themes/default/images/bnt_log.gif" /></a>
                     <a href="user.php?act=register"><img src="__STATIC__/ecimage/themes/default/images/bnt_reg.gif" /></a>
                </if>
             </font>
        </li>
        <if value="$navigator_list.top">
        <li id="topNav" class="clearfix">
            <foreach from="$navigator_list.top" value="$nav" >
                <a href="{$nav.url}" <if value='$nav.opennew eq 1'> target="_blank" </if>>{$nav.name}</a>|
            </foreach>
            
        </li>
        </if>
        </ul>
    </div>
</div>
<div  class="blank"></div>
<div id="mainNav" class="clearfix">
    <a href="{|U:'ec/index/index'}"<if value='$navigator_list.config.index eq 1'> class="cur"</if> >首页<span></span></a>
    <foreach from="$navigator_list.middle" value="$nav" >
        <a href="{$nav.url}" <if value='$nav.opennew eq 1'> target="_blank" </if> <if value='$nav.active eq 1'> class="cur"</if>>{$nav.name}<span></span></a>
    </foreach>
</div>
<!--search start-->
<div id="search"  class="clearfix">
    <div class="keys f_l">
        <script type="text/javascript">
            function checkSearchForm()
            {
                if(document.getElementById('keyword').value)
                {
                    return true;
                }
                else{
                    alert("请输入搜索关键词！");
                    return false;
                }
            }
        </script>
         <if value='$searchkeywords'>
         热门搜索：TODO：没有做
         </if>
         
    </div>
    <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()" class="f_r"  style="_position:relative; top:5px;">
        <select name="category" id="category" class="B_input">
            <option value="0">所有分类</option>
            {$category_list}
        </select>
        <input name="keywords" type="text" id="keyword" value="{$search_keywords|htmlspecialchars:@@}" class="B_input" style="width:110px;" />
        <input name="imageField" type="submit" value="" class="go" style="cursor:pointer;" />
        <a href="search.php?act=advanced_search">高级搜索</a>
    </form>
         
</div>
<!--search end-->

<div class="blank"></div>
<div class="block clearfix">
    <!--left start-->
  <div class="AreaL">
    <!--站内公告 start-->
    <div class="box">
        <div class="box_1">
            <h3><span>商店公告</span></h3>
            <div class="boxCenterList RelaArticle">
                {$shop_notice}
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    <!--站内公告 end-->
    <div class="cart" id="ECS_CARTINFO">
    <?php 
    echo insert_cart_info();
    ?>
    </div>
    <div class="blank5"></div>
    
    <div class="box">
        <div class="box_1">
            <div id="category_tree">
                <foreach from="$categories" value="$cat" >
                <dl>
                    <dt><a href="{$cat.url}">{$cat.name|htmlspecialchars:@@}</a></dt>
                    <foreach from="$cat.cat_id" value="$child" >
                    <dd><a href="{$child.url}">{$child.name|htmlspecialchars:@@}</a></dd>
                        <foreach from="$child.cat_id" value="$childer" >
                        <dd>&nbsp;&nbsp;<a href="{$childer.url}">{$childer.name|htmlspecialchars:@@}</a></dd>
                        </foreach>
                    </foreach>
                </dl>
                </foreach>
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    
    <div class="box">
        <div class="box_2">
            <div class="top10Tit"></div>
            <div class="top10List clearfix">
                <foreach from="$top_goods" value="$goods" key="$key" >
                <ul class="clearfix">
               	    <img src="__STATIC__/ecimage/themes/default/images/top_<?php echo $key+1;?>.gif" class="iteration" />
                    <if value="$key lt 3">
                        <li class="topimg">
                            <a href="{$goods.url}">
                                <img src="__ROOT__/upload/ec/{$goods.thumb}" alt="{$goods.name|htmlspecialchars:@@}" class="samllimg" />
                            </a>
                        </li>
                    </if>
                    <li <if value="$key lt 3">class="iteration1"</if> >
                        <a href="{$goods.url}" title="{$goods.name|htmlspecialchars:@@}">{$goods.short_name}</a><br />
                        本店售价：<font class="f1">{$goods.price}</font><br />
                    </li>
                </ul>
                </foreach>
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    
    <if value="$promotion_info">
    TODO:促销信息
    <div class="blank5"></div>
    </if>
    
    <if value="empty($order_query)">
    <script>var invalid_order_sn = "无效订单号"</script>
    <div class="box">
        <div class="box_1">
            <h3><span>订单查询</span></h3>
            <div class="boxCenterList">
                <form name="ecsOrderQuery">
                    <input type="text" name="order_sn" class="inputBg" /><br />
                    <div class="blank5"></div>
                    <input type="button" value="查询该订单号" class="bnt_blue_2" onclick="orderQuery()" />
                </form>
                <div id="ECS_ORDER_QUERY" style="margin-top:8px;">
                </div>
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    </if>
    
    <if value="$invoice_list">
    <style type="text/css">
    .boxCenterList form{display:inline;}
    .boxCenterList form a{color:#404040; text-decoration:underline;}
    </style>
    <div class="box">
        <div class="box_1">
            <h3><span>发货查询</span></h3>
            <div class="boxCenterList">
            <foreach from="$invoice_list" value="$invoice" >
            订单号 {$invoice.order_sn}<br />
            发货单 {$invoice.invoice_no}
            <div class="blank"></div>
            </foreach>
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    </if>
    
    <?php 
    echo insert_vote();
    ?>
    
    <div class="box">
        <div class="box_1">
            <h3><span>邮件订阅</span></h3>
            <div class="boxCenterList RelaArticle">
                <input type="text" id="user_email" class="inputBg" /><br />
                <div class="blank5"></div>
                <input type="button" class="bnt_blue" value="订阅" onclick="add_email_list();" />
                <input type="button" class="bnt_bonus"  value="退订" onclick="cancel_email_list();" />
            </div>
        </div>
    </div>
    <div class="blank5"></div>
    <script type="text/javascript">
    </script>
  </div>
  <!--left end-->
  
  <!--right start-->
  <div class="AreaR">
    <!--焦点图和站内快讯 START-->
    <div class="box clearfix">
        <div class="box_1 clearfix">
            <div class="f_l" id="focus">
            <if value="$index_ad eq 'sys'">
            <script type="text/javascript">
              var swf_width=484;
              var swf_height=200;
              
              
              </script>
              <script type="text/javascript" src="__ROOT__/data/flashdata/default/cycle_image.js"></script>
            </if>
            </div>
            <!--news-->
            <div id="mallNews" class="f_r">
                <div class="NewsTit"></div>
                <div class="NewsList tc">
                    <ul>
                    <foreach from="$new_articles" value="$article" >
                      <li>
                    	[<a href="{$article.cat_url}">{$article.cat_name}</a>] <a href="{$article.url}" title="{$article.title}">{$article.short_title|ec_sub_str:@@,10,true}</a>
                    	</li>
                    </foreach>
                    </ul>
                </div>
            </div>
            <!--news end-->
        </div>
    </div>
    <div class="blank5"></div>
    <!--焦点图和站内快讯 END-->
    
    
    <!--今日特价，品牌 start-->
    <div class="clearfix">
        <!--特价-->
        <!--品牌-->
        <div class="box f_r brandsIe6">
            <div class="box_1 clearfix" id="brands">
            </div>
        </div>
    </div>
    
  </div>
  
  
  
</div>

</body>
</html>