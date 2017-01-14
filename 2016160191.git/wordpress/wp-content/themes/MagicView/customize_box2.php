<?php 
$customize_box2 =
array(

   

		
	"cebian" => array(
        "name" => "cebian",
        "std" => "",
        "title" => "侧边栏选择"),
			
	

);
function new_customize_box2() {
    global $post, $customize_box2;
  
       
	    $meta_box_value2 = get_post_meta($post->ID,"customize", true);
		 $meta_box_value3 = get_post_meta($post->ID,"cebian", true);
	
       
        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];
			

	 
	  
	  
  
	      	
	  ?>
   
     
  <div style=" width:100%; padding:10px 0;display:inline-block;overflow: hidden; text-align:center;">
      <a target="_blank" href="http://www.themepark.com.cn/msscwordpressqyzt.html"><img style="max-width:100%; height:auto;" src="<?php echo get_bloginfo('template_url').'/images/magicmagazine_zhemepark_wordpress_theme.jpg'; ?>" /></a>
      <p>感谢使用WEB主题公园出品的免费主题，若觉得好用可以直接升级付费版，付费版可以继承免费版的绝大部分设置。</p> 
      <a class="button" href="http://www.themepark.com.cn/msscwordpressqyzt.html" target="_blank">点击查看</a>
      
      </div>
      
      <?php   
  
 }

function create_meta_box_customize2() {
    global $theme_name;
  
    if ( function_exists('add_meta_box') ) {
      
		
		  add_meta_box( 'new_customize_box2', '关注WEB主题公园', 'new_customize_box2', 'post', 'side', 'high' );
		    add_meta_box( 'new_customize_box2', '关注WEB主题公园', 'new_customize_box2', 'page', 'side', 'high' );
    }
}

function save_postdata_customize2( $post_id ) {
    global $post, $customize_box2;
  
    foreach($customize_box2 as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }
  
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }
  
        $data = $_POST[$meta_box['name']];
  
        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}
add_action('admin_menu', 'create_meta_box_customize2');
add_action('save_post', 'save_postdata_customize2');

?>
