<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Emporium Request Summary</title>
	</head>
	<body>
		<h1>Bob’s Entertainment Emporium Request Summary</h1>
		<?php
		// FILENAME: 	bizal.bobs2.php
		// AUTHOR: 		Marcus Bizal
		// DESCRIPTION: This program validates and gives feedback to the user
		//				after submitting an request from bizal.bobs1.php.

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			extract($_POST);

			if (!empty($ID))
			{
				print(	"<p>In the future we will be able to provide you with more detailed information concerning your request.<br/>" .
						"For now, we can only provide a listing of items you requested:<br/><ul>");

				foreach ($ID as $ID)
				{
					print("<li>" . $ID . "</li>");
				}

				print("</ul></p>");
			}
			else
			{
				die("No items were selected. Please hit back in your browser to return to the form.");
			}
		}
		else
		{
			die("Internal Error! We can only process POST requests.");
		}
		?>
	</body>
</html>
