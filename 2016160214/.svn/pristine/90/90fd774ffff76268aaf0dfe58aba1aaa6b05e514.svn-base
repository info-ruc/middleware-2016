<?php get_header(); ?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '' ) ); ?>/">

    <div>

        <?php if( get_search_query() ): ?>
        
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
        
        <?php else: ?>
        
            <input class="textbox" value="<?php _e('Search' , 'novavideo-lite'); ?>..." name="s" id="s" onfocus="if (this.value == '<?php _e('Search' , 'novavideo-lite'); ?>...') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search' , 'novavideo-lite'); ?>...';}" type="text" />
        
        <?php endif;?>
        
            <input type="submit" id="searchsubmit" value="" />
        
	</div>
    
</form>