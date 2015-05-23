<?php
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php comments_number( __('No comments', 'dutchdotawp'), __('One comment', 'dutchdotawp'), __('% comments', 'dutchdotawp'));?>
		</h3>

		<ul class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       	=> 'ul',
				'avatar_size' 	=> 80,
				'max_depth'   	=> 3,
				'type'			=> 'comment',
				'callback'		=> 'dutchdotawp_comment'
			) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="no-comments"><?php _e( 'Comments are closed.' , 'dutchdotawp' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php

	$args = array(
		'comment_field' =>  '<p class="comment-form-comment"><label class="hidden-sm" for="comment">' . _x( 'Comment', 'noun' ) .
			'</label><textarea id="comment" name="comment" cols="40" rows="8" aria-required="true">' .
			'</textarea></p>',
	);


	comment_form($args);

	?>

</div><!-- #comments -->