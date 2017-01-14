<div class="relevat_div">
<b class="relevat_title"><?php $word_t44=get_option('mytheme_word_t44'); if($word_t44!=""){echo $word_t44;}else{echo '相关推荐';}  ?></b>

<ul class="text_relvat">
<?php
$post_num =8;
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
               <li>
                     <a title="<?php the_title(); ?>" target="_blank" href="<?php echo $links1 ?>"><?php echo mb_strimwidth(strip_tags(apply_filters('the_title',get_the_title($id))),0,45,"..."); ?></a>
                 
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
               <li>
                  <a title="<?php the_title(); ?>"target="_blank" href="<?php echo $links1 ?>"><?php echo mb_strimwidth(strip_tags(apply_filters('the_title',get_the_title($id))),0,45,"..."); ?></a>
                 
               </li>
           
	<?php $i++;
	} wp_reset_query();
}
if ( $i  == 0 )  echo '';
?>
</ul>
</div>