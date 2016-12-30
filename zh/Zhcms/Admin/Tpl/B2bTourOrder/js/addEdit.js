/**
 * 选择颜色
 * @param obj 颜色选择对象，按钮对象
 * @param _input 颜色name=color表单
 */
function selectColor(obj, _input) {
	if ($("div.colors").length == 0) {
		var _div = "<div class='colors' style='width:80px;height:160px;position: absolute;z-index:999;'>";
		//颜色块
		var colors = ["#f00f00", "#272964", "#4C4952", "#74C0C0", "#3B111B", "#147ABC", "#666B7F", "#A95026", "#7F8150", "#F09A21", "#7587AD", "#231012", "#DE745C", "#ED2F8D", "#B57E3E", "#002D7E", "#F27F00", "#B74589"];
		for (var i = 0; i < 16; i++) {
			_div += "<div color='" + colors[i] + "' style='background:" + colors[i] + ";width:20px;height:20px;float:left;cursor:pointer;'></div>"
		}
		_div += "</div>";
		$("body").append(_div);
		$(".colors").css({
			top : $(obj).offset().top + 30,
			left : $(obj).offset().left
		});
	}
	$("div.colors").show();
	$("div.colors div").click(function() {
		$("div.colors").hide();
		var _c = $(this).attr("color");
		$("[name='" + _input + "']").val(_c);
		$("[name='title']").css({
			color : _c
		});
	})
}

//标题颜色
function update_title_color() {
	var title = $("[name='title']").css({
		"color" : $("[name='color']").val()
	});
}

//编辑文章时更改标题颜色
$(function() {
	//更改颜色文本框时
	$("[name='color']").blur(function() {
		update_title_color();
	})
	update_title_color();
})
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


//select_exterior('fashion_newcate','aid','title,updatetime','タイトル,新規時間','','multiple','news_cate_id');
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
		height : 500,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + url + '"></iframe>'
	});

}

//区域弹出层
function select_treeselect(table,title_field,id_field,self_title,self_id)
{
    var url =WEB + "?a=Admin&c=TreeSelect&m=select&table="+table+"&title_field="+title_field+"&id_field="+id_field+"&self_title="+self_title+"&self_id="+self_id;
    //alert(url);
    $.modal({
		title : '区域',
		width : 650,
		height : 500,
		content : '<iframe frameborder=0 style="height:99%;border:none;" src="'+url+'"></iframe>'
	});
}


function select_lonlat(lngfield,latfield,addressfield){
    var lngvalue=$("input[name='"+lngfield+"']").val();
    var latvalue=$("input[name='"+latfield+"']").val();
    var addressvalue=$("input[name='"+addressfield+"']").val();
    //区域弹出层
    var url =WEB + "?a=Admin&c=LnglatSelect&m=select&lngfield="+lngfield+"&latfield="+latfield+"&lonvalue="+lngvalue+"&latvalue="+latvalue+"&addressvalue="+addressvalue;
    //alert(url);
    $.modal({
  		title : '経緯度選択',
  		width : 800,
  		height : 600,
  		content : '<iframe frameborder=0 style="height:99%;border:none;" src="'+url+'"></iframe>'
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
        
			var url =WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + options.num + "&name=" + options.name;
//alert(url);
            break;
		case 'image':
			var url = WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + options.num + "&name=" + options.name + "&filetype=" + options.filetype + '&upload_img_max_width=' + options.upload_img_max_width + '&upload_img_max_height=' + options.upload_img_max_height+'&thumb_type='+options.thumb_type;
			break;
		case 'images':

			//span储存的文件数量
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url =WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype + '&upload_img_max_width=' + options.upload_img_max_width + '&upload_img_max_height=' + options.upload_img_max_height+'&thumb_type='+options.thumb_type;
			break;
		case 'files':
			num = $('#zh_up_' + options.id).text() * 1;
			if (num == 0) {
				alert('アップロードMAX数到達!');
				return false;
			}
			var url = WEB + "?a=Admin&c=ContentUpload&m=index&id=" + options.id + "&type=" + options.type + "&num=" + num + "&name=" + options.name + "&filetype=" + options.filetype;
			break;
	}
	$.modal({
		title : 'ファイルアップロード',
		width : 650,
		height : 500,
		content : '<iframe frameborder=0 scrolling="no" style="height:99%;border:none;" src="' + url + '"></iframe>'
	});
}

/**
 * 关闭文件上传窗口
 */
function close_file_upload() {
	$.removeModal();
}

//image || images上传图片显示预览
$(function() {
	$("input.images").live("mouseover", function() {
		//添加预览DIV
		if ($("#img_view").length == 0) {
			var div = "<div id='img_view' style='position:absolute;border:solid 5px #dcdcdc;padding:0px;'><img src='' width='205' height='183'/></div>";
			$("body").append(div);
		}
		var offset = $(this).offset();
		var _l = parseInt(offset.left) + 420;
		var _t = parseInt(offset.top) - 50;
		//有上传图片才可以预览
		if ($(this).val())
			$("#img_view").css({
				left : _l,
				top : _t
			}).find("img").attr("src", $(this).attr("src")).end().fadeIn(200);

	}).live("mouseout", function() {
		$("#img_view").hide();
	})
})
//------------------------上传图片处理（自定义表单）-------------------------
//移除缩略图
function remove_thumb(obj, type, id) {
	$(obj).siblings("img").attr("src", ROOT + "/zh/Common/static/img/upload-pic.png");
	$(obj).siblings("input").val('');
}

/**
 * 删除单图上传的图片（自定义字段）
 * @param obj 按钮对象
 */
function remove_upload_one_img(obj) {
	$(obj).parent().find('input').val('').attr('src', '');
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
 * 删除多图上传的图片（自定义字段）
 * @param obj 按钮对象
 */
function remove_upload(obj, id) {
	//记录上传数量的span
	var _span = $('#zh_up_' + id);
	_span.text(_span.text() * 1 + 1);
	$(obj).parents('li').eq(0).remove();
}