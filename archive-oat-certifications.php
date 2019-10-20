<?php
/**
 * The template for displaying archive pages
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

			<header class="page-header">
				<h1 class="page-title">Certifications</h1>
			</header><!-- .page-header -->

			<div class="master-wrapper">
				<div class="certifications"><!-- .certifications -->
					<?php
						while(have_posts()): 
					?>

					<div class="certification scrollReveal load-hidden"><!-- .certification -->
					<?php
							the_post();
					?>
							<h2><?php the_title(); ?></h2>
					<?php
							if(function_exists('get_field')):
								if(get_field('logo')):
					?>
									<img src="<?php the_field('logo'); ?>">
					<?php
								endif;

								if(get_field('description')):
					?>
									<p><?php the_field('description'); ?></p>
					<?php
								endif;

								if(get_field('url')):
					?>
									<div class="more-info-btn">
										<a href="<?php the_field('url'); ?>" target="_blank">
											<span>More Info</span>
											<div class="transition"></div>
										</a>
									</div>
					<?php
								endif;
							endif;
					?>
					</div>
					<?php
						endwhile;
					?>
				</div>
			</div> <!-- End master wrap -->
		<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
