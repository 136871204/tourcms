<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<title>商品管理</title>
        
		<zhjs/>
        
        <script src='__STATIC__/js/utils.js'></script>
        <script src='__STATIC__/js/transport.js'></script>
        <script src='__STATIC__/js/colorselector.js'></script>
        <script src='__STATIC__/js/validator.js'></script>
        <script type="text/javascript" src="__STATIC__/js/calendar.php?lang={$zh.session.language}"></script>
        <link href="__STATIC__/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="__STATIC__/js/selectzone.js"></script>
        <script src='__STATIC__/js/json2.js'></script>
        <script>
        var cancel_color = "无样式";
        </script>
	</head>
	<body>
		<div class="wrap">
			<div class="menu_list">
				<ul>
					<li>
                        <a href="{|U:'index',array('act'=>'list')}">商品列表</a>
					</li>
                    <li>
                        <a href="{|U:'operator',array('extension_code'=>$_GET['extension_code'],'act'=>'add')}"  class="action" >添加商品</a>
                    </li>
				</ul>
			</div>
			
			<div class="title-header">商品信息</div>
            <form method="post" class="zh-form" name="theForm"   enctype="multipart/form-data" >
                <div class="tab">
                    <ul class="tab_menu">
                        <li lab="general-tab"><a href="#">通用信息</a></li>
                        <li lab="detail-tab"><a href="#">详细描述</a></li>
                        <li lab="mix-tab"><a href="#">其他信息</a></li>
                        <li lab="properties-tab"><a href="#">商品属性</a></li>
                        <li lab="gallery-tab"><a href="#">商品相册</a></li>
                        <li lab="linkgoods-tab"><a href="#">关联商品</a></li>
                        <li lab="groupgoods-tab"><a href="#">配件</a></li>
                        <li lab="article-tab"><a href="#">关联文章</a></li>
                    </ul>
                    <div class="tab_content">
                        <div id="general-tab">
                            <table class="table1">
                                <tr>
                                    <th class="w100">商品名称：</th>
                                    <td>
                                        <input type="text" name="goods_name" value="{$goods.goods_name|htmlspecialchars:@@}" style="float:left;color:{$goods_name_color};" class="w400" />
                                        <div style="background-color:{$goods_name_color};float:left;margin-left:2px;" id="font_color" onclick="ColorSelecter.Show(this);">
                                            <img src="__STATIC__/image/color_selecter.gif" style="margin-top:-1px;" />
                                        </div>
                                        <input type="hidden" id="goods_name_color" name="goods_name_color" value="{$goods_name_color}" />&nbsp;
                                        <select name="goods_name_style">
                                            <option value="">字体样式</option>
                                            <html_options  options="{$font_styles}" selected="{$goods_name_style}" >
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>商品货号：</th>
                                    <td>
                                        <input type="text" name="goods_sn" value="{$goods.goods_sn|htmlspecialchars:@@}" class="w400" onblur="checkGoodsSn(this.value,'{$goods.goods_id}')" />
                                        <span  id="goods_sn_notice"></span><br />
                                        *如果您不输入商品货号，系统将自动生成一个唯一的货号。
                                    </td>
                                </tr>
                                <tr>
                                    <th>商品分类：</th>
                                    <td>
                                        <select name="cat_id" onchange="hideCatDiv()" >
                                            <option value="0">请选择</option>
                                            {$cat_list}
                                        </select>
                                        <if value="{$is_add}">
                                            <a href="javascript:void(0)" onclick="rapidCatAdd()" title="添加分类" class="special">
                                            添加分类
                                            </a>
                                            <span id="category_add" style="display:none;">
                                                <input type="text"  class="w200" name="addedCategoryName" />
                                                <a href="javascript:void(0)" onclick="addCategory()" title="确定" class="special" >
                                                确定
                                                </a>|
                                                <a href="javascript:void(0)" onclick="return goCatPage()" title="分类管理" class="special" >
                                                分类管理
                                                </a>|
                                                <a href="javascript:void(0)" onclick="hideCatDiv()" title="隐藏" class="special" ><<</a>
                                            </span>
                                        </if>
                                    </td>
                                </tr>
                                <tr>
                                    <th>扩展分类：</th>
                                    <td>
                                        <input type="button" value="添加" onclick="addOtherCat(this.parentNode)" class="button" />
                                        <list from="{$goods.other_cat}" name="cat_id">
                                            <select name="other_cat[]">
                                                <option value="0">请选择</option>
                                                {$other_cat_list.$cat_id}
                                            </select>
                                        </list>
                                    </td>
                                </tr>
                                <tr>
                                    <th>商品品牌：</th>
                                    <td>
                                        <select name="brand_id" onchange="hideBrandDiv()" >
                                            <option value="0">请选择</option>
                                            <html_options  options="{$brand_list}" selected="{$goods.brand_id}" >
                                        </select>
                                        <if value="{$is_add}">
                                            <a href="javascript:void(0)" title="添加品牌" onclick="rapidBrandAdd()" class="special" >
                                                添加品牌
                                            </a>
                                            <span id="brand_add" style="display:none;">
                                                <input type="text" class="text"  class="w200" name="addedBrandName" />
                                                <a href="javascript:void(0)" onclick="addBrand()" class="special" >确定</a>|
                                                <a href="javascript:void(0)" onclick="return goBrandPage()" title="品牌管理" class="special" >品牌管理</a>|
                                                <a href="javascript:void(0)" onclick="hideBrandDiv()" title="隐藏" class="special" ><<</a>
                                            </span>
                                        </if>
                                    </td>
                                </tr>
                                <if value="$suppliers_exists eq 1">
                                <tr>
                                    <th>选择供货商：</th>
                                    <td>
                                        <select name="suppliers_id" id="suppliers_id">
                                            <option value="0">不指定供货商属于本地商品</option>
                                            <html_options  options="{$suppliers_list_name}" selected="{$goods.suppliers_id}" >
                                        </select>
                                    </td>
                                </tr>
                                </if>
                                <tr>
                                    <th>本店售价：</th>
                                    <td>
                                        <input type="text" name="shop_price" value="{$goods.shop_price}" class="w100" onblur="priceSetted()"/>
                                        <input type="button" value="按市场价计算" onclick="marketPriceSetted()" />
                                    </td>
                                </tr>
                                <if value="$user_rank_list">
                                <tr>
                                    <th>会员价格：</th>
                                    <td>
                                        <foreach from="$user_rank_list" value="$user_rank">
                                        {$user_rank.rank_name}<span id="nrank_{$user_rank.rank_id}"></span>
                                        <input type="text" id="rank_{$user_rank.rank_id}" name="user_price[]" value="{$member_price_list[$user_rank.rank_id]|default:-1}" 
                                         onkeyup="if(parseInt(this.value)<-1){this.value='-1';};set_price_note({$user_rank.rank_id})"  class="w100"
                                        />
                                        <input type="hidden" name="user_rank[]" value="{$user_rank.rank_id}" />
                                        </foreach>
                                        <br />
                                        <span  id="goods_sn_notice">
                                        *会员价格为-1时表示会员价格按会员等级折扣率计算。你也可以为每个等级指定一个固定价格。
                                        </span>
                                    </td>
                                </tr>
                                </if>
                                <tr>
                                    <th>商品优惠价格：</th>
                                    <td>
                                        <table width="100%" id="tbody-volume" align="center">
                                            <foreach from="$volume_price_list" value="$volume_price" key="$volume_key">
                                            <tr>
                                                <td>
                                                    <if value="$volume_key eq 0">
                                                        <a href="javascript:;" onclick="addVolumePrice(this)">[+]</a>
                                                    <else>
                                                        <a href="javascript:;" onclick="removeVolumePrice(this)">[-]</a>
                                                    </if>
                                                    优惠数量<input type="text" name="volume_number[]" class="w100" value="{$volume_price.number}"/>
                                                    优惠价格<input type="text" name="volume_price[]" class="w100" value="{$volume_price.price}"/>
                                                </td>
                                            </tr>
                                            </foreach>
                                        </table>
                                        <br />
                                        <span  id="goods_sn_notice">
                                        *购买数量达到优惠数量时享受的优惠价格
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>市场售价：</th>
                                    <td>
                                        <input name="market_price" value="0" class="w100"  type="text" />
                                        <input value="取整数" onclick="integral_market_price()" type="button" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>赠送消费积分数：</th>
                                    <td>
                                        <input type="text" name="give_integral" value="{$goods.give_integral}" class="w200" />
                                        <br />
                                        <span  id="goods_sn_notice">
                                        *购买该商品时赠送消费积分数,-1表示按商品价格赠送
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>赠送等级积分数：</th>
                                    <td>
                                        <input type="text" name="rank_integral" value="{$goods.rank_integral}" class="w200" />
                                        <br />
                                        <span  id="goods_sn_notice">
                                        *购买该商品时赠送等级积分数,-1表示按商品价格赠送
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>积分购买金额：</th>
                                    <td>
                                        <input name="integral" value="0"  class="w100" onblur="parseint_integral()" type="text"/>
                                        <span class="notice-span" style="display:block" id="noticPoints">*(此处需填写金额)购买该商品时最多可以使用积分的金额</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <label for="is_promote">
                                        <input type="checkbox" id="is_promote" name="is_promote" value="1" <if value='{$goods.is_promote}'>checked="checked"</if>  onclick="handlePromote(this.checked);" />
                                        促销价：
                                        </label>
                                    </th>
                                    <td  id="promote_3">
                                        <input type="text" id="promote_1" name="promote_price" value="{$goods.promote_price}"  class="w200" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>促销日期：</th>
                                    <td>
                                        <input name="promote_start_date" type="text" id="promote_start_date" size="12" value='{$goods.promote_start_date}' readonly="readonly" />
                                        <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('promote_start_date', '%Y-%m-%d', false, false, 'selbtn1');" value="选择" class="button"/>
                                        - 
                                        <input name="promote_end_date" type="text" id="promote_end_date" size="12" value='{$goods.promote_end_date}' readonly="readonly" />
                                        <input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('promote_end_date', '%Y-%m-%d', false, false, 'selbtn2');" value="选择" class="button"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>上传商品图片：</th>
                                    <td>
                                        <input type="file" name="goods_img" size="35" />
                                        <if value="{$goods.goods_img}">
                                            <a href="{|U:show_image,array('img_url'=>$goods['goods_img'])}" target="_blank"><img src="__STATIC__/image/yes.gif" border="0" /></a>
                                        <else>
                                            <img src="__STATIC__/image/no.gif" />
                                        </if>
                                        <br />
                                        <input type="text" size="40" value="商品图片外部URL" style="color:#aaa;" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" name="goods_img_url"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>上传商品缩略图：</th>
                                    <td>
                                        <input type="file" name="goods_thumb" size="35" />
                                        <if value="{$goods.goods_thumb}">
                                            <a href="{|U:show_image,array('img_url'=>$goods['goods_thumb'])}" target="_blank"><img src="__STATIC__/image/yes.gif" border="0" /></a>
                                        <else>
                                            <img src="__STATIC__/image/no.gif" />
                                        </if>
                                        <br />
                                        <input type="text" size="40" value="上传商品缩略图外部URL" style="color:#aaa;" onfocus="if (this.value == '上传商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" name="goods_thumb_url"/>
                                        <if value="{$gd} gt 0">
                                        <br />
                                        <label for="auto_thumb">
                                            <input type="checkbox" id="auto_thumb" name="auto_thumb" checked="true" value="1" onclick="handleAutoThumb(this.checked)" />
                                            自动生成商品缩略图
                                        </label>
                                        </if>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="detail-tab">
                            <table width="90%" id="detail-table"   class="table1">
                              <tr>
                                <td>
                                <ueditor name="goods_desc" content="{$goods.goods_desc}" />
                                </td>
                              </tr>
                            </table>
                        </div>
                        <div id="mix-tab">
                            <table class="table1">
                                <if value="$code eq ''">
                                <tr>
                                    <th class="w150">商品重量：</th>
                                    <td>
                                        <input type="text" name="goods_weight" value="{$goods.goods_weight_by_unit}"  class="w200" />
                                        <select name="weight_unit">
                                        <html_options  options="{$unit_list}" selected="{$weight_unit}" >
                                        </select>
                                    </td>
                                </tr>
                                </if>
                                <if value="{$config_value.use_storage}">
                                <tr>
                                    <th>商品库存数量：</th>
                                    <td>
                                        <input type="text" name="goods_number" value="{$goods.goods_number}"   class="w200" />
                                        <br />
                                        <span  id="goods_sn_notice">
                                        *库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>库存警告数量：</th>
                                    <td>
                                       <input type="text" name="warn_number" value="{$goods.warn_number}"   class="w200" /> 
                                    </td>
                                </tr>
                                </if>
                                <tr>
                                    <th class="w150">加入推荐：</th>
                                    <td>
                                        <input type="checkbox" name="is_best" value="1" <if value='{$goods.is_best}'>checked="checked"</if> />&nbsp;精品&nbsp;&nbsp; 
                                        <input type="checkbox" name="is_new" value="1" <if value='{$goods.is_new}'>checked="checked"</if> />&nbsp;新品&nbsp;&nbsp;
                                        <input type="checkbox" name="is_hot" value="1" <if value='{$goods.is_hot}'>checked="checked"</if> />&nbsp;最热&nbsp;&nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <th>上架：</th>
                                    <td>
                                    <input type="checkbox" name="is_on_sale" value="1" <if value='{$goods.is_on_sale}'>checked="checked"</if> /> 打勾表示允许销售，否则不允许销售。
                                    </td>
                                </tr>
                                <tr>
                                    <th>能作为普通商品销售：</th>
                                    <td>
                                    <input type="checkbox" name="is_alone_sale" value="1" <if value='{$goods.is_alone_sale}'>checked="checked"</if> /> 打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。
                                    </td>
                                </tr>
                                <tr>
                                    <th>是否为免运费商品：</th>
                                    <td>
                                    <input type="checkbox" name="is_shipping" value="1" <if value='{$goods.is_shipping}' >checked="checked"</if> /> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。
                                    </td>
                                </tr>
                                <tr>
                                    <th>商品关键词：</th>
                                    <td>
                                    <input type="text" name="keywords" value="{$goods.keywords|htmlspecialchars:@@}" class="w400" /> 用空格分隔
                                    </td>
                                </tr>
                                <tr>
                                    <th>商品简单描述：</th>
                                    <td>
                                    <textarea name="goods_brief" cols="40" rows="3">{$goods.goods_brief|htmlspecialchars:@@}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>商家备注：</th>
                                    <td>
                                    <textarea name="seller_note" cols="40" rows="3">{$goods.seller_note}</textarea>
                                    <br />
                                        <span  id="goods_sn_notice">
                                        *仅供商家自己看的信息
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="properties-tab">
                            <if value="$goods_type_list">
                            <table class="table1">
                                <tr>
                                    <th  class="w150">商品类型：</th>
                                    <td>
                                        <select name="goods_type" onchange="getAttrList({$goods.goods_id})">
                                            <option value="0">请选择商品类型</option>
                                            {$goods_type_list}
                                        </select>
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td id="tbody-goodsAttr" colspan="2" style="padding:0">
                                        {$goods_attr_html}
                                    </td>
                                </tr>
                            </table>
                            </if>
                        </div>
                        <div id="gallery-tab">
                            <table class="table1"  id="gallery-table" >
                                <tr>
                                    <td>
                                        <foreach from="$img_list" value="$img" key="$i">
                                        <div id="gallery_{$img.img_id}" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                                            <a href="javascript:;" onclick="if (confirm('您确实要删除该图片吗？')) dropImg('{$img.img_id}')">[-]</a><br />
                                            <a href="{|U:show_image,array('img_url'=>$img['img_url'])}" target="_blank">
                                                <img src="__ROOT__/<if value='$img.thumb_url'>{$img.thumb_url}<else>{$img.img_url}</if>" 
                                                    <if value='$thumb_width neq 0'>width="{$thumb_width}"</if> 
                                                    <if value='$thumb_height neq 0'>height="{$thumb_height}"</if> border="0" />
                                            </a><br />
                                            <input type="text" value="{$img.img_desc|htmlspecialchars:@@}" size="15"  name="old_img_desc[{$img.img_id}]" />
                                        </div>
                                        </foreach>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td>
                                      <a href="javascript:;" onclick="addImg(this)">[+]</a>
                                       图片描述  <input type="text" name="img_desc[]" class="w200"/>
                                      上传文件  <input type="file" name="img_url[]" />
                                      <input type="text" class="w400" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]"/>
                                    </td>
                                  </tr>
                            </table>
                        </div>
                        <div id="linkgoods-tab">
                            <table class="table1">
                                <tr>
                                    <td colspan="3">
                                         <img src="__STATIC__/image/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
                                         <select name="cat_id1">
                                            <option value="0">所有分类</option>
                                            {$cat_list}
                                         </select>
                                         <select name="brand_id1">
                                            <option value="0">所有品牌</option>
                                            <html_options  options="{$brand_list}"  />
                                         </select>
                                         <input type="text" name="keyword1" />
                                        <input type="button" value="搜索"  class="button"
                                        onclick="searchGoods(sz1, 'cat_id1','brand_id1','keyword1')" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>可选商品</th>
                                    <th>操作</th>
                                    <th>跟该商品关联的商品</th>
                                </tr>
                                <tr>
                                    <td width="42%">
                                      <select name="source_select1" size="20" style="width:100%" ondblclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" multiple="true">
                                      </select>
                                    </td>
                                    <td align="center">
                                      <p>
                                        <input name="is_single" type="radio" value="1" checked="checked" />单向关联<br />
                                        <input name="is_single" type="radio" value="0" />双向关联
                                      </p>
                                      <p><input type="button" value=">>" onclick="sz1.addItem(true, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" class="button" /></p>
                                      <p><input type="button" value=">" onclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" class="button" /></p>
                                      <p><input type="button" value="<" onclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                      <p><input type="button" value="<<" onclick="sz1.dropItem(true, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                    </td>
                                    <td width="42%">
                                      <select name="target_select1" size="20" style="width:100%" multiple ondblclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)">
                                        <foreach from="$link_goods_list" value="$link_goods" >
                                        <option value="{$link_goods.goods_id}">{$link_goods.goods_name}</option>
                                        </foreach>
                                      </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="groupgoods-tab">
                            <table class="table1">
                                <tr>
                                    <td colspan="3">
                                        <img src="__STATIC__/image/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
                                        <select name="cat_id2">
                                            <option value="0">所有分类</option>
                                            {$cat_list}
                                        </select>
                                        <select name="brand_id2">
                                            <option value="0">所有品牌</option>
                                            <html_options  options="{$brand_list}"  />
                                        </select>
                                        <input type="text" name="keyword2" />
                                        <input type="button" value="搜索" onclick="searchGoods(sz2, 'cat_id2', 'brand_id2', 'keyword2')" class="button" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>可选商品</th>
                                    <th>操作</th>
                                    <th>该商品的配件</th>
                                  </tr>
                                <tr>
                                    <td width="42%">
                                        <select name="source_select2" size="20" style="width:100%" onchange="sz2.priceObj.value = this.options[this.selectedIndex].id" ondblclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)">
                                        </select>
                                    </td>
                                    <td align="center">
                                        <p>价格<br /><input name="price2" type="text" size="6" /></p>
                                        <p><input type="button" value=">" onclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)" class="button" /></p>
                                        <p><input type="button" value="<" onclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                        <p><input type="button" value="<<" onclick="sz2.dropItem(true, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                    </td>
                                    <td width="42%">
                                      <select name="target_select2" size="20" style="width:100%" multiple ondblclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)">
                                        <foreach from="$group_goods_list" value="$group_goods">
                                        <option value="{$group_goods.goods_id}">{$group_goods.goods_name}</option>
                                        </foreach>
                                      </select>
                                    </td>
                                </tr> 
                            </table>
                        </div>
                        <div id="article-tab">
                            <table class="table1">
                                <tr>
                                    <td colspan="3">
                                      <img src="__STATIC__/image/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
                                      文章标题 <input type="text" name="article_title" />
                                      <input type="button" value="搜索" onclick="searchArticle()" class="button" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>可选文章</th>
                                    <th>操作</th>
                                    <th>跟该商品关联的文章</th>
                                  </tr>
                                <tr>
                                    <td width="45%">
                                      <select name="source_select3" size="20" style="width:100%" multiple ondblclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)">
                                      </select>
                                    </td>
                                    <td align="center">
                                      <p><input type="button" value=">>" onclick="sz3.addItem(true, 'add_goods_article', goodsId, this.form.elements['price2'].value)" class="button" /></p>
                                      <p><input type="button" value=">" onclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)" class="button" /></p>
                                      <p><input type="button" value="<" onclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                      <p><input type="button" value="<<" onclick="sz3.dropItem(true, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" class="button" /></p>
                                    </td>
                                    <td width="45%">
                                      <select name="target_select3" size="20" style="width:100%" multiple ondblclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)">
                                        <foreach from="$goods_article_list" value="$goods_article">
                                        <option value="{$goods_article.article_id}">{$goods_article.title}</option>
                                        </foreach>
                                      </select>
                                    </td>
                                </tr>
                            </table>
                            <div class="button-div">
                              <input type="hidden" name="goods_id" value="{$goods.goods_id}" />
                              <if value="$code neq ''">
                              <input type="hidden" name="extension_code" value="{$code}" />
                              </if>
                              <input type="reset" value="{$lang.button_reset}" class="button" />
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
                <div class="position-bottom">
                    <input type="button" class="zh-success" value="確認"  onclick="validate('{$goods.goods_id}')"/>
                    <input type="reset" value="重置"  value="zh-cancel" class="button" />
                </div>
                <input type="hidden" name="act" value="{$form_act}" />
            </form>
            <br /><br /><br /><br /><br /><br /><br /><br /><br />
		</div>

<script>
    var goodsId = '{$goods.goods_id}';
    var elements = document.forms['theForm'].elements;
    var sz1 = new SelectZone(1, elements['source_select1'], elements['target_select1']);
    var sz2 = new SelectZone(2, elements['source_select2'], elements['target_select2'], elements['price2']);
    var sz3 = new SelectZone(1, elements['source_select3'], elements['target_select3']);
    var marketPriceRate ={$config_value.market_price_rate|default_value:@@,1};
    var integralPercent = {$config_value.integral_percent|default_value:@@,0};
    
    $(function () {
        handlePromote(document.forms['theForm'].elements['is_promote'].checked);
        if (document.forms['theForm'].elements['auto_thumb'])
        {
          handleAutoThumb(document.forms['theForm'].elements['auto_thumb'].checked);
        }
        
    });
    
    /**
   * 鍒犻櫎鍥剧墖
   */
  function dropImg(imgId)
  {
    var params = "img_id=" + imgId ;
      var ajaxurl=CONTROL +"&is_ajax=1&m=drop_image";
      Ajax.call(ajaxurl, params, dropImgResponse, "GET", "JSON");
   // Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  }
    
  function dropImgResponse(result)
  {
      if (result.error == 0)
      {
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  }
  
  function validate(goods_id)
  {
    var validator = new Validator('theForm');
    var goods_sn  = document.forms['theForm'].elements['goods_sn'].value;
    validator.required('goods_name', "商品名称不能为空。");
    if (document.forms['theForm'].elements['cat_id'].value == 0)
    {
        validator.addErrorMsg("商品分类必须选择。");
    }
    checkVolumeData("1",validator);
    validator.required('shop_price', "本店售价不能为空。");
    validator.isNumber('shop_price',  "本店售价不是数值。", true);
    validator.isNumber('market_price',  "市场价格不是数字", false);
    if (document.forms['theForm'].elements['is_promote'].checked)
      {
          validator.required('promote_start_date', "促销开始时间不能为空");
          validator.required('promote_end_date', "促销结束时间不能为空");
          validator.islt('promote_start_date', 'promote_end_date', "促销开始日期不能大于结束日期");
      }
      if (document.forms['theForm'].elements['goods_number'] != undefined)
      {
          validator.isInt('goods_number',  "商品库存不是整数", false);
          validator.isInt('warn_number', "库存警告不是整数", false);
      }
      var callback = function(res)
      {
        if (res.error > 0)
        {
            alert('您输入的货号已存在，请换一个');
        }else
        {
            if(validator.passed())
             {
             document.forms['theForm'].submit();
             }
        }
      }
      var params = "goods_sn=" + goods_sn + "&goods_id=" + goods_id;
      var ajaxurl=CONTROL +"&is_ajax=1&m=check_goods_sn";
      Ajax.call(ajaxurl, params, callback, "GET", "JSON");
       //Ajax.call('goods.php?is_ajax=1&act=check_goods_sn', "goods_sn=" + goods_sn + "&goods_id=" + goods_id, callback, "GET", "JSON");
  }
  

     /**
   * 鍏宠仈鏂囩珷鍑芥暟
   */
  function searchArticle()
  {
    var filters = new Object;

    filters.title = Utils.trim(elements['article_title'].value);

    sz3.loadOptions('get_article_list', filters);
  }
    
    
  /* 鍏宠仈鍟嗗搧鍑芥暟 */
  function searchGoods(szObject, catId, brandId, keyword)
  {
      var filters = new Object;
    
      filters.cat_id = elements[catId].value;
      filters.brand_id = elements[brandId].value;
      filters.keyword = Utils.trim(elements[keyword].value);
      filters.exclude = document.forms['theForm'].elements['goods_id'].value;
      
      szObject.loadOptions('get_goods_list', filters);
  }
  
  /**
   * 鍒犻櫎鍥剧墖涓婁紶
   */
  function removeImg(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');

      tbl.deleteRow(row);
  }
    
  /**
   * 鏂板?涓€涓?浘鐗
   */
  function addImg(obj)
  {
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  }

    
  /**
   * 鍒囨崲鍟嗗搧绫诲瀷
   */
  function getAttrList(goodsId)
  {
      var selGoodsType = document.forms['theForm'].elements['goods_type'];

      if (selGoodsType != undefined)
      {
          var goodsType = selGoodsType.options[selGoodsType.selectedIndex].value;
            
            var params = 'goods_id=' + goodsId + "&goods_type=" + goodsType;
            var ajaxurl=CONTROL +"&is_ajax=1&m=get_attr";
            
          Ajax.call(ajaxurl, params, setAttrList, "GET", "JSON");
      }
  }
  
  function setAttrList(result, text_result)
  {
    document.getElementById('tbody-goodsAttr').innerHTML = result.content;
  }
  
  /**
   * 鍒犻櫎瑙勬牸鍊
   */
  function removeSpec(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('attrTable');

      tbl.deleteRow(row);
  }

    
    
/**
   * 鏂板?涓€涓??鏍
   */
  function addSpec(obj)
  {
      var src   = obj.parentNode.parentNode;
      var idx   = rowindex(src);
      var tbl   = document.getElementById('attrTable');
      var row   = tbl.insertRow(idx + 1);
      var cell1 = row.insertCell(-1);
      var cell2 = row.insertCell(-1);
      var regx  = /<a([^>]+)<\/a>/i;

      cell1.className = 'label';
      cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
      cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
  }
    
  function handleAutoThumb(checked)
  {
      document.forms['theForm'].elements['goods_thumb'].disabled = checked;
      document.forms['theForm'].elements['goods_thumb_url'].disabled = checked;
  }
  
   function handlePromote(checked)
  {
      document.forms['theForm'].elements['promote_price'].disabled = !checked;
      document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      document.forms['theForm'].elements['selbtn2'].disabled = !checked;
  }
    
    
   /**
   * 灏嗙Н鍒嗚喘涔伴?搴﹀彇鏁
   */
  function parseint_integral()
  {
    document.forms['theForm'].elements['integral'].value = parseInt(document.forms['theForm'].elements['integral'].value);
  }
    
  /**
   * 灏嗗競鍦轰环鏍煎彇鏁
   */
  function integral_market_price()
  {
    document.forms['theForm'].elements['market_price'].value = parseInt(document.forms['theForm'].elements['market_price'].value);
  }

  /**
   * 鍒犻櫎浼樻儬浠锋牸
   */
  function removeVolumePrice(obj)
  {
    var row = rowindex(obj.parentNode.parentNode);
    var tbl = document.getElementById('tbody-volume');

    tbl.deleteRow(row);
  }

    
  /**
   * 鏂板?涓€涓?紭鎯犱环鏍
   */
  function addVolumePrice(obj)
  {
    var src      = obj.parentNode.parentNode;
    var tbl      = document.getElementById('tbody-volume');

    var validator  = new Validator('theForm');
    checkVolumeData("0",validator);
    if (!validator.passed())
    {
      return false;
    }

    var row  = tbl.insertRow(tbl.rows.length);
    var cell = row.insertCell(-1);
    cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addVolumePrice)(.*)(\[)(\+)/i, "$1removeVolumePrice$3$4-");

    var number_list = document.getElementsByName("volume_number[]");
    var price_list  = document.getElementsByName("volume_price[]");

    number_list[number_list.length-1].value = "";
    price_list[price_list.length-1].value   = "";
  }
  
  /**
   * 鏍￠獙浼樻儬鏁版嵁鏄?惁姝ｇ‘
   */
  function checkVolumeData(isSubmit,validator)
  {
    var volumeNum = document.getElementsByName("volume_number[]");
    var volumePri = document.getElementsByName("volume_price[]");
    var numErrNum = 0;
    var priErrNum = 0;
    for (i = 0 ; i < volumePri.length ; i ++)
    {
        if (
            (isSubmit != 1 || volumeNum.length > 1) && 
            numErrNum <= 0 && 
            volumeNum.item(i).value == "")
        {
            validator.addErrorMsg('请输入优惠数量');
            numErrNum++;
        }
        if (numErrNum <= 0 && 
            Utils.trim(volumeNum.item(i).value) != "" && 
            ! Utils.isNumber(Utils.trim(volumeNum.item(i).value)))
        {
            validator.addErrorMsg('优惠数量不是数字');
            numErrNum++;
        }
        if (
            (isSubmit != 1 || volumePri.length > 1) && 
            priErrNum <= 0 && 
            volumePri.item(i).value == "")
        {
            validator.addErrorMsg('请输入优惠价格');
            priErrNum++;
        }
        if (priErrNum <= 0 && 
            Utils.trim(volumePri.item(i).value) != "" && 
            ! Utils.isNumber(Utils.trim(volumePri.item(i).value)))
        {
            validator.addErrorMsg('优惠价格不是数字');
            priErrNum++;
        }
    }
  }
    
  /**
   * 鏍规嵁甯傚満浠锋牸锛岃?绠楀苟鏀瑰彉鍟嗗簵浠锋牸銆佺Н鍒嗕互鍙婁細鍛樹环鏍
   */
  function marketPriceSetted()
  {
    computePrice('shop_price', 1/marketPriceRate, 'market_price');
    computePrice('integral', integralPercent / 100);

    <foreach from="$user_rank_list" value="$item">
    set_price_note({$item.rank_id});
    </foreach>
  }
    
    
  /**
   * 鎸夋瘮渚嬭?绠椾环鏍
   * @param   string  inputName   杈撳叆妗嗗悕绉
   * @param   float   rate        姣斾緥
   * @param   string  priceName   浠锋牸杈撳叆妗嗗悕绉帮紙濡傛灉娌℃湁锛屽彇shop_price锛
   */
  function computePrice(inputName, rate, priceName)
  {
     var shopPrice = priceName == undefined ? document.forms['theForm'].elements['shop_price'].value : document.forms['theForm'].elements[priceName].value;
     shopPrice = Utils.trim(shopPrice) != '' ? parseFloat(shopPrice)* rate : 0;
     if(inputName == 'integral')
     {
        shopPrice = parseInt(shopPrice);
     }
     shopPrice += "";
     n = shopPrice.lastIndexOf(".");
     if (n > -1)
     {
        shopPrice = shopPrice.substr(0, n + 3);
     }
     if (document.forms['theForm'].elements[inputName] != undefined)
     {
        document.forms['theForm'].elements[inputName].value = shopPrice;
     }else{
        document.getElementById(inputName).value = shopPrice;
     }
  }

  /**
   * 璁剧疆浜嗕竴涓?晢鍝佷环鏍硷紝鏀瑰彉甯傚満浠锋牸銆佺Н鍒嗕互鍙婁細鍛樹环鏍
   */
  function priceSetted()
  {
    computePrice('market_price', marketPriceRate);
    computePrice('integral', integralPercent / 100);
    <foreach from="$user_rank_list" value="$item">
    set_price_note({$item.rank_id});
    </foreach>
  }

  /**
   * 璁剧疆浼氬憳浠锋牸娉ㄩ噴
   */
  function set_price_note(rank_id)
  {
    var shop_price = parseFloat(document.forms['theForm'].elements['shop_price'].value);
    var rank = new Array();
    <foreach from="$user_rank_list" value="$item">
    rank[{$item.rank_id}] = {$item.discount|default_value:@@,100};
    </foreach>
    if (shop_price >0 && 
        rank[rank_id] && 
        document.getElementById('rank_' + rank_id) && 
        parseInt(document.getElementById('rank_' + rank_id).value) == -1)
    {
        var price = parseInt(shop_price * rank[rank_id] + 0.5) / 100;
        if (document.getElementById('nrank_' + rank_id))
        {
            document.getElementById('nrank_' + rank_id).innerHTML = '(' + price + ')';
        }
    }
    else
    {
        if (document.getElementById('nrank_' + rank_id))
        {
            document.getElementById('nrank_' + rank_id).innerHTML = '';
        }
    }
  }




  function hideBrandDiv()
  {
      var brand_add_div = document.getElementById("brand_add");
      if(brand_add_div.style.display != 'none')
      {
          brand_add_div.style.display = 'none';
      }
  }
  
  function goBrandPage()
  {
      if(confirm("本页数据将丢失，确认要去商品品牌页添加品牌吗"))
      {
          var url=APP +"&c=Brand&m=add";
          window.location.href=url;
      }
      else
      {
          return;
      }
  }
  

    function addBrand()
  {
      var brand = document.forms['theForm'].elements['addedBrandName'];
      if(brand.value.replace(/^\s+|\s+$/g, '') == '')
      {
          alert('品牌名不能为空');
          return;
      }

      var params = 'brand=' + brand.value;
      
      var ajaxurl=APP +"&is_ajax=1&c=Brand&m=add_brand";
      
      Ajax.call(ajaxurl, params, addBrandResponse, 'GET', 'JSON');
  }

  function addBrandResponse(result)
  {
      if (result.error == '1' && result.message != '')
      {
          alert(result.message);
          return;
      }

      var brand_div = document.getElementById("brand_add");
      brand_div.style.display = 'none';

      var response = result.content;

      var selCat = document.forms['theForm'].elements['brand_id'];
      var opt = document.createElement("OPTION");
      opt.value = response.id;
      opt.selected = true;
      opt.text = response.brand;

      if (Browser.isIE)
      {
          selCat.add(opt);
      }
      else
      {
          selCat.appendChild(opt);
      }

      return;
  }

  /**
   * 蹇?€熸坊鍔犲搧鐗
   */
  function rapidBrandAdd(conObj)
  {
      var brand_div = document.getElementById("brand_add");

      if(brand_div.style.display != '')
      {
          var brand =document.forms['theForm'].elements['addedBrandName'];
          brand.value = '';
          brand_div.style.display = '';
      }
  }

    /**
   * 娣诲姞鎵╁睍鍒嗙被
   */
  function addOtherCat(conObj)
  {
      var sel = document.createElement("SELECT");
      var selCat = document.forms['theForm'].elements['cat_id'];

      for (i = 0; i < selCat.length; i++)
      {
          var opt = document.createElement("OPTION");
          opt.text = selCat.options[i].text;
          opt.value = selCat.options[i].value;
          if (Browser.isIE)
          {
              sel.add(opt);
          }
          else
          {
              sel.appendChild(opt);
          }
      }
      conObj.appendChild(sel);
      sel.name = "other_cat[]";
      sel.onChange = function() {checkIsLeaf(this);};
  }

function goCatPage()
{
    if(confirm("本页数据将丢失，确认要去商品分类页添加分类吗"))
    {
        var url=APP +"&c=GoodsCategory&m=add";
        window.location.href=url;
    }
    else
    {
        return;
    }
}
    
    
function addCategory()
{
    var parent_id = document.forms['theForm'].elements['cat_id'];
    var cat = document.forms['theForm'].elements['addedCategoryName'];
    if(cat.value.replace(/^\s+|\s+$/g, '') == '')
    {
        alert('分类名不能为空');
        return;
    }
    
    var params = 'parent_id=' + parent_id.value;
    params += '&cat=' + cat.value;
    var ajaxurl=APP +"&is_ajax=1&c=GoodsCategory&m=add_category";
    Ajax.call(ajaxurl, params, addCatResponse, 'GET', 'JSON');
}

function addCatResponse(result)
{
    if (result.error == '1' && result.message != '')
    {
        alert(result.message);
        return;
    }
    var category_add_div = document.getElementById("category_add");
    category_add_div.style.display = 'none';
    
    var response = result.content;
    
    var selCat = document.forms['theForm'].elements['cat_id'];
    var opt = document.createElement("OPTION");
    opt.value = response.id;
    opt.selected = true;
    opt.innerHTML = response.cat;
    
    var str = selCat.options[selCat.selectedIndex].text;
    var temp = str.replace(/^\s+/g, '');
    var lengOfSpace = str.length - temp.length;
    if(response.parent_id != 0)
    {
        lengOfSpace += 4;
    }
    for (i = 0; i < lengOfSpace; i++)
    {
        opt.innerHTML = '&nbsp;' + opt.innerHTML;
    }
    for (i = 0; i < selCat.length; i++)
    {
        if(selCat.options[i].value == response.parent_id)
        {
            if(i == selCat.length)
            {
                if (Browser.isIE)
                {
                    selCat.add(opt);
                }
                else
                {
                    selCat.appendChild(opt);
                }
            }
            else
            {
                selCat.insertBefore(opt, selCat.options[i + 1]);
            }
            //opt.selected = true;
            break;
          }

      }

      return;
}
  
function hideCatDiv()
{
    var category_add_div = document.getElementById("category_add");
    if(category_add_div.style.display != null)
    {
        category_add_div.style.display = 'none';
    }
}

function rapidCatAdd()
{
    var cat_div = document.getElementById("category_add");
    
    if(cat_div.style.display != '')
    {
        var cat =document.forms['theForm'].elements['addedCategoryName'];
        cat.value = '';
        cat_div.style.display = '';
    }
}

function checkGoodsSn(goods_sn, goods_id)
{
    if (goods_sn == '')
    {
        document.getElementById('goods_sn_notice').innerHTML = "";
        return;
    }
    var callback = function(res)
    {
        //alert(res);
        if (res.error > 0)
        {
            document.getElementById('goods_sn_notice').innerHTML = res.message;
            document.getElementById('goods_sn_notice').style.color = "red";
        }
        else
        {
            document.getElementById('goods_sn_notice').innerHTML = "";
        }
    }
    var ajaxurl=CONTROL +"&is_ajax=1&m=check_goods_sn";
    Ajax.call(ajaxurl, "goods_sn=" + goods_sn + "&goods_id=" + goods_id, callback, "GET", "JSON");
    
}
  
</script>
	</body>
</html>