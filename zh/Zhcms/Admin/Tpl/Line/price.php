<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>线路分类管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="content-nr">
        <div class="web-set">
            <dl>
                <dd>
                    <list from="$lineKinds" name="lineKind">
                        <if value="$lineKind.name eq $lineKinds['lineprice']['name']">
                            <a class="on" href="{$lineKind.url}">
                        <else>
                            <a href="{$lineKind.url}">
                        </if>
                        {$lineKind.name}</a>
                    </list>
                </dd>
            </dl>
        </div>
    </div>
    <div class="menu_list" style="clear: both;">
        <ul>
                <li><a href="{|U:'price'}" class="action">{$currentKindName}列表</a></li>
                <li><a href="{|U:'price_add'}">添加{$currentKindName}</a></li>
                <li>
    				<a href="javascript:zh_ajax('{|U:price_UpdateCache}')">
    					缓存更新
    				</a>
    			</li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td>id</td>
            <td>价格范围</td>
            <td>操作</td>
        </tr>
        </thead>
        <list from="$list" name="price">
            <tr>
                <td>{$price.id}</td>
                <td>{$price.lowerprice}&nbsp;<font color="#f4a460">~</font>{$price.highprice}</td>
                <td>
				    <a href="{|U:'price_edit',array('id'=>$price['id'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('确定删除？')?zh_ajax('{|U:price_del}',{id:{$price.id}}):void(0);">删除</a>
                    
                </td>
            </tr>
        </list>
    </table>
    <div class="h60"></div>
</div>
</body>
</html>