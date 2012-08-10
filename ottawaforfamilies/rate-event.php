<?php
/**
 * Small description of this file:
 * Rates events
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

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$rate = filter_input(INPUT_GET, 'rate', FILTER_SANITIZE_NUMBER_INT);
$cookie = get_rate_cookie('events_rated');

if (empty($id)) {
header('Location: index.php');
exit;
}

// Only allow the user to rate if:
// 1. there is no cookie, aka they haven't already rated
// 2. the rating value is greater than 0
// 3. the rating value is less than 5
if (isset($cookie[$id]) || $rate < 0 || $rate > 5) {
header('Location: index.php');
exit;
}

$sql = $db->prepare('
UPDATE off_event
SET rate_count = rate_count + 1, rate_total = rate_total + :rate
WHERE id = :id
');
$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->bindValue(':rate', $rate, PDO::PARAM_INT);
$sql->execute();

save_rate_cookie('events_rated',$id, $rate);

header('Location: index.php');
exit;


