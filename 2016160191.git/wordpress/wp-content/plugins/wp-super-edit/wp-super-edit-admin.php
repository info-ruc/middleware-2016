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
* Set up administration menus
*
* Function used by WordPress action to set up adminstration menus and pages
* @global object $wp_super_edit 
*/
function wp_super_edit_admin_menu_setup() {
	global $wp_super_edit;
				
	$wp_super_edit_option_page = add_options_page( __( 'WP Super Edit', 'wp_super_edit' ), __( 'WP Super Edit', 'wp_super_edit' ), 'manage_options', basename(__FILE__), 'wp_super_edit_admin_page' );

    if ( $wp_super_edit->management_mode == 'users' ) {
		$wp_super_edit_user_page = add_users_page( __( 'Visual Editor Options', 'wp_super_edit' ), __( 'Visual Editor Options', 'wp_super_edit' ), 'edit_posts', 'wp-super-edit/wp-super-edit-user.php' );
	}
}

/**
* Set up administration interface
*
* Function used by Wordpress to initialize the adminsitrative interface. This function also handles option changes based on user interface.
* @global object $wp_super_edit 
*/
function wp_super_edit_admin_setup() {
	global $wp_super_edit;
	
	if ( isset( $_GET['page'] ) && strstr( $_GET['page'], 'wp-super-edit-' ) != false ) {

		if ( isset( $_REQUEST['wp_super_edit_action'] ) ) {

			check_admin_referer( 'wp_super_edit_nonce-' . $wp_super_edit->nonce );

			switch ( $_REQUEST['wp_super_edit_action'] ) {
				case 'install':
					if ( !current_user_can('manage_options') ) return;
					wp_super_edit_install_db_tables();
					wp_super_edit_wordpress_button_defaults();
					wp_super_edit_set_user_default();
					break;
				case 'uninstall':
					if ( !current_user_can('manage_options') ) return;
					$wp_super_edit->uninstall();
					$wp_super_edit->is_installed = false;
					break;
				case 'options':
					if ( !current_user_can('manage_options') ) return;
					$wp_super_edit->do_options();
					break;
				case 'plugins':
					if ( !current_user_can('manage_options') ) return;
					$wp_super_edit->do_plugins();
					break;
				case 'buttons':
					if ( !current_user_can('edit_posts') ) return;
					$wp_super_edit->do_buttons();
					break;
			}		
		
		}		
	
		if ( $wp_super_edit->ui == 'buttons' ) {

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-dialog' );
			
			add_action('admin_footer', 'wp_super_edit_admin_footer');
		}

		wp_enqueue_style( 'p-super-edit-css', $wp_super_edit->core_uri . 'css/wp_super_edit.css', false, '2.0', 'screen' );

	}
}

/**
* Display administrative WP Super Edit interface
*
* Very advanced control interface for TinyMCE buttons and plugins using
* drag and drop.
* @global object $wp_super_edit 
*/
function wp_super_edit_admin_page() {
	global $wp_super_edit;
		
	$updated = false;
	
	wp_super_edit_ui_header();
	
	if ( isset( $_REQUEST['wp_super_edit_action'] ) ) 
		$wp_super_edit_action = $_REQUEST['wp_super_edit_action'];
	else
		$wp_super_edit_action = '';
	
	if ( !$wp_super_edit->is_installed && $wp_super_edit_action != 'install' ) {
		wp_super_edit_install_ui();
		wp_super_edit_ui_footer();
		return;
	}

	if (  $wp_super_edit_action == 'uninstall' ) {
		wp_super_edit_install_ui();
		wp_super_edit_ui_footer();
		return;
	}
	
	wp_super_edit_admin_menu_ui();

	switch ( $wp_super_edit->ui ) {
		case 'buttons':
			wp_super_edit_buttons_ui();
			break;
		case 'plugins':
			wp_super_edit_plugins_ui();
			break;
		case 'options':
			wp_super_edit_options_ui();
			break;
		default:
			wp_super_edit_options_ui();
	}
	
	wp_super_edit_ui_footer();
}

/**
* Add javascript to the admin footer area
*
* Some complex CSS and javascript functions to operate the WP Super Edit advanced interface.
* @global object $wp_super_edit 
*/
function wp_super_edit_admin_footer() {
	global $wp_super_edit;
?>

<script type="text/javascript">
	// <![CDATA[

	// Define custom jQuery namespace to keep away javascript conflicts
	var wpsuperedit = jQuery.noConflict();

	// Default Variables and Objects
		
	function wp_super_edit_button( desc, notice, status, plugin ) {
		this.desc = desc;
		this.notice = notice;
		this.status = status;
		this.plugin = plugin;
	  }
	
	var data;
	var button_separators = new Array();
	var tiny_mce_buttons = new Object();
	var buttons = new Array();
	

	
	<?php wp_super_edit_buttons_js_objects(); ?>
	
	// Plugin and Button Control Functions
	
	function toggleSeparator(button) {
		wpsuperedit( '#' + button ).toggleClass( 'button_separator' );
	}

	function getButtonInfo(button) {

		var wpse_dialog = wpsuperedit( '<div></div>' )
			.html( '<p>' + tiny_mce_buttons[button].notice + '</p>' )
			.dialog( { 
				title: tiny_mce_buttons[button].desc,
				resizable: false,
				draggable: false,
				modal: true, 
				overlay: { 
					opacity: 0.5,
					background: "black" 
				},
				close: function() {
					wpsuperedit( '#wp_super_edit_dialog' ).addClass( 'hidden' );
				}
			});
			
		wpsuperedit( '#wp_super_edit_dialog' ).removeClass( 'hidden' );
		
		return false;		
	}
	
	function submitButtonConfig() {
	
		wpsuperedit('#i_wp_super_edit_row_1').attr('value', wpsuperedit('#row_section_1').sortable('toArray').join(",") );
		wpsuperedit('#i_wp_super_edit_row_2').attr('value', wpsuperedit('#row_section_2').sortable('toArray').join(",") );
		wpsuperedit('#i_wp_super_edit_row_3').attr('value', wpsuperedit('#row_section_3').sortable('toArray').join(",") );
		wpsuperedit('#i_wp_super_edit_row_4').attr('value', wpsuperedit('#row_section_4').sortable('toArray').join(",") );
		
		submit_separators = wpsuperedit( '.button_separator' ).map(function() {
			return wpsuperedit(this).attr('id');
		}).get().join(",");
		
		wpsuperedit('#i_wp_super_edit_separators').attr('value', submit_separators)	
	}

	wpsuperedit(document).ready(
		function() {
			
			// Drag and Drop Controls
			wpsuperedit('#row_section_1').sortable(
				{
					connectWith: ['#row_section_disabled', '#row_section_2', '#row_section_3', '#row_section_4' ],
					scroll: true,
					placeholder: 'sort_placeholder',
					opacity: 0.7,
					items: '.button_control',
					tolerance: 'pointer'
				}
			);
				
			wpsuperedit('#row_section_2').sortable(
				{
					connectWith: ['#row_section_disabled', '#row_section_1', '#row_section_3', '#row_section_4' ],
					scroll: true,
					placeholder: 'sort_placeholder',
					opacity: 0.7,
					items: '.button_control',
					tolerance: 'pointer'
				}
			);		
			
			wpsuperedit('#row_section_3').sortable(
				{
					connectWith: ['#row_section_disabled', '#row_section_1', '#row_section_2', '#row_section_4' ],
					scroll: true,
					placeholder: 'sort_placeholder',
					opacity: 0.7,
					items: '.button_control',
					tolerance: 'pointer'
				}
			);
			
			wpsuperedit('#row_section_4').sortable(
				{
					connectWith: ['#row_section_disabled', '#row_section_1', '#row_section_2', '#row_section_3' ],
					scroll: true,
					placeholder: 'sort_placeholder',
					opacity: 0.7,
					items: '.button_control',
					tolerance: 'pointer'
				}
			);
			
			wpsuperedit('#row_section_disabled').sortable(
				{
					connectWith: ['#row_section_1', '#row_section_2', '#row_section_3', '#row_section_4' ],
					scroll: true,
					placeholder: 'sort_placeholder',
					opacity: 0.7,
					items: '.button_control',
					tolerance: 'pointer'
				}
			);
		}
	);

	// ]]>
</script> 
<?php
}


/**
* Display or return html tag with attributes.
* @param array $html_options options and content to display
* @return mixed
*/
function wp_super_edit_html_tag( $html = array() ) {

	$attributes = '';
	$composite = '';
	$spacer = '';
	if ( !isset( $html['return'] ) ) $html['return'] = false;
	$reserved = array(
		'tag', 'tag_type', 'attributes', 'tag_content', 'tag_content_before', 'tag_content_after', 'return'
	);
	
	foreach ( $html as $name => $option ) {
		if ( in_array( $name, $reserved ) ) continue;
		$attributes .= $name . '="' . $option . '" ';
	}
	
	if ( isset( $html['attributes'] ) ) $attributes .= $html['attributes'] . ' ' . $attributes;
	
	if ( $attributes != '' ) {
		$attributes = rtrim( $attributes );
		$spacer = ' ';
	}
	
	if ( !isset( $html['tag_type'] ) ) $html['tag_type'] = 'default';
	
	if ( isset( $html['tag_content_before'] ) ) $composite .= $html['tag_content_before'];
	
	switch ( $html['tag_type'] ) {
		case 'single':
			if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
			if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '/>';
			break;
		case 'open':
			if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '>';
			if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];			
			break;
		case 'close':
			if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];		
			if ( isset( $html['tag'] ) ) $composite .= '</' . $html['tag'] . '>';
			break;
		case 'attributes':
			$composite = $attributes;
			break;			
		case 'default':
			if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '>';
			if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
			if ( isset( $html['tag'] ) ) $composite .= '</' . $html['tag'] . '>';			
			break;
	}
	
	if ( isset( $html['tag_content_after'] ) ) $composite .= $html['tag_content_after'];	
	
	if ( $html['return'] == true ) return $composite ;
	
	echo $composite;
}

/**
* WP Super Edit admin nonce field generator for form security
* @param string $action nonce action to make keys
* @return string
*/		
function wp_super_edit_nonce_field( $action = -1 ) { 
	return wp_nonce_field( $action, "_wpnonce", true , false );
}

/**
* Administration interface display header and information
*/
function wp_super_edit_ui_header() {
	global $wp_super_edit;
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'class' => 'wrap',
	) );
	
	if ( $wp_super_edit->user_profile ) return;
	
	wp_super_edit_html_tag( array(
		'tag' => 'h2',
		'tag_content' => __( 'WP Super Edit', 'wp-super-edit' ),
	) );

	wp_super_edit_html_tag( array(
		'tag' => 'p',
		'id' => 'wp_super_edit_info',
		'tag_content' => __( 'To give you more control over the Wordpress TinyMCE WYSIWYG Visual Editor. For more information, visit the <a href="http://funroe.net/projects/super-edit/">WP Super Edit project.</a> You can help continue development by making a <a href="http://funroe.net/contribute/">donation or other contribution</a>.', 'wp-super-edit' ),
	) );
}

/**
* WP Super Edit administration interface footer
*/
function wp_super_edit_ui_footer() {
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
	) );
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'id' => 'wp_super_edit_null',
	) );
}

/**
* Start WP Super Edit administration form
* @param string $action
* @param string $content
* @param boolean $return
* @param string $onsubmit
* @return mixed
*/
function wp_super_edit_form( $action = '', $content = '', $return = false, $onsubmit = '' ) {
	global $wp_super_edit;
	
	$form_contents = wp_super_edit_nonce_field('wp_super_edit_nonce-' . $wp_super_edit->nonce);
	
	$form_contents .= wp_super_edit_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'hidden',
		'name' => 'wp_super_edit_action',
		'value' => $action,
		'return' => true
	) );
	
	$form_contents .= $content;
	
	$form_array =  array(
		'tag' => 'form',
		'id' => 'wp_super_edit_controller',
		'enctype' => 'application/x-www-form-urlencoded',
		'action' => htmlentities( $wp_super_edit->ui_form_url ),
		'method' => 'post',
		'tag_content' => $form_contents,
		'return' => $return
	);
	
	if ( $onsubmit != '' ) $form_array['onsubmit'] = $onsubmit;
	
	if ( $return == true ) return wp_super_edit_html_tag( $form_array );
	
	wp_super_edit_html_tag( $form_array );
	
}

/**
* Form table shell with WordPress admin classes
* @param string $content
* @param boolean $return
* @return mixed
*/
function wp_super_edit_form_table( $content = '', $return = false ) {
	
	$content_array = array(
		'tag' => 'table',
		'class' => 'form-table',
		'tag_content' => $content,
		'return' => $return
	);
	
	if ( $return == true ) return wp_super_edit_html_tag( $content_array );
	
	wp_super_edit_html_tag( $content_array );			
}

/**
* Form table row for WordPress admin
* @param string $header
* @param string $content
* @param boolean $return
* @return mixed
*/
function wp_super_edit_form_table_row( $header = '', $content = '', $return = false ) {
	
	$row_content = wp_super_edit_html_tag( array(
		'tag' => 'th',
		'scope' => 'row',
		'tag_content' => $header,
		'return' => true
	) );
	
	$row_content .= wp_super_edit_html_tag( array(
		'tag' => 'td',
		'tag_content' => $content,
		'return' => true
	) );
	
	$content_array = array(
		'tag' => 'tr',
		'valign' => 'top',
		'tag_content' => $row_content,
		'return' => $return
	);
	
	if ( $return == true ) return wp_super_edit_html_tag( $content_array );
	
	wp_super_edit_html_tag( $content_array );
}

/**
* Form select produces select and options form element
* @param string $option_name
* @param array $options
* @param string $selected
* @param boolean $return
* @return mixed
*/
function wp_super_edit_form_select( $option_name = '', $options = array(), $selected = '', $return = false ) {
	
	$option_content = '';
	
	foreach( $options as $option_value => $option_text ) {
		$option_array = array(
			'tag' => 'option',
			'value' => $option_value,
			'tag_content' => $option_text,
			'return' => true
		);			
		
		if ( $option_value == $selected ) $option_array['selected'] = 'selected';
		
		$option_content .= wp_super_edit_html_tag( $option_array );
	}
	
	$content_array = array(
		'tag' => 'select',
		'name' => $option_name,
		'id' => $option_name,
		'tag_content' => $option_content,
		'return' => $return
	);
	
	if ( $return == true ) return wp_super_edit_html_tag( $content_array );
	
	wp_super_edit_html_tag( $content_array );
}

/**
* Display submit button
* @param string $button_text button value
* @param string $message description text
* @param boolean $return
* @return mixed
*/
function wp_super_edit_submit_button( $button_text = 'Update Options &raquo;', $message = '', $return = false, $primary = false ) {
	
	$button_class = ( !$primary ? 'button' : 'button-primary' );
	
	$content_array = array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'submit',
		'name' => 'wp_super_edit_submit',
		'id' => 'wp_super_edit_submit_id',
		'class' => $button_class,
		'value' => $button_text,
		'tag_content' => $message,
		'return' => $return,
	);

	if ( $return == true ) return wp_super_edit_html_tag( $content_array );
	
	wp_super_edit_html_tag( $content_array );
}

/**
* Display WP Super Edit administration menu
*/
function wp_super_edit_admin_menu_ui() {		
	global $wp_super_edit;

	$ui_tabs['buttons'] = wp_super_edit_html_tag( array(
		'tag' => 'a',
		'href' => htmlentities( $wp_super_edit->ui_url . '&wp_super_edit_ui=buttons' ),
		'tag_content' => __( 'Arrange Editor Buttons', 'wp-super-edit' ),
		'return' => true
	) );
	$ui_tabs['plugins'] = wp_super_edit_html_tag( array(
		'tag' => 'a',
		'href' => htmlentities( $wp_super_edit->ui_url . '&wp_super_edit_ui=plugins' ),
		'tag_content' => __( 'Configure Editor Plugins', 'wp-super-edit' ),
		'return' => true
	) );
	$ui_tabs['options'] = wp_super_edit_html_tag( array(
		'tag' => 'a',
		'href' => htmlentities( $wp_super_edit->ui_url . '&wp_super_edit_ui=options' ),
		'tag_content' => __( 'WP Super Edit Options', 'wp-super-edit' ),
		'return' => true
	) );
	
	$ui_tab_list = '';
	
	foreach ( $ui_tabs as $ui_tab => $ui_tab_html ) {

		if ( $ui_tab == $wp_super_edit->ui ) {
			$current_tab_html = wp_super_edit_html_tag( array(
				'tag' => 'h3',
				'tag_content' => $ui_tab_html,
				'return' => true
			) );
			$ui_tab_html = $current_tab_html;
		}
		
		$list = array(
			'tag' => 'li',
			'tag_content' => $ui_tab_html,
			'return' => true
		);
		
		if ( $ui_tab == $wp_super_edit->ui ) $list['class'] = 'wp_super_edit_ui_current';
		
		$ui_tab_list .= wp_super_edit_html_tag( $list );
	}
	
	wp_super_edit_html_tag( array(
		'tag' => 'ul',
		'tag_content' => $ui_tab_list,
		'id' => 'wp_super_edit_ui_menu'
	) );
	
}

/**
* Display the current management mode
*/
function wp_super_edit_display_management_mode() {
	global $wp_super_edit;

	if( empty( $wp_super_edit->management_modes[ $wp_super_edit->management_mode ] ) )
		$management_mode = 'single';
	else
		$management_mode = $wp_super_edit->management_mode;

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'id' => 'wp_super_edit_management_mode',
		'tag_content' => __( 'Management Mode: ', 'wp-super-edit' ) . $wp_super_edit->management_modes[ $management_mode ]
	) );
}

/**
* Display installation user interfaces
*/
function wp_super_edit_install_ui() {
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_installer'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_install_form',
		'class' => 'wp_super_edit_install'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'p',
		'tag_content' => __( '<strong>Install default settings and database tables for WP Super Edit.</strong>', 'wp-super-edit' )
	) );			
	
	$button = wp_super_edit_submit_button( __( 'Install WP Super Edit', 'wp-super-edit' ), '', true, true );
	
	wp_super_edit_form( 'install', $button );
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );
}

/**
* Display deactivation user interface
*/
function wp_super_edit_uninstall_ui() {
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_deactivate'
	) );
				
	$button = wp_super_edit_submit_button( __( 'Uninstall WP Super Edit Database Tables', 'wp-super-edit' ), __( '<strong>This option will remove settings for WP Super Edit. </strong>', 'wp-super-edit' ), true );

	wp_super_edit_form( 'uninstall', $button );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );
}


/**
* Display WP Super Edit Options Interface
*/
function wp_super_edit_options_ui() {
	global $wp_super_edit;

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_settings'
	) );

	wp_super_edit_display_management_mode();
	
	$submit_button = wp_super_edit_submit_button( __( 'Update Options', 'wp-super-edit' ), '', true, true );
	$submit_button_group = wp_super_edit_html_tag( array(
		'tag' => 'p',
		'class' => 'submit',
		'tag_content' => $submit_button,
		'return' => true
	) );
	
	$mode_select = wp_super_edit_form_select( 'wp_super_edit_management_mode', $wp_super_edit->management_modes, $wp_super_edit->management_mode, true );
	
	$table_row = wp_super_edit_form_table_row( __( 'Manage editor buttons using:', 'wp-super-edit' ), $mode_select, true );

	$reset_default_user_box = wp_super_edit_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'checkbox',
		'name' => 'wp_super_edit_reset_default_user',
		'id' => 'wp_super_edit_reset_default_user_i',
		'value' => 'reset_default_user',
		'tag_content_after' => __( '<br /> Reset Default User Setting to original TinyMCE editor settings', 'wp-super-edit' ),
		'return' => true
	) );

	$table_row .= wp_super_edit_form_table_row( __( 'Reset Default User Settings:', 'wp-super-edit' ), $reset_default_user_box, true );
	
	$reset_users_box = wp_super_edit_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'checkbox',
		'name' => 'wp_super_edit_reset_users',
		'id' => 'wp_super_edit_reset_users_i',
		'value' => 'reset_users',
		'tag_content_after' => __( '<br /> Reset all users and roles using Default Editor Settings', 'wp-super-edit' ),
		'return' => true
	) );
	
	$table_row .= wp_super_edit_form_table_row( __( 'Reset All User and Role Settings:', 'wp-super-edit' ), $reset_users_box, true );
		
	$form_content = wp_super_edit_form_table( $table_row, true );
	$form_content .= $submit_button_group;
	
	wp_super_edit_form( 'options', $form_content );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );
	
	wp_super_edit_uninstall_ui();

}

/**
* Display WP Super Edit Plugins Interface
*/
function wp_super_edit_plugins_ui() {
	global $wp_super_edit;

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_settings'
	) );
	
	$submit_button = wp_super_edit_submit_button( 'Update Options', '', true, true );
	$submit_button_group = wp_super_edit_html_tag( array(
		'tag' => 'p',
		'class' => 'submit',
		'tag_content' => $submit_button,
		'return' => true
	) );
	
	
	$table_row = ''; 
	foreach ( $wp_super_edit->plugins as $plugin ) {
		
		$plugin_check_box_options = array(
			'tag' => 'input',
			'tag_type' => 'single',
			'type' => 'checkbox',
			'name' => "wp_super_edit_plugins[$plugin->name]",
			'id' => "wp_super_edit_plugins-$plugin->name",
			'value' => 'yes',
			'tag_content_after' => '<br />' . $plugin->description,
			'return' => true
		);
		
		if ( $plugin->status == 'yes' ) $plugin_check_box_options['checked'] = 'checked';
		
		$plugin_check_box = wp_super_edit_html_tag( $plugin_check_box_options );

		$table_row .= wp_super_edit_form_table_row( $plugin->nicename , $plugin_check_box, true );
	}


	$form_content = wp_super_edit_form_table( $table_row, true );
	$form_content .= $submit_button_group;
	
	wp_super_edit_form( 'plugins', $form_content );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );

}

/**
* Output Javascript array for buttons.
*
* Javascript arrays are used for various client side actions including button positioning and dialog boxes.
*/
function wp_super_edit_buttons_js_objects() {
	global $wp_super_edit;

	foreach ( $wp_super_edit->buttons as $button ) {
		printf("\t\ttiny_mce_buttons['%s'] = new wp_super_edit_button( '%s', '%s' );\n", $button->name, $button->nicename, $button->description );
	}
}


/**
* Display user management interfaces based on options.
*/
function wp_super_edit_user_management_ui() {
	global $wp_roles, $wp_super_edit;
	
	switch ( $wp_super_edit->management_mode ) {
		case 'single':
			$user_management_text = __( 'This arrangement of visual editor buttons will apply to all users', 'wp-super-edit' );
			break;
		case 'roles':
			$user_management_text = __( 'The arrangement of visual editor buttons will apply to all users in the selected Role or Default user button setting.<br />', 'wp-super-edit' );
			
			$roles = Array();

			$roles['wp_super_edit_default'] = __( 'Default Button Settings', 'wp-super-edit' );

			foreach( $wp_roles->role_names as $role => $name ) {
				$name = translate_with_context($name);
				$roles[$role] = $name;
				if ( $_REQUEST['wp_super_edit_manage_role'] == $role || $_REQUEST['wp_super_edit_user'] == $role ) {
					$selected = $role;
				}
			}					
			
			$role_select = wp_super_edit_form_select( 'wp_super_edit_manage_role', $roles, $selected, true );
								
			$submit_button = wp_super_edit_submit_button( __( 'Load Button Settings', 'wp-super-edit' ), '', true );
			$submit_button_group = wp_super_edit_html_tag( array(
				'tag' => 'p',
				'tag_content' => __( 'Select User Role to Edit: ', 'wp-super-edit' ) . $role_select . $submit_button,
				'return' => true
			) );						
			
			$user_management_text .= wp_super_edit_form( 'role_select', $submit_button_group, true, 'submitButtonConfig();' );		

			break;
		case 'users':
			$user_management_text = __( 'Users can arrange buttons under the Users tab. Changes to this button arrangement will only affect the defult button settings.', 'wp-super-edit' );        	
			break;
		default:
			break;
		
	}
	
	$user_management_text = '<strong>' . $wp_super_edit->management_modes[ $wp_super_edit->management_mode ] . ':</strong> ' . $user_management_text;
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'id' => 'wp_super_edit_user_management',
		'tag_content' => $user_management_text
	) );
	
}

/**
* Display WP Super Edit dragable button
*/
function wp_super_edit_make_button_ui( $button, $separator = false ) {
	global $wp_super_edit;

	$button_class = 'button_control';
	
	if ( $separator ) $button_class .= ' button_separator';
	
	$button_info_text = __( 'Button info for ', 'wp-super-edit' );
	
	$button_info = wp_super_edit_html_tag( array(
		'tag' => 'img',
		'tag_type' => 'single',
		'src' => $wp_super_edit->core_uri . 'images/info.png',
		'width' => '14',
		'height' => '16',
		'alt' => $button_info_text. $button->nicename,
		'title' => $button_info_text . $button->nicename,
		'onclick' => "getButtonInfo('$button->name');",
		'return' => true
	) );
	
	$separator_info_text = __( 'Toggle separator for ', 'wp-super-edit' );
	
	$button_separator_toggle = wp_super_edit_html_tag( array(
		'tag' => 'img',
		'tag_type' => 'single',
		'src' => $wp_super_edit->core_uri . 'images/separator.png',
		'width' => '14',
		'height' => '7',
		'alt' => $separator_info_text . $button->nicename,
		'title' => $separator_info_text . $button->nicename,
		'onclick' => "toggleSeparator('$button->name');",
		'return' => true
	) );
	
	$button_options = wp_super_edit_html_tag( array(
		'tag' => 'div',
		'class' => 'button_info',
		'tag_content' => $button_info . $button_separator_toggle,
		'return' => true
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'li',
		'id' => $button->name,
		'class' => $button_class,
		'tag_content' => $button_options . $button->nicename,
	) );
}


/**
* Display WP Super Edit Buttons Interface
*/
function wp_super_edit_buttons_ui() {
	global $userdata, $wp_super_edit;
	
	$user = 'wp_super_edit_default';
	
	switch ( $wp_super_edit->management_mode ) {
		case 'single':
			$user = 'wp_super_edit_default';
			break;
		case 'roles':
			if ( isset( $_REQUEST['wp_super_edit_manage_role'] ) )
				$user = $_REQUEST['wp_super_edit_manage_role'];

			if ( isset( $_REQUEST['wp_super_edit_user'] ) ) 
				$user = $_REQUEST['wp_super_edit_user'];
			
			break;
		case 'users':
			if ( $wp_super_edit->user_profile == true ) $user = $userdata->user_login; 
			break;	
		default:
			break;
	}
	
	if ( !$wp_super_edit->check_registered( 'user', $user ) ) {			
		$wp_super_edit->register_new_user( $user );
	}
	
	$current_user = $wp_super_edit->get_user_settings_ui( $user );
				
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_settings'
	) );			
	
	if ( !$wp_super_edit->user_profile ) wp_super_edit_user_management_ui();
		
	$hidden_form_user = wp_super_edit_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'hidden',
		'id' => 'i_wp_super_edit_user',
		'name' => 'wp_super_edit_user',
		'value' => $user,
		'return' => true
	) );
	
	$hidden_form_items = wp_super_edit_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'type' => 'hidden',
		'id' => 'i_wp_super_edit_separators',
		'name' => 'wp_super_edit_separators',
		'value' => '',
		'return' => true
	) );
	
	for ( $button_row = 1; $button_row <= 4; $button_row += 1) {
	
		$hidden_form_items .= wp_super_edit_html_tag( array(
			'tag' => 'input',
			'tag_type' => 'single',
			'type' => 'hidden',
			'id' => 'i_wp_super_edit_row_' . $button_row,
			'name' => 'wp_super_edit_row_' . $button_row,
			'value' => '',
			'return' => true
		) );
		
	}
	
	$action_options = array(
		'update' => __( 'Update Buttons', 'wp-super-edit' ),
		'reset_default' => __( 'Reset to Defaults', 'wp-super-edit' ),
		'set_default' => __( 'Set as Default', 'wp-super-edit' )
	);

	if ( $user == 'wp_super_edit_default' ) {
		unset( $action_options['set_default'] );
		unset( $action_options['reset_default'] );
	}
	if ( $wp_super_edit->user_profile ) unset( $action_options['set_default'] );

	
	$set_default_controls = wp_super_edit_form_select( 'wp_super_edit_action_control', $action_options, 'update', true );			

	$submit_button = wp_super_edit_submit_button( __( 'Update Button Settings For: ', 'wp-super-edit' ) . $current_user['user_nicename'], $hidden_form_user . $hidden_form_items , true, true );								

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'wp_super_edit_button_save'
	) );

	wp_super_edit_form( 'buttons', $submit_button . $set_default_controls, false, 'submitButtonConfig();' );
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'button_controls'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'button_rows'
	) );

	
	for ( $button_row = 1; $button_row <= 4; $button_row += 1) {
		
		wp_super_edit_html_tag( array(
			'tag' => 'h3',
			'class' => 'row_title',
			'tag_content' => __( 'Editor Button Row ', 'wp-super-edit' ) . $button_row
		) );

		
		wp_super_edit_html_tag( array(
			'tag' => 'ul',
			'tag_type' => 'open',
			'id' => 'row_section_' . $button_row,
			'class' => 'row_section'
		) );				
		
		foreach( $current_user['buttons'][$button_row] as $button_num => $button ) {

			$separator = false;
			
			if ( isset( $current_user['buttons'][$button_row][$button_num +1] ) && $current_user['buttons'][$button_row][$button_num +1] == '|' ) $separator = true;
			
			if ( $button == '|' ) continue;

			if ( !$wp_super_edit->check_registered( 'button', $button ) ) {
				$button_not_registered[] = $button;
				continue;
			}
								
			if ( !isset( $wp_super_edit->active_buttons[$button] ) ) continue;
			
			wp_super_edit_make_button_ui( $wp_super_edit->active_buttons[$button], $separator );
			
			$button_used[] = $button;
		
		}
		
		wp_super_edit_html_tag( array(
			'tag' => 'ul',
			'tag_type' => 'close'
		) );

	}
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'id' => 'disabled_buttons'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'h3',
		'class' => 'row_title',
		'tag_content' => __( 'Disabled Buttons', 'wp-super-edit' )
	) );

	wp_super_edit_html_tag( array(
		'tag' => 'ul',
		'tag_type' => 'open',
		'id' => 'row_section_disabled',
		'class' => 'row_section'
	) );
	
	foreach ( $wp_super_edit->active_buttons as $button => $button_options ) {
		
		if ( is_array( $button_used ) ) {		
			if ( in_array( $button, $button_used ) ) continue;
		}
		
		wp_super_edit_make_button_ui( $wp_super_edit->active_buttons[$button] );

	}

	wp_super_edit_html_tag( array(
		'tag' => 'ul',
		'tag_type' => 'close'
	) );							

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'br',
		'class' => 'clear',
		'tag_type' => 'single'
	) );			
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );			

	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close'
	) );
	
	wp_super_edit_html_tag( array(
		'tag' => 'div',
		'id' => 'wp_super_edit_dialog',
		'class' => 'hidden'
	) );

}

// End - Superedit Admin Panel //
