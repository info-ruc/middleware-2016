jQuery(document).ready(function(){
    jQuery.fn.exists = function(){return this.length>0;}
       
    /** Navigation **/
    jQuery('#nav li').mouseover( function(){
        jQuery(this).children('ul.children').slideDown("fast").show();
        jQuery(this).children('ul.sub-menu').slideDown("fast").show();
    }).mouseleave( function(){
        jQuery(this).children('ul.children').stop(true,true).slideUp("fast").hide();
        jQuery(this).children('ul.sub-menu').stop(true,true).slideUp("fast").hide();
    });
    
    /** Responsive video player **/                        
    var aspectRatio = 9/16; // Make up an aspect ratio
    // Once the video is ready
    jQuery("#video-code iframe, #video-code .wp-video, #video-code .me-plugin, #video-code .me-plugin embed, #video-code .mejs-container, #video-code .wp-video-shortcode, .video-embed iframe, .video-embed embed, .video-embed object").ready(function(){
        resizeVideoJS();
    });
    jQuery('#content').bind('resize', function(){
        resizeVideoJS();// Call the function on resize
    }) ;     
    function resizeVideoJS(){
        // Get the parent element's actual width
        //var width = document.getElementById(myPlayer.id).parentElement.offsetWidth;
        var width = jQuery('#video-code').width();
      
        // Set width to fill parent element, Set height
        jQuery('#video-code iframe, #video-code .wp-video, #video-code .me-plugin, #video-code .me-plugin embed, #video-code .mejs-container, #video-code .wp-video-shortcode, .video-embed iframe, .video-embed embed, .video-embed object').width(width).height( width * aspectRatio );
    }
    
});