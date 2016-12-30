//添加或修改文章
$(function() {
    
    $("form").submit(function() {
        
        var validate=$("#product_fm input,#product_fm textarea").st_govalidate({require:function(element,index){
		       $(element).css("border","1px solid red");
               $("li[lab='tab_basic']").trigger("click");
			   /*if(index==1)
			   {
			     var switchDiv=$(element).parents(".product-add-div").first();
			     if(switchDiv.is(":hidden")&&!switchId)
			     {
					var switchId=switchDiv.attr('id');
					var columnId=switchId.replace('content','column');
					$("#"+columnId).trigger('click');
			     }  
			   }*/
		 }});
         var startcityVal=$("select[name='startcity']").val();
         if(startcityVal==0){
            $("select[name='startcity']").css("border","1px solid red");
            validate=false;
         }
        
        var kindlistInputs=$('input[name="kindlist[]"]');
        if(kindlistInputs.length==0){
            $('#kindlistbtn').css("border","3px solid red");
            validate=false;
        }
        
        var attrlistInputs=$('input[name="attrlist[]"]');
        if(attrlistInputs.length==0){
            $('#attrlistbtn').css("border","3px solid red");
            validate=false;
        }
        
        
        //alert(kindlistInputs.length);
        
        if(validate==true){
            
            //alert($('startcity'))
        }
        if(validate==true)
        {
            var _post = $(this).serialize();
            dialog_message("数据操作中...", 30);
            $.ajax({
                type : "POST",
                url : CONTROL+"&m=ajax_linesave",
                dataType : "JSON",
                cache : false,
                data : _post,
                success : function(data) {
                    //关闭提示框
    				dialog_message(false);
                    if (data.state == 1) {
                        var line_id=$('#line_id').val();
                        if(line_id != ''){
                            $.modal({
        						width : 250,
        						height : 160,
        						button : true,
        						title : '信息',
        						button_success : "继续操作",
        						button_cancel : "关闭",
        						message : data.message,
        						type : "success",
        						success : function() {
        							if (window.opener) {
                                        window.opener.location="javascript:CHOOSE.searchKeyword();";      
        							}
        							window.location.reload();
        						},
        						cancel : function() {
        							if (window.opener) {
        								window.opener.location="javascript:CHOOSE.searchKeyword();";    
        							}
        							window.close();
        						}
        					})
                        }else{
                            $.modal({
        						width : 250,
        						height : 160,
        						button : true,
        						title : '信息',
        						button_cancel : "关闭",
        						message : data.message,
        						type : "success",
        						cancel : function() {
        							if (window.opener) {
        								window.opener.location="javascript:CHOOSE.searchKeyword();";    
        							}
        							window.close();
        						}
        					})
                        }
                        
                    }
                },
                error : function() {
                    $.dialog({
    					message : "请求时间超时，请过段时间后尝试",
    					type : "error"
    				});
                }
            })
        }else{
            ST.Util.showMsg("请将信息填写完整",1,1200);
        }
        
    })
});

/**
 * 更换模板
 * @param input_id
 */
function select_template(name) {
	$.modal({
		title : 'テンプレートファイル選択',
		button_cancel : '閉じる',
		width : 650,
		height : 400,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + APP + '&c=TemplateSelect&m=select_tpl&name=' + name + '"></iframe>'
	});
}

/**
 * 关闭模板选择窗口
 */
function close_select_template() {
	$.removeModal();
}



/**
 * 文件上传
 * @param id 显示图片列表id
 * @param type 类型 images image
 * @param num 数量
 * @param name 表单名
 * @param upload_img_max_width 最大宽度（超过这个尺寸，会进行图片裁切)
 * @param upload_img_max_width 最大高度（超过这个尺寸，会进行图片裁切)
 * @param water 是否加水印
 * @returns {boolean}
 * id, type, num, name, upload_img_max_width, upload_img_max_height
 */
function file_upload(options) {
   
    //{id:'thumb',type:'thumb',num:1,name:'thumb'}
	//多文件(图片与文件)上传时，判断是否已经超出了允许上传的图片数量
	switch(options.type) {
		case 'thumb':
            alert('TODO:content/js/addedit.js --- thumb');
			var url =WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + options.num + "&name=" + options.name;
//alert(url);
            break;
		case 'image':

            //alert('TODO:content/js/addedit.js --- file_upload');
			var url = WEB + "?a=Admin&c=Upload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + options.num + "&name=" + options.name+ "&dir=" + options.dir+"&thumb_size="+options.thumb_size;
			break;
		case 'images':
			//span储存的文件数量
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url =WEB + "?a=Admin&c=Upload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype + '&upload_img_max_width=' + options.upload_img_max_width + '&upload_img_max_height=' + options.upload_img_max_height+ "&dir=" + options.dir+"&thumb_size="+options.thumb_size;
			break;
		case 'files':
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url = WEB + "?a=Admin&c=Upload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype+ "&dir=" + options.dir;
			break;
	}
    //alert(url);
	$.modal({
		title : 'ファイルアップロード',
		width : 650,
		height : 500,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + url + '"></iframe>'
	});
}

//预览单张图片
function view_image(obj) {
   
	var src = $(obj).attr('src');
	var id = $(obj).attr('id');
	var viewImg = $('#view_' + id);
    
	//删除预览图
	if (viewImg.length >= 1) {
		viewImg.remove();
	}
	//鼠标移除时删除预览图
	$(obj).mouseout(function(){
		$('#view_' + id).remove();
	})
	if (src) {
	   //alert('aaa');
		var offset = $(obj).offset();
		var _left = 450+offset.left+"px";
		var _top = offset.top-100+"px";
		var html = '<img src="' + src + '" style="border:solid 5px #dcdcdc;position:absolute;z-index:1000;width:300px;height:200px;left:'+_left+';top:'+_top+';" id="view_'+id+'"/>';
		
        $('body').append(html);
	}
}

/**
 * 删除单图上传的图片（自定义字段）
 * @param obj 按钮对象
 */
function remove_upload_one_img(obj) {
	$(obj).parent().find('input').val('').attr('src', '');
}

/**
 * 删除多图上传的图片（自定义字段）
 * @param obj 按钮对象
 */
function remove_upload(obj, id) {
	//记录上传数量的span
	var _span = $('#zh_up_' + id);
	_span.text(_span.text() * 1 + 1);
	$(obj).parents('li').eq(0).remove();
}


/**
 * 外部数据选择
 * @param input_id
 */
function select_exterior(table,pk,showf,showt,wherestr,select_type,field_name) {
    
    var url=APP + '&c=ExteriorSelect&m=select&table=' + table + '&pk=' + pk + '&showf=' + showf + '&showt=' + showt + '&wherestr=' + wherestr + '&select_type=' + select_type + '&field_name=' + field_name + '&value=' + $("[name=" + field_name + "]").val();
    //alert(url);
	$.modal({
		title : '外部データ選択',
		width : 650,
		height : 400,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + url + '"></iframe>'
	});
}
