<?php get_header(); ?>

    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
    
    <h1><?php the_title(); ?></h1>
    <div id="page" class="post-content">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </div>
    
    <?php endwhile; ?> 
    <?php edit_post_link('Edit this page', '<p>', '</p>'); ?>   
    <?php endif; ?>
    
    <!-- Comments -->              
    <div id="comments">
        <div class="comments-template">
            <?php comments_template( '', true ); ?>
        </div>
    </div>
    
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>