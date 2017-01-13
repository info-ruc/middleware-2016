<?php

require 'Broadstreet.php';

if(!class_exists('Broadstreet_Mini_Utility')):

function bsadwidget_get_option($name, $default = FALSE)
{
    $value = get_option($name);
    if( $value !== FALSE ) return $value;
    return $default;
}

function bsadwidget_set_option($name, $value)
{
    if (get_option($name) !== FALSE)
    {
        update_option($name, $value);
    }
    else
    {
        $deprecated = ' ';
        $autoload   = 'no';
        add_option($name, $value, $deprecated, $autoload);
    }
}

function bsadwidget_get_base_url($append = false)
{
    $dir = basename(dirname(__FILE__));
    return (AdWidget_Core::getBaseURL() . ($append ? $append : ''));
}

function bsadwidget_get_email()
{
    return get_bloginfo('admin_email');
}

function bsadwidget_get_website()
{
    return get_bloginfo('url');
}

function bsadwidget_get_website_name()
{
    return get_bloginfo('url');
}

function bsadwidget_get_platform_version()
{
    return get_bloginfo('version');
}


function bsadwidget_mail($to, $subject, $body)
{
    @wp_mail($to, $subject, $body);
}


class Broadstreet_Adwidget_Mini_Utility
{
    CONST KEY_ADSERVER_ENABLED = 'Broadstreet_Adserver_Enabled';
    CONST KEY_API_KEY       = 'Broadstreet_API_Key';
    CONST KEY_NETWORK_ID    = 'Broadstreet_Network_Key';
    CONST KEY_ADVERTISER_ID = 'Broadstreet_Advertiser_Key';
    CONST KEY_AD_LIST       = 'Broadstreet_Ad_List';
    
    /**
     * Get the base URL of the Broadstreet Mini vendor plugin
     * @param string $append A path to append to the base url
     * @return string The final path
     */
    public static function getBaseURL($append = false)
    {
        return bsadwidget_get_base_url($append);
    }
    
    /**
     * Sets a Wordpress option
     * @param string $name The name of the option to set
     * @param string $value The value of the option to set
     */
    public static function setOption($name, $value)
    {  
        return bsadwidget_set_option($name, $value);
    }    

    /**
     * Gets a Wordpress option
     * @param string    $name The name of the option
     * @param mixed     $default The default value to return if one doesn't exist
     * @return string   The value if the option does exist
     */
    public static function getOption($name, $default = FALSE)
    {
        return bsadwidget_get_option($name, $default);
    }
    
    /**
     * Send an email about an error, issue, etc
     */
    public static function sendReport($message = 'General')
    {
        $report = "";
        $report .= bsadwidget_get_website_name(). "\n";
        $report .= bsadwidget_get_website(). "\n";
        $report .= bsadwidget_get_email(). "\n";
        $report .= 'Platform Version: ' . bsadwidget_get_platform_version() . "\n";
        $report .= "$message\n";

        @bsadwidget_mail('errors@broadstreetads.com', "Status Report: WP AdWidget", $report);
    }
    
    /**
     * Get a link to the Broadstreet interface
     * @param string $path
     * @return string
     */
    public static function broadstreetLink($path)
    {
        $path = ltrim($path, '/');
        $key = self::getOption(Broadstreet_Mini::KEY_API_KEY);
        $url = "https://my.broadstreetads.com/$path?access_token=$key";
        return $url;
    }
    
    /**
     * Get a key from an array without causing hell
     * @param array  $array
     * @param string $key
     * @param bool   $default 
     */
    public static function arrayGet($array, $key, $default = null)
    {
        if(isset($array[$key]))
            return $array[$key];
        
        return $default;
    }
    
    /**
     * Get a nice string for an error message
     * @param Broadstreet_ServerException $ex
     */
    public static function getPrettyError(Broadstreet_ServerException $ex)
    {
        $error = '';
        
        if($ex instanceof Broadstreet_ServerException)
        {   
            $error = 'Please check these item(s) are correct: <br />';
            $api_response = (array)$ex->error;
        
            foreach($api_response['errors'] as $field => $errors)
            {
                $error .= ucwords(str_replace('_', ' ', $field)) . '<br />';
            }
        }
        
        return $error;
    }
    
    /*
     * Determine whether the current site has been hooked up
     * with Broadstreet
     */
    public static function hasNetwork()
    {
        return (bool)self::getOption(self::KEY_NETWORK_ID, false);
    }
    
    /*
     * Determine whether the current site has been hooked up
     * with Broadstreet
     */
    public static function hasAdserving($enabled = null, $email = false)
    {
        $success = false;
        if($enabled !== null) {
            self::setOption (Broadstreet_Adwidget_Mini_Utility::KEY_ADSERVER_ENABLED, (bool)$enabled);
            $message = $enabled ? 'Subscribed' : 'Unsubscribed';
            if($enabled) $success = self::importOldAds($email);
            if($success) self::sendReport("Premium Adserver $message");
            return $success;
        } else {
            return (bool)self::getOption(self::KEY_ADSERVER_ENABLED, false);
        }
    }
    
    /*
     * Determine whether the current site has been hooked up
     * with Broadstreet
     */
    public static function getNetworkID()
    {
        return self::getOption(self::KEY_NETWORK_ID, false);
    }
    
    /**
     * Escape a javascript tag
     * @param string $tag 
     */
    public static function escapeJSTag($tag)
    {
        $tag = str_ireplace('<script>', '\x3Cscript>', $tag);
        $tag = str_ireplace('</script>', '\x3C/script>', $tag);
        
        return $tag;
    }
    
    /**
     * Get a Broadstreet API client
     * @return Broadstreet 
     */
    public static function getClient()
    {
        $key = self::getOption(self::KEY_API_KEY);
        
        if($key)
            return new Broadstreet($key);
        else
            return new Broadstreet();
    }
    
    /**
     * Does this account have any free ads left? 
     */
    public static function hasFreeAds()
    {
        $net_id = self::getOption(Broadstreet_Mini::KEY_NETWORK_ID);
   
        # If we haven't seen them before they probably do
        if(!$net_id) return true;
        
        $net = self::getClient()->getNetwork($net_id);
        
        # Check if you've used up all the hacks
        # Note to l33t haxors. We check on the server side too.
        return ($net->comp_count < $net->comp_count_max);
    }
    
    /**
     * Run a function which may or may not be defined
     * @param string $name
     * @param array $args 
     */
    public static function runHook($name, $args = array())
    {
        if(function_exists($name))
        {
            return call_user_func($name, $args);
        }
        
        return null;
    }
    
    /**
     * Print a link to open an editable link
     * @param type $label_or_markup 
     */
    public static function editableLink($label_or_markup = false, $key = 'solo')
    {
        if(!$label_or_markup)
            $label_or_markup = '<img alt="Create Editable" src="'.Broadstreet_Adwidget_Mini_Utility::getBaseURL('/assets/img/editable-button.png').'" />';
        echo '<a href="#" onclick="editable_'.$key.'(); return false;">'.$label_or_markup.'</a>';
    }
    
    /**
     * Output JS for placing the ad HTML into the 
     *  new ad form
     */
    public static function editableJS($selector = false, $key = 'solo')
    {
        bs_editable_js($selector, $key);
    }
    
    /**
     * Is this phone number valid?
     * @param string $num
     * @return boolean 
     */
    public static function isPhoneValid($num)
    {
        if(preg_match('/^[+]?([0-9]?[0-9]?[0-9]?)[(|s|-|.]?([0-9]{3})[)|s|-|.]*([0-9]{3})[s|-|.]*([0-9]{4})$/', $num))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * Import or update an image ad
     * @param type $network_id Network Id
     * @param type $advertiser_id Advertiser Id
     * @param type $image_url Image URL
     * @param type $link Destination URL
     */
    public static function importImageAd($network_id, $advertiser_id, $image_url, $link, $advertisement_id = false) {
        $api = self::getClient();
        
        $img = wp_remote_get($image_url);
        $img = $img['body'];
        
        $params = array();
        $params['name'] = 'WordPress Widget Ad ' . date('Y-m-d H:i:s');
        $params['active_base64'] = base64_encode($img);
        $params['destination'] = $link;

        try {
            if($advertisement_id === false)
                return $api->createAdvertisement($network_id, $advertiser_id, $params['name'], 'static', $params);
            else
                return $api->updateAdvertisement($network_id, $advertiser_id, $advertisement_id, $params);
            
        } catch(Exception $ex) {
            self::sendReport($ex->__toString());
            exit($ex->__toString());
            return false;
        }
    }
    
    /**
     * Import or update an HTML Ad into Broadstreet
     * @param type $network_id
     * @param type $advertiser_id
     * @param type $html 
     */
    public static function importHTMLAd($network_id, $advertiser_id, $html, $advertisement_id = false) {
        $api = self::getClient();
        
        $params = array();
        $params['name'] = 'WordPress Widget Ad ' . date('Y-m-d H:i:s');
        $params['html'] = $html;

        try {
            if($advertisement_id === false)
                return $api->createAdvertisement($network_id, $advertiser_id, $params['name'], 'html', $params);
            else
                return $api->updateAdvertisement($network_id, $advertiser_id, $advertisement_id, $params);
            
        } catch(Exception $ex) {
            self::sendReport($ex->__toString());
            exit($ex->__toString());
            return false;
        }
    }
    
    /**
     * Import old adwidget ads to Broadstreet ads
     * @param string $email 
     */
    public static function importOldAds($email = false) {
        $api = new Broadstreet();
        
        try
        {
            if(!Broadstreet_Adwidget_Mini_Utility::hasNetwork()) 
            {
                # Register the user by email address
                $user = $api->register($email);
                Broadstreet_Adwidget_Mini_Utility::setOption(Broadstreet_Adwidget_Mini_Utility::KEY_API_KEY, $user->access_token);

                # Create a network for the new user
                # Don't change this unless you want a higher tier. There's no lower tier, you haxor you
                $net = $api->createNetwork('Wordpress - ' . get_bloginfo('name'), array('tier_id' => 4));
                Broadstreet_Adwidget_Mini_Utility::setOption(Broadstreet_Adwidget_Mini_Utility::KEY_NETWORK_ID, $net->id);
            }
            else
            {
                $api = self::getClient();
                $net = (object)array('id' => Broadstreet_Adwidget_Mini_Utility::getNetworkID());
            }
            
            /* Import Image widgets */
            $ads = Broadstreet_Adwidget_Mini_Utility::getOption('widget_adwidget_imagewidget');
            
            foreach($ads as $id => $data) 
            {
                /* Ad already imported? Skip it */
                if(!is_numeric($id) || is_numeric(@$data['bs_ad_id'])) continue;
                
                $adv = $api->createAdvertiser($net->id, self::arrayGet($data, 'w_adv', 'New Advertiser - Image'));
                Broadstreet_Adwidget_Mini_Utility::setOption(Broadstreet_Adwidget_Mini_Utility::KEY_ADVERTISER_ID, $adv->id);
             
                $ad = self::importImageAd($net->id, $adv->id, $data['w_img'], $data['w_link']);
                
                if(!$ad) continue;
                
                $ads[$id]['bs_ad_html'] = $ad->html;
                $ads[$id]['bs_ad_id']   = $ad->id;
                $ads[$id]['bs_adv_id']  = $adv->id;
            }
            
            Broadstreet_Adwidget_Mini_Utility::setOption('widget_adwidget_imagewidget', $ads);
            
            
            /* Import HTML widgets */
            $ads = Broadstreet_Adwidget_Mini_Utility::getOption('widget_adwidget_htmlwidget');
            
            foreach($ads as $id => $data) 
            {
                /* Ad already imported? Skip it */
                if(!is_numeric($id) || is_numeric(@$data['bs_ad_id'])) continue;
                
                $adv = $api->createAdvertiser($net->id, self::arrayGet($data, 'w_adv', 'New Advertiser - HTML'));
                Broadstreet_Adwidget_Mini_Utility::setOption(Broadstreet_Adwidget_Mini_Utility::KEY_ADVERTISER_ID, $adv->id);
             
                $ad = self::importHTMLAd($net->id, $adv->id, $data['w_adcode']);
                
                if(!$ad) continue;
                
                $ads[$id]['bs_ad_html'] = $ad->html;
                $ads[$id]['bs_ad_id']   = $ad->id;
                $ads[$id]['bs_adv_id']  = $adv->id;
            }
            
            Broadstreet_Adwidget_Mini_Utility::setOption('widget_adwidget_htmlwidget', $ads);
        }
        catch(Exception $ex)
        {
            self::sendReport($ex->__toString());
            return false;
        }
        
        return true;
    }
}

endif;
