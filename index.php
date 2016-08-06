<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

get_template_part( 'header' );

?>
<div id="section-main" class="row">
	<div class="large-8 columns layout-loop">
		<?php
		if ( have_posts() ) {

			get_template_part('section-archive-titles');

			while ( have_posts() ) {

				the_post();
				get_template_part( 'section', get_post_type() );

			}

			if ( ThemeFunctions::do_comments() ) {

				comments_template( '', true );

			}

			ThemeFunctions::previous_next___post_link();
			ThemeFunctions::previous_next___posts_link();

		} else {
			// There were no post? maybe 404 or maybe a search?

			if ( is_404() ) {

				get_template_part( 'section', '404' );

			} else if ( is_search() ) {

				get_template_part( 'section', 'search' );

			}

		}
		?>
	</div>
	<div class="large-4 columns">
		<?php ThemeFunctions::get_widget_area( 'Primary Sidebar' ); ?>
	</div>
</div>

<?php

get_template_part( 'footer' );
