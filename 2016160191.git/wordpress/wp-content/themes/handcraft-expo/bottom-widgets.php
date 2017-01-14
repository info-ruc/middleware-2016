<?php
	if (is_active_sidebar('widgets_bar_bottom')) { ?>
	<div class="widgets-bar-bottom-div">
		<div class="widgets-bar-content widgets-bar-content-bottom"><?php dynamic_sidebar('widgets_bar_bottom'); ?></div>
	</div>
<?php }