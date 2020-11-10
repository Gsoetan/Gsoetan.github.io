<!DOCTYPE html>
<!-- Extra features done: 1 & 2 & 3 -->
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/nerdluv.css">
</head>
<body>
	<img src="images/logo.png" id="bannerarea" alt="nerdluv logo">
	<form action="matches-submit.php" method="GET">
	<fieldset class="column">
		<legend>Returning User: </legend>
		<p>
			<strong>Name:</strong>
			<input type="text" name="name" size="16">
		</p>
		<input type="submit" value="View my matches">
	</fieldset>
	</form>

	<?php
		include 'common.php';
		genFooter();
	  ?>

</body>
</html>