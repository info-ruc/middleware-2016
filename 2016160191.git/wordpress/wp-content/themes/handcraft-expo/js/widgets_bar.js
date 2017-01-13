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

(function (){

			jQuery(document).ready(function(){
				jQuery(".sidebar-button").click(function(){
					jQuery('#sidebar-toggle-icon').toggleClass('mobile-toggle-icon-pressed');
					
					var buttonPos = jQuery('#sidebar-toggle-icon').offset(),
					    pageTitle = jQuery('.page-title').length > 0 ? jQuery('.page-title') : 'none',
					    pageTitleBottom = pageTitle != 'none' ? pageTitle.outerHeight() : 0,
					    widgSidebar = jQuery('.sidebar-div'),
					    sidebarBottom = widgSidebar.offset().top + widgSidebar.outerHeight(),
					    menuSidebar = jQuery('#handcraft-expo-main-sidebar-container'),
					    winBottom = jQuery(window).height() - sidebarBottom;

					jQuery(".sidebar-div").css('position', 'fixed');
					if (jQuery('#handcraft-expo-main-sidebar-container').width() != '0'){
						jQuery(".sidebar-div").css('margin-left', '52%');
					}
					
					if (pageTitle != 'none'){
						widgSidebar.css('margin-top', pageTitleBottom + 'px');
					}
					if (pageTitle == 'none'){
						widgSidebar.css('margin-top', '0');
					}

					if (jQuery('#handcraft-expo-main-banner').css('background-image') != null) {
						jQuery(".sidebar-div").css('margin-top', '0');
					}
					jQuery(".sidebar-div").css('overflow-y', 'auto');

					widgSidebar.css('max-height', (jQuery(window).height() - jQuery('.page-title').height() - 180) + 'px');
					if (pageTitle == 'none' && jQuery('.site-title-container').length == 0 && jQuery('#handcraft-expo-main-banner').css('background-image') == null && jQuery('.blog-active-sidebar').length == 0){
						widgSidebar.css({
							maxHeight: (menuSidebar.height() - 100) + 'px'
						});
					}
					// Blog template conditional
					else if (pageTitle == 'none' && jQuery('.site-title-container').length == 0 && jQuery('#handcraft-expo-main-banner').css('background-image') == null && jQuery('.blog-active-sidebar').length != 0){
						widgSidebar.css({
							maxHeight: (menuSidebar.height() - 200) + 'px'
						});
					}
					
					jQuery(".sidebar-div").slideToggle(1500);

				});
			});

			jQuery(window).on('resize', function(){
					var mobileCheck = jQuery('#mobile-container-div').css('display'),
					    barCheck = jQuery('#handcraft-expo-main-sidebar-container').css('display');
					if (mobileCheck == 'none' && barCheck != 'none'){
						jQuery('.sidebar-button').triggerHandler('click');
					}
				});

			jQuery(document).ready(function(){
				if (jQuery('#mobile-container-div').css('display') == 'none' && jQuery('.sidebar-div').css('display') == 'none'){
					jQuery('.sidebar-button').triggerHandler('click');
				}
			});

			jQuery(document).ready(function(){
				jQuery(".sidebar-button").click(function(){
					jQuery(".sidebar-button").fadeTo(1500, 0.3);
				});
			});

			jQuery(document).ready(function(){
				jQuery(".sidebar-button").click(function(){
					jQuery(".sidebar-button").fadeTo(1500, 1);
				});
			});

})();