//监听input框的变化
$('.person_machine .num').bind('input propertychange', function() {
    var thisVal = $(this).val();
    if(!!isNaN(thisVal)){
        alert("请输入数字");
        $(this).val("1");
    }
    if(thisVal > 6){
        alert("最大6位");
        $(this).val("6");
    }
});
  
function textclear(){
  //input点击文字消失事件
  $(".fname_pinyin").placeholder({
    word:     '姓氏拼音',// @string 提示文本
    color:    '#c3c7cd',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
  });
        
  $(".lname_pinyin").placeholder({
    word:     '名字拼音',// @string 提示文本
    color:    '#c3c7cd',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
  });    

  $(".date_yy").placeholder({
    word:     'yyyy',// @string 提示文本
    color:    '#c3c7cd',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
  }); 

  $(".date_mm").placeholder({
    word:     'mm',// @string 提示文本
    color:    '#c3c7cd',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
  }); 
      

  $(".date_dd").placeholder({
    word:     'dd',// @string 提示文本
    color:    '#c3c7cd',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
  }); 
}
       
function FormCheck(){
    
    /**** 预约联系人check *****/
    var linkman = $("#linkman").val();
    var linksex = $('input[name="linksex"]:checked').val();
    var linktel = $("#linktel").val();
    var linkemail = $("#linkemail").val();
    var handleshop = $("#handleshop").val();
    var myreg = /^((1[3|4|5|8][0-9]{1})+\d{8})$/;// /^([1][3|4|5|8]+\\d{9})$/

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

function toposition( classname ){
    //页面滑行到指定class
    var nextPos = $("."+classname).offset().top;
    $('html,body').animate({scrollTop:nextPos}, 800);
    
}

var wrapperPos = $("#content .order_area").offset().top,
    drContent = $(".fixed_right") ? $(".fixed_right") : "undefined";
  
  //主体边距
  var mainContentPd = $(".main_content").css("paddingBottom");
  $(window).on("scroll",function(){
    var nowPos = $(document).scrollTop();
      //右侧热门推荐吸附事件
    //底部位置
    var footer = $("#footer"),
      footerPos = footer.offset().top,
      drHeight = drContent.height();
    var rightLine = footerPos - nowPos - drHeight;
      if(nowPos >= wrapperPos){
        drNowPos = nowPos - wrapperPos;
        if(rightLine <= 0){

          drContent.css({"position":"absolute","top":"auto","bottom":"-" + mainContentPd});
        }else{
          drContent.css({"position":"absolute","top":drNowPos+"px","bottom":"auto"});
        }
       

      }else{
        drContent.css("position","static");
      }
  });
        