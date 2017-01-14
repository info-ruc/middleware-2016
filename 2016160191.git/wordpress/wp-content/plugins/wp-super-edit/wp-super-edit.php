<?php
/*
Plugin Name: WP Super Edit
Plugin URI: http://funroe.net/projects/super-edit/
Description: Get control of the WordPress wysiwyg visual editor and add some functionality with more buttons and customized TinyMCE plugins.
Author: Jess Planck
Version: 2.5.3
Author URI: http://funroe.net
*/

/*
Copyright (c) Jess Planck (http://funroe.net)
WP Super Edit is released under the GNU General Public
License: http://www.gnu.org/licenses/gpl.txt

This is a WordPress plugin (http://wordpress.org). WordPress is
free software; you can redistribute it and/or modify it under the
terms of the GNU General Public License as published by the Free
Software Foundation; either version 2 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

For a copy of the GNU General Public License, write to:

Free Software Foundation, Inc.
59 Temple Place, Suite 330
Boston, MA  02111-1307
USA

You can also view a copy of the HTML version of the GNU General
Public License at http://www.gnu.org/copyleft/gpl.html
*/

/**
* WP Super Edit 
*
* These functions control the core functionality for this Wordpress Plugin. This
* plugin is designed to extend and control the Wordpress visual WYSIWYG editor. The editor
* is a javascript application known as TinyMCE provided by Moxicode AB. 
* @package wp-super-edit
* @author Jess Planck
* @version 2.5.3
*/

/**
* WP Super Edit core variables defined
*/
define( 'WPSE_VERSION', '2.5.3' );

/**
* WP Super Edit core class always required
*/
require_once( WP_PLUGIN_DIR . '/wp-super-edit/wp-super-edit.core.class.php' );

/**
* Conditional includes for WP Super Edit fuctions and classes in WordPress admin panels
* Set $wp_super_edit primary object instance
* @global object $wp_super_edit 
*/
if ( is_admin() ) {
	require_once( WP_PLUGIN_DIR . '/wp-super-edit/wp-super-edit.admin.class.php' );
	require_once( WP_PLUGIN_DIR . '/wp-super-edit/wp-super-edit-admin.php' );
	// Translations
	load_plugin_textdomain( 'wp-super-edit', false, WP_PLUGIN_DIR . '/wp-super-edit/languages' );
}

do_action( 'wp_super_edit_loaded', 'wp_super_edit_loaded' );

/**
* WP Super Edit Init
*
* This function is initializes WP Super Edit. We add it to wp_loaded so you have time to remove it or interact with it.
*
* @global object $wp_super_edit 
*/
function wp_super_edit_init() {
	global $wp_super_edit;
	
	$wp_super_edit_run_mode = 'off';	
	if ( is_admin() ) $wp_super_edit_run_mode = 'admin';
	$wp_super_edit_run_mode = apply_filters( 'wp_super_edit_run_mode',  $wp_super_edit_run_mode );

	// Conditional activation for WP Super Edit interfaces
	switch( $wp_super_edit_run_mode ) {
	// Minimal WP Super Edit usage
	case 'core':
		$wp_super_edit = new wp_super_edit_core();
		do_action( 'wp_super_edit_mode_core', 'wp_super_edit_mode_core' );
	// WP Super Edit Administration interfaces and default manipulation of TinyMCE.
	case 'admin':
		$wp_super_edit = new wp_super_edit_admin();
		
		if ( !$wp_super_edit->is_installed ) require_once( $wp_super_edit->core_path . 'wp-super-edit-defaults.php' );
		
		do_action( 'wp_super_edit_mode_admin', 'wp_super_edit_mode_admin' );
		add_action('admin_menu', 'wp_super_edit_admin_menu_setup');
		add_action('admin_init', 'wp_super_edit_admin_setup');		
		add_filter('mce_external_plugins','wp_super_edit_tinymce_plugin_filter', 99);
		add_filter('mce_external_languages','wp_super_edit_tinymce_plugin_lang_filter', 99);
		add_filter('tiny_mce_before_init','wp_super_edit_tinymce_filter', 99);
	}
	do_action( 'wp_super_edit_mode_run', 'wp_super_edit_mode_run' );
}
add_action( 'plugins_loaded', 'wp_super_edit_init' );


/**
* WP Super Edit TinyMCE filter
*
* This function is a WordPress filter designed to replace the TinyMCE configuration array
* with the configuration array created by WP Super Edit.
* @global object $wp_super_edit 
*/
function wp_super_edit_tinymce_filter( $initArray ) {
	global $wp_super_edit;
	
	//ISSUE:: Find out what TinyMCE is spewing
	//echo "ISSUE::";
	//print_r( $initArray );

	if ( !$wp_super_edit->is_installed ) return $initArray;

	$initArray = $wp_super_edit->tinymce_settings( $initArray );
	
	$initArray['relative_urls'] = false;
	$initArray['remove_script_host'] = false;
	$initArray['convert_urls'] = false;
	
	return $initArray;
}

/**
* WP Super Edit TinyMCE Plugin filter
*
* This WordPress filter passes plugins activated by WP Super Edit and passes them during init of 
* TinyMCE.
* @global object $wp_super_edit 
*/
function wp_super_edit_tinymce_plugin_filter( $tinymce_plugins ) {
	global $wp_super_edit;
		
	if ( !$wp_super_edit->is_installed ) return $tinymce_plugins;
	
	if ( !is_array( $wp_super_edit->plugins ) ) return;
	
	foreach( $wp_super_edit->plugins as $plugin ) {
		if ( $plugin->status != 'yes' ) continue;

		if ( $plugin->url != '' ) {
			if ( preg_match("/^(http:|https:)/i", $plugin->url ) ) {
				$tinymce_plugins[$plugin->name] = $plugin->url;
			} else {
				if ( $plugin->url != 'none' ) $tinymce_plugins[$plugin->name] = plugins_url() . $plugin->url;
			}
		} else { 
			// ISSUE: plugin files are now plugin.js
			if ( in_array( $plugin->provider, $wp_super_edit->providers_registered ) ) $tinymce_plugins[$plugin->name] = $wp_super_edit->core_uri . 'tinymce_plugins/' . $plugin->name . '/plugin.js';
		}
	}
	
	//echo 'ISSUE:: TinyMCE Plugins have slashes </br>';
	//print_r( $tinymce_plugins );
	
	return $tinymce_plugins;
}

if ( ! function_exists('wp_super_edit_get_file') ) {
	function wp_super_edit_get_file($path) {
	
		if ( function_exists('realpath') )
			$path = realpath($path);
	
		if ( ! $path || ! @is_file($path) )
			return '';
	
		if ( function_exists('file_get_contents') )
			return @file_get_contents($path);
	
		$content = '';
		$fp = @fopen($path, 'r');
		if ( ! $fp )
			return '';
	
		while ( ! feof($fp) )
			$content .= fgets($fp);
	
		fclose($fp);
		return $content;
	}
}


/**
* WP Super Edit TinyMCE Plugin language filter
*
* This WordPress filter passes plugin language files if activated by WP Super Edit. The /langs/lang.php file builds 
* string pairs suitable for the WordPress method of initializing TinyMCE.
* @global object $wp_super_edit 
*/
function wp_super_edit_tinymce_plugin_lang_filter( $tinymce_langs ) {
	global $wp_super_edit;
		
	if ( !$wp_super_edit->is_installed ) return $tinymce_langs;
	
	if ( !is_array( $wp_super_edit->plugins ) ) return;
	
	$mce_locale = ( '' == get_locale() ) ? 'en' : strtolower( substr(get_locale(), 0, 2) ); // only ISO 639-1
	
	foreach( $wp_super_edit->plugins as $plugin ) {
		if ( $plugin->status != 'yes' ) continue;

		if ( $plugin->url != '' ) {
			/* 
			ISSUE: Not sure how I'll get his to work. External Plugin URLS and Paths need to be built.
			External files are really sensitive since TinyMCE loads them in JS. SSL definitely fails here.
			if ( preg_match("/^(http:|https:)/i", $plugin->url ) ) {
				$tinymce_plugins[$plugin->name] = $plugin->url;
			} else {
				if ( $plugin->url != 'none' ) $tinymce_plugins[$plugin->name] = plugins_url() . $plugin->url;
			}
			*/
		} else { 
			// ISSUE: Stolen from TinyMCE Advanced because it makes sense inline or languages will fail on SSL.
			if ( file_exists( $wp_super_edit->core_path . 'tinymce_plugins/' . $plugin->name . '/langs/langs.php' ) ) {
				if ( in_array( $plugin->provider, $wp_super_edit->providers_registered ) ) $tinymce_langs[$plugin->name] = $wp_super_edit->core_path . 'tinymce_plugins/' . $plugin->name . '/langs/langs.php';
			}
		}
	}
	
	return $tinymce_langs;
}

// ISSUE: Placeholder for json data migrations 
function wp_super_edit_data_encode( $data ) {

}

// ISSUE: Placeholder for json data migrations 
function wp_super_edit_data_decode( $data ) {

}

// ISSUE: Placeholder for json data migrations 
function wp_super_edi_is_json( $string ) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}

// Ye' Ole Debug function
function wpse_debug() {
	global $wp_super_edit;
	print_r( $wp_super_edit );
}

// add_action( 'admin_footer', 'wpse_debug' );
