<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>商品属性</title>
    <zhjs/>
</head>
<body>
<div class="wrap">
            <form action="" class="zh-form" method="get">
                <input type="hidden" name="a" value="Admin"/>
                <input type="hidden" name="c" value="Attribute"/>
				<input type="hidden" name="m" value="index"/>
                <img src="__CONTROL_TPL__/img/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
                 按商品类型显示:
                 <select name="goods_type" >
                    <option value="0">所有商品类型</option>
                    {$goods_type_list_option_html}
                 </select>
                 <button class="zh-cancel" type="submit">
						検索
					</button>
			</form>
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'Admin/GoodsType/Index'}">商品类型</a></li>
            <li><a href="javascript:;" class="action">属性列表</a></li>
            <li><a href="{|U:'add',array('goods_type'=>$_GET['goods_type'])}">添加属性</a></li>
        </ul>
    </div>
    <table class="table2">
        <thead>
        <tr>
            <td class="w30">编号</td>
            <td class="w150">属性名称</td>
            <td class="w150">商品类型</td>
            <td class="w100">属性值的录入方式</td>
            <td class="w180">可选值列表</td>
            <td class="w180">排序</td>
            <td class="w180">操作</td>
        </tr>
        </thead>
        <tbody>
        <list from="$result" name="attr">
            <tr>
                <td>{$attr.attr_id}</td>
                <td>{$attr.attr_name}</td>
                <td>{$attr.cat_name}</td>
                <td>{$attr.attr_input_type_desc}</td>
                <td>{$attr.attr_values}</td>
                <td>{$attr.sort_order}</td>
                <td>
                    <a href="{|U:'edit',array('attr_id'=>$attr['attr_id'],'goods_type'=>$_GET['goods_type'])}">
				        修改
				    </a>|
                    <a href="javascript:confirm('是否删除?')?zh_ajax('{|U:del}',{id:{$attr.attr_id}}):void(0);">删除</a>
                </td>
            </tr>
        </list>
        </tbody>
    </table>
    <div class="page1">
        {$page}
    </div>
    <div class="h60"></div>
</div>
</body>
</html>