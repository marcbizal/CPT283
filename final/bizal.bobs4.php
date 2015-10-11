<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Universe Order Total</title>
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

			verifyPOST("department");
			extract($_POST);

			$link = establishConnectionToDB("cpt283db");
		?>
		<h1>Bob’s Entertainment Universe <? echo $department; ?> Order Total</h1>
		<p>Thank you for shopping on Bob’s Entertainment Universe, we appreciate your business!</p>
		<?php
			$id_str = implode(",", $ID);
			createReceiptForIDs($link, $id_str);
			mysqli_close($link);
		?>
		<form action="bizal.bobs5.php" method="post">
			<fieldset>
    			<legend>Address:</legend>
				Full Name: <input type="text" name="fullname" value=""><br>
				Address: <input type="text" name="address" value=""><br>
				City: <input type="text" name="city" value=""><br>
				State: <input type="text" name="state" value="" maxlength="2" size="2"><br>
				ZIP: <input type="text" name="zip" value="" maxlength="5" size="5"><br>
			</fieldset>
			<br><br>
			<fieldset>
    			<legend>Payment Info:</legend>
				Card Type:
				<select name="card_type">
					<option></option>
					<option value="VISA">VISA</option>
					<option value="Mastercard">Mastercard</option>
					<option value="American Express">American Express</option>
				</select><br>
				Card Number:
				<input type="text" name="card_number" value="" maxlength="16" size="16"><br>
				Security Code:
				<input type="text" name="security_code" value="" maxlength="4" size="4"><br>
			</fieldset>
			<br><br>
			<?php
				passVariable("id_str", $id_str);
			?>
			<button type="submit" value="Submit">Finish</button>
			<button type="reset" value="Reset">Reset</button>
		</form>
	</body>
</html>
