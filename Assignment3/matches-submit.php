<!DOCTYPE html>
<!-- Extra features done: 1 & 2 & 3 -->
<html>
<head>
	<meta charset="utf-8">
	<title>Your matches</title>
	<link rel="stylesheet" type="text/css" href="css/nerdluv.css">
</head>
<body>
	<?php
	if ("" == trim($_GET['name'])) {
		header("Location: mistake.php");
		exit();
	}
	  ?>
	<img src="images/logo.png" id="bannerarea" alt="nerdluv logo">
	<h1>Matches for <?php echo $_GET['name']; ?></h1>
	<?php
	include 'common.php';
	getMatches($_GET['name']);
	genFooter();
	  ?>

</body>
</html>