<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>问答系统</title>
    <zhjs/>
    <js file="__CONTROL_TPL__/js/js.js"/>
    <css file="__CONTROL_TPL__/css/css.css"/>
    
    
    <js file="__STATIC__/tour/js/jquery-1.8.3.min.js"/>
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
        $.hotkeys.add('f', function(){parent.window.showIndex(); });
    })
    </script>
    
    <link type="text/css" href="__STATIC__/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/plist.css" rel="stylesheet"/>   
    <link type="text/css" href="__STATIC__/tour/css/order.css" rel="stylesheet"/>
    <link type="text/css" href="__STATIC__/tour/css/jqtransform.css" rel="stylesheet"/>    
    <script type="text/javascript" src="__STATIC__/tour/js/jquery.jqtransform.js"></script>
    <script type="text/javascript" src="__STATIC__/tour/js/hdate/hdate.js"></script>    
    <link type="text/css" href="__STATIC__/tour/js/hdate/hdate.css" rel="stylesheet"/>    

</head>
<body  style="background-color: #fff">
 <div class="derive_box">
    <div class="derive_tit">选择导出时间</div>
    <div class="derive_con">
        <form>
            <p class="pd">
                <input type="radio"  name="time" value="1" checked="checked"/>
                <label>今日</label>
            </p>
            <p class="pd">
                <input type="radio"  name="time" value="2"/>
                <label>昨日</label>
            </p>
            <p class="pd">
                <input type="radio"  name="time" value="3"/>
                <label>最近7天</label>
            </p>
            <p class="pd">
                <input type="radio"  name="time" value="5"/>
                <label>最近30天</label>
            </p>
            <p class="pd">
                <input type="radio"  name="time" value="6" />
                <label>自定义时间段</label>
                <input type="text" value="" id="starttime" onclick="calendar.show({ id: this })" />
                <span class="derive_arrow_rig"></span>
                <input type="text" id="endtime" onclick="calendar.show({ id: this })" />
            </p>
            <div class="now_derive_box"><a class="derive_btn btn_excel" href="javascript:;">立即导出</a></div>
        </form>
    </div>
</div>
<script>

    var typeid = '{$typeid}';
    $(function(){
       $(".btn_excel").click(function(){
           var timetype = $("input[name='time']:checked").val();

           var starttime = endtime = 0;
           if(timetype==6){
               var starttime = $('#starttime').val();
               var endtime = $("#endtime").val();
               if(starttime==''||endtime==''){
                   ST.Util.showMsg('请选择时间段',5,1000);
                   return false;
               }

           }
           var url = SITEURL+'?g=Zhcms&a=Admin&c=TourOrder&m=genexcel&typeid='+typeid+'&timetype='+timetype+'&starttime='+starttime+'&endtime='+endtime;

           window.open(url);
       })

    })
</script>
</body>
</html>