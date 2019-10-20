<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */


get_header();

?>
	<header class="page-header">
				<h1 class="page-title">Schedule</h1>
			</header><!-- .page-header -->

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		</div class="schedule-calendar">
				<?php get_template_part( 'template-parts/schedule', 'calendar' ); ?>
			</div>
		<div class="schedule-list">
			<?php get_template_part( 'template-parts/schedule', 'list' ); ?>
		</div>

			
			
			</main><!-- #main -->
		</section><!-- #primary -->
	<?php

	get_footer();
				


