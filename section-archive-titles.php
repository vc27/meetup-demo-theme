<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

$title = '';
if ( is_single() OR is_page() ) {
	$title = get_the_title( $wp_query->queried_object->ID );
} else if ( is_search() ) {
	$title = 'Search: ' . $_GET['s'];
} else if ( is_date() ) {
	$title = 'Archive: Date';
} else if ( is_home() ) {
	$title = 'Blog';
} else if ( is_archive() ) {
	$taxonomy = get_taxonomy( $wp_query->queried_object->taxonomy );
	$title = $taxonomy->label . ': ' . $wp_query->queried_object->name;
}

if ( ! empty( $title ) ) { ?>
	<div class="row">
		<div class="large-11 columns end">
			<h1><?php echo $title; ?></h1>
		</div>
	</div>
	<hr />
<?php }
