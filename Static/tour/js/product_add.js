/**
 * Created by Administrator on 14-7-8.
 * 产品添加修改等页面
 */
Product={
    switchTab:function(dom,name,callback)
    {
        $(".w-set-tit span.on").removeClass("on");
        $(dom).addClass('on');
        $(".product-add-div").hide();
        $(".product-add-div#content_"+name).show();
		if(callback)
		   callback(name);
    },
    getDest:function(dom,selector,typeid)
    {
        //Product.getDest(this,'.dest-sel',1)
        var kindlist='';
        $(selector+" input:hidden").each(function(index,ele){
             kindlist+=$(ele).val()+',';
        });
        kindlist=kindlist?kindlist.slice(0,-1):'';
        ST.Destination.setDest(0,typeid,0,kindlist,Product.listDest,1,selector);
    },
    listDest:function(productid,dest_arr,bl,selector)
    {
        var html="";
        for(var i in dest_arr)
        {
          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+dest_arr[i].name+"<input type='hidden' name='kindlist[]' value='"+dest_arr[i].id+"'/></span>";
          $(selector).html(html);
        }
    },
    getAttrid:function(dom,selector,typeid)
    {
        var attr='';
        $(selector+" input:hidden").each(function(index,ele){
            attr+=$(ele).val()+',';
        });
        attr=attr?attr.slice(0,-1):'';
        ST.Attrid.setAttrid(0,typeid,0,attr,Product.listAttr,1,selector);
    }
	,
	listAttr:function(dom,attr_arr,bl,selector)
	{
		var html="";
        for(var i in attr_arr)
        {
          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+attr_arr[i].name+"<input type='hidden' name='attrlist[]' value='"+attr_arr[i].id+"'/></span>";
          $(selector).html(html);
        }
	}
	,getIcon:function(dom,selector)
	{
		//alert(5);
		var icon='';
        $(selector+" input:hidden").each(function(index,ele){
            icon+=$(ele).val()+',';
        });
		ST.Icon.setIcon(0,1,0,icon,Product.listIcon,1,selector);
	},
	listIcon:function(dom,icon_arr,bl,selector)
	{
		var html="";
        for(var i in icon_arr)
        {
          html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+"<img src='"+icon_arr[i].image+"'/>"+"<input type='hidden' name='iconlist[]' value='"+icon_arr[i].id+"'/></span>";
          $(selector).html(html);
        }
	},
    getSupplier:function(dom,selector)
    {
        var supplier='';
        $(selector+" input:hidden").each(function(index,ele){
            supplier+=$(ele).val()+',';
        });
        ST.Supplier.setSupplier(0,1,0,supplier,Product.listSupplier,selector);

    },
    listSupplier:function(dom,supplier_arr,bl,selector)
    {
        var html="";
        for(var i in supplier_arr)
        {
            html+="<span><s onclick=\"$(this).parent('span').remove()\"></s>"+supplier_arr[i].name+"<input type='hidden' name='supplierlist[]' value='"+supplier_arr[i].id+"'/></span>";
            $(selector).html(html);
        }
    },
    Coordinates:function(boxwidth,boxheight)
    {
        var url = SITEURL+'public/vendor/baidumap/index.html';
        ST.Util.showBox('地图坐标识取',url,boxwidth,boxheight,function(){},0,document); 
    },
    /*
    * obj:当前对象
    * contentclass:内容对象class
    * */
    changeTab:function(obj,contentclass)
    {
        var dataid = $(obj).attr('data-id');
        $(obj).addClass('on').siblings().removeClass('on');
        $(contentclass).each(function(){
            if($(this).attr('data-id') == dataid){
                $(this).show();
            }
            else{
                $(this).hide();
            }

        })

    }



}
