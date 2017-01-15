<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=11,IE=10,IE=9,IE=8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<title>
<?php 
	$t = trim(wp_title('', false)); 
	if($t) echo $t._hui('connector'); 
	else ''; bloginfo('name'); 
	if ($paged > 1) echo _hui('connector').__('第', 'haoui'), $paged, __('页', 'haoui'); 
	if (is_home ()) echo _hui('connector').get_option('blogdescription'); 
?>
</title>
<?php wp_head(); ?>
<link rel="shortcut icon" href="<?php echo HOME_URI.'/favicon.ico' ?>">
<!--[if lt IE 9]><script src="<?php echo THEME_URI ?>/js/html5.js"></script><![endif]-->
</head>
<style>
/*header*/
.mainbar {
	width:100%;
	height:32px;
}
#topbar {
	height: 30px;
	line-height: 30px;
	float: left;
	overflow: hidden;
}
#topbar ul {
	list-style: none;
}
#topbar ul li {
	display: inline;
	height: 33px;
	line-height: 33px;
	float: left;
	padding: 0 20px 0 0;
	text-align: center;
	font-size:12px;
	display: inline;
}
#topbar ul li a {
	color:#fff
}
#topbar ul li a:hover {
	color:#ececec
}
#topbar ul ul {
	display: none;
}
.toolbar {
	height:30px;
	line-height: 30px;
	float: left;
}
</style>
<div class="mainbar">
  <div class="mbtit"><a href="<?php bloginfo('url'); ?>">
    <?php bloginfo('name'); ?>
    </a></div>
  <div id="topbar">
    <ul>
      <li><a href="<?php bloginfo('url'); ?>">首页</a></li>
      <?php _the_menu('topmenu') ?>
    </ul>
  </div>
  
  <div class="slinks footnavs" style="list-style-type:none;">
    <?php { if(!is_user_logged_in()){?>
    <ul>
      <li data-sign="0" id="user-login" class="user-login"></i><span ><a href="<?php echo get_option('siteurl'); ?>/wp-login.php" target="_blank">登录</a></li>
      <li data-sign="1" id="user-reg" class="user-reg"><i class="fa fa-user-times"></i><span><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=register" target="_blank">注册</a></li>
    </ul>
    <?php } else { ?>
    <li class="exit"><a href="<?php echo wp_logout_url( home_url(add_query_arg(array(),$wp->request)) ); ?>" ><i class="fa fa-sign-out"></i><span>退出</span></a>
  </div>
  <?php } ?>
  <?php } ?>
</div>

    <style>
.footnavs ul li {
	
	height: 30px;
	line-height: 30px;
	display: inline;
	padding: 0 10px 0 0;
}
</style>
    </div>
<body <?php body_class(); ?>>
<section class="container">
