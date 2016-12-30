<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>红包类型管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">红包类型列表</a></li>
                <li><a href="{|U:'add'}">添加红包类型</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td >类型名称</td>
            <td >发放类型</td>
            <td >红包金额</td>
            <td >订单下限</td>
            <td >发放数量</td>
            <td >使用数量</td>
            <td >操作</td>
        </tr>
        </thead>
        <list from="$type_list" name="type">
            <tr>
                <td>{$type.type_name|htmlspecialchars:@@}</td>
                <td>{$type.send_by}</td>
                <td >
                    {$type.type_money}
                </td>
                <td >
                    {$type.min_amount}
                </td>
                <td ><span>{$type.send_count}</span></td>
                <td >{$type.use_count}</td>
                <td >
                    <if value='$type.send_type eq 3'>
                    <a href="bonus.php?act=gen_excel&tid={$type.type_id}">报表</a> |
                    </if>
                    <if value='$type.send_type neq 2'>
                    <a href="{|U:'send',array('id'=>$type['type_id'],'send_by'=>$type['send_type'])}">发放</a> |
                    </if>
                    <a href="bonus.php?act=bonus_list&amp;bonus_type={$type.type_id}">查看</a> |
                    <a href="{|U:'edit',array('type_id'=>$type['type_id'])}">编辑</a> |
                    <a href="javascript:;" onclick="listTable.remove({$type.type_id}, '{$lang.drop_confirm}')">移除</a>
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