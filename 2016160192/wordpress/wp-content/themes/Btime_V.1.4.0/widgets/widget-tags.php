<?php 
class widget_tags extends WP_Widget {
	function widget_tags() {
		$widget_ops = array( 'classname' => 'widget_tags', 'description' => __('显示热门标签', 'haoui') );
		$this->WP_Widget( 'widget_tags', 'B-'.__('标签云', 'haoui'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$count = $instance['count'];

		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul class="widget_tags_inner">';
		$tags_list = get_tags('orderby=count&order=DESC&number='.$count);
		if ($tags_list) { 
			$i = 0;
			foreach($tags_list as $tag) {
				$i++;
				echo '<li><a title="'.$tag->count.__('个话题', 'haoui').'" href="'.get_tag_link($tag).'">'. $tag->name .'</a></li>'; 
			} 
		}else{
			echo __('暂无标签！', 'haoui');
		}
		echo '</ul>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 'title' => __('热门标签', 'haoui'), 'count' => 24 );
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示数量：', 'haoui') ?>
				<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" class="widefat" />
			</label>
		</p>
<?php
	}
}