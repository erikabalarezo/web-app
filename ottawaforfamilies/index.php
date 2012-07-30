<?php
require_once 'includes/db.php';
session_start();

if (!isset($_SESSION['date'])) $_SESSION['date'] = date('Y-m-d');

$min_start_time = 8;
$max_end_time = 23;
$time_diff = $max_end_time - $min_start_time;

$location_sql = $db->prepare('
	SELECT id, name, time_start, time_end, category, rate_count, rate_total, paid
	FROM off_location
	WHERE category = :category
	ORDER BY name ASC
');

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

$event_sql = $db->prepare('
	SELECT id, start_date, end_date, time_start, time_end, name, rate_count, rate_total, paid
	FROM off_event
	WHERE location_id = :location_id
	AND start_date <= :date
	AND end_date >= :date
');
$event_sql->bindValue(':date', $date, PDO::PARAM_STR);

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
	<?php	
      $categories = array('Galleries', 'Museums', 'Festivals', 'Entertainment', 'Sites', 'Leisure');
	  
	  foreach ($categories as $cat) {
		$location_sql->bindValue(':category', $cat, PDO::PARAM_STR);
		$location_sql->execute();
		$locations = $location_sql->fetchAll(); 
		include 'includes/categorydisplay.php';
	  }
		 
	?>
	</ul>
<!--bottom app from here -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<!--<script src="js/date-validation.js"></script>-->
</body>
</html>
