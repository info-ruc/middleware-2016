<?php get_header(); ?>
    
    <h1 class="error"><?php _e( 'Page 404', 'novavideo-lite' ); ?></h1>
    
    <h2><?php _e( 'Sorry the page you requested does not exist. Feel free to watch our latest videos', 'novavideo-lite' ); ?> : </h2>
               
        <?php $page_query = new WP_Query( array( 'post_type' => 'post' ) ); ?>            

            <?php if( $page_query->have_posts() ) : ?>
            
                <ul class="listing-videos listing-tube">
                
                <?php while ( $page_query->have_posts() ) : $page_query->the_post(); ?>
                
                    <?php get_template_part( 'content', get_post_format() ); ?>
                    
                <?php endwhile; ?>
                
                </ul>
                
            <?php endif; ?>
            
            <div class="clear"></div>

    </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>