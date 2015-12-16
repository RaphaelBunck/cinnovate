<?php
	include_once "../database/database.php";
	
	try
	{
		if(isset($_POST['patient'], $_POST['master']))
		{
			$patient = $_POST['patient'];
			$master = $_POST['master'];
			
			$DatabaseQuery = "INSERT INTO links (master, patient) VALUES (:master, :patient);";
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindParam(":master", $master);
			$dataPDO->bindParam(":patient", $patient);
		
			$dataPDO->execute();
			
			echo "U bent in de database gezet!";
		} else
		{
			echo "Gegevens zijn niet beschiktbaar.";
		}
		
	} catch (PDOException $e)
	{
		echo "Error while executing query!";
		echo $e;
	}
	
	//Set result
	$result = array(
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
	
	$result = json_encode($result);
	echo $result;/*
	if($_GET) {
		//Set result
		$result = array(
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
		$result = json_encode($result);
		var_dump($result);
	} else {
		 echo {"error": "Er zijn geen gegevens gevonden"};
	}*/
?>