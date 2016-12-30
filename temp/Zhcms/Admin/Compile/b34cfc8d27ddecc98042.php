<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if($type == 'weblist'){?>
<!--站点选择弹出框-->
<div class="change-box-more" id="weblist_detail">
    <div class="level web_list">
        <a href="javascript:;" class="cur" onclick="CHOOSE.changeWeb(this,-1,'全部','<?php echo $resultid;?>')">全部</a>
        <?php if(is_array($weblist)):?><?php $index=0; ?><?php  foreach($weblist as $v){ ?>
            <a href="javascript:;" onclick="CHOOSE.changeWeb(this,<?php echo $v['id'];?>,'<?php echo $v['webname'];?>','<?php echo $resultid;?>')" >
                <?php echo $v['webname'];?>
            </a>
        <?php $index++; ?><?php }?><?php endif;?>
    </div>
</div>
<?php }?>

<?php if($type == 'startplace'){?>
<!--出发地选择弹出框-->
<div class="change-box-more" id="startplace_detail">
    <div class="level">
        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeStartPlace(this,0,'全部','<?php echo $resultid;?>',1)">全部</a>
        <?php if(is_array($startplace)):?><?php $index=0; ?><?php  foreach($startplace as $v){ ?>
            <a href="javascript:;" data-level="1" onclick="CHOOSE.changeStartPlace(this,<?php echo $v['id'];?>,'<?php echo $v['cityname'];?>','<?php echo $resultid;?>',0)" ><?php echo $v['cityname'];?></a>
        <?php $index++; ?><?php }?><?php endif;?>
    </div>
</div>
<?php }?>


<?php if($type == 'destlist'){?>
<!--目的地选择弹出框-->
<div class="change-box-more" id="destlist_detail">
    <div class="level">
        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeDestId(this,0,'全部','<?php echo $resultid;?>',1)">全部</a>
        <?php if(is_array($destlist)):?><?php $index=0; ?><?php  foreach($destlist as $v){ ?>
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeDestId(this,<?php echo $v['id'];?>,'<?php echo $v['kindname'];?>','<?php echo $resultid;?>',0)" ><?php echo $v['kindname'];?></a>
        <?php $index++; ?><?php }?><?php endif;?>
    </div>
</div>
<?php }?>


<?php if($type == 'attrlist'){?>
<!--属性选择弹出框-->
<div class="change-box-more" id="attrlist_detail">
    <input type="hidden" id="typeid" value="<?php echo $typeid;?>"/>
    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeAttrId(this,0,'全部','<?php echo $resultid;?>',1)">全部</a>
        <?php if(is_array($attrlist)):?><?php $index=0; ?><?php  foreach($attrlist as $v){ ?>
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeAttrId(this,<?php echo $v['id'];?>,'(<?php echo $weblist[$v['webid']];?>)<?php echo $v['attrname'];?>','<?php echo $resultid;?>',0)" >(<?php echo $weblist[$v['webid']];?>)<?php echo $v['attrname'];?></a>
        <?php $index++; ?><?php }?><?php endif;?>
    </div>

</div>
<?php }?>