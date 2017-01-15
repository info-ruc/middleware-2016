<?php 
get_header(); 
$pagedtext = '';
if( $paged && $paged > 1 ){
	$pagedtext = ' <small>'.__('第', 'haoui').$paged.__('页', 'haoui').'</small>';
}
?>

<div class="content-wrap">
	<div class="content">
		<h1 class="title"><strong><?php 
			if(is_day()) echo the_time('Y'.__('年', 'haoui').'m'.__('月', 'haoui').'j'.__('日', 'haoui').'');
			elseif(is_month()) echo the_time('Y'.__('年', 'haoui').'m'.__('月', 'haoui').'');
			elseif(is_year()) echo the_time('Y'.__('年', 'haoui').''); 
		?><?php echo __('的文章', 'haoui') ?></strong><?php echo $pagedtext ?></h1>
		<?php get_template_part( 'excerpt' );  ?>
	</div>
</div>

<?php get_sidebar(); get_footer(); ?>