(function(){
	//list 页面
	// $(".one_filter ul li").on("click",function(){
	// 	var thispIndex = $(this).parents(".one_filter").index(),
	// 		thisSort = $(this).parents(".one_filter").find(".title").html(),
	// 		thisName = $(this).find("a").html(),
	// 		thisClass = "filter_fun_" + thispIndex
	// 		objHTML = '<span class= "'+ thisClass + '">'+ thisSort + thisName +'<a href="javascript:void(0);"></a></span>';
		
	// 	var objFun = $(".result_selected"),
	// 		objCla = objFun.find("span");
	// 	objCla.each(function(){
	// 		if($(this).attr("class") == thisClass){
	// 			$(this).remove();
	// 		}
	// 	});
	// 	objFun.append(objHTML);

	// 	$(this).addClass("on").siblings().removeClass("on");
	// 	if($(this).hasClass("all")){
	// 		$("." + thisClass).remove();
	// 	}
	// 	return false;
	// });
	$(".result_selected a").live("click",function(){
		$(this).parent().remove();
		var thisname = $(this).parent().attr("class"),
			filterNum = thisname.split("_"),
			one_filter = $(".one_filter");
		one_filter.eq(filterNum[2]).find("li.all").addClass("on").siblings().removeClass("on");
	});
	$(".sort_area a").on("click",function(){
		var thisId = $(this).attr("id");
		if(thisId == "prize_sort" && $(this).hasClass("on")){
			if($(this).hasClass("down")){
				$(this).addClass("up").removeClass("down");
			}else if($(this).hasClass("up")){
				$(this).addClass("down").removeClass("up");
			}
		}
		$(this).addClass("on").siblings().removeClass("on");
	});
	//第一行的2，3级选择
	// $(".ft_filter_line li").on("click",function(){
	// 	if(!$(this).hasClass("all")){
	// 		var thisFilter = $(this).find("a").attr("filter");
	// 		$(".sec_filter_line").show();
	// 		$(".sec_filter_line").find("."+thisFilter).show().siblings().hide();
	// 		$(".sec_filter_line").find("."+thisFilter).find("li").removeClass("on");
	// 		$(".third_filter_line").hide();
	// 	}else{
	// 		var thispIndex = $(this).parents(".one_filter").index(),
	// 		thisClass = "filter_fun_" + thispIndex;
	// 		$("." + thisClass).remove();
	// 		$(".sec_filter_line").hide();
	// 		$(".third_filter_line").hide();
	// 	}
	// });
	// $(".sec_filter_line li").on("click",function(){
	// 	var thisClass = $(this).attr("class");
	// 	if(thisClass != "all"){
	// 		var thisFilter = $(this).find("a").attr("filter");
	// 		$(".third_filter_line").show();
	// 		$(".third_filter_line").find("."+thisFilter).show().siblings().hide();
	// 		$(".third_filter_line").find("."+thisFilter).find("li").removeClass("on");
	// 	}
	// });


	//更多按钮系列
	// var area = $(".more_filter_area"),
	// 	li = area.find("li"),
	// 	liLen = li.length,
	// 	liOn = area.find("li.on"),
	// 	liOnNum = liOn.index(),
	// 	moreBtn = area.find(".filter_more"),
	// 	minBtn = moreBtn.find(".min"),
	// 	plusBtn = moreBtn.find(".plus");

	// if(liLen > 10){
	// 	if(liOnNum <= 9){//选中的在第一排的时候
	// 		area.find("li:gt(9)").hide();
	// 		minBtn.show();
	// 		plusBtn.hide();
	// 	}else{
	// 		area.find("li:gt(9)").show();
	// 		minBtn.hide();
	// 		plusBtn.show();
	// 	}
	// 	moreBtn.show();
	// }else{
	// 	moreBtn.hide();
	// }

	// minBtn.on("click",function(){
	// 	var thisMoreLi = $(this).parents(".more_filter_area").find("li:gt(9)").show();
	// 	$(this).hide();
	// 	$(this).next().show();
	// });
	// plusBtn.on("click",function(){
	// 	var thisMoreLi = $(this).parents(".more_filter_area").find("li:gt(9)").hide();
	// 	$(this).hide();
	// 	$(this).prev().show();
	// });


	//展开更多筛选系列
	// var oneMore = $(".one_filter:gt(2)"),
	// 	oneMoreOn = oneMore.find("li.on").not(".all"),
	// 	moreFilter = $(".final_filter .spread_list_filter");
	// if(oneMoreOn.length < 1){
	// 	$(".one_filter").eq(2).addClass("nobdbt");
	// 	oneMore.hide();
		
	// }else{

	// 	moreFilter.addClass("on").removeClass("off");
	// }
	
	// moreFilter.on("click",function(){
	// 	if($(this).hasClass("off")){
	// 		$(".one_filter").eq(2).removeClass("nobdbt");
	// 		oneMore.slideDown(300);
	// 		$(this).addClass("on").removeClass("off");
	// 	}else{
	// 		$(".one_filter").eq(2).addClass("nobdbt");
	// 		oneMore.slideUp(300);
	// 		$(this).addClass("off").removeClass("on");
	// 	}
		
	// });

	var lmoreAreaF = $(".l_more_filter_area").find(".one_filter");
	if(lmoreAreaF.length > 0){
		var oneMore = $(".l_more_filter_area"),
			oneMoreOn = oneMore.find("li.on").not(".all"),
			moreFilter = $(".spread_list_filter");
		if(oneMoreOn.length < 1){
			//$(".one_filter").eq(2).addClass("nobdbt");
			//oneMore.hide();
			oneMore.show();
			
		}else{
			oneMore.show();
			moreFilter.addClass("on").removeClass("off");
		}
		
		moreFilter.on("click",function(){
			if($(this).hasClass("off")){
				//$(".one_filter").eq(2).removeClass("nobdbt");
				oneMore.slideDown(300);
				$(this).addClass("on").removeClass("off");
			}else{
				//$(".one_filter").eq(2).addClass("nobdbt");
				oneMore.slideUp(300);
				$(this).addClass("off").removeClass("on");
			}
			
		});
	}else{
		$(".spread_list_filter").hide();
	}
	


	//载入页面时将on的都添加上
	var objFun = $(".result_selected"),
		objCla = objFun.find("span");
	var oneFliter = $(".one_filter");
	oneFliter.each(function(){
		var thisLiArray = [],
			thisLink = [];
		var thispIndex = $(this).index(),
			thisSort = $(this).find(".title").html(),
			thisLi = $(this).find("li.on").not(".all"),
			thisClass = "filter_fun_" + thispIndex,
			thisAll = $(this).find("li.all"),
			thisAllLink = thisAll.find("a").attr("href");
			console.log(thisAllLink);
			
		thisLi.each(function(){
			var thisHtml = $(this).find("a").html(),
			tLink = $(this).find("a").attr("href");
			thisLiArray.push(thisHtml);
			thisLink.push(tLink);
		});
		var len = thisLiArray.length,
			thisName = thisLiArray[len - 1];
		if(len > 1){
			for(var i = 0;i < len;i++){
				if(i > 0){
					var nowLink = thisLink[i - 1];
					thisAllLink = nowLink;
				}
			}
		}
		if(thisName != undefined){
			var objHTML = '<span class= "'+ thisClass + '">'+ thisSort + thisName +'<a href="' + thisAllLink + '"></a></span>';
		}
		
		objCla.each(function(){
			if($(this).attr("class") == thisClass){
				$(this).remove();
			}
		});
		objFun.append(objHTML);
		
	});

})();