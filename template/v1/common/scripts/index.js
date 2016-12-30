$(function(){
	//首页轮播
	var kvItem = $("#kv_detail").find(".kv_item");
	if(kvItem.length > 1){
		$("#kv_detail").vmcSlider( {
		  width: "100%", // 宽度
		  height: 290, // 高度
		  autoPlay: true, // 自动播放
		  ascending: true, // 图片按照升序播放
		  effects: [ // 使用的转场动画效果
		    'fade'
		  ],
		  ie6Tidy: false, // IE6下精简效果
		  random: false, // 随机使用转场动画效果
		  duration: 4000, // 图片停留时长（毫秒）
		  speed: 900 // 转场效果时长（毫秒）
		});
	}
	
	//首页轮播旁 的上下滚动
	var imp_list_count = $("#new_course_detail").find("li").length;
	if(imp_list_count > 3){
		$("#new_course_detail").Scroll({line:1,speed:500,timer:3000,up:"imp_next",down:"imp_prev"});
	}else{
		$(".new_course_fun").css("display","none");
		return false;
	}
    
    //mobile版
    var ww = $(window).width();
    if(ww <= 1024){//小于1024时才触发
        var mkvItem = $("#mobile_kv_detail").find(".item");
        if(mkvItem.length > 1){
            $("#mobile_kv_detail").owlCarousel({
                items:1,
                singleItem:true,
                autoPlay:4000,
                lazyLoad:true,
                transitionStyle : "fade"
            });
        }else{
            var thisSrc = mkvItem.find("img").attr("data-src");
            mkvItem.find("img").attr("src", thisSrc);
        }
    }
	//cross banner
	var crossArea = $(".cross_banner_area");
	var crossBtn = crossArea.children(".cross_btn").children("a");
	var crossContent = crossArea.find(".cross_banner_content");
	var crossClose = crossContent.children(".cross_banner_detail").children(".close");
	crossBtn.on("click",function(){
		var thisWidth = $(this).width();
		$(this).animate({"left":"-" + thisWidth + "px"},500,function(){
			$(this).parent().hide();
			crossContent.show();
			crossContent.animate({"left":"0px"},800);
		});
	});
	crossClose.on("click",function(){
		crossContent.animate({"left":"-100%"},800,function(){
			
			crossContent.hide();
			crossBtn.parent().show();
			crossBtn.animate({"left":"0px"},500);
		});
	});
});