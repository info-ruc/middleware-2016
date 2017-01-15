<?php
/**
 * Callback functions for active_callback.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_is_image_in_archive_active' ) ) :

	/**
	 * Check if image in archive is active.
	 *
	 * @since 1.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function magazine_plus_is_image_in_archive_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'theme_options[archive_image]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'magazine_plus_is_news_ticker_active' ) ) :

	/**
	 * Check if news ticker is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function magazine_plus_is_news_ticker_active( $control ) {

		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
