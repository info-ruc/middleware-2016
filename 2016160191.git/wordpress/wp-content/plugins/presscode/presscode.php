<?php
/*
Plugin Name: PressCode
Plugin URI: http://www.pressbits.click
Description: The best and easiest way to add custom code to your WordPress site.
Version: 1.0.11
Author: PressBits
Author URI: http://www.pressbits.click
*/


DEFINE('PCODE_BASE', dirname( __FILE__ ));


require(ABSPATH . WPINC . '/pluggable.php');

require_once(PCODE_BASE . '/lib/tgmpa/class-tgm-plugin-activation.php');
require_once(PCODE_BASE . '/lib/apf/admin-page-framework.php');

require_once(PCODE_BASE . '/presscode-acf.php');
require_once(PCODE_BASE . '/presscode-cpt-extras.php');
require_once(PCODE_BASE . '/presscode-tgmpa.php');
require_once(PCODE_BASE . '/classes/class-pcode-apf-page-settings.php');
require_once(PCODE_BASE . '/classes/class-pcode-apf-page-dashboard.php');
require_once(PCODE_BASE . '/classes/class-pcode-apf-cpt-custom-code-css.php');
require_once(PCODE_BASE . '/classes/class-pcode-apf-cpt-custom-code-js.php');
require_once(PCODE_BASE . '/classes/class-pcode-apf-cpt-custom-code-php.php');


register_activation_hook( __FILE__, 'pcode_plugin_activate');


add_action('admin_enqueue_scripts', 'pcode_enqueue_js');
add_action('admin_menu', 'pcode_admin_menu');
add_action('init', 'pcode_acf_register_field_groups');
add_action('wp_head', 'pcode_insert_css');
add_action('wp_head', 'pcode_insert_js');
add_action('tgmpa_register', 'pcode_tgmpa_register_required_plugins' );

add_filter('post_updated_messages', 'pcode_post_updated_messages');
 

pcode_eval_php();



/* Functions */

function pcode_eval_php()
{	
	if(!function_exists('get_Field'))
	{	
		return;
		
	}
	
	
	$code = "";
	
	
	$customCodes = get_posts(array('numberposts' => -1, 'post_type' => 'pcode_custom_php', 'post_status' => 'publish'));


	foreach($customCodes as $customCode)
	{	$enabled = boolval(get_field('enabled', $customCode->ID));
	
		if($enabled)
		{	$code .= get_field('code', $customCode->ID, false);
		}
		
	}
	
	
	if(!empty($code))
	{	$pos = strpos($code, '<?php');
	
		if($pos !== false)
		{	$code = substr_replace($code, '', $pos, strlen('<?php'));
		}
		
		
		$pos = strrpos($code, '?>');
	
		if($pos !== false)
		{	$code = substr_replace($code, '', $pos, strlen('?>'));
		}
		
		
		$syntaxValid = pcode_check_syntax($code);
		
		if($syntaxValid === true)
		{	
			eval($code);
		
		}
		else
		{	
			pcode_error_log("PressCode: Error executing PHP code.  Code follows:\r\n");
			pcode_error_log($code);
			
		}
		
	}
	
}


function pcode_insert_css()
{	$code = "";
	
	
	$customCodes = get_posts(array('numberposts' => -1, 'post_type' => 'pcode_custom_css', 'post_status' => 'publish'));


	foreach($customCodes as $customCode)
	{	$enabled = boolval(get_field('enabled', $customCode->ID));
	
		if($enabled)
		{	$code .= ('<style>' . get_field('code', $customCode->ID, false) . '</style>');
		}
		
	}
	
	
	if(!empty($code))
	{	
		echo $code;
		
	}
	
}


function pcode_insert_js()
{	$code = "";
	
	
	$customCodes = get_posts(array('numberposts' => -1, 'post_type' => 'pcode_custom_js', 'post_status' => 'publish'));


	foreach($customCodes as $customCode)
	{	$enabled = boolval(get_field('enabled', $customCode->ID));
	
		if($enabled)
		{	$code .= ('<script type="text/javascript">' . get_field('code', $customCode->ID, false) . '</script>');
		}
		
	}
	
	
	if(!empty($code))
	{	
		echo $code;
		
	}
	
}


function pcode_enqueue_js()
{	wp_register_script('pcode-acf-input-code-field-codemirror-mode-clike', plugins_url('presscode') . '/js/presscode-codemirror-5.13-mode-clike.js');
	wp_enqueue_script('pcode-acf-input-code-field-codemirror-mode-clike');
	wp_register_script('pcode-acf-input-code-field-codemirror-mode-php', plugins_url('presscode') . '/js/presscode-codemirror-5.13-mode-php.js');
	wp_enqueue_script('pcode-acf-input-code-field-codemirror-mode-php');
}


function pcode_plugin_activate()
{	
	pcode_init_options();
	
}


function pcode_admin_menu()
{	//add_menu_page('PressCode', 'PressCode', 'manage_options', 'presscode', NULL, 'dashicons-edit');
}


function pcode_init_options()
{	
	add_option('PcodeApfPageSettings', array('editor_theme_general' => 'default'));
	
}


function pcode_check_syntax($code)
{	
	try
	{	eval('return true;function pcodeTestEval(){' . $code . '}');
	}
	catch(ParseError $e)
	{	
		pcode_error_log("PressCode: Error checking syntax.  Error follows:\r\n");
		pcode_error_log($e);
		pcode_error_log("Code follows:\r\n");
		pcode_error_log($code);
		
		
		return false;
		
	}
	
	
	return true;

	//return @eval('return true;function pcodeTestEval(){' . $code . '}');
	
}


function pcode_error_log($obj)
{	
	error_log(print_r($obj, true), 3, ABSPATH . "php_errors.log");
	
}
