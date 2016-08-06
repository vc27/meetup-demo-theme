<?php
/**
 * Template Name: Single column page
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
		<div class="large-8 large-offset-2 columns end ">
			<?php
			wp_nav_menu( array(
				'fallback_cb' => '',
				'theme_location' => 'primary-menu',
				'menu_class' => 'menu',
			) );
			?>
		</div>
	</div>

	<div id="section-main" class="row">
		<div class="large-8 large-offset-2 columns end layout-loop">
			<?php
			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();
					?>
					<h1><?php the_title(); ?></h1>
					<hr />
					<?php
					get_template_part( 'section', get_post_type() );

				}

				if ( ThemeFunctions::do_comments() ) {

					comments_template( '', true );

				}

			} else {

				get_template_part( 'section', '404' );

			}
			?>
		</div>
	</div>

<?php

get_template_part( 'footer' );
