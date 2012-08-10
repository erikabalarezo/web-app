<?php
/**
 * Small description of this file:
 * Checks the date
 *
 *use the tags available in phpdoc.org
 *@author Erika Balarezo <erikabalarezo@yahoo.com>
 *@copyright 2012 Erika Balarezo
 *@license BSD-3-Clause http://opensource.org/licenses/BSD-3-Clause 
 *@version 1.0.0
 *@package ottawaforfamilies 
 */
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
