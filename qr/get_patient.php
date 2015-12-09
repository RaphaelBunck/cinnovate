<?php
	include_once "../database/database.php";
	
	//Set result
	$r = array(
		"data" => array(
			array(
				"fName" => "Jasper",
				"lName" => "van der Linden",
				"age" => 16,
				"descr" => "Mijn omschrijving"
			)
		),
		"error" => NULL
	);
	
	$r = json_encode($r);
	echo $r/*
	if($_GET) {
		//Set result
		$r = array(
			"data" => array(
				0 => array(
					"fName" => "Jasper",
					"lName" => "van der Linden",
					"age" => 16,
					"descr" => "Mijn omschrijving"
				)
			)
		);
		var_dump($r);
		$r = json_encode($r);
		var_dump($r);
	} else {
		 echo {"error": "Er zijn geen gegevens gevonden"};
	}*/
?>