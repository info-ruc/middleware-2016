<?php
/**
 * Common helper functions.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_the_excerpt' ) ) :

	/**
	 * Generate excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length Excerpt length in words.
	 * @param WP_Post $post_obj WP_Post instance (Optional).
	 * @return string Excerpt.
	 */
	function magazine_plus_the_excerpt( $length = 0, $post_obj = null ) {

		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );

		if ( 0 === $length  ) {
			return;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}
		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );
		return $trimmed_content;

	}

endif;

if ( ! function_exists( 'magazine_plus_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_simple_breadcrumb() {

		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
		}

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
		);
		breadcrumb_trail( $breadcrumb_args );

	}

endif;

if ( ! function_exists( 'magazine_plus_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function magazine_plus_fonts_url() {

		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Rajdhani, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Rajdhani font: on or off', 'magazine-plus' ) ) {
			$fonts[] = 'Rajdhani:400,300,500,600';
		}

		/* translators: If there are characters in your language that are not supported by Source Sans Pro, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'magazine-plus' ) ) {
			$fonts[] = 'Source Sans Pro:400,300,500,600';
		}
	
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;

	}

endif;

if( ! function_exists( 'magazine_plus_get_sidebar_options' ) ) :

  /**
   * Get sidebar options.
   *
   * @since 1.0.0
   */
  function magazine_plus_get_sidebar_options() {

  	global $wp_registered_sidebars;

  	$output = array();

  	if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) {
  		foreach ( $wp_registered_sidebars as $key => $sidebar ) {
  			$output[$key] = $sidebar['name'];
  		}
  	}

  	return $output;

  }

endif;

if( ! function_exists( 'magazine_plus_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_primary_navigation_fallback() {
		echo '<ul>';
		$classes = 'home-menu';
		if ( is_front_page() ) {
			$classes .= ' current-menu-item';
		}
		echo '<li class="' . $classes . '"><a href="' . esc_url( home_url( '/' ) ) . '"><span class="screen-reader-text">' . __( 'Home', 'magazine-plus' ) . '</span></a></li>';
		$args = array(
			'number'       => 5,
			'hierarchical' => false,
			);
		$pages = get_pages( $args );
		if ( is_array( $pages ) && ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				echo '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
			}
		}
		echo '</ul>';
	}

endif;

if ( ! function_exists( 'magazine_plus_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 2.0
	 */
	function magazine_plus_the_custom_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

endif;

/**
 * Sanitize post ID.
 *
 * @since 1.0.0
 *
 * @param string $key Field key.
 * @param array  $field Field detail.
 * @param mixed  $value Raw value.
 * @return mixed Sanitized value.
 */
function magazine_plus_widget_sanitize_post_id( $key, $field, $value ) {

	$output = '';
	$value = absint( $value );
	if ( $value ) {
		$not_allowed = array( 'revision', 'attachment', 'nav_menu_item' );
		$post_type = get_post_type( $value );
		if ( ! in_array( $post_type, $not_allowed ) && 'publish' === get_post_status( $value ) ) {
			$output = $value;
		}
	}
	return $output;

}

if ( ! function_exists( 'magazine_plus_get_index_page_id' ) ) :

	/**
	 * Get front index page ID.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Type.
	 * @return int Corresponding Page ID.
	 */
	function magazine_plus_get_index_page_id( $type = 'front' ) {

		$page = '';

		switch ( $type ) {
			case 'front':
				$page = get_option( 'page_on_front' );
				break;

			case 'blog':
				$page = get_option( 'page_for_posts' );
				break;

			default:
				break;
		}
		$page = absint( $page );
		return $page;

	}
endif;

if ( ! function_exists( 'magazine_plus_render_select_dropdown' ) ) :

	/**
	 * Render select dropdown.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $main_args     Main arguments.
	 * @param string $callback      Callback method.
	 * @param array  $callback_args Callback arguments.
	 * @return string Rendered markup.
	 */
	function magazine_plus_render_select_dropdown( $main_args, $callback, $callback_args = array() ) {

		$defaults = array(
			'id'          => '',
			'name'        => '',
			'selected'    => 0,
			'echo'        => true,
			'add_default' => false,
			);

		$r = wp_parse_args( $main_args, $defaults );
		$output = '';
		$choices = array();

		if ( is_callable( $callback ) ) {
			$choices = call_user_func_array( $callback, $callback_args );
		}

		if ( ! empty( $choices ) || true === $r['add_default'] ) {

			$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
			if ( true === $r['add_default'] ) {
				$output .= '<option value="">' . __( 'Default', 'magazine-plus' ) . '</option>\n';
			}
			if ( ! empty( $choices ) ) {
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
			}
			$output .= "</select>\n";
		}

		if ( $r['echo'] ) {
			echo $output;
		}
		return $output;

	}

endif;

if ( ! function_exists( 'magazine_plus_get_news_ticker_content' ) ) :

	/**
	 * Get news ticker content.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_get_news_ticker_content(){

		$tickers = magazine_plus_news_ticker_details();
		if ( empty( $tickers ) ) {
			return;
		}
		ob_start();
		?>
		<div id="news-ticker">
			<div class="news-ticker-inner-wrap">
				<?php foreach ( $tickers as $key => $ticker ) : ?>
					<div class="list">
						<a href="<?php echo esc_url( $ticker['link'] ); ?>"><?php echo esc_html( $ticker['text'] ); ?></a>
					</div>
				<?php endforeach ?>
			</div> <!-- .news-ticker-inner-wrap -->
		</div><!-- #news-ticker -->
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}
endif;

if ( ! function_exists( 'magazine_plus_news_ticker_details' ) ) :

	/**
	 * Get news ticker details.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_news_ticker_details(){

		$output = array();

		$ticker_category = magazine_plus_get_option( 'ticker_category' );
		$ticker_number   = magazine_plus_get_option( 'ticker_number' );

		$qargs = array(
			'posts_per_page' => absint( $ticker_number ),
			'no_found_rows'  => true,
			'post_type'      => 'post',
		);
		if ( absint( $ticker_category ) > 0  ) {
		  $qargs['category'] = absint( $ticker_category );
		}

		$all_posts = get_posts( $qargs );

		if ( $all_posts ) {
			$i=0;
			foreach ( $all_posts as $post ) {
				$output[$i]['text'] = apply_filters( 'the_title', $post->post_title );
				$output[$i]['link'] = get_permalink( $post->ID );
				$i++;
			}
		}

		return $output;

	}
endif;
