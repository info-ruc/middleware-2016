<?php       $word_t17=get_option('mytheme_word_t17');
			$word_t18=get_option('mytheme_word_t18');
			$word_t19=get_option('mytheme_word_t19');
			$word_t20=get_option('mytheme_word_t20');
			$word_t21=get_option('mytheme_word_t21');
			$word_t22=get_option('mytheme_word_t22'); ?>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

	

			<div class="liuy3">
                <div class="liuy2"><?php if($word_t17!=""){echo $word_t17;}else{echo '姓  名：';}  ?></div>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="28" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="author"><?php if($word_t18!=""){echo $word_t18;}else{echo '输入名称 ';}  ?> <?php if ($req) echo "(*)"; ?></label>
			</div>

			<div class="liuy3">
                <div class="liuy2"><?php if($word_t19!=""){echo $word_t19;}else{echo '邮箱 ';}  ?></div>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="28" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="email"><?php if($word_t20!=""){echo $word_t20;}else{echo '输入邮箱 ';}  ?> <?php if ($req) echo "(*)"; ?></label>
			</div>

	

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div class="liuy3">
                <div class="liuy2"><?php if($word_t21!=""){echo $word_t21;}else{echo '留　言:';}  ?></div>
			<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
		</div>

		<div class="liuy3">
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php if($word_t22!=""){echo $word_t22;}else{echo '提  交';}  ?>" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	
	


