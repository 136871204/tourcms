//头部搜索框焦点事件
var topSearchInput = $(".search_border input[type=text]");
topSearchInput.focus(function(){
 $(this).parents(".search_area").find(".search_spread").css("display","block");
 $("body").append("<div class='body_block'></div>")
});
$(".body_block").live("click",function(){
 topSearchInput.parents(".search_area").find(".search_spread").css("display","none");
 $(this).remove();
});

topSearchInput.placeholder({
	word:'历史热门搜索',
	color:'#a1a8b3',
	evtType:'focus'
});

//首页tab切换
var indexTabBtn = $(".travel_tab").find("dd").find("li"),
	indexTabObj = $(".travel_content").find(".travel_list_content");

indexTabObj.each(function(){
	$(this).find(".travel_list_detail").eq(0).addClass("on").siblings().removeClass("on");
});
indexTabBtn.on("click",function(){
	$(this).addClass("on").siblings().removeClass("on");
	var i = $(this).index(),
	obj = $(this).parents(".travel_content").find(".travel_list_content").find(".travel_list_detail");
	obj.eq(i).addClass("on").siblings().removeClass("on");
    changeBoxSize();
	return false;
});

//当前页on状态选择
function navBannerOn(idx){
	var obj = $("#nav").find(".banner").find("li");
	obj.eq(idx).addClass("on");
}

//检索框submit
function btn_search( name ){
    var searkey = $("#"+name).children(".search_border").children("input").val();
    if( searkey == "历史热门搜索"){
        $("#"+name).children(".search_border").children("input").val("");
    }
    $("#"+name).submit();
}
/*
function btn_search( id ){
    var keyword = $("#"+id).val();
    document.location = __TEMPLATE__+"";
}*/

//清除搜索记录
$(".clear_recorder").click(function(){
    $(".search_histroy_content").html("暂无搜索记录");
    Cookie.delCookie('searchkeyword');
});

var Cookie=new Object(); 
Cookie.setCookie=function(name, value, option){ 
    var str=name+'='+escape(value); 
    if(option){ 
        if(option.expireHours){ 
            var d=new Date(); 
            d.setTime(d.getTime()+option.expireHours*3600*1000); 
            str+='; expires='+d.toGMTString(); 
        } 
        if(option.path) str+='; path='+option.path; 
        if(option.domain) str+='; domain='+option.domain; 
        if(option.secure) str+='; true'; 
    } 
    document.cookie=str; 
} 
Cookie.getCookie=function(name){ 
    var arr = document.cookie.split('; '); 
    if(arr.length==0) return ''; 
    for(var i=0; i <arr.length; i++){ 
        tmp = arr[i].split('='); 
        if(tmp[0]==name) return unescape(tmp[1]); 
    } 
    return ''; 
} 
Cookie.delCookie=function(name){
    this.setCookie(name,'',{expireHours:-1}); 
} 

// angent
/*
$(".username .angent_input").placeholder({
    word:     '请输入用户名',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});
$(".password #text").placeholder({
    word:     '请输入密码',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});
$(".veritxt .angent_input").placeholder({
    word:     '请输入验证码',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});
$('#text').focus(
    function(){
        $(this).hide();
        $("#pass").show();
        $("#pass").focus();
    }
);
*/

$("#user1").placeholder({
    word:     '请输入用户名',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});
$("#text").placeholder({
    word:     '请输入密码',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});
$("#val1").placeholder({
    word:     '请输入验证码',// @string 提示文本
    color:    '#a1a8b3',// @string 文本颜色
    evtType:  'focus'// @string focus|keydown 触发placeholder的事件类型
});

$('#text').focus(
    function(){
        $(this).hide();
        $("#pass1").show();
        $("#pass1").focus();
    }
);
/*
$('#pass1').blur(
    function(){
        if($(this).val()==""){
          $(this).hide();
          $('#text').show();  
        }
    }
);
*/
$('#pass1').live("blur",function(){
    
        if($(this).val()==""){
          $(this).hide();
          $('#text').show();  
        }
    }
);

