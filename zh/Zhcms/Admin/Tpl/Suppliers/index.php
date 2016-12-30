<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>供货商列表</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="javascript:;" class="action">供货商列表</a></li>
            <li><a href="{|U:'add'}">添加供货商</a></li>
             
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
            <td class="w30">编号</td>
            <td class="w150">供货商名称</td>
            <td>供货商描述</td>
            <td class="w100">状态</td>
            <td class="w180">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$suppliers_list" name="suppliers">
            <tr>
                <td>{$suppliers.suppliers_id}</td>
                <td>{$suppliers.suppliers_name}</td>
                <td>{$suppliers.suppliers_desc|nl2br}</td>
                <td>
                <if value="$suppliers.is_check eq 1">
                        <img src="__STATIC__/image/yes.gif" />
                <else>
                        <img src="__STATIC__/image/no.gif" />
                </if>
                </td>
                <td>
                    <a href="{|U:'edit',array('id'=>$suppliers['suppliers_id'])}">
				        修正
				    </a>|
                    <a href="javascript:confirm('是否删除?')?zh_ajax('{|U:del}',{id:{$suppliers.suppliers_id}}):void(0);">
				        删除
				    </a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
</div>
</body>
</html>