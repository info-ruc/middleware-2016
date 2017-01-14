<div class="relevat_div">
<b class="relevat_b"><?php $word_t44=get_option('mytheme_word_t44'); if($word_t44!=""){echo $word_t44;}else{echo '相关推荐';}  ?></b>
  
 <ul class="default">
<?php
$post_num = 4;
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
			
			if(get_post_meta($id, 'views', true) ){$getPostViews=get_post_meta($id, 'views', true); }else{$getPostViews='0';}
		   $linkss=get_post_meta($id,"hoturl", true); 
		    if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();};
		    $target =get_post_meta($id,"hots_tlye", true);
			
		 ?>
               <li>
                  <a <?php echo $tagerts ; ?> href="<?php echo $links1 ?>" class="pic"> <?php  if (has_post_thumbnail()) { the_post_thumbnail('fang' ,array('alt'	=>$tit, 'title'=> $tit ));}
		 else{echo '<img src="'. get_bloginfo('template_url').'/images/upload_images.gif" />';} ?></a>
                  <span>
                      <a <?php echo $tagerts .$per_colorc2; ?> href="<?php echo $links1 ?>"><?php the_title(); ?></a>
                      <p class="infot"><em>发布时间：<?php echo get_the_time('Y/m/d') ; ?></em><em><?php $posttags = get_the_tags(); if ($posttags) {echo '标签：'; foreach($posttags as $tag) { echo '<a target="_blank" id="tagss" href="'.get_bloginfo('url').'/tag/'.$tag->slug.'">' .$tag->name .'</a>';}}?></em><em>浏览：<?php echo $getPostViews; ?>  </em> </p>
                      <p <?php echo $per_colorc3; ?>> <?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,200,"..."); ?></p>
                  </span>
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
		'orderby' => 'comment_date',
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
			
			if(get_post_meta($id, 'views', true) ){$getPostViews=get_post_meta($id, 'views', true); }else{$getPostViews='0';}
		   $linkss=get_post_meta($id,"hoturl", true); 
		    if($linkss !=""){ $links1=  $linkss;}else{$links1=  get_permalink();};
		    $target =get_post_meta($id,"hots_tlye", true);
			
		 ?>
               <li>
                  <a <?php echo $tagerts ; ?> href="<?php echo $links1 ?>" class="pic"> <?php  if (has_post_thumbnail()) { the_post_thumbnail('fang' ,array('alt'	=>$tit, 'title'=> $tit ));}
		 else{echo '<img src="'. get_bloginfo('template_url').'/images/upload_images.gif" />';} ?></a>
                  <span>
                      <a <?php echo $tagerts .$per_colorc2; ?> href="<?php echo $links1 ?>"><?php the_title(); ?></a>
                      <p class="infot"><em>发布时间：<?php echo get_the_time('Y/m/d') ; ?></em><em><?php $posttags = get_the_tags(); if ($posttags) {echo '标签：'; foreach($posttags as $tag) { echo '<a target="_blank" id="tagss" href="'.get_bloginfo('url').'/tag/'.$tag->slug.'">' .$tag->name .'</a>';}}?></em><em>浏览：<?php echo $getPostViews; ?>  </em> </p>
                      <p <?php echo $per_colorc3; ?>> <?php echo mb_strimwidth(strip_tags(apply_filters('the_excerp',get_the_excerpt($id))),0,200,"..."); ?></p>
                  </span>
               </li>
           
	<?php $i++;
	} wp_reset_query();
}
if ( $i  == 0 )  echo '';
?>
</ul>
</div>