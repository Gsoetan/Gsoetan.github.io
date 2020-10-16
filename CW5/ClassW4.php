<!DOCTYPE html>
<html>
<head>
	<title>Class Work 4</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>PHP Class work 04 Part 1</h1>
	<?php 
		echo rand(1,10).'<br>';
		echo 'this is a test!<br>';
		echo rand(1,10).'<br>';
		echo 'rand(1,10)<br>';
		echo rand(1,50).'<br>';
	?>

	<br>
	<p>***Exercise 1***</p>

	<?php
		function hello_world(){ echo 'Hello World!'; }
		hello_world()
	?>

	<br>
	<p>***Exercise 2***</p>

	<?php
		function exe2() {
			for ($i = 0; $i < 5; $i++){
    			for ($j = $i+1; $j > 0; $j--){
    				echo '*';
        		}
        		echo '<br>';
    		}
		}	
		exe2()
	?>

	<br>
	<p>***Exercise 3***</p>

	<?php
		function exe3($count) {
			for ($i = 0; $i < $count; $i++){
    			for ($j = $i+1; $j > 0; $j--){
    				echo '*';
        		}
        		echo '<br>';
   			}
		}
		exe3(6)
	?>

	<br>
	<?php exe3(10) ?>
	<br>
	<p>***Exercise 4***</p>


	<?php
		function word_count($sentence) {
			echo $sentence.': ';
			$sentence = trim($sentence);
    		$count = substr_count($sentence, ' ');
    		$count = $count + 1;
    		print($count);
		}
		word_count('Hello, how are you?')
	?>

	<br>
	<p>***Exercise 5***</p>

	<?php
		function countWords($sentence)	{
			$sentence = strtolower($sentence);
   			$list = explode(' ', $sentence);
    		for ($i = 0; $i < count($list); $i++){
    			$count = 1;
        		for ($j = $i+1; $j < count($list); $j++){
        			if ($list[$i] == $list[$j]){
            			$count++;
                		$list[$j] = "_";
            		}
        		}
        		if ($count > 0 && $list[$i] != "_") { 
        			print('<br>'.$list[$i].' = '.$count); 
        		}
    		}
		}
		countWords('Hello Hello Hello looky look what we have here here')
	?>

	<br>
	<br>
	<p>***Exercise 6***</p>

	<?php
		function remove_all($sentence, $char) {
			$broken = str_split($sentence, 1);
    		$new_string = '';
    		for ($i = 0; $i < count($broken); $i++){
    			if (strtolower($broken[$i]) == $char){ continue; }
        		else { print($broken[$i]); }
    		}
		}
		remove_all('Summer is herE!', 'e')
	?>

</body>
</html>