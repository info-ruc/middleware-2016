<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magazine_Plus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content-wrapper">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php magazine_plus_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div><!-- .entry-content-wrapper -->

	<footer class="entry-footer">
		<?php magazine_plus_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
