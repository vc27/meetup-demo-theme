<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header-head' );

?>
<!-- Start Body -->
<body <?php body_class(); echo apply_filters( 'tag_body_attr', '' ); ?>>
	<?php do_action('after_body_tag'); ?>

	<div class="row">
		<div class="large-11 columns end">
			<?php
			wp_nav_menu( array(
				'fallback_cb' => '',
				'theme_location' => 'primary-menu',
				'menu_class' => 'menu',
			) );
			?>
		</div>
	</div>
