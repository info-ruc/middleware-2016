<?php get_header(); ?>
    
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