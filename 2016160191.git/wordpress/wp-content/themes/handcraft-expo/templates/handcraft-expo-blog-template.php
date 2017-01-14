<?php 

/*

Template Name: Handcraft Expo Blog Template

*/ ?>

<?php
	get_header();
	get_sidebar(); ?>
		<div class="blog-title"><h1><?php the_title();?></h1></div>
<?php 
	if (is_active_sidebar('widgets_sidebar')) { ?>
		<div class="sidebar-button clearfix">
			<div class="sidebar-control">
				<span id="sidebar-toggle-icon">></span>
			</div>
		</div>
<?php };
	$handcraft_expo_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$handcraft_expo_blogPagePosts = new WP_Query('cat=0&posts_per_page=2&paged=' . $handcraft_expo_paged);
	if ( $handcraft_expo_blogPagePosts->have_posts() ) :
		while ( $handcraft_expo_blogPagePosts->have_posts() ) : $handcraft_expo_blogPagePosts->the_post(); ?>
								<div class="blog-main-content">
										<h3 class="page-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<article class="posts-meta"><?php echo __(' by', 'handcraft-expo'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a><?php echo __(' on ', 'handcraft-expo'); ?><?php the_time('F jS, Y'); ?><?php echo __(' at ', 'handcraft-expo'); ?><?php the_time('g:i a'); ?>. 
<?php 
	handcraft_expo_get_categories();
?>																
		</article>
		<?php if (has_post_thumbnail()) { ?>
			<div class="blog-showcase-thumbnails"><?php the_post_thumbnail('medium'); ?>
			</div>
		<?php } ?>
		<p><div id="post-<?php the_ID(); ?>" class="<?php post_class(); ?>">
		<?php 
			$handcraft_expo_more_link_text = 'continue...';
			the_excerpt($handcraft_expo_more_link_text);
			edit_post_link( __('Edit', 'handcraft-expo'), '<p>', '</p>'); ?>
		</div>
<?php 
	if (get_theme_mod('handcraft-expo_content_footer_image', '')) { ?>
		<div class="content-footer">
			<img id="content-footer-image" src="<?php echo esc_url(get_theme_mod('handcraft-expo_content_footer_image', '')); ?>"  alt="" />
		</div>
<?php }; ?>	
		</div>
<?php endwhile; ?>
		<div class="blog-navigation">
			<p class="previousposts"><?php next_posts_link('&laquo; Previous Entries', $handcraft_expo_blogPagePosts->max_num_pages); ?></p>
			<p class="nextposts"><?php	previous_posts_link('Next Entries &raquo;'); ?></p>
		</div>					
<?php
		else : ?>
		<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
		<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>
<?php	endif;
 ?>
<?php
	wp_reset_postdata();
	get_template_part('bottom-widgets');
	get_footer();
?>