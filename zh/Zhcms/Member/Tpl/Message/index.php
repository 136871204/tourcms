<!DOCTYPE html>
<html>
<head>
    <title>私のメッセージ</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/message.css?ver=1.0"/>
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
                私のメッセージ
            </h2>
        </header>
        <ul>
            <list from="$data" name="d">
                <li>
                    <div class="article">
                        <a href="__ROOT__/index.php?a=Member&c=Message&m=show&from_uid={$d.from_uid}" class="title">
                            {$d.nickname} : {$d.content|mb_substr:0,30,'utf-8'}
                        </a>
                    <span class="time">
                        {$d.sendtime|date:'Y-m-d H:i:s',@@}
                        <if value=" $d['user_message_state'] == 0 " >
                        <span style="color: red;" >&nbsp;&nbsp;[未読]</span>
                        <else/>
                        <span style="color: green;" >&nbsp;&nbsp;すでに読解</span>
                        </if>
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