<?php
class widget_postlist extends WP_Widget {
	function widget_postlist() {
		$widget_ops = array( 'classname' => 'widget_postlist', 'description' => __('图文展示（最新文章+热门文章+随机文章）', 'haoui') );
		$this->WP_Widget( 'widget_postlist', 'B-'.__('聚合文章', 'haoui'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters('widget_name', $instance['title']);
		$limit        = $instance['limit'];
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		$showstyle      = $instance['showstyle'];
		// $img = $instance['img'];

		$style = ' class="'.$showstyle.'"';
		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul'.$style.'>';

		$args = array(
			'order'            => DESC,
			'cat'              => $cat,
			'orderby'          => $orderby,
			'showposts'        => $limit,
			'ignore_sticky_posts' => 1
		);
		query_posts($args);
		while (have_posts()) : the_post(); 
		?>
		<li><a<?php echo hui_target_blank(); ?> href="<?php the_permalink(); ?>"><?php if( $showstyle!=='items-03' ) echo '<span class="thumbnail">'.hui_get_thumbnail().'</span>'; ?><div class="text"><?php echo mb_strimwidth(get_the_title(), 0, 40, '…'); echo get_the_subtitle(); ?></div><?php echo hui_get_views($class='text-muted post-views') ?></a></li>
		<?php
			
		endwhile; wp_reset_query();

		echo '</ul>';
		echo $after_widget;

	}

	function form( $instance ) {
		$defaults = array( 
			'title' => __('最新文章', 'haoui'), 
			'limit' => 6, 
			'orderby' => 'date', 
			'showstyle' => 'items-01' 
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('排序：', 'haoui') ?>
				<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php echo __('评论数', 'haoui') ?></option>
					<option value="date" <?php selected('date', $instance['orderby']); ?>><?php echo __('发布时间', 'haoui') ?></option>
					<option value="rand" <?php selected('rand', $instance['orderby']); ?>><?php echo __('随机', 'haoui') ?></option>
				</select>
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示方式：', 'haoui') ?>
				<select style="width:100%;" id="<?php echo $this->get_field_id('showstyle'); ?>" name="<?php echo $this->get_field_name('showstyle'); ?>" style="width:100%;">
					<option value="items-01" <?php selected('items-01', $instance['showstyle']); ?>><?php echo __('图文', 'haoui') ?></option>
					<option value="items-02" <?php selected('items-02', $instance['showstyle']); ?>><?php echo __('图片', 'haoui') ?></option>
					<option value="items-03" <?php selected('items-03', $instance['showstyle']); ?>><?php echo __('文字', 'haoui') ?></option>
				</select>
			</label>
		</p>
		<p>
			<label>
				<?php echo __('分类限制：', 'haoui') ?>
				<a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="<?php echo __('格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的', 'haoui') ?>">？</a>
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示数目：', 'haoui') ?>
				<input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
			</label>
		</p>
		
	<?php
	}
}
