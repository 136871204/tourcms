/**
 * Created by Administrator on 14-4-27.
 */
 
 var ST = {};
 ST.Util={
     addTab:function(title,url,issingle,options)
     {

         parent.window.addTab(title,url,1,options);
     },
     showMsg:function(msg,type,time)
     {
         /*--type:4 success
          type:5 failure
          type:6 loading
          type:1 notice
          ---*/
          time = time ? time : 1000;//显示时间
         ZENG.msgbox.show(msg,type,time);

     },
     //隐藏消息框
     hideMsgBox:function(){
         ZENG.msgbox._hide();
     },
     //弹出框
     showBox:function(title,url,boxwidth,boxheight,closefunc,nofade,fromdocument)
     {
       parent.window.floatBox(title,url,boxwidth,boxheight,closefunc,nofade,fromdocument);
     },


     //弹出框关闭
     closeBox:function()
     {
        parent.window.d.close().remove();
     },
     //确认框
     confirmBox:function(boxtitle,boxcontent,okfunc)
     {

         var d = parent.window.dialog({
             title: boxtitle,
             content: boxcontent,
             okValue: '确定',
             ok: function () {
                okfunc();
             },
             cancelValue: '取消',
             cancel: function () {

             }
         });
         d.show()

     },
     //信息框
     messagBox:function(boxtitle,boxcontent,nofade)
     {
         var d = parent.window.dialog({
             title: boxtitle,
             content: boxcontent

         });
         if(nofade){
             d.show()
         }else
         {
             d.showModal();
         }

     },

     //帮助提示框
     helpBox:function(obj,helpid,e)
     {
        /* if (e && e.stopPropagation)
         //因此它支持W3C的stopPropagation()方法
             e.stopPropagation();
         else
         //否则，我们需要使用IE的方式来取消事件冒泡
          window.event.cancelBubble = true;
         var d = parent.window.dialog({
             content: '帮助ID'+helpid+'帮助信息,这个可以很长很长....',
             quickClose: true,
             align:'bottom left'


         });

         d.show(obj);*/

     }


 }

//目的地操作对象 
 ST.Destination={

     setDest:function(ele,typeid,productid,kindlist,callback,noremote,selector)//设置目的地
	 {  
	   //ST.Destination.setDest(0,typeid,0,kindlist,Product.listDest,1,selector);
	     if(Ext.getCmp('dest_window_'+productid))
		    return;
		 
		
		 
         Ext.create('Ext.window.Window',{
			     title:'设置目的地',
				 maxWidth:700,
                 maxHeight:500,

                 overflowY:'auto',
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'dest_window_'+productid,
				 minWidth:350,
				 ghost:false,
				 autoShow:true,
				 buttons:
					{
						style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
						items:[
							{ xtype: 'button', text:'提交',handler:function()
						    	{
						    	     //alert('提交');
									var me=this;
									var selected_dests= Ext.select("#dest_set_"+productid+" .dest-set-selected-td input");
									  var dest_str='';
									  var dest_arr=[];
									  selected_dests.each(function(ele,c,index)
									  {
										 dest_str+=ele.getValue()+',';
										 var _dest_arr={id:ele.getValue(),name:ele.getAttribute('rel')}; 
										 dest_arr.push(_dest_arr); 
										  
									  });
									  dest_str=dest_str.slice(0,-1);
                                    if(noremote)
                                    {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,dest_arr,0,selector);
                                      }
                                      return;
                                    }
									 Ext.Ajax.request({
									 url   : SITEURL+"?g=Zhcms&a=Admin&c=destinations&m=ajax_setdest",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,kindlist:dest_str},
									 success  :  function(response, opts) 
									 { 
									    
										var msg=response.responseText;
										var bl=msg=='ok'?true:false;
									    me.up('window').close();
										Ext.isFunction(callback)
										{
											callback(productid,dest_arr,bl);
										}
										 
									 
									 }})
								
						      }
							},
							{ xtype: 'button', text: '取消' ,handler:function(){
								alert('取消');
								  this.up('window').close();
								
								}}
						 ]
					 },
				 html:"<table class='cm-dest-set' id='dest_set_"+productid+"' style='table-layout:fixed'>"+
                        "<tr class='dest-set-selected-tr'>"+
                            "<td width='50' class='td-left'>已选：</td>"+
                            "<td class='dest-set-selected-td'></td>"+
                        "</tr>"+
                        "<tr class='dest-set-search-tr'>"+
                            "<td width='50' class='td-left'>搜索：</td>"+
                            "<td>"+
                                "<input type='text' name='keyword' class='set-text-xh dest-set-keyword'/>"+
                                "<button onclick=\"ST.Destination.getNextDestSet(0,0,1,0,'"+productid+"')\" class='outbox-ser-btn wid_60 mt-2 ml-5'>搜索</button>"+
                            "</td>"+
                        "</tr>"+
                        "<tr>"+
                            "<td valign='top' class='td-left pt-5'>列表：</td>"+
                            "<td class='dest-set-list'>"+
                                "<div class='dest-set-list-div' style='border-top:0px'>"+
                                    "<a href='javascript:;' onclick=\"ST.Destination.getNextDestSet(0,0,0,0,'"+productid+"')\">全部</a>"+
                                "</div>"+
                            "</td>"+
                        "</tr>"+
                        "</table>",
				 listeners:{
					 afterrender:function()
					  {
					   //alert('afterrender');
						  ST.Destination.getNextDestSet(0,0,0,kindlist,productid);
					  }
					 }
			 });
			 
		 
			 
			 
			 
	 },
	 //获取下一级目的地或搜索的目的地,和setDest配合使用
	 getNextDestSet:function(ele,pid,status,kindlist,productid) 
		  {
			   var keyword='';
			   if(ele==0)
			   {
				   keyword=Ext.select("#dest_set_"+productid+" .dest-set-keyword").first().getValue();
				   keyword=Ext.String.trim(keyword);
				   
			   }
			   Ext.Ajax.request({
							 url   : SITEURL+"?g=Zhcms&a=Admin&c=destinations&m=ajax_getDestsetList",
							 method  :  "POST",
							 datatype  :  "JSON",
							 params:{pid:pid,keyword:keyword,kindlist:kindlist,status:status},
							 success  :  function(response, opts) 
							 { 
							         //alert(response.responseText);
							      var data=Ext.decode(response.responseText);
								  
								  //设置新获取的目的地的层级，PID为0的目的地的step为1.依次类推
								  var step=0;
								  if(pid==0)
								  {
									  step=1;
								  }
								  else
								      step=2;
								  	   
								  if(data.parents)
								  {
									  step=data.parents.length+2;
								  }
								  
								  
								  //删除多余的后面所有级
								   var del_i=step;
									 while(true)
									 {
										var remove_div=Ext.select("#dest_set_"+productid+" .dest-set-list-"+del_i);                                 if(remove_div.getCount()<=0)
										  break;
										else
										  remove_div.remove();  
                                        del_i++; 
										 
									 }
									 
								  
								  //显示已设置的目的地
								  if(data.selected)
								  {
									  Ext.Array.each(data.selected,function(row,index)
									  {
										  var sp_str="<label class='mr-20 cor_666 dest-set-one-"+row.id+"' style='float:left;cursor:pointer;white-space:nowrap'><input type='checkbox' checked='checked' class='mr-3' rel='"+row.kindname+"' value='"+row.id+"' onclick='ST.Destination.cancelDest(this,"+row.id+")'/>"+row.kindname+"</label>";                      
										   Ext.select("#dest_set_"+productid+" .dest-set-selected-td").first().insertHtml('beforeEnd',sp_str);
										  
									  })
									  
								  }
								  
								  //加入新的一级
								  if(data.nextlist.length>0)
								  {
									  
									 var selected_dests= Ext.select("#dest_set_"+productid+" .dest-set-selected-td input");
									  var selected_dests_idarr=[];
									  selected_dests.each(function(ele,c,index)
									  {
										  selected_dests_idarr.push(ele.getValue());
										  
									  });
		  
									 var list_str="<div class='dest-set-list-div dest-set-list-"+step+"'>";
									 Ext.Array.each(data.nextlist, function(row, index, itself){
	                                      var ischecked=Ext.Array.contains(selected_dests_idarr,row.id)?"checked='checked'":'';
										 
										  list_str+="<label class='wid_100 box-hide dest-set-spc-"+row.id+"'>"+
                                                        "<input type='checkbox' "+ischecked+" onclick=\"ST.Destination.chooseDest(this,"+row.id+",'"+row.kindname+"','"+productid+"')\" value='"+row.id+"'/>"+
                                                        "<span step='"+step+"' onclick=\"ST.Destination.getNextDestSet(this,"+row.id+",0,0,'"+productid+"')\">"+row.kindname+"(<font color='red'>"+row.childnum+"</font>)"+"</span>"+
                                                    "</label>";
									  });
									 list_str+="</div>"; 
									
									 
									 Ext.select("#dest_set_"+productid+" "+".dest-set-list").first().insertHtml('beforeEnd',list_str);
									 Ext.getCmp('dest_window_'+productid).hide().show();
								  }
								  
								   
							 }
						})   
	      }, 
		  
	   //选取目的地,与setDest配合使用  
	   chooseDest:function(ele,id,kindname,productid)
	   {
		   var is_checked=Ext.get(ele).is(":checked");
		   
		   if(is_checked)
		   {
			   var selectedDest=Ext.query("#dest_set_"+productid+" .dest-set-one-"+id);
			   if(selectedDest.length<=0)
			   {
			  var sp_str="<label class='mr-20 cor_666 dest-set-one-"+id+"' style='float:left;cursor:pointer;white-space:nowrap'><input type='checkbox' checked='checked' class='mr-3' rel='"+kindname+"' value="+id+" onclick='ST.Destination.cancelDest(this,"+id+")'/>"+kindname+"</label>";
			   Ext.select("#dest_set_"+productid+" .dest-set-selected-td").first().insertHtml('beforeEnd',sp_str);
			    Ext.getCmp('dest_window_'+productid).hide().show();
			   }
		   }
		   else
		   {
			   //Ext.select("#dest_set_"+productid+" .dest-set-one-"+id+" input").first().dom.click();
			  
		   }
		   

	   },
	   //取消当前选择的目的地
	   cancelDest:function(ele,id)
	   {
		   var tab=Ext.get(ele).up('.cm-dest-set');
		   Ext.get(ele).parent().remove();  
		   tab.select('.dest-set-spc-'+id+' input').set({'checked':null},false);
		   
	   }

	      



 }
 
 
 //属性操作 
 ST.Attrid={
	 setAttrid:function(ele,typeid,productid,attrids,callback,noremote,selector)//设置目的地,callback为一个回调函数，参数分别为产品ID,设置的属性数组，布尔状态
	 {
		 if(Ext.getCmp('attr_window_'+productid))
		    return;
		  Ext.create('Ext.window.Window',{
			     title:'设置属性',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'attr_window_'+productid,
				 minWidth:200,
				 minHeight:100,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{ xtype: 'button', text:'提交',handler:function(){
							     var me=this;
								 var selected=Ext.get('attrid_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
								 });
								 selected_str=selected_str.slice(0,-1);
								 if(noremote)
                                   {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,selected_arr,0,selector);
                                      }
                                      return;
                                   }
								 
								 
								  Ext.Ajax.request({
									 url   : SITEURL+"?g=Zhcms&a=Admin&c=attrid&m=ajax_setattrid",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,attrids:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							     
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						  
						  Ext.Ajax.request({
							 url   : SITEURL+"?g=Zhcms&a=Admin&c=attrid&m=ajax_attridlist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 params:{typeid:typeid},
							 success  :  function(response, opts) 
							 { 
							     var data=Ext.decode(response.responseText);
								 var attrid_arr=attrids?attrids.split(','):[];
								 
								 //生成json列表
								 var html="<table class='cm-attrid-set' id='attrid_set_"+productid+"'>";
								 Ext.Array.each(data, function(row, index){
									 var checked_tpl="{pchecked}"; //checked模板。用来判断子属性是否被选中。 
									 html+="<tr class='set-attrid-row-p'><td height='40' colspan='2'><span class='ml-10'>"+"("+row.webname+")"+row.attrname+"</span></td></tr>";
									 var pchecked=Ext.Array.contains(attrid_arr,row.id)?"checked='checked'":'';
									
									 if(row.children)
									 {
		
										 html+="<tr class='set-attrid-row-c cld-one-"+row.id+"'><td height='30' valign='top' colspan='2' style='border-bottom:1px solid #eee'>"
									     Ext.Array.each(row.children, function(crow, cindex){
											 var checked_c='';
											 if(Ext.Array.contains(attrid_arr,crow.id))
											 {
												 checked_c="checked='checked'"
												 pchecked="checked='checked'"
											 }
											
										    html+="<span class='outbox-sx-sp'><label><input type='checkbox' class='mr-3' onclick=\"ST.Attrid.chooseAttr(this,"+crow.id+","+row.id+")\" "+checked_c+" rel='"+crow.attrname+"' value='"+crow.id+"'/>"+crow.attrname+"<label></span>";
										 });
										 html+="</td></tr>";
									 }
									 html=html.replace(/\{pchecked\}/ig,pchecked);
								  })
								 html+="</table>" ;
								 wind.update(html);
								 
							 
							 }
							 });
						 
						 
						 
					 }
					}
				 
				 });
		 
		 
		 
		 
	 },//选择属性 ，ele:dom元素，id: 属性ID，PID：属性的PID
	 chooseAttr:function(ele,id,pid)
	 {
		 var tab=Ext.get(ele).up('.cm-attrid-set');
		 var is_checked=Ext.get(ele).is(':checked');
		 if(!pid)
		 {
		    var children_checked=tab.select('.cld-one-'+id+' input:checked');
			if(children_checked.getCount()>0)
			{
			   Ext.get(ele).set({checked:'checked'},false);
			    ST.Util.showMsg('下级属性如果被选中的话，主属性也会被选中');
			}
		 }
		 else
		 {
			  tab.select('.set-attrid-one-'+pid).set({checked:'checked'},false);
		 }
	 } 
	 
    }
 
ST.Theme={
	 setTheme:function(ele,typeid,productid,themelist,callback)
	 {
		  if(Ext.getCmp('theme_window_'+productid))
		        return;
		  Ext.create('Ext.window.Window',{
			     title:'设置专题',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'theme_window_'+productid,
				 minWidth:200,
				 minHeight:100,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{xtype: 'button', text:'提交',handler:function(){
							    var me=this; 
						         var selected=Ext.get('theme_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
								 });
							     selected_str=selected_str.slice(0,-1);
						        Ext.Ajax.request({
									 url   : SITEURL+"theme/ajax_settheme",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,themes:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							        
						 
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						 if(window.theme_list)
						 {
						    ST.Theme.geneList(wind,typeid,productid,themelist,callback,window.theme_list) 
						 }
						 else
						 {
						     Ext.Ajax.request({
							 url   : SITEURL+"theme/ajax_themelist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 success  :  function(response, opts) 
							  { 
							      
							     var data=Ext.decode(response.responseText);
								 window.theme_list=data;
								 ST.Theme.geneList(wind,typeid,productid,themelist,callback,data);
							  }
					       	})
						 }
					 }
					}
				 
				 });
	 },
	 geneList:function(wind,typeid,productid,themelist,callback,data)
	 {
		 var html="<div class='cm-theme-set' id='theme_set_"+productid+"'>";
		  var theme_arr=themelist?themelist.split(','):[];
		  Ext.Array.each(data, function(row, index){
			  var checked_str=Ext.Array.contains(theme_arr,row.id)?"checked='checked'":'';
		       html+="<span><input type='checkbox' rel='"+row.ztname+"' value='"+row.id+"' "+checked_str+"/>"+row.ztname+"</span>";
		  })
		 html+="</div>";
		 wind.update(html);
		 wind.hide();
		 wind.show();
		 
	 }	
 }
 
 ST.Icon={
	  setIcon:function(ele,typeid,productid,iconlist,callback,noremote,selector)
	  {
		  if(Ext.getCmp('icon_window_ '+productid))
		    return;
		   Ext.create('Ext.window.Window',{
			     title:'设置图标',
				 maxWidth:600,
				 border:1,
				 style: {
                     borderStyle: 'solid',
					 borderWidth:'1px'
                  },
				 id:'icon_window_'+productid,
				 minWidth:400,
				 minHeight:300,
				 ghost:false,
				 autoShow:true,
				 buttons:
				 {
					style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
					items:[
						{xtype: 'button', text:'提交',handler:function(){
							    var me=this; 
						         var selected=Ext.get('icon_set_'+productid).select('input:checked');
								 var selected_str='';
								 var selected_arr=[];
							     selected.each(function(ele,comp,index)
								 {
									 selected_str+=ele.getValue()+',';
                                     var imgpath=ele.next('img').getAttribute('src');  
									 selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue(),image:imgpath});
								 });
								 if(noremote)
                                   {
                                      me.up('window').close();
                                      Ext.isFunction(callback)
                                      {
                                        callback(productid,selected_arr,0,selector);
                                      }
                                      return;
                                   }
								 
							     selected_str=selected_str.slice(0,-1);
						        Ext.Ajax.request({
									 url   : SITEURL+"?g=Zhcms&a=Admin&c=icon&m=ajax_seticon",
									 method  :  "POST",
									 datatype  :  "JSON",
									 params:{typeid:typeid,productid:productid,icons:selected_str},
									 success  :  function(response, opts) 
									 { 
									       var bl=response.responseText=='ok'?true:false;
									       if(Ext.isFunction(callback))
										   {
											   callback(productid,selected_arr,bl);
										   }
									       me.up('window').close();
									 }})
							      
						 
							}
						},
						{ xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
					 ]
				  },
				 listeners:{
					 afterrender:function(wind)
					 {
						 if(window.icon_list)
						 {
						    ST.Icon.geneList(wind,typeid,productid,iconlist,callback,window.icon_list) 
						 }
						 else
						 {
						     Ext.Ajax.request({
							 url   : SITEURL+"?g=Zhcms&a=Admin&c=icon&m=ajax_iconlist",
							 method  :  "POST",
							 datatype  :  "JSON",
							 success  :  function(response, opts) 
							  { 
							      
							     var data=Ext.decode(response.responseText);
								 window.icon_list=data;
								 ST.Icon.geneList(wind,typeid,productid,iconlist,callback,data);
							  }
					       	 })
						 }
					 }
					}
				 
				 });
		    
	  },
	  geneList:function(wind,typeid,productid,iconlist,callback,data)
	  {
		 var html="<div class='cm-icon-set' id='icon_set_"+productid+"'>";
		  var icon_arr=iconlist?iconlist.split(','):[];
		  Ext.Array.each(data, function(row, index){
			  var checked_str=Ext.Array.contains(icon_arr,row.id)?"checked='checked'":'';
		       html+="<span class='fl'><input class='fl' type='checkbox' rel='"+row.kind+"' value='"+row.id+"' "+checked_str+"/><img class='fl' alt='"+row.kind+"' title='"+row.kind+"' src='"+row.picurl+"'/></span>";
		  })
		 html+="</div>";
		 wind.update(html);
		 wind.hide();
		 wind.show(); 
		  
	  }

}
//修改页面使用共公函数
ST.Modify={
    //获取选择的目的地
    getSelectDest:function(arr)
    {
        var html = '';
        $.each(arr, function(i, item){
                html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+item.kindname;
                html+="<input type=\"hidden\" name=\"kindlist[]\" value=\""+item.id+"\"></span>";
        });
        return html;
    },
    //获取选择的属性
    getSelectAttr:function(arr)
    {
        var html = '';
        $.each(arr, function(i, item){

            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+item.attrname;
            html+="<input type=\"hidden\" name=\"attrlist[]\" value=\""+item.id+"\"></span>";
        });
        return html;
    },
    //获取选择的图标
    getSelectIcon:function(arr)
    {

        var html = '';
        $.each(arr, function(i, item){

            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s><img src=\""+item.picurl+"\">";
            html+="<input type=\"hidden\" name=\"iconlist[]\" value=\""+item.id+"\"></span>";
            });
        return html;
    },
    getUploadFile:function(arr,showsethead)
    {

        var html = '';
        var sethead = showsethead==0 ? 0 : 1;
        $.each(arr,function(i,item){
            var k=i+1;

            html+='<li class="img-li">';
            html+='<img class="fl" src="'+item.litpic+'" width="100" height="100">';
            html+='<p class="p1">';
            html+='<input type="text" class="img-name" name="imagestitle['+k+']" value="'+item.desc+'" style="width:90px">';
            html+='<input type="hidden" class="img-path" name="images['+k+']" value="'+item.litpic+'">';
            html+='</p>';
            html+='<p class="p2">';
            if(sethead){
                html+='<span class="btn-ste" onclick="Imageup.setHead(this,'+k+')">设为封面</span>';
            }

            html+='<span class="btn-closed" onclick="Imageup.delImg(this,\''+item.litpic+'\','+k+')"></span>';
            html+='</p>';
            html+='</li>';


        })
       return html;


    }


}

// 输入框焦点事件
$.fn.focusEffect = function() {
    var $input = this;

    $input.focus(function() {

        if ($(this).val() == '' || $(this).val() == $(this).attr('datadef')) {
            $(this).val('');
            $(this).css({
                color : '#333'
            })
        }
    });
    $input.blur(function() {
        //alert($(this).attr('id'));
        if ($(this).val() == '') {

            $(this).val($(this).attr('datadef'));
            $(this).css({
                color : '#aaa'
            })
        }
    })
}


ST.Supplier={
    setSupplier:function(ele,typeid,productid,supplierlist,callback,selector)
    {
        if(Ext.getCmp('supplier_window_'+productid))
            return;
        Ext.create('Ext.window.Window',{
            title:'设置供应商',
            maxWidth:600,
            border:1,
            style: {
                borderStyle: 'solid',
                borderWidth:'1px'
            },
            id:'supplier_window_'+productid,
            minWidth:200,
            minHeight:100,
            ghost:false,
            autoShow:true,
            buttons:
            {
                style:"background:#fff",	   //设置背景色，这样就不会有透明 的了.
                items:[
                    {xtype: 'button', text:'提交',handler:function(){
                        var me=this;
                        var selected=Ext.get('supplier_set_'+productid).select('input:checked');
                        var selected_str='';
                        var selected_arr=[];
                        selected.each(function(ele,comp,index)
                        {
                            selected_str+=ele.getValue()+',';
                            selected_arr.push({name:ele.getAttribute('rel'),id:ele.getValue()});
                        });
                        selected_str=selected_str.slice(0,-1);
                        Ext.Ajax.request({
                            url   : SITEURL+"supplier/ajax_set_supplier",
                            method  :  "POST",
                            datatype  :  "JSON",
                            params:{typeid:typeid,productid:productid,supplierids:selected_str},
                            success  :  function(response, opts)
                            {
                                var bl=response.responseText=='ok'?true:false;
                                if(Ext.isFunction(callback))
                                {
                                    callback(productid,selected_arr,bl,selector);
                                }
                                me.up('window').close();
                            }})


                    }
                    },
                    { xtype: 'button', text: '取消',handler:function(){ this.up('window').close();} }
                ]
            },
            listeners:{
                afterrender:function(wind)
                {
                    if(window.supplier_list)
                    {
                        ST.Supplier.geneList(wind,typeid,productid,supplierlist,callback,window.supplier_list)
                    }
                    else
                    {
                        Ext.Ajax.request({
                            url   : SITEURL+"supplier/ajax_supplier_list",
                            method  :  "POST",
                            datatype  :  "JSON",
                            success  :  function(response, opts)
                            {

                                var data=Ext.decode(response.responseText);

                                window.supplier_list=data;
                                ST.Supplier.geneList(wind,typeid,productid,supplierlist,callback,data);
                            }
                        })
                    }
                }
            }

        });
    },
    geneList:function(wind,typeid,productid,supplierlist,callback,data)
    {
        var html="<div class='cm-supplier-set' id='supplier_set_"+productid+"'>";
        var supplier_arr=supplierlist?supplierlist.split(','):[];
        Ext.Array.each(data, function(row, index){
            var checked_str=Ext.Array.contains(supplier_arr,row.id)?"checked='checked'":'';
            html+="<label class='supplier-sp'><input class='fl mt-3 mr-3' type='radio' name='suppliername' rel='"+row.suppliername+"' value='"+row.id+"' "+checked_str+"/>"+row.suppliername+"</label>";
        })
        html+="</div>";
        wind.update(html);
        wind.hide();
        wind.show();

    }
}



