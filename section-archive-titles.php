<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

$title = '';
if ( is_date() ) {
	$title = 'Archive: Date';
} else if ( is_home() ) {
	$title = 'Blog';
} else if ( is_archive() ) {
	$taxonomy = get_taxonomy( $wp_query->queried_object->taxonomy );
	$title = $taxonomy->label . ': ' . $wp_query->queried_object->name;
}

if ( ! empty( $title ) ) {
	echo "<h1>$title</h1>";
}
