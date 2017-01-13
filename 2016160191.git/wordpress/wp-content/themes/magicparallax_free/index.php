<?php get_header();?>
<div class="full">

    <div class="index_swipers swiper-container"<?php echo $pic_hieght_ss; ?>>
         <div class="swiper-wrapper">
	<?php 	   dynamic_sidebar('sidebar-widgets');  ?>	

         </div>
          <div class="pagination index_p"></div>
        
    </div>
    
<?php  get_template_part( 'post_from' ); ?>
</div>
    <?php  get_template_part( 'script' ); ?>
	
	<div class="index_content donghuaopen">
<?php	dynamic_sidebar('index_content');?>
    
  </div>
    



<?php 


 get_footer(); ?>
