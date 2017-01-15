<?php get_header(); ?>
<div class="mbmav">
<header class="header">
	<?php hui_nav_menu(); ?>
	</header>
</div>
      <div class="singlehd">
      <div class="logoimg"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo _hui('logo_src')?>" /></a>
<?php if( _hui('breadcrumbs_single_s') ){ ?><?php echo hui_breadcrumbs() ?><?php } ?></div>
  </div>
<style>
body{background-color: #fafafc;}
.content{margin-left:0px;}
.singlehd{  border-bottom:1px solid #e5e5e5; padding-bottom:5px; padding-top:10px; background-color:#fafafc}
</style>
<div class="content-wrap" style="background-color: #fafafc" >
	<div class="content">
		<?php while (have_posts()) : the_post(); ?>
		<header class="article-header">
       
			<h1 class="article-title"><a href="<?php the_permalink() ?>"><?php the_title(); echo get_the_subtitle(); ?></a></h1>
			<ul class="article-meta">
				<?php $author = get_the_author();
    if( _hui('author_link') ){
        $author = '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.$author.'</a>'; } ?>
				<li><?php echo $author ?> <?php echo __('发布于', 'haoui') ?> <?php echo hui_get_post_date( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
				<li><?php echo __('分类：', 'haoui');the_category(' / '); ?></li>
				<?php echo _hui('post_from_s') && hui_get_post_from() ? '<li>'.hui_get_post_from().'</li>' : '' ?>
				<li><?php echo hui_get_views() ?></li>
				<li><?php echo hui_get_comment_number() ?></li>
				<li><?php edit_post_link('['.__('编辑', 'haoui').']'); ?></li>
			</ul>
		</header>
		<?php if( _hui('ads_post_01_s') ) echo '<div class="ads ads-content ads-post">'.hui_get_adcode('ads_post_01').'</div>'; ?>
		<article class="article-content">
			<?php the_content(); ?>
		</article>
		<?php wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="article-paging">&after=</div>&next_or_number=number'); ?>
		<?php endwhile;  ?>
		<div class="article-social">
			<?php echo hui_get_post_like($class='action action-like'); ?>
			<?php if( _hui('post_link_single_s') ) hui_post_link(); ?>
		</div>
        <div class="gohome"><a href="<?php bloginfo('url'); ?>">返回首页</a></div>
		<div class="action-share bdsharebuttonbox">
			<?php echo hui_get_share() ?>
		</div>
		<div class="article-tags">
			<?php the_tags(__('标签：', 'haoui'),'',''); ?>
		</div>
		<?php if( _hui('ads_post_02_s') ) echo '<div class="ads ads-content ads-related">'.hui_get_adcode('ads_post_02').'</div>'; ?>
        <?php if( _hui('post_related_s') ) hui_posts_related( _hui('related_title'), _hui('post_related_n'), (_hui('post_related_model') ? _hui('post_related_model') : 'thumb') ) ?>
		<?php if( _hui('ads_post_03_s') ) echo '<div class="ads ads-content ads-comment">'.hui_get_adcode('ads_post_03').'</div>'; ?>
		<?php comments_template('', true); ?>
	</div>
</div>
<?php get_sidebar(); get_footer(); ?>