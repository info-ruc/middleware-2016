var $j=jQuery.noConflict();
// Use jQuery via $j(...)

$j(document).ready(rdp_we_shortcode_popup_onReady);
var rdp_we_popupOpening = false;

function rdp_we_shortcode_popup_onReady(){
    rdp_wiki_embed_toggleSettingInputs();
    $j('.wp-admin').on( "click", '#rdp-we-shortcode-button' , function(){
        rdp_we_popupOpening = true;
        $j('body').addClass('rdp-we-shortcode');
        setTimeout(function(){ rdp_we_popupOpening = false; }, 3000);
    }); 
    $j('body').bind('DOMSubtreeModified', function(e) {
        if(rdp_we_popupOpening)return true;
        if(!$j('body').hasClass('modal-open') && $j('body').hasClass('rdp-we-shortcode'))rdp_we_removeBodyClass();
    });     
    $j('.wp-admin').on( "click", '#btnInsertWikiEmbedShortcode' , rdp_wiki_embed_insertWikiEmbedShortcode ); 
    $j('.wp-admin').on( "click", '#rdp_we_use_default_settings' , rdp_wiki_embed_toggleSettingInputs);    
}//rdp_we_shortcode_popup_onReady

function rdp_we_removeBodyClass(){
    $j('body').removeClass('rdp-we-shortcode');
}

function rdp_wiki_embed_toggleSettingInputs(){
    $j('input.rdp_we_setting').prop('disabled', function(i, v) { return !v; });
}//rdp_we_toggleSettingInputs

function rdp_wiki_embed_insertWikiEmbedShortcode(){
    var srcURL = jQuery("#rdp_we_embed_src");
    var msg = "Please enter the wiki source URL.";
    if(rdp_wiki_embed_admin_chk_blank(srcURL,msg)){return false;}
    if(srcURL.val() === 'http://'){
        alert(msg);
        return false;
    }
    
    var sCode = "[rdp-wiki-embed url='" + srcURL.val() + "'";  
    
    var fUseDefaults = ( jQuery("#rdp_we_use_default_settings").attr('checked') ? 1: 0 );    
    if(fUseDefaults != 1){
        var weTOCShow = ( jQuery("#rdp_we_toc_show").attr('checked') ? 1: 0 );
        sCode += " toc_show='" + weTOCShow + "'"; 

        var weEditShow = ( jQuery("#rdp_we_edit_show").attr('checked') ? 1: 0 );
        sCode += " edit_show='" + weEditShow + "'";    

        var weInfoboxShow = ( jQuery("#rdp_we_infobox_show").attr('checked') ? 1: 0 );
        sCode += " infobox_show='" + weInfoboxShow + "'";

        var weUnreferencedShow = ( jQuery("#rdp_we_unreferenced_show").attr('checked') ? 1: 0 );
        sCode += " unreferenced_show='" + weUnreferencedShow + "'";         

        var weAdminNavShow = ( jQuery("#rdp_we_admin_nav_show").attr('checked') ? 1: 0 );
        sCode += " admin_nav_show='" + weAdminNavShow + "'";         

        var weFooterdShow = ( jQuery("#rdp_we_footer_show").attr('checked') ? 1: 0 );
        sCode += " footer_show='" + weFooterdShow + "'";         
}    

    sCode += "]";     
    rdp_we_removeBodyClass();
    var win = window.dialogArguments || opener || parent || top;    
    win.send_to_editor( sCode );     
}//rdp_we_insertWikiEmbedShortcode


function rdp_wiki_embed_admin_chk_blank(ctl,msg)
{
    if(typeof msg == 'undefined' || msg=="")
     {
      msg="This field cannot be blank";
     }
    if (ctl.val()=="")
     {
            alert(msg);
            ctl.val("");
            ctl.focus();
            return (true);
     }
    else
     return (false);
}  