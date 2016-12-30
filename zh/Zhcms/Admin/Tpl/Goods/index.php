<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>商品管理</title>
		<zhjs/>
	</head>
	<body>
		<div class="wrap">
			<form action="" class="zh-form" method="get">
                <input type="hidden" name="g" value="Zhcms"/>
                <input type="hidden" name="a" value="Admin"/>
                <input type="hidden" name="c" value="Goods"/>
                <input type="hidden" name="m" value="index"/>
                <input type="hidden" name="act" value="{$zh.get.act}"/>
                <input type="hidden" name="extension_code" value="{$zh.get.extension_code}"/>
                
                
				<div class="search">
                    <!-- 分类 -->
                    <select name="cat_id">
                        <option value="0">所有分类</option>
                        {$cat_list}
                    </select>
                    <!-- 品牌 -->
                    <select name="brand_id">
                        <option value="0">所有品牌</option>
                        <html_options  options="{$brand_list}" selected="{$zh.get.brand_id}" >
                    </select>
                    <!-- 推荐 -->
                    <select name="intro_type">
                        <option value="0">全部</option>
                        <html_options  options="{$intro_list}" selected="{$zh.get.intro_type}" >
                    </select>
                    <if value="$suppliers_exists eq 1">
                        <!-- 供货商 -->
                        <select name="suppliers_id">
                            <option value="0">全部</option>
                            <html_options  options="{$suppliers_list_name}" selected="{$zh.get.suppliers_id}" >
                        </select>
                    </if>
                    <!-- 上架 -->
                    <select name="is_on_sale">
                        <option value=''>全部</option>
                        <option value="1">上架</option>
                        <option value="0">下架</option>
                    </select>
                    <!-- 关键字 -->
                    关键字 <input type="text" name="keyword" size="15" value="{$zh.get.keyword}" />
					
					<button class="zh-cancel" type="submit">
						検索
					</button>
				</div>
			</form>
			<div class="menu_list">
				<ul>
					<li>
                        <a href="{|U:'index'}" class="action">商品列表</a>
					</li>
                    <li>
                        <a href="{|U:'operator',array('extension_code'=>$_GET['extension_code'],'act'=>'add')}" >添加商品</a>
                    </li>
				</ul>
			</div>
			<table class="table2 zh-form">
				<thead>
					<tr>
                        <td>编号</td>
                        <td>商品名称</td>
                        <td>货号</td>
                        <td>价格</td>
                        <td>上架</td>
                        <td>精品</td>
                        <td>新品</td>
                        <td>热销</td>
                        <td>推荐排序</td>
                        <td>库存</td>
                        <td>操作</td>
						
					</tr>
				</thead>
				<list from="$goods_list" name="goods">
				<tr>
                    <td>{$goods.goods_id}</td>
                    <td class="first-cell" style="<if value='$goods.is_promote'>color:red;</if>">{$goods.goods_name|htmlspecialchars:@@}</td>
				    <td>{$goods.goods_sn}</td>
                    <td align="right">{$goods.shop_price}</td>
                    <td align="center">
                        <if value='$goods.is_on_sale'>
                            <img src="__STATIC__/image/yes.gif" />
                        <else>
                            <img src="__STATIC__/image/no.gif" />
                        </if>
                    </td>
                    <td align="center">
                        <if value='$goods.is_best'>
                            <img src="__STATIC__/image/yes.gif" />
                        <else>
                            <img src="__STATIC__/image/no.gif" />
                        </if>
                    </td>
                    <td align="center">
                        <if value='$goods.is_new'>
                            <img src="__STATIC__/image/yes.gif" />
                        <else>
                            <img src="__STATIC__/image/no.gif" />
                        </if>
                    </td>
                    <td align="center">
                        <if value='$goods.is_hot'>
                            <img src="__STATIC__/image/yes.gif" />
                        <else>
                            <img src="__STATIC__/image/no.gif" />
                        </if>
                    </td>
                    <td align="center">
                        {$goods.sort_order}
                    </td>
                    <if value='$use_storage'>
                    <td align="right">
                        {$goods.goods_number}
                    </td>
                    </if>
                    <td align="center">
                    <a href="{|U:'Admin/CommentCollect/comment',array('goods_id'=>$goods['goods_id'])}" ><img src="__STATIC__/image/comment_icon.png"  border="0"/></a>
                    <a href="{|U:'Admin/Goods/operator',array('act'=>'edit','goods_id'=>$goods['goods_id'])}" title="编辑"><img src="__STATIC__/image/icon_edit.gif" width="16" height="16" border="0" /></a>
                    </td>
                </tr>
                </list>
			</table>
			<div class="page1">
				{$page}
			</div>
		</div>


	</body>
</html>