<?php
/**
 * We need to do a little handywork to make sure that Wordpress
 * thinks we're a standard built-in modal. 
 */

# Include this so Wordpress doesn't throw NOTICEs when setting $pagenow
$_SERVER['PHP_SELF'] = '/wp-admin';

# Turn on DEBUG if needed
if(defined('BROADSTREET_DEBUG') && BROADSTREET_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);    
}

if(!isset( $_GET['inline']))
    define('IFRAME_REQUEST', true);

# Include libraries
require_once '../../lib/Utility.php';
require_once '../../lib/Broadstreet.php';

if(!defined('WP_ADMIN'))
{
    # Find the wp-admin directory
    if(!preg_match('#(.*)/wp-content/plugins/#', $_SERVER['SCRIPT_FILENAME'], $matches))
        exit("We're awfully sorry. You have a strange server configuration we can't figure out. Email us, and we'll help figure it out. errors@broadstreetads.com");

    $root = $matches[1];

    chdir("$root/wp-admin");

    /** Load WordPress Administration Bootstrap **/
    require_once('./admin.php');
}

$page = @$_GET['step'];
if(!$page) $page = 'signup';

if($page == 'signup') 
{
    if(Broadstreet_Adwidget_Mini_Utility::hasAdserving() || @$_GET['status'] == 'agree') {  
        
        if(!Broadstreet_Adwidget_Mini_Utility::hasAdserving())
        {
            # New user
            if(!isset($_POST['resub']))
            {
                $email = $_POST['email'];
                $success = Broadstreet_Adwidget_Mini_Utility::hasAdserving(true, $email);
            }
            else
            {
                # Someone who cancelled and resubscribed
                $success = Broadstreet_Adwidget_Mini_Utility::hasAdserving(true);
            }
            
            if(!$success) exit("We're sorry! We couldn't upgrade you to premium adserving! Is your email address already linked to a Broadstreet account? This may be the problem.");
        }
        
        require "signedup.php";
        exit;
    }
}

Broadstreet_Adwidget_Mini_Utility::sendReport('Premium Exloration');
require "$page.php";

