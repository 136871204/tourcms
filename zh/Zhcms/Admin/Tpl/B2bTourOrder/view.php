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
    

</head>
<body  style="background-color: #fff">
 <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">产品名称：</dt>
            <dd>
                 {$info['productname']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">出发日期：</dt>
            <dd>{$info['usedate']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">人数<if value="$typeid==1">(成人)</if>：</dt>
            <dd>{$info['dingnum']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">价格<if value="$typeid==1">(成人)</if>：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="price" id="price" value="{$info['price']}" /></dd>
        </dl>
        <if value="$typeid==1">
            <dl class="list_dl">
                <dt class="wid_90">小孩数量：</dt>
                <dd>{$info['childnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">小孩价格：</dt>
                <dd><input type="text" class="set-text-xh text_200 mt-4" name="childprice" id="childprice" value="{$info['childprice']}" ></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">老人数量：</dt>
                <dd>{$info['oldnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">老人价格：</dt>
                <dd><input type="text" class="set-text-xh text_200 mt-4" name="oldprice" id="oldprice" value="{$info['oldprice']}" ></dd>
            </dl>
        </if>

        <dl class="list_dl">
            <dt class="wid_90">客户姓名：</dt>
            <dd>{$info['linkman']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['linktel']}</dd>
        </dl>
        <if value="isset($tourer)">
            <foreach from="$tourer" value="$r" >
        <dl class="list_dl">
            <dt class="wid_90">游客{$n}：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名:{$r['tourername']}</li>
                    <li>性别:{$r['sex']}</li>
                    <li>手机:{$r['mobile']}</li>
                    <li>证件:{$r['cardtype']}</li>
                    <li>证件号码:{$r['cardnumber']}</li>
                </ul>

            </dd>
        </dl>
            </foreach>
        </if>
        <dl class="list_dl">
            <dt class="wid_90">预订说明：</dt>
            <dd style="height: auto">{$info['remark']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd>
              <input name="status" type="radio" class="checkbox" value="0" <if value="$info['status']==0">checked="checked"</if>  />未处理
              <input name="status" type="radio" class="checkbox" value="1" <if value="$info['status']==1">checked="checked"</if>  />处理中
              <input name="status" type="radio" class="checkbox" value="2" <if value="$info['status']==2">checked="checked"</if>  />交易成功
              <input name="status" type="radio" class="checkbox" value="3" <if value="$info['status']==3">checked="checked"</if>  />取消订单
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}"/>
                <input type="hidden" id="typeid" name="typeid" value="{$typeid}"/>
            </dd>
        </dl>
    </div>
   </form>
   <script>
   $(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"?g=Zhcms&a=Admin&c=TourOrder&m=ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {
                    try{
                        var data = $.parseJSON(response.responseText);
                    }
                    catch(e){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                        return false;
                    }

                    if(data.status)
                    {
                        ST.Util.showMsg('保存成功!','4',2000);
                    }


                }});

        })


    })
   
   </script>
</body>
</html>