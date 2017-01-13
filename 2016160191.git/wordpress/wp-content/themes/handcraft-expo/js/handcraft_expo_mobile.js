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

(function(){

		jQuery(document).ready(function(){
			jQuery('#mobile-toggle-icon').click(function(){
				jQuery(this).toggleClass('mobile-toggle-icon-pressed');
				jQuery('.mobile-main-menu-dropdown .sub-menu').hide();
				jQuery('.handcraft-expo-mobile-menu').css('position', 'absolute');
				jQuery('.mobile-main-menu-dropdown').slideToggle(250);
				if (jQuery('.mobile-main-menu-dropdown').length < 1){
					jQuery('#handcraft-expo-mobile-menu .menu').slideToggle(250);					
				}
			});
		});

		jQuery(window).ready(function(){
			var socialIconsNumber = jQuery('.social-icons').length;
			if(socialIconsNumber = 1){
				jQuery('.mobile-social-icons').css('min-height', '52px');
			}
		});

		jQuery(document).ready(function(){
			var windowViewport = jQuery(window).width();
			var mobileTitleShown = jQuery('.mobile-title').length;
			if ( windowViewport < 640 && mobileTitleShown == 0 ) {
				jQuery('#mobile-logo').css({
					marginTop: '55px'
				});
			}
		});

		jQuery(document).ready(function(){
			jQuery(".mobile-main-menu-dropdown li").each(function(){
				var subMenuIcon = '<span class="sub-menu-icon">V</span>';
				var subMenuIcon = '<span class="sub-menu-icon">V</span>';
				if (jQuery(this).children('ul').length > 0){
					jQuery(this).append(subMenuIcon);
				}
				jQuery(this).children('span').click(function(){
					jQuery(this).toggleClass('mobile-toggle-icon-pressed');
					jQuery(this).parent('li').children(".sub-menu, ul:first()").slideToggle(250);
				});
			});
		});

})();