    <?php

/*
	 * If the current post is protected by a password and the visitor has not yet
	 * entered the password we will return early without loading the comments.
	 */
	if ( post_password_required() ) {
		return;
	}
     
    // Do not delete these lines
    if (!empty($_SERVER[ 'SCRIPT_FILENAME' ]) && 'comments.php' == basename($_SERVER[ 'SCRIPT_FILENAME' ]))
		die (__( 'Please do not load this page directly. Thanks!', 'fkidd'));
     
    if ( post_password_required() ) : ?>
		<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments.', 'fkidd'); ?></p>
		<?php
		return;
    endif;
    ?>
    <?php if ( have_comments() ) : ?>
    <h3 id="comments"><?php comments_number(__( 'No Comments', 'fkidd'),
											__( 'One Response', 'fkidd'),
											__( '% Responses', 'fkidd'));?> <?php _e( 'to', 'fkidd'); ?> &#8220;<?php the_title(); ?>&#8221;
	</h3>
    <ol class="commentlist">
		<?php wp_list_comments( 'avatar_size=48' ); ?>
    </ol>
    <div class="comment-navigation">
		<div class="alignleft"><?php previous_comments_link(); ?>
		</div>
		<div class="alignright"><?php next_comments_link(); ?>
		</div>
    </div>
    <?php else : // this is displayed if there are no comments so far ?> 
		<?php if ( ! comments_open() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'fkidd'); ?></p>
		<?php endif; ?>
    <?php endif; ?>
     
	<?php 
		  $comments_args = array (
							'comment_notes_before'	=>	'',
							'comment_notes_after'	=>	'',
						   );
	
		  comment_form( $comments_args ); ?>