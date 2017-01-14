<?php if ( ! defined('WP_CONTENT_DIR')) exit('No direct script access allowed'); ?>
<?php


class RDP_WIKI_EMBED_ADMIN_MENU {
    public $_options; // GLOBAL Options 
    public $_version;  

    public function __construct($version,$options){
        $this->_version = $version;
        $this->_options = $options;        
    }//__construct 


    public function enqueueStylesScripts() {
        if(wp_script_is('rdp-we-shortcode'))return;
        wp_enqueue_style( 'rdp-we-admin-style', plugins_url( 'css/admin.style.css',__FILE__ ), array('rdp-we-admin-theme-style','thickbox'),$this->_version );         
        wp_enqueue_style( 'rdp-we-admin-core-style', plugins_url( 'css/jquery-ui.css',__FILE__ ),null ,'1.11.2' );            
        wp_enqueue_style( 'rdp-we-admin-theme-style', plugins_url( 'css/jquery-ui.theme.min.css',__FILE__ ), array('rdp-we-admin-core-style'),'1.11.2' ); 
        wp_enqueue_style( 'rdp-we-tabs-style', plugins_url( 'css/tabs.css',__FILE__ ), array('rdp-we-admin-theme-style'),$this->_version );         
        
        wp_enqueue_script('rdp-we-shortcode',plugins_url('js/script.shortcode-popup.js', __FILE__), array('jquery', "jquery-ui-tabs"), $this->_version, true ); 
        $params = array(
            'settings' => $this->_options
        );
        wp_localize_script( 'rdp-we-shortcode', 'rdp_we_shortcode', $params );
    } //enqueueStylesScripts
    
    /*------------------------------------------------------------------------------
    Add admin menu
    ------------------------------------------------------------------------------*/
    static function add_menu_item(){
        if ( !current_user_can('activate_plugins') ) return;
        add_options_page( 'RDP Wiki Embed', 'RDP Wiki', 'manage_options', 'rdp-wiki-embed', 'RDP_WIKI_EMBED_ADMIN_MENU::generate_page' );
    } //add_menu_item     
    
    
    /*------------------------------------------------------------------------------
    Render settings page
    ------------------------------------------------------------------------------*/
    static function generate_page(){  
        $rv = self::handlePostback();
        
	echo '<div class="wrap">';
        echo '<h2>RDP Wiki Embed</h2>';
        
        if($rv['message']){
            printf ('<div id="message" class="%s is-dismissible">', $rv['status']);
            printf('<p>%s</p>', $rv['message']);
            echo '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>';
            echo '</div>';               
        }

        echo '<form method="post">';
        $sLabel = esc_attr__('Clear Wiki Cache', 'rdp-wiki-embed');
        submit_button( $sLabel, 'secondary', 'btnClearWikiCache', false );
        echo '</form>';

        echo '<form action="options.php" method="post">';
        settings_fields('rdp_wiki_embed_options');
        do_settings_sections('rdp-wiki-embed'); 
        submit_button();
        echo '</form>';
    }//generate_page

    private static function handlePostback() {
        global $wpdb; 
        $rv = array(
            'message' => '',
            'status' => 'notice-success notice'
        );
        if(isset($_POST['btnClearWikiCache'])){
            $table = RDP_WIKI_EMBED_TABLE;
            $sSQL = "TRUNCATE TABLE {$table};";
            $result = $wpdb->query($sSQL);
            if($result){
                $rv['message'] = 'Wiki cache cleared.';
            }else{
                $rv['message'] = 'Operation Failed: The wiki cache was not cleared.';
                $rv['status'] = 'notice-error error';
            }
        } 
        
        return $rv;
    }//handlePostback
    
    static function admin_page_init(){
        if ( !current_user_can('activate_plugins') ) return;
        //Add settings link to plugins page
        add_filter('plugin_action_links', array('RDP_WIKI_EMBED_ADMIN_MENU', 'add_settings_link'), 10, 2);
        
        register_setting(
            'rdp_wiki_embed_options',
            'rdp_wiki_embed_options',
            'RDP_WIKI_EMBED_ADMIN_MENU::options_validate'
        ); 
        
        // default shortcode settings
        add_settings_section(
            'rdp_we_defaults',
            esc_html__('Default Shortcode Settings','rdp-wiki-embed'),
            'RDP_WIKI_EMBED_ADMIN_MENU::defaults_section_text',
            'rdp-wiki-embed'
	);         
        add_settings_field(
            'toc_show',
            '',
            array('RDP_WIKI_EMBED_ADMIN_MENU', 'toc_show_input'),
            'rdp-wiki-embed',
            'rdp_we_defaults'
        );        
        
        // links
        add_settings_section(
            'rdp_we_links',
            esc_html__('Link Settings','rdp-wiki-embed'),
            'RDP_WIKI_EMBED_ADMIN_MENU::links_section_text',
            'rdp-wiki-embed'
	);  
        add_settings_field(
            'wiki_links',
            esc_html__( 'Internal wiki links:','rdp-wiki-embed'),
            array('RDP_WIKI_EMBED_ADMIN_MENU', 'wiki_links_input'),
            'rdp-wiki-embed',
            'rdp_we_links'
        );  

        // cache
        add_settings_section(
            'rdp_we_cache',
            esc_html__('Cache Settings','rdp-wiki-embed'),
            'RDP_WIKI_EMBED_ADMIN_MENU::cache_section_text',
            'rdp-wiki-embed'
	);  
        add_settings_field(
            'wiki_update',
            esc_html__( 'Content Update Interval:','rdp-wiki-embed'),
            array('RDP_WIKI_EMBED_ADMIN_MENU', 'content_update_input'),
            'rdp-wiki-embed',
            'rdp_we_cache'
        ); 

        // attribution
        add_settings_section(
            'rdp_we_attribution',
            esc_html__('Attribution','rdp-wiki-embed'),
            'RDP_WIKI_EMBED_ADMIN_MENU::attribution_section_text',
            'rdp-wiki-embed'
	);
        add_settings_field(
            'source_show',
            esc_html__( 'Credit Wiki Page:','rdp-wiki-embed'),
            array('RDP_WIKI_EMBED_ADMIN_MENU', 'source_show_input'),
            'rdp-wiki-embed',
            'rdp_we_attribution'
        );         
        
        // security
        add_settings_section(
            'rdp_we_security',
            esc_html__('Security','rdp-wiki-embed'),
            'RDP_WIKI_EMBED_ADMIN_MENU::security_section_text',
            'rdp-wiki-embed'
	);
        add_settings_field(
            'whitelist',
            '',
            array('RDP_WIKI_EMBED_ADMIN_MENU', 'whitelist_input'),
            'rdp-wiki-embed',
            'rdp_we_security'
        );        
        
    }//admin_page_init
    
    
    
    /*------------------------------------------------------------------------------
        Default Settings Section
    ------------------------------------------------------------------------------*/     
    static function defaults_section_text() {
        echo '<p>';
        _e("If there is functionality that wiki embed has that you don't want — disable it. This will keep pages lean and mean.",'rdp-wiki-embed');
        echo '</p>';
    }//defaults_section_text
    
    static function toc_show_input() {
        $options = get_option( 'rdp_wiki_embed_options' );
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings(); 

        
        // toc
        $value = isset($options['toc_show'])? $options['toc_show'] : $default_settings['toc_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[toc_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display table of contents ','rdp-wiki-embed');
        echo '</lable>';
        echo '<p class="description">';
        _e("Often, wiki pages have a table of contents (a list of content) at the top of each page.",'rdp-wiki-embed' );
        echo '</p>';
        echo '<br />';
        
        // edit links
        $value = isset($options['edit_show'])? $options['edit_show'] : $default_settings['edit_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[edit_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display edit links','rdp-wiki-embed');
        echo '</lable>';        
        echo '<p class="description">';
        _e("Often, wiki pages have edit links displayed next to sections, which is not always desired.",'rdp-wiki-embed' );
        echo '</p>';  
        echo '<br />';
        
        // info boxes
        $value = isset($options['infobox_show'])? $options['infobox_show'] : $default_settings['infobox_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[infobox_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display info boxes','rdp-wiki-embed');
        echo '</lable>';
        echo '<br /><br />';        

        // unreferenced boxes
        $value = isset($options['unreferenced_show'])? $options['unreferenced_show'] : $default_settings['unreferenced_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[unreferenced_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display "Unreferenced" warning boxes','rdp-wiki-embed');
        echo '</lable>';  
        echo '<br /><br />';         
        
        // admin nav boxes
        $value = isset($options['admin_nav_show'])? $options['admin_nav_show'] : $default_settings['admin_nav_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[admin_nav_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display admin navigation links','rdp-wiki-embed');
        echo '</lable>';    
        echo '<br /><br />';         
        
        // footer
        $value = isset($options['footer_show'])? $options['footer_show'] : $default_settings['footer_show'];
        $value = intval($value);        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[footer_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display wiki footer','rdp-wiki-embed');
        echo '</lable>';          
        
      
    }//toc_show_input


    /*------------------------------------------------------------------------------
        Attribution Settings Section
    ------------------------------------------------------------------------------*/ 
    static function attribution_section_text() {
        echo '';
    }//links_section_text 

    static function source_show_input() {
        $options = get_option( 'rdp_wiki_embed_options' );
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings();
        $value = isset($options['source_show'])? $options['source_show'] : $default_settings['source_show'];
        $value = intval($value);     
        
        echo '<lable>';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[source_show]" ' . checked( $value , 1, false) . '/> ';
        esc_html_e('Display a link to the content source after the embedded content ','rdp-wiki-embed');
        echo '</lable>'; 
        echo '<br />';
        echo '<span class="description">';
        _e('The label to use for attribution.','rdp-wiki-embed');
        echo '</span>: ';        
        $label = isset($options['pre_source'])? $options['pre_source'] : $default_settings['pre_source'];
        $label = esc_attr($label);
        echo '<input type="text" name="rdp_wiki_embed_options[pre_source]" value="' . $label  . '" size="7" />';


        
    }//source_show_input
    
    
    /*------------------------------------------------------------------------------
        Cache Settings Section
    ------------------------------------------------------------------------------*/   
    static function cache_section_text() {
        echo '';
    }//links_section_text 
    
    static function content_update_input() {
        $options = get_option( 'rdp_wiki_embed_options' );
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings(); 
        $value = isset($options['wiki_update'])? $options['wiki_update'] : $default_settings['wiki_update'];
        $value = intval($value); 
        
        echo '<select name="rdp_wiki_embed_options[wiki_update]">';
        foreach(RDP_WIKI_EMBED_PLUGIN::cache_settings() as $key => $interval){
            echo sprintf('<option value="%s" %s>%s</option>',$interval,selected($value,$interval,false), ucwords($key) );
        }
        echo '</select>';
        echo '<p class="description">';
        _e('Set the duration that the content of the wiki pages will be stored on your site, before they are refreshed.', 'rdp-wiki-embed');
        echo '</p>';        
        
    }//content_update_input
    
    
    
    /*------------------------------------------------------------------------------
        Links Settings Section
    ------------------------------------------------------------------------------*/    
    static function links_section_text() {
        echo '';
    }//links_section_text
    
    static function wiki_links_input() {
        $options = get_option( 'rdp_wiki_embed_options' );
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings(); 
        
        $value = isset($options['wiki_links'])? $options['wiki_links'] : $default_settings['wiki_links'];
        echo '<label><input name="rdp_wiki_embed_options[wiki_links]" type="radio" value="default" ' . checked($value,"default",false) . ' /> ';
        esc_html_e('Default &mdash; links take you back to the wiki site','rdp-wiki-embed');
        echo '</label>';
        echo '<br />';
        
        $openNew = isset($options['wiki_links_open_new'])? $options['wiki_links_open_new'] : $default_settings['wiki_links_open_new'];
        $openNew = intval($openNew);
        echo '<lable style="margin-left: 20px;">';
        echo '<input type="checkbox" value="1" name="rdp_wiki_embed_options[wiki_links_open_new]" ' . checked( $openNew , 1, false) . '/> ';
        esc_html_e('Open links in a new window.','rdp-wiki-embed');
        echo '</lable>';        
        
        echo '<br />';        
        echo '<label><input name="rdp_wiki_embed_options[wiki_links]" type="radio" value="overwrite" ' . checked($value,"overwrite",false). ' /> ';
        esc_html_e("Overwrite &mdash; links cause page content to be replaced with the content of the wiki site&#8217;s page",'rdp-wiki-embed');
        echo '</label>';
        echo '<br />';  
        
        $sTemplate = empty($options['global_content_replace_template'])? $default_settings['global_content_replace_template'] : $options['global_content_replace_template'];
        
        echo '<label for="ddWCRTemplate">';
        esc_html_e('Page Template to Use for Replaced Content','rdp-wiki-embed');
        echo '</label> <select  name="rdp_wiki_embed_options[global_content_replace_template]" id="ddWCRTemplate">';
        echo '<option value="same" '. selected( $sTemplate, 'same', false ) . '>';
        esc_html_e('Same as Current Page','rdp-wiki-embed');
        echo '</option>';
        echo '<option value="page.php" ' . selected( $sTemplate, 'page.php', false ) . '>';
        esc_html_e('Default Template','rdp-wiki-embed');
        echo '</option>'; 
        $templates = get_page_templates();
        foreach ( $templates as $template_name => $template_filename ) {
            if($template_filename == 'page.php')continue;
            echo "<option value='$template_filename' " . selected( $sTemplate, $template_filename, false ) . ">$template_name</option>";
        }        
        echo '</select>';        
        echo '<br />';

        $fglobalWCR = isset($options['global_content_replace'])? $options['global_content_replace'] : $default_settings['global_content_replace']; 
        $fglobalWCR = intval($fglobalWCR);
        echo '<lable style="margin-left: 20px;" for="global_content_replace">';
        echo '<input  type="checkbox" value="1" name="rdp_wiki_embed_options[global_content_replace]" id="global_content_replace" ' . checked( $fglobalWCR, 1, false) . ' /> ';
        _e('Look for all links to wiki sites listed in the <b>Security</b> section and force the content on the current page to be replaced with the content found at the wiki site when the link is clicked.','rdp-wiki-embed');
        echo '</lable>';

    }//wiki_links_input


    /*------------------------------------------------------------------------------
        Security Section
    ------------------------------------------------------------------------------*/
    static function security_section_text() {
        echo '<p>';
        _e ('Restrict the domains of wikis that you want content to be embedded from.<br />Example: <em>en.wikipedia.org</em> would allow any urls from the english wikipedia, but not from <em>de.wikipedia.org</em> German wikipedia','rdp-wiki-embed');
        echo '</p>';
    }//security_section_text 

    static function whitelist_input() {
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings();
        $sLabel = esc_attr__('Separate domains by new lines', 'rdp-wiki-embed');
        $options = get_option( 'rdp_wiki_embed_options' );
        $text_string = isset($options['whitelist'])? $options['whitelist'] : $default_settings['whitelist'];
        $text_string = esc_textarea($text_string);
        echo '<span class="alignleft">' . $sLabel . '</span><br />';
        echo '<textarea name="rdp_wiki_embed_options[whitelist]"  rows="10" cols="50">' . $text_string . '</textarea>';        
    }//whitelist_input
    
    
    
    /*------------------------------------------------------------------------------
    Validate incoming data
    ------------------------------------------------------------------------------*/
    static function options_validate($input){
        $default_settings = RDP_WIKI_EMBED_PLUGIN::default_settings();
 	$options = array(
                'wiki_update'     => (isset($input['wiki_update']) && intval($input['wiki_update']) >= 0 ? $input['wiki_update'] : $default_settings['wiki_update'] ), 
                'wiki_links'      => (isset($input['wiki_links']) ? $input['wiki_links'] : $default_settings['wiki_links'] ),
                'wiki_links_open_new' => (isset( $input['wiki_links_open_new']) && $input['wiki_links_open_new'] == 1 ? 1 : 0 ),
                'global_content_replace' => (isset( $input['global_content_replace']) && $input['global_content_replace'] == 1 ? 1 : 0 ),
                'global_content_replace_template' => (isset($input['global_content_replace_template']) ? $input['global_content_replace_template'] : $default_settings['global_content_replace_template'] ),
                'source_show'      => (isset( $input['source_show']) && $input['source_show'] == 1 ? 1 : 0 ),
                'pre_source'  => (isset($input['pre_source']) ? $input['pre_source'] : $default_settings['pre_source'] ),
                'toc_show' => (isset( $input['toc_show']) && $input['toc_show'] == 1 ? 1 : 0 ),
                'edit_show'     => (isset( $input['edit_show']) && $input['edit_show'] == 1 ? 1 : 0 ),
                'infobox_show'  => (isset( $input['infobox_show']) && $input['infobox_show'] == 1 ? 1 : 0 ),
                'unreferenced_show' => (isset( $input['unreferenced_show']) && $input['unreferenced_show'] == 1 ? 1 : 0 ),
                'whitelist' => (isset($input['whitelist']) ? $input['whitelist'] : $default_settings['whitelist']), 
                'admin_nav_show' => (isset( $input['admin_nav_show']) && $input['admin_nav_show'] == 1 ? 1 : 0 ),
                'footer_show' => (isset( $input['footer_show']) && $input['footer_show'] == 1 ? 1 : 0 ),
            );
        return $options;        
    }//options_validate
    
    
    /**
     * Add Settings link to plugins page
     */
    static function add_settings_link($links, $file){
        if ($file == RDP_WIKI_EMBED_PLUGIN_BASENAME){
            $settings_link = '<a href="options-general.php?page=' . RDP_WIKI_EMBED_PLUGIN::$plugin_slug . '">'.esc_html__("Settings", 'rdp-wiki-embed').'</a>';
             array_unshift($links, $settings_link);
        }
        return $links;
     }      
}//RDP_WIKI_EMBED_ADMIN_MENU


/* EOF */