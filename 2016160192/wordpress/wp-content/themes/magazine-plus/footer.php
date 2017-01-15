<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magazine_Plus
 */

	/**
	 * Hook - magazine_plus_action_after_content.
	 *
	 * @hooked magazine_plus_content_end - 10
	 */
	do_action( 'magazine_plus_action_after_content' );
?>

	<?php
	/**
	 * Hook - magazine_plus_action_before_footer.
	 *
	 * @hooked magazine_plus_add_footer_bottom_widget_area - 5
	 * @hooked magazine_plus_footer_start - 10
	 */
	do_action( 'magazine_plus_action_before_footer' );
	?>
    <?php
	  /**
	   * Hook - magazine_plus_action_footer.
	   *
	   * @hooked magazine_plus_footer_copyright - 10
	   */
	  do_action( 'magazine_plus_action_footer' );
	?>
	<?php
	/**
	 * Hook - magazine_plus_action_after_footer.
	 *
	 * @hooked magazine_plus_footer_end - 10
	 */
	do_action( 'magazine_plus_action_after_footer' );
	?>

<?php
	/**
	 * Hook - magazine_plus_action_after.
	 *
	 * @hooked magazine_plus_page_end - 10
	 * @hooked magazine_plus_footer_goto_top - 20
	 */
	do_action( 'magazine_plus_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
