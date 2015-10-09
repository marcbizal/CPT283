<?php

	// This standard setup has to be for all bizal.bobs*.php files.

	include "serverdetails.php";

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
	else
	{
		die("This page expects POST data! Please return to the <a href=\"bizal.form7.php\">form</a>.");
	}

?>
