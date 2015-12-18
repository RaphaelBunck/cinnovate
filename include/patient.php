<?php

include_once "persoon.php";

class Patient extends Persoon
{
	private $leeftijd,
			$insertion;
			
	function Patient($id)
	{
		if(is_numeric($id))
		{
			
		} else
			Patient();
	}
	
	function linkPatientAanVerzorger($verzorger)
	{
		global $pdo;
		
		try
		{
			$DatabaseQuery = "INSERT INTO links (master, patient) VALUES (:master, :patient);";
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindParam(":master", $verzorger->id);
			$dataPDO->bindParam(":patient", $this->id);
	
			$dataPDO->execute();
			
		} catch (PDOException $e)
		{
			echo $e;
		}
	}
}

?>