<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>End-of-Month Report</title>
	</head>
	<body>
		<?php
			// FILENAME: 	bizal.program2.php
			// AUTHOR: 		Marcus Bizal
			// DESCRIPTION: This program serves to demonstrates my knowlege of
			// 				named constants, variables and here documents.
			//				It simply generates an end-of-month report for
			//				Bizal Bookstore. 

			// NAMED CONSTANTS
			define("NET_INC_FACTOR", 0.57);

			// FUNCTIONS
			$money_format = function($number)
			{
				return number_format($number, 2, '.', ',');
			};

			// VARIABLES
			$sales				=	190000;
			$rent				=	25000;
			$salaries			=	37500;
			$supplies			=	410;
			$total_costs		=	$rent + $salaries + $supplies;
			$operating_income  	=  	$sales - $total_costs;
			$net_income			=	$operating_income  * NET_INC_FACTOR;

print <<<HTML
<h2>Bizal Bookstore Operating Costs</h2>
<hr/>
<b>Sales:</b> \${$sales}<br/>
<br/>
<b>Expenses:</b><br/>
&emsp;<b>Rent:</b> \${$rent}<br/>
&emsp;<b>Salary:</b> \${$salaries}<br/> 
&emsp;<b>Supplies:</b> \${$supplies}<br/>
<br/>
<b>Total costs:</b> \${$total_costs}<br/>
<b>Operating income:</b> \${$operating_income}<br/>
<b>Total costs:</b> \${$net_income}<br/>
<hr/>
HTML;

print <<<HTML
<h2>Bizal Bookstore Operating Costs - Formatted:</h2>
<hr/>
<b>Sales:</b> \${$money_format($sales)}<br/>
<br/>
<b>Expenses:</b><br/>
&emsp;<b>Rent:</b> \${$money_format($rent)}<br/>
&emsp;<b>Salary:</b> \${$money_format($salaries)}<br/> 
&emsp;<b>Supplies:</b> \${$money_format($supplies)}<br/>
<br/>
<b>Total costs:</b> \${$money_format($total_costs)}<br/>
<b>Operating income:</b> \${$money_format($operating_income)}<br/>
<b>Total costs:</b> \${$money_format($net_income)}<br/>
<hr/>
HTML;

		?>
	</body>
</html>
