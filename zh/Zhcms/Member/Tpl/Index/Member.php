<ul class="nav navbar-nav navbar-right">
    <if value="$zh.session.uid">
        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 12px;padding-bottom: 0px;padding-right:0px;">
                    <img src="{$zh.session.icon50}" style="width:30px;height:30px;border-radius: 50%;vertical-align: middle"/>
                    {$zh.session.nickname}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="__WEB__?a=Member&c=Message&m=index"> <span class="glyphicon glyphicon-envelope"></span> 私のメッセージ</a></li>
                    <li><a href="__WEB__?a=Member&c=Favorite&m=index"> <span class="glyphicon glyphicon-star-empty"></span> 私のカード</a></li>
                    <li><a href="__WEB__?a=Member&c=Follow&m=fans_list"> <span class="glyphicon glyphicon-heart"></span> 私のファン</a></li>
                    <li><a href="__WEB__?a=Member&c=Follow&m=follow_list"> 私の注目</a></li>
                    <li><a href="__WEB__?a=Member&c=Content&m=index&mid=1">私の文章</a></li>
                    <li><a href="__WEB__?{$zh.session.domain}">マイページ</a></li>
                    <li><a href="__WEB__?a=Member&c=Profile&m=edit">個人情報修正</a></li>
                    <li><a href="__WEB__?a=Member&c=Login&m=quit">ログアウト</a></li>
                </ul>
        </li>
        <li class="dropdown">
            <a href="__WEB__?a=Member&c=Message&m=index" class="message" style="padding-left:5px !important;">
                <span class="badge">{$message_count}のメッセージ</span>
            </a>
            <style>
                a.message:hover{
                    background: none !important;
                }
            </style>
        </li>
    <else>
        <li>
            <a href="__WEB__?a=Member&c=Login&m=login">ログイン</a>
        </li>
        <li>
            <a href="__WEB__?a=Member&c=Login&m=reg">登録</a>
        </li>
    </if>
</ul>