<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Universe Order Receipt</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.bobs5.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: Creates a final printable receipt for the user.

			include "utilities.php";
			include "serverdetails.php";

			verifyPOST(array("fullname", "address", "city", "state", "zip", "card_type", "card_number", "security_code"));
			extract($_POST);

			$link = establishConnectionToDB("cpt283db");
		?>
		<h1>Bob’s Entertainment Universe Order Receipt</h1>
		<p>Thank you for shopping on Bob’s Entertainment Universe, we appreciate your business!<br/>
		Your payment has processed and we will be preparing to ship your order shortly!<br>
		Here is a a printable copy of your recipt. We look forward to seeing you again!</p>
		<h2>Order Details</h2>
		<b>Payment Method:</b><br>
		<?php print($card_type . " - " . format_cc(mask($card_number, 4, "X")) . "<br><br>"); ?>
		<b>Shipping Address</b><br>
		<?php print("$fullname<br>$address<br>$city, $state $zip<br><br>"); ?>
		<?php
			createReceiptForIDs($link, $id_str);
			mysqli_close($link);
		?>
		<form action="bizal.bobs1.php">
			<button name="print" onclick="window.print();">Print Receipt</button>
			<button type="submit" value="back">Back to Shop</button>
		</form>
	</body>
</html>
