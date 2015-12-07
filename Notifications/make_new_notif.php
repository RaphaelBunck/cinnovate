<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once "database.php";

if(isset($_GET['patient'], $_GET['master'], $_GET['pill'], $_GET['time']))
{
	$patient = $_GET['patient'];
	$master = $_GET['master'];
	$pill = $_GET['pill'];
	$time = $_GET['time']); //daymonthyearhourminute 31220151000 3-12-2015-10:00
	
	if(is_numeric($patient) && is_numeric($master) && is_numeric($time) && is_numeric($pill)
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
		echo "Error: values are not numeric!";
}


?>