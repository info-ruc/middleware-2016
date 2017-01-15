<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Magazine_Plus
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ); ?>

			<?php endwhile; ?>

		<?php
		/**
		 * Hook - magazine_plus_action_posts_navigation.
		 *
		 * @hooked: magazine_plus_custom_posts_navigation - 10
		 */
		do_action( 'magazine_plus_action_posts_navigation' ); ?>


		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - magazine_plus_action_sidebar.
	 *
	 * @hooked: magazine_plus_add_sidebar - 10
	 */
	do_action( 'magazine_plus_action_sidebar' );
?>
<?php get_footer(); ?>
