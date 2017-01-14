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

// Handcraft Expo Previewer scripts

	jQuery(window).ready(function(){
	    jQuery('.side-navbar').mouseenter(function(){
	        var box = jQuery('.description-container');
	        var allElse = jQuery('.page-main-content, .post-main-content, .blog-main-content, .blog-title, .page-main-content-2-columns, .page-main-content-transparent, .page-notitle-main-content, .widgets-bar-div, .sidebar-div, .sidebar-button, .widgets-bar-bottom-div, .col-xs-9 .title-show, .col-xs-9 .tagline-show, .post-aside, .post-audio, .post-chat, .post-gallery, .post-quote, .post-status, .post-video, .previousposts, .nextposts, .searches-title, .handcraft-expo-scroll-up-container');
		box.finish();
		box.animate({width: '100%', opacity: '0.9'}, "1500");
	        box.animate({opacity: '0.9'}, "1500");
	        box.css("-o-border-radius", "10px");
	        box.css("-ms-border-radius", "10px");
	        box.css("-webkit-border-radius", "10px");
	        box.css("-moz-border-radius", "10px");
	        box.css("border-radius", "10px");
	        allElse.animate({opacity: '0.2'}, 150);
	    });
	});

	jQuery(document).ready(function(){
	    jQuery('.side-navbar').mouseleave(function(){
	        var box = jQuery('.description-container');
	        var allElse = jQuery('.page-main-content, .post-main-content, .blog-main-content, .blog-title, .page-main-content-2-columns, .page-main-content-transparent, .page-notitle-main-content, .widgets-bar-div, .sidebar-div, .sidebar-button, .widgets-bar-bottom-div, .title-show, .tagline-show, .post-aside, .post-audio, .post-chat, .post-gallery, .post-quote, .post-status, .post-video, .previousposts, .nextposts, .searches-title, .handcraft-expo-scroll-up-container');
	        box.animate({width: '0', opacity: '0'}, "1500");
	        box.css("-o-border-radius", "none");
	        box.css("-ms-border-radius", "none");
	        box.css("-webkit-border-radius", "none");
	        box.css("-moz-border-radius", "none");
	        box.css("border-radius", "none");
	        allElse.animate({opacity: '1'}, 150);
	    });
	});	
		
	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(0)").mouseenter(function(){	
		    jQuery("#previewer-content-1").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(0)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});
	
	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(1)").mouseenter(function(){	
		    jQuery("#previewer-content-2").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(1)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(2)").mouseenter(function(){	
		    jQuery("#previewer-content-3").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(2)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});	

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(3)").mouseenter(function(){	
		    jQuery("#previewer-content-4").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(3)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});
	
	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(4)").mouseenter(function(){	
		    jQuery("#previewer-content-5").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(4)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(5)").mouseenter(function(){	
		    jQuery("#previewer-content-6").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(5)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(6)").mouseenter(function(){	
		    jQuery("#previewer-content-7").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(6)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(7)").mouseenter(function(){	
		    jQuery("#previewer-content-8").finish().fadeIn(800);
		});
	});

	jQuery(document).ready(function(){
		jQuery(".side-navbar a:eq(7)").mouseleave(function(){
		var allToggledItems = jQuery("#blog-showcase-container, #previewer-content-1, #previewer-content-2, #previewer-content-3, #previewer-content-4, #previewer-content-5, #previewer-content-6, #previewer-content-7, #previewer-content-8");
		allToggledItems.hide();
		});
	});

})();
