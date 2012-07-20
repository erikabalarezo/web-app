<?php

require_once 'includes/db.php';

$min_start_time = 8;
$max_end_time = 23;
$time_diff = $max_end_time - $min_start_time;

$sql = $db->prepare('
	SELECT id, name
	FROM off_location
	ORDER BY name ASC
');
$sql->execute();
$locations = $sql->fetchAll();

$sql = $db->prepare('
	SELECT id, start_date, end_date, time_start, time_end, name, rate_count, rate_total, paid
	FROM off_event
	WHERE location_id = :location_id
');

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Ottawa For Families</title>
	 <link href="css/general.css" rel="stylesheet">
</head>

<body>
	<header>
		<!--<h1 class="apptitle">Ottawa For Families</h1>-->
		<form>
			<div>
				<label for="date">Date (YYYY-MM-DD)</label>
				<!--<label for="dateformat">(DD/MM/YYYY)</label>-->
				<input id="date" name="date" required>
				<button id="submitdate" type="submit">Find my events</button>
			</div>
		</form>
	</header>
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
                <li>
                    <div class="item item-title">
                        <strong class="item-name"><a href="locdescription.php?id=<?php echo $loc['id']; ?>"><?php echo $loc['name']; ?></a></strong>
                        <!--<div class="time-bar" style="width:200px">-->
                            <!--<p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>-->
                        <!--</div>-->
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
							<?php
								if ($ev['rate_count'] > 0) {
									$rating = round($ev['rate_total'] / $ev['rate_count']);
								} else {
									$rating = 0;
								}
								
								
							?>
						
						
                        <li class="event">
                            <div class="item">
							<!--<strong class="item-name item-name-event">-->
							
								<strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                               
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
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        </li>
        
        
		<li class="category two">
        
        	<a class="categorytab museums">Museums</a>
        	<ul>
            	<?php foreach($locations as $loc) : ?>
                <li>
                    <div class="item">
                        <strong class="item-name"><?php echo $loc['name']; ?></strong>
                        <div class="time-bar" style="width:500px">
                            <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                        </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
                        <li class="event">
                            <div class="item">
                                <strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                                <div class="time-bar" style="width:500px">
                                    <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
                
            </ul>
         </li>
            
            
		<li class="category three">
        	<a class="categorytab festivals">Festivals</a>
        	<ul>
            	<?php foreach($locations as $loc) : ?>
                <li>
                    <div class="item">
                        <strong class="item-name"><?php echo $loc['name']; ?></strong>
                        <div class="time-bar" style="width:500px">
                            <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                        </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
                        <li class="event">
                            <div class="item">
                                <strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                                <div class="time-bar" style="width:500px">
                                    <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
                
            </ul>    
        
        
        </li>
		
        
        
        <li class="category four">
        	<a class="categorytab entertainment">Entertainment</a>
        	<ul>
            	<?php foreach($locations as $loc) : ?>
                <li>
                    <div class="item">
                        <strong class="item-name"><?php echo $loc['name']; ?></strong>
                        <div class="time-bar" style="width:500px">
                            <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                        </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
                        <li class="event">
                            <div class="item">
                                <strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                                <div class="time-bar" style="width:500px">
                                    <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        
        
        
        </li>
        
		<li class="category five">
        	<a class="categorytab sites">Sites</a>
        	<ul>
            	<?php foreach($locations as $loc) : ?>
                <li>
                    <div class="item">
                        <strong class="item-name"><?php echo $loc['name']; ?></strong>
                        <div class="time-bar" style="width:500px">
                            <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                        </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
                        <li class="event">
                            <div class="item">
                                <strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                                <div class="time-bar" style="width:500px">
                                    <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>
        
        
        </li>
		<li class="category six">
        	<a class="categorytab leisure">Leisure</a>
        	<ul>
            	<?php foreach($locations as $loc) : ?>
                <li>
                    <div class="item">
                        <strong class="item-name"><?php echo $loc['name']; ?></strong>
                        <div class="time-bar" style="width:500px">
                            <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                        </div>
                    </div>
                    <ul class="events">
                    	<?php
							$sql->bindValue(':location_id', $loc['id'], PDO::PARAM_INT);
							$sql->execute();
							$events = $sql->fetchAll();
							
							foreach($events as $ev) :
						?>
                        <li class="event">
                            <div class="item">
                                <strong class="item-name item-name-event"><?php echo $ev['name']; ?></strong>
                                <div class="time-bar" style="width:500px">
                                    <p class="time-bar-times"><span class="time-bar-start">10:00</span> <span class="time-bar-end">5:00</span></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>
            </ul>    
            
        </li>
	</ul>
<!--bottom app from here -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/date-validation.js"></script>
</body>
</html>
