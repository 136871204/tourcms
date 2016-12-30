<!DOCTYPE html>
<html>
<head>
    <title>検索</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <zhjs/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/style.css?ver=1.0"/>
    <zhcms/>
</head>
<body>
<article class="header container">
    <h1>网站LOGO</h1>
    <!--导航-->
    <nav class=".navbar-fixed-top" role="navigation">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="__ROOT__">トップ</a></li>
                <channel type="top">
                    <li><a href='{$field.caturl}'>{$field.catname}</a></li>
                </channel>
            </ul>
            <form class="navbar-form navbar-left" role="search" method="get" action="__WEB__">
						<input type="hidden" name="a" value="Index" />
						<input type="hidden" name="c" value="Search" />
						<input type="hidden" name="m" value="search" />
						<div class="form-group">
							<input type="text" name='word' class="form-control" placeholder="キーワードで検索" required>
						</div>
						<button type="submit" class="btn btn-primary">
							検索
						</button>
					</form>
            <member/>
        </div>
    </nav>
</article>
<!--最新消息-->
<div class="message container" style="display: block;">
    <span>最新情報：</span>
    <arclist cid="2" row="1" titlelen=20>
        <a href='{$field.url}'>{$field.title}</a>
    </arclist>
</div>
<!--内容主体-->
<div class="content container">
    <div class="row">
        <div class="col-md-8">
            <form action="__WEB__" class="zh-form">
				<input type="hidden" name="a" value="Index"/>
				<input type="hidden" name="c" value="Search"/>
				<input type="hidden" name="m" value="search"/>
				<div class="search">
					新規時間：
					<input id="begin_time" placeholder="開始時間" readonly="readonly" class="w80" type="text" value="" name="search_begin_time">
					<script>
						$('#begin_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					-
					<input id="end_time" placeholder="終了時間" readonly="readonly" class="w80" type="text" value="" name="search_end_time">
					<script>
						$('#end_time').calendar({
							format : 'yyyy-MM-dd'
						});
					</script>
					&nbsp;&nbsp;&nbsp;
					<select name="mid" class="w100 h30">
						<option selected="" value="">Model</option>
						<list from="$searchModel" name="m">
							<option value="{$m.mid}" <if value="$zh.get.mid eq $m.mid">selected=""</if>>{$m.model_name}</option>
						</list>
					</select>
					<select name="cid" class="w100 h30">
						<option selected="" value="">カテゴリ</option>
						<list from="$searchCategory" name="c">
							<option value="{$c.cid}" <if value="$zh.get.cid eq $c.cid">selected=""</if>>{$c._name}</option>
						</list>
					</select>
					&nbsp;&nbsp;&nbsp;
					<select name="type" class="w100 h30">
						<option value="title" >タイトル</option>
						<option value="description">説明</option>
						<option value="username">ユーザ名</option>
						<option value="tag">Tag</option>
					</select>&nbsp;&nbsp;&nbsp;<br/><br/>
					キーワード：
					<input class="w300" type="text" placeholder="キーワードを入力..." required="" name="word">
					<button class="zh-cancel" type="submit">
						検索
					</button>
				</div>
			</form>
            <!--内容列表-->
            <div class="article-list">
                <header>検索結果</header>
                <list from="$data" name="$field">
                    <div class="article">
                        <h3>
                        <span>
                            {$field.catname}
                            <i class="glyphicon glyphicon-play"></i>
                        </span>
                            <a href="__WEB__?a=Index&c=Index&m=content&mid={$field.mid}&cid={$field.cid}&aid={$field.aid}">{$field.title|mb_substr:0,32,'utf-8'}</a>
                        </h3>
                        <div class="author">
                            <a href="{$field.member}">{$field.username}</a>
                            発表日 {$field.addtime|date_before}
                        </div>
                        <p> {$field.description} </p>
                    </div>
                </list>
                <div class="page">
                    {$page}
                </div>
            </div>
        </div>
        <!--右侧列表-->
        <div class="right-list col-md-4">
            <!--热门标签-->
            <article class="tag">
                <header>
                    人気ラベル
                </header>
                <div>
                    <tag row="30" type="hot">
                        <a href="{$field.url}">{$field.tag}</a>
                    </tag>
                </div>
                <!--Tag随机变色-->
                <script>
                    $(".tag div a ").each(function (i) {
                        var color = ['red', '#428BCA', '#5CB85C', '#D9534F', '#567E95', '#FF8433', '#4A4A4A', '#5CB85C', '#B433FF', '#33BBBA', '#C28F5B'];
                        var t = Math.floor(Math.random() * color.length);
                        $(this).css({'background-color': color[t]});
                    })
                </script>
            </article>
            <!--精英-->
            <article class="reader">
                <header>エリート</header>
                <section>
                    <user row="14">
                        <a href="{$field.url}">
                            <img src="{$field.icon}" title="{$field.nickname}"
                                 onmouseover="user.show(this,{$field.uid})"
                                 style="width: 50px;height: 50px;border-radius: 10%;"/>
                        </a>
                    </user>
                </section>
            </article>
            <!--最新评论-->
            <article class="comment">
                <header>最新コメント</header>
                <comment row="6" contentlen="20">
                    <section>
                        <a href="{$field.url}">
                            <img src="{$field.icon}" style="width: 36px;height: 36px;border-radius: 50%;" onmouseover="user.show(this,{$field.uid})"/>

                            <p class="man">
                                <span>{$field.nickname}</span> {$field.pubtime}说：
                            </p>

                            <p class="content">
                                {$field.content}
                            </p>
                        </a>
                    </section>
                </comment>

            </article>
            <!--猜你喜欢-->
            <article class="news">
                <header>
                    あなたの好み
                </header>
                <arclist type="rand" row="5" titlelen="22">
                    <section>
                        <a href="{$field.url}">
                            <h3>{$field.title}</h3>

                            <p>
                                {$field.time}
                            </p>
                        </a>
                    </section>
                </arclist>
            </article>
        </div>
    </div>
</div>
<!--copyright-->
<footer class="container">
    ZHCMS © 2014
			<a href="http://www.metaphase.co.jp">
				metaphase
			</a>
			<div class="link">
				<strong>パートナーリンク | <a href="__WEB__?g=Plugin&a=Link" target="_blank">リンク申請</a>:</strong>
				<plugin plugin='Link' tag='link' type="all" tid="1">{$field.link}</plugin>
			</div>
</footer>
</body>
</html>