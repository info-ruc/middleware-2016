<div class="relevat_div" id="left_mian">
<b class="relevat_title"><?php $word_t44=get_option('mytheme_word_t44'); if($word_t44!=""){echo $word_t44;}else{echo '相关推荐';}  ?></b>

   <div class="case_in">
         <ul class="slides">
<?php
$detect = new Mobile_Detect();
$post_num =6;
$exclude_id = $post->ID;
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
	$tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
	$args = array(
		'post_status' => 'publish',
		'tag__in' => explode(',', $tags),
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'rand',
		'posts_per_page' => $post_num,
	);
	query_posts($args);
	while( have_posts() ) { the_post(); 
	
	
	?>
    	  <?php 
		   $tit= get_the_title();
		    $id =get_the_ID();
		   $linkss=get_post_meta($id,"hoturl", true); 
		    if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();};
		    
			
		 ?>
              <?php 
		   $tit= get_the_title();
		    $id =get_the_ID(); 
		   $linkss=get_post_meta($id,"hoturl", true); 
		    if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();};
		    $target =get_post_meta($id,"hots_tlye", true);
			 $word_t1=get_option('mytheme_word_t1');
			   $price = get_post_meta($id, 'shop_price', true);
          	$original_price=get_post_meta($id,"original_price", true);
		 ?>
          
          
       <?php 
		   $id=get_the_ID(); 
  $tit= get_the_title($id);
  $linkss=get_post_meta($id,"hoturl", true); 
    $price = get_post_meta($id, 'shop_price', true);
    $original_price=get_post_meta($id,"original_price", true);
		 ?>
          
    <li class="slider">
             <a  <?php echo $tagerts ?> title="<?php the_title(); ?>" href="<?php if($linkss !=""){echo $linkss;}else{echo get_permalink();}; ?>" class="case_pic">
             
            <?php  if (has_post_thumbnail()) { the_post_thumbnail('case' ,array('alt'	=>$tit, 'title'=> $tit ));}
		   else{echo '<img src="'. get_bloginfo('template_url').'/images/demo/vedio.gif" />';} ?>
          
          </a>
             <b><a  <?php echo $tagerts ?> title="<?php the_title(); ?>" href="<?php if($linkss !=""){echo $linkss;}else{echo get_permalink();}; ?>" ><?php  echo mb_strimwidth(strip_tags(apply_filters('the_title', $tit)),  0,30,"...",'utf8'); ?></a></b>
            
            <?php if($price!=""){?>
             <em class="price">售价：￥<?php echo $price; ?></em>
              <?php  if (function_exists( 'shop_comment_number' )|| function_exists( 'shop_comment_stars' ) ) {?>
               <div class="pj_case"> 
              <?php if(shop_comment_stars() =='0'){echo '<a>暂无评分</a>';}else{?>
               <div class="star" id="stars_<?php echo shop_comment_stars()?>"> </div> 
               <?php } ?>
               
               <a><?php echo shop_comment_number();?>评价</a></div>
               
            <?php } }else{?>
             <p> <?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,80,"...",'utf-8'); ?></p>
            <?php } ?>
            
             </li>

  
             
           
	<?php
		$exclude_id .= ',' . $post->ID; $i ++;
	} wp_reset_query();
}
if ( $i < $post_num ) {
	$cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
	$args = array(
		'category__in' => explode(',', $cats),
		'post__not_in' => explode(',', $exclude_id),
		'caller_get_posts' => 1,
		'orderby' => 'rand',
		'posts_per_page' => $post_num - $i
	);
	query_posts($args);
	while( have_posts() ) { the_post(); 
	
		$id =get_the_ID(); 
	$author_id=get_the_author_meta( 'ID' );
	$bbs_post_avatar=get_option('bbs_post_avatar');
	
	?>
		    <?php 
		   $tit= get_the_title();
		    $id =get_the_ID();
		   $linkss=get_post_meta($id,"hoturl", true); 
		    if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();};
		    $target =get_post_meta($id,"hots_tlye", true);
			
		 ?>
       <?php 
		   $id=get_the_ID(); 
  $tit= get_the_title($id);
  $linkss=get_post_meta($id,"hoturl", true); 
    $price = get_post_meta($id, 'shop_price', true);
    $original_price=get_post_meta($id,"original_price", true);
		 ?>
          
    <li class="slider">
             <a  <?php echo $tagerts ?> title="<?php the_title(); ?>" href="<?php if($linkss !=""){echo $linkss;}else{echo get_permalink();}; ?>" class="case_pic">
             
            <?php  if (has_post_thumbnail()) { the_post_thumbnail('case' ,array('alt'	=>$tit, 'title'=> $tit ));}
		   else{echo '<img src="'. get_bloginfo('template_url').'/images/demo/vedio.gif" />';} ?>
          
          </a>
             <b><a  <?php echo $tagerts ?> title="<?php the_title(); ?>" href="<?php if($linkss !=""){echo $linkss;}else{echo get_permalink();}; ?>" ><?php  echo mb_strimwidth(strip_tags(apply_filters('the_title', $tit)),  0,30,"...",'utf8'); ?></a></b>
            
            <?php if($price!=""){?>
             <em class="price">售价：￥<?php echo $price; ?></em>
              <?php  if (function_exists( 'shop_comment_number' )|| function_exists( 'shop_comment_stars' ) ) {?>
               <div class="pj_case"> 
              <?php if(shop_comment_stars() =='0'){echo '<a>暂无评分</a>';}else{?>
               <div class="star" id="stars_<?php echo shop_comment_stars()?>"> </div> 
               <?php } ?>
               
               <a><?php echo shop_comment_number();?>评价</a></div>
               
            <?php } }else{?>
             <p> <?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,80,"...",'utf-8'); ?></p>
            <?php } ?>
            
             </li>

           
	<?php $i++;
	} wp_reset_query();
}
if ( $i  == 0 )  echo '';
?>
</ul>
</div>
</div>