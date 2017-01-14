<?php
function mytheme_header_options($wp_customize){
		$wp_customize->add_section('mytheme_header_options', array(
        'title'    => __('网站顶部设置', 'mytheme'),
        'description' => '通过这个选项设置顶部的样式和内容</br>  <a href="http://www.themepark.com.cn" target="_blank">WEB主题公园开发提供</a>',
        'priority' => 60,
    ));

	class Ari_Customize_Textarea_Control extends WP_Customize_Control {
  public $type = 'textarea';
  public function render_content() {

 ?>
  <label>
    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value()); ?></textarea>
  </label>
  <p><?php echo esc_html( $this->description); ?></p>
<?php 
  }
}


	class Ari_Customize_fengexian_Control extends WP_Customize_Control {
  public $type = 'fengexian';
  public function render_content() {

 ?>
 <div style="width:100%; background:#333; margin:15px 0; height:1px;"></div>
  
<?php 
  }
}


  $wp_customize->add_setting('mytheme_logo', array(
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'mytheme_logo', array(
        'label'    => __('logo上传[尺寸高度：73px，宽度不要超过200px]', 'mytheme_logo'),
        'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_logo',
     )
    )); 
	
	
 $wp_customize->add_setting('mytheme_nav_hover', array(
	    'default'        => '#fafafa',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_nav_hover', array(
        'label'    => __('鼠标经过/当前页面时导航的背景颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_nav_hover',
    )));
	
	
	
	 $wp_customize->add_setting('mytheme_title_hover', array(
	    'default'        => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_title_hover', array(
        'label'    => __('鼠标经过/当前页面时标题和副标题的颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_title_hover',
    )));

   
   
	 $wp_customize->add_setting('mytheme_nav_hover_boder', array(
	    'default'        => '#ffa800',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_nav_hover_boder', array(
      'label'    => __('当前页面时导航的描边颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_nav_hover_boder',
    )));
   

	 $wp_customize->add_setting('mytheme_nav_title', array(
	    'default'        => '#333',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_nav_title', array(
      'label'    => __('导航主标题颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_nav_title',
    )));

	 $wp_customize->add_setting('mytheme_nav_title2', array(
	    'default'        => '#ffa800',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_nav_title2', array(
      'label'    => __('导航副标题颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_nav_title2',
    )));
	
	
	
		 $wp_customize->add_setting('mytheme_top_title', array(
	    'default'        => '#ffa800',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mytheme_top_title', array(
      'label'    => __('顶部“登陆注册”等文字颜色', 'extraordinaryvision'),
         'section'  => 'mytheme_header_options',
        'settings' => 'mytheme_top_title',
    )));
	
   
};
add_action('customize_register', 'mytheme_header_options');
?>