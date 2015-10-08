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
		<h1>Bob's Rental Cars - Inventory</h1>
		<table>
			<tr>
				<th>Vehicle	</th>
				<th>Year</th>
				<th>Serial #</th>
				<th>Rental Cost</th>
				<th>Days Out</th>
				<th>Revenue</th>
				<th>Original Price</th>
				<th>Mileage</th>
				<th>Notes</th>
			</tr>
			<?php
				// FILENAME: 	bizal.program4.php
				// AUTHOR: 		Marcus Bizal
				// DESCRIPTION: This program is meant to assist with book keeping.
				//				It will display a table of all rental cars and their
				//				gross revenue, mileage, notes, etc..

				include 'bobsinventory.php';
				define("VEHICLE_FIELDS", 11);

				// FUNCTIONS
				function money_format($number)
				{
					return '$' . number_format((double)$number, 2, '.', ',');
				}

				function wrapWithTag($tag, $string)
				{
					return "<" . $tag . ">" . $string . "</" . $tag . ">";
				}

				function parseVehicleFromData(&$vehicle, &$keys, &$data = NULL, $initial = false)
				{
					for ($i = 0; $i < VEHICLE_FIELDS; $i++)
					{
						if ($initial) {
							if ($data !== NULL)
							{
								$vehicle[$keys[$i]] = strtok($data, " ");
								$initial = false;
								continue;
							}
							else
							{
								die("Please supply data to `parseVehicleFromData()`!\n");
							}
						}

						if ($i == VEHICLE_FIELDS - 1)
						{
							$vehicle[$keys[$i]] = strtok("\n");
						}
						else
						{
							$vehicle[$keys[$i]] = strtok(" ");
						}
					}
				}

				$object_keys = array(
					"name",
					"year",
					"serial",
					"seats",
					"rent",
					"days_rented",
					"revenue",
					"price",
					"mileage",
					"depreciation_factor",
					"maintenance_interval"
				);

				$vehicle = array();
				$ignore = array("seats", "depreciation_factor", "maintenance_interval");
				$formatted = array("rent", "revenue", "price");

				$total_days = 0;
				$total_revenue = 0.0;

				parseVehicleFromData($vehicle, $object_keys, $data, true);
				while ($vehicle["name"])
				{
					print("<tr>");

					foreach ($vehicle as $key => $value)
					{
						if (in_array($key, $ignore)) continue;
						print(wrapWithTag("td", in_array($key, $formatted) ? money_format($value) : $value));
					}

					$notes = "";
					if ($vehicle["mileage"] > 100000) $notes .= "I";
					if ($vehicle["days_rented"] < 10) $notes .= "L";
					print(wrapWithTag("td", $notes));

					print("</tr>");

					$total_days += $vehicle["days_rented"];
					$total_revenue += $vehicle["revenue"];

					parseVehicleFromData($vehicle, $object_keys);
				}
			?>
		</table>
		<p>
			Total Days Rented: <b><? print($total_days); ?> days</b><br/>
			Total Revenue: <b><? print(money_format($total_revenue)); ?></b><br/>
		</p>
	</body>
</html>
