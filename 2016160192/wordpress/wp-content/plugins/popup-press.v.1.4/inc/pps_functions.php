<?php

/* --------------------------------------------------------------------
   Creamos Tipo de Post "PopupPress"
-------------------------------------------------------------------- */
add_action( 'init', 'create_post_type_popuppress_PPS' );

function create_post_type_popuppress_PPS() {
	$labels = array(
		'name' => __('PopupPress', 'PPS'),
		'singular_name' => __('PopupPress', 'PPS'),
		'add_new' => __('New Popup', 'PPS'),
		'add_new_item' => __('Add New Popup', 'PPS'),
		'edit_item' => __( 'Edit Popup', 'PPS' ),
		'new_item' => __( 'New Popup', 'PPS'),
		'view_item' => __( 'View Popup', 'PPS' ),
		'search_items' => __( 'Search Popup', 'PPS' ),
		'not_found' => __( 'No Popups found', 'PPS' ),
		'not_found_in_trash' => __( 'No Popups found in Trash', 'PPS' ),
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		//'publicly_queryable' => true,
		//'show_ui' => true,
		//'exclude_from_search' => false,
		'show_in_nav_menus' => false,
		
		//'show_in_menu' => true,
		'rewrite' => false,
		'has_archive' => false,
		//'hierarchical' => false,
		'menu_position' => 20,
		'menu_icon' => PPS_URL.'/css/images/icon_plugin.png',
		
		'supports' => array('title','editor'),
	);
	register_post_type('popuppress',$args);
}

/* --------------------------------------------------------------------
  Filtro de Mensajes para el Tipo de Post "PopupPress"
-------------------------------------------------------------------- */
add_filter( 'post_updated_messages', 'messages_popuppress_PPS' );

function messages_popuppress_PPS( $messages ) {
	global $post, $post_ID;
	
	$messages['popuppress'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Popup updated. <a href="%s" class="pps-button-popup-'.$post_ID.'">View Popup</a>', 'PPS'), '#'),
		
		2 => __('Custom field updated.', 'PPS'),
		3 => __('Custom field deleted.', 'PPS'),
		4 => __('Popup updated.', 'PPS'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Popup restored to revision from %s', 'PPS'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Popup published. <a href="%s">View Popup</a>', 'PPS'), esc_url( get_permalink($post_ID) )),
		7 => __('Popup saved.', 'PPS'),
		8 => sprintf( __('Popup submitted. <a target="_blank" href="%s">Preview Popup</a>', 'PPS'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Popup scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Popup</a>', 'PPS'),
		  // translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Popup draft updated. <a target="_blank" href="%s">Preview Popup</a>', 'PPS'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
	return $messages;
}

/* --------------------------------------------------------------------
   Columnas para el Tipo de Post "PopupPress"
-------------------------------------------------------------------- */
add_filter("manage_edit-popuppress_columns", "popuppress_columns_PPS");
 
function popuppress_columns_PPS($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => "Títle",
		"shortcode" => "Shortcode",
		"views" => "Total Views",
		"preview-popup" => "Preview",
		"date" => 'Date',
	);
	return $columns;
}

/* --------------------------------------------------------------------
   Contenido de las Columnas para Popups
-------------------------------------------------------------------- */
add_action('manage_popuppress_posts_custom_column','popuppress_custom_columns_PPS', 10 , 2);

function popuppress_custom_columns_PPS($column, $post_id){
	//global $post;
	$values = get_post_custom($post_id);
	
	$views_count = (int) get_post_meta($post_id, 'pps-views', true);
	
	if($values['pps_button_type'][0] != 'no-button'){
		$popup = do_shortcode('[popuppress id="'.$post_id.'"]');
	}
	else {
		$popup = '<p>No Button</p>';
	}
		
	switch ($column) {
		case 'shortcode':
			echo '<p style="margin: 2px 0 0; font-size:13px;">[popuppress id="'.$post_id.'"]</p>';
			break;
			
		case 'views':
			echo '<p style="margin: 2px 0 0 6px;"><span style="font-size:13px;">'.$views_count.'</span><span style="color: #666;"> views</span></p>';
			break;
		case 'preview-popup':
			echo $popup;
			break;
	}
}


/* --------------------------------------------------------------------
   Código Corto que Muestra el Popup
-------------------------------------------------------------------- */
add_shortcode('popuppress', 'shortcode_popuppress'); 
 
function shortcode_popuppress( $atts, $content = null ) {
	global $wpdb, $post;
	extract( shortcode_atts( array(
		'id' => '',
	), $atts ) );
	
	$popuppress = null;
	
	if( strlen(trim($id)) > 0 ) {
		$popuppress = get_post($id);
	}
	
	//Comprobamos si existe el Popup
	if($popuppress == null)
		return;
	
	$popup = generate_popup_PPS($popuppress->ID);
	$button_popup = button_popup_PPS($popuppress->ID);
	
	return $button_popup.$popup;
}
/* --------------------------------------------------------------------
   Inserta Automáticamente un Popup al Sitio
-------------------------------------------------------------------- */
add_action( 'wp_footer', 'auto_insert_popup_PPS' );
function auto_insert_popup_PPS(){
	$args = array(
		'post_type' 	=> 'popuppress',
		'meta_query' => array(
			array(
			   'key' => 'pps_open_in',
			   'value' => 'pages',
			   'compare' => '!=',
			)
		)
	);     	
	$query_pps = new WP_Query( $args );
	if($query_pps->have_posts()):
		while($query_pps->have_posts()) : $query_pps->the_post();
			$popup_id = get_the_ID();
			$popup = generate_popup_PPS($popup_id);
			$button_popup = button_popup_PPS($popup_id);
			$values = get_post_custom($popup_id);
			$open_in = $values['pps_open_in'][0];
			if($open_in == 'home' && is_home()) {
				echo $button_popup.$popup;
			}
			elseif($open_in == 'all-site') {
				echo $button_popup.$popup;
			}
		endwhile;
	endif;
	wp_reset_postdata();
}

/* --------------------------------------------------------------------
   Función que Genera el Popup
-------------------------------------------------------------------- */

function generate_popup_PPS($popup_id = 0){
	$popup = '';
	$values = get_post_custom($popup_id);
	$border_radius = (int) $values['pps_border_radius'][0];
	$border_radius2 = 0;
	if($border_radius > 0){
		$border_radius2 = $border_radius + 2;
	}
	$width = $values['pps_width'][0];
	$height = 'auto';
	$auto_height = $values['pps_auto_height'][0];
	if($auto_height == 'false' && $values['pps_height'][0] != '')
		$height = $values['pps_height'][0].'px';
		
	$bg_overlay = $values['pps_bg_overlay'][0];
	
	$position_x = $values['pps_position_x'][0];
	$position_y = $values['pps_position_y'][0];
	$css_margin_top = 'margin-top: 0px;';
	
	if( !is_numeric($position_x) ){
		$position_x = '"auto"';
	}
	if( !is_numeric($position_y) ) {
		$position_y = '"auto"';
		$css_margin_top = '';
	}
	
	$auto_open = $values['pps_auto_open'][0];
	$auto_close = $values['pps_auto_close'][0];
	$delay = $values['pps_delay'][0];
	$delay_close = (int)$delay + (int)$values['pps_delay_close'][0];
	$first_time = $values['pps_first_time'][0];
	$cookie_popup = 'pps_cookie_'.$popup_id;
	
	$run_method = 'click';
	if($values['pps_run_on_hover'][0] == 'yes') {
		$run_method = 'mouseover';
	}
	if(!empty($values['pps_open_hook'][0])){
		$run_method = $values['pps_open_hook'][0];
	}
	
	
	$content_by_id = isset($values['pps_content_by_id'][0]) ? $values['pps_content_by_id'][0] : '';
	$class_run = isset($values['pps_button_class_run'][0]) ? $values['pps_button_class_run'][0] : '';
	if(!empty($class_run)) {
		$class_run = ', .'.$class_run;
	}
	
	$popup_easing = isset($values["pps_popup_easing"][0]) ? $values["pps_popup_easing"][0] : '';
	
	// Default Options
	$std = get_option('pps_options');
	
	$flexSlider = '
			jQuery("#pps-slider-'.$popup_id.'").flexslider({
				slideshow: '.$std["slider_auto"].',
				slideshowSpeed: '.$std["slider_timeout"].',
				animationSpeed: '.$std["slider_speed"].',
				controlNav: '.$std["slider_pagination"].',
				directionNav: '.$std["slider_arrows"].',
				pauseOnHover: '.$std["slider_pause"].',
				namespace: "pps-",
				before: function(){
					pauseVideosPopupPress('.$popup_id.');
				}
			});';
	
	$bPopup = '
			jQuery("#popuppress-'.$popup_id.'").bPopup({
				closeClass: "pps-close-link",
				easing: "'.$popup_easing.'",
				modalClose: '.$values["pps_close_overlay"][0].',
				modalColor: "'.$bg_overlay.'",
				opacity: '.$values["pps_opacity"][0].',
				positionStyle: "'.$values["pps_position_type"][0].'",
				position: ['.$position_x.','.$position_y.'],
				speed: '.(int) $values['pps_speed'][0].',
				transition: "'.$values["pps_popup_transition"][0].'",
				zIndex: '.$values["pps_zindex"][0].',
				onOpen: function(){
					contentFromIdPopupPress('.$popup_id.',"'.$content_by_id.'");
					updateViewsPopupPress('.$popup_id.');
				},
				onClose: function(){
					pauseVideosPopupPress('.$popup_id.');
				},
			});';
	$function_popup = $flexSlider.$bPopup;
	
	$close_function = '
		setTimeout(function(){
			jQuery("#popuppress-'.$popup_id.' .pps-close-link").click();
		},'.$delay_close.');';
	
	$style_popup = '
	<style type="text/css">
		#popuppress-'.$popup_id.' {
			width: '.$width.'px;
			height: '.$height.';
			'.$css_margin_top.'
		}
		#popuppress-'.$popup_id.'.pps-border-true {
			-webkit-border-radius: '.$border_radius2.'px;
			-moz-border-radius: '.$border_radius2.'px;
			border-radius: '.$border_radius2.'px;
		}
		#popuppress-'.$popup_id.' .pps-wrap {
			-webkit-border-radius: '.$border_radius.'px;
			-moz-border-radius: '.$border_radius.'px;
			border-radius: '.$border_radius.'px;
		}
	
	</style>';
	$script_popup = '
<script type="text/javascript">
jQuery(document).ready(function($){';
		
	if($run_method == 'leave_page') {
		$script_popup .= '
		jQuery(document).bind("mouseleave",function(e){
			'.$function_popup.'
			jQuery(this).unbind("mouseleave");
		});';
	} else {
		$script_popup .= '
		jQuery(".pps-button-popup-'.$popup_id.$class_run.'").bind("'.$run_method.'", function(e) {
			e.preventDefault();
			'.$function_popup.'
		});';
	}
	
	if( $auto_open == 'true' && !strstr($_SERVER['REQUEST_URI'],'/edit.php?post_type=popuppress')   ){
		if($first_time == 'true'){
			$script_popup .= '
		if(!jQuery.cookie("'.$cookie_popup.'")){
			setTimeout( function(){
				'.$function_popup.'
			}, '.$delay.');
			jQuery.cookie("'.$cookie_popup.'", "1", { expires: 1 });';
			if($auto_close == 'true'){
				$script_popup .= $close_function;
			}
			
			$script_popup .= '
		}';
			
		} else {
			$script_popup .= '
		setTimeout( function(){
			'.$function_popup.'
		}, '.$delay.');';
			if($auto_close == 'true'){
				$script_popup .= $close_function;
			}
			
		}
	}
	
$script_popup .= '		
});
</script>';
	
	$popup .= $style_popup.$script_popup;
	
	// Cuerpo del Popup
	
	$popup .= '<div id="popuppress-'.$popup_id.'" class="pps-popup pps-'.$values['pps_popup_style'][0].' pps-border-'.$values['pps_transparent_border'][0].'">';
		$popup .= '<div class="pps-wrap">';
			$popup .= '<div class="pps-close"><a href="#" class="pps-close-link"></a></div>';
			if($values['pps_show_title'][0] == 'true')
				$popup .= '<div class="pps-header"><h3 class="pps-title">'.get_the_title($popup_id).'</h3></div>';
			$popup .= '<div class="pps-content">'.content_popup_PPS($popup_id).'</div>';
		$popup .= '</div><!--.pps-wrap-->';
	$popup .= '</div><!--.pps-popup-->';
	
	return $popup;
	
}

/* --------------------------------------------------------------------
   Función que Genera el Botón del Popup
-------------------------------------------------------------------- */
function button_popup_PPS($popup_id = 0){
	$values = get_post_custom($popup_id);
	$button_type = $values['pps_button_type'][0];
	$button_popup = '';

	switch($button_type){
		case 'button':
			$button_popup = '<a href="#" class="pps-btn pps-button-popup-'.$popup_id.' '.$values['pps_button_class'][0].' '.$values['pps_button_class_run'][0].'"  title="'.$values['pps_button_title'][0].'">'.$values['pps_button_text'][0].'</a>';
			break;
		case 'image':
			$button_popup = '<a href="#" class="pps-button-popup-'.$popup_id.' '.$values['pps_button_class'][0].' '.$values['pps_button_class_run'][0].'" title="'.$values['pps_button_title'][0].'"><img src="'.$values['pps_button_image'][0].'" alt="'.get_the_title($popup_id).'" width="'.$values['pps_img_width_button'][0].'" /></a>';
			break;
		default:
			//nothing
	}
	return $button_popup;
}
/* --------------------------------------------------------------------
   Función que Genera el Contenido del Popup
-------------------------------------------------------------------- */
function content_popup_PPS($popup_id = 0){
	$values = get_post_custom($popup_id);
	$content_popup = '';
	$post = get_post($popup_id);
	$content = $post->post_content;
	$content_editor = apply_filters('the_content', $content);
	$content_file = maybe_unserialize($values['pps_file_repeatable'][0]);
	$content_oembed = maybe_unserialize($values['pps_oembed_repeatable'][0]);
	$content_iframe = isset($values['pps_iframe'][0]) ? $values['pps_iframe'][0]:'';
	$content_by_id = isset($values['pps_content_by_id'][0]) ? $values['pps_content_by_id'][0] : '';
	
	$content_popup = '<div class="flexslider" id="pps-slider-'.$popup_id.'"><ul class="slides">';
	$i = 1;
	
	$content_fields = array(
		"mbox_editor" => isset($values['pps_mbox_editor_order'][0]) ? $values['pps_mbox_editor_order'][0] : 1,
		"mbox_file" => isset($values['pps_mbox_file_order'][0]) ? $values['pps_mbox_file_order'][0] : 2,
		"mbox_oembed" => isset($values['pps_mbox_oembed_order'][0]) ? $values['pps_mbox_oembed_order'][0] : 3,
		"mbox_iframe" => isset($values['pps_mbox_iframe_order'][0]) ? $values['pps_mbox_iframe_order'][0] : 4,
		"mbox_by_id" => isset($values['pps_mbox_by_id_order'][0]) ? $values['pps_mbox_by_id_order'][0] : 5,
	);
	
	asort($content_fields); // Ordenamos el Contenido del Popup
	foreach ($content_fields as $key => $val) {
    	
		if($key == 'mbox_editor'){
			// Contenido de "Editor Wordpress"
			if(!empty($content_editor) && $values['pps_use_wp_editor'][0] != 'false'){
				$content_popup .= '<li><div class="pps-content-wp-editor">'.$content_editor.'</div></li>';
				$i++;
			}
		}
		
		if($key == 'mbox_file'){
			// Contenido de "Cargador de Archivos"
			if( !empty($content_file)) {
				foreach ($content_file as $file){
					$check_image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $file );
					if($check_image){
							$content_popup .= '<li><img src="'.$file.'" class="pps-img-slider" /></li>';
					}
					$i++;
				}
			}
		}
		
		if($key == 'mbox_oembed'){
			// Contenido de "URL de Medios"
			if( !empty($content_oembed)) {
				foreach ($content_oembed as $embed){
					$check_embed = $GLOBALS['wp_embed']->run_shortcode( '[embed]'. esc_url( $embed ) .'[/embed]' );
					if($check_embed){
							$content_popup .= '<li><div class="pps-embed">'.$check_embed.'</div></li>';
					}
					$i++;
				}
			}
		}
			
		if($key == 'mbox_iframe'){
			// Contenido de "Iframe"
			if( !empty($content_iframe)) {
				$content_popup .= '<li><div class="pps-iframe"><iframe src="'.$content_iframe.'" height="'.$values['pps_iframe_height'][0].'"></iframe></div></li>';
				$i++;
			}
		}
		
		if($key == 'mbox_by_id'){
			// Contenido por "ID de Div"
			if( !empty($content_by_id)) {
				$content_popup .= '<li><div class="pps-content-by-id"></div></li>';
				$i++;
			}
		}
	}
	
	$content_popup .= '</ul></div>';
	
	return $content_popup;
}

/* --------------------------------------------------------------------
   Función que Actualiza el Número de Vistas de un Popup
-------------------------------------------------------------------- */

add_action('wp_ajax_update_views_popups', 'update_views_PPS');
add_action('wp_ajax_nopriv_update_views_popups', 'update_views_PPS');
function update_views_PPS(){
	$popup_id = $_POST['id'];
	$plugin = $_POST['plugin'];
	// Seguridad
	if(empty($popup_id) || $plugin != 'popuppress')
		return;
		
	$views_count = (int) get_post_meta($popup_id, 'pps-views', true);
	//Sumamos una 'vista' al Popup
	update_post_meta($popup_id, 'pps-views', ++$views_count);
	
	$result = array(
		'success' => true,
		'views' => $views_count,
	);
	echo json_encode($result);
	exit;
}



?>