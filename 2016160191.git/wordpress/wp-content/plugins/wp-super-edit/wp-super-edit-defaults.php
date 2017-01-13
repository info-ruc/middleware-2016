<?php


/**
* WP Super Edit Install Database Tables
*
* Installs default database tables for WP Super Edit.
*/
function wp_super_edit_install_db_tables() {
	global $wpdb, $wp_super_edit;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	if ( !is_object( $wp_super_edit ) ) {
		$wp_super_edit = new wp_super_edit_admin();
	}

	if ( $wp_super_edit->is_installed ) return;

	if ( ! empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if ( ! empty($wpdb->collate) )
		$charset_collate .= " COLLATE $wpdb->collate";

	$install_sql="CREATE TABLE $wp_super_edit->db_options (
	 id bigint(20) NOT NULL auto_increment,
	 name varchar(60) NOT NULL,
	 value text NOT NULL,
	 PRIMARY KEY (id,name),
	 UNIQUE KEY name (name)
	) $charset_collate;
	CREATE TABLE $wp_super_edit->db_plugins (
	 id bigint(20) NOT NULL auto_increment,
	 name varchar(60) NOT NULL,
	 url text NOT NULL,
	 nicename varchar(120) NOT NULL,
	 description text NOT NULL,
	 provider varchar(60) NOT NULL,
	 status varchar(20) NOT NULL default 'no',
	 callbacks varchar(120) NOT NULL,
	 PRIMARY KEY (id,name),
	 UNIQUE KEY name (name)
	) $charset_collate;
	CREATE TABLE $wp_super_edit->db_buttons (
	 id bigint(20) NOT NULL auto_increment,
	 name varchar(60) NOT NULL,
	 nicename varchar(120) NOT NULL,
	 description text NOT NULL,
	 provider varchar(60) NOT NULL,
	 plugin varchar(60) NOT NULL,
	 status varchar(20) NOT NULL default 'no',
	 PRIMARY KEY (id,name),
	 UNIQUE KEY id (id)
	) $charset_collate;
	CREATE TABLE $wp_super_edit->db_users (
	 id bigint(20) NOT NULL auto_increment,
	 user_name varchar(60) NOT NULL,
	 user_nicename varchar(60) NOT NULL,
	 user_type text NOT NULL,
	 editor_options text NOT NULL,
	 PRIMARY KEY (id,user_name),
	 UNIQUE KEY id (id)
	) $charset_collate;";
	
	dbDelta($install_sql);
	
	$wp_super_edit->is_installed = true;
		
}

function wp_super_edit_installer_tinymce_filter( $initArray ) {
	global $wp_super_edit_tinymce_default;
	$wp_super_edit_tinymce_default = $initArray;
	return $initArray;
}
add_filter('tiny_mce_before_init','wp_super_edit_installer_tinymce_filter', 99);


/**
* WP Super Edit Default User
*
* Sets default user settings from most recent TinyMCE scan, sets initial options, and removes unnecessary WordPress options
*/
function wp_super_edit_set_user_default() {
	global $wp_super_edit, $wp_super_edit_tinymce_default;

	// Output buffering to get default TinyMCE init - Since it's the core editor we want the DFW(distraction free writing)
	ob_start();
	if ( function_exists( 'wp_editor' ) ) 
		wp_editor( '', 'null', array( 'dfw' => true ) );
	else
		wp_tiny_mce();
	ob_end_clean();
		
	$wp_super_edit->register_user_settings( 'wp_super_edit_default', 'Default Editor Settings', $wp_super_edit_tinymce_default, 'single' );

	$wp_super_edit->set_option( 'tinymce_scan', $wp_super_edit_tinymce_default );
	$wp_super_edit->set_option( 'management_mode', 'single' );
	
	/**
	* Remove old options for versions 2.2
	*/	
	delete_option( 'wp_super_edit_tinymce_scan' );
	
	/**
	* Remove old options for versions 1.5 
	*/	
	delete_option( 'superedit_options' );
	delete_option( 'superedit_buttons' );
	delete_option( 'superedit_plugins' );
}

/**
* WP Super Edit WordPress Button Defaults
*
* Registers known default TinyMCE buttons included in default WordPress installation
*/
function wp_super_edit_wordpress_button_defaults() {
	global $wp_super_edit;

	if ( !$wp_super_edit->is_installed ) return;
		
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'bold', 
		'nicename' => __( 'Bold', 'wp-super-edit' ), 
		'description' => __( 'Bold content with strong HTML tag. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'italic', 
		'nicename' => __( 'Italic', 'wp-super-edit' ), 
		'description' => __( 'Italicize content with em HTML tag. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'strikethrough', 
		'nicename' => __( 'Strikethrough', 'wp-super-edit' ), 
		'description' => __( 'Strike out content with strike HTML tag. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'bullist', 
		'nicename' => __( 'Bulleted List', 'wp-super-edit' ), 
		'description' => __( 'An unordered list. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'numlist', 
		'nicename' => __( 'Numbered List', 'wp-super-edit' ), 
		'description' => __( 'An ordered list. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'blockquote', 
		'nicename' => __( 'Block Quote', 'wp-super-edit' ), 
		'description' => __( 'Blockquotes are used when quoting other content. Usually this content is displayed as indented.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));

	$wp_super_edit->register_tinymce_button( array(
		'name' => 'hr', 
		'nicename' => __( 'Horizontal Rule', 'wp-super-edit' ), 
		'description' => __( 'Horizonatal rule lines can be used to separate areas.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'alignleft', 
		'nicename' => __( 'Left Alignment', 'wp-super-edit' ), 
		'description' => __( 'Set the alignment to left justification.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'aligncenter', 
		'nicename' => __( 'Center Alignment', 'wp-super-edit' ), 
		'description' => __( 'Set the alignment to center.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'alignright', 
		'nicename' => __( 'Right Alignment', 'wp-super-edit' ), 
		'description' => __( 'Set the alignment to right alignment.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'link', 
		'nicename' => __( 'Create Link', 'wp-super-edit' ), 
		'description' => __( 'Create a link. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'unlink', 
		'nicename' => __( 'Remove Link', 'wp-super-edit' ), 
		'description' => __( 'Remove a link. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'wp_more', 
		'nicename' => __( 'Wordpress More Tag', 'wp-super-edit' ), 
		'description' => __( 'Insert Wordpress MORE tag to divide content to multiple views. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'spellchecker', 
		'nicename' => __( 'Spell Check', 'wp-super-edit' ), 
		'description' => __( 'Wordpress spell check. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'wp_fullscreen', 
		'nicename' => __( 'Distraction Free Writing', 'wp-super-edit' ), 
		'description' => __( 'Toggle WordPress Full Screen editor mode for distraction free writing.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));		
		
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'wp_adv', 
		'nicename' => __( 'Show/Hide Advanced toolbar', 'wp-super-edit' ), 
		'description' => __( 'Built in Wordpress button <strong>normally hidden</strong>. When pressed it will show extra rows of buttons (or press Ctrl-Alt-V on FF, Alt-V on IE).', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'formatselect', 
		'nicename' => __( 'Paragraphs and Headings', 'wp-super-edit' ), 
		'description' => __( 'Set Paragraph or Headings for content.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'underline', 
		'nicename' => __( 'Underline Text', 'wp-super-edit' ), 
		'description' => __( 'Built in Wordpress button to underline selected text.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'alignjustify', 
		'nicename' => __( 'Align Justification', 'wp-super-edit' ), 
		'description' => __( 'Set the alignment to full justification.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'forecolor', 
		'nicename' => __( 'Foreground color', 'wp-super-edit' ), 
		'description' => __( 'Set foreground or text color. May produce evil font tags. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'pastetext', 
		'nicename' => __( 'Paste as Text', 'wp-super-edit' ), 
		'description' => __( 'Paste clipboard text and remove formatting. Useful for pasting text from applications that produce substandard HTML. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'removeformat', 
		'nicename' => __( 'Remove HTML Formatting', 'wp-super-edit' ), 
		'description' => __( 'Removes HTML formatting from selected item. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'charmap', 
		'nicename' => __( 'Special Characters', 'wp-super-edit' ), 
		'description' => __( 'Insert special characters or entities using a visual interface. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));

	$wp_super_edit->register_tinymce_button( array(
		'name' => 'outdent', 
		'nicename' => __( 'Decrease Indentation', 'wp-super-edit' ), 
		'description' => __( 'This will decrease the level of indentation based on content position. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'indent', 
		'nicename' => __( 'Increase Indentation', 'wp-super-edit' ), 
		'description' => __( 'This will increase the level of indentation based on content position. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));

	$wp_super_edit->register_tinymce_button( array(
		'name' => 'undo', 
		'nicename' => __( 'Undo option', 'wp-super-edit' ), 
		'description' => __( 'Undo previous formatting changes. Not useful once you save. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'redo', 
		'nicename' => __( 'Redo option', 'wp-super-edit' ), 
		'description' => __( 'Redo previous formatting changes. Not useful once you save. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));

	$wp_super_edit->register_tinymce_button( array(
		'name' => 'wp_help', 
		'nicename' => __( 'Wordpress Help', 'wp-super-edit' ), 
		'description' => __( 'Built in Wordpress help documentation. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));

	// End WordPress Defaults
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'cleanup', 
		'nicename' => __( 'Clean up HTML', 'wp-super-edit' ), 
		'description' => __( 'Attempts to clean up bad HTML in the editor. Built in Wordpress button.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'image', 
		'nicename' => __( 'Image Link', 'wp-super-edit' ), 
		'description' => __( 'Insert linked image. Wordpress default editor option for first row.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));	
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'anchor', 
		'nicename' => __( 'Anchors', 'wp-super-edit' ), 
		'description' => __( 'Create named anchors.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'sub', 
		'nicename' => __( 'Subscript', 'wp-super-edit' ), 
		'description' => __( 'Format text as Subscript.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'sup', 
		'nicename' => __( 'Superscript', 'wp-super-edit' ), 
		'description' => __( 'Format text as Superscript.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'backcolor', 
		'nicename' => __( 'Background color', 'wp-super-edit' ), 
		'description' => __( 'Set background color for selected tag or text. ', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'wp_page', 
		'nicename' => __( 'Wordpress Next Page Tag', 'wp-super-edit' ), 
		'description' => __( 'Insert Wordpress Next Page tag to divide page content into multiple views.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'yes'
	));
	
	// Start Included Plugin Defaults

	// fullscreen
	
	// WP Super Edit options for this plugin
		
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'fullscreen', 
		'nicename' => __( 'Full Screen', 'wp-super-edit' ), 
		'description' => __( 'Toggle Full Screen editor mode.', 'wp-super-edit' ), 
		'provider' => 'wordpress', 
		'plugin' => '', 
		'status' => 'no'
	));
	
	// contextmenu
	
	// WP Super Edit options for this plugin

	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'contextmenu', 
		'nicename' => __( 'Context Menu', 'wp-super-edit' ), 
		'description' => __( 'TinyMCE context menu is used by some plugins. The context menu is activated by right mouse click or crtl click on Mac in the editor area.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// fonttools

	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'fonttools', 
		'nicename' => __( 'Font Tools', 'wp-super-edit' ), 
		'description' => __( 'Adds the Font Family and Font Size buttons to the editor.', 'wp-super-edit' ), 
		'provider' => 'tinymce', 
		'status' => 'no', 
		'url' => 'none',		
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'fontselect', 
		'nicename' => __( 'Font Select', 'wp-super-edit' ), 
		'description' => __( 'Shows a drop down list of Font Typefaces.', 'wp-super-edit' ), 
		'provider' => 'tinymce', 
		'plugin' => 'fonttools',
		'status' => 'no'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'fontsizeselect', 
		'nicename' => __( 'Font Size Select', 'wp-super-edit' ), 
		'description' => __( 'Shows a drop down list of Font Sizes.', 'wp-super-edit' ), 
		'provider' => 'tinymce', 
		'plugin' => 'fonttools', 
		'status' => 'no'
	));
	
	// code
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'code', 
		'nicename' => __( 'Source Code Plugin', 'wp-super-edit' ), 
		'description' => __( 'Adds code buttons to allow viewing of HTML and other TinyMCE supported source code.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'code', 
		'nicename' => __( 'Source Code', 'wp-super-edit' ), 
		'description' => __( 'View source code used in editor area.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'insertdatetime', 
		'status' => 'no'
	));	
	
	// insertdatetime
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'insertdatetime', 
		'nicename' => __( 'Insert Date / Time Plugin', 'wp-super-edit' ), 
		'description' => __( 'Adds insert date and time buttons to automatically insert date and time.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'insertdatetime', 
		'nicename' => __( 'Insert Date or Time', 'wp-super-edit' ), 
		'description' => __( 'Insert current date or time in editor', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'insertdatetime', 
		'status' => 'no'
	));
	
	// layer
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'layer', 
		'nicename' => __( 'Layers (DIV) Plugin', 'wp-super-edit' ), 
		'description' => __( 'Insert layers using DIV HTML tag. This plugin will change the editor to allow all DIV tags. Provides the Insert Layer, Move Layer Forward, Move Layer Backward, and Toggle Layer Positioning Buttons.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'insertlayer', 
		'nicename' => __( 'Insert Layer', 'wp-super-edit' ), 
		'description' => __( 'Insert a layer using the DIV HTML tag. Be careful layers are tricky to position.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'layer', 
		'status' => 'no'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'moveforward', 
		'nicename' => __( 'Move Layer Forward', 'wp-super-edit' ), 
		'description' => __( 'Move selected layer forward in stacked view.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'layer', 
		'status' => 'no'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'movebackward', 
		'nicename' => __( 'Move Layer Backward', 'wp-super-edit' ), 
		'description' => __( 'Move selected layer backward in stacked view.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'layer', 
		'status' => 'no'
	));
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'absolute', 
		'nicename' => __( 'Toggle Layer Positioning', 'wp-super-edit' ), 
		'description' => __( 'Toggle the layer positioning as absolute or relative. Be careful layers are tricky to position.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'layer', 
		'status' => 'no'
	));
	
	// nonbreaking
	
	// WP Super Edit options for this plugin

	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'nonbreaking', 
		'nicename' => __( 'Nonbreaking Spaces', 'wp-super-edit' ), 
		'description' => __( 'Adds button to insert nonbreaking space entity.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'nonbreaking', 
		'nicename' => __( 'Nonbreaking Space', 'wp-super-edit' ), 
		'description' => __( 'Inserts nonbreaking space entities.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'nonbreaking', 
		'status' => 'no'
	));
	
	// print
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'print', 
		'nicename' => __( 'Print Button Plugin', 'wp-super-edit' ), 
		'description' => __( 'Adds print button to editor that should print only the edit area contents.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'print', 
		'nicename' => __( 'Print', 'wp-super-edit' ), 
		'description' => __( 'Print editor area contents.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'print', 
		'status' => 'no'
	));
	
	// searchreplace

	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'searchreplace', 
		'nicename' => __( 'Search and Replace Plugin', 'wp-super-edit' ), 
		'description' => __( 'Adds search and replace buttons and options to the editor.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'searchreplace', 
		'nicename' => __( 'Search and Replace', 'wp-super-edit' ), 
		'description' => __( 'Search and replace for text in editor area.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'searchreplace', 
		'status' => 'no'
	));
	
	// table
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'table', 
		'nicename' => __( 'Tables Plugin', 'wp-super-edit' ), 
		'description' => __( 'Allows the creation and manipulation of tables using the TABLE HTML tag. Provides the Tables and Table Controls Buttons.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'table', 
		'nicename' => __( 'Tables', 'wp-super-edit' ), 
		'description' => __( 'Interface to create and change table, row, and cell properties.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'table', 
		'status' => 'no'
	));
	
	// advanced list
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'advlist', 
		'nicename' => __( 'Advanced List Plugin', 'wp-super-edit' ), 
		'description' => __( 'Allows the creation and manipulation of lists with advanced options.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'numlist', 
		'nicename' => __( 'Advanced Numbered Lists', 'wp-super-edit' ), 
		'description' => __( 'Interface for advanced numbered lists.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'advlist', 
		'status' => 'no'
	));	
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'bullist', 
		'nicename' => __( 'Advanced Bulletied Lists', 'wp-super-edit' ), 
		'description' => __( 'Interface for advanced bulleted lists.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'advlist', 
		'status' => 'no'
	));	
	
	// advanced list
	
	// WP Super Edit options for this plugin
	
	$wp_super_edit->register_tinymce_plugin( array(
		'name' => 'anchor', 
		'nicename' => __( 'Anchor Plugin', 'wp-super-edit' ), 
		'description' => __( 'Allows the creation and manipulation of anchors with advanced options.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'status' => 'no', 
		'callbacks' => ''
	));
	
	// Tiny MCE Buttons provided by this plugin
	
	$wp_super_edit->register_tinymce_button( array(
		'name' => 'anchor', 
		'nicename' => __( 'Anchors', 'wp-super-edit' ), 
		'description' => __( 'Interface for anchor options.', 'wp-super-edit' ), 
		'provider' => 'wp_super_edit', 
		'plugin' => 'anchor', 
		'status' => 'no'
	));	
			
}
