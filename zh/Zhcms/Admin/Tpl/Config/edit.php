<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>{$zh.language.admin_config_page_title}</title>
    <zhjs/>
    <script>
    
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
		title : '文件上传',
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
    
    </script>
</head>
<body>
<form action="{|U:edit}" method="post" class="zh-form" onsubmit="return zh_submit(this)">
    <input type="hidden" name="webid" value="{$zh.get.webid}"/>
    <div class="wrap">
        <div class="content-nr">
        <div class="web-set">
                <dl>
                    <dt>站点：</dt>
                    <dd>
                        <list from="$weblist" name="webinfo">
                            <if value="$webinfo.id eq $_GET['webid']">
                                <a class="on" href="{|U:'edit',array('webid'=>$webinfo['id'])}">
                            <else>
                                <a  href="{|U:'edit',array('webid'=>$webinfo['id'])}">
                            </if>
                            {$webinfo.webname}</a>
                        </list>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="title-header">{$zh.language.admin_config_page_hot_hint}</div>
        <div class="help">
            1 {$zh.language.admin_config_page_help1}
            <br/>
            2 {$zh.language.admin_config_page_help2}<br>
            3 {$zh.language.admin_config_page_help3}
        </div>
        <div class="tab">
            <ul class="tab_menu">
                <li lab="web"><a href="#">{$zh.language.admin_config_page_tab_site}</a></li>
                <li lab="weixinweibo"><a href="#">{$zh.language.admin_config_page_tab_weixinweibo}</a></li>
                <li lab="custion_service"><a href="#">{$zh.language.admin_config_page_tab_custom_service}</a></li>
                <li><li lab="rewrite"><a href="#">{$zh.language.admin_config_page_tab_static}</a></li></li>
                <li lab="upload"><a href="#">{$zh.language.admin_config_page_tab_upload}</a></li>
                <li lab="member"><a href="#">{$zh.language.admin_config_page_tab_member}</a></li>
                <li lab="content"><a href="#">{$zh.language.admin_config_page_tab_content}</a></li>
                <li lab="water"><a href="#">{$zh.language.admin_config_page_tab_water}</a></li>
                <li lab="safe"><a href="#">{$zh.language.admin_config_page_tab_safe}</a></li>
                <li lab="optimize"><a href="#">{$zh.language.admin_config_page_tab_speed}</a></li>
                <li lab="email"><a href="#">{$zh.language.admin_config_page_tab_email}</a></li>
                <li lab="cookie"><a href="#">{$zh.language.admin_config_page_tab_cookie}</a></li>
                <li lab="session"><a href="#">{$zh.language.admin_config_page_tab_session}</a></li>
                <li lab="ec_shop_info"><a href="#">{$zh.language.admin_config_page_tab_ec_shop_info}</a></li>
                <li lab="ec_basic"><a href="#">{$zh.language.admin_config_page_tab_ec_basic}</a></li>
                <li lab="ec_display"><a href="#">{$zh.language.admin_config_page_tab_ec_display}</a></li>
            </ul>
            <div class="tab_content">
                <div id="web">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq '站点配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="weixinweibo">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq '微信微博'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="custion_service">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq '客服设置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                
                <div id="rewrite">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq '伪静态'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="upload">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                       <list from="$config" name="c">
                        	<if value="$c.type eq '上传配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="member">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '会员配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="content">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '内容相关'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="water">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '水印配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="safe">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '安全配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="optimize">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '性能优化'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="email">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq '邮箱配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                        <tr>
                        	<td colspan="4">
                        		<button class="zh-cancel-small" id="checkEmail" type="button">メールアドレステスト</button>
                        	</td>
                        </tr>
                    </table>
                </div>
                <div id="cookie">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq 'COOKIE配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="session">
                    <table class="table1">
                    	<tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                    	<list from="$config" name="c">
                        	<if value="$c.type eq 'SESSION配置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>
                <div id="ec_shop_info">
                    <table class="table1">
                        <tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq '网店信息'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>  
                <div id="ec_basic">
                    <table class="table1">
                        <tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq 'EC基本设置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div>  
                <div id="ec_display">
                    <table class="table1">
                        <tr style="background: #E6E6E6;">
                    		<th  class="w150">{$zh.language.admin_config_page_table_th_title}</th>
                    		<th>{$zh.language.admin_config_page_table_th_config}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_variable}</th>
                    		<th class="w300">{$zh.language.admin_config_page_table_th_desc}</th>
                    	</tr>
                        <list from="$config" name="c">
                        	<if value="$c.type eq 'EC显示设置'">
                        		<tr>
	                        		<td>{$c.title|L:@@}</td>
	                        		<td>{$c.html}</td>
	                        		<td>{$webid}_{$c.name}</td>
	                        		<td>{$c.message|L:@@}</td>
                        		</tr>
                            </if>
                        </list>
                    </table>
                </div> 
            </div>
        </div>
        <br /><br /><br /><br /><br /><br />
    </div>
    
    <div class="position-bottom">
        <input type="submit" class="zh-success" value="確認"/>
    </div>
</form>
<script type="text/javascript" charset="utf-8">
	$("#checkEmail").click(function(){
		$.post("{|U:'checkEmail'}",$('form').serialize(),function(json){
				if(json.state){
					alert(json.message);
				}else{
					alert(json.message);
				}
			},'json');
	});
</script>
</body>
</html>