<?php 
	$handcraft_expo_SocialIconsSetCheck = get_theme_mod('handcraft-expo_social_icons_set_check_setting', 'bright');
?>
	<div class="social-icons">
<?php
	if (get_theme_mod('handcraft-expo_facebook_setting', 1)) { ?>
		<a id="facebook" href="<?php echo esc_url(get_theme_mod('handcraft-expo_facebook_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/facebook.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/facebook_dark.png';
		} 
?>
		" alt="" /></a>
<?php }; 
	if (get_theme_mod('handcraft-expo_twitter_setting', 1)) { ?>
		<a id="twitter" href="<?php echo esc_url(get_theme_mod('handcraft-expo_twitter_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/twitter.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/twitter_dark.png';
		} 
?>
		" alt="" /></a>
<?php }; 
	if (get_theme_mod('handcraft-expo_google_setting', 1)) { ?>
		<a id="google" href="<?php echo esc_url(get_theme_mod('handcraft-expo_google_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/google.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/google_dark.png';
		} 
?>
		" alt="" /></a>
<?php };
	if (get_theme_mod('handcraft-expo_google_plus_setting', 1)) { ?>
		<a id="google-plus" href="<?php echo esc_url(get_theme_mod('handcraft-expo_google_plus_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/google_plus.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/google_plus_dark.png';
		} 
?>
		" alt="" /></a>
<?php }; 
	if (get_theme_mod('handcraft-expo_instagram_setting', 1)) { ?>
		<a id="instagram" href="<?php echo esc_url(get_theme_mod('handcraft-expo_instagram_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/instagram.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/instagram_dark.png';
		} 
?>
		" alt="" /></a>
<?php }; 
	if (get_theme_mod('handcraft-expo_youtube_setting', 1)) { ?>
		<a id="youtube" href="<?php echo esc_url(get_theme_mod('handcraft-expo_youtube_link_setting', 1)); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/youtube.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/youtube_dark.png';
		} 
?>
		" alt="" /></a>
<?php };
	$handcraft_expo_YourWebsiteDefault = get_stylesheet_directory_uri() . '/img/icons/social/your_site.png';
	if (get_theme_mod('handcraft-expo_social_custom_1_check', 0)) { ?>
		<a id="custom-site-1" href="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_1', 'https://www.yoursite1.com')); ?>"><img height="20px" src="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_1_img', $handcraft_expo_YourWebsiteDefault)); ?>" /></a>
<?php };
	if (get_theme_mod('handcraft-expo_social_custom_2_check', 0)) { ?>
		<a id="custom-site-2" href="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_2', 'https://www.yoursite2.com')); ?>"><img height="20px" src="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_2_img', $handcraft_expo_YourWebsiteDefault)); ?>" /></a>
<?php };
	if (get_theme_mod('handcraft-expo_social_custom_3_check', 0)) { ?>
		<a id="custom-site-3" href="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_3', 'https://www.yoursite3.com')); ?>"><img height="20px" src="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_3_img', $handcraft_expo_YourWebsiteDefault)); ?>" /></a>
<?php };
	if (get_theme_mod('handcraft-expo_social_custom_4_check', 0)) { ?>
		<a id="custom-site-4" href="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_4', 'https://www.yoursite4.com')); ?>"><img height="20px" src="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_4_img', $handcraft_expo_YourWebsiteDefault)); ?>" /></a>
<?php };
	if (get_theme_mod('handcraft-expo_social_custom_5_check', 0)) { ?>
		<a id="custom-site-5" href="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_5', 'https://www.yoursite5.com')); ?>"><img height="20px" src="<?php echo esc_url(get_theme_mod('handcraft-expo_social_custom_5_img', $handcraft_expo_YourWebsiteDefault)); ?>" /></a>
<?php }; 
	if (get_theme_mod('handcraft-expo_rss_check_1', 1)) { ?>
		<a id="rss2-feed" href="<?php bloginfo('rss2_url'); ?>"><img height="20px" src="<?php echo esc_url(get_template_directory_uri()); ?>
<?php 
	if ($handcraft_expo_SocialIconsSetCheck == 'bright') { 
		echo '/img/icons/social/rss.png';
		}
	if ($handcraft_expo_SocialIconsSetCheck == 'dark') {
		echo '/img/icons/social/rss_dark.png';
		} 
?>
		" alt="" /></a>
<?php }; ?>
	</div>
