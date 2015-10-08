<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Entertainment Emporium Department Summary</title>
		<style>

			table {
				border-collapse: collapse;
			}

			th {
				text-transform: uppercase;
			}

			table, th, td {
				padding: 0.5em;
			}

			tr:nth-child(2n+3) {
				background: #f2f2f2;
			}

		</style>
	</head>


	<body>
			<?php
				// FILENAME: 	bizal.bobs1.php
				// AUTHOR: 		Marcus Bizal
				// DESCRIPTION: This program takes a post request and 
				//				creates a dynamic formatted list
				//				of inventory for Bob’s Entertainment Emporium
				//				for the selected department and enables
				//				a selection for ordering.

				define("MYSQL_SERVERNAME", "localhost");
				define("MYSQL_USERNAME", "root");
				define("MYSQL_PASSWORD", "06rI072XtYeMM#&j");

				// FUNCTIONS
				function wrapWithTag($tag, $string)
				{
					return "<" . $tag . ">" . $string . "</" . $tag . ">";
				}

				function getCheckbox($name, $value)
				{
					return "<input type=\"checkbox\" name=" . $name . " value=" . $value . " />";
				}

				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					extract($_POST);

					if (!empty($department))
					{

// Open Form Heredoc
print <<<EOT
	<h1>Bob’s Entertainment Emporium {$department} Department Summary</h1>
	<form action="bizal.bobs2.php" method="post">
		<table>
			<tr>
				<th>Select</th>
				<th>ID</th>
				<th>Author</th>
				<th>Title</th>
				<th>Media</th>
				<th>Feature</th>
			</tr>
EOT;

						$link = mysqli_connect(MYSQL_SERVERNAME, MYSQL_USERNAME, MYSQL_PASSWORD);
						if (!$link)
						{
							die("Connection failed: " . mysqli_connect_error());
						}

						if (!mysqli_select_db ($link, "cpt283db"))
						{
							die("Problem with the database: " . mysqli_error($link));
						}

						$results = mysqli_query($link, "SELECT ID, entertainerauthor, title, media, feature FROM products WHERE department = \"$department\"");

						while($object = mysqli_fetch_assoc($results)) {
							print("<tr>");

							foreach ($object as $key => $value)
							{
								if ($key == "ID")
								{
									print(wrapWithTag("td", getCheckbox($key . "[]", $value)));
								}
								print(wrapWithTag("td", $value));
							}

							print("</tr>");
						}

// Close Form Heredoc
print <<<EOT
		</table><br />
		<button type="submit" value="Submit">Submit</button>
		<button type="reset" value="Reset">Reset</button>
	</form>
EOT;

						mysqli_close($link);
					}
					else
					{
						die("You must select a department! Please hit back in your browser to return to the form.");
					}
				}
			?>
	</body>
</html>
