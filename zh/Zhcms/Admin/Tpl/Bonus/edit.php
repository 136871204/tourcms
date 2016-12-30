<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>添加红包类型</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <script src='__STATIC__/js/utils.js'></script>
    <script src='__STATIC__/js/validator.js'></script>
    <script type="text/javascript" src="__STATIC__/js/calendar.php?lang={$zh.session.language}"></script>
    <link href="__STATIC__/js/calendar/calendar.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrap">
    <div class="menu_list">
        <ul>
            <li><a href="{|U:'index'}">红包类型列表</a></li>
            <li><a href="javascript:;" class="action">添加红包类型</a></li>
        </ul>
    </div>
    <div class="title-header">添加红包类型</div>
    <form method="post" name="theForm"  class="zh-form" onsubmit="if(validate()!=false){return zh_submit(this,'{|U:index}');}else{return false;}">
        <table class="table1">
            <tr>
                <th class="w100">类型名称</th>
                <td>
                    <input type='text' name='type_name' maxlength="30" value="{$bonus_arr.type_name}" class="w200" />
                </td>
            </tr>
            <tr>
                <th class="w100">红包金额</th>
                <td>
                    <input type="text" name="type_money" value="{$bonus_arr.type_money}" class="w200" />
                    <br />
                    <span  id="goods_sn_notice">
                    *此类型的红包可以抵销的金额。
                    </span>
                </td>
            </tr>
            <tr>
                <th class="w100">最小订单金额</th>
                <td>
                    <input name="min_goods_amount" type="text" id="min_goods_amount" value="{$bonus_arr.min_goods_amount}" class="w200"  />
                    <br />
                    <span  id="goods_sn_notice">
                    *只有商品总金额达到这个数的订单才能使用这种红包。
                    </span>
                </td>
            </tr>
            <tr>
                <th>如何发放此类型红包</th>
                <td>
                    <input type="radio" name="send_type" value="0" <if value='$bonus_arr.send_type eq 0'> checked="true" </if> onClick="showunit(0)"  />按用户发放
                    <input type="radio" name="send_type" value="1" <if value='$bonus_arr.send_type eq 1'> checked="true" </if> onClick="showunit(1)"  />按商品发放
                    <input type="radio" name="send_type" value="2" <if value='$bonus_arr.send_type eq 2'> checked="true" </if> onClick="showunit(2)"  />按订单金额发放
                    <input type="radio" name="send_type" value="3" <if value='$bonus_arr.send_type eq 3'> checked="true" </if> onClick="showunit(3)"  />线下发放的红包     </td>
                </td>
            </tr>
            <tr id="1" style="display:none">
                <th>订单下限</th>
                <td>
                    <input name="min_amount" type="text" id="min_amount" value="{$bonus_arr.min_amount}"  class="w200" />
                    <br />
                    <span  id="goods_sn_notice">
                    *只要订单金额达到该数值，就会发放红包给用户。
                    </span>
                </td>
            </tr>
            <tr>
                <th>发放起始日期</th>
                <td>
                    <input name="send_start_date" type="text" id="send_start_date" size="22" value='{$bonus_arr.send_start_date}' readonly="readonly" />
                    <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('send_start_date', '%Y-%m-%d', false, false, 'selbtn1');" value="选择" class="button"/>
                    <br />
                    <span  id="goods_sn_notice">
                    *只有当前时间介于起始日期和截止日期之间时，此类型的红包才可以发放。
                    </span>
                </td>
            </tr>
            <tr>
                <th>发放结束日期</th>
                <td>
                    <input name="send_end_date" type="text" id="send_end_date" size="22" value='{$bonus_arr.send_end_date}' readonly="readonly" />
                    <input name="selbtn2" type="button" id="selbtn2" onclick="return showCalendar('send_end_date', '%Y-%m-%d', false, false, 'selbtn2');" value="选择" class="button"/>
                </td>
            </tr>
            <tr>
                <th>使用起始日期</th>
                <td>
                    <input name="use_start_date" type="text" id="use_start_date" size="22" value='{$bonus_arr.use_start_date}' readonly="readonly" />
                    <input name="selbtn3" type="button" id="selbtn3" onclick="return showCalendar('use_start_date', '%Y-%m-%d', false, false, 'selbtn3');" value="选择" class="button"/>
                    <br />
                    <span  id="goods_sn_notice">
                    *只有当前时间介于起始日期和截止日期之间时，此类型的红包才可以使用。
                    </span>
                </td>
            </tr>
            <tr>
                <th>使用结束日期</th>
                <td>
                    <input name="use_end_date" type="text" id="use_end_date" size="22" value='{$bonus_arr.use_end_date}' readonly="readonly" />
                    <input name="selbtn4" type="button" id="selbtn4" onclick="return showCalendar('use_end_date', '%Y-%m-%d', false, false, 'selbtn4');" value="选择" class="button"/>   
                </td>
            </tr>

        </table>
        <div class="position-bottom">
            <input type="submit" value="確認" class="zh-success"/>
        </div>
        <input type="hidden" name="type_id" value="{$bonus_arr.type_id}" />    </td>
    </form>
</div>
<script>
document.forms['theForm'].elements['type_name'].focus();

var type_name_empty = "请输入红包类型名称!";
var type_money_empty = "请输入红包类型价格!";
var type_money_isnumber = "类型金额必须为数字格式!";
var send_start_lt_end = "红包发放开始日期不能大于结束日期";
var use_start_lt_end = "红包使用开始日期不能大于结束日期";
var invalid_min_amount = "请输入订单下限（大于0的数字）";

/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("type_name",      type_name_empty);
  validator.required("type_money",     type_money_empty);
  validator.isNumber("type_money",     type_money_isnumber, true);
  validator.islt('send_start_date', 'send_end_date', send_start_lt_end);
  validator.islt('use_start_date', 'use_end_date', use_start_lt_end);
  if (document.getElementById(1).style.display == "")
  {
    var minAmount = parseFloat(document.forms['theForm'].elements['min_amount'].value);
    if (isNaN(minAmount) || minAmount <= 0)
    {
	  validator.addErrorMsg(invalid_min_amount);
    }	
  }
  return validator.passed();
}

onload = function()
{
  get_value = '{$bonus_arr.send_type}';

  showunit(get_value)
  // 开始检查订单
  //TODO:?
  //startCheckOrder();
}

/* 红包类型按订单金额发放时才填写 */
function gObj(obj)
{
  var theObj;
  if (document.getElementById)
  {
    if (typeof obj=="string") {
      return document.getElementById(obj);
    } else {
      return obj.style;
    }
  }
  return null;
}

function showunit(get_value)
{
  gObj("1").style.display =  (get_value == 2) ? "" : "none";
  document.forms['theForm'].elements['selbtn1'].disabled  = (get_value != 1 && get_value != 2);
  document.forms['theForm'].elements['selbtn2'].disabled  = (get_value != 1 && get_value != 2);

  return;
}

</script>
</body>
</html>