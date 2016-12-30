/*====================================================================================================
//////////////////////////////////////////////////////////////////////////////////////////////////////

 Author : http://www.metaphase.co.jp
 created: 2013/12/02
 update : -

//////////////////////////////////////////////////////////////////////////////////////////////////////
====================================================================================================*/

$(function(){
	$.fn.blockLink = function(){

		//linkElm = '.blockLink, .itemListElementA01 li, .bannerListElementA01 li, .linkTableElementA01 td';
		
		if($(this).find('a').length){
			
			$(this).css({
				cursor: 'pointer'
			});
			$(this).click(function(){
				var blockLink = $(this).find('a').attr('href');
				if($(this).find('a').attr('target')){
					window.open(blockLink, $(this).find('a').attr('target'));
					return false;
				}else{
					window.location.href = blockLink;
					return false;
				}
			});
			
			$(this).hover(function(){
				$(this).addClass('hover');
			}, function(){
				$(this).removeClass('hover');
			});
			
			
			if($(this).find('a > img[src*="_n"]').length){
				$(this).hover(function(){
					hoverImgSrc = $(this).find('a > img[src*="_n"]').attr('src');
					$(this).find('a > img[src*="_n"]').attr('src',hoverImgSrc.replace('_n','_r'));
				}, function(){
					$(this).find('a > img[src*="_r"]').attr('src',hoverImgSrc.replace('_r','_n'));
				});
			}
		}
	}
});
