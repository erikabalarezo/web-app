<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Ottawa For Families</title>
	 <link href="css/general.css" rel="stylesheet">
</head>

<body>
	<header>
		<!--<h1 class="apptitle">Ottawa For Families</h1>-->
        <?php if (!isset($inside)) : ?>
		<form method="post" action="index.php">
			<div>
				<label for="date">Date</label>
				<!--<label for="dateformat">(DD/MM/YYYY)</label>-->
				<input id="date" name="date" value="<?php echo $date ?>">
				<button id="submitdate" type="submit">Find my events</button>
			</div>
		</form>
        <?php endif; ?>
	</header>