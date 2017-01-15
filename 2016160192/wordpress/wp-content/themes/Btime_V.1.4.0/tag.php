<?php get_header(); ?>
<div class="content-wrap">
	<div class="content">
		<?php echo _hui('ads_tag_01_s') ? '<div class="ads ads-content">'.hui_get_adcode('ads_tag_01').'</div>' : '' ?>
		<?php 
		$pagedtext = '';
		if( $paged && $paged > 1 ){
			$pagedtext = ' <small>'.__('第', 'haoui').$paged.__('页', 'haoui').'</small>';
		}
		echo '<h1 class="title"><strong>'.__('标签：', 'haoui'), single_tag_title() ,'</strong>'.$pagedtext.'</h1>';
		
		get_template_part( 'excerpt' ); 
		?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>