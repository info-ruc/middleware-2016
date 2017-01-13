<?php 
	get_header();
	get_sidebar();
	if ( have_posts() ) : ?>
						<h2 class="archives-title">
<?php 
		if (is_category()) { 
			single_cat_title(); 
		} 
		elseif (is_tag()) {
			single_tag_title();
		}
		elseif (is_author()) {
			echo __('Archives of ', 'handcraft-expo') . get_the_author();
		}
		elseif (is_day()) {
			echo __('Archives of the day ', 'handcraft-expo') . get_the_date();
		}
		elseif (is_month()) {
			echo __('Archives of the month ', 'handcraft-expo') . get_the_date('F Y');
		}
		elseif (is_year()) {
			echo the_archive_title();
		}
		else {
			echo the_archive_title();
		};	?>			
						</h2>
<?php
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
	<div class="page-image"><?php the_post_thumbnail('medium'); ?>
	</div>
<?php }; ?>									
	<a href="<?php the_permalink(); ?>"><h1 class="page-title-inside"><?php the_title();?></h1></a>
<?php 
		$handcraft_expo_author_display = get_theme_mod('handcraft-expo_author_display', 1);
		$handcraft_expo_date_display = get_theme_mod('handcraft-expo_date_display', 1);
		$handcraft_expo_time_display = get_theme_mod('handcraft-expo_time_display', 1);
		$handcraft_expo_categories_display = get_theme_mod('handcraft-expo_categories_display', 1);
		$handcraft_expo_tags_display = get_theme_mod('handcraft-expo_tags_display', 1);
		if ($handcraft_expo_author_display == 1 || $handcraft_expo_date_display == 1 || $handcraft_expo_time_display == 1 || $handcraft_expo_categories_display == 1) { ?>
			<article class="posts-meta">
<?php if ($handcraft_expo_author_display == 1) {
			echo __(' by', 'handcraft-expo'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php the_author(); ?></a>
<?php }
	 	if ($handcraft_expo_date_display == 1) {
	 		echo __(' on ', 'handcraft-expo'); ?><a href="<?php the_permalink(); ?>"><?php the_time('F jS, Y'); ?></a>
<?php }
	 	if ($handcraft_expo_time_display == 1) {
			echo __(' at ', 'handcraft-expo');
			the_time('g:i a');
		}
	 	if ($handcraft_expo_categories_display == 1) {
			handcraft_expo_get_categories();
		}
?>
	</article>
<?php } ?>
	<p class="handcraftExpo-page-default-content"><?php the_excerpt(); ?>
<?php 
	edit_post_link( __('Edit', 'handcraft-expo'), '<p>', '</p>');
	if (get_theme_mod('handcraft-expo_content_footer_image', '')) { ?>
	<div class="content-footer">
		<img id="content-footer-image" src="<?php echo esc_url(get_theme_mod('handcraft-expo_content_footer_image', '')); ?>"  alt="" />
	</div>
<?php }; ?>							
	</div>
	<?php 
	endwhile; ?>
	
	<div class="archives-navigation" style="text-align:center;">
		<?php posts_nav_link( '<div class="he-nav-pages-sep">  </div>', '<img src="' . get_stylesheet_directory_uri() . '/img/icons/previouspage.png" />' . ' < ' . __('Previous', 'handcraft-expo'), __('Next', 'handcraft-expo') . ' > <img src="' . get_stylesheet_directory_uri() . '/img/icons/nextpage.png" />' ); ?>
	</div>
<?php
	else : ?>
	<div class="page-main-content">
		<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
		<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>
	</div>
	
<?php	endif;
	get_template_part('bottom-widgets');
	get_footer();
?>