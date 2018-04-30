<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage EWF
 *
 */
	global $post;
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
?>

<?php
	
	if (comments_open()){
		echo '<div class="divider single-line"></div>';
	}
	
?>
	

	<div class="ewf-row">
		<div class="ewf-span12">
	

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', EWF_SETUP_THEME_DOMAIN ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
			 
				echo '</div> <!-- .ewf-span12  -->';
			echo '</div> <!-- .ewf-row  -->';
	
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>


<?php if ( have_comments() ) : ?>
		
	<h4 class="comments-title"><?php

		$comments_nr = get_comments_number();
		echo sprintf( _n( "%s Comment", "%s Comments", $comments_nr, EWF_SETUP_THEME_DOMAIN ), $comments_nr );
	
	?></h4>

	
	
	<ol class="commentlist">
		<?php
			wp_list_comments( array( 'callback' => 'ewf_comments' ) );
		?>
	</ol>

	
		
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php echo __('Comment navigation', EWF_SETUP_THEME_DOMAIN); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', EWF_SETUP_THEME_DOMAIN ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', EWF_SETUP_THEME_DOMAIN ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>


<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php echo __( 'Comments are closed.', EWF_SETUP_THEME_DOMAIN ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 	if ( comments_open() ) : ?>


<?php


	#	Translation Strings
	#
	#	echo '<h3 class="assistive-text section-heading">'.__('Leave a Comment', EWF_SETUP_THEME_DOMAIN).'</h3><br/><br/>';
		
		
	$args = array(

		'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __('Leave a Comment', EWF_SETUP_THEME_DOMAIN) .
		' <span class="required">*</span></label><textarea class="ewf-span7" id="comment" placeholder="'. __( 'Message', EWF_SETUP_THEME_DOMAIN).'" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>',
		
		
		'must_log_in' => '<p class="must-log-in">' .
			sprintf(
			  __( 'You must be <a href="%s">logged in</a> to post a comment.', EWF_SETUP_THEME_DOMAIN),
			  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . '</p>',
		
		'logged_in_as' => '<p class="logged-in-as">' .
			sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', EWF_SETUP_THEME_DOMAIN),
			  admin_url( 'profile.php' ),
			  $user_identity,
			  wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) . '</p>',

			
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', EWF_SETUP_THEME_DOMAIN) . '</p>',

		'comment_notes_after' => '<p class="form-allowed-tags">' .
			sprintf(
			  __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', EWF_SETUP_THEME_DOMAIN),
			  ' <code>' . allowed_tags() . '</code>'
			) . '</p>',
		
		
		 'fields' => apply_filters( 'comment_form_default_fields', array(
		 
				'author' =>
				  '<p class="comment-form-author">' .
					  '<input id="author" class="ewf-span4" placeholder="' . __('Your name', EWF_SETUP_THEME_DOMAIN) . '" name="author" type="text" value="" size="30" aria-required="true" />'.
					  '<label for="author"><i class="ifc-user_male3"></i> ' . __('Your name', EWF_SETUP_THEME_DOMAIN) . '<span class="required"></span></label> ' .
				  '</p>',

				  
				'email' =>
				  '<p class="comment-form-email">' .
					'<input class="ewf-span4" placeholder="' . __('Your Email Adress', EWF_SETUP_THEME_DOMAIN) . '" id="email" name="email" type="email" value="" size="30" aria-required="true">' . 
					'<label for="email"><i class="ifc-message"></i> ' . __('Your Email Adress', EWF_SETUP_THEME_DOMAIN) . '<span class="required"></span></label> ' .
				  '</p>',
				  
				'url' =>
				  '<p class="comment-form-url">' .
					'<input class="ewf-span4" placeholder="' . __( 'Website', EWF_SETUP_THEME_DOMAIN) . '" id="url" name="url" type="url" value="" size="30">' .
					'<label for="url"><i class="ifc-internet_explorer"></i> ' . __( 'Website', EWF_SETUP_THEME_DOMAIN) . '</label>' .
				  '</p>'
			)
		),
		
		'label_submit'		=> __('Send!', EWF_SETUP_THEME_DOMAIN),
		'title_reply'       => __( 'Leave a Reply', EWF_SETUP_THEME_DOMAIN),
		'title_reply_to'    => __( 'Leave a Reply to %s', EWF_SETUP_THEME_DOMAIN),
		'cancel_reply_link' => __( 'Cancel Reply', EWF_SETUP_THEME_DOMAIN),
		'label_submit'      => __('Send!', EWF_SETUP_THEME_DOMAIN), 
		'id_form'      		=> 'comment-form', 
		
	);
	
	comment_form($args); 
	
	

?>

<?php endif; // end ?>

		</div> <!-- .ewf-span12  -->
	</div> <!-- .ewf-row  -->
	
</div>