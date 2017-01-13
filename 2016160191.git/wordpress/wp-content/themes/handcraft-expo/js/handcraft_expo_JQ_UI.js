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



	// Main Side Menu

		jQuery(document).ready(function(){
			jQuery(".navbar-container li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").fadeIn(300);
				});
				jQuery(this).mouseleave(function(){
					jQuery(this).children("ul");
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".navbar-container .sub-menu li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").fadeIn(300);
				});
				jQuery(this).mouseleave(function(){
					if (jQuery(this).children().mouseenter == false && jQuery(this).parent().mouseenter == false){
						jQuery(this).children("ul, li");
					}
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".navbar-container .sub-menu li ul").each(function(){
				jQuery(this).mouseleave(function(){
					if (jQuery(this).children("ul, li, a").mouseenter == false || jQuery(this).parent("ul, li, a").mouseenter == false){
						jQuery(this).children("ul, li, a");
						jQuery(this);
					}
				});
			});
		});


	// Widgets Top Menu


		jQuery(document).ready(function(){
			jQuery(".widgets-bar-content-top li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").slideDown(250).fadeIn(500);
				});
				jQuery(this).mouseleave(function(){
					jQuery(this).children("ul").fadeOut(0);
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".widgets-bar-content-top .sub-menu li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").slideDown(250).fadeIn(500);
				});
				jQuery(this).mouseleave(function(){
					if (jQuery(this).children().mouseenter == false && jQuery(this).parent().mouseenter == false){
						jQuery(this).children("ul, li").slideUp(250).fadeOut(0);
					}
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".widgets-bar-content-top .sub-menu li ul").each(function(){
				jQuery(this).mouseleave(function(){
					if (jQuery(this).children("ul, li, a").mouseenter == false || jQuery(this).parent("ul, li, a").mouseenter == false){
						jQuery(this).children("ul, li, a").fadeOut(0).slideUp(250);
						jQuery(this).fadeOut(0).slideUp(250);
					}
				});
			});
		});


	// Widgets Side Menu


		jQuery(document).ready(function(){
			jQuery(".sidebar-div li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").slideDown(250).fadeIn(500);
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".sidebar-div .sub-menu li").each(function(){
				jQuery(this).mouseenter(function(){
					jQuery(this).children("ul:first()").slideDown(250).fadeIn(500);
				});
			});
		});

		jQuery(document).ready(function(){
			jQuery(".sidebar-div .sub-menu li ul").each(function(){
				jQuery(this).mouseleave(function(){
					if (jQuery(this).children("ul, li, a").mouseenter == false || jQuery(this).parent("ul, li, a").mouseenter == false){
						jQuery(this).children("ul, li, a").fadeOut(0).slideUp(250);
						jQuery(this).fadeOut(0).slideUp(250);
					}
				});
			});
		});



})();