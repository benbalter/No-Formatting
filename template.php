<?php
/**
 * Template Name: No Formatting
 *
 * Removes the header and footer, just displays post content
 *
 * @author Benjamin J. Balter <ben@balter.com>
 */

?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php the_content(); ?>
					
<?php endwhile; ?>

