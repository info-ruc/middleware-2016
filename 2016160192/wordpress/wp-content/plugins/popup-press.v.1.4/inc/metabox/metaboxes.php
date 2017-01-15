<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category PopupPress
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'pps_meta_boxes', 'metaboxes_PPS' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function metaboxes_PPS( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = 'pps_';
	
	
	
	
	
	// Get the current ID
	$post_id = 0;
	if( isset( $_GET['post'] ) )
		$post_id = $_GET['post'];
	
	// Default Options
	$std = get_option('pps_options');
	$values = get_post_custom($post_id);
	
	
	$meta_boxes[] = array(
		'id'         => 'file_uploader_mbox_pps',
		'title'      => __('Image Uploader', 'PPS'),
		'pages'      => array( 'popuppress', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			
			array(
				'name' => '',
				'id' => '',
				'type' => 'title2',
				'desc' => __('Use this field to upload images', 'PPS'),
			),
			array(
				'id' => $prefix. 'file_repeatable',
				'type' => 'file_repeatable',
				'allow' => array( 'url', 'attachment' ),
				'desc' => '',
			)
			
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'media_mbox_pps',
		'title' => __('Insert Media URL', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Image, audio, video or other media', 'PPS'),
				'id' => '',
				'type' => 'title',
				'desc' => __('Enter a Youtube, Vimeo, DailyMotion, Flickr, SoundCloud, Twitter, or Instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">Embeds</a>.', 'PPS'),
			),
			array(
				'id' => $prefix. 'oembed_repeatable',
				'type' => 'oembed_repeatable',
				'desc' => '',
			)
		)
	);
	
	$meta_boxes[] = array(
		'id'         => 'iframe_mbox_pps',
		'title'      => __('Iframe URL', 'PPS'),
		'pages'      => array( 'popuppress', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			
			array(
				'name' => '',
				'id' => '',
				'type' => 'title2',
				'desc' => __('Add a url to load the content using Iframe', 'PPS'),
			),
			array(
				'id' => $prefix. 'iframe',
				'type' => 'iframe',
				'desc' => '',
			),
			array(
				'name' => '',
				'id' => '',
				'type' => 'title2',
				'desc' => __('Add a height in pixels for the Iframe', 'PPS'),
			),
			array(
				'id' => $prefix. 'iframe_height',
				'type' => 'text_small',
				'std' => '460',
				'desc' => '',
			)
		)
	);
	
	$meta_boxes[] = array(
		'id'         => 'divID_mbox_pps',
		'title'      => __('Custom Content from ID', 'PPS'),
		'pages'      => array( 'popuppress', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			
			array(
				'name' => '',
				'id' => '',
				'type' => 'title2',
				'desc' => __('Add the "id" of the container div that contains the content to insert into the Popup. e.g #div-container', 'PPS'),
			),
			array(
				'id' => $prefix. 'content_by_id',
				'type' => 'text',
				'desc' => '',
			),
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'preview_mbox_pps',
		'title' => __('Popup Preview', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Preview', 'PPS'),
				'id' => $prefix. 'popup_preview',
				'type' => 'popup_preview',
				'desc' => __('Save to view preview', 'PPS'),
			),
			array(
				'name' => __('Shortcode', 'PPS'),
				'id' => '',
				'type' => 'plain_text',
				'std' => '<p style="margin: 5px 0 0; font-size:14px;">[popuppress id="'.$post_id.'"]</p>',
				'desc' => __('Use this Shortcode to display your Popup', 'PPS'),
			),
		)
	);
	

	$meta_boxes[] = array(
		'id' => 'button_mbox_pps',
		'title' => __('Popup Button', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Button Type', 'PPS'),
				'id' => $prefix. 'button_type',
				'type' => 'radio_inline',
				'std' => 'button',
				'options' => array(
					array('name' => __('Button','PPS'), 'value' => 'button'),
					array('name' => __('Image','PPS'), 'value' => 'image'),
					array('name' => __('No Button','PPS'), 'value' => 'no-button'),
				),
				'desc' => __('Choose the type of button Popup', 'PPS'),
			),
			
			array(
				'name' => __('Button Text', 'PPS'),
				'id' => $prefix. 'button_text',
				'type' => 'text',
				'std' => $std['button_text'],
				'desc' => __('Text for the button that opens the popup', 'PPS'),
			),
			
			array(
				'name' => __('Button Title', 'PPS'),
				'id' => $prefix. 'button_title',
				'type' => 'text',
				'std' => $std['button_title'],
				'desc' => __('Button text on hover', 'PPS'),
			),
			array(
				'name' => __('Button Style Class', 'PPS'),
				'id' => $prefix. 'button_class',
				'type' => 'text',
				'std' => $std['button_class'],
				'desc' => __('Add a Class to customize your button using CSS Styles. Use "pps-plain-text" to leave the button without format.', 'PPS'),
			),
			array(
				'name' => __('Class to Execute Popup', 'PPS'),
				'id' => $prefix. 'button_class_run',
				'type' => 'text',
				'std' => '',
				'desc' => __('This class will be used to run the popup when you click on it. E.g: run-popup. The default is "pps-button-popup-45", where 45 is the id of the popup. Without point.', 'PPS'),
			),
		
			array(
				'name' => 'Button Image',
				'id' => $prefix . 'button_image',
				'type' => 'file',
				'save_id' => false, // save ID using true
				'desc' => __('Upload an image or enter an URL.', 'PPS'),
			),
			array(
				'name' => __('Image Width Button', 'PPS'),
				'id' => $prefix. 'img_width_button',
				'type' => 'text_small',
				'std' => $std['img_width_button'],
				'desc' => __('(px)', 'PPS'),
			),
		)
	);
	
/*
	Soluciona incompatibilidad con la opción
	"Open on Hover" de la versión anterior
*/
	$run_method = 'click';
	if($values['pps_run_on_hover'][0] == 'yes') {
		$run_method = 'mouseover';
	}
	
	$meta_boxes[] = array(
		'id' => 'open_mbox_pps',
		'title' => __('Open Settings', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Open hook', 'PPS'),
				'id' => $prefix. 'open_hook',
				'type' => 'radio',
				'std' => $run_method,
				'options' => array(
					array('name' => __('Click','PPS'), 'value' => 'click'),
					array('name' => __('Hover','PPS'), 'value' => 'mouseover'),
					array('name' => __('Leave page','PPS'), 'value' => 'leave_page'),
				),
				'desc' => __('Action that will trigger the popup', 'PPS'),
			),
			
			array(
				'name' => __('Open in', 'PPS'),
				'id' => $prefix. 'open_in',
				'type' => 'radio',
				'std' => 'pages',
				'options' => array(
					array('name' => __('Specific pages','PPS'), 'value' => 'pages'),
					array('name' => __('Home','PPS'), 'value' => 'home'),
					array('name' => __('All site','PPS'), 'value' => 'all-site'),
				),
				'desc' => __('Choose where to run the popup.', 'PPS'),
			),
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'auto_open_mbox_pps',
		'title' => __('Automatically Open Settings', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => __('Auto Open', 'PPS'),
				'id' => $prefix. 'auto_open',
				'type' => 'radio_inline',
				'std' => 'false',
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Opens automatically on page load', 'PPS'),
			),
			
			array(
				'name' => __('Open Delay (ms)', 'PPS'),
				'id' => $prefix. 'delay',
				'type' => 'text_small',
				'std' => '2500',
				'desc' => __('Delay time to run the popup','PPS'),
			),
			
			array(
				'name' => __('Just first time', 'PPS'),
				'id' => $prefix. 'first_time',
				'type' => 'radio_inline',
				'std' => 'false',
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Opens only on the first load', 'PPS'),
			),
			
			array(
				'name' => __('Auto close', 'PPS'),
				'id' => $prefix. 'auto_close',
				'type' => 'radio_inline',
				'std' => 'false',
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Automatically close the popup', 'PPS'),
			),
			array(
				'name' => __('Close Delay (ms)', 'PPS'),
				'id' => $prefix. 'delay_close',
				'type' => 'text_small',
				'std' => '10000',
				'desc' => __('Delay time to close the popup','PPS'),
			),
		)
	);
		
	$meta_boxes[] = array(
		'id' => 'settings_mbox_pps',
		'title' => __('Popup Configuration', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			
			array(
				'name' => __('Popup Style', 'PPS'),
				'id' => $prefix. 'popup_style',
				'type' => 'select',
				'std' => $std['popup_style'],
				'options' => array(
					array('name' => __('Light', 'PPS'), 'value' => 'light'),
					array('name' => __('Dark', 'PPS'), 'value' => 'dark'),
				),
				'desc' => __('Choose the style of the Popup', 'PPS'),
			),
			
			array(
				'name' => __('Show Transparent Border', 'PPS'),
				'id' => $prefix. 'transparent_border',
				'type' => 'radio_inline',
				'std' => $std['transparent_border'],
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Shows a transparent outline around the Popup', 'PPS'),
			),
			
			array(
				'name' => __('Border Radius (px)', 'PPS'),
				'id' => $prefix. 'border_radius',
				'type' => 'text_small',
				'std' => $std['border_radius'],
				'desc' => __('Add value rounded corners to popup. 0 = no rounded corners.', 'PPS'),
			),
			
			array(
				'name' => __('Show Title', 'PPS'),
				'id' => $prefix. 'show_title',
				'type' => 'radio_inline',
				'std' => $std['show_title'],
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Displays the title of the popup', 'PPS'),
			),
			
			array(
				'name' => __('Popup Width', 'PPS'),
				'id' => $prefix. 'width',
				'type' => 'text_small',
				'std' => $std['popup_width'],
				'desc' => __('(px)', 'PPS'),
			),
			array(
				'name' => __('Popup Height', 'PPS'),
				'id' => $prefix. 'height',
				'type' => 'text_small',
				'std' => $std['popup_height'],
				'desc' => __('(px)', 'PPS'),
			),
			array(
				'name' => __('Auto Height', 'PPS'),
				'id' => $prefix. 'auto_height',
				'type' => 'radio_inline',
				'std' => $std['auto_height'],
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Adjust height automatically', 'PPS'),
			),
			
			array(
				'name' => __('Background Overlay', 'PPS'),
				'id' => $prefix. 'bg_overlay',
				'type' => 'colorpicker',
				'std' => $std['bg_overlay'],
				'desc' => __('Select a background color', 'PPS'),
			),
			
			array(
				'name' => __('Advanced Settings', 'PPS'),
				'id' => $prefix. 'more-fields',
				'type' => 'more_fields',
			),
			
			array(
				'name' => __('Opacity Overlay', 'PPS'),
				'id' => $prefix. 'opacity',
				'type' => 'text_small',
				'std' => $std['opacity_overlay'],
				'desc' => __('Transparency, from 0.1 to 1', 'PPS'),
			),
			
			array(
				'name' => __('Position Type', 'PPS'),
				'id' => $prefix. 'position_type',
				'type' => 'select',
				'std' => $std['position_type'],
				'options' => array(
					array('name' => __('Absolute', 'PPS'), 'value' => 'absolute'),
					array('name' => __('Fixed', 'PPS'), 'value' => 'fixed'),
				),
				'desc' => '',
			),
			array(
				'name' => __('Position X (px)', 'PPS'),
				'id' => $prefix. 'position_x',
				'type' => 'text_small',
				'std' => $std['position_x'],
				'desc' => __('Position horizontal the popup. auto=center', 'PPS'),
			),
			array(
				'name' => __('Position Y (px)', 'PPS'),
				'id' => $prefix. 'position_y',
				'type' => 'text_small',
				'std' => $std['position_y'],
				'desc' => __('Position vertical the popup. auto=center', 'PPS'),
			),
			array(
				'name' => __('Speed (ms)', 'PPS'),
				'id' => $prefix. 'speed',
				'type' => 'text_small',
				'std' => $std['popup_speed'],
				'desc' => __('Animation speed on open/close, in milliseconds', 'PPS'),
			),
			array(
				'name' => __('Popup z-index', 'PPS'),
				'id' => $prefix. 'zindex',
				'type' => 'text_small',
				'std' => $std['popup_zindex'],
				'desc' => __('Set the z-index for Popup', 'PPS'),
			),
			array(
				'name' => __('Close Click Overlay', 'PPS'),
				'id' => $prefix. 'close_overlay',
				'type' => 'radio_inline',
				'std' => $std['close_overlay'],
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('Should the popup close on click on overlay?', 'PPS'),
			),
			
			array(
				'name' => __('Transition Effect', 'PPS'),
				'id' => $prefix. 'popup_transition',
				'type' => 'select',
				'std' => $std['popup_transition'],
				'options' => array(
					array('name' => __('fadeIn', 'PPS'), 'value' => 'fadeIn'),
					array('name' => __('slideDown', 'PPS'), 'value' => 'slideDown'),
					array('name' => __('slideIn', 'PPS'), 'value' => 'slideIn'),
				),
				'desc' => 'The transition of the popup when it opens.',
			),
			
			array(
				'name' => __('Easing Effect', 'PPS'),
				'id' => $prefix. 'popup_easing',
				'type' => 'text_small',
				'std' => $std['popup_easing'],
				'desc' => sprintf(__( 'The easing of the popup when it opens. "swing" and "linear". More in %sjQuery Easing%s', 'PPS' ), '<a href="http://jqueryui.com/resources/demos/effect/easing.html" target="_blank">','</a>'),
			),
			
			array(
				'name' => __('Use WP Editor', 'PPS'),
				'id' => $prefix. 'use_wp_editor',
				'type' => 'radio_inline',
				'std' => 'true',
				'options' => array(
					array('name' => __('Yes','PPS'), 'value' => 'true'),
					array('name' => __('Not','PPS'), 'value' => 'false'),
				),
				'desc' => __('If you mark "Not", the Popup will not take content from the Wordpress editor.', 'PPS'),
			),
		)
	);
	
	
	$meta_boxes[] = array(
		'id' => 'sort_mbox_pps',
		'title' => __('Sort content fields', 'PPS'),
		'pages' => array('popuppress'),
		'context' => 'side',
		'priority' => 'default',
		'show_names' => true, // Show field names on the left
		'fields' => array(
		
			array(
				'name' => '',
				'id' => '',
				'type' => 'title2',
				'desc' => __('Use these fields to sort the contents of the popup', 'PPS'),
			),
			
			array(
				'name' => __('Wordpress Editor', 'PPS'),
				'id' => $prefix. 'mbox_editor_order',
				'type' => 'select',
				'std' => 1,
				'options' => array(
					array('name' => __(1, 'PPS'), 'value' => 1),
					array('name' => __(2, 'PPS'), 'value' => 2),
					array('name' => __(3, 'PPS'), 'value' => 3),
					array('name' => __(4, 'PPS'), 'value' => 4),
					array('name' => __(5, 'PPS'), 'value' => 5),
				),
			),
			array(
				'name' => __('Image Uploader', 'PPS'),
				'id' => $prefix. 'mbox_file_order',
				'type' => 'select',
				'std' => 2,
				'options' => array(
					array('name' => __(1, 'PPS'), 'value' => 1),
					array('name' => __(2, 'PPS'), 'value' => 2),
					array('name' => __(3, 'PPS'), 'value' => 3),
					array('name' => __(4, 'PPS'), 'value' => 4),
					array('name' => __(5, 'PPS'), 'value' => 5),
				),
			),
			array(
				'name' => __('Insert Media URL', 'PPS'),
				'id' => $prefix. 'mbox_oembed_order',
				'type' => 'select',
				'std' => 3,
				'options' => array(
					array('name' => __(1, 'PPS'), 'value' => 1),
					array('name' => __(2, 'PPS'), 'value' => 2),
					array('name' => __(3, 'PPS'), 'value' => 3),
					array('name' => __(4, 'PPS'), 'value' => 4),
					array('name' => __(5, 'PPS'), 'value' => 5),
				),
			),
			array(
				'name' => __('Iframe URL', 'PPS'),
				'id' => $prefix. 'mbox_iframe_order',
				'type' => 'select',
				'std' => 4,
				'options' => array(
					array('name' => __(1, 'PPS'), 'value' => 1),
					array('name' => __(2, 'PPS'), 'value' => 2),
					array('name' => __(3, 'PPS'), 'value' => 3),
					array('name' => __(4, 'PPS'), 'value' => 4),
					array('name' => __(5, 'PPS'), 'value' => 5),
				),
			),
			array(
				'name' => __('Custom Content from ID', 'PPS'),
				'id' => $prefix. 'mbox_by_id_order',
				'type' => 'select',
				'std' => 5,
				'options' => array(
					array('name' => __(1, 'PPS'), 'value' => 1),
					array('name' => __(2, 'PPS'), 'value' => 2),
					array('name' => __(3, 'PPS'), 'value' => 3),
					array('name' => __(4, 'PPS'), 'value' => 4),
					array('name' => __(5, 'PPS'), 'value' => 5),
				),
			),
		)
	);
	
	// Add other metaboxes as needed
	
	return $meta_boxes;
}

/**
 * Initialize the metabox class.
 */
add_action( 'init', 'initialize_meta_boxes_PPS', 9999 );

function initialize_meta_boxes_PPS() {

	if ( ! class_exists( 'pps_Meta_Box' ) )
		require_once 'init.php';
}



/* --------------------------------------------------------------------
   Campo Personalizado: Titulo 2
-------------------------------------------------------------------- */

add_action( 'pps_render_title2', 'title2_field_PPS', 10, 2 );
function title2_field_PPS( $field, $meta ) {
	if($field['name'])
		echo '<h5 class="pps_metabox_title2">', $field['name'], '</h5>';
	if($field['desc'])
		echo '<p class="pps_metabox_description">', $field['desc'], '</p>';
}

/* --------------------------------------------------------------------
   Campo Personalizado: Separador
-------------------------------------------------------------------- */

add_action( 'pps_render_separator', 'separator_field_PPS', 10, 2 );
function separator_field_PPS( $field, $meta ) {
	echo '<hr class="pps_metabox_separator">';
}


/* --------------------------------------------------------------------
   Campo Personalizado: Texto Plano
-------------------------------------------------------------------- */

add_action( 'pps_render_plain_text', 'plain_text_field_PPS', 10, 2 );
function plain_text_field_PPS( $field, $meta ) {
	
	if($field['std'])
		echo $field['std'];
	if($field['desc'])
		echo '<p class="pps_metabox_description">', $field['desc'], '</p>';
}

/* --------------------------------------------------------------------
   Campo Personalizado: Más Opciones Avanzadas
-------------------------------------------------------------------- */

add_action( 'pps_render_more_fields', 'more_fields_field_PPS', 10, 2 );
function more_fields_field_PPS( $field, $meta ) {
	echo '<p class="pps-filler">Advanced Fields</p>';
	echo '<div class="pps-more-fields"><h5>Advanced Options <a href="#" class="pps-toggle-fields">Show</a></h5></div>';
}

/* --------------------------------------------------------------------
   Campo Personalizado: Vista Previa
-------------------------------------------------------------------- */

add_action( 'pps_render_popup_preview', 'popup_preview_field_PPS', 10, 2 );
function popup_preview_field_PPS( $field, $meta ) {
	// Get the current ID
	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	echo '<p style="color:#888; margin: 6px 0 0;">';
	if( !isset( $post_id ) ) {
		echo 'Save to see the preview';
	}
	else {
		echo do_shortcode('[popuppress id="'.$post_id.'"]');
	}
	echo '</p>';
}

/* --------------------------------------------------------------------
   Campo Personalizado: Iframe
-------------------------------------------------------------------- */

add_action( 'pps_render_iframe', 'iframe_field_PPS', 10, 2 );
function iframe_field_PPS( $field, $meta ) {
	echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" />','<p class="pps_metabox_description">', $field['desc'], '</p>';
}


/* --------------------------------------------------------------------
   Campo Personalizado: oEmbed Repetible
-------------------------------------------------------------------- */

add_action( 'pps_render_oembed_repeatable', 'oembed_repeatable_field_PPS', 10, 2 );
function oembed_repeatable_field_PPS( $field, $metaArray ) {
    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
    $i = 0;
    if ($metaArray) {  
        foreach($metaArray as $meta) {
            echo '<li class="list-repeatable">'; 
				echo '<input class="pps_oembed" type="text" name="'. $field['id'].'['.$i.']" id="'. $field['id'].'_'.$i.'" value="'. $meta. '" />';
				//echo '<p class="pps_metabox_description">'. $field['desc']. '</p>';
				echo '<p class="pps-spinner spinner"></p>';
				echo '<div id="'. $field['id'].'_'.$i.'_status" class="pps_media_status ui-helper-clearfix embed_wrap">';
					if ( $meta != '' ) {
						$check_embed = $GLOBALS['wp_embed']->run_shortcode( '[embed]'. esc_url( $meta ) .'[/embed]' );
						if ( $check_embed ) {
							echo '<div class="embed_status">';
							echo $check_embed;
							echo '<a href="#" class="pps_remove_file_button" rel="', $field['id'], '" title="'.__('Remove Embed','PPS').'">Remove Embed</a>';
							echo '</div>';
						} else {
							echo __('URL is not a valid oEmbed URL.','PPS');
						}
					}
				echo '</div>';
				echo '<a class="repeatable-remove" href="#" title="Remove">Remove</a>';
				echo '<span class="sort hndle" title="Move">|||</span>';
			echo '</li>'; 
            $i++;  
        }  
    } else {  
        echo '<li class="list-repeatable">'; 
				echo '<input class="pps_oembed" type="text" name="'. $field['id'].'['.$i.']" id="'. $field['id'].'_'.$i.'" value="" />';
				//echo '<p class="pps_metabox_description">'. $field['desc']. '</p>';
				echo '<p class="pps-spinner spinner"></p>';
				echo '<div id="'. $field['id'].'_'.$i.'_status" class="pps_media_status ui-helper-clearfix embed_wrap">';
					
				echo '</div>';
				echo '<a class="repeatable-remove" href="#" title="'.__('Remove','PPS').'">Remove</a>';
				echo '<span class="sort hndle" title="'.__('Move','PPS').'">|||</span>';
			echo '</li>';
    }  
    echo '</ul><a class="repeatable-add button" href="#">Add New</a>'; 
}

/* --------------------------------------------------------------------
   Campo Personalizado: File Repetible
-------------------------------------------------------------------- */

add_action( 'pps_render_file_repeatable', 'file_repeatable_field_PPS', 10, 2 );
function file_repeatable_field_PPS( $field, $metaArray ) {
    echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';  
    $i = 0;
    if ($metaArray) {  
        foreach($metaArray as $meta) {
            echo '<li class="list-repeatable">';
				$input_type_url="text";
				echo '<input class="pps_upload_file" type="' . $input_type_url . '" size="45" id="'. $field['id'].'_'.$i. '" name="'. $field['id'].'['.$i.']" value="', $meta, '" />';
				echo '<input class="pps_upload_button button" type="button" value="Upload File" />';
				echo '<input class="pps_upload_file_id" type="hidden" id="', $field['id'].'_id_'.$i.'" name="', $field['id'].'_id['.$i.']" value="'. get_post_meta( $post->ID, $field['id'].'_id_'.$i,true). '" />';
				echo '<p class="pps_metabox_description">', $field['desc'], '</p>';
				echo '<div id="'. $field['id'].'_status_'.$i.'" class="pps_media_status">';
					if ( $meta != '' ) {
						$check_image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $meta );
						if ( $check_image ) {
							echo '<div class="img_status">';
							echo '<img src="', $meta, '" alt="" />';
							echo '<a href="#" class="pps_remove_file_button" rel="', $field['id'].'_'.$i. '" title="'.__('Remove Image','PPS').'">Remove Image</a>';
							echo '</div>';
						} else {
							$parts = explode( '/', $meta );
							for( $j = 0; $j < count( $parts ); ++$j ) {
								$title = $parts[$j];
							}
							echo 'File: <strong>', $title, '</strong>&nbsp;&nbsp;&nbsp; (<a href="', $meta, '" target="_blank" rel="external">Download</a> / <a href="#" class="pps_remove_file_button" rel="', $field['id'].'_'.$i. '">Remove</a>)';
						}
					}
				echo '</div>';
				echo '<a class="repeatable-remove" href="#" title="'.__('Remove','PPS').'">Remove</a>';
				echo '<span class="sort hndle" title="'.__('Move','PPS').'">|||</span>';
			echo '</li>'; 
            $i++;  
        }  
    } else {  
        echo '<li class="list-repeatable">'; 
				
				$input_type_url="text";
				echo '<input class="pps_upload_file" type="' . $input_type_url . '" size="45" id="'. $field['id'].'_'.$i. '" name="'. $field['id'].'['.$i.']" value="" />';
				echo '<input class="pps_upload_button button" type="button" value="Upload File" />';
				echo '<input class="pps_upload_file_id" type="hidden" id="', $field['id'].'_id_'.$i.'" name="', $field['id'].'_id['.$i.']" value="'. get_post_meta( $post->ID, $field['id'].'_id_'.$i,true). '" />';
				echo '<p class="pps_metabox_description">', $field['desc'], '</p>';
				echo '<div id="'. $field['id'].'_status_'.$i.'" class="pps_media_status">';

					/*echo '<div style="padding: 11px 0px; text-indent: -99999px; height: 0;">File</div>';*/
				echo '</div>';
				echo '<a class="repeatable-remove" href="#" title="'.__('Remove','PPS').'">Remove</a>';
				echo '<span class="sort hndle" title="'.__('Move','PPS').'">|||</span>';
			echo '</li>';
    }  
    echo '</ul><a class="repeatable-add button" href="#">Add New</a>'; 
}



?>