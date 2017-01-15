<?php 
/* 
 * post sticky
 * ====================================================
*/
function hui_posts_sticky(){
    $title = _hui('sticky_title');
    $showposts = _hui('sticky_limit');
    $sticky = get_option('sticky_posts'); rsort( $sticky );
    query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1, 'showposts' => $showposts ) );
    if( have_posts() ) : 
        printf('<div class="sticky"><h3 class="title"><strong>'.$title.'</strong></h3><ul>');
        while (have_posts()) : the_post(); 
            echo '<li class="item"><a'.hui_target_blank().' href="'.get_permalink().'">';
            echo hui_get_thumbnail();
            echo get_the_title().get_the_subtitle();
            echo '</a></li>';
        endwhile; 
        printf('</ul></div>');
    endif;
    wp_reset_query(); 
}