<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bcit-oat
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-headings-wrap">
			<div class="footer-headings">
				<div class='footer-headings-row'>
						<h3>Students</h3>
						<h3>Program</h3>
						<h3>Find Us</h3>
				</div>
			</div>
		<div>
		
		<div class="footer-links-wrap">	
			<div class='footer-links'>

				<img src="http://bcitoat.bcitwebdeveloper.ca/wp-content/uploads/2019/10/bcit_cmyk-logo.png">
			
				<div class='footer-section'>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-students',
							'menu_id'        => 'footer-students',
						) );
					?>
				</div>
				
				<div class='footer-section'>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-program',
							'menu_id'        => 'footer-program',
						) );
					?>
				</div>

				<div class='footer-section'>
					<?php
						if(function_exists('the_field')):
					?>
							<p><?php the_field('company_name', 'option'); ?> <p>
							<p><?php the_field('street_address', 'option'); ?><p>
							<p><?php the_field('city', 'option'); ?>, <?php the_field('province', 'option'); ?></p>
							<p><?php the_field('zip_code', 'option'); ?></p>
							<br />
							<p>Telephone: <?php the_field('telephone', 'option') ?></p>
							<p>Toll-free: <?php the_field('toll_free', 'option') ?></p>
					<?php
						endif;
					?>

					<br>
					<a href='https://www.bcit.ca/contacts/'>More Contact Numbers</a>
			</div>
		</div>
	</footer><!-- #colophon -->
	<div class="copyright-wrap"><span class='copyright'>Copyright &copy; BCIT OAT <?php print_r(date('Y')); ?>. All rights reserved.</span></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
