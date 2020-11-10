<!DOCTYPE html>
<!-- Extra features done: 1 & 2 & 3 -->
<html>
<head>
	<meta charset="utf-8">
	<title>NerdLuv</title>
	<link rel="stylesheet" type="text/css" href="css/nerdluv.css">
</head>
<body>
	<img src="images/logo.png" id="bannerarea" alt="nerdluv logo">

	<h1>Welcome!</h1>

	<a href="signup.php"><img src="images/signup.png" style="width: 20px; height: 20px; vertical-align: text-top;" alt="signup img"> Sign up for a free account</a>
	<br>
	<a href="matches.php"><img src="images/heart.png" style="width: 20px; height: 20px; vertical-align: text-top;" alt="heart img"> Check your matches</a>

	<?php
		include 'common.php';
		genFooter();
	  ?>

</body>
</html>