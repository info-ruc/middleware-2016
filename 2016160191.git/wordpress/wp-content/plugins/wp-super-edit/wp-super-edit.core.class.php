<?php

if ( !class_exists( 'wp_super_edit_core' ) ) {

/**
* WP Super Edit Core Class
*
* This class sets up core functions and variables for WP Super Edit. 
* @package wp-super-edit
* @subpackage wp-super-edit-core-class
*/
    class wp_super_edit_core { 
 
		/**
		* Initialize private variables. Set for php4 compatiblity. 
		*/		
		var $db_prefix;
		var $db_options;
		var $db_plugins;
		var $db_buttons;
		var $db_users;
		
		var $core_path;
		var $core_uri;
		
		var $management_modes;
		var $management_mode;
		
		var $plugins;
		var $buttons;
		var $active_buttons;
		
		var $ui;
		var $ui_url;
		var $ui_form_url;
		
		var $nonce;		
		
		var $user_profile;
		
		var $is_tinymce;
		
		/**
		* Constructor initializes private variables. Set for php4 compatiblity. 
		*/	
        function wp_super_edit_core() { // Maintain php4 compatiblity  
        	global $wpdb, $wp_super_edit_run_mode;

        	// $wpdb->base_prefix for multisite
        	$this->db_options = $wpdb->base_prefix . 'wp_super_edit_options';
        	$this->db_plugins =  $wpdb->base_prefix . 'wp_super_edit_plugins';
        	$this->db_buttons =  $wpdb->base_prefix . 'wp_super_edit_buttons';
        	$this->db_users =  $wpdb->base_prefix . 'wp_super_edit_users';
        	
			$this->core_path = WP_PLUGIN_DIR . '/wp-super-edit/';
        	$this->core_uri = plugins_url() . '/wp-super-edit/';
        	
        	$this->run_mode = $wp_super_edit_run_mode;
        	if ( $this->run_mode == 'off' ) return;
        	
        	$this->is_installed = $this->is_db_installed();
        	
        	$this->ui = false;
        	$this->user_profile = false;
        	
        	$this->management_modes = array(
				'single' => __( 'One editor setting for all users', 'wp-super-edit' ),
				'roles' => __( 'Role based editor settings', 'wp-super-edit' ),
				'users' => __( 'Individual user editor settings', 'wp-super-edit' )
			); 	
        	
        	if ( is_admin() ) {
				if ( isset( $_REQUEST['wp_super_edit_ui'] ) )
					$this->ui = ( !$_REQUEST['wp_super_edit_ui'] ? 'options' : $_REQUEST['wp_super_edit_ui'] );			
				if ( !$this->is_installed ) $this->ui = 'options';
				
				if ( isset( $_REQUEST['page'] ) && strstr( $_REQUEST['page'], 'wp-super-edit-user.php' ) != false ) {
					$this->user_profile = true;
					$this->ui = 'buttons';
				}
				
				$this->ui_url = preg_replace( '/\?.*$/', '', $_SERVER ['REQUEST_URI'] );
				if ( isset( $_REQUEST['page'] ) ) $this->ui_url .= '?page=' . $_REQUEST['page'];
				$this->ui_form_url = $this->ui_url . '&wp_super_edit_ui=' . $this->ui;
				$this->nonce = 'wp-super-edit-update-key';
			}
			
			if ( !$this->is_installed ) return false;
        	
			$tinymce_check = '/tiny_mce_config\.php|page-new\.php|page\.php|post-new\.php|post\.php/';
			
			if ( preg_match( $tinymce_check, $_SERVER['SCRIPT_FILENAME'] ) == 0 ) {
				$this->is_tinymce = false;
			} else {
				$this->is_tinymce = true;
			}           	
        	
        	$this->management_mode = $this->get_option( 'management_mode' );
        	if ( empty( $this->management_mode ) ) $this->management_mode = 'single';
        	
        	$this->providers_registered = apply_filters( 'providers_registered' , array( 'wp-super-edit', 'wp_super_edit', 'wordpress', 'tinymce' ) );
			
			$plugin_query = "
				SELECT name, url, status, provider, callbacks FROM $this->db_plugins
			";
			
			if ( $this->ui == 'plugins' ) {
				$plugin_query = "
					SELECT name, nicename, description, provider, status 
					FROM $this->db_plugins ORDER BY name
				";
			}

			$plugin_result = $wpdb->get_results( $wpdb->prepare( $plugin_query, 0 ) );
									
			foreach ( $plugin_result as $plugin ) {		
				if ( !in_array( $plugin->provider, $this->providers_registered ) ) continue;
				$this->plugins[$plugin->name] = $plugin;
			}
						
			$load_buttons = false;
			
			if ( $this->is_tinymce == true ) $load_buttons = true;
			if ( $this->ui == 'buttons' ) $load_buttons = true;

        	if ( !$load_buttons ) return;

			$button_query = "
				SELECT name, provider, plugin, status FROM $this->db_buttons ORDER BY name
			";
			
			if ( $this->ui == 'buttons' ) {
				$button_query = "
					SELECT name, nicename, description, provider, status 
					FROM $this->db_buttons ORDER BY name
				";
			}
			
			$buttons = $wpdb->get_results( $wpdb->prepare( $button_query, 0 ) );
			
			foreach( $buttons as $button ) {
				if ( !in_array( $button->provider, $this->providers_registered ) ) continue;
				$this->buttons[$button->name] = $button;
				if ( $button->status == 'yes' ) {
					$this->active_buttons[$button->name] = $button;
				}
			}
				
        }
        
		/**
		* Check if database tables are installed. 
		* @return boolean
		*/	
        function is_db_installed() {
        	global $wpdb;
        	if( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $this->db_options ) ) == $this->db_options ) return true;
			return false;
        }

		/**
		* Check if user, plugin, or button is registered in database based on type. 
		* @param string	$type 
		* @param string $name
		* @return boolean
		*/
        function check_registered( $type, $name ) {
        	global $wpdb;
 
			if ( !$this->is_installed ) return false;

			$name_col = 'name';
			$role = '';
	
			switch ( $type ) {
				case 'plugin':
					if ( isset( $this->plugins[$name] ) && $this->plugins[$name]->name == $name ) return true;
					$db_table = $this->db_plugins;
					break;
				case 'button':
					if ( isset( $this->buttons[$name] ) && $this->buttons[$name]->name == $name ) return true;
					$db_table = $this->db_buttons;
					break;
				case 'user':
					$db_table = $this->db_users;
					$name_col = 'user_name';
					$role = " AND user_type='$this->management_mode'";
					break;
				case 'option':
					$db_table = $this->db_options;
			}
			
			$name = esc_sql( $name );
			
			$register_check = $wpdb->get_var( "
				SELECT $name_col FROM $db_table
				WHERE $name_col='$name'$role
			" );
						
			if ( $register_check == $name) return true;
			
			return false;
			
		}
		
		/**
		* Get WP Super Edit option from options database table. 
		* @param string $name
		* @return mixed
		*/
        function get_option( $option_name ) {
        	global $wpdb;
        		
			if ( !$this->is_installed ) return false;

			$option = $wpdb->get_row( $wpdb->prepare( "
				SELECT value FROM $this->db_options
				WHERE name=%s
			", $option_name ) );
		
			if( empty( $option->value ) ) return false;
			$option_value = maybe_unserialize( $option->value );
			
			return $option_value;
        }

		/**
		* Set WP Super Edit option in options database table. 
		* @param string $option_name
		* @param mixed $option_value
		* @return boolean
		*/
        function set_option( $option_name, $option_value ) {
        	global $wpdb;

			if ( !$this->is_installed ) return false;

			$result = $wpdb->get_row( $wpdb->prepare( "
				SELECT * FROM $this->db_options
				WHERE name=%s
			", $option_name ),ARRAY_N);
			
			$option_value = maybe_serialize( $option_value );
			
			if( count( $result ) == 0 ) {
				$result = $wpdb->query( $wpdb->prepare( "
					INSERT INTO $this->db_options
					(name, value) 
					VALUES (%s, %s)
				", $option_name, $option_value ) );
				return true;
			} elseif( count( $result ) > 0 ) {
				$result = $wpdb->query( $wpdb->prepare( "
					UPDATE $this->db_options
					SET value=%s
					WHERE name=%s
					", $option_value, $option_name ) );
				return true;
			}
					
			return false;
        }   

		/**
		* Get user settings from users database table. 
		* @param string $user_name
		* @return object
		*/        
        function get_user_settings( $user_name ) {
        	global $wpdb;
 
			if ( !$this->is_installed ) return false;

			switch ( $this->management_mode ) {
				case 'single':
					$role = " AND user_type='single'";
					break;
				case 'roles':
					$role = " AND user_type='roles'";
					break;
				case 'users':
					$role = " AND user_type='users'";
					break;
			}
			
			if ( $user_name == 'wp_super_edit_default' ) $role = " AND user_type='single'";
			
			$user_settings = $wpdb->get_row( $wpdb->prepare( "
				SELECT user_name, user_nicename, editor_options 
				FROM $this->db_users
				WHERE user_name=%s $role
			", $user_name ) );
						
			return $user_settings;

        }
 
 		/**
		* Filter to set up WordPress TinyMCE settings from stored settings based on mode. Check for unregistered
		* buttons and deactivated plugins.
		* @param array $initArray
		* @return array
		*/ 
		function tinymce_settings( $initArray ) {
			global $current_user;
									
			if ( !$this->is_tinymce ) return $initArray;
			
        	if ( !$this->is_installed ) return $initArray;
			
			switch ( $this->management_mode ) {
				case 'single':
					$user = 'wp_super_edit_default';
					break;
				case 'roles':
					$user_roles = array_keys( $current_user->caps );
					$user = $user_roles[0];
					break;
				case 'users':
					$user = $current_user->user_login;
					break;
			}
			
			if ( !$this->check_registered( 'user', $user ) ) $user = 'wp_super_edit_default';
			
			$user_settings = $this->get_user_settings( $user );
						
			$tinymce_user_settings = maybe_unserialize( $user_settings->editor_options );
			
			$button_check = array_keys( $this->buttons );
						
			for ( $button_row = 1; $button_row <= 4; $button_row += 1) {
				
				// ISSUE: 'theme_advanced_buttons' changed to 'toolbar' in WP 3.9
				$row_name = 'toolbar' . $button_row;
			
				$wp_super_edit_check = explode( ',', $tinymce_user_settings[$row_name] );
				$row_check = explode( ',', $initArray[$row_name] );
				
				$wp_super_edit_row_buttons = array();
				$wp_super_edit_row = '';
				$comma_insert = '';
				$unregistered_buttons = array();
				$unregistered = '';
			
				foreach( $wp_super_edit_check as $button_name ) {
					if ( $button_name == '|' ) {
						$wp_super_edit_row_buttons[] = '|';
						continue;
					}
					if ( !isset( $this->buttons[$button_name] ) ) continue;
					$plugin = $this->buttons[$button_name]->plugin;
					if ( !empty( $plugin ) ) {
						if ( $this->plugins[$plugin]->status != 'yes' ) continue;
					}
					$wp_super_edit_row_buttons[] = $button_name;
				}
				
				foreach( $row_check as $button_name ) {
					if ( $button_name == '|' ||  $button_name == '') continue;
					if ( !in_array( $button_name, $button_check ) ) $unregistered_buttons[] = $button_name;
				}
				if ( !empty( $wp_super_edit_row_buttons ) ) {
					$wp_super_edit_row = implode( ',', $wp_super_edit_row_buttons );
					$comma_insert = ',';
				}
				if ( !empty( $unregistered_buttons ) ) $unregistered = $comma_insert . implode( ',', $unregistered_buttons );
			
								
				$initArray[$row_name] = $wp_super_edit_row . $unregistered;
			
			}
						
			return $initArray;
		
		}

    }

}
