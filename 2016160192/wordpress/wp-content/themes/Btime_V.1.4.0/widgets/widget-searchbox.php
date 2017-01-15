<?php
class widget_searchbox extends WP_Widget {
	function widget_searchbox() {
		$widget_ops = array( 'classname' => 'widget_searchbox', 'description' => __('搜索', 'haoui') );
		$this->WP_Widget( 'widget_searchbox', 'B-'.__('搜索', 'haoui'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$place = $instance['place'];
		$button = $instance['button'];

		echo $before_widget;
		echo $before_title.$title.$after_title; 
		global $s;
		
		echo '<form method="get" class="search-form" action="'.esc_url( home_url( '/' ) ).'" ><input class="form-control" name="s" type="text" placeholder="'.$place.'" value="'.htmlspecialchars($s).'"><input class="btn" type="submit" value="'.$button.'"></form>';

		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 'title' => __('搜索', 'haoui'), 'place' => __('输入关键字', 'haoui'), 'button' => __('搜索', 'haoui') );
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
				<?php echo __('搜索框默认文字：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('place'); ?>" name="<?php echo $this->get_field_name('place'); ?>" type="text" value="<?php echo $instance['place']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('搜索按钮文字：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo $instance['button']; ?>" />
			</label>
		</p>

<?php
	}
}
