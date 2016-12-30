<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>修改EC会员等级</title>
    <zhjs/>

</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">EC会员等级列表</a></li>
            <li><a href="javascript:;" class="action">修改EC会员等级</a></li>
        </ul>
    </div>
    <div class="title-header">会员等级信息</div>
    <form method="post" class="zh-form" onsubmit="return zh_submit(this,'{|U:index}');">
        <input type="hidden" name="rank_id" value="{$rank.rank_id}" />
        <table class="table1">
            <tr>
                <th class="w100">会员等级名称:</th>
                <td>
                    <input type="text" name="rank_name" value="{$rank.rank_name}" maxlength="20" />
                </td>
            </tr>
            <tr>
                <th class="w100">积分下限:</th>
                <td>
                    <input type="text" name="min_points" value="{$rank.min_points}" size="10" maxlength="20" />
                </td>
            </tr>
            <tr>
                <th class="w100">积分上限: </th>
                <td>
                    <input type="text" name="max_points" value="{$rank.max_points}" size="10" maxlength="20" />
                </td>
            </tr>
            <tr>
                <th class="w100"> </th>
                <td>
                   <if value="$rank.show_price eq 1">
                   <input type="checkbox" name="show_price" value="1" checked="true"/>
                   <else>
                   <input type="checkbox" name="show_price" value="1" />
                   </if>
                    在商品详情页显示该会员等级的商品价格
                </td>
            </tr>
            <tr>
                <th class="w100"> </th>
                <td>
                   <if value="$rank.special_rank eq 1">
                   <input type="checkbox" name="special_rank" value="1" checked="true"/>
                   <else>
                   <input type="checkbox" name="special_rank" value="1" />
                   </if>
                    特殊会员组<br />
                    <span class="notice-span" >*特殊会员组的会员不会随着积分的变化而变化。</span>
                </td>
            </tr>
            <tr>
                <th class="w100">初始折扣率:  </th>
                <td>
                    <input type="text" name="discount" value="{$rank.discount}" size="10" maxlength="20" />
                    <br />
                    <span class="notice-span" >*请填写为0-100的整数,如填入80，表示初始折扣率为8折</span>
                </td>
            </tr>

        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
    </form>
</div>
</body>
</html>