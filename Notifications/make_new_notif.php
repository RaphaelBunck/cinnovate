<?php

include_once "database.php";

if(isset($_GET['patient'], $_GET['master'], $_GET['pill']))
{
	$patient = $_GET['patient'];
	$master = $_GET['master'];
	$time = time();
	if(is_numeric($patient) && is_numeric($master))
	{
		$DatabaseQuery = "INSERT INTO pillnotifications (Patient_ID, Time_ID, Master_ID, Pill_ID) VALUES (:Patient_ID, :Time_ID, :Master_ID, :Pill_ID)";
		try{
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindValue(":Patient_ID", $patient);
			$dataPDO->bindValue("Time_ID", $time);
			$dataPDO->bindValue("Master_ID", $master);
			$dataPDO->bindValue("Pill_ID", $pill;
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			echo "Error while executing query!";
		}
	} else
		echo "Error: values are not numberic!";
}


?>