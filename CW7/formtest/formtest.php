<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
  <title>Form Data</title>
</head>
<body>

<h1>Raw Form Data</h1>
<pre>
<?php
   print_r($_POST);  // this prints the associative array for debugging
?>
</pre>

<!-- Extract each form item from posted data -->

<h1>Form input values</h1>
<p>Your Name: 
	<?php print $_POST["visitor_name"] ?>
</p>
<p>Password: 
	<?php print $_POST["password"] ?>
</p>
<p>License accepted: 
	<?php print $_POST["licenseOK"] ?>
</p>
<p>Account type: 
	<?php print $_POST["account_type"] ?>
</p>
<p>Options: 
	<!-- <?php print $_POST["options"] ?> -->
	<?php
		$string = "";
		foreach ($_POST['options'] as $options){
			$string = $string.$options.", ";
		}
		$string = rtrim(trim($string), ',');
		print "$string\n";
	?>
</p>
<p>Operating system: 
	<?php print $_POST["system"] ?>
</p>
<p>Remarks: 
	<?php print $_POST["remarks"] ?>
</p>

<!-- Run thru all elements of the array of posted data -->

<h1>All Form Data</h1>

<?php
    foreach($_POST as $key=>$val){
		if ($key == 'options') {
			$string = "";
			foreach ($_POST['options'] as $options){
				$string = $string.$options.", ";
			}
			$string = rtrim(trim($string), ',');
			print "<p>$key = $string\n</p>";
    	} else {
        	print "<p>$key = $val\n</p>";
    	}
    }
?>

</body>
</html>
