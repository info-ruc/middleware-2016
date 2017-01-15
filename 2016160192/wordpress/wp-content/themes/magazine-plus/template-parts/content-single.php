<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magazine_Plus
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php magazine_plus_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

    <?php
	  /**
	   * Hook - magazine_plus_single_image.
	   *
	   * @hooked magazine_plus_add_image_in_single_display -  10
	   */
	  do_action( 'magazine_plus_single_image' );
	?>

	<div class="entry-content-wrapper">
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'magazine-plus' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-content-wrapper -->

	<footer class="entry-footer">
		<?php magazine_plus_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
