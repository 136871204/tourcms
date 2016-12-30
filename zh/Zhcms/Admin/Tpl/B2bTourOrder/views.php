<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>预览画面</title>
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
    <style>
        .out-box-con .list_dl dt {
            text-align: left;
        }
    </style>
 <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd><?php echo $lists["status"][$info['status']]?></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">备注：</dt>
            <dd style="height: auto">{$info['admin_note']|nl2br}</dd>
        </dl>
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
        <if value="$info['dingnum'] gt 0">
        <dl class="list_dl">
            <dt class="wid_90">人数(成人)：</dt>
            <dd>{$info['dingnum']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">价格(成人)：</dt>
            <dd>{$info['price']}</dd>
        </dl>
        </if>
        
        <if value="$info['childnum'] gt 0">
            <dl class="list_dl">
                <dt class="wid_90">儿童数量：</dt>
                <dd>{$info['childnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">儿童价格：</dt>
                <dd>{$info['childprice']}</dd>
            </dl>
        </if>
        
        <if value="$info['oldnum'] gt 0">
            <dl class="list_dl">
                <dt class="wid_90">婴儿数量：</dt>
                <dd>{$info['oldnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">婴儿价格：</dt>
                <dd>{$info['oldprice']}</dd>
            </dl>
        </if>

        <dl class="list_dl">
            <dt class="wid_90">联系人姓名：</dt>
            <dd>{$info['linkman']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系人性别：</dt>
            <dd><if value="$info['linksex']=='1'">男<else />女</if></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['linktel']}</dd>
        </dl>
        <if value="isset($tourer)">
            <foreach from="$tourer" value="$r" >
        <dl class="list_dl">
            <dt class="wid_90"><if value="$r.ptype=='1'">成人<elseif value="$r.ptype=='2'">儿童<elseif value="$r.ptype=='3'">婴儿</if>游客{$n}：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名：{$r['tourername']}</li>
                    <li>性别：<if value="$info['sex']=='1'">男<else />女</if></li>
                    <li>姓名拼音：{$r['fnamealp']}-{$r["lnamealp"]}</li>
                    <if value="$r['birthdayy']"><li>出生日期：{$r['birthdayy']}-{$r['birthdaym']}-{$r['birthdayd']}</li></if>
                    <if value="$r['passbook']"><li>护照号：{$r['passbook']}</li></if>
                    <if value="$r['effectivey']"><li>护照有效期：{$r['effectivey']}-{$r['effectivem']}-{$r['effectived']}</li></if>
                </ul>

            </dd>
        </dl>
            </foreach>
        </if>
        <dl class="list_dl">
            <dt class="wid_90">留言：</dt>
            <dd style="height: auto">{$info['remark']|nl2br}</dd>
        </dl>
    </div>
   </form>
   
   
   <a href="javascript:window.print();" target="_self" class="zh-success">打印</a>
   
</body>
</html>