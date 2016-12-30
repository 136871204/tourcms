(function(){
	var ww = $(window).width();
	if(ww <= 1024){//小于1024时才触发
		//底部伸缩
		var footerDL = $("#footer .wrapper dl dt");
		footerDL.on("click",function(){
			var thisDD = $(this).parent().children("dd");
			if(!$(this).hasClass("off")){
				thisDD.stop().slideDown(function(){
					thisDD.addClass("over");
				});
				$(this).addClass("off");
				
				
			}else{
				thisDD.removeClass("over");
				thisDD.stop().slideUp();
				$(this).removeClass("off");
			}
			
		});

		//点开微信QQ等
		var footerWX = $("#footer .wrapper dl dd .f_wx");
		footerWX.on("click",function(){
			var content = $(this).children(".f_wx_content");
			if(!$(this).hasClass("on")){
				content.css("display","block");
				$(this).addClass("on");
			}else{
				content.css("display","none");
				$(this).removeClass("on");
			}
			
		});
		var footerQQ = $("#footer .wrapper dl dd .qq");
		footerQQ.on("click",function(){
			var content = $(this).children(".f_tx_content");
			if(!$(this).hasClass("on")){
				content.css("display","block");
				$(this).addClass("on");
			}else{
				content.css("display","none");
				$(this).removeClass("on");
			}
			
		});
		

		//menu开关
		$(".m_menu_btn").on("click",function(){
			$(this).next(".m_menu_content").css("display","block");
			$(this).next(".m_menu_content").animate({right:"0px"},300);
			//$(this).next(".m_menu_content").addClass("open").removeClass("close");
			
		});
		$(".menu_close").on("click",function(){
			
			$(this).parents(".m_menu_content").animate({right:"-250px"},300,function(){
				$(this).css("display","none");
			});
			//$(this).parents(".m_menu_content").removeClass("open").addClass("close");
			
		});
		//menu支店
		$(".m_ss_ttl").on("click",function(){
			if(!$(this).hasClass("on")){
				$(this).addClass("on");
				$(this).next(".m_ss_content").css("display","block");
			}else{
				$(this).removeClass("on");
				$(this).next(".m_ss_content").css("display","none");
			}
		});

		//menu qq 电话
		$(".contact_nav .cn_qq").on("click",function(){
			var content = $(this).find(".content");
			if(content.is(":hidden")){
				content.css("display","block");
			}else{
				content.css("display","none");
			}
		});
		$(".contact_nav .cn_phone").on("click",function(){
			var content = $(this).find(".content");
			if(content.is(":hidden")){
				content.css("display","block");
			}else{
				content.css("display","none");
			}
		});
		$(".contact_nav .cn_weixin").on("click",function(){
			var content = $(this).find(".content");
			if(content.is(":hidden")){
				content.css("display","block");
			}else{
				content.css("display","none");
			}
		});

	}
	window.onresize = function(){
		try{
			mainIntroWidth();
		}catch(e){
			
		}
		
	}
}());

