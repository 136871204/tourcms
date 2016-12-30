<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>b2b用户</title>
    <zhjs/>
    <css file="__CONTROL_TPL__/css/css.css"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">b2b用户一览</a></li>
            <li><a href="{|U:'add'}">添加b2b用户</a></li>
            <li><a href="{|U:'excel'}">导出Excel</a></li>
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
            <td>b2bid</td>
            <td>用户名</td>
            <td>法人代表</td>
            <td>省份</td>
            <td>公司全称</td>
            <td>邮件</td>
            <td>财务电话</td>
            <td>注册时间</td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$data" name="a">
            <tr>
                <td width="30">{$a.b2bid}</td>
                <td>{$a.b2busername}</td>
                <td>{$a.legalrepresentative}</td>
                <td>{$a.province}</td>
                <td>{$a.fullname}</td>
                <td>{$a.email}</td>
                <td>{$a.financetel}</td>
                <td>{$a.regtime|date:'Y-m-d H:i:s',@@}</td>
                <td>
                    <a href="{|U:'edit',array('b2bid'=>$a['b2bid'])}">修改</a> |
                    <a href="javascript:confirm('确定删除？')?zh_ajax('{|U:'del'}',{'b2bid':{$a.b2bid}}):void(0);">删除</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    
	<div class="page1">
		{$page}
	</div>
        
</div>
</body>
</html>