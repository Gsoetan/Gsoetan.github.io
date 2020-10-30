<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>Order confirmation</title>
</head>
<body>
	<h1>Henry's Fav Resturant</h1>
	<h2>Order Results</h2>
	<p>Order Processed at: 
		<?php
			date_default_timezone_set("America/New_York");
			echo date("H:i, jS M Y") 
		?>
		<br>
	</p>
	<p>Your order is as follows: <br></p>

	<?php 
	$bones = $_POST["Plate1"];
	$STK = $_POST["Plate2"];
	$CLB = $_POST["Plate3"];
	$referral = $_POST["find"];

	$bones_price = 2100;
	$STK_price = 199;
	$CLB_price = 899;
	$tax = 0.1;

	$subtotal = ($bones * $bones_price) + ($STK * $STK_price) + ($CLB * $CLB_price);
	$total = ($subtotal * $tax) + ($subtotal); 

	$total_ordered = $bones + $STK + $CLB;

	echo "Plates Ordered: ".$total_ordered."<br>";
	if ($total_ordered == 0) {
		echo "You did not order anything on the previous page!<br>";
	}

	echo "Subtotal: $".number_format($subtotal, 2, '.', ',')."<br>";
	echo "Total including tax: $".number_format($total, 2, '.', ',')."<br><br>";
	echo "Customer referred by ".$referral;
		
?>

</body>
</html>
