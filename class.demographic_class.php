<?php

// error_reporting(E_ALL);
// ini_set('display_errors', '1');

class Demographic_class{

	//read post codes from a "postcodes.csv" file
	function loadPostcodes(){
		//get post codes
		$postcodes[0] = "";
		$row = 0;
		
		ini_set('auto_detect_line_endings',TRUE);

		if (($handle = fopen("postcodes.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

				$num = count($data);
				for ($c=0; $c < $num; $c++) {
				  $data[$c] = preg_replace( '/\s+/', '', $data[$c] );
				  $postcodes[$row] = $data[$c];
				  $row++;
				}

			}
			fclose($handle);
		}

	  //json or raw array
	  $postcodes["json"] = json_encode($postcodes);
	  $postcodes["arr"] = $postcodes;

	  //store the length for reference in the js
	  $postcodes["length"] = $row;

		return $postcodes;
	}

	//this is for one off scrapes and used by the ajax function
	function scrapeOnce($code){

		$demoNumbers = array("A" => 0, "B" => 0, "C1" => 0, "C2" => 0, "D" => 0, "E" => 0);

		$url = "http://checkmyarea.com/".$_POST["code"].".htm";

		$content = file_get_contents( $url );

		$dom = new DOMdocument();

		//find the highlighted demographic tab
		//demographic is held in the pages as a triplet so need to pregmatch to which ones are in there
		if($dom->loadHTML($content)){

			$demo = $dom->getElementsByTagName('b')->item(3)->nodeValue;

			//check to make sure it isn't an area that is all over the show and therefore labelled as mixed
		  $mixedFlag = 0; 
			if ($c=preg_match_all ("/(MIXED)/is", $demo, $matches))
		  {
				$demoNumbers[A]++;
				$demoNumbers[B]++;
				$demoNumbers[C1]++;
				$demoNumbers[C2]++;
				$demoNumbers[D]++;
				$demoNumbers[E]++;
				$mixedFlag = 1;		//set flag otherwise "D" and "E" will also get matched
		  }
		  if ($c=preg_match_all ("/(A)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[A]++;
		  }
		  if ($c=preg_match_all ("/(B)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[B]++;
		  }
		  if ($c=preg_match_all ("/(C1)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[C1]++;
		  }
		  if ($c=preg_match_all ("/(C2)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[C2]++;
		  }
		  if ($c=preg_match_all ("/(D)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[D]++;
		  }
		  if ($c=preg_match_all ("/(E)/is", $demo, $matches) && $mixedFlag == 0)
		  {
				$demoNumbers[E]++;
		  }

		}
		else{
			echo "post code invalid";
		}

		print_r(json_encode($demoNumbers));
	}

	//procedural grab of areas with an array - not used anymore
	function scrapeDemographic($postcodes){

		$demoNumbers = array("A" => 0, "B" => 0, "C1" => 0, "C2" => 0, "D" => 0, "E" => 0);

		$dom = new DOMdocument();

		foreach($postcodes as $code){

			//avoid them thinking bad things are happening
			sleep(0.2);

			$url = "http://checkmyarea.com/".$code.".htm";

			$content = file_get_contents( $url );

			if($dom->loadHTML($content)){

				//find the highlighted demographic tab
				//demographic is held in the pages as a triplet so need to pregmatch to which ones are in there
				$demo = $dom->getElementsByTagName('b')->item(3)->nodeValue;

				$mixedFlag = 0;

				if ($c=preg_match_all ("/(MIXED)/is", $demo, $matches))
			  {
					$demoNumbers[A]++;
					$demoNumbers[B]++;
					$demoNumbers[C1]++;
					$demoNumbers[C2]++;
					$demoNumbers[D]++;
					$demoNumbers[E]++;
					$mixedFlag = 1;
			  }
			  if ($c=preg_match_all ("/(A)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[A]++;
			  }
			  if ($c=preg_match_all ("/(B)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[B]++;
			  }
			  if ($c=preg_match_all ("/(C1)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[C1]++;
			  }
			  if ($c=preg_match_all ("/(C2)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[C2]++;
			  }
			  if ($c=preg_match_all ("/(D)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[D]++;
			  }
			  if ($c=preg_match_all ("/(E)/is", $demo, $matches) && $mixedFlag == 0)
			  {
					$demoNumbers[E]++;
			  }

			}
			else{
				echo "post code invalid";
			}

		}
		return $demoNumbers;
	}
}