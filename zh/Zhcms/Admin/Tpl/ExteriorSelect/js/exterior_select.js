    function HashMap() {  
        var size = 0;  
        var entry = new Object();  
          
        this.put = function (key, value) {  
            entry[key] = value;  
            size++;  
        };  
          
        this.putAll = function (map) {  
            if (typeof map == "object" && !map.sort) {  
                for (var key in map) {  
                    this.put(key, map[key]);  
                }  
            } else {  
                throw "输入类型不正确，必须是HashMap类型！";  
            }  
        };  
          
        this.get = function (key) {  
            return entry[key];  
        };  
          
        this.remove = function (key) {  
            if (size == 0)  
                return;  
            delete entry[key];  
            size--;  
        };  
          
        this.containsKey = function (key) {  
            if (entry[key]) {  
                return true;  
            }  
            return false;  
        };  
          
        this.containsValue = function (value) {  
            for (var key in entry) {  
                if (entry[key] == value) {  
                    return true;  
                }  
            }  
            return false;  
        };  
          
        this.clear = function () {  
            entry = new Object();  
            size = 0;  
        };  
          
        this.isEmpty = function () {  
            return size == 0;  
        };  
          
        this.size = function () {  
            return size;  
        };  
          
        this.keySet = function () {  
            var keys = new Array();  
            for (var key in entry) {  
                keys.push(key);  
            }  
            return keys;  
        };  
          
        this.entrySet = function () {  
            var entrys = new Array();  
            for (var key in entry) {  
                var et = new Object();  
                et[key] = entry[key];  
                entrys.push(et);  
            }  
            return entrys;  
        };  
          
        this.values = function () {  
            var values = new Array();  
            for (var key in entry) {  
                values.push(entry[key]);  
            }  
            return values;  
        };  
          
        this.each = function (cb) {  
            for (var key in entry) {  
                cb.call(this, key, entry[key]);  
            }  
        };  
          
        this.toString = function () {  
            return obj2str(entry);  
        };  
          
        function obj2str(o) {  
            var r = [];  
            if (typeof o == "string")  
                return "\"" + o.replace(/([\'\"\\])/g, "\\$1").replace(/(\n)/g, "\\n").replace(/(\r)/g, "\\r").replace(/(\t)/g, "\\t") + "\"";  
            if (typeof o == "object") {  
                for (var i in o)  
                    r.push("\"" + i + "\":" + obj2str(o[i]));  
                if (!!document.all && !/^\n?function\s*toString\(\)\s*\{\n?\s*\[native code\]\n?\s*\}\n?\s*$/.test(o.toString)) {  
                    r.push("toString:" + o.toString.toString());  
                }  
                r = "{" + r.join() + "}";  
                return r;  
            }  
            return o.toString();  
        }  
    }  
    
//选择模板
function getTplFile(path) {
	//当前文件地址
	$(parent.document).find('#'+fieldName).val(path);
	//关闭父级modal对话框
	parent.close_select_template();
}
//获得模板列表
function getDateList(url) {
	$.post(url, function(html) {
		$("#select_tpl").html(html);
        $("input[name='id[]']").each(function(i){
            if(mp.containsKey($(this).val())){
                $(this).attr("checked","checked");
            }
         });
	})
}

//全选文章
function select_all() {
    $("[type='checkbox']").attr("checked", "checked");
}
var mp = new HashMap();  

function getSelectResultStr(){
    var keySets=mp.keySet();
    var valueStr="";
    for(var i=0;i<keySets.length;i++){
        if(i==0){
            valueStr=valueStr+keySets[i];
        }else{
            valueStr=valueStr+","+keySets[i];
        }
    }
    return valueStr;
}

function updateSelect(ob){
    if($(ob).attr("checked")){
        mp.put($(ob).val(),"1");  
       // alert(mp.toString());
    }else{
        mp.remove($(ob).val(),"1");  
        //alert(mp.toString());
    }
    setResultStrHtml();
    
}

function singleSelect(ob){
    $id=$(ob).val();
    //父级input表单
    var _input_obj = $(parent.document).find("[name=" + field_name + "]");
    _input_obj.val($id);
    var obp=$(ob).parents('tr');
    $tds=$("td",obp);
    var tvalues=new Array();
    $tds.each(function(index, domEle){
        var thtml=$(domEle).html();
        tvalues[index]=thtml;
    });
    if(parent.window.afterSingleSelect){
        parent.window.afterSingleSelect(field_name,tvalues)
    }
    close_window();
    
}
//关闭
function close_window() {
    $(parent.document).find("[class*=modal]").remove();
}

function setResultStrHtml(){
    var valueStr=getSelectResultStr();
    if(valueStr==""){
        $(".select_result").html("当前没有选择");
    }else{
        $(".select_result").html("当前选择id:"+valueStr);
    }
}

//点击确定
$(function () {
    if(value!=""){
        var resultArr=value.split(',');
        for(var i=0;i<resultArr.length;i++){
            mp.put(resultArr[i],"1");
        }
        setResultStrHtml();
        
    }
    
    
    $("#id_selected").click(function () {
        var valueStr=getSelectResultStr();

        //父级input表单
        var _input_obj = $(parent.document).find("[name=" + field_name + "]");
        _input_obj.val(valueStr);
        close_window();
    })
    
    //alert('aaa');
    //全选
    /*$("input#select_all").click(function () {
        alert('aaa');
        $("[type='checkbox']").each(function(i){
               if( $(this).attr("checked") == "checked"){
                    $(this).attr("checked",false);
               }else{
                    $(this).attr("checked",true);
               }
         });
    })*/
})
