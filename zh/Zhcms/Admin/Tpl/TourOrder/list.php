<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>订单一览</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    
    
    <js file="__STATIC__/tour/js/common.js"/>
    <js file="__STATIC__/tour/js/jquery.hotkeys.js"/>
    <js file="__STATIC__/tour/js/msgbox/msgbox.js"/>
    <js file="__STATIC__/tour/js/extjs/ext-all.js"/>
    <js file="__STATIC__/tour/js/extjs/locale/ext-lang-zh_CN.js"/>
    <link type="text/css" href="__STATIC__/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="__STATIC__/tour/css/common.css" rel="stylesheet"/>
     <link type="text/css" href="__STATIC__/tour/js/msgbox/msgbox.css" rel="stylesheet" />
    <link type="text/css" href="__STATIC__/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>
    <script>
    window.SITEURL =  "__WEB__";
    window.PUBLICURL ="/newtravel/public/";
    window.WEBLIST =  <?php echo json_encode(array_merge(TourCommon::getWebList())); ?> 
    $(function(){
        $.hotkeys.add('f', function(){
                   // parent.window.showIndex(); 
                   //CHOOSE.searchKeyword()
                   search();
                    });
    })
    </script>
    
    <link type="text/css" href="__STATIC__/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/plist.css" rel="stylesheet"/>   
    <link type="text/css" href="__STATIC__/tour/css/order.css" rel="stylesheet"/>
    
    <script type="text/javascript" src="__STATIC__/tour/js/artDialog/lib/sea.js"></script>
    <script>
    
    $(function(){
        
        $("#searchkey").bind({
            click:function(){
                var searchkey = $("#searchkey").val();
                if( searchkey == "订单号/产品名称/联系人" ){
                    $("#searchkey").val("")
                }
            },
            blur:function(){
                var searchkey = $("#searchkey").val();
                if( searchkey == "" ){
                    $("#searchkey").val("订单号/产品名称/联系人")
                }
            }
        })
        
    })
    
    </script>
</head>
<body>

    <div class="crumbs" id="dest_crumbs">
        <label>位置：</label>
        订单中心
        &gt; <span>{$position}</span>
        <div class="pro-search">
            <select class="sty-txt1 set-text-xh wid_200" name="status" id="status" style="margin-right: 10px;">
				<option value="" selected="">全部</option>
                <list from="$lists.status" name="st">
                <option value="{$key}" <if value="$status eq $key">selected='selected'</if>>{$st}</option>
                </list>
			</select>
            <input type="text" id="searchkey" value="<if value='$keyword'>{$keyword}<else/>订单号/产品名称/联系人</if>" datadef="订单号/产品名称/联系人" class="sty-txt1 set-text-xh wid_200" />
            <input type="button" id="btn_search" value="搜索" onclick="search()" class="sty-btn1 default-btn wid_60" />
            <span style="margin-left: 20px; float: left; line-height: 20px;"><a href="{|U:'index',array('typeid'=>$typeid)}" >清除条件</a></span>
        </div>
        
    </div>
    <div class="add_menu-btn" style="border: none">
            <a href="javascript:;" onclick="zh_open_window('{|U:'add',array('typeid'=>$typeid)}');" id="addbtn" class="add-btn-class ml-10" style="margin-top: 50px;">添加</a>
            <!--
            <div id="sellinfo" style="float: left;margin-top: 50px;margin-left: 5px;width:90%">
                <p id="btn" style="float: left">
                    <a href="javascript:;" class="btn_order btn_report" title="查看数据报表">数据报表</a>&nbsp;&nbsp;
                    <a href="javascript:;" class="btn_order btn_excel" title="导出Excel报表">导出Excel</a>
                </p>
                <div id="sell_info_list">
                    <ul>
                      <li>  &nbsp;&nbsp;今日:<span id="today_price">11111</span> &nbsp;&nbsp;</li>
                      <li>| &nbsp;&nbsp;昨日:<span id="last_price">11111</span> &nbsp;&nbsp;</li>
                      <li>| &nbsp;&nbsp;本周:<span id="thisweek_price">11111</span> &nbsp;&nbsp;</li>
                      <li>| &nbsp;&nbsp;本月:<span id="thismonth_price">11111</span> &nbsp;&nbsp;</li>
                      <li>| &nbsp;&nbsp;总销售额:<span id="total_price">11111</span> &nbsp;&nbsp;</li>
                    </ul>
                </div>

            </div>-->
       </div>
        <div id="product_grid_panel" class="content-nrt"  >
        <table class="table2 zh-form">
            <thead>
            <tr>
                <!--<td>选择</td>-->
                <td>订单号</td>
                <td>产品名称</td>
                <td>联系人</td>
                <td>申请日期</td>
                <td>使用日期</td>
                <td>预订数量</td>
                <td>总价</td>
                <td>处理状态</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>
            <list from="$data.lists" name="d">
                <tr>
                    <tr>
                        <!--<td><input name="id" type='checkbox' class='product_check' style='cursor:pointer' value="{$d.id}"/></td>-->
                        <td>{$d.ordersn}</td>
                        <td>{$d.productname|html_entity_decode:@@|mb_substr:@@,0,20,'utf-8'}...</td>
                        <td>{$d.linkman}</td>
                        <td>{$d.addtime}</td>
                        <td>{$d.usedate}</td>
                        <td><?php echo $d["dingnum"]+$d["childnum"]+$d["oldnum"];?></td>
                        <td>{$d.totalprice}</td>
                        <td><?php echo $lists["status"][$d['status']];?></td>
                        <td>
                            <a href="javascript:;" onclick="zh_open_window('{|U:'edit',array('id'=>$d['id'])}');">修改</a>
                            | <a href="javascript:;" onclick="zh_open_window('{|U:'views',array('id'=>$d['id'])}');">预览</a>
                            <!--| <a href="javascript:;" onclick="views('{$d.id}',1);">预览</a>-->
                            <?php $rid = $_SESSION['rid']; ?>
                            <if value="$rid=='18'">
                             <!--| <a href="javascript:;" onclick="deleteorder({$d.id})">删除</a>-->
                             <a href="javascript:confirm('确定删除！')?zh_ajax2('{|U:del}',{id:{$d.id}}):void(0);">删除</a>
                             </if>
                        </td>
                    </tr>
                </tr>
            </list>
            </tbody>
        </table>
		<div class="page1">
			{$page}
		</div>
            
        </div>
           <!-- 
		<div class="position-bottom">
			<input type="button" class="zh-cancel" value="全て選択" onclick="chooseAll()"/>
			<input type="button" class="zh-cancel" value="反选" onclick="chooseDiff()"/>
			<input type="button" class="zh-cancel" onclick="del({$zh.get.mid},{$zh.get.cid})" value="一括削除"/>
		</div>
        -->
        
<script>

$(function(){


    var typeid = "{$typeid}";
    var channelname = "{$channelname}";
    //查看数据报表
    $(".btn_report").click(function(){
        var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=dataview&typeid="+typeid;
        floatBox(channelname+'订单数据报表查看',url,860,510,function(){});

    })
    //导出excel
    $(".btn_excel").click(function(){
        var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=excel&typeid="+typeid;
        floatBox(channelname+'订单生成excel',url,560,380,function(){});
    })

    //获取当前产品订单常规信息
    $.getJSON(SITEURL+'?g=Zhcms&a=Admin&c=TourOrder&m=ajax_sell_info&typeid='+typeid,function(data){
        $("#today_price").html(data.today);
        $("#last_price").html(data.last);
        $("#thisweek_price").html(data.thisweek);
        $("#thismonth_price").html(data.thismonth);
        $("#total_price").html(data.total);

    })

})

window.dialog = null;
    seajs.config({
        alias: {
            "jquery": "jquery-1.10.2.js"
        }
    });
    //定义全局dialog对象
    seajs.use([ '__STATIC__/tour/js/artDialog/src/dialog-plus'], function (dialog) {
        window.dialog = dialog;
    
    });

    function floatBox(boxtitle, url, boxwidth, boxheight, closefunc, nofade,fromdocument) {
            boxwidth = boxwidth != '' ? boxwidth : 0;
            boxheight = boxheight != '' ? boxheight : 0;
            var func = $.isFunction(closefunc) ? closefunc : function () {
            };
            fromdocument = fromdocument ? fromdocument : null;//来源document
        
            window.d = window.dialog({
                url: url,
                title: boxtitle,
                width: boxwidth,
                height: boxheight,
                loadDocument:fromdocument,
                onclose: function () {
                    func();
                }
        
            })
        
        
            if (boxwidth != 0) {
                d.width(boxwidth);
            }
            if (boxheight != 0) {
                d.height(boxheight);
            }
            if (nofade) {
                d.show()
            } else {
                d.showModal();
            }
        
        
            /* dialog({
             title: '添加导航',
             height: 300,
             url: ajaxurl,
             //quickClose: true,
             onshow: function () {
             console.log('onshow');
             },
             oniframeload: function () {
             console.log('oniframeload');
             },
             onclose: function () {
             */
            /*if (this.returnValue) {
             $('#value').html(this.returnValue);
             }*/
            /*
             ST.Util.showMsg('保存成功',4);
             getNav();
        
             //console.log('onclose');
             },
             onremove: function () {
             console.log('onremove');
             }
             })*/
        
        }

//按进行搜索
function search() {
    var keyword = $.trim($("#searchkey").val());
    var status = $.trim($("#status").val());
    var datadef = $("#searchkey").attr('datadef');
    var typeid = "{$typeid}";
    keyword = keyword==datadef ? '' : keyword;

    window.location = WEB + "?a=Admin&c=TourOrder&m=index&typeid="+typeid+"&keyword="+keyword+"&status="+status;
    window.product_store.getProxy().setExtraParam('keyword',keyword);
    window.product_store.load();


}

//选择全部
function chooseAll() {
    var check_cmp = Ext.query('.product_check');
    for (var i in check_cmp) {
        if (!Ext.get(check_cmp[i]).getAttribute('checked'))
            check_cmp[i].checked = 'checked';
    }

    //  window.sel_model.selectAll();
}
//反选
function chooseDiff() {
    var check_cmp = Ext.query('.product_check');
    for (var i in check_cmp)
        check_cmp[i].click();

}

//更新某个字段
function updateField(ele, id, field, value, type) {
    var record = window.product_store.getById(id.toString());

    if (type == 'select') {
        value = Ext.get(ele).getValue();
    }
    var view_el = window.product_grid.getView().getEl();


    Ext.Ajax.request({
        url: SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=index&action=update",
        method: "POST",
        datatype: "JSON",
        params: {id: id, field: field, val: value, kindid: 0},
        success: function (response, opts) {
            if (response.responseText == 'ok') {


                record.set(field, value);
                record.commit();
                // view_el.scrollBy(0,scroll_top,false);
            }
        }});

}


//查看订单
function view(id,typeid)
{
    var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=view&id="+id+"&typeid="+typeid;
    floatBox('查看订单信息',url,450,300,function(){window.product_store.load()});
}

//删除
function deleteorder( id ){
    
    var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=del&id="+id;
    floatBox('确认删除',url,800,600,function(){});
/*
    var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=del";
    if(confirm("确定要删除吗？")){
        $.ajax({
    		type : "POST",
    		url : url,
    		data : "id="+id,
			dataType : "JSON",
    		success : function(data) {
    		  if( data.state == "1" ){
    		      alert("删除成功!");
                  window.location.reload(true);
    		  }else{
    		      alert("删除失败!");
    		  }    		      
            }
    	})
    }*/
}

//预览
function views( id , typeid ){

    var url=SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=views&id="+id+"&typeid="+typeid;
    floatBox('查看订单信息',url,800,600,function(){window.product_store.load()});
    
}



function setDialog(message,type,close_handler){
    //alert('options');
   //默认参数
	var _default = {
		"type" : type//类型 CSS样式
		,
		"message" : message//提示信息
		,
		"timeout" : 3//自动关闭时间
		,
		"close_handler" : function() {
		}//关闭时的回调函数
	};
    var opt = _default;
    //创建元素
	if ($("div.dialog").length == 0) {
		//移除dialog_message对话框
		$('#zh_dialog_message').remove();
		$('#zh_dialog_message_bg').remove();
		var div = '';
		div += '<div class="dialog">';
		div += '<div class="close">';
		div += '<a href="#" title="关闭">×</a></div>';
		div += '<h2 id="dialog_title">提示信息</h2>';
		div += '<div class="con ' + opt.type + '"><strong>ico</strong>';
		div += '<span>' + opt.message + '</span>';
		div += '</div>';
		div += '</div>';
		div += '<div class="dialog_bg"></div>'
		$(div).appendTo("body");

	}
	var _w = $(document).width();
	var _h = $(document).height();
	$("div.dialog_bg").css({
		opacity : 0.8
	}).show();
	$("div.dialog").show();
    //定时id
	var dialog_id;
	//点击关闭dialog
	$("div.dialog div.close a").click(function() {
        if(close_handler){
            close_handler();
        }
		opt.close_handler();
		$("div.dialog_bg").remove();
		$("div.dialog").remove();
		clearTimeout(dialog_id);
	})
	//自动关闭
	dialog_id = setTimeout(function() {
		//如果dialog已经关闭，不执行事件
		if ($("div.dialog").length == 0)
			return;
        if(close_handler){
            close_handler();
        }
		opt.close_handler();
		$("div.dialog_bg").remove();
		$("div.dialog").remove();
	}, opt.timeout * 200);

}

/**
 * 异步提交操作
 * @param obj
 * @param url
 * @returns {boolean}
 */
function zh_ajax2(requestUrl, postData, url) {

    //ajax提交requestUrl ,数据是postData，url是成功后返回页面
	$.ajax({
		type : "POST",
		url : requestUrl,
		cache : false,
		data : postData || {},
		success : function(data) {
		  //alert(data);
		      //判断是否json数据
			if (data.substr(0, 1) == '{') {
				data = jQuery.parseJSON(data);
				if (data.state == 1) {
                    setDialog('删除成功','success',function() {
						window.location.reload(true);
					});					
				} else {
                    setDialog('操作失败','error',function() {
					   });
				}
			} else {
			     setDialog('操作失败','error',function() {
					});
			}
		}
	})
}


</script>
</body>
</html>