<!DOCTYPE html>
<html>
<head>
    <title>私のファン</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/follow.css?ver=1.0"/>
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
                私のファン
            </h2>
        </header>
        <ul>
            <list from="$data" name="d">
                <li>
                    <div class="icon">
                       <img src="{$d['icon']|default:'__ROOT__/data/image/user/100.png'}" onmouseover="user.show(this,{$d.uid})" style="width:100px;"/>
                    </div>
                    <div class="info">
                        <p class="nickname">{$d.nickname}</p>
                        <p>関係：<a href="javascript:;" onclick="user.follow(this,{$d.uid})" >{$d.follow}</a></p>
                        <p>最後ログイン：{$d.logintime|date:"Y-m-d",@@}</p>
                        <p>
                          <if value="$field.description">
                                {$field.description|substr:0,20,'utf-8'}
                                <else/>
                                この人は怠け者で、個性サインもない
                            </if>
                        </p>
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