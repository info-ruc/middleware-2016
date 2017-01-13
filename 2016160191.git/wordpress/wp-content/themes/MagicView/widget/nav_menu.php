<?php 

class nav_menu extends WP_Widget {

	function nav_menu()
	{
		$widget_ops = array('classname'=>'nav_menu','description' => get_bloginfo('template_url').'/images/xuanxiang/11.gif');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="nav_menu",$name='自定义菜单，发送一个菜单到界面上篇【侧边栏】',$widget_ops,$control_ops);  

	}

	function form($instance) { 
	
	    	
		
		 $id =esc_attr($instance['id']);
		
		  $title = esc_attr($instance['title']);
		   $title2 = esc_attr($instance['title2']);
	
	 $nav_menu = esc_attr($instance['nav_menu']);
	?>

<br />




<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('标题:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('title2'); ?>"><?php esc_attr_e('副标题:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title2'); ?>" name="<?php echo $this->get_field_name('title2'); ?>" type="text" value="<?php echo $title2; ?>" /></label></p>


<p>   
<?php 	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) ); ?>
   <label for="<?php echo $this->get_field_id('nav_menu'); ?>">选择一个产品菜单（支持多层菜单）</label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>

</p>



 
 






 
	<?php
    }
	function update($new_instance, $old_instance) { // 更新保存
		return $new_instance;
	}
	function widget($args, $instance) { // 输出显示在页面上
	extract( $args );
	     $id =$instance['id'];
        $before_content = $instance['before_content'];
        $after_content = $instance['after_content'];
		$title= apply_filters('widget_title', empty($instance['title']) ? __('') : $instance['title']);
		$title2= apply_filters('widget_title', empty($instance['title2']) ? __('') : $instance['title2']);

		
	$nav_menu = apply_filters('widget_title', empty($instance['nav_menu']) ? __('') : $instance['nav_menu']);
	
		 
		?>
        
    <div class="m_title"><?php if($title){?><a target="_blank" href="<?php echo get_category_link($cat) ?>"><b><?php echo $title ?></b><?php echo $title2 ?></a><?php } ?></div>    
<div class="nav_menu_widgetss box">

 
   <?php  ob_start(); wp_nav_menu(array( 'walker' => new header_menu(),'container' => false,'menu' => $nav_menu ,'items_wrap' => '<ul id="menu_widgetss" class="menu_widgetss">%3$s</ul>' ) ); ?>
</div>

 
        <?php
	}
}
register_widget('nav_menu');
?>