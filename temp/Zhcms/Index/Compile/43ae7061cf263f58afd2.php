<?php if(!defined("ZHPHP_PATH"))exit;C("SHOW_NOTICE",FALSE);?><?php if(count($rightBanner1) !='0'||count($rightBanner2) !='0'){?>
<dl class="aside_adv">


    <?php if(is_array($rightBanner2)):?><?php $index=0; ?><?php  foreach($rightBanner2 as $rb2){ ?>
        <dd>
        <?php if($rb2['url']){?>
            <?php if($rb2['new_window'] == 1){?>
                <a target="_blank" href="<?php echo $rb2['url'];?>">
            <?php  }else{ ?>
                <a href="<?php echo $rb2['url'];?>">
            <?php }?>
            <img src="http://www.his.com/<?php echo $rb2['main_image'];?>" width="240" alt=""/></a>
        <?php  }else{ ?>
         	<img src="http://www.his.com/<?php echo $rb2['main_image'];?>" width="240" alt=""/>
        <?php }?>
        </dd>
    <?php $index++; ?><?php }?><?php endif;?>
</dl>
<?php }?>

<?php if(count($rightBanner3) !='0'){?>
<dl class="aside_adv">
	<dt>
		<span>HIS提供的链接</span>
	</dt>
    <?php if(is_array($rightBanner3)):?><?php $index=0; ?><?php  foreach($rightBanner3 as $rb3){ ?>
        <dd>
        <?php if($rb3['url']){?>
            <?php if($rb3['new_window'] == 1){?>
                <a target="_blank" href="<?php echo $rb3['url'];?>">
            <?php  }else{ ?>
                <a href="<?php echo $rb3['url'];?>">
            <?php }?>
            <img src="http://www.his.com/<?php echo $rb3['main_image'];?>" width="240" alt=""/></a>
        <?php  }else{ ?>
        	<img src="http://www.his.com/<?php echo $rb3['main_image'];?>" width="240" alt=""/>
        <?php }?>
        </dd>
    <?php $index++; ?><?php }?><?php endif;?>
</dl>
<?php }?>