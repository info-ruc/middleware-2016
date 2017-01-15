<?php
/* 
 * list excerpt
 * ====================================================
*/

$etype = _hui('list_type');

while ( have_posts() ) : the_post(); 
	$classname = '';
	$focuscode = '';

	if( $etype !== 'none' ){
	    $img_number = hui_post_images_number();
	    $has_thumb = has_post_thumbnail();

	    if( $etype == 'thumb' ){
	        $imgSingle = true;

	        if( $has_thumb || $img_number>0 ){
	            $classname = ' excerpt-one';
	        }
	    }else if( $etype == 'more' || $etype == 'multi' || $etype == 'four' ){
	        $imgSingle = false;

	        if( $has_thumb || ($img_number>0 && $img_number<4) ){
	            $classname = ' excerpt-one';
	        }else if( !$has_thumb && $img_number>=4 ){
	            $classname = ' excerpt-multi';
	        }
	    }

	    $focuscode = hui_get_thumbnail( $imgSingle, false );
	    $focuscode = $focuscode ? '<p class="focus"><a'.hui_target_blank().' href="'.get_permalink().'" class="thumbnail">'.$focuscode.'</a></p>' : '';
	}


	$author = get_the_author();
	if( _hui('author_link') ){
	    $author = '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.$author.'</a>';
	}

	$p_meta = _hui('post_plugin');

	echo '<article class="excerpt'.$classname.'">';
	    echo ' ';echo ' ',
	     $focuscode,
	    
	    '<h2><a'.hui_target_blank().' href="'.get_permalink().'" title="'.get_the_title()._hui('connector').get_bloginfo('name').'">'.get_the_title().get_the_subtitle().'</a></h2>',
	    '<p class="note">'.hui_get_excerpt_content().'</p>',
		
		
	    '<p class="text-muted views">
		
		
		<span class="rightkong"> '.(($p_meta && $p_meta['siteauthor'])?'  ':'').$author.' '.__(' - ', 'haoui').'  '.hui_get_post_date( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</span>';
	    if( _hui('post_link_excerpt_s') ) hui_post_link();
	    echo hui_get_views(), 
	    ($p_meta && $p_meta['comm']) ? '<span class="post-comments">'.hui_get_comment_number().'</span>' : '',
	    hui_get_post_like($class='post-like'),
	  //  the_tags('<span class="post-tags">'.__('标签：', 'haoui'), ' / ', '</span>'), 
	    '</p>';

	echo '</article>';

endwhile; 
hui_paging();
wp_reset_query();