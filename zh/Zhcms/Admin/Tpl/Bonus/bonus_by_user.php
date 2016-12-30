<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>发放红包</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script src='__STATIC__/js/utils.js'></script>
    <script src='__STATIC__/js/validator.js'></script>
    <script type="text/javascript" src="__STATIC__/js/calendar.php?lang={$zh.session.language}"></script>
    <link href="__STATIC__/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">红包类型列表</a></li>
            <li><a href="javascript:;" class="action">发放红包</a></li>
        </ul>
    </div>
    <div class="title-header">发放红包</div>
    <form method="get" name="theForm2"   class="zh-form" onsubmit="if(validate2()!=false){}else{return false;}">
        <input type="hidden" name="a" value="Admin" />
        <input type="hidden" name="c" value="Bonus" />
        <input type="hidden" name="m" value="send_by_user" />
        <table width="100%"  class="table1">
            <tr>
                <td class="label">按用户等级发放红包:</td>
                <td>
                    <select name="rank_id">
                        <option value="0">选择会员等级...</option>
                        <html_options  options="{$ranklist}" >
                    </select>&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" name="validated_email" value="1" />只给通过邮件验证的用户发放红包 
                </td>
            </tr>
            <tr>
                <td style="text-align:center" colspan =2>
                    <input type="submit" value="确定发送红包" class="button" />
                </td>
            </tr>
        </table>
         <input type="hidden" name="send_rank" value="1" />
        <input type="hidden" name="act" value="send_by_user" />
        <input type="hidden" name="id" value="{$id}" />
    </form>
</div>
<script>

function validate2()
{
    var user_rank = document['theForm2'].elements['rank_id'].value;

    if (user_rank == 0)
    {
        alert('您没有指定会员等级!');
        return false;
    }
    return true;
}


</script>
</body>
</html>