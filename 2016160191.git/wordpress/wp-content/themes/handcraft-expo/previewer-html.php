<?php 
	$handcraft_expo_previewer_defalult_text = __('describe your menu link here', 'handcraft-expo');
?>
<div class="description-container"> <!-- Previewer Start -->
	<div id="previewer-content-1">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '1') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_1_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_1_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_1', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-2">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '2') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_2_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_2_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_2', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-3">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '3') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_3_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_3_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_3', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-4">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '4') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_4_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_4_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_4', $handcraft_expo_previewer_defalult_text)); ?>
		</p>									
	</div>
<?php	} ?>
	<div id="previewer-content-5">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '5') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_5_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_5_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_5', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-6">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '6') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_6_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_6_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_6', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-7">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '7') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_7_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_7_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_7', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
	<div id="previewer-content-8">
<?php 
	if (get_theme_mod('handcraft-expo_previewer_blog_position') == '8') {
		handcraft_expo_GetPreviewerPost();
	}
	else { 
		if (get_theme_mod('handcraft-expo_previewer_text_8_img')) {?>
		<img src="<?php
							echo esc_url(get_theme_mod('handcraft-expo_previewer_text_8_img', '')); ?>" alt="" >
<?php	}?>
		<p>
			<?php echo esc_html(get_theme_mod('handcraft-expo_previewer_text_8', $handcraft_expo_previewer_defalult_text)); ?>
		</p>
	</div>
<?php	} ?>
</div> <!-- Previewer End -->