<?php

global $user_ID;
get_currentuserinfo();

if ( ! isset( $content_width ) ) $content_width = 880;

add_theme_support( 'automatic-feed-links' );

/* ************************************************************************************************
		Admin functions
************************************************************************************************ */

/**** Load metaboxes declaration ****/
    include_once( get_template_directory() . '/_admin/meta_boxes.php' );
    
/**** Load admin js and css ****/
function novavideo_lite_import_main_js_css() {
    
    //load js and css
    wp_register_script( 'admin_js', get_template_directory_uri() . '/_admin/js/script.js', array('jquery'), '1.0', true );
    wp_enqueue_script('admin_js');
    
    wp_enqueue_style('admin_style', get_template_directory_uri() . '/_admin/css/style.css');
    
    //localize ajax script
    wp_localize_script('admin_js', 'ajax_var', array(
    	'url'   => admin_url('admin-ajax.php'),
    	'nonce' => wp_create_nonce('ajax-nonce')
    ));
    
}

add_action('admin_init', 'novavideo_lite_import_main_js_css');

        
function novavideo_lite_addthemabizbar(){
    ?>   
    
    <div class="updated topbar-default notification">
        <div class="container">
            <p><?php _e('Check out the many additional options of the powerful Novavideo Pro Version here:', 'novavideo-lite'); ?> <a href="<?php echo esc_url( __('http://www.themabiz.com/shop/wp-themes/novavideo-wordpress-video-theme/?f=wplite', 'novavideo-lite')); ?>" target="_blank" class="button button-primary"><?php _e('Check out Novavideo Pro Version now!', 'novavideo-lite'); ?></a> <a href="<?php echo esc_url( __('http://www.themabiz.com/novavideo/', 'novavideo-lite')); ?>" target="_blank" class="button" ><?php _e('Live demo', 'novavideo-lite'); ?></a></p>
            <button type="button" class="close-notification">&times;</button>
        </div>
    </div>
    
    <?php
}


/**** add Ajax hide topbar ****/
add_action('wp_ajax_hide_topbar', 'novavideo_lite_hide_topbar');

function novavideo_lite_hide_topbar(){
    
	$nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');
    
    set_transient( 'novavideo_lite_topbar', 'desactivated', 60*10 );
    
	exit;
}

add_action('admin_init', 'novavideo_lite_myStartSession');


function novavideo_lite_myStartSession() {

    if( get_transient('novavideo_lite_topbar') == 'desactivated' ){
        remove_filter( 'wp_before_admin_bar_render', 'novavideo_lite_addthemabizbar');
    }else{
        add_filter( 'wp_before_admin_bar_render', 'novavideo_lite_addthemabizbar');
    }   
}


/* ************************************************************************************************
		Common front and admin functions
************************************************************************************************ */

/**** Load miscelaneous functions ****/
include_once( get_template_directory() . '/_includes/utils.php' );    
    
/**** Load menu ****/
include_once( get_template_directory() . '/_includes/menu.php' );
    
/**** Load menu ****/
include_once( get_template_directory() . '/_includes/widgets.php' );
   
/**** Load video functions ****/
include_once( get_template_directory() . '/_includes/video-functions.php' );
      
      
/**** Set translation files path ****/
function novavideo_lite_load_text_domain() {
    load_theme_textdomain( 'novavideo-lite', get_template_directory().'/languages' ); 
}
add_action('after_setup_theme', 'novavideo_lite_load_text_domain');


function novavideo_lite_setup() {
	add_theme_support('title-tag', 'post-formats', array( 'video' ) );
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'after_setup_theme', 'novavideo_lite_setup' );
    

/* ************************************************************************************************
		Front functions
************************************************************************************************ */
    
/**** Load comment system ****/
include_once( get_template_directory() . '/_front/comments.php' );

if ( is_singular() ) wp_enqueue_script( "comment-reply" );

/**** Load JS and CSS files ****/
function novavideo_lite_import_various_js_css() {
    wp_enqueue_script( 'novavideo_lite_main_js', get_template_directory_uri() . '/scripts/main.js', array("jquery"), '1.0', true );        
    wp_enqueue_style('novavideo_lite_style_css', get_template_directory_uri() . '/style.css');        
    wp_enqueue_style('novavideo_lite_googlefont_css', 'http://fonts.googleapis.com/css?family=Play:400,700');
}
add_action('wp_enqueue_scripts', 'novavideo_lite_import_various_js_css');