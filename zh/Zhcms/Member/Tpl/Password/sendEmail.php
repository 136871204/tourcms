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
    <style type="text/css">
    	h1{
    		font-family: "微软雅黑";
    		font-size:22px;
    		color:#666;
    		padding:0px !important;
    		margin:25px 0px ;
    		line-height: 2em;
    	}
    	div.emailmessage{
    		font-size:16px;color:#333;
    		line-height: 2em;
    	}
    	div.emailhelp h3{
    		font-family: "微软雅黑";
    		font-size:14px;
    	}
    	div.emailhelp p{
    		font-size:12px;color:#666;
    	}
    </style>
</head>
<body>
<div class="header container">
    <a href="__ROOT__">
        ZHCMS
    </a>
</div>
<div class="content container">
    <article class="row" style="padding-top:0px;">
        <div class="field col-md-8">
            <div id="error_tips" class="alert alert-warning " style="display: none"></div>
            <form class="form-horizontal" role="form" method="post" action="__URL__">
                <h1>{$message}</h1>
                <p>
			  		<a class="btn btn-large btn-success"  href="{|U:'findPassword'}">再取得</a>
		  			<a class="btn btn-large btn-primary" id="sendBtn" href="{|U:'Login/login'}">再ログイン</a>
				</p>
            </form>
        </div>
        <div class="field col-md-4">
           <div class="emailhelp">
                	<h3>メール届いていない?次を参照：</h3>
                	<p> >   ごみメール或いは広告メールの中に探してみてください</p>
                </div>
        </div>
    </article>
</div>
</body>
</html>