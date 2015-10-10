<?php
	// FILENAME: 	utilities.php
	// AUTHOR: 		Marcus Bizal
	// DESCRIPTION: This file contains various utility functions for use throughout
	//				Bob’s Entertainment Universe.

	function money_format($number)
	{
		return '$' . number_format((double)$number, 2, '.', ',');
	}

	function wrapWithTag($tag, $string)
	{
		return "<" . $tag . ">" . $string . "</" . $tag . ">";
	}

	function getCheckbox($name, $value)
	{
		return "<input type=\"checkbox\" name=\"$name\" value=\"$value\">";
	}

	function getRadio($name, $value)
	{
		return "<input type=\"radio\" name=\"$name\" value=\"$value\">";
	}

	function passVariable($name, $value)
	{
		print("<input type=\"hidden\" name=\"$name\" value=\"$value\">");
	}

	function createTableFromSQLResults($headers, $results, $withCheckboxes = false, $formatted = array())
	{
		print("<table><tr>");
		foreach ($headers as $header)
		{
			print(wrapWithTag("th", $header));
		}
		print("</tr>");

		while($object = mysqli_fetch_assoc($results)) {
			print("<tr>");

			foreach ($object as $key => $value)
			{
				if ($withCheckboxes && $key == "ID")
				{
					print(wrapWithTag("td", getCheckbox($key . "[]", $value)));
				}

				print(wrapWithTag("td", in_array($key, $formatted) ? money_format($value) : $value));
			}

			print("</tr>");
		}
		print("</table>");
	}

	// This function basically just handles the typical error handling
	// associated with establishing a database connection.
	function establishConnectionToDB($db)
	{
		$link = mysqli_connect(MYSQL_SERVERNAME, MYSQL_USERNAME, MYSQL_PASSWORD);

		if (!$link)
		{
			die("Connection failed: " . mysqli_connect_error());
		}

		if (!mysqli_select_db ($link, $db))
		{
			die("Problem with the database: " . mysqli_error($link));
		}

		return $link;
	}
?>
