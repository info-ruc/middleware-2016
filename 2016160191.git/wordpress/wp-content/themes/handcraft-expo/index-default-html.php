<?php
	$handcraft_expo_pageTitlePosCheck = get_theme_mod('handcraft-expo_page_title_position', 'as_banner');
	if ($handcraft_expo_pageTitlePosCheck == 'as_banner' && have_posts()) { ?>
		<div class="page-title">
			<h1><?php the_title();?></h1>
		</div>
<?php	};
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
<?php if (is_active_sidebar('widgets_sidebar')) { ?>	
		<div class="sidebar-button clearfix">
			<div class="sidebar-control">
				<span id="sidebar-toggle-icon">></span>
			</div>
		</div>
<?php } ?>
		<div class="page-main-content">
<?php if (has_post_thumbnail()) { ?>
			<div class="page-image"><?php the_post_thumbnail('large'); ?></div>
<?php };
	if ($handcraft_expo_pageTitlePosCheck == 'as_content' && have_posts()) { ?>
			<a href="<?php the_permalink(); ?>"><h1 class="page-title-inside"><?php the_title();?></h1></a>
<?php	}; ?>									
			<article class="posts-meta"><?php echo __(' by', 'handcraft-expo'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a><?php echo __(' on ', 'handcraft-expo'); ?><?php the_time('F jS, Y'); ?><?php echo __(' at ', 'handcraft-expo'); ?><?php the_time('g:i a'); ?>. 
<?php 
	handcraft_expo_get_categories();
?>													
			</article>
			<p class="handcraftExpo-page-default-content"><?php the_content(); ?>								
<?php 
	edit_post_link( __('Edit', 'handcraft-expo'), '<p>', '</p>');
	if (get_theme_mod('handcraft-expo_content_footer_image', '')) { ?>
			<div class="content-footer">
				<img id="content-footer-image" src="<?php echo esc_url(get_theme_mod('handcraft-expo_content_footer_image', '')); ?>"  alt="" />
			</div>
<?php }; ?>
			<div class="home-navigation">
				<p><?php posts_nav_link(); ?></p>
			</div>
		</div>
	<?php 
	endwhile;
		else : ?>
		<div class="page-main-content">
			<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
			<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>
		</div>
<?php	endif;