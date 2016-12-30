<!DOCTYPE html>
<html>
<head>
    <title>私の文章</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/article-list.css?ver=1.0"/>
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
            <h2> 私の文章
                <a href="javascript:;" onclick="zh_open_window('{|U:'selectCategory',array('mid'=>$_GET['mid'])}')"
                   class="send">発表</a>
            </h2>

        </header>
        <ul>
            <list from="$data" name="d">
                <li>
                    <div class="article">
                        <a href="{|U:'Index/Index/content',array(mid=>$d['mid'],cid=>$d['cid'],aid=>$d['aid'])}" target="_blank" class="title">
                            {$d.title|mb_substr:0,35,'utf-8'}
                        </a>
                        <a href="{|U:'Index/Index/category',array(cid=>$d['cid'])}" target="_blank" class="category" style="display: inline-block;">
                            {$d.catname}
                            <span class="time">
                        {$d.updatetime|date:'Y-m-d H:i:s',@@}
                    </span>
                        </a>
                        <a href="javascript:;" onclick="zh_open_window('{|U:'add',array('mid'=>$d['mid'],'cid'=>$d['cid'])}')" style="display: inline-block;">
                            	発表
                            </a>
                    </div>
                    <div class="right-action">
                        <a href="javascript:;" onclick="zh_open_window('{|U:'edit',array('mid'=>$d['mid'],'cid'=>$d['cid'],'aid'=>$d['aid'])}')" class="btn btn-default btn-sm">修正</a>
                        <a href="javascript:if(confirm('削除しますか？')){zh_ajax('{|U:'del',array('mid'=>$d['mid'],'cid'=>$d['cid'],'aid'=>$d['aid'])}');}" class="btn btn-default btn-sm">削除</a>
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