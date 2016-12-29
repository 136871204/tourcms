// JavaScript Document
/*
   思途验证支持必填和正则两种验证方式.  dom属性填写方式,   data-required:必填   data-regrex:正则   data-msg:正则验证错误时的提示信息
*/

 //为需要验证的框指定事件处理,使某个输入框在失去焦点或keyup时进行验证
 $.fn.st_readyvalidate=function(config){ 
		var defaults={
		    require:
			{
				blur:function(ele,e,action)
				{
					var val=$(ele).val();
					if(!val)
					{
						$(ele).css("border","1px solid red");
						var y=$(ele).offset().top;
						var x=$(ele).offset().left;
						var width=$(ele).width();
						$.st_hintvalidate("必填",x+width+5,y-4,1000);
					}
					else
						$(ele).removeAttr("style");				
				},
				keyup:function(ele,e,action)
				{
					var val=$(ele).val();
					if(!val)
					{
						$(ele).css("border","1px solid red");
						var y=$(ele).offset().top;
						var x=$(ele).offset().left;
						var width=$(ele).width();
						$.st_hintvalidate("*必填",x+width+10,y-4,1000);
					}
					else
						$(ele).removeAttr("style");	
				}
			},
			regrex:
			{
				keypress:function(ele,e,action)
				{
					 var val=$(ele).val();
					 var msg=$(ele).attr("data-msg");
					 var regrex=$(ele).attr("data-regrex");
					 
					  var y=$(ele).offset().top;
					 var x=$(ele).offset().left;
					 var width=$(ele).width();
					 if(regrex=='number')
					 {
						 var keyCode = e.keyCode?e.keyCode:e.which; 
						if (keyCode == 46 || (keyCode >= 48 && keyCode <=57)) 
							return true; 
						else 
						{
							$.st_hintvalidate(msg,x+width+5,y-4,1000);
							return false; 
						}
					 }
					 regrex=eval(regrex);		
					 if(val)
					 {
						 if(!val.match(regrex))
						 {
							 $.st_hintvalidate(msg,x+width+5,y-4,1000);
						 }
					 }
					 return true;
				}
			}
		  };	 
			 defaults=$.extend(defaults,config);
			 
			 $(this).each(function(index, element) {
				 
				   var data_required=$(element).attr('data-required');
				   var data_regrex=$(element).attr('data-regrex');
				   
				   if(data_required=="true")
				   {
					   for(var key in defaults.require)
					   {
						   var cur_func=defaults.require[key];
						   $(element).bind(key,function(e){
							       cur_func(element,e,key);
							   })
					   }
				   }
				   if(data_regrex)
				   {
					  for(var key in defaults.regrex)
					   {
						   var reg_func=defaults.regrex[key];
						   $(element).bind(key,function(e){
							       return reg_func(element,e,key);
							   })
					   } 
				   }
				     
				     
             });
		  }	  
		  
  //提示		  
  $.st_hintvalidate=function(msg,x,y,seconds){
		         var hint=$("<div class='validate-hint' style='line-height:30px;background:white;color:red;padding:3px 4px;position:absolute;top:"+y+"px;left:"+x+"px'>"+msg+"</div>");
				 if(isNaN(seconds)||seconds==0)
				   seconds=1000;
				 $(".validate-hint").remove();  
				 $("body").append(hint);
				 window.setTimeout(function(){
					 
					 hint.remove();
					 
					 },seconds);
		   
		   }	
	
  //验证，一般在提交表单时使用	   
  $.fn.st_govalidate=function(config)
	   {
		   var defaults={require:function(ele){      }};	 
		   defaults=$.extend(defaults,config);
		   
		    var first_ele='';
		    $(this).each(function(index, element) {
				  var data_required=$(element).attr('data-required');
				  var val=$(element).val();
				  if(data_required=="true"&&!val)
				  {
					   if(!first_ele)
					   {
					     first_ele=element;
						 defaults.require(element,1);   
					   }
					   else
					   {
					     defaults.require(element);
					   }
				  }

			})
		   if(first_ele)
		      return false;
		   else
		      return true;	  	   
	   }
	   