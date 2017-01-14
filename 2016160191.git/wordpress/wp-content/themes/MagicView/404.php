<?php get_header();?>

<div id="page_top" <?php if(get_option('mytheme_top_pic')!=""){ echo 'style="background:url('.get_option('mytheme_top_pic').')"';} ?> >

<div class="page_top_in">
  <?php     $post_data = get_post($post->ID, ARRAY_A);
			$slug = $post_data['post_name'];
			
			 ?>         
<h3> 404</h3>
 
</div>


</div>

<div id="page_muen_nav">  <b><?php if(get_option('mytheme_word_t11')==""){echo '您现在所在的位置';}else{ echo  get_option('mytheme_word_t11');}; ?></b><?php if( is_front_page() || is_home()) {echo "<a>首页</a>";}else{if (function_exists('get_breadcrumbs')){get_breadcrumbs();}}?></div>


<div id="content">
<div class="left_mian" id="left_mian" <?php if($left_right){echo 'style="float: right;"';} ?>><?php get_template_part( 'sidebar2' ); ?></div>
<div class="right_mian" <?php if($left_right){echo 'style="float: left;"';} if($detect->isMobile()){echo 'id="move_full"';} ?>>



  
 <div class="title_page"><h1>404</h1></div>




  <div class="enter">
  
<p><br />
<br />
<br />
<br />
<?php $word_t10=get_option('mytheme_word_t10'); if($word_t10!=""){echo $word_t10;}else{echo '很遗憾，没有找到你要的信息';}  ?><br />
<br />
<br />
<br />
<br />
</p>
  
  <?php wp_link_pages('before=<div class="pager">&after=</div>'); ?>
  

  





<div id="respond">
 <?php if ( comments_open() ){ comments_template();} ?>
</div>
</div>
</div>
</div>

<?php  get_footer(); ?>
