<?php

/* 
 * options
 * ====================================================
*/
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options/assets/' );
require_once THEME_FILES . '/options/options-ui.php';
//require_once THEME_FILES . '/options/update.php';


/* 
 * admin login
 * ====================================================
*/
/*if( _hui('admin_login_limit') ){
add_action('login_enqueue_scripts','login_protection');  
function login_protection(){  
    if($_GET['admin'] != _hui('admin_login_limit')) header('Location: '.HOME_URI);  
}
}*/


function add_editor_buttons($buttons) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'copy';
    $buttons[] = 'paste';
    $buttons[] = 'cut';
    $buttons[] = 'image';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    $buttons[] = 'wp_page';
    $buttons[] = 'charmap';
    return $buttons;
}
add_filter("mce_buttons_2", "add_editor_buttons");






add_filter('manage_posts_columns', 'postlike_admin_add_column');
function postlike_admin_add_column($columns){
    $columns['like'] = __('点赞数', 'haoui');
    return $columns;
}
add_action('manage_posts_custom_column','postlike_admin_show',10,2);
function postlike_admin_show($column_name,$id){
    if ($column_name != 'like')
        return;   
    $post_like = get_post_meta($id, "like",true);
    echo $post_like;
}




add_filter('manage_posts_columns', 'postviews_admin_add_column');
function postviews_admin_add_column($columns){
    $columns['views'] = __('阅读数', 'haoui');
    return $columns;
}
add_action('manage_posts_custom_column','postviews_admin_show',10,2);
function postviews_admin_show($column_name,$id){
    if ($column_name != 'views')
        return;   
    $post_views = get_post_meta($id, "views",true);
    echo $post_views;
}




/* 
 * post meta from
 * ====================================================
*/
$postmeta_from = array(
    array(
        "name" => "fromname",
        "std" => "",
        "title" => __('来源网站名', 'haoui').'：'
    ),
    array(
        "name" => "fromurl",
        "std" => "",
        "title" => __('来源地址', 'haoui').'：'
    )
);
add_action('admin_menu', 'hui_create_meta_box');
add_action('save_post', 'hui_save_postdata');

function hui_postmeta_from() {
    global $post, $postmeta_from;
    foreach($postmeta_from as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<p>'.$meta_box['title'].'</p>';
        echo '<p><input type="text" style="width:98%" value="'.$meta_box_value.'" name="'.$meta_box['name'].'_value"></p>';
    }
   
    echo '<input type="hidden" name="post_newmetaboxes_noncename" id="post_newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function hui_create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', __('来源', 'haoui'), 'hui_postmeta_from', 'post', 'normal', 'high' );
    }
}

function hui_save_postdata( $post_id ) {
    global $postmeta_from;
   
    if ( !wp_verify_nonce( $_POST['post_newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
   
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                   
    foreach($postmeta_from as $meta_box) {
        $data = $_POST[$meta_box['name'].'_value'];
        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}



/* 
 * post meta keywords
 * ====================================================
*/
$postmeta_keywords_description = array(
    array(
        "name" => "keywords",
        "std" => "",
        "title" => __('关键字', 'haoui').'：'
    ),
    array(
        "name" => "description",
        "std" => "",
        "title" => __('描述', 'haoui').'：'
        )
);
if( _hui('post_keywords_description_s') ){
    add_action('admin_menu', 'hui_postmeta_keywords_description_create');
    add_action('save_post', 'hui_postmeta_keywords_description_save');
}

function hui_postmeta_keywords_description() {
    global $post, $postmeta_keywords_description;
    foreach($postmeta_keywords_description as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<p>'.$meta_box['title'].'</p>';
        if( $meta_box['name'] == 'keywords' ){
            echo '<p><input type="text" style="width:98%" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></p>';
        }else{
            echo '<p><textarea style="width:98%" name="'.$meta_box['name'].'">'.$meta_box_value.'</textarea></p>';
        }
    }
   
    echo '<input type="hidden" name="post_newmetaboxes_noncename" id="post_newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function hui_postmeta_keywords_description_create() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'postmeta_keywords_description_boxes', __('自定义关键字和描述', 'haoui'), 'hui_postmeta_keywords_description', 'post', 'normal', 'high' );
    }
}

function hui_postmeta_keywords_description_save( $post_id ) {
    global $postmeta_keywords_description;
   
    if ( !wp_verify_nonce( $_POST['post_newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
   
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                   
    foreach($postmeta_keywords_description as $meta_box) {
        $data = $_POST[$meta_box['name']];
        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}



/* 
 * post meta link
 * ====================================================
*/
$postmeta_link = array(
    array(
        "name" => "link",
        "std" => ""/*,
        "title" => __('直达链接', 'haoui').'：'*/
    )
);
if( _hui('post_link_excerpt_s') || _hui('post_link_single_s') ){
    add_action('admin_menu', 'hui_postmeta_link_create');
    add_action('save_post', 'hui_postmeta_link_save');
}

function hui_postmeta_link() {
    global $post, $postmeta_link;
    foreach($postmeta_link as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<p>'.$meta_box['title'].'</p>';
        echo '<p><input type="text" style="width:98%" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></p>';
    }
   
    echo '<input type="hidden" name="post_newmetaboxes_noncename" id="post_newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function hui_postmeta_link_create() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'postmeta_link_boxes', __('直达链接', 'haoui'), 'hui_postmeta_link', 'post', 'normal', 'high' );
    }
}

function hui_postmeta_link_save( $post_id ) {
    global $postmeta_link;
   
    if ( !wp_verify_nonce( $_POST['post_newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
   
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                   
    foreach($postmeta_link as $meta_box) {
        $data = $_POST[$meta_box['name']];
        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}






/* 
 * post meta subtitle
 * ====================================================
*/
$postmeta_subtitle = array(
    array(
        "name" => "subtitle",
        "std" => ""/*,
        "title" => __('直达链接', 'haoui').'：'*/
    )
);

add_action('admin_menu', 'hui_postmeta_subtitle_create');
add_action('save_post', 'hui_postmeta_subtitle_save');


function hui_postmeta_subtitle() {
    global $post, $postmeta_subtitle;
    foreach($postmeta_subtitle as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
        echo'<p>'.$meta_box['title'].'</p>';
        echo '<p><input type="text" style="width:98%" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></p>';
    }
   
    echo '<input type="hidden" name="post_newmetaboxes_noncename" id="post_newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function hui_postmeta_subtitle_create() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'postmeta_subtitle_boxes', __('副标题', 'haoui'), 'hui_postmeta_subtitle', 'post', 'normal', 'high' );
    }
}

function hui_postmeta_subtitle_save( $post_id ) {
    global $postmeta_subtitle;
   
    if ( !wp_verify_nonce( $_POST['post_newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
   
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                   
    foreach($postmeta_subtitle as $meta_box) {
        $data = $_POST[$meta_box['name']];
        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}




