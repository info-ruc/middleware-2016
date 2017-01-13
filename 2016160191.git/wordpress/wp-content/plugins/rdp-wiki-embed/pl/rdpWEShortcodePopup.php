<?php


class RDP_WIKI_EMBED_SHORTCODE_POPUP {
    
    public static function addMediaButton($page = null, $target = null){
        global $pagenow;
        if ( !in_array( $pagenow, array( "post.php", "post-new.php" ) ))return;        
        $rdp_we_button_src = plugins_url('/css/images/icon.png', __FILE__);
        $output_link = '<a href="#TB_inline?width=400&inlineId=rdp-we-shortcode-popup" class="thickbox button" title="RDP Wiki Embed" id="rdp-we-shortcode-button">';
        $output_link .= '<span class="wp-media-buttons-icon" style="background: url('. $rdp_we_button_src.'); background-repeat: no-repeat; background-position: 0 0;"/></span>';
        $output_link .= '</a>';
        echo $output_link;
    }//addMediaButton 
    
    public static function renderPopupForm(){
        global $pagenow;
        if ( !in_array( $pagenow, array( "post.php", "post-new.php" ) ))return;    
        
        $options = get_option( RDP_WIKI_EMBED_PLUGIN::$options_name );
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings();
        
        echo '<div id="rdp-we-shortcode-popup" style="display:none;">';
        
        echo '<div class="media-item media-blank">';

        echo '<table class="describe" style="margin-top: 20px;">';
        echo '<tbody>';        
        
        /*------------------------------------------------------------------------------
            Source URL
        ------------------------------------------------------------------------------*/   
        echo '<tr>';        
        echo '<th valign="top" class="label" scope="row">';
        echo '<span class="alignleft"><label for="rdp-we-embed-src">';
        _e('Source URL', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '<span class="alignright"><abbr class="required" title="required">*</abbr></span>';
        echo '</th>';
        echo '<td class="field"><input type="text" aria-required="true" value="http://" id="rdp_we_embed_src"></td>';
        echo '</tr> ';  
        
        /*------------------------------------------------------------------------------
            Use Default Settings
        ------------------------------------------------------------------------------*/ 
        echo '<tr>';
        $sLabel = esc_html__('Always use the default options from the settings page', 'rdp-wiki-embed');        
        echo '<th valign="top" class="label" scope="row">';
        echo '<span class="alignleft"><label for="rdp_we_use_default_settings">';
        _e('Settings Mode', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</th>';
        echo '<td class="field"><input type="checkbox" aria-required="true" value="1" id="rdp_we_use_default_settings" checked="checked" /> <span ><label for="rdp_we_use_default_settings"> '. $sLabel . '</label></span></td>';
        echo '</tr> ';         
        
        /*------------------------------------------------------------------------------
            Show TOC
        ------------------------------------------------------------------------------*/          
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['toc_show'])? $options['toc_show'] : $default_settings['toc_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_toc_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_toc_show"> ';
        _e('Display table of contents', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>';

        /*------------------------------------------------------------------------------
            Show Edit Links
        ------------------------------------------------------------------------------*/  
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['edit_show'])? $options['edit_show'] : $default_settings['edit_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_edit_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_edit_show"> ';
        _e('Display edit links', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>';  
        
        /*------------------------------------------------------------------------------
            Show Info Boxes
        ------------------------------------------------------------------------------*/  
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['infobox_show'])? $options['infobox_show'] : $default_settings['infobox_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_infobox_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_infobox_show"> ';
        _e('Display info boxes', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>'; 

        /*------------------------------------------------------------------------------
            Show Unreferenced Boxes
        ------------------------------------------------------------------------------*/  
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['unreferenced_show'])? $options['unreferenced_show'] : $default_settings['unreferenced_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_unreferenced_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_unreferenced_show"> ';
        _e('Display "Unreferenced" warning boxes', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>';         
   
        /*------------------------------------------------------------------------------
            Show Admin Navigation Links
        ------------------------------------------------------------------------------*/  
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['admin_nav_show'])? $options['admin_nav_show'] : $default_settings['admin_nav_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_admin_nav_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_admin_nav_show"> ';
        _e('Display admin navigation links', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>';         
         
        /*------------------------------------------------------------------------------
            Show Wiki Footer
        ------------------------------------------------------------------------------*/  
        echo '<tr>';
        echo '<th valign="top" class="label" scope="row"></th>';
        echo '<td class="field">';
        $value = isset($options['footer_show'])? $options['footer_show'] : $default_settings['footer_show'];
        $value = intval($value);        
        echo '<input type="checkbox" aria-required="true" class="rdp_we_setting" value="1" id="rdp_we_footer_show" ' . checked( $value , 1, false) . ' /> <span style="margin-right: 8px;"><label for="rdp_we_footer_show"> ';
        _e('Display wiki footer', 'rdp-wiki-embed');
        echo '</label></span>';
        echo '</tr>';         
         
        
        /*------------------------------------------------------------------------------
            Insert Shortcode Button
        ------------------------------------------------------------------------------*/         
        echo '<tr>';
        echo '<td colspan="2">';
        echo '<input type="button" value="Insert Shortcode" id="btnInsertWikiEmbedShortcode" class="button-primary">';
        echo '</td></tr> ';           
        
        echo '</tbody>';
        echo '</table>';

        echo '</div><!-- media-item -->';        
        echo '</div><!-- rdp-we-shortcode-popup -->';         
    }//renderPopupForm
    
}//RDP_WIKI_EMBED_SHORTCODE_POPUP
