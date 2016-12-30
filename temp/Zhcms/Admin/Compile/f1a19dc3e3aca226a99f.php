<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>套餐添加/修改</title>
    <script type='text/javascript' src='http://www.his.com/zh/ZHPHP/zhphp/Extend/Org/Jquery/jquery-1.8.2.min.js'></script>
<link href='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/css/zhjs.css' rel='stylesheet' media='screen'>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/zhjs.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/js/slide.js'></script>
<script src='http://www.his.com/zh/ZHPHP/zhphp/../zhjs/org/cal/lhgcalendar.min.js'></script>
<script type='text/javascript'>
HOST = '<?php echo $GLOBALS['user']['HOST'];?>';
ROOT = '<?php echo $GLOBALS['user']['ROOT'];?>';
WEB = '<?php echo $GLOBALS['user']['WEB'];?>';
URL = '<?php echo $GLOBALS['user']['URL'];?>';
ZHPHP = '<?php echo $GLOBALS['user']['ZHPHP'];?>';
ZHPHPDATA = '<?php echo $GLOBALS['user']['ZHPHPDATA'];?>';
ZHPHPTPL = '<?php echo $GLOBALS['user']['ZHPHPTPL'];?>';
ZHPHPEXTEND = '<?php echo $GLOBALS['user']['ZHPHPEXTEND'];?>';
APP = '<?php echo $GLOBALS['user']['APP'];?>';
CONTROL = '<?php echo $GLOBALS['user']['CONTROL'];?>';
METH = '<?php echo $GLOBALS['user']['METH'];?>';
GROUP = '<?php echo $GLOBALS['user']['GROUP'];?>';
TPL = '<?php echo $GLOBALS['user']['TPL'];?>';
CONTROLTPL = '<?php echo $GLOBALS['user']['CONTROLTPL'];?>';
STATIC = '<?php echo $GLOBALS['user']['STATIC'];?>';
PUBLIC = '<?php echo $GLOBALS['user']['PUBLIC'];?>';
HISTORY = '<?php echo $GLOBALS['user']['HISTORY'];?>';
TEMPLATE = '<?php echo $GLOBALS['user']['TEMPLATE'];?>';
ROOTURL = '<?php echo $GLOBALS['user']['ROOTURL'];?>';
WEBURL = '<?php echo $GLOBALS['user']['WEBURL'];?>';
CONTROLURL = '<?php echo $GLOBALS['user']['CONTROLURL'];?>';
PHPSELF = '<?php echo $GLOBALS['user']['PHPSELF'];?>';
</script>
    <script type="text/javascript" src="http://www.his.com/zh/Zhcms/Admin/Tpl/Line/js/addEdit.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/common.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.hotkeys.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/msgbox/msgbox.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/extjs/ext-all.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/extjs/locale/ext-lang-zh_CN.js"></script>
    <link type="text/css" href="http://www.his.com/Static/tour/js/msgbox/msgbox.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/common.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet"/>
    <script>
    window.SITEURL =  "http://www.his.com/index.php";
    window.PUBLICURL ="/newtravel/public/";
    window.WEBLIST =  [{"webid":0,"webname":"\u4e3b\u7ad9"},{"id":"1","kindname":"\u6d77\u5916","weburl":"http:\/\/haiwai.situ.com","webroot":null,"webprefix":"haiwai","webid":"1","webname":"\u6d77\u5916"}]//网站信息数组
   $(function(){
        //$.hotkeys.add('f', function(){parent.window.showIndex(); });
    })
    </script>
    <link type="text/css" href="http://www.his.com/Static/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base2.css" rel="stylesheet"/>       
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/uploadify/jquery.uploadify.min.js?t=6791075"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/DatePicker/WdatePicker.js"></script>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/Static/tour/js/DatePicker/skin/WdatePicker.css"/>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/product_add.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/imageup.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.validate.js"></script>    
    <link type="text/css" href="http://www.his.com/Static/tour/js/uploadify/uploadify.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="http://www.his.com/Static/tour/vendor/slineeditor/themes/default/css/ueditor.css"/>
    <script defer="defer" type="text/javascript" src="http://www.his.com/Static/tour/vendor/slineeditor/third-party/codemirror/codemirror.js"></script>
    <link href="http://www.his.com/Static/tour/vendor/slineeditor/third-party/codemirror/codemirror.css" type="text/css" rel="stylesheet"/>
    
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/artDialog/lib/sea.js"></script>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/Line/css/css.css"/>
</head>
<body>
    <div class="wrap">
        <div class="content-nr" style="margin-top:0px;">
            <form method="post" name="product_frm" id="product_frm">
                <div class="manage-nr">
                    <div class="w-set-tit bom-arrow" id="nav">
                        <span class="on"><s></s>线路套餐</span>
                    </div>
                    <!--基础信息开始-->
                    <div class="product-add-div">
                        <div class="add-class">
                            <dl>
                                <dt>当前线路：</dt>
                                <dd>
                                      <?php echo $lineinfo['linename'];?>
                                      <input type="hidden" name="lineid" id="lineid" value="<?php echo $lineinfo['id'];?>"/>
                                      <input type="hidden" name="suitid" id="suitid" value="<?php echo $info['id'];?>"/>
                                  </dd>
                            </dl>
                            <dl>
                                <dt>套餐名称：</dt>
                                <dd>
                                    <input type="text" name="suitname" id="suitname"  class="set-text-xh text_700 mt-2" value="<?php echo $info['suitname'];?>" />
                                </dd>
                            </dl>
                            <dl>
                                <dt>套餐类型<?php echo $info['suittype'];?>:  </dt>
                                <dd>
                                    <input type="radio" name="suittype" <?php if($info['suittype'] <> 'b2b'){?> checked="checked" <?php }?>  value="b2c"/><span style="font-size: 16px; font-weight: bold;">B2C</span>&nbsp;&nbsp;
                                    <input type="radio" name="suittype" <?php if($info['suittype'] == 'b2b'){?> checked="checked" <?php }?> value="b2b"/><span style="font-size: 16px; font-weight: bold;">B2B</span>&nbsp;&nbsp;
                                </dd>
                            </dl>
                            <dl style="display: none;">
                                <dt>套餐说明：</dt>
                                <dd style="height: 200px;line-height: 20px">
            
                                      <?php TourCommon::getEditor('description',html_entity_decode($info['description']),700,120,'Line');?>
                                  </dd>
                            </dl>
                        </div>
                        <div class="add-class" style="display: none;">
                            <dl>
                                  <dt>预订送积分：</dt>
                                  <dd>
                                      <input type="text" name="jifenbook" id="jifenbook" class="set-text-xh text_100 mt-2" value="<?php echo $info['jifenbook'];?>" />
                                      <span class="fl ml-5">分</span>
                                  </dd>
                              </dl>
                              <dl>
                                  <dt>积分抵现金：</dt>
                                  <dd>
                                      <input type="text" name="jifentprice" id="jifentprice" value="<?php echo $info['jifentprice'];?>" class="set-text-xh text_100 mt-2 " />
                                      <span class="fl ml-5">元</span>
                                  </dd>
                              </dl>
                              <dl>
                                  <dt>评论送积分：</dt>
                                  <dd>
                                      <input type="text" name="jifencomment" id="jifencomment" class="set-text-xh text_100 mt-2" value="<?php echo $info['jifencomment'];?>" />
                                      <span class="fl ml-5">分</span>
                                  </dd>
                              </dl>
                              <dl>
                                <dt>支付方式：</dt>
                                <dd>
                                    <div class="on-off">
                                        <input type="radio" name="paytype" value="1" <?php if($info['paytype']=='1'){?>checked="checked"<?php }?> />全款支付 &nbsp;
                                        <input type="radio" name="paytype" value="2" <?php if($info['paytype']=='2'){?>checked="checked"<?php }?> />定金支付 &nbsp;
                                        <span id="dingjin" style="
                                                    <?php if($info['paytype'] == '2'){?>
                                                        display:inline-block
                                                    <?php  }else{ ?>
                                                        display: none
                                                    <?php }?>">
                                            <input type="text"  name="dingjin" id="dingjintxt" value="<?php echo $info['dingjin'];?>" size="8" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-\.]+/,'');}).call(this)" onblur="this.v();" />&nbsp;元
                                        </span>
                                        <input type="radio" name="paytype" value="3"  <?php if($info['paytype']=='3'){?>checked="checked"<?php }?> />二次确认支付 &nbsp;
                                        <script>
                                          $("input[name='paytype']").click(function(){
                                              if($(this).val() == 2)
                                              {
                                                  $("#dingjin").show();
                                              }
                                              else
                                              {
    
                                                  $("#dingjin").hide()
                                              }
                                          })
    
                                      </script>
                                    </div>
                                </dd>
                              </dl>
                        </div>
                        <div class="opn-btn" style="padding-left: 10px; " id="hidevalue">
                         <a class="save2" id="btn_view_more" style="<?php if($action=='add'){?>display:none<?php }?>"   href="javascript:;" onclick="showMore()">查看修改报价</a>
                        </div>
                        <div class="w-set-tit bom-arrow" id="nav">
                            <span class="on sp"><s></s>批量添加</span>
                        </div>
                        <div class="add-class">
                            <dl>
                              <dt>日期范围：</dt>
                              <dd>
                                  <input type="text" class="set-text-xh text_100 mt-2 choosetime" name="starttime" />
                                  <span class="fl ml-5">~</span>
                                  <input type="text" class="set-text-xh text_100 mt-2 ml-5 choosetime" name="endtime" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>报价规则：</dt>
                              <dd>
                                  <input type="radio" name="pricerule" class="pricerule" checked="checked" value="all"/>全部&nbsp;&nbsp;
                                  <input type="radio" name="pricerule" class="pricerule" value="week"/>按星期&nbsp;&nbsp;
                                  <input type="radio" name="pricerule" class="pricerule" value="month"/>按号数
        
        
                              </dd>
                          </dl>
                          <dl>
                              <dt></dt>
                              <dd style="height: auto;">
                                  <table class="day_cs" id="week_cs">
                                      <tr height="30px"><td val='1'>周一</td><td val='2'>周二</td><td val='3'>周三</td><td val='4'>周四</td><td val='5'>周五</td><td val='6'>周六</td><td val='7'>周日</td></tr>
                                  </table>
        
                                  <table class="day_cs" id="month_cs">
                                      <tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>
                                      <tr><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td></tr>
                                      <tr><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td><td>30</td></tr>
                                      <tr><td>31</td><td colspan="9"></td></tr>
                                  </table>
                              </dd>
                          </dl>
                          <dl>
                              <dt>适用人群：</dt>
                              <dd class="prop-group">
                                  <input type="checkbox" name="propgroup[]" value="2" id="adultgroup" checked="checked"/>成人
                                  &nbsp;
                                  <input type="checkbox" name="propgroup[]" value="1" id="childgroup"/>儿童
                                  &nbsp;
                                  <input type="checkbox" name="propgroup[]" value="3" id="oldgroup"/>婴儿
                                  &nbsp;
        
                              </dd>
                          </dl>
                          <dl>
                            <dt>套餐价格：</dt>
                            <dd>
                                <table class="group-tb">
                                    <tr class="group_2">
                                      <td width="80">成人价格:</td>
                                      <td>
                                      <span class="fl" style="display: none;">成本</span>
                                      <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="adultbasicprice" onkeyup="calPrice(this)" value="" />
                                      <span class="fl ml-10" style="display: none;">+利润</span>
                                      <span style="display: none;">
                                      <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="adultprofit" onkeyup="calPrice(this)" value="" />
                                      </span>
                                      <span class="fl ml-10" style="display: none;">售价：<b style=" color:#f60" class="tprice"></b></span>
                                      </td>
                                     </tr>
                                     <tr class="group_1" style="display:none">
                                        <td width="80">儿童价格:</td>
                                        <td>
                                            <span class="fl" style="display: none;">成本</span>
                                            <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="childbasicprice" onkeyup="calPrice(this)" value="<?php echo $info['childbasicprice'];?>" />
                                            <span class="fl ml-10" style="display: none;">+利润</span>
                                            <span style="display: none;">
                                            <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="childprofit" onkeyup="calPrice(this)" value="<?php echo $info['childprofit'];?>" />
                                            </span>
                                            <span class="fl ml-10" style="display: none;">售价：<b style=" color:#f60" class="tprice"></b></span>
                                        </td>
                                       </tr>
                                     <tr class="group_3" style="display:none">
                                        <td width="80">婴儿价格:</td>
                                        <td>
                                            <span class="fl" style="display: none;">成本</span>
                                            <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="oldbasicprice" onkeyup="calPrice(this)" value="<?php echo $info['oldbasicprice'];?>" />
                                            <span class="fl ml-10" style="display: none;">+利润</span>
                                            <span style="display: none;">
                                            <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="oldprofit" onkeyup="calPrice(this)" value="<?php echo $info['oldprofit'];?>" />
                                            </span>
                                            <span class="fl ml-10" style="display: none;">售价：<b style=" color:#f60" class="tprice"></b></span>
                                        </td>
                                       </tr>
                                </table>
                            </dd>
                          </dl>
                          <dl style="display: none;">
                              <dt>价格描述：</dt>
                              <dd>
                                  <input type="text" class="set-text-xh text_700 mt-2" style="width: 300px"  name="description" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>库存：</dt>
                              <dd>
                                  <input type="text" class="set-text-xh text_100 mt-2" name="number" value="-1" /> <span style="color:gray;padding-left:10px">-1表示不限</span>
                              </dd>
                          </dl>
                            
                        </div>
                    </div>
                    <!--/基础信息结束-->
                    
                    <div class="opn-btn" style="padding-left: 10px; " id="hidevalue">
                          <input type="hidden" name="suitid" id="suitid" value="<?php echo $info['id'];?>"/>
                          <input type="hidden" name="action" id="action" value="<?php echo $action;?>"/>
                          <input type="hidden" name="lineid" id="lineid" value="<?php echo $lineinfo['id'];?>">
                          <a class="save" id="btn_save" href="javascript:;">保存</a>
                         
    
                      </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        var action = "<?php echo $action;?>";
        var group = "<?php echo $info['propgroup'];?>";
        var groupArr = group.split(',');
        if($.inArray('1',groupArr)!=-1){
            $('.group_1').show();
            $('#childgroup').attr('checked','checked');
        }
        if($.inArray('3',groupArr)!=-1){
            $('.group_3').show();
            $('#oldgroup').attr('checked','checked');
        }
        
        //保存
        $("#btn_save").click(function(){
            var suitname = $("#suitname").val();
            if(suitname==''){
                ST.Util.showMsg('请输入套餐名称',5,1000);
                return false;
            }
            var starttime=$('input[name="starttime"]').val();
            var endtime=$('input[name="endtime"]').val();
            var adultbasicprice=$('input[name="adultbasicprice"]').val();
            var childbasicprice=$('input[name="childbasicprice"]').val();
            var oldbasicprice=$('input[name="oldbasicprice"]').val();
            if(starttime!= '' || endtime != '' ){
                if(adultbasicprice == '' && childbasicprice == '' && oldbasicprice == '' ){
                    ST.Util.showMsg('选中日期批量添加，必须输入价格哦',5,1000);
                    return false;
                }
            }
            if(adultbasicprice != '' || childbasicprice != '' || oldbasicprice != '')
            {
                if(starttime== '' || endtime == '' ){
                    ST.Util.showMsg('请选中需要批量添加的日期',5,1000);
                    return false;
                }
            }
            //alert(starttime);
            //if()
            Ext.Ajax.request({
               url   :  SITEURL+"?g=Zhcms&a=Admin&c=line&m=ajax_suitsave",
               method  :  "POST",
               isUpload :  true,
               form  : "product_frm",
               success  :  function(response, opts)
               {
                   //console.log(response);
                   var data = response.responseText;
                   if(data!='no')
                   {
                        var suitid=$('#suitid').val();
                        if(suitid==''){
                            $("#suitid").val(data);
                            alert('保存成功');
                            if (window.opener) {
                                window.opener.location="javascript:CHOOSE.searchKeyword();";      
 							}
                            //ST.Util.showMsg('保存成功!','4',2000);
                            window.close();
                        }else{
                            $("#suitid").val(data);
                            ST.Util.showMsg('保存成功!','4',2000);
                            $("#btn_view_more").show();
                        }
                       

                   }
               }});
        })
        
        //日历选择
        $(".choosetime").click(function(){
            WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})
        })
        
        //隐藏报价方式
        $("#week_cs").hide();
        $(".day_cs").hide();
        
        $("#week_cs td").click(function(e) {
            var v=$(this).attr('val');
            if($(this).hasClass('active'))
            {
                $("#weekval_"+v).remove();
            }
            else
            {
                $("#hidevalue").append("<input type='hidden' id='weekval_"+v+"' name='weekval[]' value='"+v+"'/>");
            }
            $(this).toggleClass('active');
        });
        
         $("#month_cs td").click(function(e) {

            var v=$(this).text();
            v=$.trim(v);
            v=window.parseInt(v);
            if($(this).hasClass('active'))
            {
                $("#monthval_"+v).remove();
            }
            else
            {
                $("#hidevalue").append("<input type='hidden' id='monthval_"+v+"' name='monthval[]' value='"+v+"'/>");
            }
            $(this).toggleClass('active');
        });
        
        $(".pricerule").click(function(e) {
            if($(this).val()=='week')
            {
                $(".day_cs").hide();
                $("#week_cs").show();
            }
            else if($(this).val()=='month')
            {
                $(".day_cs").hide();
                $("#month_cs").show();
            }
            else
            {
                $("#week_cs").hide();
                $(".day_cs").hide();
            }
        });
        
        $(".prop-group input:checkbox").click(
            function(e)
            {
				$(".group-tb tr").hide();
                $(".prop-group input:checked").each(function(index, element) {
                      var gp=$(element).val();
					  $(".group_"+gp).show();
                });
            }
        );
        
    });
    
    //计算价格
    function calPrice(obj)
    {
        var dd=$(obj).parents('td:first');

        var tprice=0;
        dd.find('input:text').each(function(index, element) {
            var price=parseInt($(element).val());
            if(!isNaN(price))
                tprice+=price;
        });
        dd.find(".tprice").html("¥"+tprice);
    }
    
    //查看日历报价
    function showMore()
    {
        var suitid = $("#suitid").val();
        var productid = $("#lineid").val();

        var width = $(window).width()-100;
        var height = $(window).height()-100
       // var url = "calendar.php?suitid="+suitid+"&carid="+carid;
        var url = SITEURL+'?g=Zhcms&a=Admin&c=calendar&m=index&suitid='+suitid+'&typeid=1&productid='+productid;
        floatBox('查看报价',url,width,height);
       // parent.window.showJbox('查看报价',url,width,height);

    }
    
    window.dialog = null;
    seajs.config({
        alias: {
            "jquery": "jquery-1.10.2.js"
        }
    });
    //定义全局dialog对象
    seajs.use([ 'http://www.his.com/Static/tour/js/artDialog/src/dialog-plus'], function (dialog) {
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
    
    </script>
</body>
</html>