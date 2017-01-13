<?php

class Pcode_Apf_Page_Dashboard extends Pcode_AdminPageFramework
{
    
    // Define the setUp() method to set how many pages, page titles and icons etc.
    public function setUp()
    {	
    	// Create the root menu
        $this->setRootMenuPage
        (	'PressCode',    // specify the name of the page group
            'dashicons-edit'   // menu icon
        );   
                           
        // Add the sub menu item
        $this->addSubMenuItems
        (	
        	array
            (	'title' => 'Dashboard',
                'page_slug' => 'pcode_dashboard'
            ),
            array
            (	'title' => 'CSS',
                'href' => admin_url() . 'edit.php?post_type=pcode_custom_css'
            ),
            array
            (	'title' => 'JavaScript',
                'href' => admin_url() . 'edit.php?post_type=pcode_custom_js'
            ),
            array
            (	'title' => 'PHP',
                'href' => admin_url() . 'edit.php?post_type=pcode_custom_php'
            ),
            array
            (	'title'         => 'Settings',
                'href' => admin_url() . 'admin.php?page=pcode_settings'
            )
            
        );  
        
        // Add in-page tabs
        $this->addInPageTabs
        (	'pcode_dashboard',    // set the target page slug so that the 'page_slug' key can be omitted from the next continuing in-page tab arrays.
            array
            (	'tab_slug'  =>    'pcode_dashboard_general',    // avoid hyphen(dash), dots, and white spaces
                'title'     =>    __('General', 'presscode'),
            )
            
        );    
 
        $this->setPageHeadingTabsVisibility(false);    // disables the page heading tabs by passing false.
        $this->setInPageTabTag('h2');        // sets the tag used for in-page tabs
        
    }
    
    /**
     * One of the predefined callback method.
     * 
     * @remark      content_{page slug}
     */
    public function content_pcode_dashboard($sContent)
    {	$pluginData = get_plugin_data(PCODE_BASE . '/presscode.php');
    	
    	
    	$content = 
    		"<div style='display: table;'>" . 
	    		"<div style='display: table-cell; vertical-align: middle; padding: 0px 20px 0px 0px;'>" . 
	    			"<img src='" . plugins_url('presscode') . "/assets/icon-256x256.png'></div>" . 
	    		"<div style='display: table-cell; vertical-align: middle;'>" . 
	    			"<h1 style='font-weight: bold;'>" . $pluginData['Name'] . " (v" . $pluginData['Version'] . ")</h1>" . 
	    			"<h3>The best and easiest way to add custom code to your WordPress site.</h3>" . 
	    			"<h5>Brought to you by <a href='" . $pluginData['AuthorURI'] . "' target='_blank'>" . 
	    				$pluginData['Author'] . "</a>.</h5>" . 
	    		"</div>" . 
    		"</div>";
    
    
        return $content . $sContent; 
        
    }
   
}
 
// Instantiate the class object.
new Pcode_Apf_Page_Dashboard;

?>