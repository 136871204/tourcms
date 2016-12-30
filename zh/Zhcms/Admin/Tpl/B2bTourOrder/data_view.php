<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>问答系统</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    
    
    <js file="__STATIC__/tour/js/jquery-1.8.3.min.js"/>
    <js file="__STATIC__/tour/js/common.js"/>
    <js file="__STATIC__/tour/js/jquery.hotkeys.js"/>
    <js file="__STATIC__/tour/js/msgbox/msgbox.js"/>
    <js file="__STATIC__/tour/js/extjs/ext-all.js"/>
    <js file="__STATIC__/tour/js/extjs/locale/ext-lang-zh_CN.js"/>
    <link type="text/css" href="__STATIC__/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="__STATIC__/tour/css/common.css" rel="stylesheet"/>
     <link type="text/css" href="__STATIC__/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="__STATIC__/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>
    <script>
    window.SITEURL =  "__WEB__";
    window.PUBLICURL ="/newtravel/public/";
    window.WEBLIST =  <?php echo json_encode(array_merge(TourCommon::getWebList())); ?> 
    $(function(){
        $.hotkeys.add('f', function(){parent.window.showIndex(); });
    })
    </script>
    
    <link type="text/css" href="__STATIC__/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/plist.css" rel="stylesheet"/>   
    <link type="text/css" href="__STATIC__/tour/css/order.css" rel="stylesheet"/>
    

</head>
<body  style="background-color: #fff">
 
<div class="pop_order_box">
    <div class="day_order_list">
        <dl>
            <dt>今日</dt>
            <dd>
                <span class="same">已付款</span>
                <span class="same today_2_num">0</span>
                <span class="price today_2_price">0</span>
            </dd>
            <dd>
                <span class="same">未付款</span>
                <span class="same today_1_num">0</span>
                <span class="price today_1_price">0</span>
            </dd>
            <dd class="bor_0">
                <span class="same">已取消</span>
                <span class="same today_3_num">0</span>
                <span class="price today_3_price">0</span>
            </dd>
        </dl>
        <dl>
            <dt>昨日</dt>
            <dd>
                <span class="same">已付款</span>
                <span class="same yesterday_2_num">0</span>
                <span class="price yesterday_2_price">0</span>
            </dd>
            <dd>
                <span class="same">未付款</span>
                <span class="same yesterday_1_num">0</span>
                <span class="price yesterday_1_price">0</span>
            </dd>
            <dd class="bor_0">
                <span class="same">已取消</span>
                <span class="same yesterday_3_num">0</span>
                <span class="price yesterday_3_price">0</span>
            </dd>
        </dl>
        <dl>
            <dt>最近7日</dt>
            <dd>
                <span class="same">已付款</span>
                <span class="same week_2_num">0</span>
                <span class="price week_2_price">0</span>
            </dd>
            <dd>
                <span class="same">未付款</span>
                <span class="same week_1_num">0</span>
                <span class="price week_1_price">0</span>
            </dd>
            <dd class="bor_0">
                <span class="same">已取消</span>
                <span class="same week_3_num">0</span>
                <span class="price week_3_price">0</span>
            </dd>
        </dl>
        <dl class="mr_0">
            <dt>最近30日</dt>
            <dd>
                <span class="same">已付款</span>
                <span class="same month_2_num">0</span>
                <span class="price month_2_price">0</span>
            </dd>
            <dd>
                <span class="same">未付款</span>
                <span class="same month_1_num">0</span>
                <span class="price month_1_price">0</span>
            </dd>
            <dd class="bor_0">
                <span class="same">已取消</span>
                <span class="same month_3_num">0</span>
                <span class="price month_3_price">0</span>
            </dd>
        </dl>
    </div>
    <div class="day_order_table">
        <table width="100%" border="1">
            <tr>
                <th height="38" align="center" bgcolor="#F1F8FB" scope="col"><a class="prev" ></a></th>
                <th colspan="11" bgcolor="#F1F8FB" scope="col"><span class="year">{$thisyear}</span></th>
                <th align="center" bgcolor="#F1F8FB" scope="col"><a class="next next_unvalid"></a></th>
            </tr>
            <tr>
                <td width="63" height="38">&nbsp;</td>
                <td width="63" align="center">1月</td>
                <td width="63" align="center">2月</td>
                <td width="63" align="center">3月</td>
                <td width="63" align="center">4月</td>
                <td width="63" align="center">5月</td>
                <td width="63" align="center">6月</td>
                <td width="63" align="center">7月</td>
                <td width="63" align="center">8月</td>
                <td width="63" align="center">9月</td>
                <td width="63" align="center">10月</td>
                <td width="63" align="center">11月</td>
                <td width="63" align="center">12月</td>
            </tr>
            <tr>
                <td rowspan="2" align="center" bgcolor="#F1F8FB">已付款</td>
                <td height="38" align="center" bgcolor="#F1F8FB" class="m1_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m2_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m3_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m4_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m5_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m6_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m7_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m8_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m9_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m10_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m11_2_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m12_2_num">0</td>
            </tr>
            <tr>
                <td height="38" align="center" bgcolor="#F1F8FB" class="m1_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m2_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m3_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m4_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m5_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m6_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m7_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m8_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m9_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m10_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m11_2_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m12_2_price">0</td>
            </tr>
            <tr>
                <td rowspan="2" align="center">未付款</td>
                <td height="38" align="center" class="m1_1_num">0</td>
                <td align="center" class="m2_1_num">0</td>
                <td align="center" class="m3_1_num">0</td>
                <td align="center" class="m4_1_num">0</td>
                <td align="center" class="m5_1_num">0</td>
                <td align="center" class="m6_1_num">0</td>
                <td align="center" class="m7_1_num">0</td>
                <td align="center" class="m8_1_num">0</td>
                <td align="center" class="m9_1_num">0</td>
                <td align="center" class="m10_1_num">0</td>
                <td align="center" class="m11_1_num">0</td>
                <td align="center" class="m12_1_num">0</td>
            </tr>
            <tr>
                <td height="38" align="center" class="m1_1_price">0</td>
                <td align="center" class="m2_1_price">0</td>
                <td align="center" class="m3_1_price">0</td>
                <td align="center" class="m4_1_price">0</td>
                <td align="center" class="m5_1_price">0</td>
                <td align="center" class="m6_1_price">0</td>
                <td align="center" class="m7_1_price">0</td>
                <td align="center" class="m8_1_price">0</td>
                <td align="center" class="m9_1_price">0</td>
                <td align="center" class="m10_1_price">0</td>
                <td align="center" class="m11_1_price">0</td>
                <td align="center" class="m12_1_price">0</td>
            </tr>
            <tr>
                <td rowspan="2" align="center" bgcolor="#F1F8FB">已取消</td>
                <td height="38" align="center" bgcolor="#F1F8FB" class="m1_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m2_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m3_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m4_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m5_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m6_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m7_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m8_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m9_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m10_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m11_3_num">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m12_3_num">0</td>
            </tr>
            <tr>
                <td height="38" align="center" bgcolor="#F1F8FB" class="m1_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m2_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m3_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m4_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m5_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m6_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m7_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m8_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m9_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m10_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m11_3_price">0</td>
                <td align="center" bgcolor="#F1F8FB" class="m12_3_price">0</td>
            </tr>
        </table>
    </div>
</div>
<input type="hidden" id="year" value="{$thisyear}"/>
    
<script>
var typeid = '{$typeid}';
$(function(){
    //订单基本统计
        $.getJSON(SITEURL+'?g=Zhcms&a=Admin&c=TourOrder&m=ajax_sell_tj&typeid='+typeid,function(data){

            //今日
            $(".today_2_num").html(data.today.pay.num);
            $(".today_2_price").html(data.today.pay.price);
            $(".today_3_num").html(data.today.cancel.num);
            $(".today_3_price").html(data.today.cancel.price);

            $(".today_1_num").html(data.today.unpay.num);
            $(".today_1_price").html(data.today.unpay.price);

            //昨日
            $(".yesterday_2_num").html(data.last.pay.num);
            $(".yesterday_2_price").html(data.last.pay.price);
            $(".yesterday_3_num").html(data.last.cancel.num);
            $(".yesterday_3_price").html(data.last.cancel.price);

            $(".yesterday_1_num").html(data.last.unpay.num);
            $(".yesterday_1_price").html(data.last.unpay.price);

            //本周
            $(".week_2_num").html(data.thisweek.pay.num);
            $(".week_2_price").html(data.thisweek.pay.price);
            $(".week_3_num").html(data.thisweek.cancel.num);
            $(".week_3_price").html(data.thisweek.cancel.price);

            $(".week_1_num").html(data.thismonth.unpay.num);
            $(".week_1_price").html(data.thismonth.unpay.price);
            //本月
            $(".month_2_num").html(data.thismonth.pay.num);
            $(".month_2_price").html(data.thismonth.pay.price);
            $(".month_3_num").html(data.thismonth.cancel.num);
            $(".month_3_price").html(data.thismonth.cancel.price);

            $(".month_1_num").html(data.thismonth.unpay.num);
            $(".month_1_price").html(data.thismonth.unpay.price);

        })
        
        //订单按年统计
        getYearOrder();
    
        //去年
        $(".prev").click(function(){
            var year = $("#year").val();
            year = Number(year)-1;
            //
            $(".next").removeClass('next_unvalid');
            $("#year").val(year);
            //alert(year);
            getYearOrder();
        })
        
         $(".next").click(function(){
            var year = $("#year").val();
            year = Number(year)+1;
            var myDate = new Date();
            var current_year = myDate.getFullYear();
            if(year>current_year){
                $(".next").addClass('next_unvalid');
                return false;
            }else{
                $("#year").val(year);
                $(".next").removeClass('next_unvalid');
                getYearOrder();
            }
        })
        
    
})

    function getYearOrder()
    {
        var year = $("#year").val();

        $.getJSON(SITEURL+'?g=Zhcms&a=Admin&c=TourOrder&m=ajax_year_tj&typeid='+typeid+"&year="+year,function(data){

            $.each(data,function(i,row){
                $(".m"+i+'_1_num').html(row.unpay.num);
                $(".m"+i+'_1_price').html(row.unpay.price);

                $(".m"+i+'_2_num').html(row.pay.num);
                $(".m"+i+'_2_price').html(row.pay.price);

                $(".m"+i+'_3_num').html(row.cancel.num);
                $(".m"+i+'_3_price').html(row.cancel.price);
            })
            $('.year').html(year);

        })
    }
</script>
</body>
</html>