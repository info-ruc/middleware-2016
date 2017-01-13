<?php

class Pcode_Apf_Page_Settings extends Pcode_AdminPageFramework {
    
    public function setUp()
    {              
        $this->addSubMenuItems
        (	array
            (	'title'         => 'Settings',        // page title
                'page_slug'     => 'pcode_settings'
            )        
        );  
        
        
        $this->addInPageTabs
        (	'pcode_settings',    // set the target page slug so that the 'page_slug' key can be omitted from the next continuing in-page tab arrays.
            array
            (	'tab_slug'  =>    'tab_general',
                'title'     =>    __('General', 'presscode'),
            ),
            array
            (	'tab_slug'  =>    'tab_css',
                'title'     =>    __('CSS', 'presscode'),
            ),
            array
            (	'tab_slug'  =>    'tab_js',
                'title'     =>    __('JavaScript', 'presscode'),
            ),
            array
            (	'tab_slug'  =>    'tab_php',
                'title'     =>    __('PHP', 'presscode'),
            )
        );    
 
        $this->setPageHeadingTabsVisibility(false);    // disables the page heading tabs by passing false.
        $this->setInPageTabTag('h2');        // sets the tag used for in-page tabs
        
    }
    
    public function content_top_pcode_settings_tab_general($sContent)
    {       
        return $sContent 
            . '<h3>General Settings</h3>'
            . '<p>Global plugin settings are defined here.</p>';
    	
    }
    
    
    public function load_pcode_settings_tab_general($oAdminPage)
    {	
    	$this->addSettingFields
	    	(	array
	    		(	'field_id' => 'editor_theme_general',
				    'title' => __('Default Code Editor Theme', 'presscode'),
				    'type' => 'select',
				    'help' => __('The default theme to use in the code editor.  Themes specified explicitly within a specific ' . 
				   		'language\'s settings take precedence over this setting.', 'presscode'),
				    'default' => 'default',
				    'label' =>
				    	array
				    	(	'default' => __('Default', 'presscode'),
				        	'ttcn' => __('TTCN', 'presscode'),
				        	'twilight' => __('Twilight', 'presscode')
				        )
				),
	            array
	            (	'field_id' => 'submit',
					'type' => 'submit'
	            )
	        );

    }
    
    
    public function content_top_pcode_settings_tab_css($sContent)
    {       
        return $sContent 
            . '<h3>CSS Settings</h3>'
            . '<p>Settings related to CSS editing are defined here.</p>';
    	
    }
    
    
    public function load_pcode_settings_tab_css($oAdminPage)
    {	
    	$this->addSettingFields
	    	(	array
	    		(	'field_id' => 'editor_theme_css',
				    'title' => __('Code Editor Theme', 'presscode'),
				    'type' => 'select',
				    'help' => __('The theme to use in the code editor for CSS.', 'presscode'),
				    'default' => 'not-set',
				    'label' =>
				    	array
				    	(	'not-set' => __('Not Set', 'presscode'),
				    		'default' => __('Default', 'presscode'),
				        	'ttcn' => __('TTCN', 'presscode'),
				        	'twilight' => __('Twilight', 'presscode')
				        )
				),
	            array
	            (	'field_id' => 'submit',
					'type' => 'submit'
	            )
	        );

    }
    
    
    public function content_top_pcode_settings_tab_js($sContent)
    {       
        return $sContent 
            . '<h3>JavaScript Settings</h3>'
            . '<p>Settings related to JavaScript editing are defined here.</p>';
    	
    }
    
    
    public function load_pcode_settings_tab_js($oAdminPage)
    {	
    	$this->addSettingFields
	    	(	array
	    		(	'field_id' => 'editor_theme_js',
				    'title' => __('Code Editor Theme', 'presscode'),
				    'type' => 'select',
				    'help' => __('The theme to use in the code editor for JavaScript.', 'presscode'),
				    'default' => 'not-set',
				    'label' =>
				    	array
				    	(	'not-set' => __('Not Set', 'presscode'),
				    		'default' => __('Default', 'presscode'),
				        	'ttcn' => __('TTCN', 'presscode'),
				        	'twilight' => __('Twilight', 'presscode')
				        )
				),
	            array
	            (	'field_id' => 'submit',
					'type' => 'submit'
	            )
	        );

    }
    
    
    public function content_top_pcode_settings_tab_php($sContent)
    {       
        return $sContent 
            . '<h3>PHP Settings</h3>'
            . '<p>Settings related to PHP editing are defined here.</p>';
    	
    }
    
    
    public function load_pcode_settings_tab_php($oAdminPage)
    {	
    	$this->addSettingFields
	    	(	array
	    		(	'field_id' => 'editor_theme_php',
				    'title' => __('Code Editor Theme', 'presscode'),
				    'type' => 'select',
				    'help' => __('The theme to use in the code editor for PHP.', 'presscode'),
				    'default' => 'not-set',
				    'label' =>
				    	array
				    	(	'not-set' => __('Not Set', 'presscode'),
				    		'default' => __('Default', 'presscode'),
				        	'ttcn' => __('TTCN', 'presscode'),
				        	'twilight' => __('Twilight', 'presscode')
				        )
				),
	            array
	            (	'field_id' => 'submit',
					'type' => 'submit'
	            )
	        );

    }
    
}
 
// Instantiate the class object.
new Pcode_Apf_Page_Settings();
    
// That's it!! See, it's very short and easy, huh?