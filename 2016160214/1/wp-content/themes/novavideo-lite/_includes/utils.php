<?php
/**** find any substring in an array ****/
function novavideo_lite_substr_in_array( $substr, $array){
    
    $founded = array();
    
    foreach ( $array as $key => $value ) {
        
       if( substr_count($value, $substr) > 0 ) {
            $founded[] = $key;
       }
       
    }
    
    if( !empty($founded) ){
        
        return ($founded);
    }else{
        
        return false;
        
    }
    
}    

/**** Pagination ****/
function novavideo_lite_paginate() {
    $big = 999999999; // need an unlikely integer
    
    global $wp_query;
    
    echo paginate_links( array(
    	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    	'format' => '?paged=%#%',
    	'current' => max( 1, get_query_var('paged') ),
    	'total' => $wp_query->max_num_pages
    ) );
}