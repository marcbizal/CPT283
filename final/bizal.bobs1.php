<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bob’s Entertainment Universe Department Select</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<form action="bizal.bobs2.php" method="post">
		<?php
			// FILENAME: 	bizal.bobs1.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: This program fetches a list of departments from
			//				the database and prompts the user to choose one.

			include "utilities.php";
			include "serverdetails.php";

			$link = establishConnectionToDB("cpt283db");
		?>
		<h1>Bob’s Entertainment Universe Department Select</h1>
		<b>Shop Department:</b>
		<ul>
			<?php
				$query = "SELECT DISTINCT department FROM products";
				$results = mysqli_query($link, $query);
				mysqli_close($link);

				while($result = mysqli_fetch_assoc($results))
				{
					print(wrapWithTag("li", getRadio("department", $result["department"]) . $result["department"]));
				}
			?>
		</ul>
		<button type="submit" value="Submit">Submit</button>
	</form>
</body>
</html>
