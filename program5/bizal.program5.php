<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Warehouse Order Summary</title>
	</head>
	<body>
		<h1>Bob’s Entertainment Warehouse Order Summary</h1>
		<?php
		// FILENAME: 	bizal.program5.php
		// AUTHOR: 		Marcus Bizal
		// DESCRIPTION: This program validates and gives feedback to the user
		//				after submitting an order from bizal.form5.php.

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			extract($_POST);

			if (empty($name))
			{
				die("Name is a required field! Please hit back in your browser to return to the form.");
			}

			$salutation = "";
			if ($gender == "male") $salutation = "Mr. ";
			else if ($gender == "female") $salutation = "Ms. ";

			print("<p>Thank you for your interest in Bob’s Entertainment Warehouse, " . $salutation . $name . "!</p>");

			if (!empty($id))
			{
				print(	"<p>In the future we will be able to provide you with more detailed information concerning your order.<br/>" .
						"For now, we can only provide a listing of your ordered books:<br/><ul>");

				foreach ($id as $id)
				{
					print("<li>" . $id . "</li>");
				}

				print("</ul></p>");
			}

			if ($member_status == "interested")
			{
				print(	"<p>Thank you for you interest in becoming a Bob’s Rewards Club Member!<br/>" .
						"We will be sending you more information regarding membership to your email address " . (!empty($email) ? "(" . $email . ") " : "") . "shortly!</p>");
			}
			else if ($member_status == "not_interested")
			{
				print( 	"<p>Are you SURE you're not interested in being a Bob’s Rewards Club Member?!<br />" .
						"Bob’s Rewards Club Members get access to <i>EXCLUSIVELY HUGE SAVINGS</i> for <b>ONLY $19.95 A MONTH!</b><br />" .
						"That's only <b>ONLY $19.95 A MONTH</b> for <i>EXCLUSIVELY HUGE SAVINGS</i>!</b><br />" .
						"Call 1-800-HUGESAVINGS today!</p>");
			}
			else if ($member_status == "current")
			{
				print( 	"<p>Thank you for supporting Bob’s Rewards Club, you're our favorite!<br />" .
						"You will be recieving new <i>EXCLUSIVELY HUGE SAVINGS</i> soon!</p>");
			}
		}
		else
		{
			die("Internal Error! We can only process POST requests.");
		}
		?>
	</body>
</html>
