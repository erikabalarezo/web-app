<?php
require_once 'includes/db.php';
session_start();

if (!isset($_SESSION['date'])) $_SESSION['date'] = date('Y-m-d');

$min_start_time = 8;
$max_end_time = 23;
$time_diff = $max_end_time - $min_start_time;

$sql = $db->prepare('
	SELECT id, name, time_start, time_end
	FROM off_location
	ORDER BY name ASC
');
$sql->execute();
$locations = $sql->fetchAll();

$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
var_dump($date);
if(empty($date)) {
	$date = $_SESSION['date'];
	//echo 'today';
}
else {
	$date = date('Y-m-d', strtotime($date));
	//var_dump($date);
}



$sql = $db->prepare('
	SELECT id, start_date, end_date, time_start, time_end, name, rate_count, rate_total, paid, category
	FROM off_event
	WHERE location_id = :location_id
	AND start_date <= :date
	AND end_date >= :date
');
$sql->bindValue(':date', $date, PDO::PARAM_STR);


include 'includes/wrapper-top.html';
//lkjkj
?>
	<div class="locationdetail">
	    <!--<div class="time-bar-wrapper">-->
		<strong>
			 <div class="time-detail">
				<span class="am">8a.m</span>
				<span class="available">Available</span>
				<span class="pm">11p.m</span>
			</div>
			<div class="pay-rating-detail">
				<span class="paytitle">Pay</span>
				<span class="averagerating">Average Rating</span>
			</div>
        </strong>
    </div>
    
	<ul class="allcategories">
		<li class="category one">
			<a class="categorytab galleries">
			<img class="icon" src="images/pinkcircle-galleries.png">Galleries
			</a>
			
            <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 1) || ($loc['id']== 2)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name "><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                         <div class="time-bar-wrapper location-time-bar">
                         	<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
                          		<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
                          	</div>
                         </div>
                     </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=1 and id=2l 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category one-->
        
        
		<li class="category two">
        	<a class="categorytab museums">Museums</a>
			 <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 3) || ($loc['id']== 4) || ($loc['id']== 5) || ($loc['id']== 6)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name linkmuseums"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                         <div class="time-bar-wrapper location-time-bar">
                         	<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
                          		<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
                          	</div>
                         </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event linkmuseums"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=3, id=4, id=5, id=6 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category two-->
        	
        
            
            
		<li class="category three">
        	<a class="categorytab festivals">Festivals</a>
        	 <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 7) || ($loc['id']== 8)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name linkfestivals"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
						<!--if time is 0 then dont display time bar -->
						<?php if(!($loc['time_start'] == 0) ||!( $loc['time_end'] == 0))  { ?>
							 <div class="time-bar-wrapper location-time-bar">
								<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
									<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
								</div>
							 </div>
						<?php } ?><!--close if condition time = 0 -->
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=1 and id=2l 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category three-->
        
       
		
        
        
        <li class="category four">
        	<a class="categorytab entertainment">Entertainment</a>
        	 <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 16) || ($loc['id']== 17) || ($loc['id']== 18) || ($loc['id']== 19)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name linkentertainment"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                         <div class="time-bar-wrapper location-time-bar">
                         	<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
                          		<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
                          	</div>
                         </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=1 and id=2l 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category four Entertainment-->
        
        
        
       
        
		<li class="category five">
        	<a class="categorytab sites">Sites</a>
        	 <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 9) || ($loc['id']== 10) || ($loc['id']== 11) || ($loc['id']== 12)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name linksites"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                        <!--if time is 0 then dont display time bar -->
						<?php if(!($loc['time_start'] == 0) ||!( $loc['time_end'] == 0))  { ?>
							<div class="time-bar-wrapper location-time-bar">
								<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
									<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
								</div>
                         	</div>
						<?php } ?><!--close if condition time = 0 -->
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=1 and id=2l 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category five Sites-->
        
       
		<li class="category six">
        	<a class="categorytab leisure">Leisure</a>
        	 <ul>
            	<?php foreach($locations as $loc) : ?>
				<?php  if(($loc['id']== 13) || ($loc['id']== 14) || ($loc['id']== 15)) { ?>
			
                    <div class="item item-title">
                        <strong class="item-name linkleisure"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                        <!--if time = 0 then dont display time bar -->
						<?php if(!($loc['time_start'] == 0) ||!( $loc['time_end'] == 0))  { ?>
							 <div class="time-bar-wrapper location-time-bar">
								<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
									<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
								</div>
							 </div>
						<?php } ?><!--close if condition time = 0 -->
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php  //here put the category equal to galleries
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
								<?php echo $ev['name']; ?></a></strong>
                               
                                <div class="time-bar-wrapper">
                                    <div class="time-bar" style="left:<?php echo (($ev['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $ev['time_end']) / $time_diff) * 100; ?>%;">
                                        <p class="time-bar-times"><span class="time-bar-start"><?php echo $ev['time_start']; ?></span> <span class="time-bar-end"><?php echo $ev['time_end']; ?></span></p>
                                    </div>
                                </div>
								
								<?php
									if($ev['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
								?>
								<span class= "pay"><?php echo $ispaid; ?></span>
								
								<ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php //closes if for id=3, id=4, id=5, id=6 
				} ?>
				 <!-- added }this but doesnt work-->
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category two-->
        
	</ul>
<!--bottom app from here -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--<script src="js/date-validation.js"></script>-->
</body>
</html>
