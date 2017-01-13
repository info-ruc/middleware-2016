<div class="handcraft-expo-scroll-up-container">
	<div id="handcraft-expo-scroll-up">
		<span id="handcraft-expo-scroll-up-icon"></span>
	</div>
</div>
<div class="mobile-widgets">
	<?php 
		dynamic_sidebar('widgets_mobile'); 
	?>
</div>
<div id="mobile-copyright">
	<code>
	<?php 
		bloginfo('name'); 
	?> 
	<?php 
		$handcraft_expo_site_creation_date = mysql2date('Y', get_user_option('user_registered', 1));
		echo '&copy;' . intval($handcraft_expo_site_creation_date);
		if ($handcraft_expo_site_creation_date != date('Y')) {
			echo '&#45;' . intval(date('Y'));
		} 
	?>
	<br />
	<span id="handcraft-expo-mobile-custom-copyright">
	<?php 
		echo wp_kses_post(get_theme_mod('handcraft-expo_custom_copyright', 'Empowered by <a href="https://wordpress.org/">WordPress</a>')); 
	?></code>
</div>


			</div>
		</div>
	</div>		
<?php wp_footer(); ?>
	</body>
</html>