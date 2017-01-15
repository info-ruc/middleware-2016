<?php 
/*
 * Template Name: Page Has Menu
 * http://themebetter.com/theme/xiu
*/
get_header();
?>

<?php  
	$pagemenus = _hui('page_menu');
	$menus = '';
	if( $pagemenus ){
		foreach ($pagemenus as $key => $value) {
			if( $value ) $menus .= '<li><a href="'.get_permalink($key).'">'.get_post($key)->post_title.'</a></li>';
		}
	}
?>
<div class="pageside">
	<div class="pagemenus">
		<?php if( !empty($menus) ){
			echo '<ul class="pagemenu">'.$menus.'</ul>';
		}else{
			echo __('如果你是本站管理员，请去后台-外观-xiu主题设置-独立页面，选择页面菜单后并保存，你选择的菜单将显示在这里。', 'haoui');
		} ?>
	</div>
</div>

<div class="content-wrap">
	<div class="content no-sidebar">
		<?php while (have_posts()) : the_post(); ?>
		<header class="article-header">
			<h1 class="article-title"><?php the_title(); ?></h1>
		</header>
		<article class="article-content">
			<?php the_content(); ?>
		</article>
		<?php endwhile;  ?>
		<?php comments_template('', true); ?>
	</div>
</div>
<?php get_footer(); ?>