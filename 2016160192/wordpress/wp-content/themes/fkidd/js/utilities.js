jQuery( document ).ready(function() {

	jQuery('#header-spacer').height(jQuery('#header-main').height());

	// add submenu icons class in main menu (only for large resolution)
	if (fkidd_IsLargeResolution()) {
	
		jQuery('#navmain > div > ul > li:has("ul")').addClass('level-one-sub-menu');
		jQuery('#navmain > div > ul li ul li:has("ul")').addClass('level-two-sub-menu');										
	}

	jQuery('#navmain > div').on('click', function(e) {

		e.stopPropagation();

		// toggle main menu
		if (fkidd_IsSmallResolution() || fkidd_IsMediumResolution()) {

			var parentOffset = jQuery(this).parent().offset(); 
			
			var relY = e.pageY - parentOffset.top;
		
			if (relY < 36) {
			
				jQuery('ul:first-child', this).toggle(400);
			}
		}
	});

	jQuery("#navmain > div > ul li").mouseleave( function() {
		if (fkidd_IsLargeResolution()) {
			jQuery(this).children("ul").stop(true, true).css('display', 'block').slideUp(300);
		}
	});
	
	jQuery("#navmain > div > ul li").mouseenter( function() {
		if (fkidd_IsLargeResolution()) {

			var curMenuLi = jQuery(this);
			if ( curMenuLi.attr('id') ) {
         jQuery("#navmain .menu > ul:not(:contains('#" + curMenuLi.attr('id') + "')) ul").hide();
      }
		
			jQuery(this).children("ul").stop(true, true).css('display','none').slideDown(400);
		}
	});

	jQuery(function(){
		jQuery('#camera_wrap').camera({
			height: '320px',
			loader: 'bar',
			pagination: true,
			thumbnails: false,
			time: 4500
		});
	});
});

function fkidd_IsSmallResolution() {

	return (jQuery(window).width() <= 360);
}

function fkidd_IsMediumResolution() {
	
	var browserWidth = jQuery(window).width();

	return (browserWidth > 360 && browserWidth < 800);
}

function fkidd_IsLargeResolution() {

	return (jQuery(window).width() >= 800);
}

jQuery(document).ready(function () {

  jQuery(window).scroll(function () {
	  if (jQuery(this).scrollTop() > 100) {
		  jQuery('.scrollup').fadeIn();
		  jQuery('#header-top').hide();
	  } else {
		  jQuery('.scrollup').fadeOut();
		  jQuery('#header-top').show();
	  }
  });

  jQuery('.scrollup').click(function () {
	  jQuery("html, body").animate({
		  scrollTop: 0
	  }, 600);
	  return false;
  });

});

var opacity = 1;
var lastScrollTop = 0;
jQuery(window).scroll(function(){
    var st = jQuery(this).scrollTop();
    if(st == 0)
        jQuery('#header-main').css('opacity','1');

    if (opacity > 0.5 && (st > lastScrollTop)){
       jQuery('#header-main').css('opacity','-=0.01');
       opacity -= 0.01;
    }
    else if(opacity < 1)
    {
       jQuery('#header-main').css('opacity','+=0.01');
        opacity += 0.01;
    }
    lastScrollTop = st;
});
