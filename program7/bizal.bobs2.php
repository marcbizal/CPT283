<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment SuperSite Request Summary</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.bobs2.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: Invites the customer to make their final selections
			//				for the items they wish to purchase.

			include "serverdetails.php";
			include "utilities.php";

			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				extract($_POST);

				if (!empty($department))
				{
					$link = establishConnectionToDB("cpt283db");
				}
				else
				{
					die("You must select a department! Please hit back in your browser to return to the form.");
				}
			}
		?>
		<h1>Bob’s Entertainment SuperSite <?php echo $department; ?> Department Summary</h1>
		<form action="bizal.bobs2.php" method="post">
			<?php
				$id_str = implode(",", $ID);

// SQL Query Heredoc
$query = <<<SQL
SELECT products.ID, products.entertainerauthor, products.title, prodinv.UnitPrice, prodinv.UnitsInStock, products.summary
FROM products
INNER JOIN prodinv
ON products.ID = prodinv.ID
WHERE products.department = "{$department}"
AND products.ID IN ({$id_str});
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
			<button type="submit" value="Submit">Submit</button>
			<button type="reset" value="Reset">Reset</button>
		</form>
	</body>
</html>
