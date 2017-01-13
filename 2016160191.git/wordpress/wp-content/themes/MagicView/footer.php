<?php


 $footer_b=get_option('mytheme_footer_b');
if($footer_b){ $footer_bs='style="background:url('.$footer_b.')"';}
 $footer_d=get_option('mytheme_footer_d');
if($footer_d){ $footer_ds='style="background:url('.$footer_d.')"';}
$word_t2=get_option('mytheme_word_t2');
         $themepark= get_option('mytheme_themepark');
         $icp_b=get_option('mytheme_icp_b');
		
 ?>
<div class="footer"<?php echo $footer_bs;?>>
 
 <div class="footer_in">
 

  <div id="footer_in_box" class="footer_in_box demor footer_about">
 <?php if(get_option('mytheme_footer_box2_pic')){$footer_box2_pic=get_option('mytheme_footer_box2_pic');}else{$footer_box2_pic=get_bloginfo('template_url').'/images/logo_footer.png';};?>
 
   <a target="_blank" href="<?php echo get_option('mytheme_footer_box2_link') ?>" class="about_pic"><img src="<?php echo $footer_box2_pic;?>"  <?php echo 'alt="'.get_option('mytheme_footer_box2_title').'"'; ?>/></a>
   
   <p class="about_text"><?php if(get_option('mytheme_footer_box2_text')){echo get_option('mytheme_footer_box2_text');}else{echo 'WEB主题公园是秉自长沙特锐文化传播有限公司，我们的团队倾力打造的一个以网页模板，网页主题为核心的商务平台。我们有着经验丰富，而且成熟的团队，我们专注于开发视觉精美，功能完善的原创中文网站主题和网站模板。';} ?></p>
   
  </div>

 
 

  <div id="footer_in_box" class="footer_in_box footer_contact">
    <b> <font><?php if(get_option('mytheme_footer_box3_title2')){ echo get_option('mytheme_footer_box3_title2');}else{echo'follow us From at social media';} ?></font>
	   <?php if(get_option('mytheme_footer_box3_title')){ echo get_option('mytheme_footer_box3_title');}else{echo'从社交媒体上关注我们';} ?>
    </b>
     <?php if(get_option('mytheme_footer_box3_pic')){$footer_box3_pic=get_option('mytheme_footer_box3_pic');}else{$footer_box3_pic=get_bloginfo('template_url').'/images/two-dimensional.jpg';};?>
   <a target="_blank" href="<?php echo get_option('mytheme_footer_box3_link'); ?>" class="about_pic"><img src="<?php echo $footer_box3_pic;?>"  alt="<?php echo get_option('mytheme_footer_box3_title') ?>"/></a>
   <p class="about_text"><?php if(get_option('mytheme_footer_box3_text')){echo get_option('mytheme_footer_box3_text');}else{echo '关注官方二维码、掌握更多最新实时消息<br />也可以通过以下方式关注我们';}; ?></p>
   <p class="about_text">
   <?php             $Socialmedia1=get_option('mytheme_Socialmedia1'); 
					 $Socialmedia2=get_option('mytheme_Socialmedia2'); 
					 $Socialmedia3=get_option('mytheme_Socialmedia3'); 
					 $Socialmedia4=get_option('mytheme_Socialmedia4'); 
					 
					 $Socialmedia_link1=get_option('mytheme_Socialmedia_link1'); 
					 $Socialmedia_link2=get_option('mytheme_Socialmedia_link2'); 
					 $Socialmedia_link3=get_option('mytheme_Socialmedia_link3'); 
					 $Socialmedia_link4=get_option('mytheme_Socialmedia_link4');  ?>
   
     <?php if($Socialmedia1!=1){ ?> <a href="<?php echo $Socialmedia_link1; ?>"><img src="<?php if($Socialmedia1){echo $Socialmedia1;}else{echo get_bloginfo('template_url').'/images/taobao.png';}; ?>" /></a><?php } ?>
     
      <?php if($Socialmedia2!=1){ ?> <a href="<?php echo $Socialmedia_link2; ?>"><img src="<?php if($Socialmedia2){echo $Socialmedia2;}else{echo get_bloginfo('template_url').'/images/weibo.png';}; ?>" /></a><?php } ?>
      
       <?php if($Socialmedia3!=1){ ?> <a href="<?php echo $Socialmedia_link3; ?>"><img src="<?php if($Socialmedia3){echo $Socialmedia3;}else{echo get_bloginfo('template_url').'/images/tengxunweibo.png';}; ?>" /></a><?php } ?>
       
        <?php if($Socialmedia4!=1){ ?> <a href="<?php echo $Socialmedia_link4; ?>"><img src="<?php if($Socialmedia4){echo $Socialmedia4;}else{echo get_bloginfo('template_url').'/images/baidu.png';}; ?>" /></a><?php } ?>
    
   </p>
  </div>

 
 

 <div id="footer_in_box" class="footer_in_box footer_linkss">
     <b> <font><?php if(get_option('mytheme_footer_box1_title2')){echo get_option('mytheme_footer_box1_title2');}else{echo 'contact us';}; ?></font>
	    <?php if(get_option('mytheme_footer_box1_title')){echo get_option('mytheme_footer_box1_title');}else{echo '联系我们';}; ?>
    </b>
     <?php 
	 if(get_option('mytheme_footer_box1_text')){
	         $contact_text= split("\n",get_option('mytheme_footer_box1_text')); 
			 for($i=0;$i<count($contact_text);$i++) {
				 echo'<p class="contact_text_p">'.$contact_text[$i].'</p>';
				 
				 } }else{echo '<p class="contact_text_p">联系电话:0731 -8578 ****  / 0731-8578 **** </p><p class="contact_text_p">联系邮箱：themepark.com.cn</p><p class="contact_text_p"> 联系邮箱：湖南省长沙市雨花区芙蓉中路296号交通大厦A座2902号</p>';} 
	 
	 ?>
   
 </div>

   <div  id="footer_bottom_link" class="footer_in">
        <?php ob_start(); wp_nav_menu(array( 'theme_location'  => "footer-menu" ,'menu_class'=> 'footer_bottom_link','container' => false  ) ); ?>
      
     
     <p> <?php  if($word_t2!=""){echo $word_t2;}else{echo '版权所有';}  ?> &copy;<?php echo date("Y"); echo " "; bloginfo('name'); 
		   if($icp_b !=="") {echo ' |   <a rel="nofollow" target="_blank" href="http://www.miitbeian.gov.cn/">'.$icp_b.'</a>'; };
		   if($themepark =="") {echo ' |  技术支持： <a target="_blank" href="http://www.themepark.com.cn">WEB主题公园</a>'; }
		   else if($themepark =="en") {echo ' |  Theme by ： <a target="_blank" href="http://www.themepark.com.cn">themepark</a>'; }
		    echo ' |  '.stripslashes(get_option('mytheme_analytics')); ?> </p>
     </div>
  
   
 </div>
 <div class="footer_bottom" <?php echo $footer_ds;?>>
 
  <div class="footer_in">
 
   <p><?php if(get_option('mytheme_footer_sm_text')){echo get_option('mytheme_footer_sm_text');}else{ echo '特别申明：本站所有演示主题上的演示图片均来源于网络，并仅用户主题的演示功能，如果侵犯到您的权利，请联系我们删除，本站演示中所有数据均为虚构，请勿当成实际价格、资料使用。';}; ?></p>
   <?php ob_start(); wp_nav_menu(array( 'theme_location'  => "link-menu2" ,'menu_class'=> 'footer_bottom_link','container' => false  ) ); ?>
   </div>
</div>



</div>


	<?php get_template_part( 'kefu' );   wp_footer(); ?>
   <!--<?php echo get_num_queries() . ' queries in ' . timer_stop(0) . ' seconds.'; ?>-->	
</html>
