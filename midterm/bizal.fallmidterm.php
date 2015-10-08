<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
	<head>
		<title>[former owner]'s Revenue Listing'</title>
	</head>
	<body>
		<pre><?php
				// FILENAME: 	bizal.fallmidterm.php
				// AUTHOR: 		Marcus Bizal
				// DESCRIPTION: To process and display revenue for all 12
				//				months of the year, as well as the total
				//				revenue for all 12 months, and the lowest.

				// FUNCTIONS
				function money_format($number)
				{
					return '$' . number_format((double)$number, 2, '.', ',');
				}

				// VARIABLES
				$monthlyRevenue =  array(
					'1' => 3928.10,
                	'2' => 947.00,
                    '3' => 721.93,
                    '4' => 1082.00,
                    '5' => 6201.00,
                    '6' => 10200.33,
                    '7' => 7290.35,
                    '8' => 6002.93,
                    '9' => 3803.30,
                    '10'=> 1012.30,
                    '11'=> 839.90,
                    '12'=> 793.85
				);

				// Array with indices starting at 1.
				$monthNames = array(
					1 => "January",
					"February",
					"March",
					"April",
					"May",
					"June",
					"July",
					"August",
					"September",
					"October",
					"November",
					"December"
				);

				// $lowestRevenue should only have to be adjusted if you're like... Apple.
				$lowestMonth = 1;
				$lowestRevenue = 100000000;
				$totalRevenue = 0;
				foreach($monthlyRevenue as $month => $revenue)
				{
					print($monthNames[$month] . " -> " . money_format($revenue) . "\n");
					if ($revenue < $lowestRevenue)
					{
						$lowestMonth = $month;
						$lowestRevenue = $revenue;
					}
					$totalRevenue += $revenue;
				}

				print("\n<b>Total Annual Revenue:</b> " .  money_format($totalRevenue) . "\n");
				print("<b>Lowest Monthly Revenue:</b> " . $monthNames[$lowestMonth] . " - " . money_format($lowestRevenue) . "\n");
			?></pre>
	</body>
</html>
