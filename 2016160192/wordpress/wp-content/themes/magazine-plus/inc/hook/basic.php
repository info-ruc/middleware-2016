<?php
/**
 * Basic theme functions.
 *
 * This file contains hook functions attached to core hooks.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_custom_body_class' ) ) :
	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function magazine_plus_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		$home_content_status =	magazine_plus_get_option( 'home_content_status' );
		if( true !== $home_content_status ){
			$input[] = 'home-content-not-enabled';
		}

		// Global layout.
		global $post;
		$global_layout = magazine_plus_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_plus_filter_theme_global_layout', $global_layout );
		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
		  case 'three-columns':
		    $input[] = 'three-columns-enabled';
		    break;

		  default:
		    break;
		}

		return $input;

	}
endif;

add_filter( 'body_class', 'magazine_plus_custom_body_class' );

if ( ! function_exists( 'magazine_plus_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = magazine_plus_get_option( 'global_layout' );
		$global_layout = apply_filters( 'magazine_plus_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'magazine_plus_custom_content_width' );

if ( ! function_exists( 'magazine_plus_custom_links_in_navigation' ) ) :

	/**
	 * Add custom links in navigation.
	 *
	 * @since 1.0.0
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param object $args  An object containing wp_nav_menu() arguments.
	 * @return string Modified HTML list content for the menu items.
	 */
	function magazine_plus_custom_links_in_navigation( $items, $args ) {

		if ( 'primary' === $args->theme_location ) {
			$classes = 'home-menu';
			if ( is_front_page() ) {
				$classes .= ' current-menu-item';
			}
			$items = '<li class="' . $classes . '"><a href="' . esc_url( home_url( '/' ) ) . '"><span class="screen-reader-text">' . __( 'Home', 'magazine-plus' ) . '</span></a></li>' . $items;
		}

		return $items;

	}
endif;

add_filter( 'wp_nav_menu_items', 'magazine_plus_custom_links_in_navigation', 10, 2 );

if ( ! function_exists( 'magazine_plus_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function magazine_plus_implement_read_more( $more ) {

		$output = ' <a href="' . esc_url( get_permalink() ) . '">[&hellip;]</a>';
		return $output;

	}

endif;

if ( ! function_exists( 'magazine_plus_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function magazine_plus_content_more_link( $more_link, $more_link_text ) {

		$read_more_text = '[&hellip;]';
		$more_link = str_replace( $more_link_text, $read_more_text, $more_link );
		return $more_link;

	}

endif;

if ( ! function_exists( 'magazine_plus_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function magazine_plus_implement_excerpt_length( $length ) {

		return apply_filters( 'magazine_plus_filter_excerpt_length', 35 );

	}

endif;

if ( ! function_exists( 'magazine_plus_hook_read_more_filters' ) ) :

	/**
	 * Hook read more filters.
	 *
	 * @since 1.0.0
	 */
	function magazine_plus_hook_read_more_filters() {

		if ( is_home() || is_category() || is_tag() || is_author() || is_date() ) {
			add_filter( 'excerpt_length', 'magazine_plus_implement_excerpt_length', 999 );
			add_filter( 'the_content_more_link', 'magazine_plus_content_more_link', 10, 2 );
			add_filter( 'excerpt_more', 'magazine_plus_implement_read_more' );
		}

	}
endif;

add_action( 'wp', 'magazine_plus_hook_read_more_filters' );
