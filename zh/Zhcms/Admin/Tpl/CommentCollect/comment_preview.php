<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>天猫评论采集</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Admin/Goods/index'}">商品列表</a></li>
            <li><a href="javascript:;" class="action">天猫评论采集</a></li>
        </ul>
    </div>
    <form method="POST" action="{|U:comment_batch_import,array('goods_id'=>$goods_id)}" name="listForm" onsubmit="return confirm_bath()">
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td >编号</td>
            <td >用户名</td>
            <td >评论内容</td>
            <td >评论时间</td>
            <td >评分等级</td>
            <td >显示/隐藏</td>
        </tr>
        </thead>
        <list from="$comment_list" name="comment">
            <tr>
                <td>
                    <input value="{$comment.id}" name="checkboxes[]" type="checkbox"/>{$comment.id}
                </td>
                <td>
                    <input type='text' name='user_name[]' class="w50" value="<if value='{$comment.user_name}'>{$comment.user_name}<else></if>" />
                </td>
                <td>
                    <input type='text' name='content[]' class="w700" value="{$comment.content}" />
                </td>
                <td align="center">
                    <input type='text' name='add_time[]' class="w150" value="{$comment.format_time}" />
                </td>
                <td align="center">
                    <input type='text' name='comment_rank[]' class="w50" value="{$comment.comment_rank}" />
                </td>
                <td align="center">
                    <input value="1" name="is_show[]" type="checkbox" checked="checked"/>
                </td>
            </tr>
        </list>
    </table>

    <table cellpadding="4" cellspacing="0"  class="table2 zh-form">
        <tr>
        	<th colspan="4">
                <strong>生成订单信息项设置（为保证真实性，请把评论随机隐藏掉几个,并且把评论的日期改到不同时间段）</strong>
            </th>
        </tr>
        <tr>
            <td>购买数量设置</td>
            <td>
                <input type='text' name='buy_num' size='20' value="5" />（默认为5，表示数量随机1-5件，可更改）
            </td>
            <td>购买时间设置</td>
            <td>
                <input type='text' name='buy_time' size='20' value="5" />（默认为5，表示订单购买时间在评论时间前5天，可更改）
                <input type='hidden' name='goods_id' size='20' value="{$goods_id}" />
            </td>
        </tr>
    </table>

    <table cellpadding="4" cellspacing="0"  class="table2 zh-form">
        <tr>
            <td>
                <input id="auto_clear" type="checkbox"   value="1"  name="auto_clear"/>自动清除该商品下的所有历史评论
                <input type="submit" name="drop" id="btnSubmit" value="批量导入" class="button" />
            </td>
        </tr>
    </table>
    </form>
    <script type="text/javascript" language="JavaScript">
    function confirm_bath()
    {
        return confirm("确定将所选评论导入数据库？");
    }
    </script>
</div>
</body>
</html>