<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */


/**
 * ThemeFunctions
 **/
$ThemeFunctions = new ThemeFunctions();
$ThemeFunctions->init();

class ThemeFunctions {

	/**
	 * __construct
	 **/
	function __construct() {

	} // end function __construct


	/**
	 * A simple method for adding variable to the class
	 **/
	function set( $key, $val = false ) {

		if ( isset( $key ) AND ! empty( $key ) ) {
			$this->$key = $val;
		}

	} // end function set


	/**
	 * Initiate the theme by adding actions to the primary
	 * hooks of the wp system.
	 * Ref: https://codex.wordpress.org/Plugin_API/Action_Reference
	 * @uses add_action
	 **/
	function init() {

		add_action( 'after_setup_theme', [ $this, 'action__after_setup_theme' ] );
		add_action( 'init', [ $this, 'action__init' ] );

	} // end function initThemeFunctions


	/**
	 * Add primary theme needs at the first possible hook
	 * @uses add_image_size, load_theme_textdomain
	 **/
	function action__after_setup_theme() {

		// Translations can be added to the /languages/ directory.
		// load_theme_textdomain( 'ThemeFunctions', "$this->stylesheet_directory/languages" );
		// load_theme_textdomain( 'parenttheme', $this->ParentTheme->template_directory . "/languages" );

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'standard', 300, 300, false );
		add_image_size( 'medium', 600, 1000, false );
		add_image_size( 'large', 1000, 2000, false );
		add_image_size( 'large-ex', 2000, 4000, false );

	} // end function action__after_setup_theme


	/**
	 * Add functionality when wp initiates
	 * @uses register_nav_menus, add_action
	 **/
	function action__init() {

		self::register_sidebars( [
			'Primary Sidebar' => [
				'desc' => 'This is the primary widgetized area.',
			],
		] );

		register_nav_menus( [
			'primary-menu' => __( 'Primary Menu Navigation', 'parenttheme' ),
			'footer-menu' => __( 'Footer Menu Navigation', 'parenttheme' )
		] );

		add_action( 'wp_enqueue_scripts', [ $this, 'register_style_and_scripts' ], 9 );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_localize_script' ], 11 );

	} // end function init


	####################################################################################################
	/**
	 * Register / De-Register Scripts & CSS
	 **/
	####################################################################################################


	/**
	 * register_style_and_scripts
	 * @uses wp_register_style, wp_register_script
	 **/
	function register_style_and_scripts() {

		// CSS External - must not be required by local resources
		wp_register_style( 'google-fonts', "https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic", [], null );
		wp_register_style( 'font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css", [], null );

		// CSS Local - able to be dependant on eachother
		wp_register_style( 'foundations', get_stylesheet_directory_uri() . "/css/foundation.min.css", [], null );
		wp_register_style( 'ThemeFunctions-style', get_stylesheet_directory_uri() . "/css/style.css", ['foundations'], null );

		// Scripts
		wp_register_script( 'ThemeFunctions-scripts', get_stylesheet_directory_uri() . "/js/siteScripts.js", ['jquery'], null );

	} // end function register_style_and_scripts


	####################################################################################################
	/**
	 * Front End - Enqueue, Print & other menial labor
	 **/
	####################################################################################################


	/**
	 * Load an object following a specified registered script
	 * @uses wp_localize_script
	 **/
	function wp_localize_script() {

		$array = [
			'stylesheet_directory_uri' => get_stylesheet_directory_uri(),
			'template_directory_uri' => get_template_directory_uri(),
			'home_url' => home_url(),
		];

		wp_localize_script( 'jquery', 'siteObject', $array );

	} // end function wp_localize_script


	/**
	 * wp_enqueue_scripts
	 **/
	function wp_enqueue_scripts() {

		// Styles
		wp_enqueue_style( 'google-fonts' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'ThemeFunctions-style' );

		// JS Scripts
		wp_enqueue_script( 'ThemeFunctions-scripts' );

	} // function wp_enqueue_scripts


	####################################################################################################
	/**
	 * Utility Functions
	 **/
	####################################################################################################


	/**
	 * Utility for registering sidebars.
	 * @uses register_sidebar, sanitize_title_with_dashes
	 **/
	static function register_sidebars( $sidebars = [] ) {

		// Register Sidebars
		foreach ( $sidebars as $name => $info ) {

			$id = sanitize_title_with_dashes( $name );

			register_sidebar( [
				'name' => $name,
				'id' => $id,
				'description' => $info['desc'],
				'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="h3 widget-title"><span class="widget-title-wrap">',
				'after_title' => '</span></div>'
			] );

		} // endforeach; register sidebars

	} // end function register_sidebars


	/**
	 * Utility for adding widget areas.
	 * @uses wp_parse_args, is_active_sidebar, sanitize_title_with_dashes, dynamic_sidebar
	 **/
	static function get_widget_area( $name, $args = [] ) {

		$defaults = [
			'class' => '',
			'element' => 'div'
		];

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		if ( ! is_active_sidebar( $name ) ) {
			return false;
		}

		echo "<$element id=\"" . sanitize_title_with_dashes( $name ) . "\" class=\"widget-area $class\">";
			dynamic_sidebar( $name );
		echo "</$element>";

	} // end function get_widget_area


	/**
	 * Conditional to see if comments should be displayed
	 **/
	static function do_comments() {
		global $post;

		if (
			'closed' == $post->comment_status
			OR (
				$post->post_type == 'attachment'
				AND $post->post_mime_type == 'application/pdf'
			)
		) {
			return false;
		} else {
			return true;
		}

	} // end function do__comments


	/**
	 * previous_next___post_link
	 **/
	static function previous_next___post_link( $args = [] ) {

		if ( ! is_single() ) {
			return false;
		}

		$defaults = [
			'before' => '',
			'after' => '',
			'prev_spacer' => '&laquo;',
			'prev_text' => '%title',
			'next_spacer' => '&raquo;',
			'next_text' => '%title',
			'element' => 'div',
			'class' => 'navigation-post',
			'spacer' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			'in_same_term' => false,
			'excluded_terms' => '',
			'taxonomy' => 'category',
			'echo' => 1,
		];

		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );

		$output = "<$element class=\"$class\">";
			$output .= $before;

			$output .= "<span class=\"prev-post\">";
				$output .= get_previous_post_link( '%link', "<span class=\"spacer\">$prev_spacer</span> $prev_text", $in_same_term, $excluded_terms, $taxonomy );
			$output .= '</span>';

			$output .= $spacer;

			$output .= "<span class=\"next-post\">";
				$output .= get_next_post_link( '%link', "$next_text <span class=\"spacer\">$next_spacer</span>", $in_same_term, $excluded_terms, $taxonomy );
			$output .= '</span>';

			$output .= $after;
		$output .= "</$element>";

		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}

	} // end function previous_next___post_link


	/**
	 * previous_next___posts_link
	 **/
	static function previous_next___posts_link( $args = [] ) {
		global $wp_query;

		if (
			( is_home() OR is_archive() OR is_search() )
			AND ( $wp_query->found_posts >= $wp_query->query_vars['posts_per_page'] )
		) {

			$defaults = [
				'before' => '',
				'after' => '',
				'element' => 'div',
				'class' => 'navigation-posts',
				'spacer' => ' ',
			];

			$r = wp_parse_args( $args, $defaults );
			extract( $r, EXTR_SKIP );

			echo "<$element class=\"$class\">";

				echo $before;

				if ( function_exists('wp_pagenavi') ) {
					wp_pagenavi();
				} else {
					echo "<span class=\"prev-post\">"; previous_posts_link(); echo "</span>";
						echo $spacer;
					echo "<span class=\"next-post\">"; next_posts_link(); echo "</span>";
				}

				echo $after;

			echo "</$element>";

		}

	} // end function previous_next___posts_link


} // end class ThemeFunctions


####################################################################################################
/**
 * Procedural Functions
 **/
####################################################################################################



/**
 * Comments Callback
 **/
function comments__callback( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	?>

	<li id="comment-<?php echo get_comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">

			<div class="comment-details-block">

				<div class="comment-author"><?php echo get_comment_author_link(); ?></div>
				<div class="comment-date"><?php echo get_comment_date(); ?></div>

			</div>

			<div class="comment-text-block-wrap">
				<div class="comment-text-block">
					<?php if ( $comment->comment_approved == '0' ) { ?>
						<em> <?php _e('Your comment is awaiting moderation.'); ?></em>
					<?php } ?>
					<?php comment_text(); ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => 'Reply &raquo;',
							'depth' => $depth,
							'max_depth' => $args['max_depth'] )
							) );
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	// </li> is added from wrapping php function

} // end function comments__callback
