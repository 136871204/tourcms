
$(function () {
    $("form").validate({
        brand_name: {
            rule: {
                required: true, 
                ajax: {url: CONTROL + "&m=check_brandname", field: ['brand_id']}
            },
            error: {
                required: "ブランド名は必須",
                ajax: 'ブランド名はすでに存在している'
            }
        }
    })
})

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
			var url = WEB + "?a=Admin&c=Upload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + options.num + "&name=" + options.name+ "&dir=" + options.dir;
			break;
		case 'images':
            alert('TODO:content/js/addedit.js --- images');
			//span储存的文件数量
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url =WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype + '&upload_img_max_width=' + options.upload_img_max_width + '&upload_img_max_height=' + options.upload_img_max_height;
			break;
		case 'files':
            alert('TODO:content/js/addedit.js --- files');
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url = WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype;
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
