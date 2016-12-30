<section class="menu">
    <div class="center-block user">
        <a href="__WEB__?{$zh.session.domain}" target="_blank">
            <img src="{$zh.session.icon150}" onmouseover="user.show(this,{$zh.session.uid})" style="width:150px;150px;"/>
        </a>
        <p class="nickname">
            <span class="glyphicon glyphicon-user"></span> <b>{$zh.session.nickname}</b></p>
        <p class="edit-nickname" data-toggle="modal" data-target="#myModal">
            <span class="glyphicon glyphicon-cog"></span> ネックネーム修正
        </p>
        <p>
            金&nbsp;&nbsp;&nbsp; 貨：{$zh.session.credits} <br/>
        </p>
        <p>
            会員組：{$zh.session.rname} <br/>
        </p>
        <!--修改昵称 start--->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog"  >
                <div class="modal-content" style="height:200px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">ネックネーム修正</h4>
                    </div>
                    <div class="modal-body" style="margin-left: 100px;margin-top:20px;">
                        <form method="post" class="zh-form" id="edit_nickname" onsubmit="return false;">
                            <input type="text" name="nickname" value="{$zh.session.nickname}" class="h40 w300"/>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script>
            //修改昵称
            $("#edit_nickname").submit(function(){
                var nickname = $.trim($("input[name=nickname]").val());
                if(!nickname){
                    alert('ネックネームは必須');
                    return false;
                }
                $('#myModal').modal('hide');
                $.post("{|U:'Profile/editNickname'}",$(this).serialize(),function(data){
                    if(data.state==1){
                        $('p.nickname b').html(nickname);
                        $('input[name=nickname]').val(nickname);
                    }
                },'json')
            })
        </script>
        <!--修改昵称 end--->
    </div>
    <nav>
        <a href="__WEB__?a=Member&c=Dynamic&m=index">
            <span class="glyphicon glyphicon-share"></span>
            会員動態
        </a>
        <a href="__WEB__?a=Member&c=Profile&m=edit">
            <span class="glyphicon glyphicon-fire"></span>
            資料修正
        </a>
        <?php
            $model = cache('model');
            foreach($model as $m):
        ?>
        <a href="__WEB__?a=Member&c=Content&m=index&mid=<?php echo $m['mid'];?>">
            <span class="glyphicon glyphicon-book"></span>
            <?php echo $m['model_name'];?>
        </a>
        <?php endforeach;?>
        <a href="__WEB__?a=Member&c=SystemMessage&m=index">
            <span class="glyphicon glyphicon-comment"></span>
            システムメッセージ
            <span class="badge">{$systemmessage_count}</span>
        </a>
        <a href="__WEB__?a=Member&c=Message&m=index">
            <span class="glyphicon glyphicon-comment"></span>
            私のメッセージ
            <span class="badge">{$message_count}</span>
        </a>
        <a href="__WEB__?a=Member&c=Favorite&m=index">
            <span class="glyphicon glyphicon-folder-open"></span>
            私のカード
        </a>
        <a href="__WEB__?a=Member&c=Follow&m=fans_list">
            <span class="glyphicon glyphicon-send"></span>
            私のファン
        </a><a href="__WEB__?a=Member&c=Follow&m=follow_list">
            <span class="glyphicon glyphicon-tower"></span>
            私の注目
        </a>
    </nav>
</section>