jQuery(document).ready(function($){
	
	// Tabs del Panel de Opciones
	$(".pps-tab-content").hide(); //Hide all content
	$("#pps-tabs a:first").addClass("nav-tab-active").show(); //Activate first tab
	$(".pps-tab-content:first").show(); //Show first tab content
	
	$("#pps-tabs a").click(function() {
		$("#pps-tabs a").removeClass("nav-tab-active"); //Remove any "active" class
		$(this).addClass("nav-tab-active"); //Add "active" class to selected tab
		$(".pps-tab-content").removeClass("active").hide(); //Remove any "active" class and Hide all tab content
		var activeTab = $(this).attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn().addClass("active"); //Fade in the active content
		return false;
	});
	
	
	// Elimina elementos no deseados
	if($('.wp-list-table tr.type-popuppress').length){
		$('tr.type-popuppress').find('td .row-actions span.view').remove();
	}
	if($('.pps_metabox').length) {
		$('#edit-slug-box, #preview-action').remove();
	}
	
	
	// Oculta y Muestra Opciones Avanzadas del MetaBox
	$(".pps-toggle-fields").toggle(function (){
    	$(this).closest('.pps-row').nextAll().css('visibility', 'visible');
		$(this).text("Hide");
    }, function(){
    	$(this).closest('.pps-row').nextAll().css('visibility', 'collapse');
		$(this).text("Show");
	});
	
	// Activa ColorPicker en la Página de Opciones
	$('.pps-colorpicker').wpColorPicker();
});
