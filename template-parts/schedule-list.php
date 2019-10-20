
			<?php
			$args = array(
				'post_type' 		=> 'tablepress_table',
				'posts_per_page'	=> -1 
			);

			$query = new WP_Query( $args );

			while ($query->have_posts()):
				$query->the_post();
				$table_data 	= json_decode(get_the_content());
			foreach ($table_data as $item):
				$month = date("F", strtotime($item[1]));
				$year = date("Y", strtotime($item[1]));
				$schedule[$month][] = $item;
			endforeach;?>
			
			<div class="schedule-list">
				<div class="buttons">
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>	
			
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php $slide_index=0;?>

						<?php foreach ($schedule as $month => $monthlySchedule):?>
							<div class="swiper-slide" slide_index=<?php echo $slide_index ?>>
								<div class="schedule-header">
									<h1><?php echo $month . " " . $year; ?></h1>	
								</div>								
								<div class="grid-container">
									<?php foreach ($monthlySchedule as $weeks):
									// Add the appropriate weekday to the array 
									$weekday = date("l", strtotime($weeks[1])); 
									array_unshift($weeks, $weekday);
									

									// Format the date and define all the variables
									for ($i = 0; $i < count($weeks); $i++):
										$formatedDate = date("F d", strtotime($weeks[2]));
										$weekday 	= $weeks[0];
										$week 	 	= $weeks[1];
										$date 		= $formatedDate;
										$class	 	= $weeks[3];
										$room		= $weeks[4];
										$instructor	= $weeks[5];
										$isWeekend	= $weeks[6];
									endfor;?>
										<?php if ($isWeekend): ?>
											<div class="weekend grid-item" id=<?php echo "'D" . $weeks[2] . "'" ?>>
												<div class="date">
													<p id="day"><?php  echo $weekday ?></p>
													<p id="date"><?php  echo $date ?></p>
												</div>
												<div class="day-info">
													<p class="holiday"><?php  echo $class  ?></p>
												</div>
											</div>
										<?php else: ?>
											<div class=<?php echo "'week " . $week . " grid-item'"?> id=<?php echo "'D" . $weeks[2] . "'" ?>> 
											<div class="date">
												<p id="day"><?php  echo $weekday ?></p>
												<p id="date"><?php  echo $date ?></p>
											</div>
											<div class="day-info">
												<p class="class"><?php  echo $class  ?></p>
												<div class="class-info">
													<p class="instructor"> <?php echo $instructor ?> </p>
													<p class="room">Room: <?php echo $room?> </p>
												</div>
											</div>
											</div>
										<?php endif; ?>
									<?php endforeach;?>
								</div>
							</div>
							<?php $slide_index++?>
						<?php endforeach; ?>
					</div>
				</div>
					<div class="swiper-pagination"></div>

				</div>
				<?php endwhile;

				wp_reset_postdata();
			
				?>
	<?php

	get_footer();