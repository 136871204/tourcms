<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>站点管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">站点列表</a></li>
                <li><a href="{|U:'add'}">站点添加</a></li>
                <li>
    				<a href="javascript:zh_ajax('{|U:updateCache}')">
    					缓存更新
    				</a>
    			</li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td >网站webid</td>
            <td >站点名称</td>
            <td >访问域名</td>
            <td >主站|子站</td>
            <td >排序</td>
            <td >操作</td>
        </tr>
        </thead>
        <list from="$weblist" name="w">
            <tr>
                <td>{$w.id}</td>
                <td>{$w.webname}</td>
                <td>{$w.weburl}</td>
                <td>
                    <if value="$w.is_main==0">
                        主站
                    <else>
                        子站
                    </if>
                </td>
                <td>{$w.displayorder}</td>
                <td>
				    <a href="{|U:'edit',array('id'=>$w['id'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('需要删除吗')?zh_ajax('{|U:del}',{id:{$w.id}}):void(0);">删除</a>
                    
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