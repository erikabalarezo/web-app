<?php

require_once 'includes/db.php';
require_once 'includes/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
	header('Location: index.php');
	exit;
}

$sql = $db->prepare('
SELECT name, description
FROM off_location
WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$details= $sql->fetchALL();

$sql = $db->prepare('
	SELECT location_id, category, name, description
	FROM off_event
	WHERE location_id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_STR);
$sql->execute();
$evdetails= $sql->fetchALL();


//print_r($details);
//print_r($evdetails);

if (empty($details)) {
header('Location: index.php');
exit;
}
if (empty($evdetails)) {
header('Location: index.php');
exit;
}
//include 'includes/app-top.php';


?>


<?php foreach($details as $det) : ?>
	<h1><?php echo $det['name']; ?></h1>
	<p><?php echo $det['description']; ?></p>
	<?php foreach($evdetails as $evdet) : ?>
		<?php $category = $evdet['category']; ?>
		
		<h2><?php echo $evdet['name']; ?></h1>
		<p><?php echo $evdet['description']; ?></p>
	<?php endforeach; ?>
<?php endforeach; ?>
<?php

//include 'includes/app-bottom.php';

?>
