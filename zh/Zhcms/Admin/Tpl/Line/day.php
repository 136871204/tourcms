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
                        <if value="$lineKind.name eq $lineKinds['lineday']['name']">
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
                <li><a href="{|U:'day'}" class="action">{$currentKindName}列表</a></li>
                <li><a href="{|U:'day_add'}">添加{$currentKindName}</a></li>
                <li>
    				<a href="javascript:zh_ajax('{|U:day_UpdateCache}')">
    					缓存更新
    				</a>
    			</li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td>id</td>
            <td>天数</td>
            <td>是否前台显示</td>
            <td>操作</td>
        </tr>
        </thead>
        <list from="$list" name="data">
            <tr>
                <td>{$data.id}</td>
                <td>{$data.word}日游</td>
                <td>
                    <if value="$data.isdisplay == 1">
                        <img src="__CONTROL_TPL__/img/yes.gif" />
                    <else>
                        <img src="__CONTROL_TPL__/img/no.gif" />
                    </if>
                </td>
                <td>
				    <a href="{|U:'day_edit',array('id'=>$data['id'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('确定删除？')?zh_ajax('{|U:day_del}',{id:{$data.id}}):void(0);">删除</a>
                    
                </td>
            </tr>
        </list>
    </table>
    <div class="h60"></div>
</div>
</body>
</html>