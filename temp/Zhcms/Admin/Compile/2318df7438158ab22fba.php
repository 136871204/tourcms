<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>线路管理</title>
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
        $.hotkeys.add('f', function(){parent.window.showIndex(); });
    })
    </script>
    <link type="text/css" href="http://www.his.com/Static/tour/css/style.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/base2.css" rel="stylesheet"/>
    <link type="text/css" href="http://www.his.com/Static/tour/css/jqtransform.css" rel="stylesheet"/>    
    <link type="text/css" href="http://www.his.com/Static/tour/js/extjs/resources/ext-theme-neptune/ext-theme-neptune-all-debug.css" rel="stylesheet">    
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/uploadify/jquery.uploadify.min.js?t=6791075"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/product_add.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/st_validate.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.colorpicker.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.jqtransform.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/imageup.js"></script>
    <script type="text/javascript" src="http://www.his.com/Static/tour/js/jquery.upload.js"></script>    
    <link type="text/css" href="http://www.his.com/Static/tour/js/uploadify/uploadify.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="http://www.his.com/Static/tour/vendor/slineeditor/themes/default/css/ueditor.css"/>
    <script defer="defer" type="text/javascript" src="http://www.his.com/Static/tour/vendor/slineeditor/third-party/codemirror/codemirror.js"></script>
    <link href="http://www.his.com/Static/tour//vendor/slineeditor/third-party/codemirror/codemirror.css" type="text/css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="http://www.his.com/zh/Zhcms/Admin/Tpl/Line/css/css.css"/>
</head>
<body>
    <?php //TourCommon::getEditor('jseditor','',700,300,'Sline','','print',true); ?>
    <div class="wrap">
        <div class="menu_list">
    		<ul>
                <li>
                    <a   class="action" >操作线路</a>
                </li>
    		</ul>
        </div>
        <div class="title-header">商品信息</div>
        <form method="post" class="zh-form" name="product_fm" id="product_fm"   onsubmit="return false;" action="<?php echo U(add);?>" enctype="multipart/form-data" >
            <div class="tab">
                <ul class="tab_menu">
                    <li lab="tab_basic"><a href="#">基础信息</a></li>
                    <li lab="tab_shotcontent"><a href="#">产品推荐</a></li>
                    <?php

                      foreach($columns as $col)
                      {
                         if($col['columnname']=='jieshao'){
                            echo "<li lab='tab_".$col['columnname']."' onclick='beforeJieshao();'  ><a href=\"#\">".$col['chinesename']."</a></li>";
                         }else{
                            echo "<li lab='tab_".$col['columnname']."'><a href=\"#\">".$col['chinesename']."</a></li>";
                         }
                         
                      }
                    ?>
                    <li lab="tab_attachment" ><a href="#">上传封面图片</a></li>
                    <li lab="tab_seo"><a href="#">优化设置</a></li>
                </ul>
                <div class="tab_content">
                    <div id="tab_basic">
                        <table class="table1">
                            <tr>
                                <th class="w100">站点：</th>
                                <td>
                                    <select name="webid">
                                        <?php
                                        $roleid=$_SESSION['rid'];
                                       foreach($webSelectArr as $web)
                                       {
                                            if($web['id']=='1'){
                                                continue;
                                            }
                                            if($roleid==19){//北京管理员
                                                if($web['id']!='3'){
                                                    continue;
                                                }
                                            }else if($roleid==20){//上海管理员
                                                if($web['id']!='2'){
                                                    continue;
                                                }
                                            }else if($roleid==22){//其他地区管理员
                                                if($web['id']!='6'){
                                                    continue;
                                                }
                                            }else{//超级管理员
                                                
                                            }
                                           $is_selected=$web['id']==$info['webid']?"selected='selected'":'';
                                           echo "<option ".$is_selected." value='".$web['id']."'>".$web['webname']."</option>";
                                       }
                                       ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>产品编号：<span class="error">*</span></th>
                                <td>
                                    <input type="text" name="linesn" data-required="true" value="<?php echo $info['linesn'];?>"  class="set-text-xh text_500 mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th>过期时间：<span class="error">*</span></th>
                                <td>
                                    <?php 
                                    $expirevalue=$info['expire'];
                                    $expirevalue = empty($expirevalue) ? "": date("Y-m-d", $expirevalue);
                                    ?>
                                    <input  id="expire" name="expire" data-required="true" value="<?php echo $expirevalue;?>" class="w150" type="text"/>
                                    <script>$('#expire').calendar({format: 'yyyy-MM-dd'});</script>      
                                </td>
                            </tr>
                            <tr>
                                <th>出发地：<span class="error">*</span></th>
                                <td>
                                    <select name="startcity"  >
                                        <option value="0">请选择出发地</option>
                                        <?php echo $startplacelist;?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>咨询电话：<span class="error">*</span></th>
                                <td>
                                    <input type="text" name="hotlinetel" data-required="true" value="<?php echo $info['hotlinetel'];?>"  class="set-text-xh text_400 mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th>线路名称：<span class="error">*</span></th>
                                <td>
                                    <input type="text" name="linename" data-required="true" class="set-text-xh text_700 mt-2" value="<?php echo $info['linename'];?>"/>
                                    <input type="hidden" name="lineid" id="line_id" value="<?php echo $info['id'];   ?>"/>
                                </td>
                            </tr>
                            <tr>
                                <th>节假日名称：</th>
                                <td>
                                    <input type="text" name="holiday" value="<?php echo $info['holiday'];?>"  class="set-text-xh text_300 mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th>线路特色：</th>
                                <td>
                                    <input type="text" name="sellpoint" value="<?php echo $info['sellpoint'];?>"  class="set-text-xh text_700 mt-2"/>
                                </td>
                            </tr>
                            <tr>
                                <th>目的地选择：<span class="error">*</span></th>
                                <td>
                                    <input type="button"  id="kindlistbtn" onclick="Product.getDest(this,'.dest-sel',1)"  class="btn-sum-xz mt-4" value="选择"/>
                                    <div class="save-value-div mt-2 ml-10 dest-sel">
                                        <?php if(is_array($info['kindlist_arr'])):?><?php $index=0; ?><?php  foreach($info['kindlist_arr'] as $v){ ?>
                                        <span>
                                            <s onclick="$(this).parent('span').remove()"></s>
                                            <?php echo $v['kindname'];?>
                                            <input type="hidden" name="kindlist[]" value="<?php echo $v['id'];?>"/>
                                        </span>
                                        <?php $index++; ?><?php }?><?php endif;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>旅行方式：<span class="error">*</span></th>
                                <td>
                                    <input type="button"  id="attrlistbtn" class="btn-sum-xz mt-4" onclick="Product.getAttrid(this,'.attr-sel',1)" value="选择"/>
                                    <div class="save-value-div mt-2 ml-10 attr-sel wid_650">
                                        <?php if(is_array($info['attrlist_arr'])):?><?php $index=0; ?><?php  foreach($info['attrlist_arr'] as $v){ ?>
                                        <span>
                                            <s onclick="$(this).parent('span').remove()"></s>
                                            <?php echo $v['attrname'];?>
                                            <input type="hidden" name="attrlist[]" value="<?php echo $v['id'];?>"/>
                                        </span>
                                        <?php $index++; ?><?php }?><?php endif;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>推荐图标设置：</th>
                                <td>
                                    <input type="button" class="btn-sum-xz mt-4" onclick="Product.getIcon(this,'.icon-sel')" value="选择"/>
                                    <div class="save-value-div mt-2 ml-10 icon-sel">
                                        <?php if(is_array($info['iconlist_arr'])):?><?php $index=0; ?><?php  foreach($info['iconlist_arr'] as $v){ ?>
                                        <span>
                                            <s onclick="$(this).parent('span').remove()"></s>
                                            <img src="<?php echo $v['picurl'];?>"/>
                                            <input type="hidden" name="iconlist[]" value="<?php echo $v['id'];?>"/>
                                        </span>
                                        <?php $index++; ?><?php }?><?php endif;?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>旅游天数：<span class="error">*</span></th>
                                <td>
                                    <input type="text" value="<?php echo $info['lineday'];?>" data-regrex="number" data-required="true" data-msg="必须为数字" id="travel_days" class="w60" name="lineday"/>
                                    *天
                                    <input type="text" value="<?php echo $info['linenight'];?>" data-regrex="number" data-msg="必须为数字" class="w60" name="linenight"/>
                                    晚
                                </td>
                            </tr>
                            <tr>
                                <th>燃油费：</th>
                                <td>
                                   
                                        <input type="radio" name="baf"  <?php if($info['baf']==0){?>checked="checked"<?php }?> value="0"/>
                                        包含
                                        <input  type="radio" name="baf"  <?php if($info['baf']==1){?>checked="checked"<?php }?> value="1"/>
                                        不含
                                        <input  type="radio" name="baf"  <?php if($info['baf']==2){?>checked="checked"<?php }?> value="2"/>
                                        不显示
                                </td>
                            </tr>
                            <tr>
                                <th>成团人数:<span class="error">*</span></th>
                                <td>
                                    <input type="text" name="corporationnum"  data-required="true" value="<?php echo $info['corporationnum'];?>"  class="set-text-xh text_100 mt-2"/>
                                </td>
                            </tr>
                            <tr >
                                <th>提前天数：</th>
                                <td>
                                    建议提前
                                    <input type="text" name="linebefore" value="<?php echo $info['linebefore'];?>" data-regrex="number" data-msg="必须为数字" class="w60"/>
                                    天报名
                                </td>
                            </tr>
                            <tr>
                                <th>市场价：</th>
                                <td>
                                    <input type="text" value="<?php echo $info['storeprice'];?>" name="storeprice" class="w60"/>元
                                </td>
                            </tr>
                            <tr>
                                <th>推荐:</th>
                                <td>
                                    <?php if(is_array($sysmagrecommend)):?><?php $index=0; ?><?php  foreach($sysmagrecommend as $n=>$v){ ?>
                                        <input name="magrecommend_pub[]" type="checkbox" class="checkbox" id="Magrecommend<?php echo $n;?>" <?php if(strpos($info['magrecommend'],$v) !== false){?>checked="checked" <?php }?> value="<?php echo $v;?>" />&nbsp;
                                        <label for="Magrecommend<?php echo $n;?>"><?php echo $v;?></label>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    <?php if(is_array($usermagrecommend)):?><?php $index=0; ?><?php  foreach($usermagrecommend as $n=>$user){ ?>
                                        <?php if(!in_array($user,$sysmagrecommend) && !empty($user)){?>
                                        <input name="magrecommend_pub[]" type="checkbox" class="checkbox" id="Magrecommend_user_<?php echo $n;?>" checked="checked" value="<?php echo $user;?>" />&nbsp;
                                        <label for="Magrecommend_user_<?php echo $n;?>"><?php echo $user;?></label>
                                        <?php }?>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    <span id="addmr"></span>
                                    <img style="line-height: 30px;vertical-align: middle;cursor: pointer" onclick="addMagrecommend()" src="http://www.his.com/Static/tour/images/tianjia.png" />
                                </td>
                            </tr>
                            <tr>
                                <th>往返交通:</th>
                                <td>
                                    <?php if(is_array($sysjiaotong)):?><?php $index=0; ?><?php  foreach($sysjiaotong as $v){ ?>
                                        <input name="transport_pub[]" type="checkbox" class="checkbox" id="Transport<?php echo $n;?>" <?php if(strpos($info['transport'],$v) !== false){?>checked="checked" <?php }?> value="<?php echo $v;?>" />&nbsp;
                                        <label for="Transport<?php echo $n;?>"><?php echo $v;?></label>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    <?php if(is_array($usertransport)):?><?php $index=0; ?><?php  foreach($usertransport as $user){ ?>
                                        <?php if(!in_array($user,$sysjiaotong) && !empty($user)){?>
                                        <input name="transport_pub[]" type="checkbox" class="checkbox" id="Transport_user_<?php echo $n;?>" checked="checked" value="<?php echo $user;?>" />&nbsp;
                                        <label for="Transport_user_<?php echo $n;?>"><?php echo $user;?></label>
                                        <?php }?>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    <span id="addjt"></span>
                                    <img style="line-height: 30px;vertical-align: middle;cursor: pointer" onclick="addJiaoTong()" src="http://www.his.com/Static/tour/images/tianjia.png" />
                                </td>
                            </tr>
                            <?php
                            if($roleid==18){
                                echo '<tr >';
                            }else{
                                echo '<tr style="display: none;">';
                            }
                             ?>
                                <th>搜索显示数据：</th>
                                <td>
                                    <span >推荐次数</span>
                                    <input type="text" name="yesjian" value="<?php echo $info['yesjian'];?>" data-regrex="number" data-msg="*必须为数字" class="w60"/>
                                    <span  style="display: none;" >满意度</span>
                                    <input  style="display: none;" type="text" name="satisfyscore" value="<?php echo $info['satisfyscore'];?>" data-regrex="number" data-msg="*必须为数字" class="w60"/>
                                    <span >销量</span>
                                    <input type="text" name="bookcount" value="<?php echo $info['bookcount'];?>" data-regrex="number" data-msg="*必须为数字" class="w60"/>
                                </td>
                            </tr>
                            <tr>
                                <th>前台公开：</th>
                                <td>
                                   
                                        <input type="radio" name="ishidden"  <?php if($info['ishidden']==0){?>checked="checked"<?php }?> value="0"/>
                                        公开
                                        <input  type="radio" name="ishidden"  <?php if($info['ishidden']==1){?>checked="checked"<?php }?> value="1"/>
                                        非公开
                                </td>
                            </tr>
                            
                            
                            
                            
                            
                            

                            <tr  style="display: none;">
                                <th>儿童标准:</th>
                                <td>
                                    <input type="text" class="w700" name="childrule" value="<?php echo $info['childrule'];?>"/>
                                </td>
                            </tr>
                            <tr  style="display: none;">
                                <th>婴儿标准:</th>
                                <td>
                                    <input type="text" class="w700" name="babyrule" value="<?php echo $info['babyrule'];?>"/>
                                </td>
                            </tr>
                            <tr  style="display: none;">
                                <th>显示模版:</th>
                                <td>
                                    <input style="width:300px;" id="template" name="template" value="<?php echo $info['template'];?>" onfocus="select_template('template');" type="text"/><span id="zh_template"></span>
                                    <button class="zh-cancel-small" type="button" onclick="select_template('template');">テンプレート選択</button>                    
                                </td>
                            </tr>
                            <tr  style="display: none;">
                                <th>标题颜色：</th>
                                <td>
                                    <input type="text" name="color" value="<?php echo $info['color'];?>" class="set-text-xh text_100 mt-2 title-color"/>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tab_shotcontent">
                        <div  class="editor-range">
                            <?php 
                            echo '<textarea id="shotcontent" style="width:900px;height:500px"  name="shotcontent">';
                            echo $info['shotcontent'];
                            echo '</textarea>';
                             //echo  tag('ueditor', array("name" => 'shotcontent', "content" => html_entity_decode($info['shotcontent']), "style" => 1, "height" => 300, "width" => 1000));
                            ?>
                        </div>
                    </div>

                    <?php
                      foreach($columns as $col)
                      { 
                        if($col['columnname']=='jieshao'){
                            echo '<div class="product-add-div"  id="tab_'.$col['columnname'].'">';
                            ?>
                            <div class="ap-div-top">
                                <dl>
                                    <dt>排版方式：</dt>
                                    <dd>
                                        <div class="temp-chg">
                                            <a <?php if($info['isstyle']==2 ||empty($info['isstyle'])) echo 'class="on"';   ?> href="javascript:void(0)" onclick="togStyle(this,2)">标准版</a>
                                            <a <?php if($info['isstyle']==1) echo 'class="on"';   ?> href="javascript:void(0)" onclick="togStyle(this,1)">简洁版</a>
        
                                            <input type="hidden" name="isstyle" id="line_isstyle" value="<?php echo $info['isstyle'];?>"/>
                                        </div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>用餐情况：</dt>
                                    <dd>
                                    <div class="on-off">
                                      <input type="radio" id="" class="fl mt-8" onclick="togDiner(1)" name="showrepast" value="1" <?php if($info['showrepast']==1||!isset($info['showrepast'])) echo 'checked="checked"';   ?>>
                                      <label class="fl mr-20 ml-5">显示</label>
                                      <input type="radio" id="" class="fl mt-8" onclick="togDiner(0)" <?php if($info['showrepast']==0&&isset($info['showrepast'])) echo 'checked="checked"';   ?> name="showrepast" value="0">
                                      <label class="fl mr-20 ml-5">隐藏</label>
                                    </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="content-jieshao-simple" style="<?php  if(empty($info['isstyle'])||$info['isstyle']==2) echo 'display:none'   ?>">
                               <div>
                               <?php 
                                echo  tag('ueditor', array("name" => 'jieshao', "content" => html_entity_decode($info['jieshao']), "style" => 1, "height" => 300, "width" => 1000));
                                ?>
                               </div>
                            </div>
                            <div class="content-jieshao-detail" style="<?php  if($info['isstyle']==1) echo 'display:none'   ?>">
                                <?php


                                   foreach($info['linejieshao_arr'] as $k=>$v)
                                   {
                                       $jiaotong = '';
                                       $transport_arr=explode(',',$v['transport']);
                                       foreach($sysjiaotong as $v1)
                                       {
                                           $checkstatus = in_array($v1,$transport_arr) ? "checked='checked'" : '';
                                           $jiaotong.="<span class=\"fl\"><input class=\"fl mt-8\" type=\"checkbox\" ".$checkstatus."  name=\"transport[".$v['day']."][]\" value=\"".$v1."\"/></span>&nbsp;<label class=\"fl ml-5 mr-20\" style=\"cursor:pointer;\">".$v1."</label>";
                                       }
        
                                       foreach($transport_arr as $user)
                                       {
                                            if(!in_array($user,$sysjiaotong) && !empty($user))
                                            {
                                               $jiaotong.="<span class=\"fl zdy\"><input checked='checked'  class=\"fl mt-8\" type=\"checkbox\"  name=\"transport[".$v['day']."][]\" value=\"".$user."\"/></span>&nbsp;<label class=\"fl ml-5 mr-20\" style=\"cursor:pointer;\">".$user."</label>";
        
                                            }
        
                                       }
                                       $jiaotong.=" <span id=\"addjt_".$v['day']."\"></span><img class='addimg' data-contain='addjt_".$v['day']."' data-day='".$v['day']."' style=\"line-height: 30px;vertical-align: middle;cursor: pointer\"  src=\"". $info['static_path'] ."/tour/images/tianjia.png\">";
                                        
                                       $imageup='';
                                       $imageup.='<fieldset class="img_list">';
                                            $imageup.='<legend style="color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;">图片列表</legend>';
                                            $imageup.='<center>';
                                                $imageup.='<div style="color:#666;font-size:12px;margin-bottom: 5px;">';
                                                $imageup.='最多';
                                                $imageup.='<span style="color:red" id="zh_up_img_timg'.$v['day'].'">10</span>';
                                                $imageup.='张图片可以上传';
                                                $imageup.='</div>';
                                            $imageup.='</center>';
                                            $imageup.='<div id="img_timg'.$v['day'].'" class="fileList">';
                                            if (!empty($v['timg'])) {
                                                $h='';
                                                $h .= '<ul>';
                                                $pic_arr = explode(',', $v['timg']);
                                                $id = "img_timg".$v['day'];
                                                $tname="timg".$v['day'];
                                                foreach ($pic_arr as $pick => $picv) {
                                                    if (empty($picv))
                                                        continue;
                                                    $imginfo_arr = explode('||', $picv);
                                                    $h .= "<li><div class='img'><img src='http://www.his.com/" . $imginfo_arr[0] . "' style='width:135px;height:135px;'/>";
                                					$h .= "<a href='javascript:;' onclick='remove_upload(this,\"$id\")'>X</a>";
                                					$h .= "</div>";
                                					$h .= "<input type='hidden' name='" . $tname. "[path][]'  value='" . $imginfo_arr[0] . "' src='http://www.his.com" . '/' . $imginfo_arr[0] . "' class='w400 images'/> ";
                                					$h .= "<input type='text' name='" . $tname . "[alt][]' value='" . $imginfo_arr[1] . "' placeholder='画像説明...'/>";
                                					$h .= "</li>";
                                                }
                                                $h .= '</ul>';
                                                $imageup.=$h;
                                            }
                                            
                                            $imageup.='</div>';
                                        $imageup.='</fieldset>';
                                        $imageup.='<button class="zh-cancel-small" onclick=\'file_upload({"id":"img_timg'.$v['day'].'","type":"images","num":"10","name":"timg'.$v['day'].'","filetype":"jpg,png,gif,jpeg","upload_img_max_width":"596","upload_img_max_height":"370","thumb_type":"5","dir":"line","thumb_size":"596*370"})\' type="button">图片上传</button> <span class="timg'.$v['day'].' validate-message"></span>     ';
                                        $imageup.='<span style="color:red;">请上传596*370或等比例图片</span>  ';
                                       $breakfirst_check=$v['breakfirsthas']==1?'checked="checked"':'';
                                       $lunch_check=$v['lunchhas']==1?'checked="checked"':'';
                                       $supper_check=$v['supperhas']==1?'checked="checked"':'';
                                       $transport_arr=explode(',',$v['transport']);
                                       $car_check=in_array(2,$transport_arr)?'checked="checked"':'';
                                       $train_check=in_array(3,$transport_arr)?'checked="checked"':'';
                                       $plane_check=in_array(1,$transport_arr)?'checked="checked"':'';
                                       $ship_check=in_array(4,$transport_arr)?'checked="checked"':'';
                                       $food_style=$info['showrepast']==0?"display:none":'';
                                       //$dayspot= Model_Line::getDaySpotHtml($v['day'],$v['lineid']);
                                       $jieshao='<div class="add-class">';
                                       $jieshao.='<dl><dt>第'.$v['day'].'天：</dt>';
                                       $jieshao.='<dd>';
                                       $jieshao.='<input type="text" name="jieshaotitle['.$v['day'].']" value="'.$v['title'].'" class="set-text-xh text_700 mt-2"/></dd>';                                      $jieshao.='</dl>';
                                       $jieshao.='<dl class="jieshao-diner" style="'.$food_style.'">';
                                       $jieshao.='<dt>用餐情况：</dt>';
                                       $jieshao.='<dd>';
                                       $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="breakfirsthas['.$v['day'].']" '.$breakfirst_check.' value="1"></span>';
                                       $jieshao.='<label style=" float:left; cursor: pointer;">早餐</label>';
                                       $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="breakfirst['.$v['day'].']" value="'.$v['breakfirst'].'"/></span>';
                                       $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="lunchhas['.$v['day'].']" '.$lunch_check.' value="1"></span>';
                                       $jieshao.='<label style=" float:left; cursor: pointer;">午餐</label>';
                                       $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="lunch['.$v['day'].']" value="'.$v['lunch'].'"/></span>';
                                       $jieshao.='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="supperhas['.$v['day'].']" '.$supper_check.' value="1"></span>';
                                       $jieshao.='<label style=" float:left; cursor: pointer;">晚餐</label>';
                                       $jieshao.='<span><input class="set-text-xh text_177 ml-5 mr-10" type="text"name="supper['.$v['day'].']" value="'.$v['supper'].'"/></span>';
                                       $jieshao.='</dd>';
                                       $jieshao.='</dl>';
                                       $jieshao.='<dl><dt>住宿情况：</dt>';
                                       $jieshao.='<dd><input type="text"  class="set-text-xh text_222 mt-2" name="hotel['.$v['day'].']" value="'.$v['hotel'].'"></dd>';
                                       $jieshao.='</dl>';
                                       $jieshao.='<dl   style="display: none;"><dt>交通工具：</dt>';
                                       $jieshao.='<dd   style="display: none;">';
                                       $jieshao.=$jiaotong;
                                       $jieshao.='</dd>';
                                       $jieshao.='</dl>';
                                       
                                       $jieshao.='<dl><dt>行程内容：</dt>';
                                       $jieshao.='<dd>';
                                       $jieshao.='<textarea name="tjieshao['.$v['day'].']" style="width:800px;height:100px;resize:both;" >'.$v['tjieshao'].'</textarea>';
                                       $jieshao.='</dd>';
                                       $jieshao.='</dl>';
                                       
                                       $jieshao.='<dl><dt>模板用图片：</dt>';
                                       $jieshao.='<dd>';
                      
                                       $jieshao.=$imageup;
                                       
                                       $jieshao.='</dd>';
                                       $jieshao.='</dl>';
                                       
                                       $jieshao.='<div class="xc-con">';
                                       $jieshao.='<h4>自由编辑：</h4>';
                                       $jieshao.='<div>';
                                       $jieshao.='<textarea name="txtjieshao['.$v['day'].']" style=" float:left" id="line_content_'.$v['day'].'">'.$v['jieshao'].'</textarea>';
                                       $jieshao.='</div>';
                                       //$jieshao.='<dl>';
                                       //$jieshao.='<dt>相关景点：</dt>';
                                       //$jieshao.='<dd><input type="button" class="btn-sum-xz mt-4" value="提取" onclick="autoGetSpot('.$v['day'].')"><div class="save-value-div mt-2 ml-10" id="listspot_'.$v['day'].'">'.$dayspot.'</div></dd>';
                                       //$jieshao.='</dl>';
                                       $jieshao.='</div></div>';
                                       echo $jieshao;
                                   }
        
                                ?>
                            </div>
                            <?php 
                            echo '</div>';
                        }
                        /** addby xie 20151207**/
                        elseif($col['columnname']=='biaozhun'){
                            echo '<div class="product-add-div"  id="tab_'.$col['columnname'].'">';
                            ?>
                            <div class="ap-div-top">
                                <dl>
                                    <dt>排版方式：</dt>
                                    <dd>
                                        <div class="temp-chg">
                                            <a <?php if($info['biaozhun_isstyle']==2 ||empty($info['biaozhun_isstyle'])) echo 'class="on"';?> href="javascript:void(0)" onclick="togStyle2(this,2)">标准版</a>
                                            <a <?php if($info['biaozhun_isstyle']==1) echo 'class="on"';   ?> href="javascript:void(0)" onclick="togStyle2(this,1)">简洁版</a>
        
                                            <input type="hidden" name="biaozhun_isstyle" id="biaozhun_isstyle" value="<?php echo $info['biaozhun_isstyle'];?>"/>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                            <div class="content-biaozhun-simple" style="<?php  if(empty($info['biaozhun_isstyle'])||$info['biaozhun_isstyle']==2) echo 'display:none';?>">
                            <?php
                                echo '<div id="tab_'.$col['columnname'].'">';
                                echo '<div  class="editor-range" style="margin-top:36px;">';
                                echo '<textarea id="'.$col['columnname'].'" style="width:900px;height:500px"  name="'.$col['columnname'].'">';
                                echo $info[$col['columnname']];
                                echo '</textarea>';
                                echo '</div>';
                                echo '</div>';                            
                            ?>
                            </div>
                            <div class="content-biaozhun-detail" style="<?php  if($info['biaozhun_isstyle']==1) echo 'display:none';?>">

                                <table class="table1" id="biaozhuninfo">
                                    <tr>
                                        <th class="w80">航班信息</th>
                                        <th class="w80">航空公司</th>
                                        <th class="w80">航班号</th>
                                        <th class="w80">起飞机场</th>
                                        <th class="w80">起飞时间</th>
                                        <th class="w80">到达机场</th>
                                        <th class="w80">到达时间</th>
                                    </tr>
                                    <?php if(empty($info['biaozhun_detail'])){?>
                                    <tr class="biaozhuninfo">
                                        <th class="w80"><input name="biaozhuninfo1" value="" /></th>
                                        <th><input name="biaozhuncompany1" value="" /></th>
                                        <th><input name="biaozhunnum1" value="" /></th>
                                        <th><input name="biaozhunstartairport1" value="" /></th>
                                        <th><input name="biaozhunstarttime1" value="" /></th>
                                        <th><input name="biaozhunendairport1" value="" /></th>
                                        <th><input name="biaozhunendtime1" value="" /></th>
                                    </tr>
                                    <?php  }else{ ?>
                                    <?php if(is_array($info['biaozhun_detail'])):?><?php $index=0; ?><?php  foreach($info['biaozhun_detail'] as $key=>$bz){ ?>
                                    <tr class="biaozhuninfo">
                                        <th class="w80"><input name="biaozhuninfo<?php echo $key;?>" value="<?php echo $bz["biaozhuninfo".$key];?>" /></th>
                                        <th><input name="biaozhuncompany<?php echo $key;?>" value="<?php echo $bz["biaozhuncompany".$key];?>" /></th>
                                        <th><input name="biaozhunnum<?php echo $key;?>" value="<?php echo $bz["biaozhunnum".$key];?>" /></th>
                                        <th><input name="biaozhunstartairport<?php echo $key;?>" value="<?php echo $bz["biaozhunstartairport".$key];?>" /></th>
                                        <th><input name="biaozhunstarttime<?php echo $key;?>" value="<?php echo $bz["biaozhunstarttime".$key];?>" /></th>
                                        <th><input name="biaozhunendairport<?php echo $key;?>" value="<?php echo $bz["biaozhunendairport".$key];?>" /></th>
                                        <th><input name="biaozhunendtime<?php echo $key;?>" value="<?php echo $bz["biaozhunendtime".$key];?>" /></th>
                                    </tr>
                                    <?php $index++; ?><?php }?><?php endif;?>
                                    <?php }?>
                                </table>
                                <input type="hidden" name="biaozhuncount" id="biaozhuncount" value="<?php echo count($info['biaozhun_detail']);?>" />
                                <span class="biaozhunadd">增加</span> | <span class="biaozhundel">减少</span>
                            </div>
                            </div>
                  <?php }
                        /** addby xie end 20151207**/
                        
                        else{
                            echo '<div id="tab_'.$col['columnname'].'">';
                            echo '<div  class="editor-range">';
                            echo '<textarea id="'.$col['columnname'].'" style="width:900px;height:500px"  name="'.$col['columnname'].'">';
                            echo $info[$col['columnname']];
                            echo '</textarea>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                      }
                    ?>
                    <div id="tab_attachment">
                        <table class="table1">
                            <tr>
                                <th class="w80">封面图片：</th>
                                <td>
                                    <input id="linepic" name="linepic" value="<?php echo $info['linepic'];?>" src="http://www.his.com/<?php echo $info['linepic'];?>" class="w300 images" onmouseover="view_image(this)" type="text"/>
                                    <button class="zh-cancel-small" onclick='file_upload({"id":"linepic","type":"image","dir":"config","num":1,"name":"linepic","filetype":"jpg,png,gif,jpeg","upload_img_max_width":"500","upload_img_max_height":"280","thumb_type":"5","dir":"line","thumb_size":"500*280,300*168,200*113"})' type="button">图片上传</button>
                                    &nbsp;&nbsp;
                                    <button class="zh-cancel-small" onclick="remove_upload_one_img(this)" type="button">取消</button></td>
                            </tr>
                            <tr>
                                <th class="w80">线路相册：</th>
                                <td>
                                    <fieldset class="img_list">
                                        <legend style="color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;">图片列表</legend>
                                        <center>
                                        <div style="color:#666;font-size:12px;margin-bottom: 5px;">
                                        最多
                                        <span style="color:red" id="zh_up_img_piclist">10</span>
                                        张图片可以上传
                                        </div>
                                        </center>
                                        <div id="img_piclist" class="fileList">
                                        <?php
                                        if (!empty($info['piclist'])) {
                                            $h='';
                                            $h .= '<ul>';
                                            $pic_arr = explode(',', $info['piclist']);
                                            $id = "img_piclist";
                                            //p($pic_arr);die;
                                            foreach ($pic_arr as $k => $v) {
                                                if (empty($v))
                                                    continue;
                                                $imginfo_arr = explode('||', $v);
                                                $h .= "<li><div class='img'><img src='http://www.his.com/" . $imginfo_arr[0] . "' style='width:135px;height:135px;'/>";
                            					$h .= "<a href='javascript:;' onclick='remove_upload(this,\"$id\")'>X</a>";
                            					$h .= "</div>";
                            					$h .= "<input type='hidden' name='" . "piclist" . "[path][]'  value='" . $imginfo_arr[0] . "' src='http://www.his.com" . '/' . $imginfo_arr[0] . "' class='w400 images'/> ";
                            					$h .= "<input type='text' name='" . "piclist" . "[alt][]' value='" . $imginfo_arr[1] . "' placeholder='画像説明...'/>";
                            					$h .= "</li>";
                                                
                                            }
                                            $h .= '</ul>';
                                            echo $h;
                                        }
                                        
                                        ?>
                                        </div>
                                    </fieldset>
                                    <button class="zh-cancel-small" onclick='file_upload({"id":"img_piclist","type":"images","num":"10","name":"piclist","filetype":"jpg,png,gif,jpeg","upload_img_max_width":"800","upload_img_max_height":"800","thumb_type":"5","dir":"line","thumb_size":"500*280,300*168,200*113"})' type="button">图片上传</button> <span class="piclist validate-message"></span>                   
                                    <span style="color: red;">500*280</span>
                                </td>
                            </tr>
                            <tr>
                                <th class="w80">附件</th>
                                <td>
                                    <fieldset class="img_list">
                                        <legend style="color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;">文件列表</legend>
                                        <center>
                                        <div style="color:#666;font-size:12px;margin-bottom: 5px;">
                                        最多
                                        <span style="color:red" id="zh_up_linedoc">10</span>
                                        个文件可以上传
                                        </div>
                                        </center>
                                        <div id="linedoc" class="fileList">
                                        <?php
                                        if (!empty($info['linedoc'])) {
                                            $h='';
                                            $h .= '<ul>';
                                            $file_arr = explode(',', $info['linedoc']);
                                            $id = "img_linedoc";
                                            //p($pic_arr);die;
                                            foreach ($file_arr as $k => $v) {
                                                if (empty($v))
                                                    continue;
                                                $fileinfo_arr = explode('||', $v);
                            					$h .= "<li style='width:45%'>";
                            					$h .= "<img src='http://www.his.com/zh/ZHPHP/zhphp/Extend"   . "/Org/Uploadify/default.png' style='width:50px;height:50px;'/>";
                            					$h .= "<input type='hidden' name='linedoc[path][]'  value='" . $fileinfo_arr[0] . "'/> ";
                            					$h .= "説明：<input type='text' name='linedoc[alt][]' style='width:200px;' value='" . $fileinfo_arr[1] . "'/>";
                            					$h .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                            					$h .= "&nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='remove_upload(this,\"$id\")'>削除</a>";
                            					$h .= "</li>";
                            				}
                                            $h .= '</ul>';
                                            echo $h;
                                        }
                                        
                                        ?>
                                        </div>
                                    </fieldset>
                                    <button class="zh-cancel-small" onclick='file_upload({"id":"linedoc","type":"files","num":"10","name":"linedoc","filetype":"zip,rar,doc,ppt,pdf","dir":"line"});' type="button">文件上传</button> <span class="linedoc validate-message"></span>     
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="tab_seo">
                        <table class="table1">
                            <tr>
                                <th>优化标题：</th>
                                <td>
                                    <input type="text" name="seotitle" value="<?php echo $info['seotitle'];?>" class="w700"/>
                                </td>
                            </tr>
                            <!--
                            <tr>
                                <th>Tag词：</th>
                                <td>
                                    <input type="text" name="tagword" class="w700" value="<?php echo $info['tagword'];?>">
                                </td>
                            </tr>
                            -->
                            <tr>
                                <th>关键词：</th>
                                <td>
                                    <input type="text" name="keyword" value="<?php echo $info['keyword'];?>" class="w700"/>
                                </td>
                            </tr>
                            <tr>
                                <th>页面描述：</th>
                                <td>
                                    <textarea class="set-area wid_695" name="description" cols="" rows=""><?php echo $info['description'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>热门线路：</th>
                                <td>
                                    <input id="hotlines" name="hotlines" style="width:300px" class="" value="<?php echo $info['hotlines'];?>" type="text"/><span id="zh_hotlines"></span>
                                    <button class="zh-cancel-small" type="button"  onclick="select_exterior('line','id','linesn,linename','产品编号,线路名称','','multiple','hotlines');">外部データ選択</button>                    
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br /><br /><br /><br /><br />
            <div class="position-bottom">
                <input type="submit" class="zh-success" value="确认"/>
                <input type="button" class="zh-cancel" onclick="zh_close_window()" value="关闭"/>
                <?php if(isset($_GET['lineid'])){?>
                <a target="_blank" class="btn1" href="/lines/detail/<?php echo $_GET['lineid'];?>.html" style="font-size: 16px;font-weight:bold;" >预览</a>
                <?php }?>
            </div>
        </form>
    </div>
    <script>
    
    window.JSEDITOR=function(edname,edvalue){

                var ue = UE.getEditor(edname,{
                imageUrl:CONTROL+'&lineid=33&m=ueditor_upload&g=Zhcms&water=0&uploadsize=2000000&maximagewidth=false&maximageheight=false'//处理上传脚本
                ,zIndex : 0
                ,autoClearinitialContent:false
                ,initialFrameWidth:"1000" //宽度1000
                ,initialFrameHeight:"300" //宽度1000
                ,autoHeightEnabled:false //是否自动长高,默认true
                ,autoFloatEnabled:false //是否保持toolbar的位置不动,默认true
                ,maximumWords:2000 //允许的最大字符数
                ,readonly : false //编辑器初始化结束后,编辑区域是否是只读的，默认是false
                ,wordCount:true //是否开启字数统计
                ,imagePath:''//图片修正地址
                , toolbars:[
            ['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe','insertcode', 'pagebreak', 'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars',  'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                'print', 'preview', 'searchreplace']
            ]//工具按钮
                , initialStyle:'p{line-height:1em; font-size: 14px; }'
            });
            return ue;
    }
    
     $(document).ready(function(e) {
            
            window.biaozhun=window.JSEDITOR('biaozhun');
            window.simple_jieshao=window.JSEDITOR('simple_jieshao');
            //window.beizu=window.JSEDITOR('beizu');
            window.payment=window.JSEDITOR('payment');
            //window.feeinclude=window.JSEDITOR('feeinclude');
            //window.features=window.JSEDITOR('features');
            window.reserved1=window.JSEDITOR('reserved1');
            //window.reserved2=window.JSEDITOR('reserved2');
            //window.reserved3=window.JSEDITOR('reserved3');
            //window.reserved4=window.JSEDITOR('reserved4');
            //window.shotcontent=window.JSEDITOR('shotcontent');
            
            
                      //颜色选择器
            	  $(".title-color").colorpicker({
                        ishex:true,
                        success:function(o,color){
                            $(o).val(color)
                        },
                        reset:function(o){
            
                        }
                    });  
                        
        })
        
        function beforeJieshao(){
            var days=$("#travel_days").val();
            if(days<=0 || isNaN(days) )
            {
              
            }else{
                var html="";
                var jieshao_num=$(".content-jieshao-detail").find('.add-class').length;
                jieshao_num=!jieshao_num?0:jieshao_num;
                //alert(jieshao_num);
                var jiaotong = '';
                jiaotong+='<span >'+
                                '<input  type="checkbox" name="transport[{day}][]" value="汽车"/>'+
                          '</span>';
                jiaotong+='<label class=" ml-5 mr-20" style="cursor:pointer;">汽车</label>';
                jiaotong+='<span >'+
                                '<input  type="checkbox" name="transport[{day}][]" value="火车">'+
                          '</span>';
                jiaotong+='<label class=" ml-5 mr-20" style="cursor:pointer;">火车</label>';
                jiaotong+='<span >'+
                                '<input  type="checkbox"value="飞机" name="transport[{day}][]">'+
                          '</span>';
                jiaotong+='<label class=" ml-5 mr-20" style="cursor:pointer;">飞机</label>';
                jiaotong+='<span >'+
                                '<input  type="checkbox" name="transport[{day}][]" value="轮船">'+
                          '</span>';
                jiaotong+='<label class=" ml-5 mr-20" style="cursor:pointer;">轮船</label>';
                jiaotong+="<span id=\"addjt_{day}\"></span>"+
                          "<img class='addimg' data-contain='addjt_{day}' data-day='{day}' style=\"line-height: 30px;vertical-align: middle;cursor: pointer\"  src=\"http://www.his.com/Static/tour/images/tianjia.png\">";
                
                var imageup='';
                imageup+='<fieldset class="img_list">';
                    imageup+='<legend style="color:#666;font-size: 12px;line-height: 25px;padding: 0px 10px; text-align:center;margin: 0px;">图片列表</legend>';
                    imageup+='<center>';
                        imageup+='<div style="color:#666;font-size:12px;margin-bottom: 5px;">';
                        imageup+='最多';
                        imageup+='<span style="color:red" id="zh_up_img_timg{day}">10</span>';
                        imageup+='张图片可以上传';
                        imageup+='</div>';
                    imageup+='</center>';
                    imageup+='<div id="img_timg{day}" class="fileList">';
                    imageup+='</div>';
                imageup+='</fieldset>';
                imageup+='<button class="zh-cancel-small" onclick=\'file_upload({"id":"img_timg{day}","type":"images","num":"10","name":"timg{day}","filetype":"jpg,png,gif,jpeg","upload_img_max_width":"596","upload_img_max_height":"370","thumb_type":"5","dir":"line","thumb_size":"596*370"})\' type="button">图片上传</button> <span class="timg{day} validate-message"></span>     ';
                imageup+='<span style="color:red">请上传596*370或等比例图片</span>';
                
                var day_content='<div class="add-class">';
					   day_content+='<dl>';
					       day_content+='<dt>第{day}天：</dt>';
	                       day_content+='<dd><input type="text" name="jieshaotitle[{day}]" class="set-text-xh text_700 mt-2"/></dd>';
					   day_content+='</dl>';
					   day_content+='<dl class="jieshao-diner">';
	                       day_content+='<dt>用餐情况：</dt>';
					       day_content+='<dd>';
                                day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="breakfirsthas[{day}]" value="1"></span>';
            					day_content+='<label style="float:left;cursor:pointer;">早餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="breakfirst[{day}]"/></span>';
            					day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="lunchhas[{day}]" value="1"></span>';
            					day_content+='<label style="float:left;cursor:pointer;">午餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text" name="lunch[{day}]" value=""/></span>';
            					day_content+='<span class="fl"><input class="mt-8 mr-3 fl" type="checkbox" name="supperhas[{day}]" value="1"></span>';
            					day_content+='<label style="float:left;cursor:pointer;">晚餐</label><span class="fl"><input class="set-text-xh text_177 ml-5 mr-10" type="text"name="supper[{day}]"/></span>';
					       day_content+='</dd>';
					   day_content+='</dl>';
					   day_content+='<dl>';
					       day_content+='<dt>住宿情况：</dt>';
					       day_content+='<dd><input type="text" class="set-text-xh text_222 mt-2" name="hotel[{day}]"></dd>';
					   day_content+='</dl>';
					   day_content+='<dl   style="display: none;">';
					       day_content+='<dt>交通工具：</dt>';
	                       day_content+='<dd >';
	                           day_content+=jiaotong;
					       day_content+='</dd>';
					   day_content+='</dl>';
                       day_content+='<dl>';
					       day_content+='<dt>行程内容：</dt>';
					       day_content+='<dd><textarea name="tjieshao[{day}]" style="width:800px;height:100px;resize:both;" ></textarea></dd>';
					   day_content+='</dl>';
                       day_content+='<dl>';
					       day_content+='<dt>模板用图片：</dt>';
	                       day_content+='<dd>';
                                day_content+=imageup;
					       day_content+='</dd>';
					   day_content+='</dl>';
					   day_content+='<div class="xc-con">';
					       day_content+='<h4>自由编辑：</h4>';
					       day_content+='<div><textarea name="txtjieshao[{day}]" style=" float:left" id="line_content_{day}"></textarea></div>';;
					   day_content+='</div><br/><br/>';
				    day_content+='</div>';
               /* var day_content='<table class="table1 add-class">';
					   day_content+='<tr>';
					       day_content+='<th>第{day}天：</th>';
	                       day_content+='<td><input type="text" name="jieshaotitle[{day}]" class="w700"/></td>';
					   day_content+='</tr>';
					   day_content+='<tr class="jieshao-diner">';
	                       day_content+='<th>用餐情况：</th>';
					       day_content+='<td>';
                                day_content+='<span class=""><input class=" mr-3 " type="checkbox" name="breakfirsthas[{day}]" value="1"></span>';
            					day_content+='<label style="cursor:pointer;">早餐</label><span class=""><input class="w200" type="text" name="breakfirst[{day}]"/></span>';
            					day_content+='<span class=""><input class=" mr-3 " type="checkbox" name="lunchhas[{day}]" value="1"></span>';
            					day_content+='<label style="cursor:pointer;">午餐</label><span class=""><input class="w200" type="text" name="lunch[{day}]" value=""/></span>';
            					day_content+='<span class=""><input class=" mr-3 " type="checkbox" name="supperhas[{day}]" value="1"></span>';
            					day_content+='<label style="cursor:pointer;">晚餐</label><span class=""><input class="w200" type="text"name="supper[{day}]"/></span>';
					       day_content+='</td>';
					   day_content+='</tr>';
					   day_content+='<tr>';
					       day_content+='<th>住宿情况：</th>';
					       day_content+='<td><input type="text" class="w300" name="hotel[{day}]"></td>';
					   day_content+='</tr>';
					   day_content+='<tr>';
					       day_content+='<th>交通工具：</th>';
	                       day_content+='<td>';
	                           day_content+=jiaotong;
					       day_content+='</td>';
					   day_content+='</tr>';
					   day_content+='<tr class="xc-con">';
					       day_content+='<th>行程内容：</th>';
					       day_content+='<td><textarea name="txtjieshao[{day}]" style=" float:left" id="line_content_{day}"></textarea></td>';;
					   day_content+='</tr>';
				    day_content+='</table>';*/
                if(jieshao_num<days)
                {
                   for(var i=jieshao_num+1;i<=days;i++)
                   {
                     html+=day_content.replace(/\{day\}/g,i);
                   }
                   $(".content-jieshao-detail").append(html);
                }else if(jieshao_num>days)
                {
                    $dayInputs=$(".content-jieshao-detail").find('.add-class');
                    $dayInputs.each(function(i){
                        if(((i+1))>days){
                            $dayInputs[i].remove();
                        }
                        //alert(i);
                     });
                    /*alert($(".content-jieshao-detail").find('.add-class').length);
                    alert(days);
                   $(".content-jieshao-detail").find('.add-class').gt(days-1).remove();*/
                }
                for(var i=1;i<=days;i++)
                {
                    window['line_content_'+i]=window.JSEDITOR('line_content_'+i);
                }
                addJiaoTong2();
            }
            
        }
        
        
        function afterTabClick(id){
            if(id=='tab_jieshao'){
                var days=$("#travel_days").val();
                if(days<=0 || isNaN(days) )
                {
                    ST.Util.showMsg("请先填写旅游天数,输入数字",1,1500);
                    $("#travel_days").css("border","1px solid red");
                    $("li[lab='tab_basic']").trigger("click");
                }
            }
        }
                     
                     
        //添加交通
        function addJiaoTong()
        {
            var myDate = new Date();
            var mid = "jt_"+myDate.getMilliseconds();//毫秒数
            var html = "<input name=\"transport_pub[]\" type=\"checkbox\" class=\"checkbox\" id=\""+mid+"\" value=\"\">&nbsp;"+
                        "<label for=\"Transport\">"+
                            "<input type=\"text\" class=\"uservalue\" data-value=\""+mid+"\" style=\"width:70px;border-left:none;border-right:none;border-top:none\"  value=\"\">"+
                        "</label>";
            $("#addjt").append(html);
        
            $('.uservalue').unbind('input propertychange').bind('input propertychange', function() {
                var datacontain = $(this).attr('data-value');
                $('#'+datacontain).val($(this).val());
            });
        }
        
        //添加交通
        function addMagrecommend()
        {
            var myDate = new Date();
            var mid = "mr_"+myDate.getMilliseconds();//毫秒数
            var html = "<input name=\"magrecommend_pub[]\" type=\"checkbox\" class=\"checkbox\" id=\""+mid+"\" value=\"\">&nbsp;"+
                        "<label for=\"Magrecommend\">"+
                            "<input type=\"text\" class=\"uservalue\" data-value=\""+mid+"\" style=\"width:70px;border-left:none;border-right:none;border-top:none\"  value=\"\">"+
                        "</label>";
            $("#addmr").append(html);
        
            $('.uservalue').unbind('input propertychange').bind('input propertychange', function() {
                var datacontain = $(this).attr('data-value');
                $('#'+datacontain).val($(this).val());
            });
        }
        
        
        function togStyle(dom,num)
        {
            $("#line_isstyle").val(num);
            $(dom).addClass('on');
            $(dom).siblings().removeClass('on');
        
            if(num==1)
            {
              $(".content-jieshao-detail").hide();
              $(".content-jieshao-simple").show();
              
              $(".content-biaozhun-detail").hide();
              $(".content-biaozhun-simple").show();
            }
            else
            {
                $(".content-jieshao-detail").show();
                $(".content-jieshao-simple").hide();
                
                $(".content-biaozhun-detail").show();
                $(".content-biaozhun-simple").hide();
            }
        }
        
        
        function togStyle2(dom,num)
        {
            $("#biaozhun_isstyle").val(num);
            $(dom).addClass('on');
            $(dom).siblings().removeClass('on');
        
            if(num==1)
            {              
              $(".content-biaozhun-detail").hide();
              $(".content-biaozhun-simple").show();
            }
            else
            {                
                $(".content-biaozhun-detail").show();
                $(".content-biaozhun-simple").hide();
            }
        }
        
        function addJiaoTong2()
        {
            $(".addimg").unbind('click').click(function(){
                var day = $(this).attr('data-day');
                var datacontain = $(this).attr('data-contain');
        
                var myDate = new Date();
                var mid = "jt_" + myDate.getMilliseconds();//毫秒数
                var html = "<input  class=\"mt-8\" type=\"checkbox\"  name=\"transport["+day+"][]\" id=\""+mid+"\" value=\"\"/>&nbsp;"+
                            "<label class=\"ml-5 mr-20\" style=\"cursor:pointer;\">"+
                                "<input type=\"text\" class=\"day_uservalue\" data-value=\"" + mid + "\" style=\"width:70px;border-left:none;border-right:none;border-top:none\"  value=\"\">"+
                            "</label>";
        
        
                $("#"+datacontain).append(html);
        
                $('.day_uservalue').unbind('input propertychange').bind('input propertychange', function () {
                    var datacontain = $(this).attr('data-value');
                    $('#' + datacontain).val($(this).val());
                });
        
            })
        }
        
        $(function(){
            
            /* 航班信息增加 */
            $(".biaozhunadd").click(function(){
                var num = $(".biaozhuninfo").length+1;
                var $out='';
                $out = '<tr class="biaozhuninfo">';
                $out +=      '<th class="w80"><input name="biaozhuninfo'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhuncompany'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhunnum'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhunstartairport'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhunstarttime'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhunendairport'+num+'" value="" /></th>';
                $out +=      '<th><input name="biaozhunendtime'+num+'" value="" /></th>';
                $out += '</tr>';
                $("#biaozhuninfo").append($out);
                $("#biaozhuncount").val(num);
            })
            
            /* 航班信息减少 */
            $(".biaozhundel").click(function(){
                var num = $(".biaozhuninfo").length-1;
                $(".biaozhuninfo").last().remove();
                $("#biaozhuncount").val(num);
            })
            
        })
        
        
    </script>
</body>
</html>