<?php
/**
* WP Super Edit Uninstall
*
* Uses Wordpress method to uninstall the plugin
*
* @package wp-super-edit
* @subpackage wp-super-edit-admin
*/

// Always check for constant or fail
if (!defined('WP_UNINSTALL_PLUGIN')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wp_super_edit, $wpdb;

if ( !current_user_can('manage_options') ) return;
if ( !current_user_can( 'install_plugins' ) )
	wp_die( 'You do not have permission to run this script.' );
	
/**
* WP Super Edit core class always required
*/
if ( is_admin() ) {
	require_once( WP_PLUGIN_DIR . '/wp-super-edit/wp-super-edit.core.class.php' );
	require_once( WP_PLUGIN_DIR . '/wp-super-edit/wp-super-edit.admin.class.php' );
	
	$wp_super_edit = new wp_super_edit_admin();
	
	$wp_super_edit->uninstall();
	
	$wp_super_edit->is_installed = false;
}

// End - WP Super Edit Uninstall //
