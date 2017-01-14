jQuery(document).ready(function(){    
    jQuery("button.close-notification").live('click', function(){
       
        jQuery(this).parents("div.notification").fadeOut('fast', function(){
            
            jQuery.ajax({
                
                type: "post",
                url: ajax_var.url,
                dataType   : "html",
                cache: false,
                data: "action=hide_topbar&nonce=" + ajax_var.nonce,
                			success    : function(data, textStatus, jqXHR){
                                //alert('ok : ' + data);
                                
                			},
                            error     : function(jqXHR, textStatus, errorThrown) {
                                //alert('erreur : ' + errorThrown);
                            } 
            
            });        
        
        });
       
    });
    
});