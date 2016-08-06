<?php
/**
 * @package WordPress
 * @subpackage ParentTheme
 * @license GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 **/
#################################################################################################### */

if ( is_home() OR is_archive() OR is_search() ) { ?>

	<div <?php post_class(); ?>>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="row">
			<div class="large-8 columns">
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
				<a class="button small" href="<?php the_permalink(); ?>">Read More &raquo;</a>
			</div>
			<div class="large-4 columns">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</div>
		</div>
	</div>

<?php } else if ( is_single() ) { ?>

	<div <?php post_class(); ?>>
		<div class="subheader"><?php the_date(); ?></div>
		<a class="tiny button" href="<?php the_author_link(); ?>">By: <?php the_author(); ?></a>
		<a class="tiny button" href="<?php comments_link(); ?>"><?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?></a>
		<div class="entry">
			<?php the_content(); ?>
		</div>
		<hr />
		<div class="row">
			<div class="large-6 columns">
				<div class="subheader">Categories</div>
				<?php the_category( ', ' ); ?>
			</div>
			<div class="large-6 columns">
				<div class="subheader">Tags</div>
				<?php the_tags( '', ', ', '' ); ?>
			</div>
		</div>
		<hr />
	</div>

<?php }
