<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>修改订单</title>
    <zhjs />
    <js file="__CONTROL_TPL__/js/addEdit.js"/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    <link rel="stylesheet" href="__TEMPLATE__/common/css/import.css">
	<link rel="stylesheet" href="__TEMPLATE__/common/css/list.css">
</head>
<body>
<form action="{|U:edit}" method="post" id="edit" class="zh-form">
    <div>
        <div class="content_left">
            <div class="title-header">修改订单</div>
            <table class="table1">
                <tr>
                    <th class="w80">处理状态</th>
                    <td colspan="4">
                        <select name="status">
                            <foreach from="$lists.status" value="$s" key="$key">
                            <option value="{$key}" <if value="$order.status==$key">selected='selected'</if>>{$s}</option>
                            </foreach>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="w80">订单号</th>
                    <td>{$order.ordersn}</td>
                </tr>
                <tr>
                    <th>备注</th>
                    <td colspan="4">
                        <textarea name="admin_note" cols="100" rows="8">{$order.admin_note}</textarea>
                    </td>
                </tr>
                <tr>
                    <th class="w80">线路选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="{$lineinfo.linename}" class="lineid_show" style="width:300px;" />
                        <input type="hidden" value="{$order.productautoid}" class="" name="lineid" id="lineid" />
                        <span id="zh_lineid"></span>
                        <button class="zh-cancel-small" type="button" onclick="selectlineid();">选择</button>
                        <span class="err_lineid" style="color: #fc4169;"></span>
                    </td>
                </tr>
                <tr>
                    <th class="w80">套餐选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="{$suit.suitname}" class="suitid_show" style="width: 300px;" />
                        <input type="hidden" value="{$order.suitid}" class="" name="suitid" id="suitid" validate="1" />
                        <span id="zh_suitid"></span>
                        <button class="zh-cancel-small" type="button" onclick="selectsuitid();">选择</button>
                        <span class="err_suitid" style="color: #fc4169;"></span>
                    </td>
                </tr>
                <tr>
                    <th class="w100">出发日期选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="{$order.usedate}" class="usedate_show" style="width: 300px;" validate="1" /><span id="zh_usedate"></span>
                        <input type="hidden" name="usedate" id="usedate" value="{$order.usedate}"/>
                        <button class="zh-cancel-small" type="button" onclick="selectusedate();">选择</button>
                        <span class="err_usedate" style="color: #fc4169;"></span>
                    </td>
                </tr>
                <tr>
                    <th class="w100" rowspan="4">预定人数</th>
                    <td>
                        <span>类型</span>
                    </td>
                    <td>
                        <span>单价</span>
                    </td>
                    <td>
                        <span>数量</span>
                    </td>
                    <td>
                        <span>金额</span>
                    </td>
                </tr>
                <if value="empty($order.dingnum)">
                <tr id="hasadult" style="display: none;">
                <else/>
                <tr id="hasadult">
                </if>
                    <td>
                        <span>成人</span>
                    </td>
                    <td>
                        &yen;<span class="adultprice">{$order.price}</span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="1" class="gm_num num" id="adultnum" name="adultnum" readonly value="{$order.dingnum}" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="adulttotalprice">{$order["price"]*$order["dingnum"]}</span>
                    </td>
                </tr>
                <if value="empty($order.childnum)">
                <tr id="haschild" style="display: none;">
                <else/>
                <tr id="haschild">
                </if>
                    <td>
                        <span>儿童</span>
                    </td>
                    <td>
                        &yen;<span class="childprice">{$order.childprice}</span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="2" class="gm_num num" id="childnum" name="childnum" readonly value="{$order.childnum}" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="childtotalprice">{$order["childprice"]*$order["childnum"]}</span>
                    </td>
                </tr>
                <if value="empty($order.oldnum)">
                <tr id="hasold" style="display: none;">
                <else/>
                <tr id="hasold">
                </if>
                    <td>
                        <span>婴儿</span>
                    </td>
                    <td>
                        &yen;<span class="oldprice">{$order.oldprice}</span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="3" class="gm_num num" id="oldnum" name="oldnum" readonly value="{$order.oldnum}" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="oldtotalprice">{$order["oldprice"]*$order["oldnum"]}</span>
                    </td>
                </tr>
            </table>
            <br />
            <section class="order_block">
							<h2 class="order_ttl"><strong>预订人信息</strong></h2>
							<div class="order_content">
								<table class="order_person_info_table table_style_01">
									<tbody>
										<tr>
											<th>预订联系人<span class="tb_imp">（必填）</span><span class="tb_imp err_linkman"></span></th>
											<th>联系手机<span class="tb_imp">（必填）</span><span class="tb_imp err_linktel"></span></th>
										</tr>
										<tr>
											<td>
                                                <input type="text" name="linkman" id="linkman" class="sex_input" value="{$order.linkman}" />
                                                <input type="radio" name="linksex" id="male" value="1" <if value="$order.linksex=='1'">checked</if>/><label for="male">男</label>
                                                <input type="radio" name="linksex" id="female" value="2" <if value="$order.linksex=='2'">checked</if>/><label for="female">女</label></td>
											<td>
                                                <input type="text" class="msg_text" name="linktel" id="linktel" value="{$order.linktel}" />
											</td>
										</tr>
										<tr>
											<th>邮箱<span class="tb_imp">（必填）</span><span class="tb_imp err_linkemail"></span></th>
											<th>处理支店<span class="tb_imp">（必填）</span><span class="tb_imp err_handleshop"></span></th>
										</tr>
										<tr>
											<td>
												<input type="text" class="msg_text" name="linkemail" id="linkemail" value="{$order.linkemail}" />
											</td>
											<td>
                                                <select id="handleshop" name="handleshop">
                                                    <foreach from="$handleshop" value="$shopD" key="$shopK" >
                                                        <option value="{$shopK}" <if value='$order.handleshop == $shopK'>selected='selected'</if>>{$shopD}</option>
                                                    </foreach>                                                    
                                                </select>
											</td>
										</tr>
										<tr>
											<th colspan="2">订单留言</th>
										</tr>
										<tr>
											<td colspan="2">
                                                <textarea class="msg_area" name="remarkinfo" cols="30" rows="10">{$order.remark}</textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>
                        
                        <if value="$order.dingnum gt '0' ">
                        <h3 class="order_ttl tourer1"><strong>成人游客</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer1">
							<list from="$tourer.adult" name="tour">
                            <?php $j = $key+1;$i="1".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>成人{$j}</strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername{$i}" id="tourname{$i}" value="{$tour.tourername}">
                                                    <input type="radio" name="tourersex{$i}" id="male{$i}" value="1" <if value="$tour.sex=='1'">checked</if>><label for="male{$i}">男</label>
                                                    <input type="radio" name="tourersex{$i}" id="female{$i}" value="2" <if value="$tour.sex=='2'">checked</if>><label for="female{$i}">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp{$i}" value="{$tour.fnamealp}" id="tourerfnamealp{$i}" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp{$i}" value="{$tour.lnamealp}" id="tourerlnamealp{$i}">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy{$i}" value="{$tour.birthdayy}" id="tourerbirthdayy{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym{$i}" value="{$tour.birthdaym}" id="tourerbirthdaym{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd{$i}" value="{$tour.birthdayd}" id="tourerbirthdayd{$i}">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook{$i}" value="{$tour.passbook}" class="text_msg tourname" id="tourerpassbook{$i}" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey{$i}" value="{$tour.effectivey}" id="tourereffectivey{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem{$i}" value="{$tour.effectivem}" id="tourereffectivem{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived{$i}" value="{$tour.effectived}" id="tourereffectived{$i}">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype{$i}" value="1">
            				</div>
                            </list>
						</section>
                        </if>
                        
                        <if value="$order.childnum gt '0' ">
                        <h3 class="order_ttl tourer2"><strong>儿童游客（2-12周岁）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer2">
							<list from="$tourer.child" name="tour">
                            <?php $j = $key+1;$i="2".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>儿童{$j}</strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername{$i}" id="tourname{$i}" value="{$tour.tourername}">
                                                    <input type="radio" name="tourersex{$i}" id="male{$i}" value="1" <if value="$tour.sex=='1'">checked</if>><label for="male{$i}">男</label>
                                                    <input type="radio" name="tourersex{$i}" id="female{$i}" value="2" <if value="$tour.sex=='2'">checked</if>><label for="female{$i}">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp{$i}" value="{$tour.fnamealp}" id="tourerfnamealp{$i}" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp{$i}" value="{$tour.lnamealp}" id="tourerlnamealp{$i}">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy{$i}" value="{$tour.birthdayy}" id="tourerbirthdayy{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym{$i}" value="{$tour.birthdaym}" id="tourerbirthdaym{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd{$i}" value="{$tour.birthdayd}" id="tourerbirthdayd{$i}">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook{$i}" value="{$tour.passbook}" class="text_msg tourname" id="tourerpassbook{$i}" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey{$i}" value="{$tour.effectivey}" id="tourereffectivey{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem{$i}" value="{$tour.effectivem}" id="tourereffectivem{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived{$i}" value="{$tour.effectived}" id="tourereffectived{$i}">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype{$i}" value="2">
            				</div>
                            </list>
						</section>
                        </if>
                        
                        <if value="$order.oldnum gt '0' ">
                        <h3 class="order_ttl tourer3"><strong>婴儿游客（2周岁以下）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer3">
							<list from="$tourer.old" name="tour">
                            <?php $j = $key+1;$i="3".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>婴儿{$j}</strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername{$i}" id="tourname{$i}" value="{$tour.tourername}">
                                                    <input type="radio" name="tourersex{$i}" id="male{$i}" value="1" <if value="$tour.sex=='1'">checked</if>><label for="male{$i}">男</label>
                                                    <input type="radio" name="tourersex{$i}" id="female{$i}" value="2" <if value="$tour.sex=='2'">checked</if>><label for="female{$i}">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin{$i}"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp{$i}" value="{$tour.fnamealp}" id="tourerfnamealp{$i}" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp{$i}" value="{$tour.lnamealp}" id="tourerlnamealp{$i}">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy{$i}" value="{$tour.birthdayy}" id="tourerbirthdayy{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym{$i}" value="{$tour.birthdaym}" id="tourerbirthdaym{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd{$i}" value="{$tour.birthdayd}" id="tourerbirthdayd{$i}">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook{$i}" value="{$tour.passbook}" class="text_msg tourname" id="tourerpassbook{$i}" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey{$i}" value="{$tour.effectivey}" id="tourereffectivey{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem{$i}" value="{$tour.effectivem}" id="tourereffectivem{$i}" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived{$i}" value="{$tour.effectived}" id="tourereffectived{$i}">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype{$i}" value="3">
            				</div>
                            </list>
						</section>
                        </if>
                        
						<div class="order_all">
							<span class="ttl">订单金额：<strong class="price_one">￥<span class="totalprice">{$order.totalprice}</span></strong></span>
							<!--<a class="btn_03 btnsaveorder" href="javascript:void(0);">立即预订</a>-->
						</div>
            <br /><br /><br /><br />
        </div>
    </div>
    
    <input type="hidden" id="adultprice" name="price" value="{$order.price}"/>
    <input type="hidden" id="childprice" name="childprice" value="{$order.childprice}"/>
    <input type="hidden" id="oldprice" name="oldprice" value="{$order.oldprice}"/>
    <input type="hidden" name="dingjin" value=""/>
    <input type="hidden" id="productautoid" name="productautoid" value="{$order.productautoid}"/>
    <input type="hidden" name="productaid" value=""/>
    <input type="hidden" id="productname" name="productname" value="{$order.productname}"/>
    <input type="hidden" name="oldsuitid" id="oldsuitid" value=""/>
    <input type="hidden" name="typeid" value="{$typeid}"/>
    <input type="hidden" name="id" value="{$order.id}"/>
    <input type="hidden" name="totalprice" class="totalprice" value="{$order.totalprice}" />
    
    <div class="position-bottom">
        <input type="hidden" name="content_state" value="1" />
        <input type="button" class="zh-success" onclick="updateorder();" value="确认"/>
        <input type="button" class="zh-cancel" onclick="window.close();" value="关闭"/>
    </div>
</form>

<script type="text/javascript">
	//$('form').validate({$formValidate});

    //选择线路
    function selectlineid(){
        select_exterior('line','id','linename','线路','linename is not null','single','lineid');
    }
    
    //选择套餐
    function selectsuitid(){
        var lineid = $("#lineid").val();
        if( lineid == ''){
            $("#zh_suitid").html("<span style='color:red;'>请先选择线路</span>");
            setTimeout('$("#zh_suitid").html("")',1000);
        }else{
            //$("#suitid").removeAttr("disabled");
            select_exterior('line_suit','id','suitname','套餐','lineid = '+lineid,'single','suitid');
        }
    }
    
    //选择日期
    function selectusedate(){
        var suitid = $("#suitid").val();
        var gettime = (new Date().getTime())/1000;
        if( suitid == ''){
            $("#zh_usedate").html("<span style='color:red;'>请先选择套餐</span>");
            setTimeout('$("#zh_usedate").html("")',1000);
        }else{
            select_exterior('line_suit_price','day','day','出发日期','suitid='+suitid+' and day > '+gettime+' and adultprice>0 and `number`!=0','single','usedate');
        }
    }
    
    //根据套餐判断 成人 儿童 婴儿
    function afterSingleSelect(field_name,tvalues){
        //alert(field_name);
        if( tvalues[2] ){
            $("."+field_name+"_show").val(tvalues[2]);
        }else{
            $("."+field_name+"_show").val(tvalues[1]);
        }
                
        //判断是否有更新线路以及套餐
        var oldlineid = $("#productautoid").val();
        var oldsuitid = $("#oldsuitid").val();

        var lineid = $("#lineid").val();
        var usedate = $("#usedate").val();
        var suitid = $("#suitid").val();
        
        $("#productautoid").val(lineid);
        //$("#usedate").val(usedate);
        $("#oldsuitid").val(suitid);
        
        if( oldlineid != lineid ){
            $("#suitid").val("");
            $(".suitid_show").val("");
            $("#usedate").val("");
            $(".usedate_show").val("");
            
            $("#oldsuitid").val("");
            
            usedate = '';
            suitid = '';
            $("#haschild").hide();
            $("#hasold").hide();
            return;
        }
        
        if( oldsuitid != suitid ){
            $("#usedate").val("");
            $(".usedate_show").val("");
            
            usedate = '';
            $("#haschild").hide();
            $("#hasold").hide();
            return;
        }
        
        
        if( lineid && usedate && suitid ){
            var lineid = $("#lineid").val();
            var usedate = $("#usedate").val();
            $.ajax({
                url: CONTROL + "&m=ajax_linedetail",
                type:"post",
                data:"lineid="+lineid+"&usedate="+usedate+"&suitid="+suitid,
                success:function(msg){
                    //alert(msg);
                    var data = jQuery.parseJSON(msg);
                    $("#adultprice").val(data.price);
                    $("#childprice").val(data.childprice);
                    $("#oldprice").val(data.oldprice);
                    $(".adultprice").html(data.price);
                    $(".childprice").html(data.childprice);
                    $(".oldprice").html(data.oldprice);
                    $("#productname").val(data.title);
                    
                    booking.countPrice();

                    if(typeof(data.hasadult) != "undefined" && data.hasadult == "1"){
                        $("#hasadult").show();
                    }else if(typeof(data.hasadult) == "undefined"){
                        //隐藏成人
                        $("#hasadult").hide();
                        $("#tourer1").html("");
                        $(".tourer1").hide();
                        $("#adultnum").val("0")
                    }
                    if(typeof(data.haschild) != "undefined" && data.haschild == "1"){
                        $("#haschild").show();
                    }else if(typeof(data.haschild) == "undefined"){
                        //隐藏儿童
                        $("#haschild").hide();
                        $("#tourer2").html("");
                        $(".tourer2").hide();
                        $("#childnum").val("0")
                    }
                    if(typeof(data.hasold) != "undefined" && data.hasold == "1"){
                        $("#hasold").show();
                    }else if(typeof(data.hasold) == "undefined"){
                        //隐藏婴儿
                        $("#hasold").hide();
                        $("#tourer3").html("");
                        $(".tourer3").hide();
                        $("#oldnum").val("0")
                    }
                    
                }
            })
        }else{
            return;
        }
        
    }    
    
    function updateorder(){
        
       var err;
       err = FormCheck();

       if( err == "error" ){
            return;
       }
       dialog_message("数据操作中...", 30);
        var _post = $("#edit").serialize();
        $.ajax({
            type : "POST",
			url : METH,
			dataType : "JSON",
			cache : false,
			data : _post,
            success : function(data) {
                dialog_message(false);
                if(data.state == "1"){
                    $.modal({
						width : 250,
						height : 160,
						button : true,
						title : '信息',
						//button_success : "继续操作",
						button_cancel : "关闭",
						message : data.message,
						type : "success",
						success : function() {
							if (window.opener) {
							    //window.opener.document.test();
								window.opener.location.reload();
							}
							window.location.reload();
						},
						cancel : function() {
							if (window.opener) {
								window.opener.location.reload();
							}
                            window.location.reload();
							window.close();
						}
					})
                }else{
                    $.dialog({
						message : data.message,
						type : "error"
					});
                }
            }
        })
        
    }
    
</script>

</body>
</html>