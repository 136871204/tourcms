<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>会員一覧</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <if value='$state==1'>
                <li><a href="{|U:'index'}" class="action">会員一覧</a></li>
                <li><a href="{|U:'add'}">会員新規</a></li>
            <else/>
                <li><a href="{|U:'index',array('state'=>0)}" class="action">会員一覧</a></li>
            </if>
            
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">uid</td>
            <td class="w200">ネックネーム</td>
            <td class="w200">アカウント</td>
            <td class="w150">会員グループ</td>
            <td class="w150">ログイン時間</td>
            <td class="w150">登録IP</td>
            <td class="w150">最近ログインIP</td>
            <td class="w150">積分</td>
            <td class="w150">操作</td>
        </tr>
        </thead>
        <list from="$data" name="d">
            <tr>
                <td>{$d.uid}</td>
                <td>{$d.nickname}</td>
                <td>{$d.username}</td>
                <td>{$d.rname}</td>
                <td>{$d.logintime|date:'Y-m-d H:i:s',@@}</td>
                <td>{$d.regip}</td>
                <td>{$d.lastip}</td>
                <td>{$d.credits}</td>
                <td>
                    <if value='$state==1'>
                        <a href="{|U:'edit',array('uid'=>$d['uid'])}">修正</a>
                        <span class="line">|</span>
                        <?php if($d['lock_end_time']<time()){?>
                        	<a href="javascript:;" onclick="zh_ajax('{|U:'lock'}',{uid:{$d['uid']},lock:1})">
                        	ロック</a>
                        <?php }else{?>
                        	<a href="javascript:;" onclick="zh_ajax('{|U:'lock'}',{uid:{$d['uid']},lock:0})">
                        		<font color="red">解消</font>	</a>
                        <?php }?>
                        <span class="line">|</span>
                        <a href="{|U:'del',array('uid'=>$d['uid'])}">削除</a>
                    <else/>
                        <a href="{|U:'view',array('uid'=>$d['uid'],'state'=>0)}">審査</a>
                    </if>
                    
                </td>
            </tr>
        </list>
    </table>
    <div class="h60"></div>
</div>
</body>
</html>