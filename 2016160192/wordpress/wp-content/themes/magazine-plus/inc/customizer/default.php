<?php
/**
 * Default theme options.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function magazine_plus_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_date']             = true;
		$defaults['show_ticker']           = true;
		$defaults['ticker_title']          = esc_html__( 'Latest News', 'magazine-plus' );
		$defaults['ticker_category']       = 0;
		$defaults['ticker_number']         = 3;
		$defaults['show_social_in_header'] = false;

		// Layout.
		$defaults['global_layout']           = 'three-columns';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'medium';
		$defaults['archive_image_alignment'] = 'left';

		// Home Page.
		$defaults['home_content_status'] = true;

		// Footer.
		$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'magazine-plus' );

		// Pass through filter.
		$defaults = apply_filters( 'magazine_plus_filter_default_theme_options', $defaults );
		return $defaults;
	}

endif;
