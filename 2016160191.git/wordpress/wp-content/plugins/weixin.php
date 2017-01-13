<?php
/*
Plugin Name: Weixin Switch Theme
Plugin URI: http://fatesinger.com/74958
Description: 切换微信主题
Version: 1.0.0
Author: Bigfa
Author URI: http://fatesinger.com/
*/
if( !function_exists('is_weixin') ) :
function is_weixin(){ 
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
            return true;
    }    
    return false;
}
endif;
function angela_switch_theme($theme){
    if( is_weixin() ){
        $theme = 'Bur';//主题文件夹名而不是主题名
    }
    return $theme;
}
add_filter( 'template', 'angela_switch_theme' );
add_filter( 'stylesheet', 'angela_switch_theme' );
?>