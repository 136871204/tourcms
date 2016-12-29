/**
 * 用于列表页面的图片上传
 */
ListImageup={
    genePic:function(imgpath,selector,name,isindex)//生成图片框
    {
       
       
       var img_path=name ? name:  'images';
       var img_name=img_path+"title";
       var content='<li class="img-li">';
           content+='<img class="fl" src="'+imgpath+'" width="100" height="100">';
           content+='<p class="p1"><input type="text" class="img-name" name="'+img_name+'[]" value="'+name+'" style="width:90px" />';
           content+='<input type="hidden" class="img-path" name="'+img_path+'[]" value="'+imgpath+'"/></p>';
           content+='<p class="p2"><span class="btn-ste" onclick="ListImageup.setHead(this,\''+imgpath+'\',\''+selector+'\')">设为封面</span>';
           content+='<span class="btn-closed" onclick="ListImageup.delImg(this,\''+imgpath+'\',\''+selector+'\')"></span></p>';
           content+='</li>';
		var newdom=$(content);   
        $(selector).append(newdom);
		
		if(isindex)
		{
		  newdom.find(".btn-ste").trigger('click');
		}
    },
    /*
    * 删除图片
    *
    * */
    delImg:function(dom,path,selector)
    {
        var pdom=$(selector).parent();
		var hid=pdom.find('.headimg');
		if(hid)
		{
			var headimg=hid.val();
			if(headimg==path)
			   hid.val('');
		}
        $.ajax({
            type: "post",
            url : SITEURL+"uploader/delpicture",
            dataType:'html',
            data:{picturepath:path},
            success: function(result){
                if(result=='ok')
                {
                    $(dom).parents(".img-li").remove();
                }
            }
        });
    },
    setHead:function(dom,path,selector)
    {
        $(selector+" li .btn-ste").removeAttr("style");

        $(selector+" li .btn-ste").text("设为封面");
        $(dom).css("background","green");
        $(dom).css("display","block");
        $(dom).text("已设为封面");
        var pdom=$(selector).parent();
		var hid=pdom.find('input.headimg');
		
		if(hid.length>0)
		{
			hid.val(path)
		}
		else
		{
			pdom.append("<input type='hidden' class='headimg' value='"+path+"'/>");
		}
    }





}
