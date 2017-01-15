<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Plus
 */

?><?php
	/**
	 * Hook - magazine_plus_action_doctype.
	 *
	 * @hooked magazine_plus_doctype -  10
	 */
	do_action( 'magazine_plus_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - magazine_plus_action_head.
	 *
	 * @hooked magazine_plus_head -  10
	 */
	do_action( 'magazine_plus_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - magazine_plus_action_before.
	 *
	 * @hooked magazine_plus_page_start - 10
	 * @hooked magazine_plus_skip_to_content - 15
	 */
	do_action( 'magazine_plus_action_before' );
	?>

    <?php
	  /**
	   * Hook - magazine_plus_action_before_header.
	   *
	   * @hooked magazine_plus_header_start - 10
	   */
	  do_action( 'magazine_plus_action_before_header' );
	?>
		<?php
		/**
		 * Hook - magazine_plus_action_header.
		 *
		 * @hooked magazine_plus_site_branding - 10
		 */
		do_action( 'magazine_plus_action_header' );
		?>
    <?php
	  /**
	   * Hook - magazine_plus_action_after_header.
	   *
	   * @hooked magazine_plus_header_end - 10
	   */
	  do_action( 'magazine_plus_action_after_header' );
	?>

	<?php
	/**
	 * Hook - magazine_plus_action_before_content.
	 *
	 * @hooked magazine_plus_add_breadcrumb - 7
	 * @hooked magazine_plus_content_start - 10
	 */
	do_action( 'magazine_plus_action_before_content' );
	?>
    <?php
	  /**
	   * Hook - magazine_plus_action_content.
	   */
	  do_action( 'magazine_plus_action_content' );
	?>
