<?php
/**
 * Helper functions related to customizer and options.
 *
 * @package Magazine_Plus
 */

if ( ! function_exists( 'magazine_plus_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function magazine_plus_get_global_layout_options() {

		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'magazine-plus' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'magazine-plus' ),
			'three-columns' => esc_html__( 'Three Columns', 'magazine-plus' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'magazine-plus' ),
		);
		$output = apply_filters( 'magazine_plus_filter_layout_options', $choices );
		return $output;

	}

endif;

if ( ! function_exists( 'magazine_plus_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function magazine_plus_get_archive_layout_options() {

		$choices = array(
			'full'    => esc_html__( 'Full Post', 'magazine-plus' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'magazine-plus' ),
		);
		$output = apply_filters( 'magazine_plus_filter_archive_layout_options', $choices );
		if ( ! empty( $output ) ) {
			ksort( $output );
		}
		return $output;

	}

endif;

if ( ! function_exists( 'magazine_plus_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable True for adding No Image option.
	 * @param array $allowed Allowed image size options.
	 * @return array Image size options.
	 */
	function magazine_plus_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'magazine-plus' );
		}
		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'magazine-plus' );
		$choices['medium']    = esc_html__( 'Medium', 'magazine-plus' );
		$choices['large']     = esc_html__( 'Large', 'magazine-plus' );
		$choices['full']      = esc_html__( 'Full (original)', 'magazine-plus' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ){
					$choices[ $key ] .= ' ('. $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;


if ( ! function_exists( 'magazine_plus_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function magazine_plus_get_image_alignment_options() {

		$choices = array(
			'none'   => _x( 'None', 'Alignment', 'magazine-plus' ),
			'left'   => _x( 'Left', 'Alignment', 'magazine-plus' ),
			'center' => _x( 'Center', 'Alignment', 'magazine-plus' ),
			'right'  => _x( 'Right', 'Alignment', 'magazine-plus' ),
		);
		return $choices;

	}

endif;

if ( ! function_exists( 'magazine_plus_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $min    Min.
	 * @param int    $max    Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 *
	 * @return array Options array.
	 */
	function magazine_plus_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {

		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;

	}

endif;
