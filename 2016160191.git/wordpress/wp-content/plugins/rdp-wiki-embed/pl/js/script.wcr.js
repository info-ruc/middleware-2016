var $j=jQuery.noConflict();
// Use jQuery via $j(...)

$j(document).ready(rdp_wcr_main_onReady);
var rdp_wcr_main_onReady_fired = false;

function rdp_wcr_main_onReady(){
    if(rdp_wcr_main_onReady_fired)return;
    rdp_wcr_main_onReady_fired = true;
    $j('#mainContent .ready').removeClass('invisible');
    rdp_wcr_handle_links();
}//rdp_wcr_main_onReady

function rdp_wcr_handle_links(){

    var baseURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
    var baseTarget = (typeof rdp_wiki_embed_settings != 'undefined')? url('protocol', rdp_wiki_embed_settings.target_url) + "//" + url('hostname', rdp_wiki_embed_settings.target_url): '';
    var oDomains = rdp_wcr.domains.split(',');
    
    $j("a").each(function(i){
        var sHREF = $j(this).attr('href');        
        if(typeof sHREF == 'undefined')return true;        
        if(sHREF.substring(0, 1) == '#')return true;
        if(url('?rdp_we_resource',sHREF))return true;
        if($j(this).hasClass('ppe-add-to-cart'))return true;
        if($j(this).hasClass('ppe-cover-link'))return true;  
        if($j(this).hasClass('rdp_ppe_add_to_cart'))return true;
        if($j(this).hasClass('rdp-ppe-cta-button'))return true;
        if($j(this).hasClass('rdp-ppe-cover-link'))return true;  
        if($j(this).hasClass('image'))return true;  
        if($j(this).hasClass('rdp-wbb-go-to-wiki-page'))return true;  
        if($j(this).attr('rel') === 'external_link')return true; 

        var n = -1;
        for (i = 0; i < oDomains.length; i++) { 
            n = sHREF.indexOf(oDomains[i]);
            if(n >= 0)break;
        }
        var p = 'pediapress.com'.indexOf(url('domain', sHREF));
        if(n <= 0 && p <= 0)return true;
        if(sHREF.substring(0, 2) == '//') sHREF = 'http:' + sHREF;
        if(baseTarget != '' && sHREF.substring(0, 1) == '/') sHREF = baseTarget + sHREF;        
        urls = sHREF.match(/(https?:\/\/[^\s]+)/g);
        if(urls == null)return true;
        $j(this).attr('href',baseURL+jQuery.query.set("rdp_we_resource", sHREF) ).removeAttr('target');    
        $j(this).data("href",sHREF).addClass('wiki-link');
    });     
}//rdp_wcr_handle_links
