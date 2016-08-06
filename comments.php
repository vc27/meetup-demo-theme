<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * Description
 * Comments file based on twentyeleven
 **/
#################################################################################################### */

if ( ! ThemeFunctions::do_comments() ) {
	return;
}
?>
<div id="comments">

	<?php
	/**
	 * Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 **/
	if ( post_password_required() ) { ?>
			<p class="nopassword">
			 	<?php _e( 'This post is password protected. Enter the password to view any comments.', 'parenttheme' ); ?>
			</p>
		</div><!-- #section-comments -->
		<?php
		return;

	} // end if ( post_password_required() )


	if ( have_comments() ) { ?>

		<h4 class="h4">
			<?php
			comments_number(
				__( 'No Responses', 'parenttheme' ),
				__( 'One Response', 'parenttheme' ),
				__( '% Responses', 'parenttheme' )
			);
			?>
			<?php echo sprintf( __( 'to &#8220;%1$s&#8221', 'parenttheme' ), get_the_title() ); ?>
		</h4>

		<?php // are there comments to navigate through
		if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) {
			?>
			<div id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'parenttheme' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'parenttheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'parenttheme' ) ); ?></div>
			</div>
			<?php
 		} // end if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) )
		?>


		<ol class="list-comments">
			<?php
			wp_list_comments( [
				'callback' => 'comments__callback'
			] );
			?>
		</ol>


		<?php
		// are there comments to navigate through
		if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) ) { ?>

			<div id="comment-nav-above">
				<div class="assistive-text"><?php _e( 'Comment navigation', 'parenttheme' ); ?></div>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'parenttheme' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'parenttheme' ) ); ?></div>
			</div>
			<?php
 		} // end if ( get_comment_pages_count() > 1 AND get_option( 'page_comments' ) )
		
	// Comments are closed or not available
	} else if ( !comments_open() AND !is_page() AND post_type_supports( get_post_type(), 'comments' ) ) { ?>

		<p class="nocomments">Comments are closed</p>

	<?php } // end if ( have_comments() )


	// http://codex.wordpress.org/Function_Reference/comment_form
	comment_form( array(
		'label_submit' => __( 'Submit', 'parenttheme' ),
		'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'parenttheme' ) . '</p>',
		'comment_notes_after' => false,
	) );

?>
</div><!-- #comments -->
