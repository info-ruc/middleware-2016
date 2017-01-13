<?php

function themepark_init_css() {
	 $id =get_the_ID();
if(get_option('mytheme_theme_animation_way') =='none'){$mytheme_search_color='index_hight.js' ;}else{$mytheme_search_color='index.js';};
if ( !is_admin()) {
	
	
	   wp_deregister_script('jquery');
	   wp_register_script( 'jquery', get_template_directory_uri() ."/js/jquery-1.11.0.js");
	   wp_enqueue_script('jquery');
	   
	    wp_deregister_script('easing');
	   wp_register_script( 'easing',get_template_directory_uri() ."/js/jquery.easing.1.3.js");
	   wp_enqueue_script('easing');
	      
	    wp_deregister_script('script');
	   wp_register_script( 'script',get_template_directory_uri() ."/js/script.js");
	   wp_enqueue_script('script');

       wp_deregister_script('swiper2');
	   wp_register_script( 'swiper2',get_template_directory_uri() ."/js/swiper2.min.js");
	   wp_enqueue_script('swiper2');
	
	  	   if(!is_home()){
			   if(get_post_meta($id, "customize",true)!='modle1'){
	 
  wp_deregister_script('lightbox');
	   wp_register_script( 'lightbox',get_template_directory_uri() ."/js/lightbox.js");
	   wp_enqueue_script('lightbox');}
	   }
	 

	
	    wp_deregister_style('stylesheet');
	   wp_register_style( 'stylesheet', get_template_directory_uri() .'/style.css');
	   wp_enqueue_style('stylesheet');
	   
	   

	}}

add_action('wp_print_styles', 'themepark_init_css');


	?>