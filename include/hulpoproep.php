<?php

include_once "patient.php";

class Hulpoproep
{
	private $id, $patient, $tijd;
	
	function Hulpoproep($idPatient, $tijdInput = 0)
	{
		if($tijdInput == 0)
		{
			$this->HulpoproepOpslaan($idPatient);
		} else
		{
			$patient = new Patient($patientInput);
			$tijd = $tijdInput;
		}
	}
	
	function HulpoproepOpslaan($idInput)
	{
		if(is_int($idInput))
		{
			$this->id = $idInput;
			
			global $pdo;
			
			$query = "SELECT ID_patient AS 'id', id_time AS 'tijd' FROM helpcalls WHERE id = " . $this->id . " LIMIT 1;";
			
			$queryPDO = $pdo->query($query);
			$dataPDO = $queryPDO->fetch(PDO::FETCH_ASSOC);
			
			$this->patient = new Patient((int) $dataPDO['id']);
			$this->tijd = (int) $dataPDO['tijd'];
		} else
			throw new Exception("De waarde \$idInput is geen geldige waarde, hij kan alleen maar een integer zijn.");
	}
	
	function hulpoproepOpslaanDatabase()
	{
		global $pdo;
		
		try
		{
			$query = "INSERT INTO helpcalls (id_patient, id_time) VALUES (:id_patient, :id_time)";
			
			$queryPDO = prepare($query);
			$queryPDO->bindParam(":Patient_ID", $patient->getID());
			$queryPDO->bindParam(":id_time", $this->tijd);
			$queryPDO->execute();
		} catch (PDOException $e)
		{
			throw new Exception($e);
		}
	}
	
	function getListViewData()
	{
		return "<div style=\"width: 100%; height: 4em; position: relative; \">
						<div style=\"color: black; position: absolute; top: 1.5em;\">
							<div style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\">
								" . $this->getPatient()->achternaam . ", " . $this->getPatient()->voornaam . "
							</div>
							<small>Hulp geroepen op: " . date("D j F Y g:i", $this->getTijd()) . "</small>
						</div>
						<div style=\"color: black; position: absolute; top: 0; right: 0;\">
							<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $this->getPatient()->getProfielfoto() . "\">
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
			throw new Exception($e);
		}
	}
	
	function getPatient()
	{
		return $this->patient;
	}
	
	function setPatient($idPatient)
	{
		if(is_int($idPatient))
			$this->patient = new Patient($idPatient);
		else
			throw new Exception("De waarde \$idPatient is moet een Integer zijn.");
	}
	
	function getID()
	{
		return $this->id;
	}
	
	function setID($idInput)
	{
		if(is_int($idInput))
		{
			$this->id = $idInput;
			Hulpoproep($this->getID());
		} else
			throw new Exception("De waarde \$idInput moet een Integer zijn.");
	}
	
	function getTijd()
	{
		return $this->tijd;
	}
	
	function setTijd($tijdInput)
	{
		if(is_int($tijdInput))
			$this->tijd = $tijdInput;
		else
			throw new Exception("De waarde \$tijdInput moet een Integer zijn.");
	}
}

?>