<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Magazine_Plus
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'magazine-plus' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'search' ); ?>

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
	</section><!-- #primary -->

<?php
	/**
	 * Hook - magazine_plus_action_sidebar.
	 *
	 * @hooked: magazine_plus_add_sidebar - 10
	 */
	do_action( 'magazine_plus_action_sidebar' );
?>
<?php get_footer(); ?>
