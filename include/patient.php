<?php

include_once "persoon.php";

class Patient extends Persoon
{
	private $profielfoto;
	
	function Patient($patientID = -1)
	{
		if($patientID == -1)
		{
			$this->PatientUpdate();
		} else
		{
			if(is_int($patientID))
			{
				$this->setID($patientID);
				$this->getDatabaseWaarde();
			} else
				$this->PatientUpdate();
		}
	}
	
	function PatientUpdate()
	{
		if($this->getID() >= 0)
		{
			$this->getDatabaseWaarde();
		} else
		{
			throw new Exception("De variabele \$id heeft geen geldige waarde, roep eerst de functie setID() aan om de waarde in te stellen. Of gebruik de constructor met als argument het id van de patient ");
		}
	}
	
	function getDatabaseWaarde()
	{
		try
		{
			global $pdo;
		
			$query = "
			SELECT 
				voornaam, 
				achternaam, 
				geboortedatum, 
				beschrijving, 
				profielfoto 
			FROM 
				patients 
			WHERE 
				id = " . (int) $this->getID();
		
			$queryPDO = $pdo->query($query);
			$patientResultaat = $queryPDO->fetch(PDO::FETCH_ASSOC);
			
			$geboortedatum = Datum::getDatabaseWaarde((int) $patientResultaat['geboortedatum']);			
			
			parent::setVoornaam($patientResultaat['voornaam']);
			parent::setAchternaam($patientResultaat['achternaam']);
			parent::setGeboortedatum($geboortedatum->getDag(), $geboortedatum->getMaand(), $geboortedatum->getJaar());
			parent::setBeschrijving($patientResultaat['beschrijving']);
			$this->setProfielfoto($patientResultaat['profielfoto']);
		} catch (PDOException $e)
		{
			throw new Exception($e);
		}
	}
	
	function setDatabaseWaarde()
	{
		try
		{
			global $pdo;
		
			$query = "
			UPDATE 
				patients 
			SET 
				voornaam = '" . parent::getVoornaam() . "',
				achternaam = '" . parent::getAchternaam() . "', 
				geboortedatum = '" . parent::getGeboortedatum()->naarDatabaseWaarde() . "', 
				beschrijving = '" . parent::getBeschrijving() . "',
				profielfoto = '" . $this->getProfielfoto() . "'
			WHERE 
				id = " . parent::getID() . ";";
		
			$dataPDO = $pdo->prepare($query);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			throw new Exception($e);
		}
	}
	
	function linkPatientAanVerzorger($verzorger)
	{
		global $pdo;
		
		try
		{
			$DatabaseQuery = "INSERT INTO links (master, patient) VALUES (:master, :patient);";
			$dataPDO = $pdo->prepare($DatabaseQuery);
			$dataPDO->bindParam(":master", $verzorger->getID());
			$dataPDO->bindParam(":patient", $this->getID());
	
			$dataPDO->execute();
			
		} catch (PDOException $e)
		{
			throw new Exception($e);
		}
	}
	
	function getProfielfoto()
	{
		return $this->profielfoto;
	}
	
	function setProfielfoto($profielfotoInput)
	{
		if(is_string($profielfotoInput) or is_null($profielfotoInput))
			if($profielfotoInput == "" or is_null($profielfotoInput))
				$this->profielfoto = "generic-profile.png";
			else
				$this->profielfoto = $profielfotoInput;
		else
			throw new Exception("De waarde \$profielfotoInput mag alleen maar een string zijn.");
	}
	
	function updatePatient()
	{
		$this->Patient();
	}
	
	function getListViewData()
	{
		return "<div style=\"width: 100%; height: 4em; position: relative; \">
					<div style=\"color: black; position: absolute; top: 1.5em;\">
						<a style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\" href=\"/patienten_info.php?id=" . $this->getID() . "\">
							" . parent::getAchternaam() . ", " . parent::getVoornaam() . "
						</a>
					</div>
					<div style=\"color: black; position: absolute; top: 0; right: 0;\">
						<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $this->getProfielfoto() . "\">
					</div>
				</div><hr>";
	}

	static function getLijstPatienten()
	{
		try
		{
			global $pdo;
		
			$query = "SELECT id FROM patients WHERE 1";
		
			$queryPDO = $pdo->query($query);
			return $queryPDO->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e)
		{
			throw new Exception($e);
		}
	}
}

?>