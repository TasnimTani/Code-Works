<?php
/*
 * The template for displaying comments.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
  return;
}

$prev_comment_text     = cs_get_option('previous_comment_text') ? cs_get_option('previous_comment_text') : esc_html__( 'Older Comments', 'seese' );
$next_comment_text     = cs_get_option('next_comment_text') ? cs_get_option('next_comment_text') : esc_html__( 'Newer Comments', 'seese' );
$comment_singular_text = cs_get_option('comment_singular_text') ? cs_get_option('comment_singular_text') : esc_html__( 'Comment', 'seese' );
$comment_plural_text   = cs_get_option('comment_plural_text') ? cs_get_option('comment_plural_text') : esc_html__( 'Comments', 'seese' );
?>

<!-- Comments Start -->
<div class="seese-commentbox">
  <div class="seese-comments-area comments-area" id="comments">

  <?php
  if ( have_comments() ) :
  ?>
    <div class="comments-section">

      <h3 class="comments-title">
    	<?php
    		printf( // WPCS: XSS OK.
    			esc_html__( _nx( '%1$s '.$comment_singular_text, '%1$s '.$comment_plural_text, get_comments_number(), 'comments title', 'seese' ) ),
    			number_format_i18n( get_comments_number() ),
    			'<span>' . get_the_title() . '</span>'
    		);
    	?>
      </h3>

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
   	    <nav id="comment-nav-above" class="navigation seese-comment-navigation" role="navigation">
    		<h2 class="seese-screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seese' ); ?></h2>
    		<div class="seese-nav-links">
    			<div class="seese-nav-previous"><?php previous_comments_link( $prev_comment_text ); ?></div>
    			<div class="seese-nav-next"><?php next_comments_link( $next_comment_text ); ?></div>
    		</div>
    	</nav>
      <?php endif; // Check for comment navigation. ?>

      <ol class="comments">
        <?php wp_list_comments('	type=comments&callback=seese_comment_modification'); ?>
      </ol>

      <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
	    	<nav id="seese-comment-nav-below" class="navigation seese-comment-navigation" role="navigation">
	    		<h2 class="seese-screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seese' ); ?></h2>
	    		<div class="seese-nav-links">
	    			<div class="seese-nav-previous"><?php previous_comments_link( $prev_comment_text ); ?></div>
	    			<div class="seese-nav-next"><?php next_comments_link( $next_comment_text ); ?></div>
	    		</div>
	    	</nav>
      <?php endif; // Check for comment navigation. ?>

    </div>

    <?php
    endif; // Check for have_comments().

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<div class="comments-section">
			  <p class="seese-no-comments"><?php esc_html_e( 'Comments are closed.', 'seese' ); ?></p>
			</div>
		<?php
		endif; ?>

		<?php
		/* ==============================================
		  Comment Forms
		=============================================== */
		if ( comments_open() ) { ?>
			<div class="seese-comment-form">
		    <?php
				$form_title_text    = cs_get_option('comment_form_title_text') ? cs_get_option('comment_form_title_text') : esc_html__( 'Leave Comments', 'seese' );
				$form_reply_to_text = cs_get_option('comment_form_reply_to_text') ? cs_get_option('comment_form_reply_to_text') : esc_html__( 'Leave a Comment to', 'seese' );
				$comment_field_text = cs_get_option('comment_field_text') ? cs_get_option('comment_field_text') : esc_html__( 'Your comment here *', 'seese' );
				$name_field_text    = cs_get_option('name_field_text') ? cs_get_option('name_field_text') : esc_html__( 'Name *', 'seese' );
				$email_field_text   = cs_get_option('email_field_text') ? cs_get_option('email_field_text') : esc_html__( 'Email *', 'seese' );
				$post_comment_text  = cs_get_option('post_comment_text') ? cs_get_option('post_comment_text') : esc_html__( 'Add your Review', 'seese' );

				$fields = array(
				  'author' => '<div class="seese-form-inputs"><p><input type="text" id="author" name="author" value="'.esc_attr($commenter['comment_author']).'" tabindex="1" placeholder="'.$name_field_text.'"/></p>',
				  'email' => '<p><input type="text" id="email" name="email" value="'.esc_attr($commenter['comment_author_email']).'" tabindex="2" placeholder="'.$email_field_text.'"/></p></div>',
				);

			  $defaults = array(
					'comment_notes_before' => '',
					'comment_notes_after'  => '',
					'fields'               => apply_filters( 'comment_form_default_fields', $fields),
					'comment_field' 	     => '<div class="seese-form-textarea"><p><textarea id="comment" name="comment" tabindex="4" rows="3" cols="30" placeholder="'.$comment_field_text.'"></textarea></p></div>',
					'id_form'              => 'commentform',
					'class_form'           => 'comment-form seese-contact',
					'id_submit'            => 'submit',
					'title_reply'          => $form_title_text,
					'title_reply_to'       => $form_reply_to_text.' %s',
					'cancel_reply_link'    => '<i class="fa fa-times-circle"></i>'. '',
					'label_submit'         => $post_comment_text,
	      );
	      comment_form($defaults); ?>
		  </div>
		<?php
		} ?>

  </div>
</div>
<!-- Comments End -->