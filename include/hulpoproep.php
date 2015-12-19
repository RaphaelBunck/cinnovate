<?php

include_once "patient.php";

class Hulpoproep
{
	private $id, $patient, $tijd;
	
	function Hulpoproep($idPatient, $tijdInput)
	{
		$patient = new Patient($patientInput);
		$tijd = $tijdInput;
	}
	
	function Hulpoproep($idInput)
	{
		if(is_int($idInput))
		{
			$id = $idInput;
			
			global $pdo;
			
			$query = "SELECT ID_patient AS 'id' FROM helpcalls WHERE id = " . $id . " LIMIT 1;";
			
			$queryPDO = $pdo($query);
			$dataPDO = queryPDO->fetch(PDO::FETCH_ASSOC);
			
			$patient = new Patient($dataPDO['id']);
		} else
			throw new Exeption("De waarde \$idInput is geen geldige waarde, hij kan alleen maar een integer zijn.");
	}
	
	function hulpoproepOpslaanDatabase()
	{
		global $pdo;
		
		try
		{
			$query = "INSERT INTO helpcalls (id_patient, id_time) VALUES (:id_patient, :id_time)";
			
			$queryPDO = prepare($query);
			$queryPDO->bindParam(":Patient_ID", $patient->getID());
			$queryPDO->bindParam(":id_time", $tijd);
			$
		} catch (PDOException $e)
		{
			throw new Exeption($e);
		}
	}
	
	function getListViewData()
	{
		return "<div style=\"width: 100%; height: 4em; position: relative; \">
						<div style=\"color: black; position: absolute; top: 1.5em;\">
							<div style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\">
								" . $patient->achternaam . ", " . $patient->voornaam . "
							</div>
							<small>Hulp geroepen op: " . date("D j F Y g:i", $tijd) . "</small>
						</div>
						<div style=\"color: black; position: absolute; top: 0; right: 0;\">
							<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $patient->profielfoto . "\">
						</div>
					</div><hr>";
	}
	
	static function getLijstHulpoproepen()
	{
		try
		{
			global $pdo;
			
			$query = "SELECT id FROM helpcalls WHERE 1";
			
			$queryPDO = $pdo->query($query);
			return $queryPDO->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e)
		{
			throw new Exeption($e);
		}
	}
	
	function getPatient()
	{
		return $patient;
	}
	
	function setPatient($idPatient)
	{
		if(is_int($idPatient))
			$patient = new Patient($idPatient);
		else
			throw new Exeption("De waarde \$idPatient is moet een Integer zijn.");
	}
	
	function getID()
	{
		return $id;
	}
	
	function setID($idInput)
	{
		if(is_int($idInput))
		{
			$id = $idInput;
			Hulpoproep($id);
		} else
			throw new Exeption("De waarde \$idInput moet een Integer zijn.");
	}
	
	function getTijd()
	{
		return $tijd;
	}
	
	function setTijd($tijdInput)
	{
		if(is_int($tijdInput))
			$tijd = $tijdInput;
		else
			throw new Exeption("De waarde \$tijdInput moet een Integer zijn.");
	}
}

?>