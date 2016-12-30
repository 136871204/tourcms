<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>EC会员等级</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">EC会员等级列表</a></li>
                <li><a href="{|U:'add'}">添加EC会员等级</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td >会员等级名称</td>
            <td >积分下限</td>
            <td >积分上限</td>
            <td >初始折扣率(%)</td>
            <td >特殊会员组</td>
            <td >显示价格</td>
            <td >操作</td>
        </tr>
        </thead>
        <list from="$user_ranks" name="rank">
            <tr>
                <td>{$rank.rank_name}</td>
                <td>{$rank.min_points}</td>
                <td>{$rank.max_points}</td>
                <td>{$rank.discount}</td>
                <td>
                    <if value="{$rank.special_rank}"> 
                        <img src="__STATIC__/image/yes.gif"  />
                    <else>
                        <img src="__STATIC__/image/no.gif"  />
                    </if>
                </td>
                <td>
                    <if value="{$rank.show_price}"> 
                        <img src="__STATIC__/image/yes.gif"  />
                    <else>
                        <img src="__STATIC__/image/no.gif"  />
                    </if>
                </td>
                <td>
				    <a href="{|U:'edit',array('rank_id'=>$rank['rank_id'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('是否删除')?zh_ajax('{|U:del}',{rank_id:{$rank.rank_id}}):void(0);">削除</a>
                    
                </td>
            </tr>
        </list>
    </table>
    <div class="page1">
        {$page}
    </div>
    <div class="h60"></div>
</div>
</body>
</html>