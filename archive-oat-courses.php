<?php
/**
 * The template for displaying archive courses page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bcit-oat
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>
			<?php $postCounter = 0; ?>

			<header class="page-header">
				<h1 class="page-title">Courses</h1>
			</header><!-- page-header -->

			<section>
				<div class="master-wrapper">
					<?php while ( have_posts() ) :
						the_post(); ?>
							<div class="course-wrap scrollReveal load-hidden">
								<div class="course-info-wrap">
									<div class="course-info">
										<h1 class="course-heading"><?php the_title(); ?>
											<?php if( function_exists('get_field') ):
												$file = get_field('course_outline'); ?>
											<?php endif; ?>
											<?php if( get_field('credits') ): ?>
												<span class="credits">Credits: <?php the_field('credits'); ?></span>
											<?php endif; ?>
										</h1>

										<?php if( get_field('course_description') ): ?>
											<p><?php the_field('course_description'); ?></p>
										<?php endif; ?>

										<?php if( $file ): ?>
											<div class="course-outline">
												<i class="fas fa-paperclip"></i>
												<a href="<?php echo $file['url']; ?>">Download OATP <?php echo ucwords(strtolower(substr(strstr(get_the_title()," "), 1))); ?> Course Outline</a>
											</div>
										<?php endif; ?>
									</div> <!-- end course info -->											
								</div> <!--end course info wrap -->

								<?php if( get_field('course_image') ): ?>
									<?php echo wp_get_attachment_image( get_field('course_image'), 'large' ); ?>								
								<?php endif; ?>

							</div> <!---end course wrap--->
					<?php endwhile; ?>
				</div><!---end master wrap--->
			</section>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
