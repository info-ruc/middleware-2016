<?php

if ( class_exists( 'wp_super_edit_core' ) ) {

/**
* WP Super Edit Admin Class
*
* This class uses WP Super Edit core class and variables and extends by creating user interfaces
* and administrative functions for WP Super Edit. 
* @package wp-super-edit
* @subpackage wp-super-edit-admin-class
*/    
    class wp_super_edit_admin extends wp_super_edit_core {
		
		/**
		* Gets user configuration data from user database tables and returns a complex settings 
		* array. User checked for management mode changes.
		* @param string $user_name
		* @return array
		*/
        function get_user_settings_ui( $user_name ) {
        	global $wpdb, $userdata;
        	
			if ( !$this->check_registered( 'user', $user_name ) ) $user_name = 'wp_super_edit_default';
			
			$user_settings = $this->get_user_settings( $user_name );
			
			$current_user['user_name'] = $user_name;
			$current_user['user_nicename'] = $user_settings->user_nicename;
			
			if ( $this->management_mode == 'users' && $this->user_profile == true ) {
				$current_user['user_nicename'] = $userdata->display_name;
			} 
						
			$current_user['editor_options'] = maybe_unserialize( $user_settings->editor_options );

			for ( $button_rows = 1; $button_rows <= 4; $button_rows += 1) {
				// ISSUE: 'theme_advanced_buttons' changed to 'toolbar' in WP 3.9								
				if ( $current_user['editor_options']['toolbar' . $button_rows] == '' ) {
					$current_user['buttons'][$button_rows] = array();
					continue;
				}
				// ISSUE: 'theme_advanced_buttons' changed to 'toolbar' in WP 3.9				
				$current_user['buttons'][$button_rows] = explode( ',', $current_user['editor_options']['toolbar' . $button_rows] );
			}
			
			return $current_user;

        }

		/**
		* Removes database tables for uninstallation. 
		*/
		function uninstall() {
			global $wpdb;
			
			$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS ' . $this->db_options, 0 ));
			$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS ' . $this->db_plugins, 0 ));
			$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS ' . $this->db_buttons, 0 ));
			$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS ' . $this->db_users, 0 ));
						
			$this->is_installed = false;

			// $url = add_query_arg( '_wpnonce', wp_create_nonce( 'deactivate-plugin_wp-super-edit/wp-super-edit.php' ), get_bloginfo('wpurl') . '/wp-admin/plugins.php?action=deactivate&plugin=wp-super-edit/wp-super-edit.php' );
			// wp_redirect( $url );

		}

		/**
		* Set WP Super Edit options from Options administrative interface.
		*/
		function do_options() {
			global $wpdb;
			
			if ( !$this->is_installed ) return false;

			if ( isset( $_REQUEST['wp_super_edit_management_mode'] ) ) {
				$this->set_option( 'management_mode', $_REQUEST['wp_super_edit_management_mode'] );
				$this->management_mode = $this->get_option( 'management_mode' );
			}

			if ( isset( $_REQUEST['wp_super_edit_reset_default_user'] ) && $_REQUEST['wp_super_edit_reset_default_user'] == 'reset_default_user' ) {
				$tiny_mce_scan = $this->get_option( 'tinymce_scan' );
				$this->update_user_settings( 'wp_super_edit_default', $tiny_mce_scan );
			}
			
			if ( isset( $_REQUEST['wp_super_edit_reset_users'] ) && $_REQUEST['wp_super_edit_reset_users'] == 'reset_users' ) {

				$user_settings = $this->get_user_settings( 'wp_super_edit_default' );
						
				$wpdb->query( $wpdb->prepare( "
					UPDATE $this->db_users
					SET editor_options = %s
					WHERE user_name != 'wp_super_edit_default'", 
					$user_settings->editor_options
				), 0 );

			}
		
		}
		
		/**
		* Activate and deactivate WP Super Edit TinyMCE plugins from Plugins administrative interface.
		*/
		function do_plugins() {
			global $wpdb;
			
			if ( !$this->is_installed ) return false;

			foreach ( $this->plugins as $plugin ) {
				if ( isset( $_REQUEST['wp_super_edit_plugins'][$plugin->name] ) && $_REQUEST['wp_super_edit_plugins'][$plugin->name] == 'yes' ) {
					$status = 'yes';
				} else {
					$status = 'no';
				}
				
				$plugin->status = $status;
				
				$this->plugins[$plugin->name] = $plugin;
				
				$plugin_result = $wpdb->query( $wpdb->prepare( "
					UPDATE $this->db_plugins
					SET status=%s
					WHERE name=%s ",
					$status, $plugin->name 
				) );
				$button_result = $wpdb->query( $wpdb->prepare( "
					UPDATE $this->db_buttons
					SET status=%s
					WHERE plugin=%s ",
					$status, $plugin->name 
				) );
			}
									
		}
		
		/**
		* Set button settings from Editor Buttons administrative interface.
		*/
		function do_buttons() {
									
			if ( !$this->is_installed ) return false;

			if ( isset( $_REQUEST['wp_super_edit_action_control'] ) && $_REQUEST['wp_super_edit_action_control'] == 'reset_default' ) {
				$user = 'wp_super_edit_default';
			} else {
				if ( isset( $_REQUEST['wp_super_edit_user'] ) ) $user = $_REQUEST['wp_super_edit_user'];
			}

			$current_settings = $this->get_user_settings_ui( $user );
			$current_user_settings = $current_settings['editor_options'];
			unset( $current_settings );
			
			if ( isset( $_REQUEST['wp_super_edit_action_control'] ) ) {
				if ( $_REQUEST['wp_super_edit_action_control'] == 'update' || $_REQUEST['wp_super_edit_action_control'] == 'set_default' ) {

					if ( isset( $_REQUEST['wp_super_edit_separators'] ) )
						$separators = explode( ',', $_REQUEST['wp_super_edit_separators'] );

					if ( isset( $_REQUEST['wp_super_edit_row_1'] ) )
						$wp_super_edit_rows[1] = explode( ',', $_REQUEST['wp_super_edit_row_1'] );
					if ( isset( $_REQUEST['wp_super_edit_row_2'] ) )
						$wp_super_edit_rows[2] = explode( ',', $_REQUEST['wp_super_edit_row_2'] );
					if ( isset( $_REQUEST['wp_super_edit_row_3'] ) )
						$wp_super_edit_rows[3] = explode( ',', $_REQUEST['wp_super_edit_row_3'] );
					if ( isset( $_REQUEST['wp_super_edit_row_4'] ) )
						$wp_super_edit_rows[4] = explode( ',', $_REQUEST['wp_super_edit_row_4'] );
		
					foreach( $wp_super_edit_rows as $wp_super_edit_row_number => $wp_super_edit_row ) {
						if ( empty( $wp_super_edit_row ) ) continue;
							
						$button_row_setting = array();
						$button_row = '';
						
						foreach( $wp_super_edit_row as $wp_super_edit_button ) {
						
							if ( empty( $wp_super_edit_button ) ) continue;
							
							$button_row_setting[] = $wp_super_edit_button;
							
							if ( in_array( $wp_super_edit_button, $separators ) ) {
								$button_row_setting[] = '|';
							}
						
						}
										
						$button_row = implode( ',', $button_row_setting );
						
						/*
						ISSUE: 'theme_advanced_buttons' changed to 'toolbar' in WP 3.9
						*/
						$button_array_key = 'toolbar' . $wp_super_edit_row_number;
						
						$current_user_settings[$button_array_key] = $button_row;
						
					}
				}
			}

			if ( isset( $_REQUEST['wp_super_edit_user'] ) )
				$this->update_user_settings( $_REQUEST['wp_super_edit_user'], $current_user_settings );

			if ( isset( $_REQUEST['wp_super_edit_action_control'] ) ) {
				if ( $_REQUEST['wp_super_edit_action_control'] == 'set_default' && !$this->user_profile ) {
					$this->update_user_settings( 'wp_super_edit_default', $current_user_settings );
				}
			}
			
		}

		/**
		* Register WP Super Edit TinyMCE plugin in plugin database table. 
		* @param array $plugin 
		*/
        function register_tinymce_plugin( $plugin = array() ) {
        	global $wpdb;

			if ( !$this->is_installed ) return false;

			if ( $this->check_registered( 'plugin', $plugin['name'] ) ) return true;
			
			if ( !isset( $plugin['url'] ) ) $plugin['url'] = '';
			if ( !isset( $plugin['callbacks'] ) ) $plugin['callbacks'] = '';

			$wpdb->query( $wpdb->prepare( "
				INSERT INTO $this->db_plugins
				( name, nicename, description, provider, status, callbacks, url ) 
				VALUES ( %s, %s, %s, %s, %s, %s, %s )", 
				$plugin['name'], $plugin['nicename'], $plugin['description'], $plugin['provider'], $plugin['status'], $plugin['callbacks'], $plugin['url']
			) );
        	
        }
        
		/**
		* Unregister WP Super Edit TinyMCE plugin in plugin database table. 
		* @param string $plugin_name 
		*/
        function unregister_tinymce_plugin( $plugin_name ) {
        	global $wpdb;
        	
			if ( !$this->is_installed ) return false;
						
			if ( $plugin_name == '' ) return false;
			
			$wpdb->query( $wpdb->prepare( "
				DELETE FROM $this->db_plugins
				WHERE name = %s", $plugin_name
			) );
        	
        }        
        
		/**
		* Register WP Super Edit TinyMCE button in button database table. 
		* @param array $button 
		*/
        function register_tinymce_button( $button = array() ) {
        	global $wpdb;
			
			if ( !$this->is_installed ) return false;

			if ( $this->check_registered( 'button', $button['name'] ) ) return true;

			$wpdb->query( $wpdb->prepare( "
				INSERT INTO $this->db_buttons 
				( name, nicename, description, provider, plugin, status )  
				VALUES ( %s, %s, %s, %s, %s, %s )", 
				$button['name'], $button['nicename'], $button['description'], $button['provider'], $button['plugin'], $button['status'] 
			) );

		}
		
		/**
		* Unregister WP Super Edit TinyMCE button in button database table. 
		* @param array $button 
		*/
        function unregister_tinymce_button( $button_name ) {
        	global $wpdb;
			
			if ( !$this->is_installed ) return false;

			if ( $button_name == '' ) return false;

			$wpdb->query( $wpdb->prepare( "
				DELETE FROM $this->db_buttons
				WHERE name = %s", $button_name
			) );

		}		

		/**
		* Register WP Super Edit user settings in users database table. 
		* @param string $user_name 
		* @param string $user_nicename 
		* @param array $user_settings 
		* @param string $type 
		*/
        function register_user_settings( $user_name = 'wp_super_edit_default', $user_nicename = 'Default Editor Settings', $user_settings, $type = 'single' ) {
        	global $wpdb;
			
			if ( !$this->is_installed ) return false;

			if ( $this->check_registered( 'user', $user_name ) ) return;
			
			$settings = maybe_serialize( $user_settings );

			$wpdb->query( $wpdb->prepare( "
				INSERT INTO $this->db_users
				( user_name, user_nicename, user_type, editor_options ) 
				VALUES ( %s, %s, %s, %s )", 
				$user_name, $user_nicename, $type, $settings 
			) );
					
		}

		/**
		* Update WP Super Edit user settings in users database table. 
		* @param string $user_name 
		* @param array $user_settings 
		*/
        function update_user_settings(  $user_name = 'wp_super_edit_default', $user_settings ) {
        	global $wpdb;
			
			if ( !$this->is_installed ) return false;

			$settings = maybe_serialize( $user_settings );
			
			$management_mode = ( $user_name == 'wp_super_edit_default' ? 'single' : $this->management_mode );
						
			$wpdb->query( $wpdb->prepare( "
				UPDATE $this->db_users
				SET editor_options = %s 
				WHERE user_name = %s AND user_type = %s LIMIT 1", 
				$settings, $user_name, $management_mode 
			) );
					
		}

		/**
		* Register new user settings in users database table based on management mode.
		* @param string $user_name 
		*/
		function register_new_user( $user_name ) {
        	global $wpdb, $wp_roles, $userdata;

			if ( !$this->is_installed ) return false;

        	switch ( $this->management_mode ) {
				case 'single':
					return;
				case 'roles':
					if ( isset( $wp_roles->role_names[$user_name] ) ) {
						if ( $this->check_registered( 'user', $user_name ) ) return;
						$nice_name = translate_with_context( $wp_roles->role_names[$user_name] );
						$user_settings = $this->get_user_settings( 'wp_super_edit_default' );
						$editor_options = maybe_unserialize( $user_settings->editor_options );
						$this->register_user_settings( $user_name, $nice_name, $editor_options, $this->management_mode );
					}
					break;
				case 'users':
					if ( $this->check_registered( 'user', $user_name ) ) return;
					$user_settings = $this->get_user_settings( 'wp_super_edit_default' );
					$editor_options = maybe_unserialize( $user_settings->editor_options );
					$this->register_user_settings( $userdata->user_login, 'user', $editor_options, $this->management_mode );
					break;	
				default:
					break;
			}
		
		}
 
    }

}
