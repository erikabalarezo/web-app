     
		<li class="category cat-<?php echo strtolower($cat); ?>">
        	<a class="categorytab <?php echo strtolower($cat); ?>"><?php echo $cat; ?></a>
        	 <ul>
            	<?php foreach($locations as $loc) : ?>
                
                    <div class="item item-title">
                        <strong class="item-name link<?php echo strtolower($cat); ?>"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
						<img class="<?php echo $loc['name']; ?>" src="images/bigtogglebutton.png" />
						
						<!--if time is 0 then dont display time bar -->
						<?php if(!($loc['time_start'] == 0) ||!( $loc['time_end'] == 0))  { ?>
							 <div class="time-bar-wrapper location-time-bar">
								<div class="time-bar" style="left:<?php echo (($loc['time_start'] - $min_start_time) / $time_diff) * 100; ?>%;right:<?php echo (($max_end_time - $loc['time_end']) / $time_diff) * 100; ?>%;">
									<p class="time-bar-times"><span class="time-bar-start"><?php echo $loc['time_start']; ?></span> <span class="time-bar-end"><?php echo $loc['time_end']; ?></span></p>
								</div>
							 </div>
						<?php } ?><!--close if condition time = 0 -->
                    
	                    <?php
									if($loc['paid'] == 0) {
										$ispaid = 'free';
									}
									else {
										$ispaid = '$';
									}
						?>
								<span class= "pay"><?php echo $ispaid; ?></span>
                    
                    
                    
                    <!--adding rating for each location-->
                    <?php
								if ($loc['rate_count'] > 0) {
									$rating = round($loc['rate_total'] / $loc['rate_count']);
								} else {
									$rating = 0;
								}
								
								
					?>
			                    <ul class="rater rater-usable">
								<?php for ($i = 1; $i <= 5; $i++) : 
								$class = ($i <= $rating) ? 'is-rated' : '';
								?>
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate-location.php?id=<?php echo $loc['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                     </div>
                    
                    
                    <!---------------------------------------->
                    
                    <ul class="events">
                    	<?php
							$event_sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$event_sql->execute();
							$events = $event_sql->fetchAll();
							
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
							
								<strong class="item-name item-name-event link<?php echo strtolower($cat); ?>"><a href="locdescription.php?id=<?php echo $loc['id']; ?>">
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
							
                                <li class="rater-level <?php echo $class; ?>"><a href="rate-event.php?id=<?php echo $ev['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
                                
								<?php endfor; ?>
								</ul>
                                                               
                                
                           </div><!--end for item-->
                        </li>
                        <?php endforeach; ?> <!--for events-->
                    </ul>
               
				<?php endforeach; ?><!--end of all locations -->
            </ul>
        </li> <!--closing category -->
        