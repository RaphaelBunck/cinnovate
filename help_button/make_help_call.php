<?php

include_once "../database/database.php";

if(isset($_GET['patient'], $_GET['master']))
{
	$patient = $_GET['patient'];
	$master = $_GET['master'];
	$time = time();
	if(is_numeric($patient) && is_numeric($master))
	{
		$DatabaseQuery = "INSERT INTO helpcalls (id_patient, id_time, id_master) VALUES (:id_patient, :id_time, :id_master)";
		try{
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindValue(":id_patient", $patient);
			$dataPDO->bindValue("id_time", $time);
			$dataPDO->bindValue("id_master", $master);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			echo "Error while executing query!";
		}
	} else
		echo "Error: values are not numberic!";
}


?>