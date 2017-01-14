<?php 

/*

Template Name: Handcraft Expo 2 Columns Template

*/ ?>

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
			while ( have_posts() ) : the_post();
			if (is_active_sidebar('widgets_sidebar')) { ?>	
		<div class="sidebar-button clearfix">
			<div class="sidebar-control">
				<span id="sidebar-toggle-icon">></span>
			</div>
		</div>
<?php } ?>
								<div class="page-main-content-2-columns">
<?php
	if (has_post_thumbnail()) { ?>														
		<div class="page-image"><?php the_post_thumbnail('large'); ?>
		</div>
<?php };
	
	if ($handcraft_expo_pageTitlePosCheck == 'as_content') { ?>
		<a href="<?php the_permalink(); ?>"><h1 class="page-title-inside"><?php the_title();?></h1></a>
<?php	}; ?>									
		<p class="handcraftExpo-page-default-content"><?php the_content(); ?></p>
																	
<?php
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