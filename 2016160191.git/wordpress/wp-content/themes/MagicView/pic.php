  <?php               $picss=get_option('mytheme_picss'); 
                     $pic1=get_option('mytheme_pic1'); 
					 $pic_content1=get_option('mytheme_pic_content1'); 
					 $pic_link1=get_option('mytheme_pic_link1'); 
					 $pic_tagets1=get_option('mytheme_pic_taget1');  
					 if($pic_tagets1==="1"){$pic_taget1='target="_blank"';}elseif($pic_tagets1==="2"){$pic_taget1='rel="nofollow" target="_blank"';}

					  $pic2=get_option('mytheme_pic2'); 
					 $pic_content2=get_option('mytheme_pic_content2'); 
					 $pic_link2=get_option('mytheme_pic_link2'); 
					 $pic_tagets2=get_option('mytheme_pic_taget2'); 
                        if($pic_tagets2==="1"){$pic_taget2='target="_blank"';}elseif($pic_tagets2==="2"){$pic_taget2='rel="nofollow" target="_blank"';}
					  $pic3=get_option('mytheme_pic3'); 
					 $pic_content3=get_option('mytheme_pic_content3'); 
					 $pic_link3=get_option('mytheme_pic_link3'); 
					 $pic_tagets3=get_option('mytheme_pic_taget3'); 
                    if($pic_tagets3==="1"){$pic_taget3='target="_blank"';}elseif($pic_tagets3==="2"){$pic_taget3='rel="nofollow" target="_blank"';}
					  $pic4=get_option('mytheme_pic4'); 
					 $pic_content4=get_option('mytheme_pic_content4'); 
					 $pic_link4=get_option('mytheme_pic_link4'); 
					 $pic_tagets4=get_option('mytheme_pic_taget4');
		         	 if($pic_tagets4==="1"){$pic_taget4='target="_blank"';}elseif($pic_tagets4==="2"){$pic_taget4='rel="nofollow" target="_blank"';}		  
					 $detect = new Mobile_Detect();
				     if($detect->isMobile()){$pic_hight='auto';}else	{if($picss){$pic_hight=$picss."px";}else{$pic_hight='400px';}}
					 $pic_move1=get_option('mytheme_pic_move1');
					 $pic_move2=get_option('mytheme_pic_move2');
					 $pic_move3=get_option('mytheme_pic_move3');
					 $pic_move4=get_option('mytheme_pic_move4');
					 
					  
					  
					
					 ?>
  <?php if($pic1||$pic2||$pic3||$pic4){ ?>                   
                     
<div id="photo_full" style="height:<?php echo $pic_hight; ?>;">

<div id="photo_full_in">
 <ul class="slides">                                     
<?php if ($pic1 !=""){ ?>			   
    <li><a  href="<?php  echo $pic_link1?>"<?php echo $pic_taget1; if(!$detect->isMobile()){?> style="height:<?php echo $pic_hight; ?>; background: center url(<?php echo  $pic1;?>)" <?php } ?>title="<?php echo  $pic_content1;?>" >
    <?php   if($detect->isMobile()){ echo '<img src="'.$pic_move1.'" alt="'.$pic_content1.'" />';}?>
     </a>
     </li>
  <?php }; ?>     
  <?php if ($pic2 !=""){ ?>			   
    <li><a href="<?php  echo $pic_link2?>"<?php echo $pic_taget2; if(!$detect->isMobile()){?> style="height:<?php echo $pic_hight; ?>; background: center url(<?php echo  $pic2;?>)" <?php } ?> title="<?php echo  $pic_content2;?>" >  
     <?php   if($detect->isMobile()){ echo '<img src="'.$pic_move2.'" alt="'.$pic_content2.'" />';}?>
    </a></li>
  <?php }; ?>         
 <?php if ($pic3 !=""){ ?>			   
   <li><a href="<?php  echo $pic_link3?>"<?php echo $pic_taget3; if(!$detect->isMobile()){?> style="height:<?php echo $pic_hight; ?>; background: center url(<?php echo  $pic3;?>)" <?php } ?>title="<?php echo  $pic_content3;?>" >
    <?php   if($detect->isMobile()){ echo '<img src="'.$pic_move3.'" alt="'.$pic_content3.'" />';}?>
     </a></li>
  <?php }; ?>                                            
  <?php if ($pic4 !=""){ ?>			   
    <li><a href="<?php  echo $pic_link4?>" <?php echo $pic_taget4; if(!$detect->isMobile()){?> style="height:<?php echo $pic_hight; ?>; background: center url(<?php echo  $pic4;?>)" <?php } ?>title="<?php echo  $pic_content4;?>" >
    
     <?php   if($detect->isMobile()){ echo '<img src="'.$pic_move4.'" alt="'.$pic_content4.'" />';}?>
    </a></li>
  <?php }; ?>                   
 </ul>
<?php if ($pic1&&$pic2){ ?>

<script>
$(function() {
      $('#photo_full_in').flexslider({
                animation: "slide",
				controlNav:false,
				slideToStart: 0,
				easing:'easeOutExpo',
				animationSpeed:1500,
				animationLoop: true,
				itemWidth:1000,
                itemMargin: 0,
				  minItems:1,
                 maxItems:1,
				 move:1,
				slideshowSpeed:5000   
         
            });
});	
</script>
  <?php }; ?>     
</div>
</div>
  <?php }; ?>   
