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
		$month = date("F", strtotime($item[1]));//Format the month to text
		$year = date("Y", strtotime($item[1])); // Get the year in the right format
		array_push($allMonths, $month);	// Push all months in an array --> It going to add the month info for every day
		$schedule[$month][] = $item; //Add the month as a key to the array
	endforeach;
   
		 
    date_default_timezone_set('America/Vancouver');
    //Formats to get the correct schedule data
    $currentMonth = date('F');
    $today = date("j") ;
    $tomorrow = date("j", strtotime('tomorrow'));
    $todaysDate = date("md");
    $firstDayOfMonth = date("j", strtotime($schedule[$currentMonth][0][1])); 

    
    //Formats for the UI
    $dateUI = date("j");
    $weekdayUI = date("D");
    $monthUI    = date("M");
    ?>

    <a href="/oat/schedule<?php echo '/#D'. date(Ymd); ?>">

   
    <a href="/oat/schedule" >
    <div class="schedule-widget">
        <div class="widget-date">
            <p class="widget-day">
                <?php  echo $dateUI ?>
            </p>
            <p class="widget-month">
                <?php echo $monthUI ?>
            </p>
             <p class="widget-weekday">
                <?php echo $weekdayUI; ?>
            </p>
            
        </div>
        
      
        <div class="widget-info">
              <?php if ($todaysDate > 0705 && $todaysDate < 1015 ): ?>
                <h3> The new semester starts   
                    <?php if ($schedule[$currentMonth][0][1]): // Display the startdate of new semester only if a new schedule is uploaded, else just output April
                    echo date("F d, Y", strtotime($schedule[$currentMonth][0][1]));
                    else:?> in October. </h3>
                    <?php endif; ?>
            <?php elseif ($todaysDate > 0207 && $todaysDate < 0401): ?>
                <h3> The new semester starts   
                    <?php if ($schedule[$currentMonth][0][1]):
                    echo date("F d, Y", strtotime($schedule[$currentMonth][0][1]));
                    else:?> in April. </h3>
                    <?php endif; ?>

            <?php elseif (date("H") >= 17 || $weekdayUI == "Sun" || $schedule[$month][$today][5] == 1): // after 17, Sunday, or holiday  ?> 
                <h3>Tomorrow's class</h3>
                <p class="widget-class">
                    <?php echo ($schedule[$currentMonth][$tomorrow - $firstDayOfMonth][2])  // Weekdays start at 1 in php?> 
                </p>
                <p class="widget-instructor">
                    <?php echo ($schedule[$currentMonth][$tomorrow - $firstDayOfMonthMonth][4]) ?>
                </p>
                <?php if ($schedule[$month][$tomorrow - $firstDayOfMonthMonth][5] != 1): ?>
                    <p class="widget-room ">
                    Room:  <?php echo ($schedule[$currentMonth][$tomorrow - $firstDayOfMonth][3]) ?>
                    </p>
                <?php endif; ?>

            <?php elseif ($weekdayUI == "Sat"):?>
                <h3>Mondays's class</h3>
                <p class="widget-class ">
                    <?php echo ($schedule[$currentMonth][$tomorrow + 1 - $firstDayOfMonth][2]) ?> 
                </p>
                <p class="widget-instructor ">
                    <?php echo ($schedule[$currentMonth][$tomorrow + 1 - $firstDayOfMonth][4]) ?>
                </p>
                <?php if ($schedule[$month][$tomorrow + 1 - $firstDayOfMonth ][5] != 1): ?>
                    <p class="widget-room ">
                    Room:  <?php echo ($schedule[$currentMonth][$tomorrow + 1 - $firstDayOfMonth][3]) ?>
                    </p>
                <?php endif; ?>

            <?php elseif ($weekdayUI == "Fri" && date("H") >= 17):?>
                <h3>Mondays's class</h3>
                <p class="widget-class ">
                    <?php echo ($schedule[$currentMonth][$tomorrow + 2 - $firstDayOfMonth][2]) ?> 
                </p>
                <p class="widget-instructor ">
                    <?php echo ($schedule[$currentMonth][$tomorrow + 2 - $firstDayOfMonth][4]) ?>
                </p>
                <?php if ($schedule[$month][$tomomorrow + 2][5] != 1): ?>
                    <p class="widget-room ">
                    Room:  <?php echo ($schedule[$currentMonth][$tomorrow + 2 - $firstDayOfMonth][3]) ?>
                    </p>
                <?php endif; ?>

            <?php else: ?>
            <h3>Today's class</h3>
                <p class="widget-class">
                    <?php echo ($schedule[$currentMonth][$today - $firstDayOfMonth][2])  // Minus 1 because weekdays start at 1 in php?> 
                </p>
                <p class="widget-instructor">
                    <?php echo ($schedule[$currentMonth][$today - $firstDayOfMonth][4]) ?>
                </p>
                 <?php if ($schedule[$month][$today - $firstDayOfMonth][5] != 1): ?>
                    <p class="widget-room ">
                    Room:  <?php echo ($schedule[$currentMonth][$today - $firstDayOfMonth][3]) ?>
                    </p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    </a>



    

<?php endwhile; ?>