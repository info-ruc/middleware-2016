<?php

/**** Return number of thumbs for a defined post ****/
function novavideo_lite_get_nb_thumbs( $post_id ){
    
    global $post;
    $post = get_post( $post_id );
    
    $attachments = get_children( array(
    	'post_type'      => 'attachment',
    	'posts_per_page' => -1,
    	'post_parent'    => $post->ID,
    ) );
    
    $attachments_guid = '';
    
    if ( $attachments ) {
        
    	foreach ( $attachments as $attachment ) {   		  
           $attachments_guid[] = $attachment->guid;
        }
    
    }
    
    return count($attachments_guid);
    
}

/**** Return number of videos found (for titles) ****/
function novavideo_lite_get_nb_video(){
    
    global $wp_query;
    
    $nb_videos = $wp_query->found_posts;
    
    $output = '(';
    
    if( $nb_videos > 1 ){
        $output .= $nb_videos . ' ' . __( 'videos', 'novavideo-lite' );
    }else{
        $output .= $nb_videos . ' ' . __( 'video', 'novavideo-lite' );
    }
    
    $output .= ')';
    
    if( $nb_videos ){
        return $output;
    }else{
        return false;
    }
    
}

/**** get video thumb ****/
function novavideo_lite_get_post_no_thumbnail( $post ){
    
    global $post;
    
    
    // On récupère la liste des images attachées à l'article
    $attachments = get_children( array(
    	'post_type'      => 'attachment',
    	'posts_per_page' => 1,
    	'post_parent'    => get_the_ID(),
    	'exclude'        => get_post_thumbnail_id()
    ) );
    
    // On teste si on a des images ou non
    if ( $attachments ) {
    	
        $attachments_tmp = array_values($attachments);
        $attachment = array_shift($attachments_tmp);
        
        $extention = explode( '.', $attachment->guid );
        $extention = end($extention);
        
        $attachment_url = str_replace( '.' . $extention, '-210x142.' . $extention, $attachment->guid );
        
    	return '<img src="' . $attachment_url . '" alt="' . get_the_title() . '" />';
    	
    }else{
        return false;
    }
}

function novavideo_lite_get_post_image( $size = 'thumb_site', $url_only = false ){
    
    global $post;
    
    $output = false;
    
        if( has_post_thumbnail() ){
            
            $output =  get_the_post_thumbnail( $post->ID, $size );
        
        } else if( novavideo_lite_get_post_no_thumbnail($post) ) {
            
            $output = novavideo_lite_get_post_no_thumbnail($post) ;
        
        } else {
        
        }                   
    
    if( $url_only ){
        preg_match( '@src="([^"]+)"@' , $output, $img_url );
        $output = $img_url[1];        
    }
    return $output; 
    
}

function novavideo_lite_theme_support() {
    add_theme_support( 'post-thumbnails' );    
    add_image_size( 'thumb_site', '210', '142', '1' ); 
}

add_action( 'after_setup_theme', 'novavideo_lite_theme_support' );
      
add_filter( 'intermediate_image_sizes', 'novavideo_lite_rcd_remove_stock_image_sizes' );    

function novavideo_lite_rcd_remove_stock_image_sizes( $sizes ) {
    return array( 'thumb_site' );
}

function novavideo_lite_delete_thumb_function( $post_ID ) {

    $upload_dir = wp_upload_dir();
    
    if ( 'post' == get_post_type() ):
    
        global $_wp_additional_image_sizes;

        $post = get_post( $post_ID );
        // On récupère la liste des images attachées à la vidéo
        $attachments = get_children( array(
        	'post_type'      => 'attachment',
        	'posts_per_page' => -1,
        	'post_parent'    => get_the_ID(),
        ) );
        // On teste si on a des images ou non
        if ( $attachments ) {
        	foreach ( $attachments as $attachment ) {
        	       
                //delete generated thumbs
                wp_delete_attachment( $attachment->ID, true );
               
                //delete original file
                $file_URI = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $attachment->guid);
                if( file_exists( $file_URI ) && !is_dir( $file_URI ) ){
                    unlink( $file_URI );
                }
            }
        
        }
        
    endif;
}
add_action('before_delete_post', 'novavideo_lite_delete_thumb_function');