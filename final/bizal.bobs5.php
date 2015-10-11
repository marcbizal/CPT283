<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Universe Order Receipt</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.bobs4.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: This program will sum the order confirmed in
			//				bizal.bobs4.php.

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
		<?php print($card_type . " - " . cc_format(mask($card_number, 4, "X")) . "<br><br>"); ?>
		<b>Shipping Address</b><br>
		<?php print("$fullname<br>$address<br>$city, $state $zip<br><br>"); ?>
		<?php
			createReceiptForIDs($link, $id_str);
			mysqli_close($link);
		?>
		</form>
	</body>
</html>
