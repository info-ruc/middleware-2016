<?php

class wpshare {
	
	private		$ip;
	public		$post_id;
	public		$user_id;
	public		$share_count;
	public		$is_loggedin;
	
	public function __construct($post_id, $user_id){
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->post_id = $post_id;
		$this->user_id = $user_id;
		
		if( $user_id && $user_id > 0 ){
			$this->is_loggedin = true;
		}
		
		$this->share_count();
	}

	public function share_count(){
		global $wpdb, $slm_share_table_name;
		
		// check in the db for share
		$share_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(post_id) FROM $slm_share_table_name WHERE post_id = %d", $this->post_id));
		
		// returns share, return 0 if no share were found
		$this->share_count = $share_count;
		
	}
	
	public function is_share(){
		if( isset($_COOKIE['wp_share_'.$this->post_id]) ){
			return true;
		}

		global $wpdb, $slm_share_table_name;
		
		if($this->is_loggedin){
			// user is logged in	
			$share_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(post_id) FROM $slm_share_table_name
											WHERE	post_id = %d
											AND		user_id = %d", $this->post_id, $this->user_id));
		} else{
			// user not logged in, check by ip address
			$share_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(post_id) FROM $slm_share_table_name
											WHERE	post_id = %d
											AND		ip_address = %s
											AND		user_id = %d", $this->post_id, $this->ip, 0));
		}

		$share_check = intval($share_check);

		return $share_check && $share_check > 0;
	}
	
	public function add_share(){
		global $wpdb, $slm_share_table_name;
		
		if( !$this->is_share() ){
			$wpdb->insert($slm_share_table_name, array('post_id' => $this->post_id, 
													'user_id' => $this->user_id,
													'ip_address' => $this->ip), array('%d', '%d', '%s'));

			$expire = time() + 365*24*60*60;
        	setcookie('wp_share_'.$this->post_id, $this->post_id, $expire, '/', $_SERVER['HTTP_HOST'], false);
		}

		$this->share_count();
	}
		
	public function share_button($odc){
		$class = $this->is_share() ? 'wp-share shareed' : 'wp-share';
		$userId = $this->is_loggedin ? $this->user_id : 0;	
		$postId = $this->post_id;

		$action = "wpshare($postId, $userId)";
		
		$btn_html = '<div class="slmwp_share"><span class="like"><a id="wp-share-%d" class="%s" onclick="%s" href="javascript:;">赞 <span class="count">%d</span></a></span> <span class="shang-p"><a id="shang" href="javascript:;">赏</a> </span><span class="share-s"><a id="share" href="javascript:;">分享</a></span><div class="clear"></div></div>';
		$button = sprintf($btn_html, $postId, $class, $action, $this->share_count);

		return $button;
	}
}

?>
