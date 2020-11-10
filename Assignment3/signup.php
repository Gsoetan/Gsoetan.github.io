<!DOCTYPE html>
<!-- Extra features done: 1 & 2 & 3 -->
<html>
<head>
	<meta charset="utf-8">
	<title>Sign-up</title>
	<link rel="stylesheet" type="text/css" href="css/nerdluv.css">
</head>
<body>
	<img src="images/logo.png" id="bannerarea" alt="nerdluv logo">
	<form action="signup-submit.php" method="post" enctype="multipart/form-data">
	<fieldset class="column">
		<legend>New User Signup: </legend>
		<p>
			<strong>Name:</strong> 
			<input type="text" name="name" size="16">
		</p>
		
			<label for="gender" class="left"><strong>Gender:</strong></label>
			<div id="sex">
				<input type="radio" id="gender" name="gender" value="M"> Male
				<input type="radio" name="gender" value="F" checked> Female
			</div>
		
		<p>
			<strong>Age:</strong>
			<input type="text" name="age" maxlength="2" size="6">
		</p>
		<p>
			<strong>Personality type:</strong>
			<input type="text" name="person_type" maxlength="4" size="6"> (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
		</p>
		<p>
			<label for="OS" class="left"><strong>Favorite OS:</strong></label>
			<select name="OS_type" size="1" id="OS">
				<option>Windows</option>
				<option>Mac OS X</option>
				<option>Linux</option>
			</select>
		</p>
		<p>
			<strong>Seeking age:</strong>
			<input type="text" placeholder="min" name="age_min" maxlength="2" size="6"> to <input type="text" placeholder="max" name="age_max" maxlength="2" size="6">
		</p>
		
			<label for="gender_preference" class="left"><strong>Seek Gender(s):</strong></label>
			<div id="preference">
				<input type="checkbox" id="gender_preference" name="gender_preference[]" value="M" checked> Male
				<input type="checkbox" name="gender_preference[]" value="F"> Female
			</div>
		
		<p>
			<strong>Photo:</strong>
			<input type="file" name="pfp" id="pfp">
		</p>
		<input type="submit" value="Sign Up">
	</fieldset>
	</form>

	<?php
		include 'common.php';
		genFooter();
	  ?>

</body>
</html>