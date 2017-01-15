<?php
class widget_comments extends WP_Widget {
	function widget_comments() {
		$widget_ops = array( 'classname' => 'widget_comments', 'description' => __('显示网友最新评论（头像+名称+评论）', 'haoui') );
		$this->WP_Widget( 'widget_comments', 'B-'.__('最新评论', 'haoui'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$outer = $instance['outer'];

		if( !$outer ){
			$outer = -1;
		}

		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul>';

		global $wpdb;
		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,60) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
		$comments = $wpdb->get_results($sql);
		foreach ( $comments as $comment ) {
			$output .= $comment->user_id.'<li><a'.hui_target_blank().' href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.$comment->post_title.__('上的评论', 'haoui').'">'.hui_get_avatar($user_id=$comment->user_id, $user_email=$comment->comment_author_email).strip_tags($comment->comment_author).' <span class="text-muted">'.timeago( $comment->comment_date_gmt ).__('说：', 'haoui').'<br>'.str_replace(' src=', ' data-original=', convert_smilies(strip_tags($comment->com_excerpt))).'</span></a></li>';
		}
		
		echo $output;

		echo '</ul>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 'title' => __('最新评论', 'haoui'), 'limit' => 8, 'outer' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示数目：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('排除某用户ID：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>

<?php
	}
}


