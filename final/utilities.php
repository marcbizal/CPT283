<?php
	// FILENAME: 	utilities.php
	// AUTHOR: 		Marcus Bizal
	// DESCRIPTION: This file contains various utility functions for use throughout
	//				Bob’s Entertainment Universe.

	function cc_format($cc)
	{
		$cc_len = strlen($cc);
		if ($cc_len == 16)
		{
			$formatted_cc = "";
			for ($i = 0; $i < $cc_len; $i++)
			{
				if ($i > 0 && $i % 4 == 0) $formatted_cc .= "-";
				$formatted_cc .= $cc[$i];
			}
			return $formatted_cc;
		}
		else {
			print("Error: invalid credit card only contains " . $cc_len . " digits.");
		}
	}

	function mask($str, $n = 4, $mask = "*")
	{
		for ($i = strlen($str) - ($n + 1); $i >= 0; $i--)
		{
			if ($str[$i] != "-") $str[$i] = $mask;
		}
		return $str;
	}

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

	function createReceiptForIDs($link, $id_str)
	{
		$query = "SELECT products.title, prodinv.UnitPrice FROM products INNER JOIN prodinv ON products.ID = prodinv.ID WHERE products.ID IN ($id_str);";

		createTableFromSQLResults(
									array("Title", "Price"),
									mysqli_query($link, $query),
									false,
									array("UnitPrice")
								);

		$query = "SELECT SUM(UnitPrice) AS total FROM prodinv WHERE ID IN ($id_str);";
		$order_total = mysqli_fetch_assoc(mysqli_query($link, $query))["total"];

		print(wrapWithTag("h2", "Order total: " . money_format($order_total)));
	}

	function verifyPOST($required)
	{
		if (!is_array($required)) $required = array($required);
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$not_found = array();
			foreach ($required as $r)
			{
				if (empty($_POST[$r])) array_push($not_found, $r);
			}

			if (!empty($not_found))
			{
				die("Required POST variables - " . implode(", ", $not_found) . " - not found!<br>Please hit back in your browser to return to the form.");
			}
		}
		else
		{
			die("This page expects POST data!<br>Please hit back in your browser to return to the form.");
		}
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
