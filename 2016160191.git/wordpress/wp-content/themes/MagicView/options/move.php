<?php
function mytheme_move_opion($wp_customize){
	
	  $wp_customize->add_section('mytheme_detects_scheme', array(
        'title'    => __('移动设备设置', 'mytheme'),
        'description' => '<strong>【付费版主题可以直接在此处提供移动版预览设置的方式，免费版未提供移动设备的兼容功能，故不能显示相关选项】</strong><br />
若你对付费版感兴趣，可以查看付费版演示以及详细介绍</br>  <a href="http://www.themepark.com.cn/msscwordpressqyzt.html" target="_blank">魔术视差付费版主题详情</a>  </br>',
        'priority' => 79,
    ));
	  $wp_customize->add_setting('mytheme_detects', array(
        'default'        => 'value1',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('mytheme_detects', array(
        'label'      => __('移动设备调试信息', 'mytheme_detects'),
        'section'    => 'mytheme_detects_scheme',
        'settings'   => 'mytheme_detects',
		'type'    => 'select',
		 'choices'    => array(
            '' => 'pc端效果',
            '' => 'pc端效果',
			
           
        ),
    )); 
	 
	
};
add_action('customize_register', 'mytheme_move_opion');		
?>