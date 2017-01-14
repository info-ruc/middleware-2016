<li>

    <?php
        $attr = array(			
            'alt'	=> get_the_title(),
            'title'	=> get_the_title(),        
            'rel'   => novavideo_lite_get_nb_thumbs( get_the_ID() )
        );
    ?>    
    
    <?php echo novavideo_lite_get_post_image(); ?>
    
    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><span><?php the_title() ?></span></a>
    
</li>