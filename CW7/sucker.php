<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!-- saved from url=(0057)https://codd.cs.gsu.edu/~lhenry23/06-Forms&PHP/sucker.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Buy Your Way to a Better Education!</title>
		<link href="./sucker.php_files/buyagrade.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<h1>Thanks, sucker!</h1>

		<p>Your information has been recorded.</p>

		<dl>
			<dt>Name</dt>
			<dd>
				<?php print $_POST["student_name"]; ?>
			</dd>

			<dt>Section</dt>
			<dd>
				<?php print $_POST["section"]; ?>
			</dd>

			<dt>Credit Card</dt>
			<dd>
				<?php 
					print $_POST["credit_card"];
					print " (".$_POST["payment_type"].")";
				?>
			</dd>
		</dl>
		<p>Here are all the suckers who have submitted here:<br></p>
		<?php
			$name = $_POST["student_name"];
			$section = $_POST["section"];
			$credit_card = $_POST["credit_card"];
			$credit_type = $_POST["payment_type"];

			$sucker_info = $name.";".$section.";".$credit_card.";".$credit_type."<br>";

			if (("" != trim($_POST['student_name'])) && ("" != trim($_POST['credit_card']))) {
				$filename = 'suckers.txt';
				$file = fopen($filename, 'a');

				if ($file == false) { echo "Can't open file"; }

				fwrite($file, $sucker_info);
				fclose($file);
			} else {
				header("Location: mistake.html");
				exit();
			}
		?>

		<?php
			$file = "suckers.txt";
			$suckers_list = file_get_contents($file);
			print $suckers_list;
		?>
	
 </body></html>