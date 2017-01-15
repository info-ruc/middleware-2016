<?php
/**
 * The default template for displaying content
 *
 * Used for single, index, archive, and search contents.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>

	<?php else : ?>
	
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
	
	<?php endif; ?>

	<div class="before-content">
		<span class="author-icon">
			<?php the_author_posts_link(); ?>
		</span>
		<?php if ( !is_single() && get_the_title() === '' ) : ?>

		<span class="clock-icon">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time(get_option('date_format')); ?></time>
			</a>
		</span>
	
		<?php else : ?>

			<span class="clock-icon">
				<time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time(get_option('date_format')); ?></time>
			</span>
			
		<?php endif; ?>
		
		<?php if ( ! post_password_required() ) :
		
					$format = get_post_format();
						if ( current_theme_supports( 'post-formats', $format ) ) :
							printf( '<span class="%1$s-icon"> <a href="%2$s">%3$s</a></span>',
									$format,							
									esc_url( get_post_format_link( $format ) ),
									get_post_format_string( $format )
								);
						endif;
				
			   endif;
		?>
		
		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>

				<span class="comments-icon">
					<?php comments_popup_link(__( 'No Comments', 'fkidd' ), __( '1 Comment', 'fkidd' ), __( '% Comments', 'fkidd' ), '', __( 'Comments are closed.', 'fkidd' )); ?>
				</span>
		<?php endif; ?>
		
	</div>

	<?php if ( is_single() ) : ?>

				<div class="content">
					<?php fkidd_the_content_single(); ?> 
				</div>

	<?php else : ?>

				<div class="content">

					<?php fkidd_the_content(); ?>

				</div>

	<?php endif; ?>


	<div class="after-content">
		
		<?php if ( ! post_password_required() ) : ?>

				<?php if ( has_category() ) : ?>
							<span class="category-icon">
								<?php the_category( ', ' ) ?>
							</span>
				<?php endif; ?>
				
				<?php if ( has_tag() ) : ?>
							<span class="tags-icon">
								<?php the_tags(); ?>
							</span>
				<?php endif; ?>

		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'fkidd'), '<span class="edit-icon">', '</span>' ); ?>
	</div>
	
	<?php if ( !is_single() ) : ?>
				<div class="separator">
				</div>
	<?php endif; ?>
</article>
