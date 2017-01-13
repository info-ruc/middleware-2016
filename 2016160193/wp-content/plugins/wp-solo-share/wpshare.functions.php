<?php
	function wp_share($odc=false){
		global $user_ID;
		get_currentuserinfo();

		$user_ID = $user_ID ? $user_ID : 0;
		$wpshare = new wpshare(get_the_ID(), $user_ID);

		echo $wpshare->share_button($odc);
	}

	add_action('admin_menu', 'wpshare_menu');
	function wpshare_menu() {
		add_options_page('Solo Share设置', 'Solo Share设置', 'manage_options', basename(__FILE__), 'wpshare_setting_page');
		add_action( 'admin_init', 'wpshare_setting_group');
	}

	function wpshare_setting_group() {
		register_setting( 'wpshare_setting_group', 'wpshare_setting' );
	}	

	function wpshare_setting_page(){
        @include 'include/wpshare-setting.php';
    }

    add_action('admin_enqueue_scripts', 'wpshare_setting_scripts');
    function wpshare_setting_scripts(){
		if( isset($_GET['page']) && $_GET['page'] == "wpshare.functions.php" ){
    		wp_enqueue_style( 'wp-color-picker' );
    		wp_enqueue_script( 'wpshare_setting', wpshare_js_url('wp-share-setting'), array( 'wp-color-picker' ), false, true );	
		}
    }

	function wpshare_install(){
		global $wpdb, $slm_share_table_name;

		if( $wpdb->get_var("show tables like '{$slm_share_table_name}'") != $slm_share_table_name ) {
			$wpdb->query("CREATE TABLE {$slm_share_table_name} (
				id      BIGINT(20) NOT NULL AUTO_INCREMENT,
				post_id BIGINT(20) NOT NULL,
				user_id BIGINT(20) NOT NULL,
				ip_address VARCHAR(25) NOT NULL,
				UNIQUE KEY id (id)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
		}
	}

	function wpshare_uninstall(){
		global $wpdb, $slm_share_table_name;

		$wpdb->query("DROP TABLE IF EXISTS {$slm_share_table_name}");
	}

	function wpshare_plugin_action_link($actions, $plugin_file, $plugin_data){
		if( strpos($plugin_file, 'wp-share') !== false && is_plugin_active($plugin_file) ){
			$myactions = array(
				'option' => "<a href=\"" . SLMWP_ADMIN_URL . "options-general.php?page=wpshare.functions.php\">设置</a>"
			);
			$actions = array_merge($myactions, $actions);
		}
		return $actions;
	}
	add_filter('plugin_action_links', 'wpshare_plugin_action_link', 10, 4);

	function wpshare_scripts(){
		wp_enqueue_style( 'wpshare', wpshare_css_url('wp-share'), array(), SLMWP_VERSION );
		wp_enqueue_script( 'wpshare',  wpshare_js_url('wp-share'), array(), SLMWP_VERSION );
	}
	add_action('wp_enqueue_scripts', 'wpshare_scripts', 20, 10);
	

	
	function wpshare_footer_div(){
		if ( is_single() || is_page()) {?>
<div style="display: none" id="baidu"><div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a href="#" class="bds_mail" data-cmd="mail" title="分享到邮件分享"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div></div>
<script>
jQuery('#shang').jBox('Tooltip', {
    content: '<img src="<?php echo wpshare_get_setting('pay_img');?>" />',
    closeOnMouseleave: true
});
jQuery('#share').jBox('Modal', {
    title: '分享：',
    content: jQuery('#baidu')
});
</script>
	<?php }
	
	}
	add_action( 'wp_footer', 'wpshare_footer_div' );

	
	

	function wpshare_callback(){
		$user_id = $_POST['user_id'];
		$post_id = $_POST['post_id'];

		$wpshare = new wpshare($post_id, $user_id);
		if( $wpshare->is_share() ){
			$result = array(
				'status' => 300
			);
		}else{
			$wpshare->add_share();

			$result = array(
				'status' => 200,
				'count' => $wpshare->share_count
			);
		}

		header('Content-type: application/json');
		echo json_encode($result);
		exit;
	}
	add_action( 'wp_ajax_wpshare', 'wpshare_callback');
	add_action( 'wp_ajax_nopriv_wpshare', 'wpshare_callback');

	/**
	 * 获取设置
	 * @return [array]
	 */
	function wpshare_get_setting($key=NULL){
		$setting = get_option('wpshare_setting');
		return $key ? $setting[$key] : $setting;
	}

	/**
	 * 删除设置
	 * @return [void]
	 */
	function wpshare_delete_setting(){
		delete_option('wpshare_setting');
	}

	/**
	 * [wpshare_setting_key description]
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	function wpshare_setting_key($key){
		if( $key ){
			return "wpshare_setting[$key]";
		}

		return false;
	}

	/**
	 * 升级设置
	 * @param  [array] $setting
	 * @return [void]
	 */
	function wpshare_update_setting($setting){
		update_option('wpshare_setting', $setting);
	}	

	function wpshare_css_url($css_url){
		return SLMWP_URL . "/static/css/{$css_url}.css";
	}

	function wpshare_js_url($js_url){
		return SLMWP_URL . "/static/js/{$js_url}.js";
	}