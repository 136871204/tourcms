function FormCheck(){
    
    /**** 预约联系人check *****/
    var linkman = $("#linkman").val();
    var linksex = $('input[name="linksex"]:checked').val();
    var linktel = $("#linktel").val();
    var linkemail = $("#linkemail").val();
    var handleshop = $("#handleshop").val();
    var myreg = /^((1[3|4|5|8][0-9]{1})+\d{8})$/;// /^([1][3|4|5|8]+\\d{9})$/
    var lineid = $("#lineid").val();
    var suitid = $("#suitid").val();
    var usedate = $("#usedate").val();
    
    if( !lineid ){
        $(".err_lineid").html("请选择线路！");
        toposition("err_lineid");
        setTimeout('$(".err_lineid").html("")',5000);
        return "error";
    }
    
    if( !suitid ){
        $(".err_suitid").html("请选择套餐！");
        toposition("err_suitid");
        setTimeout('$(".err_suitid").html("")',5000);
        return "error";
    }
    
    if( !usedate ){
        $(".err_usedate").html("请选择日期！");
        toposition("err_usedate");
        setTimeout('$(".err_usedate").html("")',5000);
        return "error";
    }

    if( !linkman ){
        $(".err_linkman").html("预订联系人不能为空！");
        toposition("err_linkman");
        setTimeout('$(".err_linkman").html("")',5000);
        return "error";
    }
    if( !linksex || typeof(linksex) == 'undefined' ){
        $(".err_linkman").html("预订联系人性别不能为空！");
        toposition("err_linkman");
        setTimeout('$(".err_linkman").html("")',5000);
        return "error";
    }
    if( !linktel ){
        $(".err_linktel").html("联系人手机不能为空！");
        toposition("err_linktel");
        setTimeout('$(".err_linktel").html("")',5000);
        return "error";
    }else if( !myreg.test(linktel) ){
        $(".err_linktel").html("请输入正确的联系手机号码！");
        toposition("err_linktel");
        setTimeout('$(".err_linktel").html("")',5000);
        return "error";        
    }
    if( !linkemail ){
        $(".err_linkemail").html("邮箱不能为空！");
        toposition("err_linkemail");
        setTimeout('$(".err_linkemail").html("")',5000);
        return "error";
    }
    if( !handleshop ){
        $(".err_handleshop").html("处理支店不能为空！");
        toposition("err_handleshop");
        setTimeout('$(".err_handleshop").html("")',5000);
        return "error";
    }
    
    /***** 游客check *****/    
    for (ptype=1;ptype<=3;ptype++){
        var num = $("#tourer"+ptype).find(".one_person_order").length;
        if( num > 0 ){
            for(i=1;i<=num;i++){
                var tourname = $("#tourname"+ptype+i).val();
                var toursex = $('input[name="tourersex'+ptype+i+'"]:checked').val();
                var tourerfnamealp = $("#tourerfnamealp"+ptype+i).val();
                var tourerlnamealp = $("#tourerlnamealp"+ptype+i).val();
                if( !tourname ){
                    $(".err_tourername"+ptype+i).html("姓名不能为空！");                    
                    toposition("err_tourername"+ptype+i);
                    setTimeout('$(".err_tourername'+ptype+i+'").html("")',5000);
                    return "error";
                }
                if( !toursex ){
                    $(".err_tourername"+ptype+i).html("性别不能为空！");                    
                    toposition("err_tourername"+ptype+i);
                    setTimeout('$(".err_tourername'+ptype+i+'").html("")',5000);
                    return "error";
                }
                if( !tourerfnamealp || tourerfnamealp == "姓氏拼音" ){
                    $(".err_pinyin"+ptype+i).html("姓氏拼音不能为空！");                    
                    toposition("err_pinyin"+ptype+i);
                    setTimeout('$(".err_pinyin'+ptype+i+'").html("")',5000);
                    return "error";
                }
                if( !tourerlnamealp || tourerlnamealp == "名字拼音" ){
                    $(".err_pinyin"+ptype+i).html("名字拼音不能为空！");                    
                    toposition("err_pinyin"+ptype+i);
                    setTimeout('$(".err_pinyin'+ptype+i+'").html("")',5000);
                    return "error";
                }
            }
        }
    }    
    //return "error";
}

$(function(){
    
    //人数添加事件
    $(".person_machine").find('.plus').click(function(){
        var data = $(this).parents('.person_machine').find('.num').attr("data");
        var txt = $(this).parents('.person_machine').find('.num');
        txt.val(Number(txt.val())+1);
        var cn = Number(txt.val());
        if(cn>6){
          txt.val(6);
          alert('最大6位');
        }
        booking.countPrice();
        booking.addTourer();
    
        //隐藏游客信息
        tourerhidden();
    })
    //人数减少事件
     $(".person_machine").find('.min').click(function(){
        var data = $(this).parents('.person_machine').find('.num').attr("data");
        var txt = $(this).parents('.person_machine').find('.num');
        var n = Number(txt.val())-1;
        n = n<0 ? 0 : n;
        txt.val(n);
        booking.countPrice();
        booking.removeTourer(data);
    
        //隐藏游客信息
        tourerhidden();
     })
})

var booking = {
    countPrice:function(){
        var childnum = Number($("#childnum").val());
        var adultnum = Number($("#adultnum").val());
        var oldnum = Number($("#oldnum").val());
        
        var childprice = $("#childprice").val();
        var adultprice = $("#adultprice").val();
        var oldprice = $("#oldprice").val();

        childtotalprice = childnum * childprice;
        adulttotalprice = adultnum * adultprice;
        oldtotalprice = oldnum * oldprice;
        totalprice = childtotalprice + adulttotalprice + oldtotalprice;
        
        $('.childtotalprice').html(childtotalprice);
        $('.adulttotalprice').html(adulttotalprice);
        $('.oldtotalprice').html(oldtotalprice);
        
        $('.adulttotalnum').html(adultnum);
        $('.childtotalnum').html(childnum);
        $('.oldtotalnum').html(oldnum);
        
        $('.totalprice').html(totalprice);
        $('.totalprice').val(totalprice);
        $('.payprice').html(totalprice);
    },
    addTourer:function(){
        var childnum = Number($("#childnum").val());
        var adultnum = Number($("#adultnum").val());
        var oldnum = Number($("#oldnum").val());
        var totalnum = childnum+adultnum+oldnum;
        var $info = '';
        for(ptype=1;ptype<=3;ptype++){
            switch(ptype)
                {
                case 1:
                  var listnum = adultnum;
                  break;
                case 2:
                  var listnum = childnum;
                  break;
                case 3:
                  var listnum = oldnum;
                  break;
                }
            var hasnum = $('#tourer'+ptype).find('.msg_list').length+1;

            for(i=hasnum;i<=listnum;i++){
                $info = '<div class="one_person_order msg_list">';
                if(ptype=="1"){
                    $info +='   <h2 class="order_ttl"><strong>成人'+i+'</strong></h2>';
                }else if(ptype=="2"){
                    $info +='   <h2 class="order_ttl"><strong>儿童'+i+'</strong></h2>';
                }else if(ptype=="3"){
                    $info +='   <h2 class="order_ttl"><strong>婴儿'+i+'</strong></h2>';
                }                        
                $info +='   <div class="order_content">';
                $info +='       <table class="table_style_01">';
                $info +='       <tbody>';
                $info +='           <tr><th>姓名<span class="tb_imp">（必填）</span><span class="tb_imp err_tourername'+ptype+i+'"></span></th></tr>';
                $info +='           <tr><td>';
                $info +='                   <input class="sex_input" type="text" name="tourername'+ptype+i+'" id="tourname'+ptype+i+'">';
                $info +='                   <input type="radio" name="tourersex'+ptype+i+'" id="male'+ptype+i+'" value="1" checked><label for="male'+ptype+i+'">男</label>';
                $info +='                   <input type="radio" name="tourersex'+ptype+i+'" id="female'+ptype+i+'" value="2"><label for="female'+ptype+i+'">女</label>';
                $info +='           </td></tr>';
                $info +='           <tr><th>姓名拼音<span class="tb_imp">（必填）</span><span class="tb_imp err_pinyin'+ptype+i+'"></span></th></tr>';
                $info +='           <tr><td>';
                $info +='                   <input class="pinyin_input fname_pinyin" type="text" name="tourerfnamealp'+ptype+i+'" id="tourerfnamealp'+ptype+i+'" style="margin-right:65px;">';
                $info +='                   <input class="pinyin_input lname_pinyin" type="text" name="tourerlnamealp'+ptype+i+'" id="tourerlnamealp'+ptype+i+'">';
                $info +='           </td></tr>';
                $info +='           <tr><th>出生日期</th></tr>';
                $info +='           <tr><td>';
                $info +='                   <input class="date_input date_yy" type="text" name="tourerbirthdayy'+ptype+i+'" id="tourerbirthdayy'+ptype+i+'" style="margin-right: 46px;">';
                $info +='                   <input class="date_input date_mm" type="text" name="tourerbirthdaym'+ptype+i+'" id="tourerbirthdaym'+ptype+i+'" style="margin-right: 46px;">';
                $info +='                   <input class="date_input date_dd" type="text" name="tourerbirthdayd'+ptype+i+'" id="tourerbirthdayd'+ptype+i+'">';
                $info +='           </td></tr>';
                //if(ptype == '1'){
                    $info +='           <tr><th>护照号</th></tr>';
                    $info +='           <tr><td><input type="text" name="tourerpassbook'+ptype+i+'" class="text_msg tourname" id="tourerpassbook'+ptype+i+'" /></td></tr>';
                    $info +='           <tr><th>护照有效期</th></tr>';
                    $info +='           <tr><td>';
                    $info +='                   <input class="date_input date_yy" type="text" name="tourereffectivey'+ptype+i+'" id="tourereffectivey'+ptype+i+'" style="margin-right: 46px;">';
                    $info +='                   <input class="date_input date_mm" type="text" name="tourereffectivem'+ptype+i+'" id="tourereffectivem'+ptype+i+'" style="margin-right: 46px;">';
                    $info +='                   <input class="date_input date_dd" type="text" name="tourereffectived'+ptype+i+'" id="tourereffectived'+ptype+i+'">';
                    $info +='           </td></tr>';
                //}
                
                $info +='       </tbody>';                    
                $info +='       </table>'
                $info +='   </div>';
                $info +='<input type="hidden" name="tourerptype'+ptype+i+'" value="'+ptype+'">';
                $info +='</div>';
                $("#tourer"+ptype).append($info);
            }
        }
    },
    removeTourer:function(data){
        $('#tourer'+data).find('.msg_list').last().remove();
    }
}

function tourerhidden(){
    for(i=1;i<=3;i++){
        var num = $("#tourer" + i +" .one_person_order").length;
        if( num < 1){
            $("#tourer"+i).prev("h3").hide();
        }else{
            $("#tourer"+i).prev("h3").show();
        }
    }            
}

function toposition( classname ){
    //页面滑行到指定class
    var nextPos = $("."+classname).offset().top;
    $('html,body').animate({scrollTop:nextPos}, 0);
    //alert(nextPos)
}