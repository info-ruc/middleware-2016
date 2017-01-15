<?php get_header(); ?>

<div id="main-content-wrapper">
	<div id="main-content">
		<?php
			/**
			 * we use get_the_archive_title() to get the title of the archive of 
			 * a category (taxonomy), tag (term), author, custom post type, post format, date, etc.
			 */
			$title = get_the_archive_title();
		?>
	
		<div id="info-title">
			<?php echo $title; ?>
		</div><!-- #info-title -->
		<?php if ( have_posts() ) : ?>

				<?php
				// starts the loop
				while ( have_posts() ) :

					the_post();

					/*
					 * Include the post format-specific template for the content.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;
	
				the_posts_pagination( array(
		                        'prev_next' => '',
		                    ) );
				  
		 else :

				// if no content is loaded, show the 'no found' template
				get_template_part( 'template-parts/content', 'none' );
			
		  endif; ?>
	</div>

	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>