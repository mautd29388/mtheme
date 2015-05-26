<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="entry-title comments-title">
		<?php
			printf( _nx( 'One <small>comment</small>', '%1$s <small>comments</small>', get_comments_number(), 'mTheme' ),
				number_format_i18n( get_comments_number() ) );
		?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mTheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mTheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mTheme' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>
	
		<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'avatar_size'=> 60,
				'callback' => 'mTheme_comment',
			) );
		?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'mTheme' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mTheme' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mTheme' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'mTheme' ); ?></p>
	<?php endif; ?>

	<?php comment_form( array(
			'title_reply'          => __( 'Write a comment', 'mTheme' ),
			'title_reply_to'       => __( 'Write a comment to %s', 'mTheme' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'label_submit'         => __( 'Comment', 'mTheme' ),
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'mTheme' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="5" aria-describedby="form-allowed-tags" aria-required="true"></textarea></p>',
		)); ?>

</div><!-- .comments-area -->

