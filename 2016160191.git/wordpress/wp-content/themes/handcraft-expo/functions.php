<?php
	
// Handcraft Expo Functions

//Handcraft Expo CSS and JS resources

	function handcraft_expo_resources() {
		
		wp_enqueue_style('handcraft-expo-styles', get_stylesheet_uri());
		wp_enqueue_style('handcraft-expo-mobile-styles', get_template_directory_uri() . '/css/handcraft-expo-mobile-style.css');
		wp_enqueue_style('handcraft-expo-comments-styles', get_template_directory_uri() . '/css/handcraft-expo-comments.css');


	//Handcraft Expo conditional google fonts enqueued styles
		$handcraft_expo_google_protocol = is_ssl() ? 'https' : 'http';

		$handcraft_expo_TitleGoogleFontCheck = get_theme_mod('handcraft-expo_title_google_font');
		if ($handcraft_expo_TitleGoogleFontCheck){
			wp_enqueue_style('handcraft-expo-title-google-fonts', "$handcraft_expo_google_protocol://" . '//fonts.googleapis.com/css?family=' . esc_textarea(str_replace(' ', '+', $handcraft_expo_TitleGoogleFontCheck)));
		}

		$handcraft_expo_BodyGoogleFontCheck = get_theme_mod('handcraft-expo_body_google_font');
		if ($handcraft_expo_BodyGoogleFontCheck){
			wp_enqueue_style('handcraft-expo-body-google-fonts', "$handcraft_expo_google_protocol://" . '//fonts.googleapis.com/css?family=' . esc_textarea(str_replace(' ', '+', $handcraft_expo_BodyGoogleFontCheck)));
		}

		$handcraft_expo_PreviewerGoogleFontCheck = get_theme_mod('handcraft-expo_previewer_google_font');
		if ($handcraft_expo_PreviewerGoogleFontCheck){
			wp_enqueue_style('handcraft-expo-previewer-google-fonts', "$handcraft_expo_google_protocol://" . '//fonts.googleapis.com/css?family=' . esc_textarea(str_replace(' ', '+', $handcraft_expo_PreviewerGoogleFontCheck)));
		}


		if ( is_singular() ) {
			wp_enqueue_script( "comment-reply" );
		}		

		wp_enqueue_script( 'handcraft-expo-scripts', get_template_directory_uri() . '/js/handcraft_expo.js', array('jquery'), true );
		wp_enqueue_script( 'handcraft-expo-JQ-UI-scripts', get_template_directory_uri() . '/js/handcraft_expo_JQ_UI.js', array('jquery-effects-core'), true );
		wp_enqueue_script( 'handcraft-expo-JQ-UI-mobile_scripts', get_template_directory_uri() . '/js/handcraft_expo_mobile.js', array('jquery-effects-core'), true );
		
		$handcraft_expo_mainBannerCheck = get_theme_mod('handcraft-expo_main_banner_background', '');
	
		if ($handcraft_expo_mainBannerCheck != '') {
			wp_enqueue_script( 'menu_with_banner_script', get_template_directory_uri() . '/js/menu-with-banner.js', array('jquery'), true );
		}
	
		$handcraft_expo_previewerCheckVar = get_theme_mod('handcraft-expo_previewer_show', 1);
		$handcraft_expo_previewerSizeCheckVar = get_theme_mod('handcraft-expo_previewer_size_check', 'standard');
		
		if ($handcraft_expo_previewerCheckVar == 1 && $handcraft_expo_previewerSizeCheckVar == 'standard') {
			wp_enqueue_script( 'previewer_script', get_template_directory_uri() . '/js/previewer.js', array('jquery-effects-core'), true );
		}
		if ($handcraft_expo_previewerCheckVar == 1 && $handcraft_expo_previewerSizeCheckVar == 'full') {
			wp_enqueue_script( 'previewer_script', get_template_directory_uri() . '/js/previewer_full.js', array('jquery-effects-core'), true );
		}

		if (is_active_sidebar('widgets_sidebar')) {
			wp_enqueue_script( 'sidebar_scripts', get_template_directory_uri() . '/js/widgets_bar.js', array('jquery'), true );
		}

	}

	add_action('wp_enqueue_scripts', 'handcraft_expo_resources');


	// Handcraft Expo Fonts
	
	function handcraft_expo_fonts_selection($handcraft_expo_selected_font) {
		switch ($handcraft_expo_selected_font){
		    case 'georgia':
		        echo 'Georgia, serif';
		        break;
		        
		    case 'palatino':
		        echo '"Palatino Linotype", "Book Antiqua", Palatino, serif';
		        break;
		        
		    case 'times':
		        echo '"Times New Roman", Times, serif';
		        break;
		        
		    case 'arial':
		        echo 'Arial, Helvetica, sans-serif';
		        break;	 
		               
		    case 'arial_black':
		        echo '"Arial Black", Gadget, sans-serif';
		        break;	
		         	        
		    case 'comic':
		        echo '"Comic Sans MS", cursive, sans-serif';
		        break;	        
	
		    case 'impact':
		        echo 'Impact, Charcoal, sans-serif';
		        break;	  
	
		    case 'lucida':
		        echo '"Lucida Sans Unicode", "Lucida Grande", sans-serif';
		        break;
	
		    case 'tahoma':
		        echo 'Tahoma, Geneva, sans-serif';
		        break;	   
	
		    case 'trebuchet':
		        echo '"Trebuchet MS", Helvetica, sans-serif';
		        break;	 
	
		    case 'verdana':
		        echo 'Verdana, Geneva, sans-serif';
		        break;
	
		    case 'courier':
		        echo '"Courier New", Courier, monospace';
		        break;	    
	
		    case 'lucida':
		        echo '"Lucida Console", Monaco, monospace';
		        break;
	
		    case 'google_title':
		        echo esc_textarea(get_theme_mod('handcraft-expo_title_google_font')) . ', Helvetica, sans-serif';
		        break;

		    case 'google_body':
		        echo esc_textarea(get_theme_mod('handcraft-expo_body_google_font')) . ', Helvetica, sans-serif';
		        break;

		    case 'google_previewer':
		        echo esc_textarea(get_theme_mod('handcraft-expo_previewer_google_font')) . ', Helvetica, sans-serif';
		        break;


		    default:
		        echo 'Arial, Helvetica, sans-serif';
		}
	}


// Handcraft Expo Theme Setup		

	if ( ! isset($content_width)) {$content_width = 960; };


	// Categories listing

		function handcraft_expo_get_categories() {
			$handcraft_expo_categories = get_the_category();
			$handcraft_expo_separator = ', ';
			$handcraft_expo_categoriesOutput = '';

			if ($handcraft_expo_categories) { 
				echo __(' || Posted in: ', 'handcraft-expo');
				foreach ($handcraft_expo_categories as $handcraft_expo_category) {
				$handcraft_expo_categoriesOutput .= '<a href="' . get_category_link($handcraft_expo_category->term_id) . '">' . $handcraft_expo_category->cat_name . '</a>' . $handcraft_expo_separator;																					
			}
				echo trim($handcraft_expo_categoriesOutput, $handcraft_expo_separator);
			}
		}


	// Page children-ancestor Navigation

		function handcraft_expo_get_top_ancestor_page_id() {
			
			global $post;

			if ($post->post_parent) {
				$handcraft_expo_ancestors = array_reverse(get_post_ancestors($post->ID));
				return $handcraft_expo_ancestors[0];
			}
			return $post->ID;
		};


// Previewer latest post

		function handcraft_expo_GetPreviewerPost() {
		
			$handcraft_expo_previewerBlogPosts = new WP_Query('posts_per_page=1');
			if ($handcraft_expo_previewerBlogPosts->have_posts() ) :
				while ($handcraft_expo_previewerBlogPosts->have_posts()) : $handcraft_expo_previewerBlogPosts->the_post();
				$handcraft_expo_previewerCheckVar = get_theme_mod('handcraft-expo_previewer_show', 1);
				if ($handcraft_expo_previewerCheckVar == 1) { ?>
						<h3><?php echo strip_tags(the_title()); ?></h3>
		<?php
			if (! post_password_required()) { ?>
					<article class="posts-meta"><?php echo __(' by', 'handcraft-expo'); ?> <?php the_author(); ?><?php echo __(' on ', 'handcraft-expo'); ?><?php the_time('F jS, Y'); ?><?php echo __(' at ', 'handcraft-expo'); ?><?php the_time('g:i a'); ?>. 
					</article>
		<?php } ?>
		<?php if (has_post_thumbnail()) { ?>
						<div class="blog-showcase-thumbnails"><?php the_post_thumbnail('medium'); ?>
						</div>
		<?php } ?>
						<p><div><?php $handcraft_expo_previewerBlogText = get_the_content(); echo strip_tags($handcraft_expo_previewerBlogText); ?></div>	
		<?php }
				endwhile;
				else : ?>
						<h2 class="not-found"><?php echo __('Ooops! No content found!', 'handcraft-expo'); ?></h2>
						<h3 class="not-found-2"><?php echo __('You might want to go back to the', 'handcraft-expo'); ?> <a href="<?php echo home_url(); ?>"><?php echo __('homepage', 'handcraft-expo'); ?></a>.</h3>	
		<?php	endif;
			wp_reset_postdata(); ?>
					</div>
<?php	};


	// Handcraft Expo editor style

		function handcraft_expo_add_editor_styles() {
	
			add_editor_style('editor-style.css');

		}

		add_action( 'admin_init', 'handcraft_expo_add_editor_styles' );

	// Handcraft Expo Theme Support

		function handcraft_expo_setup() {


	// WP HTML 5 support

		$handcraft_expo_html5 = array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		);

		add_theme_support('html5', $handcraft_expo_html5);


	// Handcraft Expo Navigation Menus

		register_nav_menus(array(
			'handcraft-expo_main_menu' => __('Handcraft Expo Main Menu', 'handcraft-expo')
		));

		register_nav_menus(array(
			'handcraft-expo_mobile_main_menu' => __('Handcraft Expo Pocket Menu', 'handcraft-expo')
		));


	// Auto feeds

		add_theme_support('automatic-feed-links');


		// Featured Images support

			add_theme_support('post-thumbnails');

		// logo support

			add_theme_support("custom-logo");
			function handcraft_expo_custom_logo() {
				if (function_exists( 'the_custom_logo' )) {
					the_custom_logo();
				}
			}

		// title-tag support

			add_theme_support( "title-tag" );

		}
		
				add_action('after_setup_theme', 'handcraft_expo_setup');


	// Handcraft Expo page templates custom CSS classes
	function handcraft_expo_templates_classes($classes) {
		if ( is_single() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'single-no-sidebar';
		}
		if ( is_single() && is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'single-active-sidebar';
		}
		if ( is_page() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-no-sidebar';
		}
		if ( is_home() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'home-no-sidebar';
		}
		if ( is_archive() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'archive-no-sidebar';
		}
		if ( is_search() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'search-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-2-columns-template.php') && have_posts() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-2col-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-page-template.php') && have_posts() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-standard-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-frontpage-template.php') && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-front-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-page-notitle-template.php') && have_posts() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-nt-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-transparent-page-template.php') && have_posts() && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'page-trs-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-blog-template.php') && ! is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'blog-no-sidebar';
		}
		if ( is_page_template('templates/handcraft-expo-blog-template.php') && is_active_sidebar('widgets_sidebar') ) {
			$classes[] = 'blog-active-sidebar';
		}
		return $classes;
	}
	add_filter('body_class', 'handcraft_expo_templates_classes');


	// Replaces the excerpt "more" text with a link

	function handcraft_expo_excerpt_more($more) {
		
		global $post;
		$handcraft_expo_ReadMore = __('continue...', 'handcraft-expo');
		
		return '<a class="moretag" href="'. get_permalink($post->ID) . '">'. $handcraft_expo_ReadMore . '</a>';
	}
	
	add_filter('excerpt_more', 'handcraft_expo_excerpt_more');


	// Website Titles
		
		function handcraft_expo_titles($handcraft_expo_Titles) {
			
			$handcraft_expo_Titles .= ' || ';
			$handcraft_expo_Titles .= get_bloginfo('name', 'display');
			
			if (is_home() || is_front_page()) {
				$handcraft_expo_defaultHomeTitle = get_bloginfo('name', 'display');
				return $handcraft_expo_defaultHomeTitle;
			}
			
			elseif (empty($handcraft_expo_Titles) && (is_home() || is_front_page())) {
				return __( 'Home', 'handcraft-expo' ) . ' || ' . get_bloginfo( 'description' );
			}
			
			else {
				return $handcraft_expo_Titles;
				
			}
			
		};

		add_filter('wp_title', 'handcraft_expo_titles');
		

// Handcraft Expo Widgets Sidebar

		function handcraft_expo_widgets() {

			register_sidebar( array(
			'name' => esc_html__('Widgets Pocket', 'handcraft-expo'),
			'id' => 'widgets_mobile',
			'before_widget' => '<div class="widget-items">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
			));
			
			register_sidebar( array(
			'name' => esc_html__('Widgets Sidebar', 'handcraft-expo'),
			'id' => 'widgets_sidebar',
			'before_widget' => '<div class="widget-items">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
			));

			register_sidebar( array(
			'name' => esc_html__('Widgets Top', 'handcraft-expo'),
			'id' => 'widgets_bar_top',
			'before_widget' => '<div class="widget-items">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
			));

			register_sidebar( array(
			'name' => esc_html__('Widgets Bottom', 'handcraft-expo'),
			'id' => 'widgets_bar_bottom',
			'before_widget' => '<div class="widget-items">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
			));

		}

		add_action('widgets_init', 'handcraft_expo_widgets');


// Handcraft Expo translations

	load_theme_textdomain('handcraft-expo', get_template_directory_uri() . '/languages');


// Handcraft Expo Customizable Options

	function handcraft_expo_customize_register($wp_customize) {


	// $wp_customize standard items

		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// $wp_customize Handcraft Expo Settings

		$wp_customize->add_setting('handcraft-expo_custom_logo_pocket_size', array(
			'default'           => '80',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage'
		));

		$wp_customize->add_setting('handcraft-expo_custom_logo_size', array(
			'default'           => '80',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage'
		));

		$wp_customize->add_setting('handcraft-expo_background', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'postMessage',
		));
		
		$wp_customize->add_setting('handcraft-expo_main_banner_background', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_banner_image_cover', array(
			'default' => 'cover',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_background_image_X_position', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_background_image_Y_position', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_background_image_scroll_check', array(
			'default' => 'fixed',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_background_image_cover', array(
			'default' => 'contain',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_banner_image_X_position', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_banner_image_Y_position', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_position', array(
			'default' => 'left',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_page_title_position', array(
			'default' => 'as_banner',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_content_footer_image', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_content_footer_image_rotate', array(
			'default' => '12',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));	

		$wp_customize->add_setting('handcraft-expo_title_font_size', array(
			'default' => '350',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_position_X', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));
		
		$wp_customize->add_setting('handcraft-expo_title_position_Y', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_hover_effect', array(
			'default' => 'color_scale',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_title_hover_scale_effect', array(
			'default' => '0.9',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_title_hover_rotate_effect', array(
			'default' => '0.01',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_font_size', array(
			'default' => '180',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_position_X', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_position_Y', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_custom_copyright', array(
			'default' => __('Empowered by <a href="https://wordpress.org/">WordPress</a>', 'handcraft-expo'),
			'sanitize_callback' => 'wp_kses_post',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_color', array(
			'default' => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_color', array(
			'default' => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_background_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_background_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_title_background', array(
			'default' => '#545454',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_tagline_background', array(
			'default' => '#545454',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_background_color', array(
			'default' => '#23282d',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_links_background_color', array(
			'default' => '#8f8404',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_links_color', array(
			'default' => '#bababa',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_page_links_color', array(
			'default' => '#c4c103',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_left_sidebar_color', array(
			'default' => '#8f8404',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_main_text_color', array(
			'default' => '#a3a3a3',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_content_background_color', array(
			'default' => '#1d2126',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_main_sidebar_opacity', array(
			'default' => '100',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_menu_sidebar_switch', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_menu_sidebar_gradient', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_menu sidebar_border_show', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_menubar_border_size', array(
			'default' => '1.8',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_links_size', array(
			'default' => '180',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_menu_links_alignment', array(
			'default' => 'center',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_social_icons_set_check_setting', array(
			'default' => 'bright',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_icons_position', array(
			'default' => 'below_logo',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_rss_check_1', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_facebook_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_facebook_link_setting', array(
			'default' => 'https://www.facebook.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_twitter_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_twitter_link_setting', array(
			'default' => 'https://www.twitter.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_google_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_google_link_setting', array(
			'default' => 'https://www.google.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_google_plus_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_google_plus_link_setting', array(
			'default' => 'https://www.google.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_instagram_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_instagram_link_setting', array(
			'default' => 'https://www.instagram.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_youtube_setting', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_youtube_link_setting', array(
			'default' => 'https://www.youtube.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$handcraft_expo_YourWebsiteDefault = get_stylesheet_directory_uri() . '/img/icons/social/your_site.png';

		$wp_customize->add_setting('handcraft-expo_social_custom_1_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_1', array(
			'default' => 'https://www.yoursite1.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_1_img', array(
			'default' => $handcraft_expo_YourWebsiteDefault,
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_2_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_2', array(
			'default' => 'https://www.yoursite2.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_2_img', array(
			'default' => $handcraft_expo_YourWebsiteDefault,
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_3_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_3', array(
			'default' => 'https://www.yoursite3.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_3_img', array(
			'default' => $handcraft_expo_YourWebsiteDefault,
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_4_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_4', array(
			'default' => 'https://www.yoursite4.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_4_img', array(
			'default' => $handcraft_expo_YourWebsiteDefault,
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_5_check', array(
			'default' => 0,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_5', array(
			'default' => 'https://www.yoursite5.com',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_social_custom_5_img', array(
			'default' => $handcraft_expo_YourWebsiteDefault,
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_title_show', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_author_display', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_date_display', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_time_display', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_categories_display', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_tags_display', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_title_font_type', array(
			'default' => 'arial',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_title_google_font', array(
			'default' => '',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_body_font_type', array(
			'default' => 'arial',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_body_google_font', array(
			'default' => '',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_main_font_size', array(
			'default' => '1',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_font_type', array(
			'default' => 'arial',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_google_font', array(
			'default' => '',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_font_size', array(
			'default' => '100',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_font_color', array(
			'default' => '#cecece',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_show', array(
			'default' => 1,
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_size_check', array(
			'default' => 'standard',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_blog_position', array(
			'default' => 'none',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_offset_X', array(
			'default' => '0',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_offset_Y', array(
			'default' => '20',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_background_color', array(
			'default' => '#1d2126',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_shadow_color', array(
			'default' => '#111111',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_background_image', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_1', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_1_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_2', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_2_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_3', array(
			'default' => __('describe your menu link here', 'handcraft-expo'),
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_3_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_4', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_4_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_5', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_5_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_6', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_6_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_7', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_7_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_8', array(
			'default' => 'describe your menu link here',
			'sanitize_callback' => 'esc_textarea',
			'transport' => 'postMessage',
		));

		$wp_customize->add_setting('handcraft-expo_previewer_text_8_img', array(
			'default' => '',
			'sanitize_callback' => 'esc_url',
			'transport' => 'refresh',
		));

		$wp_customize->add_setting('handcraft-expo_custom_css', array(
			'default' => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
			'transport' => 'postMessage',
		));

	// $wp_customize Handcraft Expo Sections

		$wp_customize->add_section('handcraft-expo_background', array(
			'title'       => __('Banner & Background', 'handcraft-expo'),
			'description' => __('Choose a banner, an image and a color for your website background. Banner images will display on top of the page and will force the background picture to be displayed on content area.', 'handcraft-expo'),
			'priority'    => 50,
		));

		$wp_customize->add_section('handcraft-expo_pages', array(
			'title'       => __('Posts & Pages', 'handcraft-expo'),
			'description' => __('How to display posts and pages on your website.', 'handcraft-expo'),
			'priority'    => 50,
		));

		$wp_customize->add_section('handcraft-expo_menu_items', array(
			'title'       => __('Menu Sidebar', 'handcraft-expo'),
			'description' => __("Choose Menu Bar's transparency level, its border and font size for Menu Links. Note: smaller devices will automatically adapt.", "handcraft-expo"),
			'priority'    => 60,
		));

		$wp_customize->add_section('handcraft-expo_social_section', array(
			'title'       => __('Socials and affiliated', 'handcraft-expo'),
			'description' => __('Add links to your social platforms and/or affiliated websites and activate them to show their icons. Note: Handcraft Expo suggests 24x24 or - same as the defalut pre-installed - 32x32 icons ONLY. Facebook&reg;, Twitter&reg;, Google&reg;, Google Plus&reg;, YouTube&reg; and Instagram&reg; are registred trademarks of the respective owners.', 'handcraft-expo'),
			'priority'    => 50,
		));

		$wp_customize->add_section('handcraft-expo_previewer', array(
			'title'       => __('Previewer', 'handcraft-expo'),
			'description' => __('Previewer is a tool that offers your visitor an animated page preview by hovering on a Menu Link. Previewer gives you up to 8 text description fields and you can add a picture on any of them.', 'handcraft-expo'),
			'priority'    => 50,
		));

		$wp_customize->add_section('handcraft-expo_your_css', array(
			'title'       => __('Custom CSS', 'handcraft-expo'),
			'priority'    => 120,
		));

	// $wp_customize Handcraft Expo Controls

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_show_control', array(
			'label'    => __( 'Show Title and Tagline:', 'handcraft-expo' ),
			'description' => __('Note: When "On Banner" is selected, title and tagline will be visible ONLY if you select a banner image first (Background -> Banner Image).', 'handcraft-expo'),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_show',
			'type'     => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_custom_logo_pocket_size_controller', array(
			'label'       => __('Logo size - Pocket', 'handcraft-expo'),
			'description' => __('On smaller devices', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_custom_logo_pocket_size',
			'priority'    => 8,
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => 25,
				'max'              => 100,
				'range'            => 2
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_custom_logo_size_controller', array(
			'label'       => __('Logo size - Standard', 'handcraft-expo'),
			'description' => __(' On standard devices', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_custom_logo_size',
			'priority'    => 8,
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => 25,
				'max'              => 100,
				'range'            => 2
			)
		)));

		$handcraft_expo_TitleGoogleFontCheck = get_theme_mod('handcraft-expo_title_google_font');
		$handcraft_expo_TitleGoogleFontPush = array(
				'georgia'       => __('Georgia', 'handcraft-expo'),
				'palatino'      => __('Palatino', 'handcraft-expo'),
				'times'         => __('Times New Roman', 'handcraft-expo'),
				'arial'         => __('Arial', 'handcraft-expo'),
				'arial_black'   => __('Arial Black', 'handcraft-expo'),
				'comic'         => __('Comic Sans', 'handcraft-expo'),
				'impact'        => __('Impact', 'handcraft-expo'),
				'lucida'        => __('Lucida Sans Unicode', 'handcraft-expo'),
				'tahoma'        => __('Tahoma', 'handcraft-expo'),
				'trebuchet'     => __('Trebuchet', 'handcraft-expo'),
				'verdana'       => __('Verdana', 'handcraft-expo'),
				'courier'       => __('Courier New', 'handcraft-expo'),
				'lucida'        => __('Lucida Console', 'handcraft-expo')
		      );
		if ($handcraft_expo_TitleGoogleFontCheck){
			$handcraft_expo_TitleGoogleFontPush['google_title'] = esc_textarea($handcraft_expo_TitleGoogleFontCheck);
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_font_type_control', array(
			'label'    => __('Title font:', 'handcraft-expo'),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_font_type',
			'type'     => 'select',
			'choices'  => $handcraft_expo_TitleGoogleFontPush
		)));

		if ($handcraft_expo_TitleGoogleFontCheck){
			$wp_customize->get_control( 'handcraft-expo_title_font_type_control' )->choices = $handcraft_expo_TitleGoogleFontPush;
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_google_font_controller', array(
         'label'          => __('Google&reg; font:', 'handcraft-expo'),
         'description'    => __('Type here your Google&reg; font name, <strong>save</strong> and <strong>refresh</strong> to add it to the title font list above. Google&reg; is a registered trademark of the respective owner.', 'handcraft-expo'),
         'section'        => 'title_tagline',
         'settings'       => 'handcraft-expo_title_google_font',
         'type'           => 'text',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_position_control', array(
			'label'    => __( 'Title Position:', 'handcraft-expo'),
			'description' => __('Note: When "On Banner" is selected, title and tagline will be visible ONLY if you select a banner image first (Background -> Banner Image).', 'handcraft-expo'),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_position',
			'type'     => 'select',
			'choices'  => array(
				'banner'        => __('On Banner', 'handcraft-expo'),
				'left'          => __( 'Menu Bar' , 'handcraft-expo'),
				'center'        => __( 'Main Page' , 'handcraft-expo'),
			),
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_title_color_control', array(
			'label'       => __('Title Color:', 'handcraft-expo'),
			'description' =>__('Note: title color will change content links hovering color as well.', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_title_color',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_background_check_control', array(
			'label'    => __( 'Show title background:', 'handcraft-expo' ),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_background_check',
			'type'     => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'handcraft-expo_title_background_control', array(
			'label'    => __( 'Title background color:', 'handcraft-expo' ),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_background',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_font_size_control', array(
			'label'       => __('Title font size:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_title_font_size',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => 50,
				'max'              => 700,
				'step'             => 10,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_position_X_control', array(
			'label'       => __('Title horizontal offset:', 'handcraft-expo'),
			'description' => __('Note: "Pocket" layout will always display centered title and tagline.', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_title_position_X',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => -60,
				'max'              => 60,
				'step'             => 0.5,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_position_Y_control', array(
			'label'       => __('Title vertical offset:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_title_position_Y',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => -20,
				'max'              => 20,
				'step'             => 0.5,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_hover_effect_control', array(
			'label'    => __('Title hover effect:', 'handcraft-expo'),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_title_hover_effect',
			'type'     => 'select',
			'choices'  => array(
				'none'                      => __('None', 'handcraft-expo'),
				'color'                     => __('Color', 'handcraft-expo'),
				'color_scale'               => __('Color, scale and rotate', 'handcraft-expo'),
				'color_scale_border_rotate' => __('Full', 'handcraft-expo'),
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_hover_scale_effect_control', array(
			'label'       => __('Title SCALE effect amount:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'description' => __('Note: ONLY active when either "Color, scale and rotate" or "Full" or title hover effect is selected.', 'handcraft-expo'),
			'settings'    => 'handcraft-expo_title_hover_scale_effect',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => 0,
				'max'              => 5,
				'step'             => 0.1,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_title_hover_rotate_effect_control', array(
			'label'       => __('Title ROTATE effect amount:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'description' => __('Note: ONLY active when either "Color, scale and rotate" or "Full" or title hover effect is selected.', 'handcraft-expo'),
			'settings'	  => 'handcraft-expo_title_hover_rotate_effect',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => -180,
				'max'              => 180,
				'step'             => 3,
			)
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_tagline_color_control', array(
			'label'    => __('Tagline Color:', 'handcraft-expo'),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_tagline_color',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_tagline_background_check_control', array(
			'label'    => __( 'Show tagline background:', 'handcraft-expo' ),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_tagline_background_check',
			'type'     => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'handcraft-expo_tagline_background_control', array(
			'label'    => __( 'Tagline background color:', 'handcraft-expo' ),
			'section'  => 'title_tagline',
			'settings' => 'handcraft-expo_tagline_background',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_tagline_font_size_control', array(
			'label'       => __('Tagline font size:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_tagline_font_size',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => 30,
				'max'              => 600,
				'step'             => 10,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_tagline_position_X_control', array(
			'label'       => __('Tagline horizontal offset:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_tagline_position_X',
			'type'        => 'range',
			'input_attrs' => array(
				'min'   => -60,
				'max'   => 60,
				'step'  => 0.5,
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_tagline_position_Y_control', array(
			'label'       => __('Tagline vertical offset:', 'handcraft-expo'),
			'section'     => 'title_tagline',
			'settings'    => 'handcraft-expo_tagline_position_Y',
			'type'        => 'range',
			'input_attrs' => array(
				'min'   => -20,
				'max'   => 20,
				'step'  => 0.5,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_custom_copyright_control', array(
         'label'       => __('Copyright notice:', 'handcraft-expo'),
         'section'     => 'title_tagline',
         'settings'    => 'handcraft-expo_custom_copyright',
         'type'        => 'textarea',
		)));
		
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_main_banner_background_control', array(
			'label'    => __('Banner Image:', 'handcraft-expo'),
			'default'  => '',
			'section'  => 'handcraft-expo_background',
			'settings' => 'handcraft-expo_main_banner_background',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_banner_image_cover_control', array(
			'label'       => __('Banner Position:', 'handcraft-expo'),
			'section'     => 'handcraft-expo_background',
			'settings'    => 'handcraft-expo_banner_image_cover',
			'type'        => 'select',
			'choices'     => array(
				'cover'            => __('Cover', 'handcraft-expo'),
				'contain'          => __('Contain', 'handcraft-expo'),
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_banner_image_X_position_control', array(
			'label'       => __('On Contain: Banner image horizontal offset:', 'handcraft-expo'),
			'section'     => 'handcraft-expo_background',
			'settings'    => 'handcraft-expo_banner_image_X_position',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => -10,
				'max'              => 110,
				'step'             => 2,
			)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_banner_image_Y_position_control', array(
			'label'       => __('On Cover: Banner image vertical offset:', 'handcraft-expo'),
			'section'     => 'handcraft-expo_background',
			'settings'    => 'handcraft-expo_banner_image_Y_position',
			'type'        => 'range',
			'input_attrs' => array(
				'min'              => -100,
				'max'              => 100,
				'step'             => 2,
			)
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_background_color_control', array(
			'label' => __('Background Color:', 'handcraft-expo'),
			'section' => 'handcraft-expo_background',
			'settings' => 'handcraft-expo_background_color',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_background_control', array(
         'label'      => __( 'Background Image:', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_background',
         'settings'   => 'handcraft-expo_background',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_background_image_scroll_check_control', array(
         		'label'          => __( 'Display:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_background',
         		'settings'       => 'handcraft-expo_background_image_scroll_check',
         		'type'           => 'select',
         		'choices'        => array(
         			'fixed'       => __('Fixed', 'handcraft-expo'),
         			'scroll'      => __('Scroll', 'handcraft-expo'),
         		)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_background_image_cover_control', array(
         		'label'          => __('Background Position:', 'handcraft-expo'),
         		'section'        => 'handcraft-expo_background',
         		'settings'       => 'handcraft-expo_background_image_cover',
         		'type'           => 'select',
         		'choices'        => array(
         			'cover'       => __('Cover', 'handcraft-expo'),
         			'contain'      => __('Contain', 'handcraft-expo'),
         		)
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_background_image_X_position_control', array(
		    'label'			  => __('On Contain: Background horizontal offset:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_background',
			 'settings'		  => 'handcraft-expo_background_image_X_position',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => -500,
		        'max'   => 500,
		        'step'  => 2,
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_background_image_Y_position_control', array(
		    'label'			  => __('On Cover: Background vertical offset:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_background',
			 'settings'		  => 'handcraft-expo_background_image_Y_position',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => -800,
		        'max'   => 800,
		        'step'  => 2,
		        )
		)));
	
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_page_title_position_control', array(
		    'label'			  => __('Display page titles:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_pages',
		    'description'   => __('Select titles position on standard pages.', 'handcraft-expo'),
			 'settings'		  => 'handcraft-expo_page_title_position',
		    'type'          => 'select',
		    'choices'   => array(
		        'as_banner'   => __('As banner', 'handcraft-expo'),
		        'as_content'   => __('As content', 'handcraft-expo'),
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_author_display_control', array(
			'label'       => __( 'Display post author', 'handcraft-expo' ),
			'section'     => 'handcraft-expo_pages',
			'settings'    => 'handcraft-expo_author_display',
			'type'        => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_date_display_control', array(
			'label'       => __( 'Display post date', 'handcraft-expo' ),
			'description' => __( '<strong>Note:</strong> Posts with no title won\'t be reachable if unchecked.', 'handcraft-expo' ),
			'section'     => 'handcraft-expo_pages',
			'settings'    => 'handcraft-expo_date_display',
			'type'        => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_time_display_control', array(
			'label'       => __( 'Display post time', 'handcraft-expo' ),
			'section'     => 'handcraft-expo_pages',
			'settings'    => 'handcraft-expo_time_display',
			'type'        => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_categories_display_control', array(
			'label'       => __( 'Display post categories', 'handcraft-expo' ),
			'section'     => 'handcraft-expo_pages',
			'settings'    => 'handcraft-expo_categories_display',
			'type'        => 'checkbox'
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_tags_display_control', array(
			'label'       => __( 'Display post tags', 'handcraft-expo' ),
			'section'     => 'handcraft-expo_pages',
			'settings'    => 'handcraft-expo_tags_display',
			'type'        => 'checkbox'
		)));

		$handcraft_expo_BodyGoogleFontCheck = get_theme_mod('handcraft-expo_body_google_font');
		$handcraft_expo_BodyGoogleFontPush = array(
				'georgia'       => __('Georgia', 'handcraft-expo'),
				'palatino'      => __('Palatino', 'handcraft-expo'),
				'times'         => __('Times New Roman', 'handcraft-expo'),
				'arial'         => __('Arial', 'handcraft-expo'),
				'arial_black'   => __('Arial Black', 'handcraft-expo'),
				'comic'         => __('Comic Sans', 'handcraft-expo'),
				'impact'        => __('Impact', 'handcraft-expo'),
				'lucida'        => __('Lucida Sans Unicode', 'handcraft-expo'),
				'tahoma'        => __('Tahoma', 'handcraft-expo'),
				'trebuchet'     => __('Trebuchet', 'handcraft-expo'),
				'verdana'       => __('Verdana', 'handcraft-expo'),
				'courier'       => __('Courier New', 'handcraft-expo'),
				'lucida'        => __('Lucida Console', 'handcraft-expo')
		      );
		if ($handcraft_expo_BodyGoogleFontCheck){
			$handcraft_expo_BodyGoogleFontPush['google_body'] = esc_textarea($handcraft_expo_BodyGoogleFontCheck);
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_body_font_type_control', array(
		    'label'			  => __('Posts & Pages main font:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_pages',
			 'settings'		  => 'handcraft-expo_body_font_type',
		    'type'          => 'select',
		    'choices'       => $handcraft_expo_BodyGoogleFontPush
		)));

		if ($handcraft_expo_BodyGoogleFontCheck){
			$wp_customize->get_control( 'handcraft-expo_body_font_type_control' )->choices = $handcraft_expo_BodyGoogleFontPush;
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_body_google_font_controller', array(
         'label'          => __('Google&reg; font:', 'handcraft-expo'),
         'description'    => __('Type here your Google&reg; font name, <strong>save</strong> and <strong>refresh</strong> to add it to the Posts & Pages main font list above. Google&reg; is a registered trademark of the respective owner.', 'handcraft-expo'),
         'section'        => 'handcraft-expo_pages',
         'settings'       => 'handcraft-expo_body_google_font',
         'type'           => 'text',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_main_font_size_control', array(
		    'label'			  => __('Posts & Pages font size:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_pages',
			 'settings'		  => 'handcraft-expo_main_font_size',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 0.1,
		        'max'   => 3,
		        'step'  => 0.1,
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_content_footer_image_control', array(
         'label'         => __( 'Choose a content footer image:', 'handcraft-expo' ),
         'section'       => 'handcraft-expo_pages',
         'description'   => __('Note: Handcraft Expo suggests to use ONLY images with low opacity and high transparency and contrast in order to resemble a watermark effect.', 'handcraft-expo'),
         'settings'      => 'handcraft-expo_content_footer_image',
		)));		
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_content_footer_image_rotate_control', array(
		    'label'			  => __('Rotate image:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_pages',
			 'settings'		  => 'handcraft-expo_content_footer_image_rotate',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => -90,
		        'max'   => 90,
		        'step'  => 2,
		        )
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_main_text_color_control', array(
			'label' => __('Content text:', 'handcraft-expo'),
			'section' => 'colors',
			'description'    => __('Note: changes content background shadow as well.', 'handcraft-expo'),
			'settings' => 'handcraft-expo_main_text_color',
		)));
		
		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_content_background_color_control', array(
			'label' => __('Content background:', 'handcraft-expo'),
			'section' => 'colors',
			'settings' => 'handcraft-expo_content_background_color',
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_links_color_control', array(
			'label' => __('Side Menu Links:', 'handcraft-expo'),
			'section' => 'colors',
			'settings' => 'handcraft-expo_links_color',
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_links_background_color_control', array(
			'label' => __('Side Menu Links Hovering Background:', 'handcraft-expo'),
			'section' => 'colors',
			'settings' => 'handcraft-expo_links_background_color',
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_page_links_color_control', array(
			'label' => __('Page Links:', 'handcraft-expo'),
			'section' => 'colors',
			'settings' => 'handcraft-expo_page_links_color',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_menu_sidebar_switch_control', array(
         'label'          => __( 'Sidebar toggle button:', 'handcraft-expo' ),
			'description'    => __('Shows a button to show/hide the Menu Sidebar', 'handcraft-expo'),
         'section'        => 'handcraft-expo_menu_items',
         'settings'       => 'handcraft-expo_menu_sidebar_switch',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_main_sidebar_opacity_control', array(
		    'label'			  => __('Main Sidebar opacity:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_menu_items',
			 'settings'		  => 'handcraft-expo_main_sidebar_opacity',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 0,
		        'max'   => 1,
		        'step'  => 0.01,
		        )
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_menu_sidebar_gradient_control', array(
         'label'          => __( 'Show Sidebar gradient:', 'handcraft-expo' ),
			'description'    => __('Suggested if using a full-screen background image. Note: NOT visible when a banner image is used.', 'handcraft-expo'),
         'section'        => 'handcraft-expo_menu_items',
         'settings'       => 'handcraft-expo_menu_sidebar_gradient',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_menu sidebar_border_show_control', array(
         'label'          => __( 'Show Sidebar border:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_menu_items',
         'settings'       => 'handcraft-expo_menu sidebar_border_show',
         'type'           => 'checkbox',
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_menubar_border_size_control', array(
		    'label'			  => __('Sidebar border Size:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_menu_items',
		    'description'   => __('Note: affects also sub-menus border.', 'handcraft-expo'),
			 'settings'		  => 'handcraft-expo_menubar_border_size',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 1,
		        'max'   => 20,
		        'step'  => 0.1,
		        )
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_left_sidebar_color_control', array(
			'label' => __('Sidebar Border:', 'handcraft-expo'),
			'section' => 'handcraft-expo_menu_items',
			'settings' => 'handcraft-expo_left_sidebar_color',
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_links_size_control', array(
		    'label'			  => __('Menu Links Size:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_menu_items',
			 'settings'		  => 'handcraft-expo_links_size',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 80,
		        'max'   => 300,
		        'step'  => 1,
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_menu_links_alignment_control', array(
			'label'    => __( 'Menu Links Alignment:', 'handcraft-expo'),
			'section'  => 'handcraft-expo_menu_items',
			'settings' => 'handcraft-expo_menu_links_alignment',
			'type'     => 'select',
			'choices'  => array(
				'left'          => __( 'Left' , 'handcraft-expo'),
				'center'        => __( 'Center' , 'handcraft-expo'),
				'right'        => __( 'Right' , 'handcraft-expo'),
			),
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_icons_set_check_control', array(
         		'label'          => __('Icons set:', 'handcraft-expo'),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_icons_set_check_setting',
         		'type'           => 'select',
         		'choices'        => array(
         			'bright'       => __('Bright', 'handcraft-expo'),
         			'dark'      => __('Dark', 'handcraft-expo'),
         		)
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_icons_position_control', array(
		    'label'			  => __('Social Icons Position:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_social_section',
			 'settings'		  => 'handcraft-expo_social_icons_position',
		    'type'          => 'select',
		    'choices'   => array(
		        'top'   => __('Top', 'handcraft-expo'),
		        'below_title'   => __('Below Title', 'handcraft-expo'),
		        'below_tag'   => __('Below Tagline', 'handcraft-expo'),
		        'below_logo'   => __('Below Logo', 'handcraft-expo'),
		        'below_menu'  => __('Below Menu', 'handcraft-expo'),
		        )
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_rss_check_1_control', array(
         		'label'          => __( 'Show RSS2 feeds:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_rss_check_1',
         		'type'           => 'checkbox',
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_facebook_control', array(
         'label'          => __( 'Show Facebook Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_facebook_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_facebook_link_control', array(
         'label'          => __( 'Facebook Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_facebook_link_setting',
         'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_twitter_control', array(
         'label'          => __( 'Show Twitter Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_twitter_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_twitter_link_control', array(
         'label'          => __( 'Twitter Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_twitter_link_setting',
         'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_google_control', array(
         'label'          => __( 'Show Google Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_google_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_google_link_control', array(
         'label'          => __( 'Google Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_google_link_setting',
         'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_google_plus_control', array(
         'label'          => __( 'Show Google Plus Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_google_plus_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_google_plus_link_control', array(
         'label'          => __( 'Google Plus Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_google_plus_link_setting',
         'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_instagram_control', array(
         'label'          => __( 'Show Instagram Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_instagram_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_instagram_link_control', array(
         'label'          => __( 'Instagram Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_instagram_link_setting',
         'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_youtube_control', array(
         'label'          => __( 'Show YouTube Icon:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_youtube_setting',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_youtube_link_control', array(
         'label'          => __( 'YouTube Link:', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_social_section',
         'settings'       => 'handcraft-expo_youtube_link_setting',
         'type'           => 'url',
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_1_check_control', array(
         		'label'          => __( 'Show custom site 1:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_1_check',
         		'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_1_control', array(
         		'label'          => __( 'Your custom site 1:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_1',
         		'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_social_custom_1_img_control', array(
			'label' => __('Custom site 1 logo:', 'handcraft-expo'),
			'default' => '',
			'section' => 'handcraft-expo_social_section',
			'settings' => 'handcraft-expo_social_custom_1_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_2_check_control', array(
         		'label'          => __( 'Show custom site 2:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_2_check',
         		'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_2_control', array(
         		'label'          => __( 'Your custom site 2:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_2',
         		'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_social_custom_2_img_control', array(
			'label' => __('Custom site 2 logo:', 'handcraft-expo'),
			'default' => '',
			'section' => 'handcraft-expo_social_section',
			'settings' => 'handcraft-expo_social_custom_2_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_3_check_control', array(
         		'label'          => __( 'Show custom site 3:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_3_check',
         		'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_3_control', array(
         		'label'          => __( 'Your custom site 3:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_3',
         		'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_social_custom_3_img_control', array(
			'label' => __('Custom site 3 logo:', 'handcraft-expo'),
			'default' => '',
			'section' => 'handcraft-expo_social_section',
			'settings' => 'handcraft-expo_social_custom_3_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_4_check_control', array(
         		'label'          => __( 'Show custom site 4:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_4_check',
         		'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_4_control', array(
         		'label'          => __( 'Your custom site 4:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_4',
         		'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_social_custom_4_img_control', array(
			'label' => __('Custom site 4 logo:', 'handcraft-expo'),
			'default' => '',
			'section' => 'handcraft-expo_social_section',
			'settings' => 'handcraft-expo_social_custom_4_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_5_check_control', array(
         		'label'          => __( 'Show custom site 5:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_5_check',
         		'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_social_custom_5_control', array(
         		'label'          => __( 'Your custom site 5:', 'handcraft-expo' ),
         		'section'        => 'handcraft-expo_social_section',
         		'settings'       => 'handcraft-expo_social_custom_5',
         		'type'           => 'url',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_social_custom_5_img_control', array(
			'label' => __('Custom site 5 logo', 'handcraft-expo'),
			'default' => '',
			'section' => 'handcraft-expo_social_section',
			'settings' => 'handcraft-expo_social_custom_5_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_show_control', array(
         'label'          => __( 'Show Previewer', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_show',
         'type'           => 'checkbox',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_size_check_control', array(
         'label'          => __( 'Previewer size', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'description'   => __('Note: When "<strong>All content area</strong>" is selected, pictures with a 16:9 ratio are preferable.', 'handcraft-expo'),
         'settings'       => 'handcraft-expo_previewer_size_check',
		   'type'           => 'select',
		   'choices'        => array(
		        'standard'  => __('Portion of content area', 'handcraft-expo'),
		        'full'      => __('All content area', 'handcraft-expo')
		        )
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_offset_X_control', array(
		    'label'			  => __('Previewer Offset X', 'handcraft-expo'),
		    'description'   => __('Tip: you can click on this controller and adjust the value with your left and right keyboard arrows.', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_previewer',
			 'settings'		  => 'handcraft-expo_previewer_offset_X',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 0,
		        'max'   => 50,
		        'step'  => 1,
		        )
		)));
		
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_offset_Y_control', array(
		    'label'			  => __('Previewer Offset Y', 'handcraft-expo'),
		    'description'   => __('Tip: you can click on this controller and adjust the value with your left and right keyboard arrows.', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_previewer',
			 'settings'		  => 'handcraft-expo_previewer_offset_Y',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => -10,
		        'max'   => 50,
		        'step'  => 1,
		        )
		)));

		$handcraft_expo_PreviewerGoogleFontCheck = get_theme_mod('handcraft-expo_previewer_google_font');
		$handcraft_expo_PreviewerGoogleFontPush = array(
				'georgia'       => __('Georgia', 'handcraft-expo'),
				'palatino'      => __('Palatino', 'handcraft-expo'),
				'times'         => __('Times New Roman', 'handcraft-expo'),
				'arial'         => __('Arial', 'handcraft-expo'),
				'arial_black'   => __('Arial Black', 'handcraft-expo'),
				'comic'         => __('Comic Sans', 'handcraft-expo'),
				'impact'        => __('Impact', 'handcraft-expo'),
				'lucida'        => __('Lucida Sans Unicode', 'handcraft-expo'),
				'tahoma'        => __('Tahoma', 'handcraft-expo'),
				'trebuchet'     => __('Trebuchet', 'handcraft-expo'),
				'verdana'       => __('Verdana', 'handcraft-expo'),
				'courier'       => __('Courier New', 'handcraft-expo'),
				'lucida'        => __('Lucida Console', 'handcraft-expo')
		      );
		if ($handcraft_expo_PreviewerGoogleFontCheck){
			$handcraft_expo_PreviewerGoogleFontPush['google_previewer'] = esc_textarea($handcraft_expo_PreviewerGoogleFontCheck);
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_font_type_control', array(
		    'label'			  => __('Previewer font:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_previewer',
			 'settings'		  => 'handcraft-expo_previewer_font_type',
		    'type'          => 'select',
		    'choices'       => $handcraft_expo_PreviewerGoogleFontPush
		)));

		if ($handcraft_expo_PreviewerGoogleFontCheck){
			$wp_customize->get_control( 'handcraft-expo_previewer_font_type_control' )->choices = $handcraft_expo_PreviewerGoogleFontPush;
		}

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_google_font_controller', array(
         'label'          => __('Google&reg; font:', 'handcraft-expo'),
         'description'    => __('Type here your Google&reg; font name, <strong>save</strong> and <strong>refresh</strong> to add it to the Previewer font list above. Google&reg; is a registered trademark of the respective owner.', 'handcraft-expo'),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_google_font',
         'type'           => 'text',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_font_size_control', array(
		    'label'			  => __('Previewer font size:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_previewer',
			 'settings'		  => 'handcraft-expo_previewer_font_size',
		    'type'          => 'range',
		    'input_attrs'   => array(
		        'min'   => 50,
		        'max'   => 200,
		        'step'  => 5,
		        )
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_previewer_font_color_control', array(
			'label' => __('Previewer font color:', 'handcraft-expo'),
			'section' => 'handcraft-expo_previewer',
			'settings' => 'handcraft-expo_previewer_font_color',
		)));
		
		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_previewer_background_color_control', array(
			'label' => __('Previewer Background Color', 'handcraft-expo'),
			'section' => 'handcraft-expo_previewer',
			'settings' => 'handcraft-expo_previewer_background_color',
		)));

		$wp_customize->add_control(new WP_customize_Color_Control($wp_customize, 'handcraft-expo_previewer_shadow_color_control', array(
			'label' => __('Previewer Shadow Color', 'handcraft-expo'),
			'section' => 'handcraft-expo_previewer',
			'settings' => 'handcraft-expo_previewer_shadow_color',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_background_image_control', array(
         'label'         => __( 'Previewer Background image:', 'handcraft-expo' ),
         'section'       => 'handcraft-expo_previewer',
         'description'   => __('Note: Handcraft Expo suggests to use ONLY images with low opacity and high transparency and contrast in order to resemble a watermark effect.', 'handcraft-expo'),
         'settings'      => 'handcraft-expo_previewer_background_image',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_blog_position_control', array(
		    'label'			  => __('Display latest post on menu link:', 'handcraft-expo'),
		    'section'       => 'handcraft-expo_previewer',
			 'settings'		  => 'handcraft-expo_previewer_blog_position',
		    'type'          => 'select',
		    'choices'   => array(
		        'none'   => __('None', 'handcraft-expo'),
		        '1'   => '1',
		        '2'   => '2',
		        '3'   => '3',
		        '4'   => '4',
		        '5'   => '5',
		        '6'   => '6',
		        '7'   => '7',
		        '8'   => '8'
		        )
		)));
		
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_1_img_control', array(
         'label'      => __( 'Upload an image for menu link #1', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_1_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_1_control', array(
         'label'          => __( 'Previewer Text Box 1', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_1',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_2_img_control', array(
         'label'      => __( 'Upload an image for menu link #2', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_2_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_2_control', array(
         'label'          => __( 'Previewer Text Box 2', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_2',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_3_img_control', array(
         'label'      => __( 'Upload an image for menu link #3', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_3_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_3_control', array(
         'label'          => __( 'Previewer Text Box 3', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_3',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_4_img_control', array(
         'label'      => __( 'Upload an image for menu link #4', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_4_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_4_control', array(
         'label'          => __( 'Previewer Text Box 4', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_4',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_5_img_control', array(
         'label'      => __( 'Upload an image for menu link #5', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_5_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_5_control', array(
         'label'          => __( 'Previewer Text Box 5', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_5',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_6_img_control', array(
         'label'      => __( 'Upload an image for menu link #6', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_6_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_6_control', array(
         'label'          => __( 'Previewer Text Box 6', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_6',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_7_img_control', array(
         'label'      => __( 'Upload an image for menu link #7', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_7_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_7_control', array(
         'label'          => __( 'Previewer Text Box 7', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_7',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'handcraft-expo_previewer_text_8_img_control', array(
         'label'      => __( 'Upload an image for menu link #8', 'handcraft-expo' ),
         'section'    => 'handcraft-expo_previewer',
         'settings'   => 'handcraft-expo_previewer_text_8_img',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_previewer_text_8_control', array(
         'label'          => __( 'Previewer Text Box 8', 'handcraft-expo' ),
         'section'        => 'handcraft-expo_previewer',
         'settings'       => 'handcraft-expo_previewer_text_8',
         'type'           => 'textarea',
		)));

		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'handcraft-expo_custom_css_control', array(
         'label'       => __('Add your custom CSS', 'handcraft-expo'),
         'description' => __('Note: Leave EMPTY if unsure. Style tags included, just add CSS selectors and options. Example: <br /><strong>body</strong> {display: none;}', 'handcraft-expo'),
         'section'     => 'handcraft-expo_your_css',
         'settings'    => 'handcraft-expo_custom_css',
         'type'        => 'textarea',
		)));

		// Handcraft Expo Info
			$wp_customize->add_setting('handcraft-expo_your_theme_setting', array(
				'default' => '',
				'sanitize_callback' => 'esc_html',
				'transport' => 'postMessage',
			));
	
	
			$wp_customize->add_section('handcraft-expo_your_theme', array(
				'title'       => __('Your theme', 'handcraft-expo'),
				'description' => __('Thank you for using Handcraft Expo: my promise is that there will never be a \'PRO\' version of this theme, any new feature will always be included in future updates. If you value this as much as I do, please visit Handcraft Expo\'s <a href="http://handcraftexpo.nouveausiteweb.fr/" target="_blank">website</a>, share your <a href="https://wordpress.org/support/view/theme-reviews/handcraft-expo#postform" target="_blank">feedback</a>, <a href="https://wordpress.org/support/theme/handcraft-expo" target="_blank">opinions</a> and suggestions and help me making it better!<br /><br />Credits:<br /><a href="https://stallman.org" target="_blank">Richard Stallman</a>: for the inspiration<br /><a href="https://fsf.org" target="_blank">Free Software Foundation</a>: for the licences<br /><a href="https://wordpress.org" target="_blank">WordPress</a>: for the platform<br /><a href="https://profiles.wordpress.org/poena" target="_blank">Carolina</a> and all the <a href="https://make.wordpress.org/themes/" target="_blank">Theme Review Team</a>: for helping make a way better theme<br />Kevin from Graphinity Design: for the help<br />My girlfriend: for the psychological support<br /><a href="https://en.wikipedia.org/wiki/Coffee" target="_blank">Coffee</a>: for the physical support<br />', 'handcraft-expo'),
				'priority'    => 130,
			));
	
	
			$wp_customize->add_control(new WP_customize_Control($wp_customize, 'handcraft-expo_your_theme_control', array(
				'label'       => '_Y_Power',
				'type'        => 'hidden',
				'section'     => 'handcraft-expo_your_theme',
				'settings'    => 'handcraft-expo_your_theme_setting',
			)));

		}
		
	add_action('customize_register', 'handcraft_expo_customize_register');


// Outputting Customized WP CSS

	function handcraft_expo_customize_css_output() { ?>

		<style type="text/css">

<?php

			if ( is_admin_bar_showing() ) { ?>

					#handcraft-expo-mobile-menu {
							top: 32px;
						}
					@media screen and (max-width: 782px) {
						#handcraft-expo-mobile-menu {
							top: 46px;
						}
					}
					@media screen and (max-width: 600px) {
						#handcraft-expo-mobile-menu {
							position: absolute;
						}
					}

			<?php }

		$handcraft_expo_visibleTitle = get_theme_mod('handcraft-expo_title_show', 1);
		
			if ($handcraft_expo_visibleTitle == 0) {
				set_theme_mod('handcraft-expo_title_position', 'center'); ?>
		
			.title-show, 
			.tagline-show,
			.mobile-main-title-show,
			.mobile-main-tagline-show {
					width: 0;
					height: 0;
					max-width: 0;
					max-height: 0;
					visibility: hidden;
				}
			@media (max-height: 767px),
			(max-width: 1180px),
			handheld {
				.site-custom-logo .custom-logo-link img,
				.mobile-logo .custom-logo-link img {
					margin-top: 80px;
				}
			}
				
<?php };

			if ($handcraft_expo_visibleTitle == 1) { ?>
		
			.title-show,
			.mobile-main-title-show {
					font-family: <?php

	$handcraft_expo_titleFontCheck = get_theme_mod('handcraft-expo_title_font_type', 'arial');
	handcraft_expo_fonts_selection($handcraft_expo_titleFontCheck); ?>;
					font-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_font_size', '350')); ?>%;
				}

			.title-show {
					margin-left: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_position_X', '0')); ?>%;
					margin-top: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_position_Y', '0')); ?>%;					
			}
				
			.tagline-show,
			.mobile-main-tagline-show {
					font-family: <?php

	$handcraft_expo_titleFontCheck = get_theme_mod('handcraft-expo_title_font_type', 'arial');
	handcraft_expo_fonts_selection($handcraft_expo_titleFontCheck); ?>;
					font-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_font_size', '180')); ?>%;
				}

			.tagline-show {
					margin-left: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_position_X', '0')); ?>%;
					margin-top: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_position_Y', '0')); ?>%;
			}
				
<?php };

	$handcraft_expo_titleAnimatCheck = get_theme_mod('handcraft-expo_title_hover_effect', 'color_scale');

	if ($handcraft_expo_titleAnimatCheck == 'color') { ?>
				
			.title-banner:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_color', '#bababa')); ?>;
					opacity: 0.7;
				}
			
			.title-left:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_color', '#bababa')); ?>;
					opacity: 0.7;
				}

			.title-center:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_color', '#bababa')); ?>;
					opacity: 0.7;
				}
			
<?php };
				
			if ($handcraft_expo_titleAnimatCheck == 'color_scale') { ?>
				
			.title-banner:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

			.title-left:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

			.title-center:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '0.01')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

<?php	};

			if ($handcraft_expo_titleAnimatCheck == 'color_scale_border_rotate') { ?>
				
			.title-banner:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					letter-spacing: 3px;
					border: 5px solid white;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

			.title-left:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					letter-spacing: 3px;
					border: 5px solid white;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

			.title-center:hover {			
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.7;
					letter-spacing: 3px;
					border: 5px solid white;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_rotate_effect', '12')); ?>deg) scale(<?php echo esc_attr(get_theme_mod('handcraft-expo_title_hover_scale_effect', '0.9')); ?>);
				}

<?php };

			$handcraft_expo_facebookCheck = get_theme_mod('handcraft-expo_facebook_setting', 1);
			$handcraft_expo_twitterCheck = get_theme_mod('handcraft-expo_twitter_setting', 1);
			$handcraft_expo_googleCheck = get_theme_mod('handcraft-expo_google_setting', 1);
			$handcraft_expo_googlePlusCheck = get_theme_mod('handcraft-expo_google_plus_setting', 1);
			$handcraft_expo_instagramCheck = get_theme_mod('handcraft-expo_instagram_setting', 1);
			$handcraft_expo_youtubeCheck = get_theme_mod('handcraft-expo_youtube_setting', 1);
			$handcraft_expo_customSocial_1_Check = get_theme_mod('handcraft-expo_social_custom_1_check', 0);
			$handcraft_expo_customSocial_2_Check = get_theme_mod('handcraft-expo_social_custom_2_check', 0);
			$handcraft_expo_customSocial_3_Check = get_theme_mod('handcraft-expo_social_custom_3_check', 0);
			$handcraft_expo_customSocial_4_Check = get_theme_mod('handcraft-expo_social_custom_4_check', 0);
			$handcraft_expo_customSocial_5_Check = get_theme_mod('handcraft-expo_social_custom_5_check', 0);
			$handcraft_expo_rss_feed_1_check = get_theme_mod('handcraft-expo_rss_check_1', 1);
			
					
			
			if ($handcraft_expo_facebookCheck == 1 || 
				$handcraft_expo_twitterCheck == 1 || 
				$handcraft_expo_googleCheck == 1 || 
				$handcraft_expo_googlePlusCheck == 1 || 
				$handcraft_expo_instagramCheck == 1 || 
				$handcraft_expo_youtubeCheck == 1 ||
				$handcraft_expo_customSocial_1_Check == 1 ||
				$handcraft_expo_customSocial_2_Check == 1 ||
				$handcraft_expo_customSocial_3_Check == 1 ||
				$handcraft_expo_customSocial_4_Check == 1 ||
				$handcraft_expo_customSocial_5_Check == 1 ||
				$handcraft_expo_rss_feed_1_check == 1) { ?>

			.social-icons {
					visibility: visible;
				}

<?php };

			$handcraft_expo_menuSidebarborderCheck = get_theme_mod('handcraft-expo_menu sidebar_border_show', 1);

			if ($handcraft_expo_menuSidebarborderCheck == 1) { ?>

			.col-xs-3 {
					border-right: <?php echo esc_attr(get_theme_mod('handcraft-expo_menubar_border_size', '1.8')); ?>px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;					
					-o-box-shadow: 1px 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-ms-box-shadow: 1px 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-moz-box-shadow: 1px 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-webkit-box-shadow: 1px 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					box-shadow: 1px 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
				}

<?php };
	
	$handcraft_expo_mainBannerCheck = get_theme_mod('handcraft-expo_main_banner_background', '');
	
	if ( $handcraft_expo_mainBannerCheck == '') { ?>

			body {
					background-image: url("<?php echo esc_url(get_theme_mod('handcraft-expo_background', '')); ?>");
					background-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_cover', 'contain')); ?>;
					background-attachment: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_scroll_check', 'fixed')); ?>;
					background-position: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_X_position', '0')); ?>% <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_Y_position', '0')); ?>%;
				}

<?php };

	if ( $handcraft_expo_mainBannerCheck != '') { ?>

			.handcraftExpo-main-background {
					min-height: 100%;
				}
				
			.col-xs-9 {
					background-image: url("<?php echo esc_url(get_theme_mod('handcraft-expo_background','')); ?>");
					background-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_cover', 'contain')); ?>;
					background-attachment: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_scroll_check', 'fixed')); ?>;			
					background-position: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_X_position', '0')); ?>% <?php echo esc_attr(get_theme_mod('handcraft-expo_background_image_Y_position', '0')); ?>%;
				}
				
			.col-xs-3 {
					position: absolute;
				}

<?php };

	$handcraft_expo_menuSidebarGradCheck = get_theme_mod('handcraft-expo_menu_sidebar_gradient', 1);

	if ($handcraft_expo_menuSidebarGradCheck == 1) { ?>
	
			.col-xs-3,
			.navbar-container ul li ul li ul {
					background: rgb(13,15,17); /* Old browsers */
					background: -moz-linear-gradient(left,  rgba(13,15,17,1) 0%, rgba(31,35,40,1) 66%, rgba(31,35,40,1) 66%, rgba(35,40,45,1) 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(left,  rgba(13,15,17,1) 0%,rgba(31,35,40,1) 66%,rgba(31,35,40,1) 66%,rgba(35,40,45,1) 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to right,  rgba(13,15,17,1) 0%,rgba(31,35,40,1) 66%,rgba(31,35,40,1) 66%,rgba(35,40,45,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0d0f11', endColorstr='#23282d',GradientType=1 ); /* IE6-9 */

					background-size: cover;
				}

			.navbar-container ul li ul,
			.navbar-container ul li ul li ul li ul {
					background: rgb(35,40,45); /* Old browsers */
					background: -moz-linear-gradient(left,  rgba(35,40,45,1) 0%, rgba(31,35,40,1) 34%, rgba(31,35,40,1) 34%, rgba(13,15,17,1) 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(left,  rgba(35,40,45,1) 0%,rgba(31,35,40,1) 34%,rgba(31,35,40,1) 34%,rgba(13,15,17,1) 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to right,  rgba(35,40,45,1) 0%,rgba(31,35,40,1) 34%,rgba(31,35,40,1) 34%,rgba(13,15,17,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#23282d', endColorstr='#0d0f11',GradientType=1 ); /* IE6-9 */
				}

			#copyright,
			#mobile-copyright {
					background: rgb(13,15,17); /* Old browsers */
					background: -moz-linear-gradient(left,  rgba(13,15,17,1) 0%, rgba(31,35,40,1) 66%, rgba(31,35,40,1) 66%, rgba(35,40,45,1) 100%); /* FF3.6-15 */
					background: -webkit-linear-gradient(left,  rgba(13,15,17,1) 0%,rgba(31,35,40,1) 66%,rgba(31,35,40,1) 66%,rgba(35,40,45,1) 100%); /* Chrome10-25,Safari5.1-6 */
					background: linear-gradient(to right,  rgba(13,15,17,1) 0%,rgba(31,35,40,1) 66%,rgba(31,35,40,1) 66%,rgba(35,40,45,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
					filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0d0f11', endColorstr='#23282d',GradientType=1 ); /* IE6-9 */

					background-size: cover;
				}

<?php };

	if ($handcraft_expo_menuSidebarGradCheck == 0) {?>

			#copyright,
			#mobile-copyright {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
				}

<?php };

	$handcraft_expo_pageTitlePosCheck = get_theme_mod('handcraft-expo_page_title_position', 'as_banner');
	
	if ($handcraft_expo_pageTitlePosCheck == 'as_content') { ?>
	
					.page-main-content > p:first-of-type, 
					.blog-main-content > p:first-of-type, 
					.post-main-content > p:first-of-type,
					.page-main-content-2-columns > p:first-of-type {
							border-top: 2px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
						}

<?php	};

	$handcraft_expo_pageTitleShadowCheck = get_theme_mod('handcraft-expo_background', '');
	
	if ($handcraft_expo_pageTitleShadowCheck != '') { ?>

			.blog-title {
					box-shadow: 3px 3px 3px 0 black;
				}
				
			.page-title {
					box-shadow: 3px 3px 3px 0 black;
				}

<?php };

	$handcraft_expo_titleBackgroundCheck = get_theme_mod('handcraft-expo_title_background_check', 0);
	$handcraft_expo_taglineBackgroundCheck = get_theme_mod('handcraft-expo_tagline_background_check', 0);

	if (get_theme_mod('handcraft-expo_title_background_check') == 1) { ?>

			.title-show,
			.mobile-main-title-show {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_background', '#545454')); ?>;
				}

<?php }

	else { ?>

			.title-show {
					background-color: ;
				}

<?php	};

	if (get_theme_mod('handcraft-expo_tagline_background_check') == 1) { ?>

			.tagline-show,
			.mobile-main-tagline-show {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_background', '#545454')); ?>;
				}

<?php }

	else { ?>

			.title-show {
					background-color: ;
				}

<?php	}; ?>

			body {
					font-family: <?php

	$handcraft_expo_bodyFontCheck = get_theme_mod('handcraft-expo_body_font_type', 'arial');
	handcraft_expo_fonts_selection($handcraft_expo_bodyFontCheck); ?>;
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
				}
				
			.handcraftExpo-main-banner {
					background-image: url("<?php echo esc_attr(get_theme_mod('handcraft-expo_main_banner_background', '')); ?>");
					background-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_banner_image_cover', 'cover')); ?>;
					background-repeat: no-repeat;
					background-position: <?php echo esc_attr(get_theme_mod('handcraft-expo_banner_image_X_position', '0')); ?>% <?php echo esc_attr(get_theme_mod('handcraft-expo_banner_image_Y_position', '0')); ?>%;
				}

			.col-xs-3 {		
					opacity: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_sidebar_opacity', '100')); ?>;
				}
				
			.title-show,
			.mobile-main-title-show,
			.blog-title {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
				}

			.tagline-show,
			.mobile-main-tagline-show {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_color', '#fff')); ?>;
				}

			.mobile-logo img.custom-logo {
					width: <?php echo esc_attr(get_theme_mod('handcraft-expo_custom_logo_pocket_size', '80')); ?>%;
				}

			.site-custom-logo img.custom-logo {
					width: <?php echo esc_attr(get_theme_mod('handcraft-expo_custom_logo_size', '80')); ?>%;
				}

			.navbar-container li {
					font-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_size', '180')); ?>%;
				}
	
			.navbar-container li a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_color', '#bababa')); ?>;
				}
		
			.navbar-container li a:hover {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
				}

			.navbar-container ul li a {
				text-align: <?php echo esc_attr(get_theme_mod('handcraft-expo_menu_links_alignment', 'center')); ?>;
				}

			.navbar-container ul li ul {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
					border-top: <?php echo esc_attr(get_theme_mod('handcraft-expo_menubar_border_size', '1.8')); ?>px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					border-right: <?php echo esc_attr(get_theme_mod('handcraft-expo_menubar_border_size', '1.8')); ?>px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					border-bottom: <?php echo esc_attr(get_theme_mod('handcraft-expo_menubar_border_size', '1.8')); ?>px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-o-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-ms-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-moz-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-webkit-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
				}

			.navbar-container ul li ul li ul {
					-o-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-ms-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-moz-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					-webkit-box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;
					box-shadow: 0 0 3px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_left_sidebar_color', '#8f8404')); ?>;				
				}

			.navbar-container .sub-menu > li {
					

				}

			.current-menu-item {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_background', '#545454')); ?>;
				}
				
			.col-xs-9 a,
			.widgets-bar-content-top .menu a,
			.widgets-bar-content-top .menu a:hover,
			#copyright a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_page_links_color', '#c4c103')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}
			
			.col-xs-9 a:hover,
			#copyright a:hover {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;	
				}
				
			.page-main-content, 
			.blog-main-content, 
			.post-main-content,
			.page-notitle-main-content,
			.page-main-content-2-columns {
					font-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_font_size', '1')); ?>em;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
					-o-box-shadow: 0 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					-ms-box-shadow: 0 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					-moz-box-shadow: 0 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					-webkit-box-shadow: 0 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					box-shadow: 0 0 5px 0 <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>; 
				}
				
			.pages-navigation:hover {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
				}

			.blog-navigation .previousposts,
			.blog-navigation .nextposts,
			.mobile-main-content .pages-navigation .alignleft,
			.mobile-main-content .pages-navigation .alignright,
			.mobile-main-content .ancestors-children-nav,
			.mobile-main-content .posts-main-tags,
			.mobile-main-content .posts-navigation {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
					
				}

			.mobile-main-content .posts-main-tags :not(a) {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;	
				}

			.mobile-main-content .posts-main-tags a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_tagline_background_color', '#000')); ?>;
				}

			.blog-navigation .previousposts a,
			.blog-navigation .nextposts a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
				}

			#content-footer-image {
					-ms-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_content_footer_image_rotate', '12')); ?>deg);
					-moz-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_content_footer_image_rotate', '12')); ?>deg);
					-webkit-transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_content_footer_image_rotate', '12')); ?>deg);
					transform: rotate(<?php echo esc_attr(get_theme_mod('handcraft-expo_content_footer_image_rotate', '12')); ?>deg);
				}
				
			.description-container {
					font-family: <?php

	$handcraft_expo_previewerFontCheck = get_theme_mod('handcraft-expo_previewer_font_type', 'arial');
	
	handcraft_expo_fonts_selection($handcraft_expo_previewerFontCheck); ?>;
					margin-top: <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_offset_Y', '20')); ?>%;
					margin-left: <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_offset_X', '1')); ?>%;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_background_color', '#1d2126')); ?>;
					box-shadow: 3px 3px 3px <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_shadow_color', '#111111')); ?>;
					font-size: <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_font_size', '100')); ?>%;
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_previewer_font_color', '#cecece')); ?>;
					background-image: url("<?php echo esc_url(get_theme_mod('handcraft-expo_previewer_background_image', '')); ?>");
					background-size: cover;
				}

			.archives-title,
			.searches-title {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
				}

			.archives-navigation {	
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}

			.comments-pages-links {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
				}

			.archives-navigation:hover,
			.comments-pages-links:hover {	
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}

			.sidebar-div {
					
				}
			
			.sidebar-button:hover {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}

			.widgets-bar-content {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
				}

			#blog-showcase-container > h3, 
			#previewer-content-1 > h3, 
			#previewer-content-2 > h3, 
			#previewer-content-3 > h3, 
			#previewer-content-4 > h3, 
			#previewer-content-5 > h3, 
			#previewer-content-6 > h3, 
			#previewer-content-7 > h3, 
			#previewer-content-8 > h3 {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_page_links_color', '#c4c103')); ?>;
				}
				
			.sticky
			.tag-sticky-1,
			.tag-sticky-2,
			.tag-sticky-3,
			.tag-sticky-4,
			.tag-sticky-5 { 
					-o-box-shadow: 0 0 10px 3px <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?> inset;
					-ms-box-shadow: 0 0 10px 3px <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>  inset;
					-moz-box-shadow: 0 0 10px 3px <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?> inset;
					-webkit-box-shadow: 0 0 10px 3px <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?> inset;
					box-shadow: 0 0 10px 3px  <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?> inset;
				}

			.widget-items > h1,
			.widget-items > h2, 
			.widget-items > h3,
			.widget-items > h4,
			.widget-items > h5,
			.widget-items > h6 {
					border-bottom: 2px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
				}
			
			.widget-items a:hover,
			.widget-items a:hover, 
			.widget-items a:hover,
			.widget-items a:hover,
			.widget-items a:hover,
			.widget-items a:hover {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}

			.widgets-bar-content-top .menu ul:hover {
					border: 1px solid <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
				}
	
			.widgets-bar-content-top ul li ul,
			.widgets-bar-content-top ul li ul li ul,
			.widgets-bar-content-top ul li ul li ul li ul {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
				}
			
			.sidebar-div,
			.search-submit,
			#submit,
			#searchsubmit,
			#formsubmit,
			#formsubmit-mobile {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
				}
			
			#searchsubmit:hover,
			#submit:hover,
			.search-submit:hover,
			#formsubmit:hover,
			#formsubmit-mobile:hover {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_title_color', '#fff')); ?>;
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
				}
			
			#wp-calendar
			caption {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					opacity: 0.9;
				}

			#wp-calendar tbody td#today {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
					border-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
				}
			
			#wp-calendar tbody td a,
			#wp-calendar tfoot td#prev a:hover,
			#wp-calendar tfoot td#next a:hover {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
				}
				
			.not-found-2 > a:hover {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
					-ms-transition: all linear 0.4s;
					-moz-transition: all linear 0.4s;
					-webkit-transition: all linear 0.4s;
					transition: all linear 0.4s;
				}


/* -- Mobile -- */


			#mobile-container-div {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_background_color', '#23282d')); ?>;
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_background_color', '#8f8404')); ?>;
				}

			#mobile-container-div a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_links_color', '#bababa')); ?>;
				}

			#handcraft-expo-mobile-menu {
					background-color: <?php echo esc_attr(get_theme_mod('handcraft-expo_content_background_color', '#1d2126')); ?>;
				}

			.mobile-main-menu-dropdown a {
					color: <?php echo esc_attr(get_theme_mod('handcraft-expo_main_text_color', '#a3a3a3')); ?>;
				}

		</style>

<?php echo '<style id="handcraft-expo-live-css">' . esc_attr(get_theme_mod('handcraft-expo_custom_css', '')) . '</style>';

};



	
	add_action('wp_head', 'handcraft_expo_customize_css_output');


// Live Customizer JS

	function handcraft_expo_live_preview() { 

		wp_enqueue_script('handcraft_live_customizer', get_template_directory_uri() . '/js/handcraftExpo-customizer.js', array('jquery', 'customize-preview'), true );

	}

	add_action('customize_preview_init', 'handcraft_expo_live_preview');
