<?php
/**
 * The template for displaying career pages
 *
 * This is the template that displays career pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bcit-oat
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
	
		<header class="page-header">
			<h1 class="page-title">Careers</h1>
		</header><!-- .page-header -->
	
		<div class='careers-wrapper'>
			<div class='careerToggle'>
				<button class='careersBtn recruitmentAgencies'><span>Recruitment Agencies</span><i class="fas fa-chevron-down"></i></button>
				<?php 
					if (have_rows('recruitment_agencies')):
				?>
						<div class='careerLinks recruitmentAgencies'>
							<ul>
					<?php
						while(have_rows('recruitment_agencies')) : the_row();
					?>
							<li><a href='<?php the_sub_field('url'); ?>' target="_blank"><?php the_sub_field('agency_name'); ?></a></li>
					<?php
						endwhile;
					?>
							</ul>
						</div>
				<?php 
					endif;
				?>
			</div>

			<div class='careerToggle'>
				<button class='careersBtn jobSites'><span>Job Sites</span><i class="fas fa-chevron-down"></i></button>
				<?php 
					if (have_rows('job_sites')):
				?>
						<div class='careerLinks jobSites'>
							<ul>
					<?php
						while(have_rows('job_sites')) : the_row();
					?>
							<li><a href='<?php the_sub_field('url'); ?>' target="_blank"><?php the_sub_field('website_name'); ?></a></li>
					<?php
						endwhile;
					?>
							</ul>
						</div>
				<?php 
					endif;
				?>
			</div>
			<h2>Civic Jobs BC</h2>
			<div class='jobPostings'>
			<?php
				$url = "https://www.civicjobs.ca/rss/pc?id=36"; // Civic Jobs Office Administration
				$feeds = file_get_contents($url);
				$rss = simplexml_load_string($feeds);
				$number_of_posts_to_show = 6;

				$items = [];

				foreach($rss->channel->item as $entry):
					$items[] = [
						'title' 		=> $entry->title,			// Title
						'link' 			=> $entry->link,			// Link
						'description' 	=> $entry->description,		// Description
						'pubDate' 		=> $entry->pubDate,			// Publication Date
					];
				endforeach;

				$counter = 0;
				foreach($items as $item):
					/* Show a set number of most recent Posts */
					if($counter === $number_of_posts_to_show):
						break;
					endif;

					/* Parse XML Object into Usable String */
					$title = $item['title']->__toString();
					$link = $item['link']->__toString();
					$description = $item['description']->__toString();

					/* Regex to Remove Time and Timezone */
					$reg = '/\s[0-9]{2}:[0-9]{2}:[0-9]{2}\s[A-Z]{3}/m';
					$pubDate_formatted = preg_replace($reg, "", $item['pubDate']->__toString());
					
					/* Calculate how many days ago the Job was posted */
					$pubDate_seconds = strtotime($item['pubDate']->__toString());
					$date = strtotime('now');
					
					$pubDate_daysElapsed = floor(($date - $pubDate_seconds)/(60*60*24));
			?>
					<div class='posting'>
						<h2 class='title'><a href='<?php print_r($link); ?>'><?php print_r($title); ?></a></h2>
						<p class='description'><?php print_r($description); ?></p>
						<p class='jobInfo'>
							<span class='pubDate'>Posted <?php print_r($pubDate_daysElapsed); ?> days ago</span>
							<a href='<?php print_r($link); ?>' target="_blank" class='viewJob'>View Posting</a>
						</p>
					</div>
			<?php
					$counter++;
				endforeach;
			?>
			</div>
			<span class='viewMore'>
				<a href='https://www.civicjobs.ca/jobs' class="viewMoreBtn" target="_blank">View More</a>
			</span>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
