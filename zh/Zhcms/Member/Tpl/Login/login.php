<!DOCTYPE html>
<html>
<head>
    <title>{$zh.config.webname}</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <jquery/>
    <bootstrap/>
    <link rel="stylesheet" type="text/css" href="__CONTROL_TPL__/css/reg.css?ver=1.0"/>
    <script>
        $(function () {
            var error = '{$error}';
            if (error) {
                $("div#error_tips").show().html(error);
                setTimeout(function(){ $("div#error_tips").hide().html('')},5000);
            }
        })
    </script>
</head>
<body>
<div class="header container">
    <a href="__ROOT__">
       Metaphase
    </a>
</div>
<div class="content container">
    <header>
        <span>会員ログイン</span>

        <p>ZHCMSを体験して、真に感謝します，metaphase！</p>
        <strong>お客サポートメール <a href="mailto:{$zh.config.email}">{$zh.config.email}</a></strong>
    </header>
    <article class="row">
        <div class="field col-md-8">
            <div id="error_tips" class="alert alert-warning " style="display: none"></div>
            <form class="form-horizontal" role="form" action="__URL__" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">アカウント：</label>
                    <div class="col-sm-7">
                        <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="アカウント或いはメールアドレス入力" required=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">パスワード：</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required=""/>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">検証番号：</label>
                    <div class="col-sm-7">
                        <input type="text" name="code" class="form-control" placeholder="検証番号" required=""/><br/>
                        <img src="__CONTROL__&m=code" style="cursor: pointer" onclick="this.src='__CONTROL__&m=code&_'+Math.random()"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-lg">会員ログイン</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="field col-md-4">
            > アカウントがない？ <a href="__WEB__?a=Member&c=Login&m=reg">すぐ登録</a><br/>
            > パスワードを忘れた？ <a href="__WEB__?a=Member&c=Password&m=findPassword">パスワード探す</a>
        </div>
    </article>
</div>
</body>
</html>