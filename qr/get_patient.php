<?php
	include_once "../help_button/database.php";
	try
	{
		$DatabaseQuery = "INSERT INTO links (master, patient) VALUES (?, ?)";
		$dataPDO = $pdo->prepare($DatabaseQuery);
		$dataPDO->bind_param("ii", $m, $p);

		$p = $_POST['patient'];
		$m = $_POST['master'];
		$dataPDO->execute();
		
		echo "U bent in de database gezet!";
	} catch (PDOException $e)
	{
		echo "Error while executing query!";
	}
	
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