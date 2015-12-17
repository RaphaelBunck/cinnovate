<?php

include_once "../database/database.php";

if(isset($_GET['patient']))
{
	$patient = $_GET['patient'];
	$time = time();
	if(is_numeric($patient))
	{
		$DatabaseQuery = "INSERT INTO helpcalls (id_patient, id_time) VALUES (:id_patient, :id_time)";
		try{
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindValue(":id_patient", $patient);
			$dataPDO->bindValue("id_time", $time);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			echo "Error while executing query!";
			echo $e;
		}
	} else
		echo "Error: values are not numberic!";
}


?>