<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'app_2016160214jmx');

/** MySQL数据库用户名 */
define('DB_USER', 'lk343lk44l');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'liz32ykykykymk41yxk4ww0z42jhihh54l25x3m4');

/** MySQL主机 */
define('DB_HOST', 'w.rdc.sae.sina.com.cn');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'w6:U%Jkfs;e&KEdW&r/=_0AFX]RU39rDbAXdm=ItIH.~f.)K3s.H /xR=hvf_.%c');
define('SECURE_AUTH_KEY',  'Mfvbvez(HMFw*k%a#~FB<m(baY{%%3SU^Vo}W{,@{XA@]r|)().w.D;ScCD>-|F-');
define('LOGGED_IN_KEY',    'o/yg4xG,wEh?VTK+6M4{>8G9>m=FZB&~5%,n%VE>5*rqQog~->;v5umNf88g 6_f');
define('NONCE_KEY',        '(aPHCd{3N]=-xuP0of8)Q8Ko33Fovw9l[]0lagM?-o?RB(vSZZ;;4Z^9<xj%e&8$');
define('AUTH_SALT',        '$MS-KSV,ePY6n5ld)l</(A*XBkS8n>]7nrvrUt*0TQm8[rhjY?qzkVKKP-pX&qxw');
define('SECURE_AUTH_SALT', '`JrKWpi0jHVb)O2h.59FVxD]DG@j6&~2wXRoL0mdgzRb+0%6x* v??w1u9o+I_3`');
define('LOGGED_IN_SALT',   '^`nNcRycrU7y#GxLQJ.]njh|6YQ6Gj)&T d`|/I-g$~+U#cm8[=g ivcMdZ}}MO5');
define('NONCE_SALT',       'p$]S*3(d .ZNj:w-VgBd:yOQ!De @%U,7%Ty)`}~QQmmx8:M_z4t:dv=kMI$:fDk');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
