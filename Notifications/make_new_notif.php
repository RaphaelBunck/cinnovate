<?php

include_once "../database/database.php";

if(isset($_GET['patient'], $_GET['master'], $_GET['pill'], $_GET['tijd']))
{
	$patient = $_GET['patient'];
	$master = $_GET['master'];
	$pill = $_GET['pill'];
	$tijd = $_GET['tijd']; //daymonthyearhourminute 31220151000 3-12-2015-10:00

    if(is_numeric($patient) && is_numeric($master) && is_numeric($tijd) && is_numeric($pill))
	{
		$DatabaseQuery = "INSERT INTO pillnotifications (Patient_ID, Time_ID, Master_ID, Pill_ID) VALUES (:Patient_ID, :Time_ID, :Master_ID, :Pill_ID)";
		try{
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindValue(":Patient_ID", $patient);
			$dataPDO->bindValue("Time_ID", $tijd);
			$dataPDO->bindValue("Master_ID", $master);
			$dataPDO->bindValue("Pill_ID", $pill);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			echo "Error while executing query!";
		}
	} else
		echo "Error: values are not numeric!";
}


?>