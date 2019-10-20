<!-- TablePress plugin provides the data from the .csv - file as a json string -->

<?php
$args = array(
	'post_type' 		=> 'tablepress_table',
	'posts_per_page'	=> -1 
);

$query = new WP_Query( $args );

while ($query->have_posts()):
	$query->the_post();
	$table_data 	= json_decode(get_the_content()); // Parsing the json into an object.
	$allMonths = array();

		foreach ($table_data as $item):
			$month = date("F", strtotime($item[1]));//Format the months from numerical value to text
			array_push($allMonths, $month);	// Push all months in an array --> Its going to add the month info for every day
			$schedule[$month][] = $item; //Add the month as a key to the array
		endforeach;
		?>
		
		
		<?php $months = array_unique($allMonths); // Filter out all the duplicate values
		$numberOfDaysInMonth = array(); //Empty array to get the number of days in a month	
		$monthIndex = 0; // Define index so you can loop through all months 
		?>
		<div class="schedule-calendar">
				<button class="goto">Go to today</button>
			<?php foreach ($months as $month):
					
					$currentYear = date("Y", strtotime($schedule[$month][0][1])); // Get the year in the right format
					$monthAsNumber = date("n", strtotime($month)); // Converting the months to a number so they can be used in cal_days_in_month function
					array_push($numberOfDaysInMonth, cal_days_in_month(CAL_GREGORIAN, $monthAsNumber, $currentYear)); // Push the number of days for each month in an array
					$firstWeekday = date("w",  mktime(0, 0, 0, $monthAsNumber, 1, $currentYear)); // Getting the first weekday of month. Number between 1 - 6?>
						<div class="schedule-header" id=<?php echo $month?>>
							<h1><?php echo $month . " " . $currentYear ?> </h1>
						</div>

						<div class="calendar">
							<div class="weekdays-grid">
								<p class="weekday">Sunday</p>
								<p class="weekday">Monday</p>
								<p class="weekday">Tuesday</p>
								<p class="weekday">Wednesday</p>
								<p class="weekday">Thursday</p>
								<p class="weekday">Friday</p>
								<p class="weekday">Saturday</p>
							</div>
								<?php $dayOfMonth = date("j", strtotime($schedule[$month][0][1])); ?> 
								<?php $dayIndex = 0; // Have to use this index and not the current day, so schedules can be used that don't start on the 1st of the month ?>
								<div class="date-grid">
									<?php for ($i = 0 ; $i < 5; $i ++): // Create rows?> 
											<?php for ($j = 0; $j < 7; $j++ ): //Creating the individual cells ?>  
												<?php if ($i == 0 && $j < $firstWeekday ):  ?> 
													<span class="beginning-month">
													</span>
												<?php elseif ( $dayIndex >= count($schedule[$month])): ?> 
													<span class="end-month">
													</span>
												<?php else: ?>
													<div class="day-of-month" id=<?php echo "'D" . $schedule[$month][$dayIndex][1] . "'" // Multidimensional array can be accessed with brackets - [2] is  the postion of the instructor?> >
														<div class=<?php if ($schedule[$month][$dayIndex][5] == 1):?>
																<?php echo "holiday"; 
																else:
																echo "weekday";
																endif; ?>>
															<div class="day-info">
																<span class="class">
																	<?php echo ($schedule[$month][$dayIndex][2]) 
	
																	?>
																</span>
																<span class="instructor">
																	<?php echo ($schedule[$month][$dayIndex][4]) ?> 
																</span>
																<?php if ($schedule[$month][$dayIndex][5] != 1): ?>
																	<span class="room">
																	Room: <?php echo ($schedule[$month][$dayIndex][3]) ?> 
																	</span>
															<?php endif; ?>
														</div>
													</div>
														<span class=<?php if ($schedule[$month][$dayIndex][5] != 1):?> 
															<?php echo "date" ?>
																<?php else: ?>
																<?php echo "date-holiday" ?>
															<?php endif ;?>>
															<?php echo $dayOfMonth; ?>
														</span>
													</div>
													<?php $dayIndex++;?>
													<?php $dayOfMonth++; ?> 
												<?php endif; ?>
											<?php endfor;?>
									<?php endfor; ?>
								</div>
							</div>
					<?php $monthIndex++ ?>
				<?php endforeach; ?>
		<?php endwhile;
		wp_reset_postdata();	
		?>
