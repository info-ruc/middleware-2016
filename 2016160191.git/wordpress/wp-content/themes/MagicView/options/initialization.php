<?php
function mytheme_initialization_options($wp_customize){
		$wp_customize->add_section('mytheme_initialization_options', array(
        'title'    => __('其他区域调整', 'mytheme'),
        'description' => '整体区域颜色和一些样式的调整。</br>  <a href="http://www.themepark.com.cn" target="_blank">WEB主题公园开发提供</a>  </br>',
        'priority' => 70,
    ));
	
	
	
	
	 $wp_customize->add_setting('mytheme_index_blue', array(
	    'default'        => '#ff4800',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_index_blue', array(
        'label'    => __('所有蓝色，以及鼠标经过的蓝色色值调整', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_index_blue',
    )));	
	
	
	
	
	
	
	
	
	  $wp_customize->add_setting('mytheme_fengexian3', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new Ari_Customize_fengexian_Control($wp_customize, 'mytheme_fengexian3', array(
         'label'      => __('分隔线', 'mytheme_searchkey'),
         'section'    => 'mytheme_initialization_options',
         'settings'   => 'mytheme_fengexian3',
  
      )));
	
	
	
	

 $wp_customize->add_setting('mytheme_left_right', array(
        'default'        => 'value1',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));	
 $wp_customize->add_control('mytheme_left_right', array(
        'label'      => __('内页布局替换', 'mytheme_left_right'),
        'section'    => 'mytheme_initialization_options',
        'settings'   => 'mytheme_left_right',
		'type'    => 'select',
		 'choices'    => array(
            '' => '默认（右边显示主要内容）',
            'none' => '对调（左边显示主要内容）',
          
        ),
    )); 


	
 $wp_customize->add_setting('mytheme_search_color', array(
	    'default'        => '#117dc2',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_search_color', array(
        'label'    => __('多重筛选颜色调整', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_search_color',
    )));	
   
   
   
  

	
		  $wp_customize->add_setting('mytheme_tag_color', array(
	    'default'        => '#117dc2',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_tag_color', array(
        'label'    => __('标签颜色调整', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_tag_color',
    )));
	
	
	$wp_customize->add_setting('mytheme_buy_color', array(
	    'default'        => '#117dc2',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_buy_color', array(
        'label'    => __('内页的按钮颜色', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_buy_color',
    )));
   
   
   
   	$wp_customize->add_setting('mytheme_ppc_color', array(
	    'default'        => '#ccc',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_磷矿_color', array(
        'label'    => __('内页产品模板正文切换选中状态', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_ppc_color',
    )));
	
	   	$wp_customize->add_setting('mytheme_link_color', array(
	    'default'        => '#ccc',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_link_color', array(
        'label'    => __('内页链接文字颜色', 'extraordinaryvision'),
        'section'  => 'mytheme_initialization_options',
        'settings' => 'mytheme_link_color',
    )));
	
	 $wp_customize->add_setting('mytheme_textzise_color', array(
        'default'        => '14',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('mytheme_textzise_color', array(
        'label'      => __('内页文字大小（默认14号字）', 'mytheme_textzise_color'),
        'section'    => 'mytheme_initialization_options',
        'settings'   => 'mytheme_textzise_color',
    ));
	
	$wp_customize->add_setting('mytheme_textlinehight_color', array(
        'default'        => '28',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('mytheme_textlinehight_color', array(
        'label'      => __('内页文字行距（默认24像素）', 'mytheme_textlinehight_color'),
        'section'    => 'mytheme_initialization_options',
        'settings'   => 'mytheme_textlinehight_color',
    ));
	
	
 $wp_customize->add_setting('mytheme_enter_p', array(
        'default'        => '',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));	
 $wp_customize->add_control('mytheme_enter_p', array(
        'label'      => __('内页手段字母缩进', 'mytheme_enter_p'),
        'section'    => 'mytheme_initialization_options',
        'settings'   => 'mytheme_enter_p',
		'type'    => 'select',
		 'choices'    => array(
            '' => '不缩进',
            'suojin' => '缩进2个单位',
          
        ),
    )); 

	
};
add_action('customize_register', 'mytheme_initialization_options');
?>