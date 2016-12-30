<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品类型管理</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
                <li><a href="{|U:'index'}" class="action">商品类型一览</a></li>
                <li><a href="{|U:'add'}">新建商品类型</a></li>
        </ul>
    </div>
    <table class="table2 zh-form">
        <thead>
        <tr>
            <td class="w30">商品类型名称</td>
            <td class="w100">属性分组</td>
            <td class="w200">属性数量</td>
            <td class="w200">状态</td>
            <td class="w150">操作</td>
        </tr>
        </thead>
        <list from="$all" name="a">
            <tr>
                <td>{$a.cat_name}</td>
                <td>{$a.attr_group}</td>
                <td>{$a.attr_count}</td>
                <td>
                    <if value="$a.enabled==1">
                        <img src="__CONTROL_TPL__/img/yes.gif" />
                    <else>
                        <img src="__CONTROL_TPL__/img/no.gif" />
                    </if>
                </td>
                <td>
                    <a href="{|U:'Admin/Attribute/index',array('goods_type'=>$a['cat_id'])}">
				        属性列表
				    </a>|
				    <a href="{|U:'edit',array('cat_id'=>$a['cat_id'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('是否删除?')?zh_ajax('{|U:del}',{id:{$a.cat_id}}):void(0);">删除</a>
                    
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