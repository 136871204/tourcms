<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>选择模板</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/exterior_select.js"/>
    <css file="__CONTROL_TPL__/css/exterior_select.css"/>
    <script type="text/javascript" charset="utf-8">
        var table ="{$zh.get.table}" ;
        var select_type ="{$zh.get.select_type}" ;
        var pk="{$zh.get.pk}" ;
        var showf="{$showf}";
        var showt="{$showt}";
        var wherestr="{$zh.get.wherestr}" ;
        var field_name="{$zh.get.field_name}" ;
        var value="{$zh.get.value}" ;
        
        function keyWordSearch(){
            var searchUrl="{|U:'getDateList',array('table'=>$_GET['table'],'select_type'=>$_GET['select_type'],'pk'=>$_GET['pk'])}"+"&search_keyword="+$("input[name='search_keyword']").val()+"&showf="+showf+"&showt="+showt+"&wherestr="+wherestr;
            getDateList(searchUrl);
        }
        
        //注册键盘事件
        
    </script>
</head>
<body>
<div class="wrap">
    <div class="search">
        <form class="zh-form" onsubmit="return false;" >
        关键字：
		<input class="w200" type="text" placeholder="请输入关键字..." value="{$zh.post.search_keyword}" name="search_keyword">
		<button class="zh-cancel" type="button" onclick="keyWordSearch();">
						検索
		</button>
        </form>
    </div>

    <div class="select_result">当前没有选择</div>
    
    <div class="tab">
        <ul class="tab_menu">
            <li lab="select_tpl"><a href="#">选择内容</a></li>
        </ul>
        <div class="tab_content">
            <div id="select_tpl" style="overflow-y: auto;height:315px;">
    
            </div>

        </div>
    </div>
</div>
<div class="position-bottom" style="position: fixed;bottom:0px;">
        <if value="$select_type == 'single' ">
        <input type="button" class="zh-cancel" value="关闭" onclick="close_window();"/>
        <else/>
        <input type="button" class="zh-success" id="id_selected" value="确定"/>
        <input type="button" class="zh-cancel" value="关闭" onclick="close_window();"/>
        </if>
        
    </div>
<script type="text/javascript" charset="utf-8">
	$(function(){
        var getDateListUrl=WEB+"?a=Admin&c=ExteriorSelect&m=getDateList&table="+table+"&select_type="+select_type+"&pk="+pk+"&showf="+showf+"&showt="+showt+"&wherestr="+wherestr;
		getDateList(getDateListUrl);
	});
</script>

</body>
</html>