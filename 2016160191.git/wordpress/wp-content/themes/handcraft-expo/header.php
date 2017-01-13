<!DOCTYPE html>
	
<html <?php language_attributes(); ?> >
		
	<head>					
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta charset="<?php bloginfo('charset'); ?>" />
		<link href="css/style.css" rel="stylesheet" type="text/css">
	
<?php wp_head(); ?>
	</head>
			
	<body <?php body_class(); ?> >

		<div class="container-fluid">
<?php 
		$handcraft_expo_titlePositionCheck = get_theme_mod('handcraft-expo_title_position', 'left');
		$handcraft_expo_titleAnimatCheck = get_theme_mod('handcraft-expo_title_hover_effect', 'color_scale');
		if (get_theme_mod('handcraft-expo_main_banner_background')) { ?>
			<div class="row">
				<div class="col-xs-12">
					<div id="handcraft-expo-main-banner" class="handcraftExpo-main-banner">
<?php
		if (get_theme_mod('handcraft-expo_main_banner_background') && $handcraft_expo_titlePositionCheck == 'banner') { 
			if ($handcraft_expo_titleAnimatCheck != 'none') { ?>
							<a href="<?php echo home_url(); ?>" style="text-decoration: none;"><h1 class="title-show title-banner"><?php bloginfo('title'); ?></h1>
							<h3 class="tagline-show tagline-banner"><?php bloginfo('description'); ?></h3></a>
<?php } 
			elseif ($handcraft_expo_titleAnimatCheck == 'none' ) { ?>
							<h1 class="title-show title-banner"><?php bloginfo('title'); ?></h1>
							<h3 class="tagline-show tagline-banner"><?php bloginfo('description'); ?></h3>
<?php }}; ?>
							</div>
						</div>
					</div>
<?php }; ?>
					<div class="row handcraftExpo-main-background">
						<div id="handcraft-expo-main-sidebar-container" class="col-xs-3">
<?php
	$handcraft_expo_socialIconsPosCheck = get_theme_mod('handcraft-expo_social_icons_position', 'below_logo');
	if ($handcraft_expo_socialIconsPosCheck == 'top') { 
		get_template_part('socials');
	}; 
	if ($handcraft_expo_titlePositionCheck == 'left') { 
		if ($handcraft_expo_titleAnimatCheck != 'none' ) { ?>
			<a href="<?php echo home_url(); ?>" style="text-decoration: none;"><h1 class="title-show title-left"><?php bloginfo('title'); ?></h1></a>
<?php } 
		elseif ($handcraft_expo_titleAnimatCheck == 'none') { ?>
			<h1 class="title-show title-left"><?php bloginfo('title'); ?></h1>
<?php }}; 

	if ($handcraft_expo_socialIconsPosCheck == 'below_title') { 
		get_template_part('socials');
	};
	if ($handcraft_expo_titlePositionCheck == 'left') { 
		if ($handcraft_expo_titleAnimatCheck != 'none') { ?>
			<a href="<?php echo home_url(); ?>" style="text-decoration: none;"><h3 class="tagline-show title-left"><?php bloginfo('description'); ?></h3></a>
<?php } 
		elseif ($handcraft_expo_titleAnimatCheck == 'none') { ?>
			<h3 class="tagline-show title-left"><?php bloginfo('description'); ?></h3>
<?php }}; 
	if ($handcraft_expo_socialIconsPosCheck == 'below_tag') { 
		get_template_part('socials');
	}; ?>
			<div class="site-custom-logo">
<?php	handcraft_expo_custom_logo(); ?>
			</div>
<?php 
	if ($handcraft_expo_socialIconsPosCheck == 'below_logo') { 
		get_template_part('socials');
	};
?>
		<div id="handcraft-expo-main-menu-container" class="side-navbar"> <!-- Navigation Bar Start -->
			<nav class="navbar-container">
<?php 
	$handcraft_expo_args = array(
		'theme_location' 	=> 'handcraft-expo_main_menu',
		'conatiner'	=> ''							
	); ?>
<?php wp_nav_menu($handcraft_expo_args); ?>
			</nav>
		</div> <!-- Navigation Bar End -->
							
<?php 
	if ($handcraft_expo_socialIconsPosCheck == 'below_menu') { 
		get_template_part('socials');
	}; ?>				
			<div id="copyright">
				<code>
<?php 
	bloginfo('name'); ?> 
<?php 
	$handcraft_expo_site_creation_date = mysql2date('Y', get_user_option('user_registered', 1));
	echo '&copy;' . intval($handcraft_expo_site_creation_date);
	if ($handcraft_expo_site_creation_date != date('Y')) {
		echo '&#45;' . intval(date('Y'));
	} ?>
					<br />
					<span id="handcraft-expo-custom-copyright">
<?php 
	echo wp_kses_post(get_theme_mod('handcraft-expo_custom_copyright', 'Empowered by <a href="https://wordpress.org/">WordPress</a>')); ?></code>
					</span>
			</div>
		</div>
			<div id ="handcraft-expo-main-content-container" class="col-xs-9">
<?php
	$handcraft_expo_menu_sidebar_switch = get_theme_mod('handcraft-expo_menu_sidebar_switch', 0);
	if ($handcraft_expo_menu_sidebar_switch == 1) {?>
		<div id="handcraft-expo-menu-sidebar-toggle-container">
			<span id="handcraft-expo-menu-sidebar-toggle" class="menu-sidebar-ui-label">></span>
		</div>
<?php	}
	if ($handcraft_expo_titlePositionCheck == 'center') {
		if ($handcraft_expo_titleAnimatCheck != 'none') { ?>
			<a class="site-title-container" href="<?php echo home_url(); ?>" style="text-decoration: none;"><h1 class="title-show title-center"><?php bloginfo('title'); ?></h1>
			<h3 class="tagline-show title-center"><?php bloginfo('description'); ?></h3></a>
<?php } 
		elseif ($handcraft_expo_titleAnimatCheck == 'none') { ?>
			<h1 class="title-show title-center"><?php bloginfo('title'); ?></h1>
			<h3 class="tagline-show title-center"><?php bloginfo('description'); ?></h3>
<?php }
	}; ?>

<?php
	get_template_part('mobile-menu');
	if (is_active_sidebar('widgets_bar_top')) { ?>
		<div class="widgets-bar-div">
			<div class="widgets-bar-content widgets-bar-content-top"><?php dynamic_sidebar('widgets_bar_top'); ?></div>
		</div>
<?php }; 		
	$handcraft_expo_previewerCheckVar = get_theme_mod('handcraft-expo_previewer_show', 1);
		
	if ($handcraft_expo_previewerCheckVar == 1) {
		get_template_part('previewer-html');
	}
