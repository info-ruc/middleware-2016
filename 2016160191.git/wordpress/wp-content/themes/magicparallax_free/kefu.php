<?php
if(!get_option('mytheme_kefu_on')){
 ?>


<div class="kefu">
   <div class="kefu_d" id="tops"> <a href="#"></a></div>
  
   
      <a class="kefu_d" id="weixin" href="tel:<?php echo get_option('mytheme_tell'); ?>"></a>
 

  
 
   
      <a class="kefu_d" id="kefu_severs" href="Mailto:<?php echo get_option('mytheme_mail'); ?>"></a>
         
 
 
   <div class="kefu_d"  id="shoucang"></div>
   
   <div class="kefu_d" id="homes"></div>


<?php }else{?>
<div class="kefu">
   <div class="kefu_d" id="tops"> <a href="#"></a></div>
  <?php if(get_option('mytheme_kefu_weixin') !==""){ ?>
   <div class="kefu_d" id="weixin">
      <div><img src="<?php echo get_option('mytheme_kefu_weixin'); ?>" /></div>
   </div>
  <?php }; ?>
  
   <?php $qq_tu=get_option('mytheme_qq_tu');if(get_option('mytheme_kefu_qq') !==""){ ?>
   <div class="kefu_d" id="kefu_severs">
       <div class="qq_kefu">
       <img src="<?php if($qq_tu==""){ echo get_bloginfo('template_url').'/images/kf.jpg';}else{echo $qq_tu; } ?>" />
       <p><?php echo get_option('mytheme_tell'); ?></p>
       <p><?php echo  get_option('mytheme_mail'); ?></p>
      <?php echo stripslashes(get_option('mytheme_kefu_qq')); ?>
       </div>
         
   </div>
   <?php }; ?>
  
   
   <div class="kefu_d" id="homes"><a ></a></div>


</div> <?php }; ?>