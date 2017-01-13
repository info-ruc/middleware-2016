<?php 

class product_nav extends WP_Widget {

	function product_nav()
	{
		$widget_ops = array('classname'=>'product_nav','description' => get_bloginfo('template_url').'/images/xuanxiang/bb.gif');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="product_nav",$name='调用多重筛选（不能放在27%宽度和侧边栏）',$widget_ops,$control_ops);  

	}

	function form($instance) { 
		
	?>
	




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
	;	
     

		
		?>
        <div  class="product_nav_index"> 
        <div class="product_nav_index_in">
 <?php  get_template_part( 'product_nav' );  ?>
 </div></div>
        <?php
	}
}
register_widget('product_nav');
?>