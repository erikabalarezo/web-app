<?php

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (empty($id)) {
header('Location: index.php');
exit;
}

require_once 'includes/db.php';
require_once 'includes/functions.php';

$sql = $db->prepare('
SELECT id, name, adr, lat, lng, rate_count, rate_total
FROM dinobones
WHERE id = :id
');

$sql->bindValue(':id', $id, PDO::PARAM_INT);
$sql->execute();
$dino = $sql->fetch();

if (empty($dino)) {
header('Location: index.php');
exit;
}

$title = $dino['name'];

if ($dino['rate_count'] > 0) {
$rating = round($dino['rate_total'] / $dino['rate_count']);
} else {
$rating = 0;
}

$cookie = get_rate_cookie();

include 'includes/theme-top.php';

?>

<h1><?php echo $dino['name']; ?></h1>

<dl>
<dt>Average Rating</dt><dd><meter value="<?php echo $rating; ?>" min="0" max="5"><?php echo $rating; ?> out of 5</meter></dd>
<dt>Address</dt><dd><?php echo $dino['adr']; ?></dd>
<dt>Longitude</dt><dd><?php echo $dino['lng']; ?></dd>
<dt>Latitude</dt><dd><?php echo $dino['lat']; ?></dd>
</dl>

<?php if (isset($cookie[$id])) : ?>

<h2>Your rating</h2>
<ol class="rater rater-usable">
<?php for ($i = 1; $i <= 5; $i++) : ?>
<?php $class = ($i <= $cookie[$id]) ? 'is-rated' : ''; ?>
<li class="rater-level <?php echo $class; ?>">★</li>
<?php endfor; ?>
</ol>

<?php else : ?>

<h2>Rate</h2>
<ol class="rater rater-usable">
<?php for ($i = 1; $i <= 5; $i++) : ?>
<li class="rater-level"><a href="rate.php?id=<?php echo $dino['id']; ?>&rate=<?php echo $i; ?>">★</a></li>
<?php endfor; ?>
</ol>

<?php endif; ?>

<?php

include 'includes/theme-bottom.php';

?>