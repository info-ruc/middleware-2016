<?php 

/*

Template Name: Handcraft Expo Page No-Title Template

*/ ?>
<?php 
	get_header();
	get_sidebar();
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
		<div class="page-notitle-main-content">
<?php		
	if (has_post_thumbnail()) { ?>
		<div class="page-image"><?php the_post_thumbnail('large'); ?>
		</div>
<?php }; ?>									
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