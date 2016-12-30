// JavaScript Document
function bookSubmit(parameters,url)
{
	
	
   bookShadow();
   bookLoading();
   $.ajax({
		type: "post",	
		url: url,
		data:parameters,
		dataType:"html",
		beforeSend: function(XMLHttpRequest){ 
		       
		    },
		success: function(data, textStatus){
			
			
			 bookCloseLoad()
			   var content="";
               if(data=='nonumber'){
                   layer.msg('库存不足,不能预订!', 2,8);
                   bookClose();
                   return false;
               }
               else if(data!='no')
                {
				   content="<div class=\"bk_hint\"><table class=\"bk_word\"><tr><td class='td_lt'></td><td class='td_rt'><h4>订单提交成功！</h4></td></tr></table></div>";
			    }
				else
				{
					 content="<div class=\"bk_hint\"><table class=\"bk_word\"><tr><td class='td_lt2'></td><td class='td_rt'><h4>订单提交失败！</h4></td></tr></table></div>";
				}
				   
			   $("body").append(content);
			    var s_top=$(window).scrollTop()+140;
	            var s_left=$(window).width()/2-330;
				$(".bk_hint").css("left",s_left);
				$(".bk_hint").css("top",s_top);
                if(data!='no'){
                    setTimeout(function(){bookConfirm(data)},1000);
                }
                else{
                    setTimeout(function(){bookClose()},1000);
                }

				 
		   }
		}); 		
}

function bookShadow()
{
	var shadow=$("<div id='shadow' style='background:#333;position:absolute;left:0px;top:0px;z-index:100'></div>");
	$("body").append(shadow);
	$("#shadow").css("height",$(document).height());
	$("#shadow").css('width','100%');
	$("#shadow").css("opacity",0.5);
}
function bookCloseShadow()
{
	$("#shadow").remove();
}
function bookConfirm(url)
{
	bookCloseShadow();
	window.open(url,"_self")
}
function bookClose()
{
	bookCloseShadow();
	$(".bk_hint").remove();
}
function bookLoading()
{
	var content="<div class=\"bk_load\"><div><img src=\"/templets/smore/images/bookloading.gif\"/></div>正在提交..</div>";
	$("body").append(content);
	var s_top=$(window).scrollTop()+160;
	var s_left=$(window).width()/2-40;
	$(".bk_load").css("left",s_left);
	$(".bk_load").css("top",s_top); 
	
}
function bookCloseLoad()
{
	$(".bk_load").remove();
}