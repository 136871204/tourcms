<!DOCTYPE html>
<html>
<head>
    <title>私のカード</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/favorite.css?ver=1.0"/>
    <zhcms/>
</head>
<body>
<load file="__TPL__/Public/block/top_menu.php"/>
<article class="center-block main">
    <!--左侧导航start-->
    <load file="__TPL__/Public/block/left_menu.php"/>
    <!--左侧导航end-->
    <section class="article">
        <header>
            <h2>
                私のカード
                <span>({$count})</span>
            </h2>
        </header>
        <ul>
            <list from="$data" name="d">
                <li>
                    <div class="article" style="width: 680px;">
                    	<a href='javascript:;'  onclick="zh_ajax('{|U:'del'}',{fid:{$d.fid}})" style="float: right">削除</a>
                        <a href="{|U:'Index/Index/content',array(mid=>$d['mid'],cid=>$d['cid'],aid=>$d['aid'])}" target="_blank" class="title">
                            {$d.content.title}
                        </a>
                        <a  target="_blank" href="<?php echo Url::getCategoryUrl($d);?>" class="category">
                            {$d.catname}
                        </a>
                    <span class="time">
                        {$d.content.updatetime|date:'Y-m-d H:i:s',@@} 
                    </span>
                    
                    </div>
                </li>
            </list>
        </ul>
    </section>
    <div class="page1 h30">
        {$page}
    </div>
</article>
<load file="__TPL__/Public/block/footer.php"/>
</body>
</html>