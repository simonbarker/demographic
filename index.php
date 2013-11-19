<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

include ('class.demographic_class.php');

$customer_data = new demographic_class();

$postcodes = $customer_data->loadPostcodes();

?>
<html>
<head>
	<script>
		postcodes = <? echo $postcodes["json"] ?>;
		demographic = { 'A':{'total': 0, "percentage" : 0}, 'B':{'total': 0, "percentage" : 0}, 'C1':{'total': 0, "percentage" : 0}, 'C2':{'total': 0, "percentage" : 0}, 'D':{'total': 0, "percentage" : 0}, 'E':{'total': 0, "percentage" : 0}};
		postcodesLength = <? echo $postcodes["length"] ?>;
		globalCounter = 0;
	</script>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
	<script src="chart.js"></script>
	<script src="demographic.js"></script>
</head>
<body>
	
	 <div class="container">

	 	<div class="row">
	 		
	 		<div class="col-md-6">

	 			<p>Progress: <span id="completed">0</span>/<? echo $postcodes["length"] ?></p>

				<table class="table">
					<thead>
						<th>Demographic</th>
						<th>Total</th>
						<th>Percentage / %</th>
					</thead>
					<tbody>
						<tr>
							<td>A:</td><td id="ATotal">0</td><td id="APercentage">0</td>
						</tr>
						<tr>
							<td>B:</td><td id="BTotal">0</td><td id="BPercentage">0</td>
						</tr>
						<tr>
							<td>C1:</td><td id="C1Total">0</td><td id="C1Percentage">0</td>
						</tr>
						<tr>
							<td>C2:</td><td id="C2Total">0</td><td id="C2Percentage">0</td>
						</tr>
						<tr>
							<td>D:</td><td id="DTotal">0</td><td id="DPercentage">0</td>
						</tr>
						<tr>
							<td>E:</td><td id="ETotal">0</td><td id="EPercentage">0</td>
						</tr>
					</tbody>
				</table>

	 		</div>

	 		<div class="col-md-6">
	 			<canvas id="demographicChart" width="600" height="400"></canvas>
	 		</div>
	 	</div>
			
  </div><!-- /.container -->

</body>
</html>