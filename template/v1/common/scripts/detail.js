(function(){
	var ww = $(window).width();
	//价格类型效果
	$(".price_combo li").on("click",function(){
		$(this).addClass("on").siblings().removeClass("on");
	});
	// 滚动效果
	var tourNav = $(".tour_intro .tour_nav") ? $(".tour_intro .tour_nav") : "undefined",
		tourContent = $(".tour_intro .tour_content") ? $(".tour_intro .tour_content") : "undefined",
		bookingBtn = tourNav.find(".btn_03") ? tourNav.find(".btn_03") : "undefined",
		drContent = $(".detail_right_content") ? $(".detail_right_content") : "undefined",
		wrapperPos = $("#content .wrapper").offset().top;
	if(tourNav == "undefined") return false;

	var	tourNavPos = tourNav.offset().top,
		navHeight = tourNav.height();
		tagNav = tourNav.find("ul").find("li").not(".download");

	//获取日历
	var calendarArea = $("#calendar");
	
	//获取左侧区块
	var tourPos = [];
	var tourSec = $(".tour_intro").find(".tour_detail");
	try{
		var tourDayList = $(".tour_day_list"),
			tdListPos = tourDayList.offset().top - navHeight - 10,
			tourDayNowPos = navHeight + 10,
			dayNav = tourDayList.find("li");
		//day那一块的整体高度
		var tourEndPos = $(".tour_day_detail").height() + $(".tour_day_detail").offset().top,
			tourListEnd = tourEndPos - tourDayList.height() - 10;
			
	}catch(err){

	}


	try{
		//底部位置
		var footer = $("#footer"),
			footerPos = footer.offset().top,
			drHeight = drContent.height();
		//主体边距
		var mainContentPd = $(".main_content").css("paddingBottom");

	}catch(err){

	}
	if(ww < 767){
		var mobileNavHeight = $(".mobile_header").height();
	}

	$(window).on("scroll",function(){
		//日历出现后影响了滚动的判定，以此修复
		if(calendarArea.height() > 0){
			tdListPosLast = Number(tdListPos) + parseInt(calendarArea.height());
			tourNavPosLast = Number(tourNavPos) + parseInt(calendarArea.height());
		}else{
			tdListPosLast = tdListPos;
			tourNavPosLast = tourNavPos;
		}
		//day滚的事件
		
		var nowPos = $(document).scrollTop(),
			nowPos2 = nowPos + navHeight + 10;
		//详细菜单吸附事件
		if(ww >= 767){
			if(nowPos >= tourNavPosLast){
				tourNav.css("position","fixed");
				tourContent.css("marginTop",navHeight + "px");
				bookingBtn.css("display","block");

				
			}else{
				tourNav.css("position","relative");
				tourContent.css("marginTop","0");
				bookingBtn.css("display","none");

				
			}
		}
		
		//中间菜单滚的事件
		tourSec.each(function(){
			var thisPos = $(this).offset().top,
				thisIndex = $(this).index();
			if(nowPos2 >= thisPos - 10){
				//console.log(thisIndex);
				tagNav.eq(thisIndex).addClass("on").siblings().removeClass("on");
			}

		});

		
		//右侧热门推荐吸附事件
		//右边的界限
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
		


		//mobile版
		//day1234吸附事件
		
		if(ww <= 767){//小于767时才触发
			var tourEndPos = $(".tour_day_detail").height() + $(".tour_day_detail").offset().top,
			tourListEnd = tourEndPos - tourDayList.height() - 10;
			var tourDayPos = $(".tour_day_detail").offset().top;
			
			if(nowPos >= (tourDayPos - mobileNavHeight - 10)){
				
				tourDayList.css({"position":"fixed","top":"46px","right":"11px"});

			}else{
				tourDayList.css({"position":"absolute","top":"0px","right":"0px"});
			}

			if(nowPos >= tourListEnd){
				
				tourDayList.css({"position":"absolute","top":"0px"});
			}
		}else{
			//day1234吸附事件
			var tourEndPos = $(".tour_day_detail").height() + $(".tour_day_detail").offset().top,
			tourListEnd = tourEndPos - tourDayList.height() - 10;
			if(nowPos >= tdListPosLast){
				tourDayList.css({"position":"fixed","top":tourDayNowPos+"px"});

			}else{
				tourDayList.css({"position":"absolute","top":"0px"});
			}

			if(nowPos >= tourListEnd){
				tourDayList.css({"position":"absolute","top":"0px"});
			}
		}

		



		try{
			//day1234滚的on事件
			
			var dayPos = [];
			var dayArea = $(".tour_list_show");
			var daySec = dayArea.find(".tdd_content");
			var holeArea = dayArea.parent(".tour_txt");
			if(holeArea.is(":hidden")) return false;

			daySec.each(function(){
				var thisPos = $(this).offset().top - 10,
					thisIndex = $(this).index();
				if(nowPos2 >= thisPos){
					dayNav.eq(thisIndex).addClass("on").siblings().removeClass("on");
				}

			});
		}catch(err){

		}
		


		
	});

	//点击菜单滚动事件
	tagNav.on("click",function(){
		var thisIndex = $(this).index();
		tourSec.each(function(){
			tourPos.push($(this).offset().top - navHeight -10);

		});
		$('html,body').stop().animate({scrollTop:tourPos[thisIndex]}, 800);
	});

	try{
		//点击day滚动事件
		
		dayNav.on("click",function(){
			//day滚加on事件
			var dayPos = [];
			var daySec = $(".tour_list_show").find(".tdd_content");
			daySec.each(function(){
				if(ww <= 767){//小于767时才触发
					//dayPos.push($(this).offset().top);
					dayPos.push($(this).offset().top - mobileNavHeight - 20);
				}else{
					dayPos.push($(this).offset().top - navHeight - 10);

					
				}
			});
			var thisIndex = $(this).index();
			$('html,body').stop().animate({scrollTop:dayPos[thisIndex]}, 800);
			return false;
		});
	}catch(err){
		
	}
	
	
	//详细的开关
	$(".tour_switch").on("click",function(){
		var obj = $(this).parents(".tour_detail").find(".tour_txt");
		if($(this).hasClass("min")){
			$(this).removeClass("min");
			$(this).addClass("plus");
			obj.slideUp(300);
		}else{
			$(this).addClass("min");
			$(this).removeClass("plus");
			obj.slideDown(300);
		}
	});


	if(ww <= 767){//小于767时才触发
		//手机板默认收起，只打开第一个
		var dContent = $(".tour_content").children(".tour_detail:gt(0)");
		dContent.children(".tour_txt").css("display","none");
		dContent.children(".tour_ttl").children(".tour_switch").addClass("plus").removeClass("min");
	}
})();