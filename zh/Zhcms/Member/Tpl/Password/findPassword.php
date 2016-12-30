<!DOCTYPE html>
<html>
<head>
    <title>パスワード探す-{$zh.config.webname}</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <jquery/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/reg.css?ver=1.0"/>
</head>
<body>
<div class="header container">
    <a href="__ROOT__">
        ZHCMS
    </a>
</div>
<div class="content container">
    <header>
        <span>パスワード探す</span>
        <p>ZHCMSを体験して、真に感謝します，METAPHASE！</p>
        <strong>お客サポートメール <a href="mailto:{$zh.config.email}">{$zh.config.email}</a></strong>
    </header>
    <article class="row">
        <div class="field col-md-8">
            <div id="error_tips" class="alert alert-warning " style="display: none"></div>
            <form class="form-horizontal" role="form" method="post" action="{|U:'sendEmail'}">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">メールアドレス：</label>
                    <div class="col-sm-7">
                        <input type="email" name="email" class="form-control"  id="inputEmail3" placeholder="メールアドレスを入力" required=""/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg">確認</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="field col-md-4">
            > アカウントが持っている？ <a href="__WEB__?a=Member&c=Login&m=login">すぐログイン</a>
        </div>
    </article>
</div>
</body>
</html>