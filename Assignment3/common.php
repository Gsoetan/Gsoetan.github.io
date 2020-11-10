<!-- Extra features done: 1 & 2 & 3 -->
	<?php 
		// Global Variables
		$singlesArray = array();

		function getSinglesArray() {
			$filelocation = "text/singles2.txt";
			$file = fopen($filelocation, "r");
			
			if ($file = fopen($filelocation, "r")) {
				while (!feof($file)) {
					 $line = fgets($file);
					 $line_exp = explode(",", $line);
					 $person_key = ""; // the name of the person
					 $person_details = []; // the person's details in an array
					 for ($i=0; $i < count($line_exp); $i++) { 
					 	// take the first element and separate from the rest
					 	if ($i == 0) {$person_key = $line_exp[$i];}
					 	else {$person_details[$i-1] = $line_exp[$i];}

					 }
					 $temp_arr[$person_key] = $person_details;
					 $GLOBALS['singlesArray'] = $temp_arr;
				}
			} else { echo "error reading file"; }
		}
		getSinglesArray();

		function getMatches($name) {
			$bach_name = "";
			$bach_details = []; // person's details
			foreach ($GLOBALS['singlesArray'] as $key => $value) {
				if ($key == $name) { 
					$bach_name = $key;
					$bach_details = $value;
				}
			}
			if ($bach_name == "") {
				header("Location: mistake.php");
				exit();
			}

			// start checking for matches
			foreach ($GLOBALS['singlesArray'] as $key => $value) {
				$match_name = $key;
				$match_details = $value;
				$match_criteria = []; // array of numbers, 1 is match 0 is not
				$name_formated = str_replace(" ", "_", trim($match_name)); // format for image pullup
				$is_match = false;

				$bach_perf = array_pad(str_split(trim($bach_details[6])), 2, ""); // account for if the match only has one perference

				if ($match_name == $bach_name) { continue; }

				// check for different sexes
				if (($match_details[0] == $bach_perf[0]) || ($match_details[0] == $bach_perf[1])) {
					// it's a match!
					$match_criteria[0] = 1;
				} else { $match_criteria[0] = 0;}

				// start check for age compatability 
				if (($match_details[1] >= $bach_details[4]) && ($match_details[1] <= $bach_details[5])) {
					$match_criteria[1] = 1;
				} else { $match_criteria[1] = 0; }

				// start check for personality similarities
				$match_split = str_split($match_details[2]);
				$bach_split = str_split($bach_details[2]);

				$personality_sim_string = "";

				for ($i=0; $i < 4; $i++) { 
					if (strcasecmp($match_split[$i], $bach_split[$i]) == 0) {
						$personality_sim_string .= $match_split[$i];
					}
				}
				if (strlen($personality_sim_string) >= 1) {
					$match_criteria[2] = 1;
				} else { $match_criteria[2] = 0;}

				// start check for OS similarities
				if (strcasecmp($match_details[3], $bach_details[3]) == 0) { $match_criteria[3] = 1; }
				else { $match_criteria[3] = 0; }

				// check similarity array
				if (!in_array(0, $match_criteria, true)) {
					// this code below is used for debugging comparisons
// $body = <<<EOT
// <div class="match">
// <p><img src="./images/user.jpg" id="user">{$match_name}</p>
// <p>
// 	<ul sytle="list-style-type:circle;">
// 		<li>{$match_details[0]} compared to {$bach_details[0]}</li>
// 		<li>{$match_details[1]} compared to {$bach_details[4]} and {$bach_details[5]}</li>
// 		<li>{$match_details[2]} compared to {$bach_details[2]}</li>
// 		<li>{$match_details[3]} compared to {$bach_details[3]}</li>
// 	</ul>
// </p>
// </div>
// EOT;
// 	echo $body;

$match = <<<EOT
<div class="match">
	<p><img src="pfp/{$name_formated}.png" alt="{$name_formated} pfp">{$match_name}</p>
		<ul>
			<li><strong>gender:</strong>{$match_details[0]}</li>
			<li><strong>age:</strong>{$match_details[1]}</li>
			<li><strong>type:</strong>{$match_details[2]}</li>
			<li><strong>OS:</strong>{$match_details[3]}</li>
		</ul>
</div>

EOT;
	echo $match;
				}
			}
		}

		function genFooter (){
$footer = <<<EOT
<p>
	The page is for single nerds to meet and date each other! Type<br> in your personal information and wait for the nerdly luv to begin!<br> Thank you for using our site.
	<br><br>
	Results and page (C) Copyright NerdLuv Inc.
</p>

<a href="nerdluv.php"><img src="images/back.jpg" style="width: 20px; height: 20px; vertical-align: text-top;" alt="back img"> Back to front page</a>

<div id="w3c" style="margin-top: 3em;">
	<a href="https://validator.w3.org"><img src="images/w3c-xhtml.png" alt="w3c-html"></a>
	<a href="https://jigsaw.w3.org/css-validator/"><img src="images/w3c-css.png" alt="w3c-cc"></a>
</div>
EOT;
	echo $footer;
		}
	?>
