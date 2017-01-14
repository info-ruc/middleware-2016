
<?php 
	if (is_active_sidebar('widgets_sidebar')) { ?>
		
		<div id="widgets-sidebar-container" class="sidebar-div clearfix">
			<?php dynamic_sidebar('widgets_sidebar'); ?>

		</div>
		
<?php } ?>