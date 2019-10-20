<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays the front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bcit-oat
 */
?>
<div class="home-page">
<?php get_header(); ?>


	<div id="primary" class="content-area" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>)">

		<main id="main" class="site-main">

			</div class="schedule-calendar">
				<?php get_template_part( 'template-parts/schedule', 'widget' ); ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
</div> <!-- home-page -->
<?php
