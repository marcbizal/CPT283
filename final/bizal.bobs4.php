<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Universe Order Total</title>
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.bobs3.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: This program will sum the order confirmed in
			//				bizal.bobs2.php.

			include "utilities.php";
			include "setup.php";
		?>
		<h1>Bob’s Entertainment Universe <? echo $department; ?> Order Total</h1>
		<p>Thank you for shopping on Bob’s Entertainment Universe, we appreciate your business!</p>
		<?php
					$id_str = implode(",", $ID);
					$query = "SELECT UnitPrice FROM prodinv WHERE ID IN ($id_str);";

					$results = mysqli_query($link, $query);
					mysqli_close($link);

					$order_total = 0;
					while($item = mysqli_fetch_assoc($results))
					{
						$order_total += $item["UnitPrice"];
					}

					print(wrapWithTag("h2", "Your order total is: " . money_format($order_total)));
		?>
	</body>
</html>
