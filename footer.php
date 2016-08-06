<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

?>
<hr />
<?php
wp_nav_menu( array(
	'fallback_cb' => '',
	'theme_location' => 'footer-menu',
	'menu_class' => 'menu',
	'container_class' => 'menu-centered'
) );
?>
<div class="layout-site-credits text-center">&copy; <?php current_time('Y'); ?> <?php bloginfo('name'); ?></div>
<?php wp_footer(); ?>
</body>
</html>
