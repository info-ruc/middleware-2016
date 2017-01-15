<?php
/**
 * Core functions.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function magazine_plus_get_option( $key = '' ) {

		global $magazine_plus_default_options;
		if ( empty( $key ) ) {
			return;
		}

		$default = ( isset( $magazine_plus_default_options[ $key ] ) ) ? $magazine_plus_default_options[ $key ] : '';
		$theme_options = (array) get_theme_mod( 'theme_options', $magazine_plus_default_options );
		$theme_options = array_merge( $magazine_plus_default_options, $theme_options );
		$value = '';
		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}
		return $value;

	}

endif;

if ( ! function_exists( 'magazine_plus_get_options' ) ) :

	/**
	 * Get all theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Theme options.
	 */
	function magazine_plus_get_options() {

		$value = array();
		$value = get_theme_mod( 'theme_options' );
		return $value;

	}

endif;
