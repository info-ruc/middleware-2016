<?php 
/* 
 * post focus
 * ====================================================
*/
function hui_posts_focus(){
    $html = '';
    $html .= '<li class="large"><a'.hui_target_blank().' href="'._hui('focus_href').'"><img class="thumb" data-original="'._hui('focus_src').'"><h4>'._hui('focus_title').'</h4></a></li>';

    $sticky = get_option('sticky_posts'); rsort( $sticky );
    query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1, 'showposts' => 4 ) );
    if( have_posts() ) : 
        while (have_posts()) : the_post(); 
            $html .= '<li><a'.hui_target_blank().' href="'.get_permalink().'">';
            $html .= hui_get_thumbnail();
            $html .= '<h4>'.get_the_title().get_the_subtitle().'</h4>';
            $html .= '</a></li>';
        endwhile; 
    endif;
    wp_reset_query(); 
    echo '<div class="focusmo"><ul>'.$html.'</ul></div>';
}