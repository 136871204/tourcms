<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{$user.nickname} - マイページ</title>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/style.css"/>
    <jquery/>
    <zhcms/>
</head>
<body>
<!--头部-->
<div id="head_out">
    <div class="head">
        <div class="menu">
            <a href="__WEB__" style="color:#fff;">トップ</a>
            <a href="__WEB__?a=Member&c=Dynamic&m=index" style="color:#fff;">会員中心</a>
        </div>
        <img src="{$user.icon|default:'__ROOT__/data/image/user/150.png'}" class="face" onmouseover="user.show(this,{$user.uid})"/>

        <p class="name">
            {$user.nickname}
            <if value="$zh.session.admin">
                <a href="__ROOT__/index.php?a=User&c=Lock&m=lock&uid={$user.uid}" class="attention"
                   target="_blank">禁止</a>
            </if>

        </p>
        <p class="page">
            マイページ：
            <a href="__ROOT__?{$user.domain}">
                __ROOT__?{$user.domain}
            </a>
            <br/>
            積分: {$user.credits}&nbsp;&nbsp;&nbsp;&nbsp;
            訪問：{$user.spec_num}次<br/>
            会員組: {$user.rname}
            <br/>
                    <span>
                        {$user.signature}
                    </span>
        </p>
    </div>
</div>
<!--头部结束-->

<!--主体-->
<div id="main">

    <!--左侧-->
    <div class="left">
        <p class="title">
           私の文章
        </p>
        <ul class="arc_list">
            <list from="$data" name="$d">
                <li>
                    <a href="{|U:'Index/Index/content',array('mid'=>1,'cid'=>$d['cid'],'aid'=>$d['aid'])}"
                       target="_blank">
                        <span>[{$d.addtime|date:'Y-m-d',@@}]</span> {$d.title|mb_substr:0,35,'utf-8'}
                    </a>
                </li>
            </list>
        </ul>
        <div class="page">
            {$page}
        </div>
    </div>
    <!--左侧结束-->

    <!--右侧-->
    <div class="right">



        <p class="title">
            最近のお客
        </p>
        <ul class="visitor_list">
            <list from="$guest" name="g">
                <li>
                    <a href="__WEB__?{$g.domain}" class="face">
                        <img src="{$g.icon}" alt="{$g.nickname}" style='width:50px;'/>	
                    </a>
                    <a href="__WEB__?{$g.domain}" class="name">
                        {$g.nickname}
                    </a>
                </li>
            </list>


        </ul>
    </div>
    <!--右侧结束-->

</div>
<!--主体结束-->

<!--底部-->
<div id="footer_out">
    <p>国内で優秀なオープンソースのシステム<a href="">ZHCMS</a></p>

    <p>All rights reserved, metaphase</p>
</div>
<!--底部结束-->

</body>
</html>








