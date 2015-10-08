<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bob’s Rental Cars</title>
		<style>

			table {
	    		border-collapse: collapse;
			}

			table, th, td {
				border: 1px solid black;
				padding: 0.5em;
			}

		</style>
	</head>
	<body>
		<?php
			// FILENAME: bizal.program3.php
			// AUTHOR: Marcus Bizal
			// DESCRIPTION: This program is meant to assist with book keeping.
			//				It will display a table of all rental cars and their
			//				gross revenue, as well as create depreciation tables
			//				for the rental cars. Finally, it includes one function
			//				to calculate a monthly payment on a loan.
			//
			// TODO: 		Add some sort of enumeration for the vehicle
			//				fields so that they can be accessed by some
			//				sort of key, rather than having to remember
			//				indices.

			include 'bobscars.php';

			// NAMED CONSTANTS
			define("VEHICLE_FIELDS", 9);

			// FUNCTIONS
			function money_format($number)
			{
				return '$' . number_format((double)$number, 2, '.', ',');
			}

			function wrapWithTag($tag, $string)
			{
				return "<" . $tag . ">" . $string . "</" . $tag . ">";
			}

			function arrayFromIndices($indices, $array)
			{
				$newArray = array();
				foreach ($indices as $index)
				{
					array_push($newArray, $array[$index]);
				}

				return $newArray;
			}

			function formatElements($indices, $array, $func = "money_format")
			{
				foreach ($indices as $index)
				{
					$array[$index] = call_user_func($func, $array[$index]);
				}

				return $array;
			}

			function arrayToRow($array, $header = false)
			{
				$headOrData = $header ? 'h' : 'd';
				$cells = "\n";

				foreach ($array as $element)
				{
					$cells .= "\t" . wrapWithTag('t' . $headOrData, $element) . "\n";
				}

				return wrapWithTag("tr", $cells) . "\n";
			}

			function createDepreciationTable($vehicle, $years = 5)
			{
				print("<table>\n");

				$name = $vehicle[0];
				$year = $vehicle[1];
				$startingValue = $vehicle[6];
				$factor = $vehicle[7];
				$depreciation = $startingValue * $factor;
				$endingValue = $startingValue - $depreciation;

				print(wrapWithTag("h2", $name . " – Depreciation over " . $years . "-year period (Factor: " . $factor . ")") . "\n");
				print(arrayToRow(array(
					"Year",
					"Starting Value",
					"Depreciation",
					"Ending Value"
				), true));

				for ($i = 0; $i < $years; $i++)
				{
					print(arrayToRow(array(
						$year,
						money_format($startingValue),
						money_format($depreciation),
						money_format($endingValue)
					)));

					$year++;
					$startingValue = $endingValue;
					$depreciation = $startingValue * $factor;
					$endingValue = $startingValue - $depreciation;
				}

				print("</table>\n");
			}

			function calculateMonthyPayment($principal, $years, $annualRate)
			{
				$rate = $annualRate / 12;
				$n = $years * 12;

				return $principal * ($rate + ($rate / ((1 + $rate)^$n - 1)));
			}

			// VARIABLES
			$vehicles = array();
			$fields = array(
				"Vehicle",
				"Year",
				"Serial #",
				"Seats",
				"Rental cost",
				"Days rented",
				"Orig price",
				"Deprec factor",
				"Sked mx interval"
			);

			$line = strtok($data, "\n");
			$lineNum = 0;

			// Parse the `$data` variable, iterating through lines.
			// Create an array of vehicle "objects" (really just arrays).
			while ($line !== false)
			{
				$vehicles[floor($lineNum / VEHICLE_FIELDS)][$lineNum % VEHICLE_FIELDS] = rtrim($line);
				$line = strtok("\n");
				$lineNum++;
			}

			// If the last vehicle doesn't have the proper number of fields,
			// something has probably gone wrong, or the file is invalid.
			if (sizeof(end($vehicles)) !== VEHICLE_FIELDS)
			{
				die("An error occured in parsing; the vehicle list may be invalid!");
			}

			print("<table>");

			// Print the table header
			$headerRow = arrayFromIndices(array(0, 1, 2, 4, 5), $fields);
			array_push($headerRow, "Rental Revenue");
			print(arrayToRow($headerRow, true));

			// Print another row for each vehicle
			$moneyIndices = array(3, 4, 5);
			foreach ($vehicles as $vehicle)
			{
				$row = arrayFromIndices(array(0, 1, 2, 4, 5), $vehicle);
				array_push($row, (double)$row[3] * (double)$row[4]);
				print(arrayToRow(formatElements($moneyIndices, $row)));
			}

			print("</table>");

			createDepreciationTable($vehicles[0]);
			createDepreciationTable($vehicles[3]);

			print(wrapWithTag("h4", "Monthly Loan Payment: " . money_format(calculateMonthyPayment(179500, 15, .05))));
		?>
	</body>
</html>
