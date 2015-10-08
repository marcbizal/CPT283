<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sunrise/Sunset Calculator</title>
	</head>
	<body>
		<?php
			// FILENAME: bizal.program1.php
			// AUTHOR: Marcus Bizal
			// DESCRIPTION: This program announces today's date along with,
			//				both the sunrise and sunset times for today.

			$today = date("m/d/y");
			$sunrise = date_sunrise(time(), SUNFUNCS_RET_STRING, 33, -80, 90, -4);
			$sunset = date_sunset(time(), SUNFUNCS_RET_STRING, 33, -80, 90, -4);

			print("On today’s date, " . $today . ", sunrise was at " . $sunrise . ", and sunset will be at " . $sunset . ".");
		?>
	</body>
</html>
