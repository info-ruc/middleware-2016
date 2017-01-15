<?php
get_header();
global $wp_query;
$curauth = $wp_query->get_queried_object();
?>
<div class="content-wrap">
	<div class="content">
		<?php 
		$pagedtext = '';
		if( $paged && $paged > 1 ){
			$pagedtext = ' <small>'.__('第', 'haoui').$paged.__('页', 'haoui').'</small>';
		}
		echo '<h1 class="title"><strong>'.$curauth->display_name.__('的文章', 'haoui').'</strong>'.$pagedtext.'</h1>';
		
		get_template_part( 'excerpt' ); 
		?>
	</div>
</div>

<?php get_sidebar(); get_footer(); ?>