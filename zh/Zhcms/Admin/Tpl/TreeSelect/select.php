<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>选择模板</title>
    <zhjs/>
    <bootstrap/>
    <js file="__CONTROL_TPL__/js/tree_select.js"/>
    <css file="__CONTROL_TPL__/css/tree_select.css"/>
    <script type="text/javascript" charset="utf-8">
    
        var self_id="{$zh.get.self_id}" ;
        var self_title="{$zh.get.self_title}" ;
        var title_field="{$zh.get.title_field}" ;
        var id_field="{$zh.get.id_field}" ;
        var table="{$zh.get.table}" ;
    
        function Ndata(pid,nid,title,selectable){
            this.pid = pid;
            this.nid = nid;
            this.title=title;
            this.selectable=selectable;
            this.showInfo=function(){
                alert('pid:'+this.pid+'  nid:'+this.nid+'  title:'+this.title);
            }
        }
        
        var tree_data={$treeData};
        var tree_array=new Array();
        var top_tree_array=new Array();
        for(var tid in tree_data){
            var nid=tree_data[tid][id_field];
            var pid=tree_data[tid]["pid"];
            var title=tree_data[tid][title_field];
            var selectable=tree_data[tid]["selectable"];
            var ndata = new Ndata(pid,nid,title,selectable);
            if(pid==0){
                top_tree_array.push(ndata);
            }
            tree_array.push(ndata);
        }
        
        $(document).ready(function(){
            var topLevelHtml='<li class="list-group-item">第1层</li>';
            for(var i = 0; i < top_tree_array.length; i++){ 
                var top_data=top_tree_array[i];
                if(top_data.selectable=="1"){
                    topLevelHtml+='<li class="list-group-item selectable" onclick="setValue(\''+top_data.title+'\',\''+top_data.nid+'\')">'+top_data.title+'</li>';
                }else{
                    topLevelHtml+='<li class="list-group-item" onclick="showNextTree(\''+top_data.nid+'\',\'2\',this)">'+top_data.title+'<span class="glyphicon glyphicon-chevron-right"></span></li>';
                }
                
            } 
            $("#topLevel").html(topLevelHtml);
        });
        
        function showNextTree(parentNid,levelNum,ob){
            $(ob).parent('ul').children('li').removeClass('select');
            $(ob).addClass("select");
            
            if(levelNum=='2'){
                 $("#level3").html('');
            }
            var nextLevelHtml='<li class="list-group-item">第'+levelNum+'层</li>';
            for(var i = 0; i < tree_array.length; i++){ 
                var cdata=tree_array[i];
                //alert(cdata.pid);
                if(cdata.pid==parentNid){
                    if(cdata.selectable=="1"){
                        nextLevelHtml+='<li class="list-group-item selectable" onclick="setValue(\''+cdata.title+'\',\''+cdata.nid+'\')">'+cdata.title+'</li>';
                        //nextLevelHtml+='<li class="list-group-item selectable">'+cdata.title+'</li>';
                    }else{
                        nextLevelHtml+='<li class="list-group-item" onclick="showNextTree(\''+cdata.nid+'\',\''+(parseInt(levelNum)+1)+'\',this)">'+cdata.title+'<span class="glyphicon glyphicon-chevron-right"></span></li>';
                        //nextLevelHtml+='<li class="list-group-item" onclick="showNextTree(\''+cdata.nid+'\',\''+(parseInt(levelNum)+1)+'\')">'+cdata.title+'</li>';
                    }
                }
                
                
            } 
            $("#level"+levelNum).html(nextLevelHtml);

        }
        
        function setValue(title,id){
            //var post_data = $(obj).serialize();
            $.post(CONTROL+'&m=getTreeTitle', {id:id,table:table}, function (data) {
                    if (data.state == 1) {
                        $(parent.document).find("[name=" + self_title + "]").val(data.data);
                    	$(parent.document).find("[name=" + self_id + "]").val(id).focus();
                    	//关闭父级modal对话框
                    	$(parent.document).find("[class*=modal]").remove();
                    }
            }, 'json')
        
            
        }
    </script>
    <style>
        #tree_area li:hover{
            cursor: pointer;
        }
        #tree_area{
            position: relative;
        }
        #tree_area li.select{
            background-color:#D9EDF7;
        }
        .selectable{
            color:#337AB7;
        }
        #topLevel{
            width: 150px;
            float:left;
        }
        #level2{
            width: 150px;
            margin-left:5px;
            float:left;
        }
        #level3{
            width: 150px;
            margin-left:5px;
            float:left;
        }
    </style>
</head>
<body>

<div id="tree_area" >
    <ul class="list-group" id="topLevel">
    </ul>
    <ul class="list-group" id="level2">
    </ul>
    <ul class="list-group" id="level3">
    </ul>
</div>

</body>
</html>