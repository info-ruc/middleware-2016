<?php
/*
Plugin Name: WP Solo Share
Plugin URI: http://www.slmwp.com/wp-solo-share.html
Description: Wordpress 文章点赞、打赏付款二维码、分享
Version: 1.1
Author: 水冷眸
Author URI: http://www.slmwp.com
*/

define('SLMWP_VERSION', '1.0');
define('SLMWP_URL', plugins_url('', __FILE__));
define('SLMWP_PATH', dirname( __FILE__ ));
define('SLMWP_ADMIN_URL', admin_url());

/**
 * 定义数据库
 */
global $wpdb, $slm_share_table_name;
$slm_share_table_name = isset($table_prefix) ? ($table_prefix . 'share') : ($wpdb->prefix . 'share');

/**
 * 加载类
 */
require SLMWP_PATH . '/class.wpshare.php';

/**
 * 加载函数
 */
require SLMWP_PATH . '/wpshare.functions.php';

/**
 * 插件激活,新建数据库
 */
register_activation_hook(__FILE__, 'wpshare_install');

/**
 * 插件停用, 删除数据库
 */
//register_deactivation_hook(__FILE__, 'wpshare_uninstall');
