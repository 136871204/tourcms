<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?>
		<div class="left_content comfirm_content">
			<section class="order_block order_block_border_01">
				<h2 class="order_ttl"><strong>产品信息</strong><span>（产品编号：<?php echo $data['lineseries'];?>）</span></h2>
				<div class="order_content">
					<table class="order_info_table">
						<tbody>
							<tr>
								<th>产品名称</th>
								<td><?php echo $data['title'];?></td>
							</tr>
							<tr>
								<th>产品类型</th>
								<td><?php echo $data['suitname'];?></td>
							</tr>
							<tr>
								<th>出发日期</th>
								<td><?php echo $data['day'];?>(周<?php echo getWeekDay(date('w',strtotime($data['day'])));?>)</td>
							</tr>
							<tr>
								<th>出发城市</th>
								<td><?php echo $data['startcity'];?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
			<section class="order_block">
				<h2 class="order_ttl"><strong>预订人数</strong></h2>
				<div class="order_content order_content_style_01">
					<table class="order_person_table">
						<thead>
							<tr>
								<th>类型</th>
								<th>单价</th>
								<th>购买数量</th>
								<th>金额</th>
							</tr>
						</thead>
						<tbody>
                            <?php if($data['adultnum'] > 0){?>
							<tr>
								<th>成人</th>
								<td>￥<?php echo $data['adultprice'];?></td>
								<td>                                    
									<div class="person_machine">
										<input class="num" type="text" name="" id="" value="<?php echo $data['adultnum'];?>" disabled="disabled">
									</div>
                                </td>
								<td>￥<?php echo $data["adultprice"]*$data["adultnum"];?></td>
							</tr>
                            <?php }?>
                            <?php if($data['childnum'] > 0){?>
							<tr>
								<th>儿童</th>
								<td>￥<?php echo $data['childprice'];?></td>
								<td>                                    
									<div class="person_machine">
										<input class="num" type="text" name="" id="" value="<?php echo $data['childnum'];?>" disabled="disabled">
									</div>
                                </td>
								<td>￥<?php echo $data["childprice"]*$data["childnum"];?></td>
							</tr>
                            <?php }?>
                            <?php if($data['oldnum'] > 0){?>
							<tr>
								<th>婴儿</th>
								<td>￥<?php echo $data['oldprice'];?></td>
								<td>                                    
									<div class="person_machine">
										<input class="num" type="text" name="" id="" value="<?php echo $data['oldnum'];?>" disabled="disabled">
									</div>
                                </td>
								<td>￥<?php echo $data["oldprice"]*$data["oldnum"];?></td>
							</tr>
                            <?php }?>
						</tbody>
					</table>
				</div>
			</section>
			<section class="order_block">
				<h2 class="order_ttl"><strong>预订人信息</strong></h2>
				<div class="order_content">
					<table class="order_person_info_table table_style_01">
						<tbody>
							<tr>
								<th>预订联系人</th>
								<th>联系手机</th>
							</tr>
							<tr>
                                <td><input type="text" name="" id="" class="sex_input" value="<?php echo $data['linkman'];?>" disabled="disabled"><span><?php if($data['linksex']=='1'){?>男<?php  }else{ ?>女<?php }?></span></td>
								<td>
									<input type="text" value="<?php echo $data['linktel'];?>" id="" disabled="disabled" />
								</td>
							</tr>
							<tr>
								<th>邮箱</th>
								<th>处理支店</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="" id="" value="<?php echo $data['linkemail'];?>" disabled="disabled">
								</td>
								<td>
									<span><?php echo $handleshop[$data['handleshop']];?></span>
								</td>
							</tr>
							<tr>
								<th colspan="2">订单留言</th>
							</tr>
							<tr>
								<td colspan="2"><span><?php echo nl2br(htmlspecialchars($data['remarkinfo']));?></span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>        
			
            <?php if($data['adultnum'] > 0){?>
            <h3 class="order_ttl"><strong>成人游客</strong><span class="line"></span></h3>
			<section class="order_block fix order_person_list">
                <?php 
                    for($i=1;$i<=$data["adultnum"];$i++){
                        $k = "1".$i;
                ?>
				<div class="one_person_order">
					<h2 class="order_ttl"><strong>成人<?php echo $i;?></strong></h2>
					<div class="order_content">
						<table class="table_style_01">
							<tbody>
								<tr>
									<th>姓名</th>
								</tr>
								<tr>
									<td><input type="text" class="sex_input" value="<?php echo $data["tourername".$k]?>" disabled="disabled" ><span><?php if($data["tourersex".$k]=="1"){echo "男";}else{echo "女";}?></span></td>
								</tr>
								<tr>
									<th>姓名拼音</th>
								</tr>
								<tr>
									<td>
										<input class="pinyin_input fname_pinyin" type="text" value="<?php echo $data["tourerfnamealp".$k]?>" style="margin-right:65px;" disabled="disabled" >
										<input class="pinyin_input lname_pinyin" type="text" value="<?php echo $data["tourerlnamealp".$k]?>" disabled="disabled" />
									</td>
								</tr>
								<tr>
									<th>出生日期</th>
								</tr>
								<tr>
									<td>
                                    <?php if($data["tourerbirthdayy".$k]){?>
                                    <span><?php echo $data["tourerbirthdayy".$k]?> 年 <?php echo $data["tourerbirthdaym".$k]?> 月 <?php echo $data["tourerbirthdayd".$k]?> 日 </span>
									<?php }?>
                                    </td>
								</tr>
								<tr>
									<th>护照号</th>
								</tr>
								<tr>
									<td>
										<span><?php echo $data["tourerpassbook".$k]?></span>
									</td>
								</tr>
								<tr>
									<th>护照有效期</th>
								</tr>
								<tr>
									<td>
                                    <?php if ($data["tourereffectivey".$k]){?>
                                    <span><?php echo $data["tourereffectivey".$k]?> 年 <?php echo $data["tourereffectivem".$k]?> 月 <?php echo $data["tourereffectived".$k]?> 日 </span>
                                    <?php }?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <?php } ?>
			</section>
            <?php }?>       
			
            <?php if($data['childnum'] > 0){?>
            <h3 class="order_ttl"><strong>儿童游客（2-12周岁）</strong><span class="line"></span></h3>
			<section class="order_block fix order_person_list">
                <?php 
                    for($i=1;$i<=$data["childnum"];$i++){
                        $k = "2".$i;
                ?>
				<div class="one_person_order">
					<h2 class="order_ttl"><strong>儿童<?php echo $i;?></strong></h2>
					<div class="order_content">
						<table class="table_style_01">
							<tbody>
								<tr>
									<th>姓名</th>
								</tr>
								<tr>
									<td><input type="text" class="sex_input" value="<?php echo $data["tourername".$k]?>" disabled="disabled" ><span><?php if($data["tourersex".$k]=="1"){echo "男";}else{echo "女";}?></span></td>
								</tr>
								<tr>
									<th>姓名拼音</th>
								</tr>
								<tr>
									<td>
										<input class="pinyin_input fname_pinyin" type="text" value="<?php echo $data["tourerfnamealp".$k]?>" style="margin-right:65px;" disabled="disabled" >
										<input class="pinyin_input lname_pinyin" type="text" value="<?php echo $data["tourerlnamealp".$k]?>" disabled="disabled" />
									</td>
								</tr>
								<tr>
									<th>出生日期</th>
								</tr>
								<tr>
									<td>
                                    <?php if($data["tourerbirthdayy".$k]){?>
                                    <span><?php echo $data["tourerbirthdayy".$k]?> 年 <?php echo $data["tourerbirthdaym".$k]?> 月 <?php echo $data["tourerbirthdayd".$k]?> 日 </span>
									<?php }?>
									</td>
								</tr>
								<tr>
									<th>护照号</th>
								</tr>
								<tr>
									<td>
										<span><?php echo $data["tourerpassbook".$k]?></span>
									</td>
								</tr>
								<tr>
									<th>护照有效期</th>
								</tr>
								<tr>
									<td>                                    
                                    <?php if ($data["tourereffectivey".$k]){?>
                                    <span><?php echo $data["tourereffectivey".$k]?> 年 <?php echo $data["tourereffectivem".$k]?> 月 <?php echo $data["tourereffectived".$k]?> 日 </span>
                                    <?php }?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <?php } ?>
			</section>
            <?php }?>       
			
            <?php if($data['oldnum'] > 0){?>
            <h3 class="order_ttl"><strong>婴儿游客（2周岁以下）</strong><span class="line"></span></h3>
			<section class="order_block fix order_person_list">
                <?php 
                    for($i=1;$i<=$data["oldnum"];$i++){
                        $k = "3".$i;
                ?>
				<div class="one_person_order">
					<h2 class="order_ttl"><strong>婴儿<?php echo $i;?></strong></h2>
					<div class="order_content">
						<table class="table_style_01">
							<tbody>
								<tr>
									<th>姓名</th>
								</tr>
								<tr>
									<td><input type="text" class="sex_input" value="<?php echo $data["tourername".$k]?>" disabled="disabled" ><span><?php if($data["tourersex".$k]=="1"){echo "男";}else{echo "女";}?></span></td>
								</tr>
								<tr>
									<th>姓名拼音</th>
								</tr>
								<tr>
									<td>
										<input class="pinyin_input fname_pinyin" type="text" value="<?php echo $data["tourerfnamealp".$k]?>" style="margin-right:65px;" disabled="disabled" >
										<input class="pinyin_input lname_pinyin" type="text" value="<?php echo $data["tourerlnamealp".$k]?>" disabled="disabled" />
									</td>
								</tr>
								<tr>
									<th>出生日期</th>
								</tr>
								<tr>
									<td>
                                    <?php if($data["tourerbirthdayy".$k]){?>
                                    <span><?php echo $data["tourerbirthdayy".$k]?> 年 <?php echo $data["tourerbirthdaym".$k]?> 月 <?php echo $data["tourerbirthdayd".$k]?> 日 </span>
									<?php }?>
									</td>
								</tr>
								<tr>
									<th>护照号</th>
								</tr>
								<tr>
									<td>
										<span><?php echo $data["tourerpassbook".$k]?></span>
									</td>
								</tr>
								<tr>
									<th>护照有效期</th>
								</tr>
								<tr>
									<td>
                                    <?php if ($data["tourereffectivey".$k]){?>
                                    <span><?php echo $data["tourereffectivey".$k]?> 年 <?php echo $data["tourereffectivem".$k]?> 月 <?php echo $data["tourereffectived".$k]?> 日 </span>
                                    <?php }?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                <?php } ?>
			</section>
            <?php }?>
			<div class="order_all">
				<span class="ttl">订单金额：<strong class="price_one">￥<?php echo $data['totalprice'];?></strong></span>

				<a class="btn_03 btnsaveorder" href="javascript:;">立即预订</a>
				<a class="btn_02 confirmback" href="javascript:;">修改信息</a>
			</div>

		</div>