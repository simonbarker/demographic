<?php

	include ('class.demographic_class.php');

	$customer_data = new demographic_class();

	if($_POST["action"] == 'scrapeOnce'){
		$customer_data->scrapeOnce();
	}
	if($_POST["action"] == 'scrapeDemographic'){
		$customer_data->scrapeDemographic();
	}

?>