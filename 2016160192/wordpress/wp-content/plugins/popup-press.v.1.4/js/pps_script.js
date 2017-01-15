jQuery(document).ready(function($){
	//Fix z-index youtube video embedding
	$('iframe').each(function() {
		var url = $(this).attr("src");
		if ($(this).attr("src").indexOf("?") > 0) {
			$(this).attr({
			  "src" : url + "&wmode=transparent",
			  "wmode" : "Opaque"
			});
		}
		else {
			$(this).attr({
			  "src" : url + "?wmode=transparent",
			  "wmode" : "Opaque"
			});
		}
	});
});

function contentFromIdPopupPress(id, idDivContent) {
	if(idDivContent){
		var idDivContent = idDivContent.replace('#','');
		var contentDiv = jQuery("#"+idDivContent).clone();
		jQuery("#popuppress-"+id).find('.pps-content-by-id').html(contentDiv);
	}
}

function pauseVideosPopupPress(id) {
	jQuery("#popuppress-"+id+" iframe, #popuppress-"+id+" embed").each(function() {
		var url = jQuery(this).attr('src');
		jQuery(this).attr('src', '');
		jQuery(this).attr('src', url);
	});
}

function updateViewsPopupPress(id){
	jQuery.ajax({
		type: "POST",
		url: PPS.ajaxurlPps,
		data: 'action=update_views_popups&plugin=popuppress&id='+id,
		success: function(result){
			var data = jQuery.parseJSON(result);
			if(data.success == true){
				if(jQuery('table.wp-list-table').length){
					jQuery('tr#post-'+id+' td.column-views > p > span:eq(0)').html(data.views);
				}
			}
		}
	});
}