<?php if ( ! defined('WP_CONTENT_DIR')) exit('No direct script access allowed'); ?>
<?php


class RDP_WIKI_EMBED_CONTENT {
    private $_hasError = false;
    private $_lastMessage = '';
    private $_key = '';
    private $_contentRaw = '';
    private $_content = '';
    private $_dateCreated = null;
    
    public function __construct($props = null){
        if(!$props){
            $this->_hasError = true;
            $this->_lastMessage = esc_html__('Missing props parameter.','rdp-job-board');
            return ;        
        }
        
       foreach ($props as $key => $value ) {
           $newvalue = (isset($props[$key])) ? $props[$key] : null;
           if ($newvalue === "true") $newvalue = true;
           if ($newvalue === "false") $newvalue = false;
           $this->$key = $newvalue;
       }
       
       $this->_dateCreated = current_time( 'mysql' );
       $this->_key = RDP_WIKI_EMBED_UTILITIES::getKey($this->url);
    }//__construct 
    
    public function hasError(){
        return $this->_hasError;
    }
    
    public function lastMessage(){
        return $this->_lastMessage;
    } 
    
    public function fetch() {
        global $wpdb;
        $wpdb->suppress_errors();
        $wpdb->show_errors(false);        
        $table = RDP_WIKI_EMBED_TABLE;
        $sSQL = sprintf('Select wiki_content, date_created From %s Where wiki_key = "%s";',  $table, $this->_key);
        $row = $wpdb->get_row($sSQL);
        if($row){
            $this->_contentRaw = $row->wiki_content;
            $this->_dateCreated = $row->date_created;
        }
        
        $fIsExpired = $this->isExpired();
        if(empty($this->_contentRaw) || $fIsExpired){
            $this->content_get($wpdb,$table);
        }
        
        $this->preRender();
        return $this->_content;
    }//fetch
    
    private function preRender() {
        if($this->_hasError){
            $label = __('ERROR', 'rdp-wiki-embed');
            $msg = sprintf('<span></span> %s: %s', $label, $this->_lastMessage);
            $this->_content = RDP_WIKI_EMBED_UTILITIES::showMessage($msg, true, false);
            return;
        }
        
        $permalink = get_the_permalink();
        $html = new rdp_simple_html_dom();
        $html->load('<html>'.$this->_contentRaw.'</html>');
        
        $remove_elements = explode( ",", $this->remove );
        if(empty($this->edit_show)){
            array_push($remove_elements,'.editsection');
            array_push($remove_elements,'.mw-editsection');
        }
        if(empty($this->toc_show)) array_push($remove_elements, '#toc'); 
        if(empty($this->infobox_show)) array_push($remove_elements, '.infobox'); 
        if(empty($this->admin_nav_show)) array_push($remove_elements, '#mw-navigation'); 
        if(empty($this->footer_show)) array_push($remove_elements, '#footer'); 
        
        
        foreach ( $remove_elements as $element ) {
            foreach($html->find($element) as $e) 
            {
                $e->outertext = '';
            }            
        }

        if(empty($this->unreferenced_show)){
            foreach($html->find('table[class*=ambox-Unreferenced') as $e) 
            {
                $e->outertext = '';
            }            
        }
        
        $fOpenNew = ($this->_options['wiki_links'] == 'default' && !empty($this->_options['wiki_links_open_new']));
        $fOverwrite = ($this->_options['wiki_links'] === 'overwrite');

        foreach($html->find('a') as $link){
            $fIsExternal = false;
            if(isset($link->class)){
                $pos = strpos($link->class, 'external');
                $fIsExternal = !($pos === false);
                if($fIsExternal)$link->rel = 'external_link';
            } 
            
            $pos = isset($link->href)?substr($link->href, 0, 1) === '#':-1;
            
            if(!$fOverwrite && 
                $fOpenNew && 
                isset($link->href) &&
                ($pos === false)){
                    $link->target = '_new';                    
            }
            
            if(!$fIsExternal && 
                isset($link->href) &&
                ($pos === false)){
                if(isset($link->class)){
                    $link->class .= ' wiki-link';
                }else{
                    $link->class = 'wiki-link';
                }
            }            
            
            if(!$fIsExternal && 
                $fOverwrite && 
                isset($link->href) &&
                ($pos === false)){
                    $encodedURL = urlencode($link->href);
                    // restore hashtags
                    $encodedURL = str_replace('%23', '#',$encodedURL);
                    $params = array(
                        'rdp_we_resource' => $encodedURL
                    );
                    $link->href = esc_attr(add_query_arg($params,$permalink));                
                    $link->target = null;
                    $att = 'data-href';
                    $link->$att = esc_attr($link->href);
                    $att = 'data-title';
                    $link->$att = esc_attr($link->innertext);                    
                    $link->title = esc_attr($link->innertext);
                    
            }

        }                  

        $source = $html->find('.printfooter',0);
        if($source){
            if(!$this->source_show){
                $source->outertext = '';
            }else{
                $source->innertext = sprintf('%s <a rel="external_link" class="external" href="%s">%s</a>', $this->pre_source, $this->url, $this->url);
            }            
        }

            
        $this->_content = $html->find('body',0)->innertext;        
    }//preRender
    
    private function scrub(&$body) {
        $remove_elements = array(
            '#jump-to-nav',
            '#column-one',
            '#siteSub',
            '#contentSub',
            '#catlinks',
            'script',
            'style',
            'link[rel=stylesheet]',
            '.mw-inputbox-centered',
            'table.plainlinks',
            'div.plainlinks'
        );
        
        
        
        foreach ( $remove_elements as $element ) {
            foreach($body->find($element) as $e) 
            {
                $e->outertext = '';
            }            
        }
        
        foreach($body->find('table') as $e) 
        {
            $e->style = str_replace('float:right;', '', $e->style);
        } 
        
        $oURLPieces = parse_url($this->url);
        if(empty($oURLPieces['scheme']))$oURLPieces['scheme'] = 'http';        
        $sSourceDomain = $oURLPieces['scheme'].'://'.$oURLPieces['host'];        
        foreach($body->find('img') as $img){
             $oImgPieces = parse_url($img->src);
             if(!isset($oImgPieces['host'])):
                 $sPath = $oImgPieces['path'];
                 if(substr($sPath, 0, 2) == '..')$sPath = substr($sPath, 3);
                 if(substr($sPath, 0, 1) != '/')$sPath = '/'.$sPath;
                 $img->src = $sSourceDomain . $sPath;
             endif;
            
             $class = 'data-file-width';
             $img->$class = null;
             $class = 'data-file-height';
             $img->$class = null;
             $img->srcset = null;
             if($img->width >= 400 || $img->height >= 400){
                $img->width = null;
                $img->height = null;
                $img->style = 'width: 100%;max-width: 400px;height: auto;';
             }
        }
        
        foreach($body->find('a') as $link){
            if(!isset($link->href))continue;

            $pos = strpos($link->href, 'Special:');
            $fIsSpecial = !($pos === false);
            if($fIsSpecial){
                $link->outertext = $link->innertext;
                continue;
            }
          
            if($link->innertext == 'printable version'){
                $link->class = $link->class . ' external';

            }
            if($link->innertext == 'edit'){
                $link->class = $link->class . ' external';

            }

            $oLinkPieces = parse_url($link->href);
             if(is_array($oLinkPieces) && !isset($oLinkPieces['host'])):
                 if(!key_exists('path', $oLinkPieces))continue;
                 $sPath = $oLinkPieces['path'];
                 if(substr($sPath, 0, 2) == '..')$sPath = substr($sPath, 3);
                 if(substr($sPath, 0, 1) != '/')$sPath = '/'.$sPath;
                 $link->href = $sSourceDomain . $sPath;
                if(substr(strtolower($link->href), 0, 4) != 'http'){
                     $link->href = $oURLPieces['scheme'] . ':' . $link->href;
                }  
                $pos = false;                
                if(key_exists('query', $oLinkPieces)){
                    $link->href .= '?' . $oLinkPieces['query'];
                    parse_str($oLinkPieces['query'], $output);
                    if(key_exists('title', $output)){
                        $pos =  (strpos($this->url,$output['title']) !== false);
                    }
                }
                if(key_exists('fragment', $oLinkPieces)){
                    if($pos){
                        $link->href = '#' . $oLinkPieces['fragment'];
                    }else{
                       $link->href .= '#' . $oLinkPieces['fragment']; 
                    }
                }
                 
             endif;  
        }   
        
    }//content_scrub
    
    private function content_get(&$wpdb,$table) {
        $html = rdp_file_get_html($this->url);
        if(!$html){
            $this->_hasError = true; 
            $msg = esc_html__('Unable to retrieve wiki contents.', 'rdp-wiki-embed');
            $this->_lastMessage = $msg;
            return;
        }
        
        $body = $html->find('body',0);
        if(!$body){
            $msg = esc_html__('Unable to retrieve wiki contents.', 'rdp-wiki-embed');
            $this->_lastMessage = $msg;
            return;            
        }
     
        $this->scrub($body);
        $this->_contentRaw = $body->outertext;        

        $wpdb->update( 
                $table, 
                array( 
                        'wiki_content' => $this->_contentRaw,
                        'date_created' => current_time( 'mysql' )
                ), 
                array( 'wiki_key' => $this->_key ), 
                array( 
                        '%s',	
                        '%s'	
                ), 
                array( '%s' ) 
        ); 
        
        if($wpdb->rows_affected != 0)return;
        $wpdb->insert( 
                $table, 
                array( 
                        'wiki_key' => $this->_key, 
                        'wiki_content' => $this->_contentRaw,
                        'date_created' => current_time( 'mysql' )
                ), 
                array( 
                        '%s',
                        '%s',
                        '%s' 
                ) 
        );            
    }//content_get
    
    private function isExpired() {
        $date = new DateTime($this->_dateCreated);
        $update = intval($this->_options['wiki_update']);
        $i = DateInterval::createFromDateString($update . ' minutes');            
        $date->add($i); 
        return (new DateTime() > $date);
    }//isExpired
    
}//RDP_WIKI_EMBED_CONTENT


/*EOF */