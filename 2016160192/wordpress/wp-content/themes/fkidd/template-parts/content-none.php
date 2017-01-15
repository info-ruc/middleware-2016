<?php
/**
 * The default template for displaying content
 *
 * Used for single, index, archive, and search contents.
 *
 */
?>

<article>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<h1><?php _e( 'Oh no! Article not found! 404 error!', 'fkidd'); ?></h1>
	
	<?php elseif ( is_search() ) : ?>

			<h1><?php _e( 'No Results Found!', 'fkidd'); ?></h1>
			<?php get_search_form(); ?>

	<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'fkidd'); ?></p>
			<?php get_search_form(); ?>

	<?php endif; ?>

</article>