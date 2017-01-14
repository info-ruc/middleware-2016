<?php
	if (! post_password_required()) {

		paginate_comments_links();
	
		$handcraft_expo_CommentsArgs = array(
			'walker'            => null,
			'max_depth'         => '',
			'style'             => 'ul',
			'callback'          => null,
			'end-callback'      => null,
			'type'              => 'all',
			'reply_text'        => __('Click to reply to comment', 'handcraft-expo'),
			'page'              => '',
			'per_page'          => '',
			'avatar_size'       => 32,
			'reverse_top_level' => null,
			'reverse_children'  => '',
			'format'            => 'html5',
			'short_ping'        => false,
		        'echo'              => true     // boolean, default is true
		);
		
		wp_list_comments($handcraft_expo_CommentsArgs);
			
		comment_form();

	}
?>