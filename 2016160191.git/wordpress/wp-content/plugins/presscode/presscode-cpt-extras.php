<?php

function pcode_post_updated_messages($messages)
{	global $post;
	$code_post_types = array("pcode_custom_css", "pcode_custom_js", "pcode_custom_php");

    $post_ID = $post->ID;
    $post_type = get_post_type( $post_ID );
    
    
    if(!in_array($post_type, $code_post_types, true))
    {
    	return $messages;
    	
    }
    

    $obj = get_post_type_object( $post_type );
    $singular = $obj->labels->singular_name;

    $messages[$post_type] = array(
            0 => '', // Unused. Messages start at index 1.
            1 => sprintf( __( '%s updated.'), esc_attr( $singular ), esc_url( get_permalink( $post_ID ) ), strtolower( $singular ) ),
            2 => __( 'Custom field updated.', 'presscode' ),
            3 => __( 'Custom field deleted.', 'presscode' ),
            4 => sprintf( __( '%s updated.', 'presscode' ), esc_attr( $singular ) ),
            5 => isset( $_GET['revision']) ? sprintf( __('%2$s restored to revision from %1$s', 'presscode' ), wp_post_revision_title( (int) $_GET['revision'], false ), esc_attr( $singular ) ) : false,
            6 => sprintf( __( '%s published. <a href="%s">View %s</a>'), $singular, esc_url( get_permalink( $post_ID ) ), strtolower( $singular ) ),
            7 => sprintf( __( '%s saved.', 'presscode' ), esc_attr( $singular ) ),
            8 => sprintf( __( '%s submitted. <a href="%s" target="_blank">Preview %s</a>'), $singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), strtolower( $singular ) ),
            9 => sprintf( __( '%s scheduled for: <strong>%s</strong>. <a href="%s" target="_blank">Preview %s</a>' ), $singular, date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post_ID ) ), strtolower( $singular ) ),
            10 => sprintf( __( '%s draft updated. <a href="%s" target="_blank">Preview %s</a>'), $singular, esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ), strtolower( $singular ) )
    );
    

    return $messages;

}

?>
