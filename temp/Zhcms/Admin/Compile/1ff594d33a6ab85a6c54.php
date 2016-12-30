<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>修改订单</title>
    <script type='text/javascript' src='http://www.his.com/zh/ZHPHP/zhphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/css/zhjs.css' rel='stylesheet' media='screen'>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/zhjs.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/slide.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
HOST = '<?php echo $GLOBALS['user']['HOST'];?>';
ROOT = '<?php echo $GLOBALS['user']['ROOT'];?>';
WEB = '<?php echo $GLOBALS['user']['WEB'];?>';
URL = '<?php echo $GLOBALS['user']['URL'];?>';
ZHPHP = '<?php echo $GLOBALS['user']['ZHPHP'];?>';
ZHPHPDATA = '<?php echo $GLOBALS['user']['ZHPHPDATA'];?>';
ZHPHPTPL = '<?php echo $GLOBALS['user']['ZHPHPTPL'];?>';
ZHPHPEXTEND = '<?php echo $GLOBALS['user']['ZHPHPEXTEND'];?>';
APP = '<?php echo $GLOBALS['user']['APP'];?>';
CONTROL = '<?php echo $GLOBALS['user']['CONTROL'];?>';
METH = '<?php echo $GLOBALS['user']['METH'];?>';
GROUP = '<?php echo $GLOBALS['user']['GROUP'];?>';
TPL = '<?php echo $GLOBALS['user']['TPL'];?>';
CONTROLTPL = '<?php echo $GLOBALS['user']['CONTROLTPL'];?>';
STATIC = '<?php echo $GLOBALS['user']['STATIC'];?>';
PUBLIC = '<?php echo $GLOBALS['user']['PUBLIC'];?>';
HISTORY = '<?php echo $GLOBALS['user']['HISTORY'];?>';
TEMPLATE = '<?php echo $GLOBALS['user']['TEMPLATE'];?>';
ROOTURL = '<?php echo $GLOBALS['user']['ROOTURL'];?>';
WEBURL = '<?php echo $GLOBALS['user']['WEBURL'];?>';
CONTROLURL = '<?php echo $GLOBALS['user']['CONTROLURL'];?>';
PHPSELF = '<?php echo $GLOBALS['user']['PHPSELF'];?>';
</script>
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/TourOrder/js/addEdit.js"></script>
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/TourOrder/js/js.js"></script>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/TourOrder/css/css.css"/>
    <link rel="stylesheet" href="http://www.his.com/template/v1/common/css/import.css">
	<link rel="stylesheet" href="http://www.his.com/template/v1/common/css/list.css">
</head>
<body>
<form action="<?php echo U(edit);?>" method="post" id="edit" class="zh-form">
    <div>
        <div class="content_left">
            <div class="title-header">修改订单</div>
            <table class="table1">
                <tr>
                    <th class="w80">处理状态</th>
                    <td colspan="4">
                        <select name="status">
                            <?php if(is_array($lists['status'])):?><?php $index=0; ?><?php  foreach($lists['status'] as $key=>$s){ ?>
                            <option value="<?php echo $key;?>" <?php if($order['status']==$key){?>selected='selected'<?php }?>><?php echo $s;?></option>
                            <?php $index++; ?><?php }?><?php endif;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="w80">订单号</th>
                    <td><?php echo $order['ordersn'];?></td>
                </tr>
                <tr>
                    <th>备注</th>
                    <td colspan="4">
                        <textarea name="admin_note" cols="100" rows="8"><?php echo $order['admin_note'];?></textarea>
                    </td>
                </tr>
                <tr>
                    <th class="w80">线路选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="<?php echo $lineinfo['linename'];?>" class="lineid_show" style="width:300px;" />
                        <input type="hidden" value="<?php echo $order['productautoid'];?>" class="" name="lineid" id="lineid" />
                        <span id="zh_lineid"></span>
                        <button class="zh-cancel-small" type="button" onclick="selectlineid();">选择</button>
                        <span class="err_lineid" style="color: #fc4169;"></span>
                    </td>
                </tr>
                <tr>
                    <th class="w80">套餐选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="<?php echo $suit['suitname'];?>" class="suitid_show" style="width: 300px;" />
                        <input type="hidden" value="<?php echo $order['suitid'];?>" class="" name="suitid" id="suitid" validate="1" />
                        <span id="zh_suitid"></span>
                        <button class="zh-cancel-small" type="button" onclick="selectsuitid();">选择</button>
                        <span class="err_suitid" style="color: #fc4169;"></span>
                    </td>
                </tr>
                <tr>
                    <th class="w100">出发日期选择</th>
                    <td colspan="4">
                        <input type="text" disabled="disabled" value="<?php echo $order['usedate'];?>" class="usedate_show" style="width: 300px;" validate="1" /><span id="zh_usedate"></span>
                        <input type="hidden" name="usedate" id="usedate" value="<?php echo $order['usedate'];?>"/>
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
                <?php if(empty($order['dingnum'])){?>
                <tr id="hasadult" style="display: none;">
                <?php  }else{ ?>
                <tr id="hasadult">
                <?php }?>
                    <td>
                        <span>成人</span>
                    </td>
                    <td>
                        &yen;<span class="adultprice"><?php echo $order['price'];?></span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="1" class="gm_num num" id="adultnum" name="adultnum" readonly value="<?php echo $order['dingnum'];?>" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="adulttotalprice"><?php echo $order["price"]*$order["dingnum"];?></span>
                    </td>
                </tr>
                <?php if(empty($order['childnum'])){?>
                <tr id="haschild" style="display: none;">
                <?php  }else{ ?>
                <tr id="haschild">
                <?php }?>
                    <td>
                        <span>儿童</span>
                    </td>
                    <td>
                        &yen;<span class="childprice"><?php echo $order['childprice'];?></span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="2" class="gm_num num" id="childnum" name="childnum" readonly value="<?php echo $order['childnum'];?>" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="childtotalprice"><?php echo $order["childprice"]*$order["childnum"];?></span>
                    </td>
                </tr>
                <?php if(empty($order['oldnum'])){?>
                <tr id="hasold" style="display: none;">
                <?php  }else{ ?>
                <tr id="hasold">
                <?php }?>
                    <td>
                        <span>婴儿</span>
                    </td>
                    <td>
                        &yen;<span class="oldprice"><?php echo $order['oldprice'];?></span>
                    </td>
                    <td>
						<div class="person_machine">
							<input class="min" type="button" value="-">
                            <input type="text" data="3" class="gm_num num" id="oldnum" name="oldnum" readonly value="<?php echo $order['oldnum'];?>" />
							<input class="plus" type="button" value="+">
						</div>
                    </td>
                    <td>
                        &yen;<span class="oldtotalprice"><?php echo $order["oldprice"]*$order["oldnum"];?></span>
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
                                                <input type="text" name="linkman" id="linkman" class="sex_input" value="<?php echo $order['linkman'];?>" />
                                                <input type="radio" name="linksex" id="male" value="1" <?php if($order['linksex']=='1'){?>checked<?php }?>/><label for="male">男</label>
                                                <input type="radio" name="linksex" id="female" value="2" <?php if($order['linksex']=='2'){?>checked<?php }?>/><label for="female">女</label></td>
											<td>
                                                <input type="text" class="msg_text" name="linktel" id="linktel" value="<?php echo $order['linktel'];?>" />
											</td>
										</tr>
										<tr>
											<th>邮箱<span class="tb_imp">（必填）</span><span class="tb_imp err_linkemail"></span></th>
											<th>处理支店<span class="tb_imp">（必填）</span><span class="tb_imp err_handleshop"></span></th>
										</tr>
										<tr>
											<td>
												<input type="text" class="msg_text" name="linkemail" id="linkemail" value="<?php echo $order['linkemail'];?>" />
											</td>
											<td>
                                                <select id="handleshop" name="handleshop">
                                                    <?php if(is_array($handleshop)):?><?php $index=0; ?><?php  foreach($handleshop as $shopK=>$shopD){ ?>
                                                        <option value="<?php echo $shopK;?>" <?php if($order['handleshop'] == $shopK){?>selected='selected'<?php }?>><?php echo $shopD;?></option>
                                                    <?php $index++; ?><?php }?><?php endif;?>                                                    
                                                </select>
											</td>
										</tr>
										<tr>
											<th colspan="2">订单留言</th>
										</tr>
										<tr>
											<td colspan="2">
                                                <textarea class="msg_area" name="remarkinfo" cols="30" rows="10"><?php echo $order['remark'];?></textarea>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</section>
                        
                        <?php if($order['dingnum'] > '0'){?>
                        <h3 class="order_ttl tourer1"><strong>成人游客</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer1">
							<?php $zh["list"]["tour"]["total"]=0;if(isset($tourer['adult']) && !empty($tourer['adult'])):$_id_tour=0;$_index_tour=0;$lasttour=min(1000,count($tourer['adult']));
$zh["list"]["tour"]["first"]=true;
$zh["list"]["tour"]["last"]=false;
$_total_tour=ceil($lasttour/1);$zh["list"]["tour"]["total"]=$_total_tour;
$_data_tour = array_slice($tourer['adult'],0,$lasttour);
if(count($_data_tour)==0):echo "";
else:
foreach($_data_tour as $key=>$tour):
if(($_id_tour)%1==0):$_id_tour++;else:$_id_tour++;continue;endif;
$zh["list"]["tour"]["index"]=++$_index_tour;
if($_index_tour>=$_total_tour):$zh["list"]["tour"]["last"]=true;endif;?>

                            <?php $j = $key+1;$i="1".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>成人<?php echo $j;?></strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername<?php echo $i;?>" id="tourname<?php echo $i;?>" value="<?php echo $tour['tourername'];?>">
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="male<?php echo $i;?>" value="1" <?php if($tour['sex']=='1'){?>checked<?php }?>><label for="male<?php echo $i;?>">男</label>
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="female<?php echo $i;?>" value="2" <?php if($tour['sex']=='2'){?>checked<?php }?>><label for="female<?php echo $i;?>">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp<?php echo $i;?>" value="<?php echo $tour['fnamealp'];?>" id="tourerfnamealp<?php echo $i;?>" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp<?php echo $i;?>" value="<?php echo $tour['lnamealp'];?>" id="tourerlnamealp<?php echo $i;?>">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy<?php echo $i;?>" value="<?php echo $tour['birthdayy'];?>" id="tourerbirthdayy<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym<?php echo $i;?>" value="<?php echo $tour['birthdaym'];?>" id="tourerbirthdaym<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd<?php echo $i;?>" value="<?php echo $tour['birthdayd'];?>" id="tourerbirthdayd<?php echo $i;?>">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook<?php echo $i;?>" value="<?php echo $tour['passbook'];?>" class="text_msg tourname" id="tourerpassbook<?php echo $i;?>" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey<?php echo $i;?>" value="<?php echo $tour['effectivey'];?>" id="tourereffectivey<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem<?php echo $i;?>" value="<?php echo $tour['effectivem'];?>" id="tourereffectivem<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived<?php echo $i;?>" value="<?php echo $tour['effectived'];?>" id="tourereffectived<?php echo $i;?>">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype<?php echo $i;?>" value="1">
            				</div>
                            <?php $zh["list"]["tour"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
						</section>
                        <?php }?>
                        
                        <?php if($order['childnum'] > '0'){?>
                        <h3 class="order_ttl tourer2"><strong>儿童游客（2-12周岁）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer2">
							<?php $zh["list"]["tour"]["total"]=0;if(isset($tourer['child']) && !empty($tourer['child'])):$_id_tour=0;$_index_tour=0;$lasttour=min(1000,count($tourer['child']));
$zh["list"]["tour"]["first"]=true;
$zh["list"]["tour"]["last"]=false;
$_total_tour=ceil($lasttour/1);$zh["list"]["tour"]["total"]=$_total_tour;
$_data_tour = array_slice($tourer['child'],0,$lasttour);
if(count($_data_tour)==0):echo "";
else:
foreach($_data_tour as $key=>$tour):
if(($_id_tour)%1==0):$_id_tour++;else:$_id_tour++;continue;endif;
$zh["list"]["tour"]["index"]=++$_index_tour;
if($_index_tour>=$_total_tour):$zh["list"]["tour"]["last"]=true;endif;?>

                            <?php $j = $key+1;$i="2".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>儿童<?php echo $j;?></strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername<?php echo $i;?>" id="tourname<?php echo $i;?>" value="<?php echo $tour['tourername'];?>">
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="male<?php echo $i;?>" value="1" <?php if($tour['sex']=='1'){?>checked<?php }?>><label for="male<?php echo $i;?>">男</label>
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="female<?php echo $i;?>" value="2" <?php if($tour['sex']=='2'){?>checked<?php }?>><label for="female<?php echo $i;?>">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp<?php echo $i;?>" value="<?php echo $tour['fnamealp'];?>" id="tourerfnamealp<?php echo $i;?>" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp<?php echo $i;?>" value="<?php echo $tour['lnamealp'];?>" id="tourerlnamealp<?php echo $i;?>">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy<?php echo $i;?>" value="<?php echo $tour['birthdayy'];?>" id="tourerbirthdayy<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym<?php echo $i;?>" value="<?php echo $tour['birthdaym'];?>" id="tourerbirthdaym<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd<?php echo $i;?>" value="<?php echo $tour['birthdayd'];?>" id="tourerbirthdayd<?php echo $i;?>">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook<?php echo $i;?>" value="<?php echo $tour['passbook'];?>" class="text_msg tourname" id="tourerpassbook<?php echo $i;?>" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey<?php echo $i;?>" value="<?php echo $tour['effectivey'];?>" id="tourereffectivey<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem<?php echo $i;?>" value="<?php echo $tour['effectivem'];?>" id="tourereffectivem<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived<?php echo $i;?>" value="<?php echo $tour['effectived'];?>" id="tourereffectived<?php echo $i;?>">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype<?php echo $i;?>" value="2">
            				</div>
                            <?php $zh["list"]["tour"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
						</section>
                        <?php }?>
                        
                        <?php if($order['oldnum'] > '0'){?>
                        <h3 class="order_ttl tourer3"><strong>婴儿游客（2周岁以下）</strong><span class="line"></span></h3>
						<section class="order_block fix order_person_list" id="tourer3">
							<?php $zh["list"]["tour"]["total"]=0;if(isset($tourer['old']) && !empty($tourer['old'])):$_id_tour=0;$_index_tour=0;$lasttour=min(1000,count($tourer['old']));
$zh["list"]["tour"]["first"]=true;
$zh["list"]["tour"]["last"]=false;
$_total_tour=ceil($lasttour/1);$zh["list"]["tour"]["total"]=$_total_tour;
$_data_tour = array_slice($tourer['old'],0,$lasttour);
if(count($_data_tour)==0):echo "";
else:
foreach($_data_tour as $key=>$tour):
if(($_id_tour)%1==0):$_id_tour++;else:$_id_tour++;continue;endif;
$zh["list"]["tour"]["index"]=++$_index_tour;
if($_index_tour>=$_total_tour):$zh["list"]["tour"]["last"]=true;endif;?>

                            <?php $j = $key+1;$i="3".$j;?>
            				<div class="one_person_order msg_list">
            					<h2 class="order_ttl"><strong>婴儿<?php echo $j;?></strong></h2>
            					<div class="order_content">
            						<table class="table_style_01">
            							<tbody>
            								<tr>
            									<th>姓名<span class="tb_imp err_tourername<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
                                                    <input type="text" class="sex_input" name="tourername<?php echo $i;?>" id="tourname<?php echo $i;?>" value="<?php echo $tour['tourername'];?>">
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="male<?php echo $i;?>" value="1" <?php if($tour['sex']=='1'){?>checked<?php }?>><label for="male<?php echo $i;?>">男</label>
                                                    <input type="radio" name="tourersex<?php echo $i;?>" id="female<?php echo $i;?>" value="2" <?php if($tour['sex']=='2'){?>checked<?php }?>><label for="female<?php echo $i;?>">女</label>
                                                </td>
            								</tr>
            								<tr>
            									<th>姓名拼音<span class="tb_imp err_pinyin<?php echo $i;?>"></span></th>
            								</tr>
            								<tr>
            									<td>
            										<input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp<?php echo $i;?>" value="<?php echo $tour['fnamealp'];?>" id="tourerfnamealp<?php echo $i;?>" style="margin-right:65px;">
            										<input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp<?php echo $i;?>" value="<?php echo $tour['lnamealp'];?>" id="tourerlnamealp<?php echo $i;?>">
            									</td>
            								</tr>
            								<tr>
            									<th>出生日期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourerbirthdayy<?php echo $i;?>" value="<?php echo $tour['birthdayy'];?>" id="tourerbirthdayy<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourerbirthdaym<?php echo $i;?>" value="<?php echo $tour['birthdaym'];?>" id="tourerbirthdaym<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourerbirthdayd<?php echo $i;?>" value="<?php echo $tour['birthdayd'];?>" id="tourerbirthdayd<?php echo $i;?>">
                                                </td>
            								</tr>
            								<tr>
            									<th>护照号</th>
            								</tr>
            								<tr>
            									<td>
            										<input type="text" name="tourerpassbook<?php echo $i;?>" value="<?php echo $tour['passbook'];?>" class="text_msg tourname" id="tourerpassbook<?php echo $i;?>" />
            									</td>
            								</tr>
            								<tr>
            									<th>护照有效期</th>
            								</tr>
            								<tr>
            									<td>
                                                    <input class="date_input date_yy" type="text" name="tourereffectivey<?php echo $i;?>" value="<?php echo $tour['effectivey'];?>" id="tourereffectivey<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_mm" type="text" name="tourereffectivem<?php echo $i;?>" value="<?php echo $tour['effectivem'];?>" id="tourereffectivem<?php echo $i;?>" style="margin-right: 46px;">
                                                    <input class="date_input date_dd" type="text" name="tourereffectived<?php echo $i;?>" value="<?php echo $tour['effectived'];?>" id="tourereffectived<?php echo $i;?>">
            									</td>
            								</tr>
            							</tbody>
            						</table>
            					</div>
                                <input type="hidden" name="tourerptype<?php echo $i;?>" value="3">
            				</div>
                            <?php $zh["list"]["tour"]["first"]=false;
endforeach;
endif;
else:
echo "";
endif;?>
						</section>
                        <?php }?>
                        
						<div class="order_all">
							<span class="ttl">订单金额：<strong class="price_one">￥<span class="totalprice"><?php echo $order['totalprice'];?></span></strong></span>
							<!--<a class="btn_03 btnsaveorder" href="javascript:void(0);">立即预订</a>-->
						</div>
            <br /><br /><br /><br />
        </div>
    </div>
    
    <input type="hidden" id="adultprice" name="price" value="<?php echo $order['price'];?>"/>
    <input type="hidden" id="childprice" name="childprice" value="<?php echo $order['childprice'];?>"/>
    <input type="hidden" id="oldprice" name="oldprice" value="<?php echo $order['oldprice'];?>"/>
    <input type="hidden" name="dingjin" value=""/>
    <input type="hidden" id="productautoid" name="productautoid" value="<?php echo $order['productautoid'];?>"/>
    <input type="hidden" name="productaid" value=""/>
    <input type="hidden" id="productname" name="productname" value="<?php echo $order['productname'];?>"/>
    <input type="hidden" name="oldsuitid" id="oldsuitid" value=""/>
    <input type="hidden" name="typeid" value="<?php echo $typeid;?>"/>
    <input type="hidden" name="id" value="<?php echo $order['id'];?>"/>
    <input type="hidden" name="totalprice" class="totalprice" value="<?php echo $order['totalprice'];?>" />
    
    <div class="position-bottom">
        <input type="hidden" name="content_state" value="1" />
        <input type="button" class="zh-success" onclick="updateorder();" value="确认"/>
        <input type="button" class="zh-cancel" onclick="window.close();" value="关闭"/>
    </div>
</form>

<script type="text/javascript">
	//$('form').validate(<?php echo $formValidate;?>);

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