<?php get_header(); ?>
<?php hui_logo(); ?>
<header class="header">
	<?php hui_nav_menu(); ?>
	</header>
<div class="content-wrap">
	<div class="content">
		<?php echo _hui('ads_cat_01_s') ? '<div class="ads ads-content">'.hui_get_adcode('ads_cat_01').'</div>' : '' ?>
		<?php 
		$pagedtext = '';
		if( $paged && $paged > 1 ){
			$pagedtext = ' <small>'.__('第', 'haoui').$paged.__('页', 'haoui').'</small>';
		}
		echo '<h1 class="title"><strong><a href="'.get_category_link( get_cat_ID( single_cat_title('',false) ) ).'">', single_cat_title(), '</a></strong>'.$pagedtext.'</h1>';

		get_template_part( 'excerpt' ); 
		?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>