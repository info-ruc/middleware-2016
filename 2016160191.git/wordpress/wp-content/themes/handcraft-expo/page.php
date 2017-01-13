<?php 
	get_header();
	get_sidebar();
	$handcraft_expo_pageTitlePosCheck = get_theme_mod('handcraft-expo_page_title_position', 'as_banner');
	if ($handcraft_expo_pageTitlePosCheck == 'as_banner') { ?>
		<div class="page-title">
			<h1><?php the_title();?></h1>
		</div>
<?php	};
	if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
<?php 
	if (is_active_sidebar('widgets_sidebar')) { ?>	
		<div class="sidebar-button clearfix">
			<div class="sidebar-control">
				<span id="sidebar-toggle-icon">></span>
			</div>
		</div>
<?php } ?>
		<div class="page-main-content">
			<nav class="ancestors-children-nav">
				<span class="page-top-ancestor"><?php echo __('Main page: ', 'handcraft-expo'); ?><a href="<?php echo get_the_permalink(handcraft_expo_get_top_ancestor_page_id()); ?>" ><?php echo get_the_title(handcraft_expo_get_top_ancestor_page_id()); ?></a></span>
				<ul>
<?php										
$handcraft_expo_args = array(
	'child_of'      => handcraft_expo_get_top_ancestor_page_id(),
	'title_li'      => __('Related Pages:', 'handcraft-expo')
);	
wp_list_pages($handcraft_expo_args); 
?>
				</ul>	
				</nav>
<?php		
	if (has_post_thumbnail()) { ?>
		<div class="page-image"><?php the_post_thumbnail('large'); ?></div>
<?php };
	if ($handcraft_expo_pageTitlePosCheck == 'as_content') { ?>
		<a href="<?php the_permalink(); ?>"><h1 class="page-title-inside"><?php the_title();?></h1></a>
<?php	}; ?>									
		<p class="handcraftExpo-page-default-content"><?php the_content(); ?>
<?php
	edit_post_link( __('Edit', 'handcraft-expo'), '<p>', '</p>');
	$handcraft_expo_PagesLinks_defaults = array(
			'before'           => '<p class="comments-pages-links">' . __('Pages:', 'handcraft-expo'),
			'after'            => '</p>',
			'next_or_number'   => 'number',
			'separator'        => ' - ',
			'nextpagelink'     => __('Next page', 'handcraft-expo'),
			'previouspagelink' => __('Previous page', 'handcraft-expo'),
			'pagelink'         => '%',
			'echo'             => 1
	);

	wp_link_pages($handcraft_expo_PagesLinks_defaults);
	$handcraft_expo_pagelist = get_pages('sort_column=menu_order&sort_order=asc');
	$handcraft_expo_pages = array();
	foreach ($handcraft_expo_pagelist as $handcraft_expo_page) {
		$handcraft_expo_pages[] += $handcraft_expo_page->ID;
	}
	$handcraft_expo_current = array_search(get_the_ID(), $handcraft_expo_pages);
	$handcraft_expo_prevID = $handcraft_expo_pages[$handcraft_expo_current-1];
	$handcraft_expo_nextID = $handcraft_expo_pages[$handcraft_expo_current+1];
?>
		<div class="pages-navigation">
<?php 
	if ($handcraft_expo_prevID != 0) { ?>
			<div class="alignleft">
			<a href="<?php echo get_permalink($handcraft_expo_prevID); ?>"
			title="<?php echo get_the_title($handcraft_expo_prevID); ?>">< <?php echo __('Previous', 'handcraft-expo'); ?><img id="he-previouspage" src="<?php echo get_template_directory_uri(); ?>/img/icons/previouspage.png" alt="" /></a>
			</div>
<?php }
	if ($handcraft_expo_nextID != 0) { ?>
			<div class="alignright">
			<a href="<?php echo get_permalink($handcraft_expo_nextID); ?>" 
			title="<?php echo get_the_title($handcraft_expo_nextID); ?>"><img id="he-nextpage" src="<?php echo get_template_directory_uri(); ?>/img/icons/nextpage.png" alt="" /><?php echo __('Next', 'handcraft-expo'); ?> ></a>
			</div>
<?php } ?>
		</div>
<?php
	comments_template('/comments-special.php');
	if (get_theme_mod('handcraft-expo_content_footer_image', '')) { ?>
		<div class="content-footer">
			<img id="content-footer-image" src="<?php echo esc_url(get_theme_mod('handcraft-expo_content_footer_image', '')); ?>"  alt="" />
		</div>
<?php }; ?>
		</div>
<?php 
	endwhile;
		else : ?>
			<div class="page-main-content">
				<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
				<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>
			</div>
<?php	endif;
	get_template_part('bottom-widgets');
	get_footer();
?>
