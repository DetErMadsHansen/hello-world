<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (__('Please do not load this page directly. Thanks!', 'lmp-textdomain'));

	if ( post_password_required() ) {
		_e('This post is password protected. Enter the password to view comments.', 'lmp-textdomain');
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h2 id="comments"><?php comments_number(__('No Responses', 'lmp-textdomain'), __('One Response', 'lmp-textdomain'), __('% Responses', 'lmp-textdomain') );?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

<?php 
	
	if ( comments_open() ) :
		// If comments are open, but there are no comments.
 
	else : // comments are closed
		
		echo '<p>' . __('Comments are closed.', 'lmp-textdomain') . '</p>';

	endif; // END, Comments open
	
endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h2><?php comment_form_title( __('Leave a Reply', 'lmp-textdomain'), __('Leave a Reply to %s', 'lmp-textdomain') ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php 
	if ( get_option('comment_registration') && !is_user_logged_in() ) :

		echo '<p>' . sprintf( __('You must be %s logged in%s to post a comment.', 'lmp-textdomain') , '<a href="' . wp_login_url( get_permalink() ) . '">', '</a>' ) . '</p>';
 
	else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php 
		if ( is_user_logged_in() ) :

			$linkProfile	= '<a href="' . get_option('siteurl') . '/wp-admin/profile.php">' . $user_identity . '</a>';
			$linkLogout		= '<a href="' . wp_logout_url(get_permalink()) . '" title="' __('Log out of this account', 'lmp-textdomain' ) . '">' . __( 'Log out &raquo;', 'lmp-textdomain' ) . '</a>';
			echo '<p>' . sprintf( __('Logged in as %s. %s', 'lmp-textdomain' ), $linkProfile, $linkLogout ) . '</p>';

		else :
		?>

			<div>
				<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="author"><?php if ($req) echo "*"; _e('Name', 'lmp-textdomain'); ?></label>
			</div>

			<div>
				<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				<label for="email"><?php if ($req) echo "(required)"; _e('Mail (will not be published)', 'lmp-textdomain'); ?></label>
			</div>

			<div>
				<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
				<label for="url"><?php _e('Website', 'lmp-textdomain'); ?></label>
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div>
			<textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
		</div>

		<div>
			<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
			<?php comment_id_fields(); ?>
		</div>
		
		<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	
</div>

<?php endif; ?>
