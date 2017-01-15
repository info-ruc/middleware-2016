<?php get_header(); ?>
    
    <h1>
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Daily Archives: %s', 'novavideo-lite' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Monthly Archives: %s', 'novavideo-lite' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'novavideo-lite' ) ) ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Yearly Archives: %s', 'novavideo-lite' ),  get_the_date( _x( 'Y', 'yearly archives date format', 'novavideo-lite' ) ) ); ?>
		<?php else : ?>
			<?php _e( 'Blog Archives', 'novavideo-lite' ); ?>
		<?php endif; ?>
         <?php echo novavideo_lite_get_nb_video(); ?>
	</h1>
    
    <?php if ( have_posts() ) : ?>
    
        <ul class="listing-videos listing-tube">
        
            <?php while ( have_posts() ) : the_post(); ?>
                                   
                <?php get_template_part( 'content', get_post_format() ); ?>
            
            <?php endwhile; ?>
        
        </ul>
        
    <?php endif; ?>
    
    <div class="clear"></div>
    
    <div class="pagination"><?php novavideo_lite_paginate(); ?></div>
   
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>