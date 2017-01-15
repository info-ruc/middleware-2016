<?php
// if( is_super_admin() ) ini_set('display_errors','On');



/* 
 * define
 * ====================================================
*/

define( 'HOME_URI'       , home_url() );
define( 'HOME_DIR'       , rtrim(WP_CONTENT_DIR, "/wp-content") );
define( 'THEME_FILES'    , get_stylesheet_directory() );
define( 'THEME_URI'      , get_stylesheet_directory_uri() );
define( 'AVATAR_DEFAULT' , THEME_URI.'/images/avatar-default.png' );
define( 'THUMB_DEFAULT'  , THEME_URI.'/images/thumbnail.png' );
define( 'MOD_URI'        , THEME_FILES.'/modules' );
define( 'WIDGET_URI'     , THEME_FILES.'/widgets' );
define( 'THEME_NAME'     , 'xiu' );


if ( ! function_exists( '_hui' ) ) {
    function _hui( $name, $default = false ) {
        $config = get_option( 'opshui' );

        if ( ! isset( $config['id'] ) ) {
            return $default;
        }

        $options = get_option( $config['id'] );

        if ( isset( $options[$name] ) ) {
            return $options[$name];
        }

        return $default;
    }
}




// WordPress Emoji Delete
remove_action( 'admin_print_scripts' ,  'print_emoji_detection_script');
remove_action( 'admin_print_styles'  ,  'print_emoji_styles');
remove_action( 'wp_head'             ,  'print_emoji_detection_script', 7);
remove_action( 'wp_print_styles'     ,  'print_emoji_styles');
remove_filter( 'the_content_feed'    ,  'wp_staticize_emoji');
remove_filter( 'comment_text_rss'    ,  'wp_staticize_emoji');
remove_filter( 'wp_mail'             ,  'wp_staticize_emoji_for_email');






/* 
 * delete google fonts
 * ====================================================
*/
// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
    function remove_wp_open_sans() {
        wp_deregister_style( 'open-sans' );
        wp_register_style( 'open-sans', false );
    }
    add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
 
    // Uncomment below to remove from admin
    // add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

function remove_open_sans() {    
    wp_deregister_style( 'open-sans' );    
    wp_register_style( 'open-sans', false );    
    wp_enqueue_style('open-sans','');    
}    
add_action( 'init', 'remove_open_sans' );




function hui_breadcrumbs(){
    if( !is_single() ) return false;
    $categorys = get_the_category();
    $category = $categorys[0];
    
    return '<span class="text-muted">当前位置：</span><a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> <small>></small> '.get_category_parents($category->term_id, true, ' <small>></small> ').'<span class="text-muted">'.(!_hui('breadcrumbs_single_text')?get_the_title():'正文').'</span>';
}




/**
 * open link manager
 *
 * ====================================================================================================
 **/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


/* 
 * languages
 * ====================================================
*/
add_action('after_setup_theme', 'hui_languages');
function hui_languages(){
    load_theme_textdomain('haoui', THEME_FILES . '/languages');
}


if( is_admin() ){
    require_once THEME_FILES . '/functions.admin.php';
}

/* 
 * no categoty
 * ====================================================
*/
if( _hui('no_categoty') ) require_once THEME_FILES . '/modules/no-category.php';



if( !_hui('gravatar_url') || _hui('gravatar_url') == 'ssl' ){
    add_filter('get_avatar', 'get_ssl2_avatar');
}else if( _hui('gravatar_url') == 'duoshuo' ){
    add_filter('get_avatar', 'duoshuo_get_avatar', 10, 3);
}

//官方Gravatar头像调用ssl头像链接
function get_ssl2_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="https://secure.gravatar.com/avatar/$1" class="avatar avatar-$2" height="$2" width="$2">', $avatar);
    return $avatar;
}

//多说官方Gravatar头像调用
function duoshuo_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "gravatar.duoshuo.com", $avatar);
    return $avatar;
}


function hui_moloader($name = '', $apply = true) {
    if (!function_exists($name)) {
        include MOD_URI . '/' . $name . '.php';
    }

    if ($apply && function_exists($name)) {
        $name();
    }
}

// print_r( get_option('WPLANG') );


/* 
 * widgets
 * ====================================================
*/
if( _hui('layout') !== 'ui-c2' ){
    if (function_exists('register_sidebar')){
        $widgets = array(
            'sitesidebar' => __('全站侧栏', 'haoui'),
            'sidebar' => __('首页侧栏', 'haoui'),
            'othersidebar' => __('分类/标签/搜索页侧栏', 'haoui'),
            'postsidebar' => __('文章页侧栏', 'haoui'),
            'pagesidebar' => __('页面侧栏', 'haoui'),
        );
        foreach ($widgets as $key => $value) {  
            register_sidebar(array(
                'name'          => $value,
                'id'            => 'widget_'.$key,
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="title"><strong>',
                'after_title'   => '</strong></h3>'
            ));
        }
    }

    require_once WIDGET_URI . '/widget-index.php';
}


/* 
 * reg nav
 * ====================================================
*/
if (function_exists('register_nav_menus')){
    register_nav_menus( array(
        'nav' => __('网站导航', 'haoui')
    ));
}


/* 
 * nav
 * ====================================================
*/
function hui_nav_menu($class='nav', $location='nav'){
    echo '<ul class="'.$class.'"><li class="navmore"></li>'.str_replace("</ul></div>", "", preg_replace("/<div[^>]*><ul[^>]*>/", "", wp_nav_menu(array('theme_location' => $location, 'echo' => false)) )).'</ul>';
}


/* 
 * logo
 * ====================================================
*/
function hui_logo($class='logo', $tag=array('h1', 'h1')){

    $tag = is_home() ? $tag[0] : $tag[1];
    echo '<'.$tag.' class="logo"><a href="'.get_bloginfo('url').'" title="'.get_bloginfo('name')._hui('connector').get_bloginfo('description').'"><img src="'._hui('logo_src').'">'.get_bloginfo('name').'</a></'.$tag.'>';
}


/* 
 * from
 * ====================================================
*/
function hui_get_post_from($pid='', $prevtext='图片参考：'){
    if( !$pid ) $pid = get_the_ID();
    $fromname = trim(get_post_meta($pid, "fromname_value", true));
    $fromurl = trim(get_post_meta($pid, "fromurl_value", true));
    $from = '';
    if( $fromname ){
        if( $fromurl ){
            $from = '<a href="'.$fromurl.'" target="_blank" rel="external nofollow">'.$fromname.'</a>';
        }else{
            $from = $fromname;
        }
        $from = (_hui('post_from_h1')?_hui('post_from_h1'):$prevtext).$from;
    }
    return $from; 
}


/* 
 * recent post number
 * ====================================================
*/
function hui_get_recent_posts_number($days=1) {
    global $wpdb;
    $today = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
    $daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) ); 
    $post_ID = array();
    $result = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' AND post_status='publish' AND post_type='post' ORDER BY post_date DESC ");         
        foreach ($result as $Item) {
            $post_ID[] = $Item->ID;
        }
    return count($post_ID);
}





function hui_bodyclass(){
    $class = 'excerpt_thumb_left';
    if( (is_page() || is_single()) && _hui('post_p_s') ){
        $class .= ' post_p_indent';
    }

    if( !_hui('search_nav') ){
        $class .= ' search_not';
    }

 

    global $paged;
    if( !$paged && _hui('focusslide_s') && _hui('focusslide_s_m') ){
        $class .= ' focusslide_s_m';
    }

   /* if( _hui('layout_mo') ){
        $class .= ' uimo';
    }*/

    return trim(trim($class).' '._hui('layout'));
}


/* 
 * post like button
 * ====================================================
*/
function hui_get_post_like($class='', $pid='', $text=''){
    $pls = _hui('post_plugin');
    if( !$pls || !$pls['like'] ) return false;
    
    $pid = $pid ? $pid : get_the_ID();
    $text = $text ? $text : __('赞', 'haoui');
    $like = get_post_meta( $pid, 'like', true );
    // $event = is_user_logged_in() ? 'like' : 'login';
    $event = 'like';
    if( hui_is_my_like($pid) ) {
        $class .= ' actived';
    }
    return '<a href="javascript:;" class="'.$class.'" data-pid="'.$pid.'" data-event="'.$event.'"><i class="glyphicon glyphicon-thumbs-up"></i>'.$text.' (<span>'.($like ? $like : 0).'</span>)</a>';

}


/* 
 * is user like ?
 * ====================================================
*/
function hui_is_my_like($pid=''){
    if( !is_user_logged_in() ) return false;
    $pid = $pid ? $pid : get_the_ID();
    $likes = get_user_meta( get_current_user_id(), 'like-posts', true );
    $likes = $likes ? unserialize($likes) : array();
    return in_array($pid, $likes) ? true : false;
}


/* 
 * remove head
 * ====================================================
*/
remove_action( 'wp_head',   'wp_generator' ); 

add_filter('show_admin_bar','hide_admin_bar');
function hide_admin_bar($flag) {
    return false;
}


/* 
 * editor style
 * ====================================================
*/
add_editor_style('editor-style.css');


/* 
 * post thumbnail
 * ====================================================
*/
add_theme_support('post-thumbnails');
// set_post_thumbnail_size(240, 180, false); 


function hui_target_blank(){
    return _hui('target_blank') ? ' target="_blank"' : '';
}




/* 
 * paging
 * ====================================================
*/

if ( ! function_exists( 'hui_paging' ) ) :
function hui_paging() {
    $p = 3;
    if ( is_singular() ) return;
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ( $max_page == 1 ) return; 
    echo '<div class="pagination'.(_hui('paging_type') == 'multi'?' pagination-multi':'').'"><ul>';
    if ( empty( $paged ) ) $paged = 1;
    if( _hui('paging_type') == 'multi' && $paged !== 1 ) p_link(0);
    // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; 
    echo '<li class="prev-page">'; previous_posts_link(__('上一页', 'haoui')); echo '</li>';

    if( _hui('paging_type') == 'multi' ){
        if ( $paged > $p + 1 ) p_link( 1, '<li>'.__('第一页', 'haoui').'</li>' );
        if ( $paged > $p + 2 ) echo "<li><span>···</span></li>";
        for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
            if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"active\"><span>{$i}</span></li>" : p_link( $i );
        }
        if ( $paged < $max_page - $p - 1 ) echo "<li><span> ... </span></li>";
    }
    //if ( $paged < $max_page - $p ) p_link( $max_page, '&raquo;' );
    echo '<li class="next-page">'; next_posts_link(__('下一页', 'haoui')); echo '</li>';
    if( _hui('paging_type') == 'multi' && $paged < $max_page ) p_link($max_page, '', 1);
    if( _hui('paging_type') == 'multi' ) echo '<li><span>'.__('共', 'haoui').' '.$max_page.' '.__('页', 'haoui').'</span></li>';

    echo '</ul></div>';
}
function p_link( $i, $title = '', $w='' ) {
    if ( $title == '' ) $title = __('页', 'haoui')." {$i}";
    $itext = $i;
    if( $i == 0 ){
        $itext = __('首页', 'haoui');
    }
    if( $w ){
        $itext = __('尾页', 'haoui');
    }
    echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "'>{$itext}</a></li>";
}
endif;


/* 
 * custom code
 * ====================================================
*/
add_action('wp_head', 'hui_wp_head');
function hui_wp_head() { 
    hui_head_css();
    if( _hui('site_keywords_description_s') ){
        hui_keywords();
        hui_description();
    }
    hui_record_visitors();
    if( _hui('headcode') ) echo "<!--ADD_CODE_HEADER_START-->\n"._hui('headcode')."\n<!--ADD_CODE_HEADER_END-->\n";
}

add_action('wp_footer', 'hui_wp_footer');
function hui_wp_footer() { 
    if( _hui('footcode') ) echo "<!--ADD_CODE_FOOTER_START-->\n"._hui('footcode')."\n<!--ADD_CODE_FOOTER_END-->\n";
}




function get_the_subtitle(){
    global $post;
    $post_ID = $post->ID;
    $subtitle = get_post_meta($post_ID, 'subtitle', true);

    if( !empty($subtitle) ){
        return ' <span>'.$subtitle.'</span>';
    }else{
        return false;
    }
}


function hui_post_link(){
    global $post;
    $post_ID = $post->ID;
    $link = get_post_meta($post_ID, 'link', true);

    if( $link ){
        echo '<a class="post-linkto'. (is_single()?' action':'') .'" href="'. $link .'"'. (_hui('post_link_blank_s')?' target="_blank"':'') . (_hui('post_link_nofollow_s')?' rel="external nofollow"':'') .'>'. (is_single()?'<i class="glyphicon glyphicon-share-alt"></i>':'') ._hui('post_link_h1') .'</a>';
    }
}

function hui_get_share(){
    $shares = array(
        'qzone',
        'tsina',
        'weixin',
       // 'tqq',
        'sqq',
     //   'bdhome',
       // 'tqf',
        'renren',
     //   'diandian',
     //   'youdao',
     //   'ty',
     //   'kaixin001',
     //   'taobao',
        'douban',
    //    'fbook',
    //    'twi',
    //    'mail',
    //    'copy'
    );

    $html = '';
    foreach ($shares as $value) {
        $html .= '<a class="bds_'.$value.'" data-cmd="'.$value.'"></a>';
    }

    return __('分享到：', 'haoui').$html.'<a class="bds_more" data-cmd="more">'.__('更多', 'haoui').'</a> (<a class="bds_count" data-cmd="count"></a>)';
}


/* 
 * post views
 * ====================================================
*/
function hui_record_visitors(){
    if (is_singular()){
      global $post;
      $post_ID = $post->ID;
      if($post_ID){
          $post_views = (int)get_post_meta($post_ID, 'views', true);
          if(!update_post_meta($post_ID, 'views', ($post_views+1))){
            add_post_meta($post_ID, 'views', 1, true);
          }
      }
    }
}
function hui_get_views($class='post-views', $before='', $after=''){
    $pls = _hui('post_plugin');
    if( !$pls || !$pls['view'] ) return false;
    if( !$before ) $before = __('阅读', 'haoui').'(';
    if( !$after ) $after = ')';
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    return '<span class="'.$class.'">'.$before.$views.$after.'</span>';
}


/* 
 * string limit
 * ====================================================
*/
function hui_strimwidth($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}

function random_str($length){
    $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $strlen = 62;
    while($length > $strlen){
        $str .= $str;
        $strlen += 60;
    }
    $str = str_shuffle($str);
    return substr($str, 0,$length);
}


/* 
 * 404
 * ====================================================
*/
function hui_404(){
    echo '<div class="e404"><img src="'.THEME_URI.'/images/404.png"><h1>404 . Not Found</h1><p>'.__('沒有找到你要的内容！', 'haoui').'</p><br><p><a class="btn btn-primary" href="'.get_bloginfo('url').'">'.__('返回首页', 'haoui').'</a></p></div>';
}


/* 
 * post excerpt
 * ====================================================
*/
function _str_cut($str ,$start , $width ,$trimmarker ){
    $output = preg_replace('/^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start.'}((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$width.'}).*/s','\1',$str);
    return $output.$trimmarker;
}
function hui_get_excerpt_content($limit=50, $after='...'){
    $excerpt = get_the_excerpt();
    if ( mb_strlen( $excerpt ) > $limit ) {
        return _str_cut(strip_tags($excerpt), 0, $limit, $after);
    }else{
        return $excerpt;
    }
}

function twentyeleven_excerpt_length( $length ) {
    return 100;
}

add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );


function hui_post_images_number(){
    global $post;
    $content = $post->post_content;  
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
    return count($strResult[1]);  
}
function hui_get_comment_number($before='',$after=''){
    if( !$before ) $before = __('评论', 'haoui').'(';
    if( !$after ) $after = ')';

    global $wpdb, $post;
    $str = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_approved = '1' AND comment_type = ''");
    return $before.$str.$after;
}


function hui_get_adcode($name){
    if( !$name ) return '';
    if( wp_is_mobile() ){
        return _hui($name.'_m');
    }else{
        return _hui($name);
    }
}






/* 
 * post related
 * ====================================================
*/
function hui_posts_related($title='', $limit=8, $model='thumb'){
    global $post;

    $exclude_id = $post->ID; 
    $posttags = get_the_tags(); 
    $i = 0;
    echo '<div class="relates'.' relates-model-'.$model.'"><h3 class="title"><strong>'.$title.'</strong></h3><ul>';
    if ( $posttags ) { 
        $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->name . ',';
        $args = array(
            'post_status' => 'publish',
            'tag_slug__in' => explode(',', $tags), 
            'post__not_in' => explode(',', $exclude_id), 
            'ignore_sticky_posts' => 1, 
            'orderby' => 'comment_date', 
            'posts_per_page' => $limit
        );
        query_posts($args); 
        while( have_posts() ) { the_post();
            echo '<li><a'.hui_target_blank().' href="'.get_permalink().'">';

            if( $model == 'thumb' ){
                echo hui_get_thumbnail();
            }

            echo get_the_title().get_the_subtitle().'</a></li>';

            $exclude_id .= ',' . $post->ID; $i ++;
        };
        wp_reset_query();
    }
    if ( $i < $limit ) { 
        $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
        $args = array(
            'category__in' => explode(',', $cats), 
            'post__not_in' => explode(',', $exclude_id),
            'ignore_sticky_posts' => 1,
            'orderby' => 'comment_date',
            'posts_per_page' => $limit - $i
        );
        query_posts($args);
        while( have_posts() ) { the_post();
            echo '<li><a'.hui_target_blank().' href="'.get_permalink().'">';

            if( $model == 'thumb' ){
                echo hui_get_thumbnail();
            }

            echo get_the_title().get_the_subtitle().'</a></li>';

            $i ++;
        };
        wp_reset_query();
    }
    if ( $i == 0 ){
        echo '暂无内容！';
    }
    
    echo '</ul></div>';
}


/* 
 * post thumbnail
 * ====================================================
*/
function hui_get_thumbnail( $single=true, $must=true ) {  
    global $post;
    $html = '';
    if ( has_post_thumbnail() ) {   

        /*$domsxe = simplexml_load_string(get_the_post_thumbnail());
        $src = $domsxe->attributes()->src;  
        $src_array = wp_get_attachment_image_src(hui_get_attachment_id_from_src($src), 'thumbnail');
        $html = sprintf('<span><img data-original="%s" class="thumb"/></span>', $src_array[0]);*/
        
        $domsxe = get_the_post_thumbnail();
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $domsxe, $strResult, PREG_PATTERN_ORDER);  
        $images = $strResult[1];
        foreach($images as $src){
            $html = sprintf('<span><img data-original="%s" class="thumb"/></span>', $src);
            break;
        }

    } else {
        $content = $post->post_content;  
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
        $images = $strResult[1];

        $counter = count($strResult[1]);

        if( !$counter && $single && $must ){
            return '<span><img data-original="'.THUMB_DEFAULT.'" class="thumb"/></span>';
        }

        $etype = _hui('list_type');
        
        $i = 0;
        foreach($images as $src){
            $i++;
            $src2 = wp_get_attachment_image_src(hui_get_attachment_id_from_src($src), 'thumbnail');
            $src2 = $src2[0];
            if( !$src2 && _hui('list_thumb_out') ){
                $src = $src;
            }else{
                $src = $src2;
            }

            // 
          /*  if( _hui('list_thumb_out') && _hui('list_thumb_out_text') ){
                $filetype = hui_get_filetype($src);
                $src = rtrim($src, '.'.$filetype)._hui('list_thumb_out_text').'.'.$filetype;
            }*/
            
            $item = sprintf('<img data-original="%s" class="thumb"/>', $src);
            if( $single){
                return $item;
                break; 
            }
            $html .= '<span class="item"><span class="thumb-span">'.$item.'</span></span>';
            if( 
                /*( $etype == 'more' && $counter >= 12 && $i >= 12 ) || 
                ( $etype == 'multi' && ($counter >= 8 && $i >= 8) || ($counter >= 4 && $i >= 4) || ($counter > 0 && $counter < 4 && $i >= 1) ) || 
                ( $etype == 'four' && $counter >= 4 && $i >= 4 ) || 
                ( $etype == 'thumb' && $counter >= 1 && $i >= 1 )*/

                ($etype == 'more' && $counter >= 12 && $i >= 12) || 
                ($etype == 'multi' && $counter >= 8 && $i >= 8) || 
                ($etype == 'four' && $counter >= 4 && $i >= 4) || 
                ($counter >= 12 && $i >= 12) || 
                ($counter >= 8 && $counter < 12 && $i >= 8) || 
                ($counter >= 4 && $counter < 8 && $i >= 4) || 
                ($counter > 0 && $counter < 4 && $i >= 1) 
            ){
                break; 
            }
        }
    }
    return $html;
}

function hui_get_attachment_id_from_src ($link) {
    global $wpdb;
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid='$link'");
}



/* 
 * avatar cache
 * ====================================================
*/
// add_filter('get_avatar','hui_avatar'); 
function hui_avatar($avatar) {
    $tmp = strpos($avatar, 'http');
    $g = substr($avatar, $tmp, strpos($avatar, "'", $tmp) - $tmp);
    $tmp = strpos($g, 'avatar/') + 7;
    $f = substr($g, $tmp, strpos($g, "?", $tmp) - $tmp);
    $w = get_bloginfo('wpurl');
    $e = ABSPATH .'avatar/'. $f .'.png';
    $t = 15*24*60*60; 
    if ( !is_file($e) || (time() - filemtime($e)) > $t ) 
        copy(htmlspecialchars_decode($g), $e);
    else  
        $avatar = strtr($avatar, array($g => $w.'/avatar/'.$f.'.png'));
    if ( filesize($e) < 500 ) 
        copy(AVATAR_DEFAULT, $e);
    return $avatar;
}


/* 
 * avatar
 * ====================================================
*/
function hui_get_avatar( $user_id='', $user_email='', $src=false, $size=50 ){
    $user_avtar = hui_user_avatar($user_id);
    if( $user_avtar ){
        $attr = 'data-original';
        if( $src ) $attr = 'src';
        return '<img class="avatar avatar-'.$size.' photo" width="'.$size.'" height="'.$size.'" '.$attr.'="'.$user_avtar.'">';
    }else{
        $avatar = get_avatar( $user_email, $size , AVATAR_DEFAULT);
        if( $src ){
            return $avatar;
        }else{
            return str_replace(' src=', ' data-original=', $avatar);
        }
    }
}


/* 
 * keywords
 * ====================================================
*/
function hui_keywords() {
  global $s, $post;
  $keywords = '';
  if ( is_single() ) {
    if ( get_the_tags( $post->ID ) ) {
      foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
    }
    foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
    if( _hui('post_keywords_description_s') ) {
        $the = trim(get_post_meta($post->ID, 'keywords', true));
        if( $the ) $keywords = $the;
    }else{
        $keywords = substr_replace( $keywords , '' , -2);
    }
    
  } elseif ( is_home () )    { $keywords = _hui('keywords');
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);

    if( _hui('cat_keyworks_s') ){
        $description = trim(strip_tags(category_description()));
        if( $description && strstr($description, '::::::') ){
            $desc = explode('::::::', $description);
            $keywords .= ','.trim($desc[0]);
        }
    }

  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
    echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}


/* 
 * description
 * ====================================================
*/
function hui_description() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
    if( _hui('post_keywords_description_s') ) {
        $the = trim(get_post_meta($post->ID, 'description', true));
        if( $the ) $description = $the;
    }
  } elseif ( is_home () )    { $description = _hui('description');
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { 

    $description = trim(strip_tags(category_description()));

    if( _hui('cat_keyworks_s') && $description && strstr($description, '::::::') ){
        $desc = explode('::::::', $description);
        $description = trim($desc[1]);
    }

  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' ".__('的搜索結果', 'haoui');
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 80, 'utf-8' );
  echo "<meta name=\"description\" content=\"$description\">\n";
}


/* 
 * smiliea src
 * ====================================================
*/
add_filter('smilies_src','hui_smilies_src',1,10); 
function hui_smilies_src ($img_src, $img, $siteurl){
    return THEME_URI.'/images/smilies/'.$img;
}


/* 
 * noself ping
 * ====================================================
*/
add_action('pre_ping','hui_noself_ping');
function hui_noself_ping( &$links ) {
    $home = get_option( 'home' );
    foreach ( $links as $l => $link )
    if ( 0 === strpos( $link, $home ) )
    unset($links[$l]);
}


/* 
 * mail from & name
 * ====================================================
*/
add_filter('wp_mail_from', 'hui_res_from_email');
function hui_res_from_email($email) {
    $wp_from_email = get_option('admin_email');
    return $wp_from_email;
}

add_filter('wp_mail_from_name', 'hui_res_from_name');
function hui_res_from_name($email){
    $wp_from_name = get_option('blogname');
    return $wp_from_name;
}


/* 
 * comment notify
 * ====================================================
*/
add_action('comment_post','comment_mail_notify'); 
function comment_mail_notify($comment_id) {
  $admin_notify = '1'; 
  $admin_email = get_bloginfo ('admin_email'); 
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  global $wpdb;
  if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
    $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
  if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
    $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
  $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
  $spam_confirmed = $comment->comment_approved;
  if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
    $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); 
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = 'Hi，您在 [' . get_option("blogname") . '] 的留言有人回复啦！';
    $message = '
    <div style="color:#333;font:100 14px/24px microsoft yahei;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回应:<br /> &nbsp;&nbsp;&nbsp;&nbsp; '
       . trim($comment->comment_content) . '<br /></p>
      <p>点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回应完整內容</a></p>
      <p>欢迎再次光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p style="color:#999">(此邮件由系统自动发出，请勿回复.)</p>
    </div>';
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
  }
}


/* 
 * comment mail notify checked
 * ====================================================
*/
add_action('comment_form','hui_add_checkbox');
function hui_add_checkbox() {
  echo '<label for="comment_mail_notify" class="checkbox inline hide" style="padding-top:0"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked"/>'.__('有人回复时邮件通知我', 'haoui').'</label>';
}


/* 
 * post copyright
 * ====================================================
*/
if( _hui('post_copyright_s') ){
    add_filter('the_content','hui_copyright');
}    
function hui_copyright($content) {
    // $content .= '<p>'.(_hui('post_from_s')?hui_get_post_from():'').'</p>'; 
    if( !is_page() ){
        $content.= '<p class="post-copyright">'._hui('post_copyright').'：<a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a> &raquo; <a href="'.get_permalink().'">'.get_the_title().get_the_subtitle().'</a></p>';
    }
    return $content;
}


/* 
 * timeago
 * ====================================================
*/
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return __('刚刚', 'haoui');
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  __('年前', 'haoui').' ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  __('个月前', 'haoui').' ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  __('周前', 'haoui').' ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  __('天前', 'haoui'),
        60 * 60                 =>  __('小时前', 'haoui'),
        60                      =>  __('分钟前', 'haoui'),
        1                       =>  __('秒前', 'haoui')
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}


/* 
 * admin comment Ctrl+Enter
 * ====================================================
*/
add_action('admin_footer', 'hui_admin_comment_ctrlenter');
function hui_admin_comment_ctrlenter(){
    echo '<script type="text/javascript">
        jQuery(document).ready(function($){
            $("textarea").keypress(function(e){
                if(e.ctrlKey&&e.which==13||e.which==10){
                    $("#replybtn").click();
                }
            });
        });
    </script>';
};


/* 
 * oauth
 * ====================================================
*/
$oauthArr = array(
    'qq' => 'QQ',
    'weibo' => '微博'
);

function hui_current_oauth($user_id=''){
    if( !$user_id ) $user_id = get_current_user_id();
    $oauth = get_user_meta( $user_id, 'is_oauth', true );
    if( $oauth ){
        global $oauthArr;
        return $oauthArr[$oauth];
    }else{
        return get_bloginfo('name').__('账号', 'haoui');
    }
}

function hui_user_avatar($user_id=''){
    if( !$user_id ) return false;
    $avatar = get_user_meta( $user_id, 'avatar', true );
    if( $avatar ){
        return $avatar;
    }else{
        return false;
    }
}


/* 
 * comment list 
 * ====================================================
*/
function hui_comment_list($comment, $args, $depth) {
  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  echo '<div class="c-avatar">'.hui_get_avatar( $comment->user_id, $comment->comment_author_email ).'</div>';
  echo '<div class="c-main" id="div-comment-'.get_comment_ID().'">';
    echo '<span class="c-author">'.get_comment_author_link().'</span>';
    echo str_replace(' src=', ' data-original=', convert_smilies(get_comment_text()));
    if ($comment->comment_approved == '0'){
      echo '<span class="c-approved">'.__('待审核', 'haoui').'</span>';
    }
    echo '<time class="c-time">'.timeago($comment->comment_date).'</time>'; 
    if ($comment->comment_approved !== '0')
        echo comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
  echo '</div>';
}


/* 
 * import javascript & css
 * ====================================================
*/
add_action('wp_enqueue_scripts', 'hui_load_scripts');
function hui_load_scripts() {
    if (!is_admin()) {
        wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/style.css', array(), THEME_VERSION, 'all' );
        wp_deregister_script( 'jquery' );
        wp_deregister_script( 'l10n' ); 

        $jss = array(
            'no' => array(
                'jquery' => THEME_URI.'/js/jquery.js',
                'bootstrap' => THEME_URI . '/js/bootstrap.js'
            ),
            'baidu' => array(
                'jquery' => 'http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js',
                'bootstrap' => 'http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js'
            ),
            '360' => array(
                'jquery' => 'http://libs.useso.com/js/jquery/2.0.0/jquery.min.js',
                'bootstrap' => 'http://libs.useso.com/js/bootstrap/3.2.0/js/bootstrap.min.js'
            ),
            'he' => array(
                'jquery' => '//code.jquery.com/jquery-2.0.0.min.js',
                'bootstrap' => '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'
            )
        );
        wp_register_script( 'jquery', _hui('js_outlink') ? $jss[_hui('js_outlink')]['jquery'] : THEME_URI.'/js/jquery.js', false, THEME_VERSION, (_hui('jquery_bom')?true:false) );
        wp_enqueue_script( '_bootstrap', _hui('js_outlink') ? $jss[_hui('js_outlink')]['bootstrap'] : THEME_URI . '/js/bootstrap.js', array('jquery'), THEME_VERSION, true );

        global $paged;
        if( !$paged && _hui('focusslide_s') && _hui('focusslide_s_m') ){
            wp_enqueue_script( '_hammer', THEME_URI . '/js/hammer.min.js', array(), THEME_VERSION, true );
        }
        
        wp_enqueue_script( '_custom', THEME_URI . '/js/custom.js', array(), THEME_VERSION, true );

    }
}


/* 
 * import style
 * ====================================================
*/
function hui_head_css() {

    $styles = '';

   /* $site_width = _hui('site_width');
    if( $site_width && $site_width !== '1280' ){
        $styles .= ".container{max-width:{$site_width}px}";
    }*/

    if( _hui('site_gray') ){
        $styles .= "html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}";
    }

    if( _hui('theme_skin_custom') ){
        $skin_option = _hui('theme_skin_custom');
        $skc = $skin_option;
    }else{
        $skin_option = _hui('theme_skin');
        $skc = '#'.$skin_option;
    }
    
    if( $skin_option && $skin_option !== 'FF5E52' ){
        $styles .= "a:hover, a:focus,.post-like.actived,.excerpt h2 a:hover,.user-welcome strong,.article-title a:hover,#comments b,.relates a:hover,.archives .item:hover h3,.linkcat h2,.sticky a:hover,.article-content a:hover,.nav li.current-menu-item > a, .nav li.current-menu-parent > a, .nav li.current_page_item > a, .nav li.current-posa,.article-meta a:hover,.excerpt h2 a span,.article-title a span,.most-comment-posts li > a span,.widget_postlist .items-01 .text span,.nav li a:hover,.gohome a{color:{$skc};}.widget .title strong{border-left: 5px solid {$skc};}.pagination ul > .active > a,.pagination ul > .active > span,.mainbar,.article-tags a,.search-form .btn,#bdcs .bdcs-search-form-submit,.widget_tags_inner a:hover:hover,.focusmo a:hover h4,.tagslist .tagname:hover,.pagination ul > li.next-page > a{background-color:{$skc};}.label-important,.badge-important{background-color:{$skc};}.label-important .label-arrow,.badge-important .label-arrow{border-left-color:{$skc};}.title strong{border-bottom-color:{$skc};}#submit{background: {$skc};border-right: 2px solid {$skc};border-bottom: 2px solid {$skc};}@media (max-width:720px){.ui-navtop .logo, .logo{background-color:{$skc};}.nav li.current-menu-item > a, .nav li.current-menu-parent > a, .nav li.current_page_item > a, .nav li.current-post-ancestor > a{border-bottom-color:$skc;}}";
    }

    $styles .= _hui('csscode');

    if( $styles ) echo '<style>'.$styles.'</style>';
}


/**
 * hui_get_post_date function
 *
 * @return date
 * ====================================================================================================
 **/
function hui_get_post_date($ptime='')
{
    if( empty($ptime) ){
        return false;
    }

    if( _hui('post_date_ago') ){
        return timeago($ptime);
    }

    $format = _hui('post_date_format');
    if( !$format ){
        $format = 'Y-m-d';
    }

    return date($format, strtotime($ptime));
}


/**
 * hui_get_filetype function
 *
 * @return date
 * ====================================================================================================
 **/
function hui_get_filetype($filename) {
    $exten = explode('.', $filename);
    return end($exten);
}