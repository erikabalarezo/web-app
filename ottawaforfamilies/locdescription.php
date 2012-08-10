<?php
/**
 * Small description of this file:
 * Manages locations and events for a specific date.
 *
 *use the tags available in phpdoc.org
 *@author Erika Balarezo <erikabalarezo@yahoo.com>
 *@copyright 2012 Erika Balarezo
 *@license BSD-3-Clause http://opensource.org/licenses/BSD-3-Clause 
 *@version 1.0.0
 *@package ottawaforfamilies 
 */
require_once 'includes/db.php';
require_once 'includes/functions.php';
session_start();

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

$sql = $db->prepare('
SELECT name, description, category
FROM off_location
WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$details= $sql->fetch();

$sql = $db->prepare('
	SELECT location_id, name, description
	FROM off_event
	WHERE location_id = :id AND :date BETWEEN start_date AND end_date
');
$sql->bindValue(':id', $id, PDO::PARAM_STR);
$sql->bindValue(':date', $_SESSION['date'], PDO::PARAM_STR);
$sql->execute();
$evdetails= $sql->fetchALL();

if (empty($details)) {
header('Location: index.php');
exit;
}

$inside = true;
include 'includes/wrapper-top.php';

?>
<!--added this line to test style of inside pages-->
<div class = "all<?php echo strtolower($details['category']); ?>">


	<h1><?php echo $details['name']; ?></h1>
	<p><?php echo $details['description']; ?></p>
	<?php foreach($evdetails as $evdet) : { ?>
		
		
		<h2><?php echo $evdet['name']; ?></h2>
		<p><?php echo $evdet['description']; } ?></p>
	<?php endforeach; ?>

</div>
<?php

//include 'includes/app-bottom.php';

?>
