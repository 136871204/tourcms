(function(){
	var ww = $(window).width();
	var jrNav = $(".jr_nav"),
		jrNavLi = jrNav.find("li"),
		jrNavPos = jrNav.offset().top,
		jrNavsH = parseInt(jrNav.height());
		jrNavHeight = parseInt(jrNav.height()) + parseInt(jrNav.css("marginTop")) + parseInt(jrNav.css("marginBottom"));
	var jrTtl = $(".jr_ttl");
	var oneP = $(".jr_cate_one");
	if(ww >= 1024){//小于1024时才触发

	
		
		//滚动选中TAB
		$(window).on("scroll",function(){
			var nowPos = $(document).scrollTop() + 10;
			if(nowPos >= jrNavPos){
				jrNav.css("position","fixed");
				jrTtl.css("marginBottom",jrNavHeight + "px");
			}else{
				jrNav.css("position","static");
				jrTtl.css("marginBottom","0px");
				jrNavLi.removeClass("on");
			}


			oneP.each(function(){
				var thisPos = $(this).offset().top - jrNavsH,
					thisIndex = $(this).index(".jr_cate_one");
				
				if(nowPos >= thisPos){
					jrNavLi.eq(thisIndex).addClass("on").siblings().removeClass("on");
				}
			});
		});

		
	}
	//点击滑动页面去向指定TAB
	jrNavLi.on("click",function(){
		var thisIndex = $(this).index();
		var thisGoPos = oneP.eq(thisIndex).offset().top - jrNavsH;
		$('html,body').stop().animate({scrollTop:thisGoPos}, 800);
		return false;
	});

	
})();