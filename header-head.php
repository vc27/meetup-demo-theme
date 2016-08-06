<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

?><!doctype html>
<html <?php language_attributes(); echo apply_filters( 'tag_html_attr', '' ); ?>>
<head <?php echo apply_filters( 'tag_head_attr', '' ); ?>>

	<title><?php wp_title(); ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<meta name="viewport" content="<?php echo apply_filters( 'meta-viewport-content', 'width=device-width, initial-scale=1.0' ); ?>">

	<?php wp_head(); ?>

</head>
