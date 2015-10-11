<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Universe Order Summary</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.bobs3.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: Invites the customer to make their final selections
			//				for the items they wish to purchase.

			include "utilities.php";
			include "serverdetails.php";

			verifyPOST("department");
			extract($_POST);

			$link = establishConnectionToDB("cpt283db");
		?>
		<h1>Bob’s Entertainment Universe <?php echo $department; ?> Order Summary</h1>
		<p>Please confirm your order below by checking the boxes next to the items you wish to purchase.</p>
		<form action="bizal.bobs4.php" method="post">
			<?php
				$id_str = implode(",", $ID);

// SQL Query Heredoc
$query = <<<SQL
SELECT products.ID, products.entertainerauthor, products.title, prodinv.UnitPrice, prodinv.UnitsInStock, products.summary
FROM products
INNER JOIN prodinv
ON products.ID = prodinv.ID
WHERE products.department = "{$department}"
AND products.ID IN ({$id_str})
ORDER BY products.entertainerauthor;
SQL;

				createTableFromSQLResults(
											array("Select", "ID", "Entertainer/Author", "Title", "Price", "Units In Stock", "Summary"),
											mysqli_query($link, $query),
											true,
											array("UnitPrice")
										);

				mysqli_close($link);
			?>
			<br/>
			<input type="hidden" name="department" value="<? echo $department; ?>">
			<button type="submit" value="Submit">Order</button>
			<button type="reset" value="Reset">Reset</button>
		</form>
	</body>
</html>
