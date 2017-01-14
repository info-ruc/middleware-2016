<?php


function pcode_acf_acf_settings_dir($dir)
{
    $dir = PCODE_BASE . '/lib/acf/';
    
    
    return $dir;
    
}


function pcode_acf_register_field_groups()
{
	if(function_exists('register_field_group'))
	{	$options = get_option('Pcode_Apf_Page_Settings');
		$defaultTheme = $options['editor_theme_general'];
		$cssTheme = $options['editor_theme_css'];
		$jsTheme = $options['editor_theme_js'];
		$phpTheme = $options['editor_theme_php'];
		
		
		if(empty($cssTheme) || $cssTheme === "not-set")
		{	$cssTheme = $defaultTheme;
		}
		
		if(empty($jsTheme) || $jsTheme === "not-set")
		{	$jsTheme = $defaultTheme;
		}
		
		if(empty($phpTheme) || $phpTheme === "not-set")
		{	$phpTheme = $defaultTheme;
		}
	
		
		register_field_group(array (
			'key' => 'pcode_group_5867383ba9b3f',
			'title' => 'Custom CSS',
			'fields' => array (
				array (
					'default_value' => 1,
					'message' => '',
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
					'key' => 'pcode_field_5867383badb6e',
					'label' => 'Enabled',
					'name' => 'enabled',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array (
					'mode' => 'css',
					'theme' => $cssTheme,
					'key' => 'pcode_field_5867383badc13',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'acf_code_field',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'pcode_custom_css',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array (
				0 => 'slug',
			),
			'active' => 1,
			'description' => '',
		));
		
		register_field_group(array (
			'key' => 'pcode_group_58674275a89ae',
			'title' => 'Custom JS',
			'fields' => array (
				array (
					'default_value' => 1,
					'message' => '',
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
					'key' => 'pcode_field_58674275af90e',
					'label' => 'Enabled',
					'name' => 'enabled',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
				),
				array (
					'mode' => 'javascript',
					'theme' => $jsTheme,
					'key' => 'pcode_field_58674275af997',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'acf_code_field',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'pcode_custom_js',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array (
				0 => 'slug',
			),
			'active' => 1,
			'description' => '',
		));
		
		register_field_group(array (
			'key' => 'pcode_group_58669e64587c7',
			'title' => 'Custom PHP',
			'fields' => array (
				array (
					'key' => 'pcode_field_5866d6b640124',
					'label' => 'Enabled',
					'name' => 'enabled',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 1,
					'message' => '',
					'ui' => 0,
					'ui_on_text' => '',
					'ui_off_text' => '',
				),
				array (
					'mode' => 'application/x-httpd-php',
					'theme' => $phpTheme,
					'key' => 'pcode_field_58669e6e14bba',
					'label' => 'Code',
					'name' => 'code',
					'type' => 'acf_code_field',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '<?php
		
		
		
		?>',
					'placeholder' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'pcode_custom_php',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => array (
				0 => 'slug',
			),
			'active' => 1,
			'description' => '',
		));
	
	}
	
}

?>