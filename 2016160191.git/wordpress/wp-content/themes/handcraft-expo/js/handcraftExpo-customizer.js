/*
    Copyright (C) 2015  _Y_Power

    The JavaScript code in this page is free software: you can
    redistribute it and/or modify it under the terms of the GNU
    General Public License (GNU GPL) as published by the Free Software
    Foundation, either version 3 of the License, or (at your option)
    any later version.  The code is distributed WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS
    FOR A PARTICULAR PURPOSE.  See the GNU GPL for more details.

    As additional permission under GNU GPL version 3 section 7, you
    may distribute non-source (e.g., minimized or compacted) forms of
    that code without the copy of the GNU GPL normally required by
    section 4, provided you include this license notice and a URL
    through which recipients can access the Corresponding Source.
*/

(function(jQuery) {


// Fast update of the site title
	wp.customize('blogname', function(value){
		value.bind(function(newval){
			jQuery('.title-show').html(newval);
		});
	});
	
// Fast update of the site description
	wp.customize('blogdescription', function(value){
		value.bind(function(newval){
			jQuery('.tagline-show').html(newval);
		});
	});

// Fast update of custom logo size
	wp.customize('handcraft-expo_custom_logo_pocket_size', function(value){
		value.bind(function(newval){
			jQuery('.mobile-logo img.custom-logo').css('width', newval + '%');
		});
	});

	wp.customize('handcraft-expo_custom_logo_size', function(value){
		value.bind(function(newval){
			jQuery('.site-custom-logo img.custom-logo').css('width', newval + '%');
		});
	});	

// Fast update of the site background
	wp.customize('handcraft-expo_background', function(value){
		value.bind(function(newval){
			jQuery('body').css('background-image', "url(" + newval + ")");
		});
	});

// Fast update of the banner background size
	wp.customize('handcraft-expo_banner_image_cover', function(value){
		value.bind(function(newval){
			jQuery('.handcraftExpo-main-banner').css('background-size', newval);
		});
	});

// Fast update of the background horizontal position
	wp.customize('handcraft-expo_background_image_X_position', function(value){
		value.bind(function(newval){
			var posCheck = jQuery('body').css('background-position');
			var posNum = posCheck.indexOf("%");		
			var posRest = posCheck.slice(posNum + 1);
			var posRest = posRest.trim();
			var newvalCheck = newval.indexOf("%");
			var newvalSlice = newval.slice(0, newvalCheck - 1 );
			var newvalSlice = newval.trim();
			
				jQuery('body').css({"background-position": newvalSlice + "% " + posRest});
				jQuery('.col-xs-9').css({"background-position": newvalSlice + "% " + posRest});
		});
	});

// Fast update of the background vertical position
	wp.customize('handcraft-expo_background_image_Y_position', function(value){
		value.bind(function(newval){
			var posCheck = jQuery('body').css('background-position');
			var posNum = posCheck.indexOf("%");		
			var posRest = posCheck.slice(posNum + 1);
			var posRest = posRest.trim();
			var newvalCheck = newval.indexOf("%");
			var newvalSlice = newval.slice(0, newvalCheck - 1 );
			var newvalSlice = newval.trim();
			
				jQuery('body').css({"background-position": posRest + newvalSlice + "%"});
				jQuery('.col-xs-9').css({"background-position": posRest + newvalSlice + "%"});
		});
	});

// Fast update of the background scroll
	wp.customize('handcraft-expo_background_image_scroll_check', function(value){
		value.bind(function(newval){
			jQuery('body').css('background-attachment', newval);
			jQuery('.col-xs-9').css('background-attachment', newval);
		});
	});

// Fast update of the background size
	wp.customize('handcraft-expo_background_image_cover', function(value){
		value.bind(function(newval){
			jQuery('body').css('background-size', newval);
			jQuery('.col-xs-9').css('background-size', newval);
		});
	});

// Fast update of the banner image horizontal position
	wp.customize('handcraft-expo_banner_image_X_position', function(value){
		value.bind(function(newval){
			var posCheck = jQuery('.handcraftExpo-main-banner').css('background-position');
			var posNum = posCheck.indexOf("%");		
			var posRest = posCheck.slice(posNum + 1);
			var posRest = posRest.trim();
			var newvalCheck = newval.indexOf("%");
			var newvalSlice = newval.slice(0, newvalCheck - 1 );
			var newvalSlice = newval.trim();
			
				jQuery('.handcraftExpo-main-banner').css({"background-position": newvalSlice + "% " + posRest});
		});
	});

// Fast update of the banner image vertical position
	wp.customize('handcraft-expo_banner_image_Y_position', function(value){
		value.bind(function(newval){
			var posCheck = jQuery('.handcraftExpo-main-banner').css('background-position');
			var posNum = posCheck.indexOf("%");		
			var posRest = posCheck.slice(posNum + 1);
			var posRest = posRest.trim();
			var newvalCheck = newval.indexOf("%");
			var newvalSlice = newval.slice(0, newvalCheck - 1 );
			var newvalSlice = newval.trim();
			
				jQuery('.handcraftExpo-main-banner').css({"background-position": posRest + newvalSlice + "%"});
		});
	});

// Fast update of the footer image rotation
	wp.customize('handcraft-expo_content_footer_image_rotate', function(value){
		value.bind(function(newval){
			jQuery('.content-footer img').css({transform: "rotate(" + newval + "deg)"});
		});
	});

// Fast update of title font size
	wp.customize('handcraft-expo_title_font_size', function(value){
		value.bind(function(newval){
			jQuery('.title-show').css('font-size', newval + "%");
		});
	});

// Fast update of the site title horizontal position
	wp.customize('handcraft-expo_title_position_X', function(value){
		value.bind(function(newval){
			jQuery('.title-show').not('.mobile-site-title-permalink .title-show').css('margin-left', newval + "%");
		});
	});

// Fast update of the site title vertical position
	wp.customize('handcraft-expo_title_position_Y', function(value){
		value.bind(function(newval){
			jQuery('.title-show').not('.mobile-site-title-permalink .title-show').css('margin-top', newval + "%");
		});
	});

// Fast update of tagline font size
	wp.customize('handcraft-expo_tagline_font_size', function(value){
		value.bind(function(newval){
			jQuery('.tagline-show').css('font-size', newval + "%");
		});
	});

// Fast update of the site tagline horizontal position
	wp.customize('handcraft-expo_tagline_position_X', function(value){
		value.bind(function(newval){
			jQuery('.tagline-show').not('.mobile-site-title-permalink .tagline-show').css('margin-left', newval + "%");
		});
	});

// Fast update of the site tagline vertical position
	wp.customize('handcraft-expo_tagline_position_Y', function(value){
		value.bind(function(newval){
			jQuery('.tagline-show').not('.mobile-site-title-permalink .tagline-show').css('margin-top', newval + "%");
		});
	});

// Fast update of the site custom copyright
	wp.customize('handcraft-expo_custom_copyright', function(value){
		value.bind(function(newval){
			jQuery('#handcraft-expo-custom-copyright, #handcraft-expo-mobile-custom-copyright').html('<code>' + newval + '</code>');
		});
	});

// Fast update of the title color
	wp.customize('handcraft-expo_title_color', function(value){
		value.bind(function(newval){
			jQuery('.title-show, .mobile-main-title-show').css('color', newval);
			
			var baseColor = jQuery('div.sidebar-button').next('div').children('a').css('color');
			jQuery('.col-xs-9 a').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.col-xs-9 a').mouseleave(function(){
				jQuery(this).css('color', baseColor);
			});
		});
	});

// Fast update of the title color (added)
	wp.customize('handcraft-expo_title_color', function(value){
		value.bind(function(newval){
			var oldBackground = jQuery('.search-submit, .archives-navigation, .comments-pages-links').css('background-color');
			jQuery('.archives-title, .searches-title').css('color', newval);
			jQuery('.search-submit, .archives-navigation, .comments-pages-links').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('.search-submit, .archives-navigation, .comments-pages-links').mouseleave(function(){
				jQuery(this).css('background-color', oldBackground);
			});
		});
	});

// Fast update of the tagline color
	wp.customize('handcraft-expo_tagline_color', function(value){
		value.bind(function(newval){
			jQuery('.mobile-main-tagline-show, .tagline-show').css('color', newval);
		});
	});

// Fast update of the title background color
	wp.customize('handcraft-expo_title_background', function(value){
		value.bind(function(newval){
			jQuery('.title-show').css('background-color', newval);
		});
	});

// Fast update of the tagline background color
	wp.customize('handcraft-expo_tagline_background', function(value){
		value.bind(function(newval){
			jQuery('.tagline-show').css('background-color', newval);
		});
	});

// Fast update of the site background color
	wp.customize('handcraft-expo_background_color', function(value){
		value.bind(function(newval){
			jQuery('body, #mobile-container-div').css('background-color', newval);
		});
	});

// Fast update of the site background color (and added)
	wp.customize('handcraft-expo_background_color', function(value){
		value.bind(function(newval){
			jQuery('body, .blog-title, .page-title, .navbar-container ul li ul, .title-banner:hover, .title-left:hover, .title-center:hover, #menu-handcraft-expo-main-menu-1 ul, #menu-handcraft-expo-main-menu-1 ul li ul, #menu-handcraft-expo-main-menu-1 ul li ul li ul, #menu-handcraft-expo-main-menu-1 ul li ul li ul li ul, #copyright').css('background-color', newval);
			jQuery('.blog-navigation .previousposts a, .blog-navigation .nextposts a').css('color', newval);
		});
	});

// Fast update of the mobile page color
	wp.customize('handcraft-expo_links_background_color', function(value){
		value.bind(function(newval){
			jQuery('.mobile-container').css('color', newval);
		});
	});

// Fast update of the site menu links hovering background color (and added)
	wp.customize('handcraft-expo_links_background_color', function(value){
		value.bind(function(newval){
			var prevValue = jQuery('body').css('background-color');
			
			jQuery('.navbar-container li a').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('.navbar-container li a').mouseleave(function(){
				jQuery(this).css('background-color', 'transparent');
			});
			jQuery('.current-menu-item, .blog-navigation .previousposts, .blog-navigation .nextposts, .mobile-main-content .pages-navigation .alignleft, .mobile-main-content .pages-navigation .alignright, .mobile-main-content .ancestors-children-nav, .mobile-main-content .posts-main-tags, .mobile-main-content .posts-navigation').css('background-color', newval);
			jQuery('#wp-calendar tbody td#today').css('border-color', newval);
			jQuery('#wp-calendar tfoot td#prev a').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('#wp-calendar tfoot td#prev a').mouseleave(function(){
				jQuery(this).css('background-color', prevValue);
			});
			jQuery('#wp-calendar tfoot td#next a').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('#wp-calendar tfoot td#next a').mouseleave(function(){
				jQuery(this).css('background-color', prevValue);
			});
			jQuery('.not-found-2 a').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('.not-found-2 a').mouseleave(function(){
				jQuery(this).css('background-color', prevValue);
			});
			jQuery('#wp-calendar tbody td a').css('color', newval);
		});
	});

// Fast update of the site menu links color (and added)
	wp.customize('handcraft-expo_links_color', function(value){
		value.bind(function(newval){
			
			var prevValue = jQuery('.title-banner').css('background-color');			

			jQuery('.navbar-container li a').css('color', newval);
			jQuery('.mobile-main-menu-dropdown a').css('color', newval);

			var prevCol = jQuery('.title-show').css('color');
			jQuery('.title-show').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.title-show').mouseleave(function(){
				jQuery(this).css('color', prevCol);
			});
		});
	});

// Fast update of the page links color (and added)
	wp.customize('handcraft-expo_page_links_color', function(value){
		value.bind(function(newval){
			var prevCol = jQuery('.title-show').css('color');
			jQuery('.col-xs-9 a, .widgets-bar-content-top .menu a, #copyright a').css('color', newval);
			jQuery('.col-xs-9 a').mouseenter(function(){
				jQuery(this).css('color', prevCol);
			});
			jQuery('.col-xs-9 a').mouseleave(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('#blog-showcase-container h3, #previewer-content-1 h3, #previewer-content-2 h3, #previewer-content-3 h3, #previewer-content-4 h3, #previewer-content-5 h3, #previewer-content-6 h3, #previewer-content-7 h3').css('color', newval);
		});
	});

// Fast update of the main sidebar color (and added)
	wp.customize('handcraft-expo_left_sidebar_color', function(value){
		value.bind(function(newval){
			jQuery('.col-xs-3').css('border-color', newval);
			jQuery('.col-xs-3').css({
				'-o-box-shadow': '0 5px 10px 0 ' + newval,
				'-ms-box-shadow': '0 5px 10px 0 ' + newval,
				'-moz-box-shadow': '0 5px 10px 0 ' + newval,
				'-webkit-box-shadow': '0 5px 10px 0 ' + newval,
				'box-shadow': '0 5px 10px 0 ' + newval
			});
			jQuery('.navbar-container ul, .navbar-container ul li ul, .navbar-container ul li ul li ul').css({
				borderColor: newval,
				'-o-box-shadow': '0 0 3px 0' + newval,
				'-ms-box-shadow': '0 0 3px 0' + newval,
				'-moz-box-shadow': '0 0 3px 0' + newval,
				'-webkit-box-shadow': '0 0 3px 0' + newval,
				'box-shadow': '0 0 3px 0' + newval
			});
		});
	});

// Fast update of the main text color (and added)
	wp.customize('handcraft-expo_main_text_color', function(value){
		value.bind(function(newval){

			var prevValue = jQuery('.title-banner').css('color');
			var prevValueW = jQuery('.widget-items a').css('color');

			jQuery('body').css('color', newval);
			jQuery('.post-gallery  p:first()').css('color', newval);
			jQuery('.archives-title, .searches-title, .widgets-bar-content, #wp-calendar, #wp-calendar tbody td#today').css('color', newval);
			jQuery('.widget-items h1, .widget-items h2, .widget-items h3, .widget-items h4, .widget-items h5, .widget-items h6').css('color', newval);
			jQuery('.sidebar-div, .search-submit, #searchsubmit, #formsubmit').css('color', newval);
			jQuery('.page-main-content p:first(), .blog-main-content p:first(), .post-main-content p:first()').css('border-color', newval);
			jQuery('.page-main-content, .blog-main-content, .post-main-content, .page-notitle-main-content, .page-main-content-2-columns').css({
				boxShadow: '0 0 5px 0 ' + newval
			});
			jQuery('.sticky, .tag-sticky-1, .tag-sticky-2, .tag-sticky-3, .tag-sticky-4, .tag-sticky-5').css({
				boxShadow: '0 0 10px 3px ' + newval + ' inset'
			});

			jQuery('.title-banner').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.title-banner').mouseleave(function(){
				jQuery(this).css('color', prevValue);
			});
			jQuery('.title-left').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.title-left').mouseleave(function(){
				jQuery(this).css('color', prevValue);
			});
			jQuery('.title-center').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.title-center').mouseleave(function(){
				jQuery(this).css('color', prevValue);
			});
			jQuery('.widget-items a').mouseenter(function(){
				jQuery(this).css('color', newval);
			});
			jQuery('.widget-items a').mouseleave(function(){
				jQuery(this).css('color', prevValueW);
			});
		});
	});

// Fast update of the main content background color (and added)
	wp.customize('handcraft-expo_content_background_color', function(value){
		value.bind(function(newval){

			var prevValue = jQuery('.search-submit').css('background-color');

			jQuery('.page-main-content, .blog-main-content, .post-main-content, .widgets-bar-content, .sidebar-div, .search-submit, #searchsubmit, #formsubmit, #wp-calendar tbody td#today, #handcraft-expo-mobile-menu, .post-audio').css('background-color', newval);

			jQuery('#searchsubmit, .search-submit, #formsubmit').mouseenter(function(){
				jQuery(this).css('background-color', newval);
			});
			jQuery('#searchsubmit, .search-submit, #formsubmit').mouseleave(function(){
				jQuery(this).css('background-color', prevValue);
			});
		});
	});

// Fast update of the main sidebar opacity
	wp.customize('handcraft-expo_main_sidebar_opacity', function(value){
		value.bind(function(newval){
			jQuery('.col-xs-3').css('opacity', newval);
		});
	});

// Fast update of the main sidebar border size
	wp.customize('handcraft-expo_menubar_border_size', function(value){
		value.bind(function(newval){
			var sideBarBor = jQuery('.col-xs-3').css('border-color');

			jQuery('.col-xs-3').css('border-right', newval + 'px solid' + sideBarBor);
			
			jQuery('.navbar-container ul li ul').css('border-top', newval + "px solid");
			jQuery('.navbar-container ul li ul').css('border-right', newval + "px solid");
			jQuery('.navbar-container ul li ul').css('border-bottom', newval + "px solid");
		});
	});

// Fast update of the main menu links size
	wp.customize('handcraft-expo_links_size', function(value){
		value.bind(function(newval){
			jQuery('.navbar-container li').css('font-size', newval + "%");
		});
	});

// Fast update of the main menu links alignment
	wp.customize('handcraft-expo_menu_links_alignment', function(value){
		value.bind(function(newval){
			jQuery('.navbar-container ul li a').css('text-align', newval);
		});
	});

// Fast update of the title and tagline font type
	wp.customize('handcraft-expo_title_font_type', function(value){
		value.bind(function(newval){
			jQuery('.title-show, .tagline-show').css('font-family', newval);
		});
	});

	wp.customize('handcraft-expo_title_google_font', function(value){
		value.bind(function(newval){
			jQuery('.title-show, .tagline-show').css('font-family', newval);
		});
	});

// Fast update of the body font type
	wp.customize('handcraft-expo_body_font_type', function(value){
		value.bind(function(newval){
			jQuery('body').css('font-family', newval);
		});
	});

	wp.customize('handcraft-expo_body_google_font', function(value){
		value.bind(function(newval){
			jQuery('body').css('font-family', newval);
		});
	});

// Fast update of the main font size
	wp.customize('handcraft-expo_main_font_size', function(value){
		value.bind(function(newval){
			jQuery('.page-main-content, .blog-main-content,	.post-main-content, .page-notitle-main-content, .page-main-content-2-columns, .page-main-content-transparent').css('font-size', newval + "em");
		});
	});

// Fast update of the Previewer font type
	wp.customize('handcraft-expo_previewer_font_type', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('font-family', newval);
		});
	});

	wp.customize('handcraft-expo_previewer_google_font', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('font-family', newval);
		});
	});

// Fast update of the Previewer font size
	wp.customize('handcraft-expo_previewer_font_size', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('font-size', newval + "%");
		});
	});

// Fast update of the Previewer font color
	wp.customize('handcraft-expo_previewer_font_color', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('color', newval);
		});
	});

// Fast update of the Previewer horizontal position
	wp.customize('handcraft-expo_previewer_offset_X', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('margin-left', newval + "%");
		});
	});

// Fast update of the Previewer vertical position
	wp.customize('handcraft-expo_previewer_offset_Y', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('margin-top', newval + "%");
		});
	});

// Fast update of the Previewer background color
	wp.customize('handcraft-expo_previewer_background_color', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('background-color', newval);
		});
	});

// Fast update of the Previewer shadow color
	wp.customize('handcraft-expo_previewer_shadow_color', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('-ms-box-shadow', "3px 3px 3px " + newval);
			jQuery('.description-container').css('-moz-box-shadow', "3px 3px 3px " + newval);
			jQuery('.description-container').css('-webkit-box-shadow', "3px 3px 3px " + newval);
			jQuery('.description-container').css('box-shadow', "3px 3px 3px " + newval);
		});
	});

// Fast update of the Previewer background image
	wp.customize('handcraft-expo_previewer_background_image', function(value){
		value.bind(function(newval){
			jQuery('.description-container').css('background-image', "url(" + newval + ")");
		});
	});

// Fast update of the Previewer text 1
	wp.customize('handcraft-expo_previewer_text_1', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-1').html(newval);
		});
	});

// Fast update of the Previewer text 2
	wp.customize('handcraft-expo_previewer_text_2', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-2').html(newval);
		});
	});

// Fast update of the Previewer text 3
	wp.customize('handcraft-expo_previewer_text_3', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-3').html(newval);
		});
	});

// Fast update of the Previewer text 4
	wp.customize('handcraft-expo_previewer_text_4', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-4').html(newval);
		});
	});

// Fast update of the Previewer text 5
	wp.customize('handcraft-expo_previewer_text_5', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-5').html(newval);
		});
	});

// Fast update of the Previewer text 6
	wp.customize('handcraft-expo_previewer_text_6', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-6').html(newval);
		});
	});

// Fast update of the Previewer text 7
	wp.customize('handcraft-expo_previewer_text_7', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-7').html(newval);
		});
	});

// Fast update of the Previewer text 8
	wp.customize('handcraft-expo_previewer_text_8', function(value){
		value.bind(function(newval){
			jQuery('#previewer-content-8').html(newval);
		});
	});

	// Fast update of Custom CSS
		wp.customize('handcraft-expo_custom_css', function(value){
			value.bind(function(newval){
				jQuery('#handcraft-expo-live-css').html(newval);
			});
		});

	
})(jQuery);