<?php
/**
* WP Super Edit Administration interface 
*
* These functions control the display for the administrative interface. This
* interface allows drag and drop control for buttons and interactive control for
* activating TinyMCE plugins. This interface requires a modern browser and 
* javascript.
* @package wp-super-edit
* @subpackage wp-super-edit-admin
*/

/**
* Display user profile WP Super Edit interface
*
* Very advanced control interface for TinyMCE buttons and plugins using
* drag and drop.
* @global object $wp_super_edit 
*/
global $wp_super_edit;
	
$updated = false;

wp_super_edit_ui_header();

wp_super_edit_buttons_ui();

wp_super_edit_ui_footer();

// End - WP Super Edit User Panel //
