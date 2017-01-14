<?php

/*********************************************************/

/********************** VIDEOS ***************************/

/*********************************************************/    

    

    //Ajout de la zone 'Informations complémentaires' dans une vidéo

    add_action('add_meta_boxes', 'novavideo_lite_infos_video_add_meta_box', 10, 1);

    function novavideo_lite_infos_video_add_meta_box()

    {

    	add_meta_box(

    		'novavideo_lite_info',

    		 __('Novavideo Lite - Video information', 'novavideo-lite'),

    		'novavideo_lite_infos_video_display_meta_box',

    		'post',

    		'advanced',

    		'default'

    	);

    }

    

    //Affichage de la zone 'Informations complémentaires' dans une vidéo

    function novavideo_lite_infos_video_display_meta_box($post, $args){

        

        wp_nonce_field( basename( __FILE__ ), 'novavideo_lite_metabox_nonce' );

        

    ?>

        <table class="form-table">

                    

        <th scope="row">

        

            <img width="22" height="22" style="float: left; vertical-align: middle; margin: -3px 5px 0 0;" src="<?php echo get_template_directory_uri(); ?>/_admin/images/embed.png" alt="<?php _e('Video code', 'novavideo-lite'); ?>"/><?php _e('Video code', 'novavideo-lite'); ?> : <i>(<?php _e('ex: iframe or embed', 'novavideo-lite'); ?>)</i>

        

        </th>

         

        <td>



            <textarea style="width:80%;" name="code" rows="10" cols="30"><?php echo get_post_meta($post->ID, 'code', true); ?></textarea>

            

        </td>

        

        <tr valign="top">

        

            <th scope="row">

            

                <img width="22" height="22" style="float: left; vertical-align: middle; margin: -3px 5px 0 0;" src="<?php echo get_template_directory_uri(); ?>/_admin/images/preview.png" alt="<?php _e('Video preview', 'novavideo-lite'); ?>"/><?php _e('Video preview', 'novavideo-lite'); ?> :

            

            </th>

             

            <td class="embed-code">

                        

                <?php $code = get_post_meta( $post->ID, 'code', true ); ?>

                

                <?php if ( $code !='' ) : ?>

                

                    <?php global $post; ?> 

                         

                    <?php echo htmlspecialchars_decode( get_post_meta( $post->ID, 'code', true ) ); ?>                    

                    

                <?php else:?>

                

                    <?php echo '<i>' . __('Complete the video embed code above in order to preview the video.', 'novavideo-lite') . '</i>';?>

                    

                <?php endif;?>

                    

            </td>

        </tr>              

        

        </table>



    <?php

    }

    

    add_action('save_post', 'novavideo_lite_infos_save_meta_box', 10, 2);

    function novavideo_lite_infos_save_meta_box($post_id, $post){

        

        if( !current_user_can('edit_posts') ){

            return;

        }

        

        // Checks save status

        $is_autosave = wp_is_post_autosave( $post_id );

        $is_revision = wp_is_post_revision( $post_id );

        $is_valid_nonce = ( isset( $_POST[ 'novavideo_lite_metabox_nonce' ] ) && wp_verify_nonce( $_POST[ 'novavideo_lite_metabox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

     

        // Exits script depending on save status

        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {

            return;

        }

    

        if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){

           return;

        }

               

        // Do nothing during a bulk edit or inline edit

        if ( isset($_REQUEST['bulk_edit']) || ( isset($_REQUEST["action"]) && $_REQUEST["action"] == 'inline-save' ) ){

            return;

        }

                   

        if( isset($_POST['code']) )

            update_post_meta($post_id, 'code', $_POST['code']);

        

        return;

            

    }

    

?>