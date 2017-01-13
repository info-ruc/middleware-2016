<?php 

class nav extends WP_Widget {

	function nav()
	{
		$widget_ops = array('classname'=>'nav','description' => '自动调用页面和分类目录的树形层级链接，如果没有层级，那么他就不会显示出来[注意，这个模块首页无效]');
		$control_ops = array('width' => 200, 'height' => 300);
		parent::WP_Widget($id_base="nav",$name='自动调用页面和分类树形层级【侧边栏】',$widget_ops,$control_ops);  

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
		
     

		
		?>
       
  <?php if(is_category()) {?>
 <?php       
          $cat2 = get_query_var('cat'); 
          $cat = get_category_yes_id($cat2);
          $category = get_category($cat);
				  
				   ?>
          <?php if ( get_category_children($cat) != "" ) { ?>      
<div class="widget_left widget_nav_menu">

<div class="widge_hd">
   <span>
  
       <b><?php echo $category->name ; ?></b><p><?php echo $category->slug ; ?></p>
   </span>
  
   </div>

    <ul> <?php  if ( get_category_children($cat) != "" ) {wp_list_categories("child_of=".$cat."&depth=0&hide_empty=0&title_li="); }?></ul>
</div>

<?php } }?>


 <?php if(is_single()) {?>
 <?php       
          $cat2 = get_query_var('cat'); 
         $cat = get_category_yes_id(the_category_ID(false));
          $category = get_category($cat);
				  
				   ?>
          <?php if ( get_category_children($cat) != "" ) { ?>      
<div class="widget_left widget_nav_menu">

<div class="widge_hd">
   <span>
  
       <b><?php echo $category->name ; ?></b><p><?php echo $category->slug ; ?></p>
   </span>
  
   </div>

    <ul> <?php  if ( get_category_children($cat) != "" ) {wp_list_categories("child_of=".$cat."&depth=0&hide_empty=0&title_li="); }?></ul>
</div>

<?php } }?>
  <?php if(is_page()) {;?>
  
    <?php    global $wpdb;global $post;  
	        $post_data = get_post($post->ID, ARRAY_A);
			$slug = $post_data['post_name'];
			$name = $slug; //page别名
			$parent_id =get_post($post->post_parent, ARRAY_A);
			$parent_slug = $parent_id['post_name'];
			$parent_title = get_the_title($post->post_parent);
			$parent_link =get_page_link($post->post_parent);
        	$childrensd=wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1");
        	if($childrensd !="" ||$post->post_parent){
			 ?>
       <div class="widget_left widget_nav_menu">

<div class="widge_hd">
 <span>
       <b><?php if($post->post_parent){ echo $parent_title ;}else{echo  get_the_title();} ; ?></b><p><?php if($post->post_parent){ echo $parent_slug;}else{echo $slug;}  ?></p>
  </span>
   </div>

   
          <?php if($post->post_parent):  ?>
          <ul class="nav_left">  <?php $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1"); if ($children){ echo $children; }  ?></ul>
        <?php else: ?>
         <ul class="nav_left"> <?php  $children = wp_list_pages("title_li=&child_of=". $post->ID."&echo=0&depth=1");  if ($children){ echo $children; }?></ul>
           <?php endif; ?> 
        
        
</div>
       
        <?php
	}}}
}
register_widget('nav');
?>