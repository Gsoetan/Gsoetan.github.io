<!DOCTYPE html>
<!-- Extra features done: 1 & 2 & 3 -->
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome Page</title>
	<link rel="stylesheet" type="text/css" href="css/nerdluv.css">
</head>
<body>
	<?php
	if ("" == trim($_POST['name'])) {
		header("Location: mistake.php");
		exit();
	}
	  ?>
	<img src="images/logo.png" id="bannerarea" alt="nerdluv logo">

	<h1>Thank you!</h1>
	<p>
		Welcome to NerdLuv, <?php echo $_POST["name"] ?>
	</p>

	<p>
		Now <a href="matches.php">login to see your matches!</a>
	</p>

	<?php
		include 'common.php';
		genFooter();
	  ?>

	<?php
		foreach ($GLOBALS['singlesArray'] as $key => $value) {
			if ($_POST['name'] == $key) {
				header("Location: mistake.php");
				exit();
			}
		}

		$name = $_POST["name"]; // name checked at the top
		$gender = $_POST["gender"]; // gender only has radio buttons

		// verify age
		if (preg_match("/(\d){1,2}/i", $_POST["age"]) != 1) {
			header("Location: mistake.php");
			exit();
		} elseif ((intval($_POST["age"]) < 0) || (intval($_POST["age"]) > 99)) {
			header("Location: mistake.php");
			exit();
		} else { $age = $_POST["age"]; }

		// verify personality 
		$personality_split = str_split($_POST["person_type"]);
		if ((strcasecmp($personality_split[0], "i") != 0) && (strcasecmp($personality_split[0], "e") != 0)) {
			header("Location: mistake.php");
			exit();
		} elseif ((strcasecmp($personality_split[1], "n") != 0) && (strcasecmp($personality_split[1], "s") != 0)) {
			header("Location: mistake.php");
			exit();
		} elseif ((strcasecmp($personality_split[2], "f") != 0) && (strcasecmp($personality_split[2], "t") != 0)) {
			header("Location: mistake.php");
			exit();
		} elseif ((strcasecmp($personality_split[3], "j") != 0) && (strcasecmp($personality_split[3], "p") != 0)) {
			header("Location: mistake.php");
			exit();
		} else { $personality = strtoupper($_POST["person_type"]); }


		$fav_os = $_POST["OS_type"]; // only 1 OS can be choosen from the list (verification is handled by that)

		// verify age range
		$max_age_check = false;
		$min_age_check = false;

		if (preg_match("/(\d){1,2}/i", $_POST["age_max"]) != 1) {
			header("Location: mistake.php");
			exit();
		} elseif ((intval($_POST["age_max"]) < 0) || (intval($_POST["age_max"]) > 99)) {
			header("Location: mistake.php");
			exit();
		} else { $max_age_check = true; } 

		if (preg_match("/(\d){1,2}/i", $_POST["age_min"]) != 1) {
			header("Location: mistake.php");
			exit();
		} elseif ((intval($_POST["age_min"]) < 0) || (intval($_POST["age_min"]) > 99)) {
			header("Location: mistake.php");
			exit();
		} else { $min_age_check = true; }

		if (($max_age_check == $min_age_check) && (intval($_POST["age_max"]) > intval($_POST["age_min"]))) {
			$min_age = $_POST["age_min"];
			$max_age = $_POST["age_max"];
		} else {
			header("Location: mistake.php");
			exit();
		}

		// get preferences and verify
		$preference = "";
		$temp_arr = $_POST["gender_preference"];
		if (empty($temp_arr)) { 
			header("Location: mistake.php");
			exit(); 
		}
		else {
			foreach ($temp_arr as $pref) {
				$preference .= $pref;
			}
		}

		// file upload set up
		$target_dir = "pfp/";
		$file_full_name = $_FILES["pfp"]["name"];
		$file_base = substr($file_full_name, 0, strripos($file_full_name,'.')); // get file name
		$file_extension = substr($file_full_name, strripos($file_full_name, '.')); // get file extension
		

		$name_formated = str_replace(" ", "_", trim($name)); // for file retrieval
		$file_renamed = $name_formated.$file_extension;

		$target_file = $target_dir.$file_renamed;
		move_uploaded_file($_FILES["pfp"]["tmp_name"], $target_file);

		$single_nerd = PHP_EOL.$name.",".$gender.",".$age.",".$personality.",".$fav_os.",".$min_age.",".$max_age.",".$preference;

		$filename = './text/singles2.txt';
		$file = fopen($filename, 'a');

		if ($file == false) { echo "Can't open file"; }

		fwrite($file, $single_nerd);
		fclose($file);
	?>

</body>
</html>