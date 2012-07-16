<?php
require_once 'includes/db.php';


$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$sql = $db->prepare('
SELECT *
FROM off_event
WHERE :date BETWEEN start_date AND end_date');
$sql->bindValue(':date', $date, PDO::PARAM_STR);
$sql->execute();
$results= $sql->fetchALL();

print_r($results);


?>
