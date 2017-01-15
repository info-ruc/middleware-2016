<?php get_header(); ?>

    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        $code = get_post_meta( $post->ID, 'code', true );
    ?> 
        
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <?php if ( has_post_format( 'video' ) ) : ?>        
    
            <div id="video">
                <h1><?php the_title(); ?></h1>
                
                <?php if ( $code != '' ) : ?>           
                    <div id="video-code">
                        <?php global $post; ?> 
                        <?php echo htmlspecialchars_decode( get_post_meta( $post->ID, 'code', true ) ); ?>
                    </div>
                <?php endif; ?>
                                            
                <div id="video-infos">
                    <div id="video-synopsys">
                    
                        <?php if ( $code !='' ) : ?>
                        <?php else : ?>                        
                        <?php 
                            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              the_post_thumbnail();
                            } 
                        ?>
                        <?php endif; ?>
                    
                        <?php the_content(); ?> 
                        <?php wp_link_pages(); ?>                         
                    </div>
                                                            
                    <div id="video-bottom">
                        <div id="cat-tag">                              
                            <?php echo get_the_term_list( $post->ID, 'category', '<li>', '</li><li>', '</li>' ); ?>                   
                            <?php echo get_the_tag_list( '<li>', '</li><li>', '</li>' ); ?>                  
                        </div>                    
                        <div class="clear"></div>                    
                    </div>
                </div>
            </div>
            
        <?php else: ?>
        
            <div id="video">
                <h1><?php the_title(); ?></h1>
                
                <?php if ( $code != '' ) : ?>           
                    <div id="video-code">
                        <?php global $post; ?> 
                        <?php echo htmlspecialchars_decode( get_post_meta( $post->ID, 'code', true ) ); ?>
                    </div>
                <?php endif; ?>
                                            
                <div id="video-infos">
                    <div id="video-synopsys">
                    
                        <?php if ( $code !='' ) : ?>
                        <?php else : ?>                        
                        <?php 
                            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              the_post_thumbnail();
                            } 
                        ?>
                        <?php endif; ?>
                    
                        <?php the_content(); ?> 
                        <?php wp_link_pages(); ?>                         
                    </div>
                                                            
                    <div id="video-bottom">
                        <div id="cat-tag">                              
                            <?php echo get_the_term_list( $post->ID, 'category', '<li>', '</li><li>', '</li>' ); ?>                   
                            <?php echo get_the_tag_list( '<li>', '</li><li>', '</li>' ); ?>                  
                        </div>                    
                        <div class="clear"></div>                    
                    </div>
                </div>
            </div>
            
        <?php endif; ?>                                      
                             
        <div id="comments">
            <div class="comments-template">
                <?php comments_template( '', true ); ?>
            </div>
        </div>
                    
    </div>   
        
    <?php endwhile; else: ?>
        <?php _e('No video founded.', 'novavideo-lite'); ?>
    <?php endif; ?>                      
            
    <div class="clear"></div>
    
</div><!-- #content -->

<?php wp_reset_query(); ?> 

<?php get_sidebar(); ?>
<?php get_footer(); ?>