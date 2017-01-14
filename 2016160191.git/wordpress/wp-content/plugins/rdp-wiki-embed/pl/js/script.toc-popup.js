 $j=jQuery.noConflict();
// Use jQuery via $j(...)

var rdp_we_toc_popup_onReady_fired = false;

$j(document).ready(rdp_we_toc_popup_onReady);

function rdp_we_toc_popup_onReady(){
    if(rdp_we_toc_popup_onReady_fired)return;
    rdp_we_toc_popup_onReady_fired = true;    

    oRDPWEContainer = $j('#rdp-we-main');
    if(!oRDPWEContainer.length)return;  
    oTOC = $j('div.we-toc-link-container');
    if(!oTOC.length){
       oRDPWEContainer.first().before('<div class="we-toc-link-container"><a href="#rdp_we_toc_inline_content" class="we-toc-link">Show Book Table of Contents</a></div>' );
    }
    $j(".we-toc-link").colorbox(
                                {returnFocus:false,
                                inline:true, 
                                innerWidth: 960, 
                                innerHeight:"80%",
                                maxHeight: 500,
                                transition:"none",
                                top: 0
                                });  
                                
    $j(document).bind('cbox_cleanup', function(){
      $j("#rdp_we_toc_inline_content_wrapper").html($j("#cboxLoadedContent").html());
    });  

}//rdp_we_toc_popup_onReady


