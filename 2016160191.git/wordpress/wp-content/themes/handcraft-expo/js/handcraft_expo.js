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

    // Handcraft Expo jQuery scripts


    jQuery(document).ready(function(){
	jQuery('#handcraft-expo-menu-sidebar-toggle').click(function(){
	    var realWidthCheck = parseInt(jQuery('#handcraft-expo-main-sidebar-container').width());
	    jQuery(this).toggleClass('mobile-toggle-icon-pressed');
	    var bodyWidth = jQuery('.container-fluid').width();
	    if (jQuery('.clearfix').length == 0 && jQuery('#handcraft-expo-main-sidebar-container').width() != '0'){
		var prevPosition = jQuery('html').scrollTop();
		jQuery('#handcraft-expo-main-sidebar-container').animate({
		    width: '0'
		});
		jQuery('#handcraft-expo-main-sidebar-container *').addClass('hidden-menu-sidebar-content');
		jQuery('#handcraft-expo-main-content-container').animate({
		    position: 'relative',
		    width: '100%',
		    maxWidth: '100%',
		    marginLeft: '0'
		});
		jQuery(this).addClass('menu-sidebar-ui-label-active').removeClass('menu-sidebar-ui-label');
		jQuery('html, body').animate({
		    scrollTop: prevPosition
		}, 1500, 'easeOutCirc');
	    }
	    if (jQuery('.clearfix').length > 0 && jQuery('#handcraft-expo-main-sidebar-container').width() != '0'){
		var prevPosition = jQuery('html').scrollTop();
		jQuery('#handcraft-expo-main-sidebar-container').animate({
		    width: '0'
		});
		jQuery('#handcraft-expo-main-sidebar-container *').addClass('hidden-menu-sidebar-content');
		jQuery('#handcraft-expo-main-content-container').animate({
		    position: 'relative',
		    width: '100%',
		    maxWidth: '100%',
		    marginLeft: '0'
		});
		jQuery('.sidebar-button').animate({
		    marginLeft: '74%'
		});
		jQuery('#widgets-sidebar-container').animate({
		    marginLeft: '77%'
		});
		jQuery('.page-main-content, .page-main-content-transparent').animate({
		    width: '64%',
		    maxWidth: '64%'
		});
		jQuery('.post-main-content, .blog-main-content').animate({
		    width: '68%',
		    maxWidth: '68%'
		});
		jQuery('.page-main-content-2-columns, .page-notitle-main-content').animate({
		    width: '72%',
		    maxWidth: '72%'
		});
		jQuery(this).addClass('menu-sidebar-ui-label-active').removeClass('menu-sidebar-ui-label');
		jQuery('html, body').animate({
		    scrollTop: prevPosition
		}, 1500, 'easeOutCirc');
	    }
	    if (jQuery('.clearfix').length == 0 && realWidthCheck == 0){
		var prevPosition = jQuery('html').scrollTop();
		jQuery('#handcraft-expo-main-sidebar-container').animate({
		    width: '25%'
		});
		jQuery('#handcraft-expo-main-content-container').animate({
		    position: 'absolute',
		    width: '75%',
		    maxWidth: '75%',
		    marginLeft: '25%'
		});
		jQuery(this).removeClass('menu-sidebar-ui-label-active').addClass('menu-sidebar-ui-label');
		jQuery('html, body').animate({
		    scrollTop: prevPosition
		}, 1500, 'easeOutCirc');
	    }
	    if (jQuery('.clearfix').length == 0 && realWidthCheck < 10){
		jQuery('#handcraft-expo-main-sidebar-container').animate({
		    width: '25%'
		});
		jQuery('#handcraft-expo-main-sidebar-container *').removeClass('hidden-menu-sidebar-content');
		jQuery('#handcraft-expo-main-content-container').animate({
		    position: 'absolute',
		    width: '75%',
		    maxWidth: '75%',
		    marginLeft: '25%'
		});
		jQuery(this).removeClass('menu-sidebar-ui-label-active').addClass('menu-sidebar-ui-label');
		jQuery('html, body').animate({
		    scrollTop: prevPosition
		}, 1500, 'easeOutCirc');
	    }
	    if (jQuery('.clearfix').length > 0 && jQuery('#handcraft-expo-main-sidebar-container').width() == '0'){
		var prevPosition = jQuery('html').scrollTop();
		jQuery('#handcraft-expo-main-sidebar-container').animate({
		    width: '25%'
		});
		jQuery('#handcraft-expo-main-sidebar-container *').removeClass('hidden-menu-sidebar-content');
		jQuery('#handcraft-expo-main-content-container').animate({
		    position: 'absolute',
		    width: '75%',
		    maxWidth: '75%',
		    marginLeft: '25%'
		});
		jQuery('.sidebar-button').animate({
		    marginLeft: '48.7%'
		});
		jQuery('#widgets-sidebar-container').animate({
		    marginLeft: '52%'
		});
		jQuery('.page-main-content, .page-main-content-transparent').animate({
		    width: '50%',
		    maxWidth: '50%'
		});
		jQuery('.post-main-content, .blog-main-content').animate({
		    width: '59%',
		    minWidth: '59%'
		});
		jQuery('.page-main-content-2-columns, .page-notitle-main-content').animate({
		    minWidth: '63%',
		    maxWidth: '63%'
		});

		jQuery(this).removeClass('menu-sidebar-ui-label-active').addClass('menu-sidebar-ui-label');
		jQuery('html, body').animate({
		    scrollTop: prevPosition
		}, 1500, 'easeOutCirc');
	    }
	});
    });

    // 'Pocket' layout adjustment
    jQuery(window).resize(function(){
	var mobileLayoutCheck = jQuery('#mobile-container-div').css('display');
	if (mobileLayoutCheck == 'block') {
	    jQuery('#handcraft-expo-main-content-container').css({
		marginLeft: '0',
		width: '100%',
		maxWidth: '100%'
	    });
	    jQuery('.page-main-content, .blog-active-sidebar, .page-main-content-transparent').css({
		width: '88%',
		maxWidth: '88%'
	    });			
	    jQuery('.single-active-sidebar, .post-main-content, .blog-active-sidebar').css({
		width: '92%',
		maxWidth: '92%'
	    });
	    jQuery('.page-main-content-2-columns, .page-notitle-main-content').css({
		width: '96%',
		maxWidth: '96%'
	    });
	    jQuery('.sidebar-div').hide();
	}
	if (mobileLayoutCheck == 'none') {
	    jQuery('#handcraft-expo-main-content-container').css({
		marginLeft: '25%',
		width: '75%',
		maxWidth: '75%'
	    });
	    jQuery('.page-main-content, .blog-active-sidebar, .page-main-content-transparent').css({
		width: '50%',
		maxWidth: '50%'
	    });		
	    jQuery('.single-active-sidebar .post-main-content, .page-main-content-2-columns, .page-notitle-main-content').css({
		width: '55%',
		maxWidth: '55%'
	    });
	}
    });

    jQuery.fn.extend({
	hePocketBannerAdjust: function(){
	    var mobileDivVisibility = jQuery('#mobile-container-div').css('display'),
		mobileMenu = jQuery('#handcraft-expo-mobile-menu'),
		mobileMenuHeight = mobileMenu.offset().top + mobileMenu.outerHeight(true);
	    if (mobileDivVisibility == 'block'){
		jQuery('#handcraft-expo-main-banner').css({
		    marginTop: mobileMenuHeight + 'px',
		    marginLeft: 'auto'
		});
	    }
	}
    });

    jQuery(document).ready(function(){
	jQuery(document).hePocketBannerAdjust();
    });

    jQuery(window).resize(function(){
	var mobileDivVisibility = jQuery('#mobile-container-div').css('display');
	if (mobileDivVisibility == 'block'){
	    jQuery(window).hePocketBannerAdjust();
	}
	else if (mobileDivVisibility != 'block'){
	    jQuery('#handcraft-expo-main-banner').css({
		marginTop: '0',
		marginLeft: 'auto'
	    });
	}
    });

    jQuery.fn.extend({
	hePocketNoTitleAdjust: function(){
	    var mobileTitleCheck = jQuery('.mobile-site-title-container').length,
		logoCheck = jQuery('.mobile-logo').length,
		bannerCheck = jQuery('.handcraft-expo-main-banner').length;
	    if (mobileTitleCheck == 0){
		var windowSize = jQuery(window).width();
		if (windowSize < 1200 && logoCheck == 0 && bannerCheck == 0){
		    jQuery('.page-main-content:eq(0), .blog-main-content:eq(0), .post-main-content:eq(0), .page-notitle-main-content:eq(0), .page-main-content-2-columns:eq(0)').css({
			marginTop: '85px'
		    });
		}
		if (windowSize >= 1200 && logoCheck == 0 && bannerCheck == 0){
		    jQuery('.page-main-content:eq(0), .blog-main-content:eq(0), .post-main-content:eq(0), .page-notitle-main-content:eq(0), .page-main-content-2-columns:eq(0)').css({
			marginTop: '10px'
		    });
		}				
	    }
	    if (logoCheck > 0){
		if (bannerCheck == 0 && mobileTitleCheck == 0){
		    jQuery('.mobile-logo a img').css({
			marginTop: '0',
			paddingTop: '85px'
		    });
		}
	    }
	}
    });

    jQuery(document).ready(function(){
	jQuery(document).hePocketNoTitleAdjust();
    });

    jQuery(window).resize(function(){
	jQuery(document).hePocketNoTitleAdjust();
    });

    jQuery(document).on('change', function(){
	jQuery(document).hePocketBannerAdjust();
    });

    // Poket layout title adjustment
    jQuery.fn.extend({
	hePocketTitleAdjust: function(){
	    var mobileLayoutCheck = jQuery('#mobile-container-div').css('display'),
		mobileMenuOffset = jQuery('.mobile-social-icons').height(),
		siteTitle = jQuery('#mobile-container-div .title-show');
	    if (mobileLayoutCheck == 'block'){
		siteTitle.css('margin-top', mobileMenuOffset + 'px');
	    }
	}
    });

    jQuery(document).ready(function(){
	jQuery(this).hePocketTitleAdjust();
    });

    jQuery(window).on('resize', function(){
	jQuery(this).hePocketTitleAdjust();
    });

    // Layout adjustments extra
    jQuery(document).ready(function(){

	jQuery('.tag-read-more span').append(' >>');

	jQuery('.navbar-container li ul, .navbar-container li ul li ul, .navbar-container li ul li ul li ul').css({
	    position: 'relative',
	    width: '80%',
	    margin: '3% auto',
	    fontSize: '.5em',
	    textAlign: 'right',
	    borderRadius: 'none',
	});
	// Side Menu overflow
	jQuery('.navbar-container li .sub-menu').css({
	    position: 'relative',
	    width: '80%',
	    margin: '3% auto',
	    fontSize: '.5em',
	    textAlign: 'right',
	    borderRadius: 'none',
	});

	// Widgets Top

	jQuery(".widgets-bar-content-top li").find(".sub-menu").css("position", "absolute");

	// Widgets Bottom

	jQuery(".sidebar-div").find(".sub-menu").hide(0);
	jQuery("sidebar-div li").find(".sub-menu").css("position", "absolute");
    });

    // Previewer Links

    jQuery(document).ready(function(){
	var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
	allToggledItems.hide();
    });

    // Navigation

    jQuery(document).ready(function(){
	var hePostsNavNextCheck = jQuery('.blog-navigation .nextposts a').html();
	if (hePostsNavNextCheck == null) {
	    jQuery('.blog-navigation .nextposts').css('visibility', 'hidden');
	}
	/* if there are next posts pages */
	else {
	    var hePreviousPaginatedURL = jQuery('div.blog-navigation p.nextposts a').attr('href');
	    jQuery('p.nextposts').on('click', function(){
		window.location.href = hePreviousPaginatedURL;
	    });
	}
    });
    
    jQuery(document).ready(function(){
	var hePostsNavPrevCheck = jQuery('.blog-navigation .previousposts a').html();
	if (hePostsNavPrevCheck == null) {
	    jQuery('.blog-navigation .previousposts').css('visibility', 'hidden');
	}
	/* if there are previous posts pages */
	else {
	    var heNextPaginatedURL = jQuery('div.blog-navigation p.previousposts a').attr('href');
	    jQuery('p.previousposts').on('click', function(){
		window.location.href = heNextPaginatedURL;
	    });
	}
    });

    // Scroll-up Arrow

    jQuery.fn.extend({
	hePageScroller: function(){
	    var mainWin = jQuery(window),
		menuBar = jQuery('#handcraft-expo-main-sidebar-container').width(),
		mainContent = jQuery('#handcraft-expo-main-content-container').width(),
		mobileVisibility = jQuery('#mobile-container-div').css('display'),
		totalWidth = jQuery(window).width(),
		topMargin = mainWin.height() + mainWin.scrollTop(),
		scrollFromTop = jQuery(document).scrollTop(),
		scroller = jQuery('.handcraft-expo-scroll-up-container'),
		widgetSidebarIcon = jQuery('.sidebar-control');
	    if (scrollFromTop > 150){
		if (menuBar > 10 && mobileVisibility == 'none'){
		    if (widgetSidebarIcon.length > 0){
			scroller.offset({
			    top:  topMargin - 100,
			    left: totalWidth / 1.37
			});
		    }
		    else if (widgetSidebarIcon.length <= 0){
			scroller.offset({
			    top:  topMargin - 100,
			    left: (menuBar + mainContent) - 100
			});
		    }
		    scroller.fadeIn(350);
		}
		else if (menuBar < 10 && mobileVisibility == 'none'){
		    if (widgetSidebarIcon.length > 0){
			scroller.offset({
			    top:  topMargin - 100,
			    left: totalWidth / 1.37
			});
		    }	
		    else if (widgetSidebarIcon.length <= 0){
			scroller.offset({
			    top:  topMargin - 100,
			    left: (menuBar + mainContent) - 100
			});
		    }
		    scroller.fadeIn(350);					
		}
		if (mobileVisibility != 'none'){
		    scroller.offset({
			top:  topMargin - 80,
			left: mainContent - 60
		    });
		    scroller.fadeIn(350);
		}
	    }
	    else if (scrollFromTop <= 150){
		scroller.fadeOut(350);
	    }
	}
    });

    jQuery(document).ready(function(){
	jQuery(document).hePageScroller();
    });

    jQuery(document).on('scroll', function(){
	jQuery(document).hePageScroller();
    });

    jQuery(window).resize(function(){
	jQuery(document).hePageScroller();
    });

    jQuery(document).ready(function(){
	jQuery('#handcraft-expo-scroll-up').on('click', function(){
	    jQuery('html, body').animate({
		scrollTop: 0
	    }, 1000);
	});
    });

    // Comments

    jQuery(document).ready(function(){
	jQuery('.post-main-content .comment').each(function(){
	    var getCol = jQuery('.post-main-content').css('background-color');
	    var colSlice = getCol.indexOf(',') + 1;
	    var colSliceEnd = getCol.lastIndexOf(',');
	    var stripCol = getCol.slice(colSlice, colSliceEnd);
	    var colToNum = Number(stripCol) - 2;
	    var changeCol = colToNum.toString();
	    var colRebuilt = getCol.slice(0, colSlice);
	    var colRebuiltEnd = getCol.slice(colSliceEnd);
	    jQuery(this).css('background-color', colRebuilt + changeCol + colRebuiltEnd);
	});
    });


    jQuery(document).ready(function(){
	jQuery('.post-main-content .comment .parent ul').each(function(){
	    var getCol = jQuery('.post-main-content').css('background-color');
	    var colSlice = getCol.indexOf(',') + 1;
	    var colSliceEnd = getCol.lastIndexOf(',');
	    var stripCol = getCol.slice(colSlice, colSliceEnd);
	    var colToNum = Number(stripCol) - 4;
	    var changeCol = colToNum.toString();
	    var colRebuilt = getCol.slice(0, colSlice);
	    var colRebuiltEnd = getCol.slice(colSliceEnd);
	    jQuery(this).css('background-color', colRebuilt + changeCol + colRebuiltEnd);
	});
    });

    jQuery(document).ready(function(){
	jQuery('.post-main-content .comment .children ul li').each(function(){
	    var getCol = jQuery('.post-main-content').css('background-color');
	    var colSlice = getCol.indexOf(',') + 1;
	    var colSliceEnd = getCol.lastIndexOf(',');
	    var stripCol = getCol.slice(colSlice, colSliceEnd);
	    var colToNum = Number(stripCol) - 6;
	    var changeCol = colToNum.toString();
	    var colRebuilt = getCol.slice(0, colSlice);
	    var colRebuiltEnd = getCol.slice(colSliceEnd);
	    jQuery(this).css('background-color', colRebuilt + changeCol + colRebuiltEnd);
	});
    });

    jQuery(document).ready(function(){
	jQuery('.post-main-content .comment .children ul ul li').each(function(){
	    var getCol = jQuery('.post-main-content').css('background-color');
	    var colSlice = getCol.indexOf(',') + 1;
	    var colSliceEnd = getCol.lastIndexOf(',');
	    var stripCol = getCol.slice(colSlice, colSliceEnd);
	    var colToNum = Number(stripCol) - 8;
	    var changeCol = colToNum.toString();
	    var colRebuilt = getCol.slice(0, colSlice);
	    var colRebuiltEnd = getCol.slice(colSliceEnd);
	    jQuery(this).css('background-color', colRebuilt + changeCol + colRebuiltEnd);
	});
    });


})();



// Handcraft Expo JS scripts


