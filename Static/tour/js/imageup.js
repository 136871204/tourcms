/**
 * Created by Administrator on 14-7-11.
 */
Imageup={
    genePic:function(imgpath,selector,headselector,name)//生成图片框
    {
       if(!window.image_index)
           window.image_index=1;
       else
           window.image_index++;

       var img_path=name ? name:  'images';
       var img_name=img_path+"title";
       var content='<li class="img-li">';
           content+='<img class="fl" src="'+imgpath+'" width="100" height="100">';
           content+='<p class="p1"><input type="text" class="img-name" name="'+img_name+'['+window.image_index+']" style="width:90px" />';
           content+='<input type="hidden" class="img-path" name="'+img_path+'['+window.image_index+']" value="'+imgpath+'"/></p>';
           content+='<p class="p2"><span class="btn-ste" onclick="Imageup.setHead(this,'+window.image_index+')">设为封面</span>';
           content+='<span class="btn-closed" onclick="Imageup.delImg(this,\''+imgpath+'\','+window.image_index+')"></span></p>';
           content+='</li>';
       $(selector).append(content);
    },
    /*
    * 删除图片
    *
    * */
    delImg:function(dom,path,index)
    {
        var headindex= $(".headimgindex").val();
        if(headindex==index)
            $(".headimgindex").val("");

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
    setHead:function(dom,index)
    {
        $("li .btn-ste").removeAttr("style");

        $("li .btn-ste").text("设为封面");
        $(dom).css("background","green");
        $(dom).css("display","block");
        $(dom).text("已设为封面");
        $(".headimgindex").val(index);



       /* var pnode=$(dom).parents('.img-li').first();
        var imgpath=pnode.find('.img-path').val();
        var imgtitle=pnode.find('.img-title').val();
         var content='<ul class="head-img-ul"><li class="img-li"><img class="fl" src="'+imgpath+'" width="100" height="100"><p class="p1"><input type="text" class="img-name" name="headimgtitle" style="width:90px" /><input type="hidden" class="img-path" name="headimg" value="'+imgpath+'"/></p><p class="p2"><span class="btn-closed" onclick="Imageup.delImg(this,\''+imgpath+'\',1)"></span></p></li></ul>';
        $(headselector).html(content);
        */



    }





}
