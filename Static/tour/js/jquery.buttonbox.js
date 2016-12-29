/**
 * Created by netman on 14-8-15.
 * 点击button底部弹出box插件
 */
(function($) {

    $.fn.buttonBox=function(options){

        var defaults  ={
            id:null,
            dataurl:'1',
            params:{}

        };
        var opts = $.extend(defaults , options);

        var errorHTML = '<div style="padding-top:50px;padding-bottom:50px;text-align:center;">加载失败...</div>';

        return this.each(function(){

            $(this).click(function(event){

                if (event && event.stopPropagation)
                //因此它支持W3C的stopPropagation()方法
                    event.stopPropagation();
                else
                //否则，我们需要使用IE的方式来取消事件冒泡
                    window.event.cancelBubble = true;

                var boxid = 'STBOX_'+$(this).attr('id');
                var boxurl = $(this).attr('data-url');
                var resultid = $(this).attr('data-result');//最终选择项的存储容器
                if(resultid != '')
                {
                    var params = {resultid:resultid};
                    opts.params = $.extend(opts.params , params);
                }

                $("div[id^='STBOX_']").hide();

                //查找box是否已经存在
                if($("#"+boxid).length==0){

                        var offset = $(this).offset();
                        var box = $("<div id='"+boxid+"'></div>");
                        $("body").append(box);
                        $("#"+boxid).css({
                            background:'#fff',
                            position:'absolute',
                            boxShadow:'3px 3px 5px #ddd;',
                            top:offset.top+$(event.target).height()+"px",
                            left:offset.left,
                            padding:'0 15px 10px;',
                            zIndex:'1001',
                            display:'none'
                        })
                        //alert(SITEURL+boxurl);
                        //读取数据
                       if(opts.dataurl!='')
                       {
                           $.ajax({
                               type: 'POST',
                               url:  SITEURL+boxurl,
                               data: opts.params,
                               dataType: 'html',
                               cache: false,
                               success: function (data) {
                                   box.html(data);
                               },
                               error: function () {
                                   box.html(errorHTML);
                               }
                           });

                       }




                }
                $('#'+boxid).toggle();//按钮的toggle,如果div是可见的,点击按钮切换为隐藏的;如果是隐藏的,切换为可见的。
                $(document).unbind('click').bind("click",function(e){
                    var target  = $(e.target);//表示当前对象，切记，如果没有e这个参数，即表示整个BODY对象

                    if(target.closest("#"+boxid).length == 0){
                        $("#"+boxid).hide();
                    }
                })


            })



        })





    }




})(jQuery);

