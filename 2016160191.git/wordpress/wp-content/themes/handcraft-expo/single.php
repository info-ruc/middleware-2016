<?php 
	get_header();
	get_sidebar();
	if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 			
		if (is_active_sidebar('widgets_sidebar')) { ?>
		<div class="sidebar-button clearfix">
			<div class="sidebar-control">
				<span id="sidebar-toggle-icon">></span>
			</div>
		</div>
<?php }; ?>
		<div class="post-main-content">
			<a class="post-title" href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
<?php 
		if (! post_password_required()) {
			$handcraft_expo_author_display = get_theme_mod('handcraft-expo_author_display', 1);
			$handcraft_expo_date_display = get_theme_mod('handcraft-expo_date_display', 1);
			$handcraft_expo_time_display = get_theme_mod('handcraft-expo_time_display', 1);
			$handcraft_expo_categories_display = get_theme_mod('handcraft-expo_categories_display', 1);
			$handcraft_expo_tags_display = get_theme_mod('handcraft-expo_tags_display', 1);
			if ($handcraft_expo_author_display == 1 || $handcraft_expo_date_display == 1 || $handcraft_expo_time_display == 1 || $handcraft_expo_categories_display == 1) { ?>
				<article class="posts-meta">
<?php 		if ($handcraft_expo_author_display == 1) {
					echo __(' by ', 'handcraft-expo');
					the_author_posts_link(); 
				}
				if ($handcraft_expo_date_display == 1) {
					echo __(' on ', 'handcraft-expo'); the_time('F jS, Y'); 
				}
				if ($handcraft_expo_time_display == 1) {
					echo __(' at ', 'handcraft-expo'); the_time('g:i a'); 
				} 
			 	if ($handcraft_expo_categories_display == 1) {
					handcraft_expo_get_categories();
				}
?>
				</article>
<?php 	}
		}
	$handcraft_expo_tags_display = get_theme_mod('handcraft-expo_tags_display', 1);
	if ($handcraft_expo_tags_display == 1) {
		get_template_part('custom-tags');
	}
	if (has_post_thumbnail()) { ?>
		<div class="post-image"><?php the_post_thumbnail('large'); ?></div>
<?php } ?>
		<p><div <?php post_class(); ?>><?php the_content(); ?></div>
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
?>
		<div class="posts-navigation">
<?php
	$handcraft_expo_PrevPostImg = get_template_directory_uri() . '/img/icons/previouspage.png';
	$handcraft_expo_NextPostImg = get_template_directory_uri() . '/img/icons/nextpage.png'; ?>
			<p class="alignleft">
<?php 
	$handcraft_expo_PrevPostNav = __('Previous: ', 'handcraft-expo');
	previous_post_link($handcraft_expo_PrevPostNav . ' %link', '%title<img id="he-previouspage" src="' . $handcraft_expo_PrevPostImg . '" alt="" />', 'yes'); ?>
			</p>
			<p class="alignright">
<?php 
	$handcraft_expo_NextPostNav = __('Next: ', 'handcraft-expo');
	next_post_link($handcraft_expo_NextPostNav . ' %link', '%title<img id="he-nextpage" src="' . $handcraft_expo_NextPostImg . '" alt="">', 'yes'); ?></p>
		</div>
	<?php 
	comments_template('/comments-special.php');
	if (get_theme_mod('handcraft-expo_content_footer_image')) { ?>
		<div class="content-footer">
			<img id="content-footer-image" src="<?php echo esc_url(get_theme_mod('handcraft-expo_content_footer_image')); ?>"  alt="" />
		</div>
<?php }; ?>
		</div>
<?php
			endwhile;
		else : ?>
			<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
			<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>
<?php	endif;
	get_template_part('bottom-widgets');
	get_footer();
?>
