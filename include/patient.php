<?php

include_once "persoon.php";

class Patient extends Persoon
{
	private $profielfoto;
	
	function Patient($patientID)
	{
		if(is_numeric($patientID))
		{
			$id = $patientID;
			gegevensOphalenUitDatabase();
		} else
			Patient();
	}
	
	function Patient()
	{
		if($id >= 0)
		{
			gegevensOphalenUitDatabase();
		} else
		{
			throw new Exeption("De variabele \$id heeft geen geldige waarde, roep eerst de functie setID() aan om de waarde in te stellen. Of gebruik de constructor met als argument het id van de patient ");
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
				id = " . $id . " LIMIT 1;";
		
			$queryPDO = $pdo->query($query);
			$patientResultaat = $queryPDO->fetch(PDO::FETCH_ASSOC);
		
			$voornaam = $patientResultaat['voornaam'];
			$achternaam = $patientResultaat['achternaam'];
			$geboortedatum = Datum.getDatabaseWaarde($patientResultaat['geboortedatum']);
			$beschrijving = $patientResultaat['beschrijving'];
			$profielfoto = $patientResultaat['profielfoto'];
		} catch (PDOException $e)
		{
			throw new Exeption($e);
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
				voornaam = :voornaam, 
				achternaam = :achternaam, 
				geboortedatum = :geboortedatum, 
				beschrijving = :beschrijving,
				profielfoto = :profielfoto
			WHERE 
				id = " . $id . ";";
		
			$dataPDO = $pdo->prepare($query);
			$dataPDO->bindParam(":voornaam", $voornaam);
			$dataPDO->bindParam(":achternaam", $achternaam);
			$dataPDO->bindParam(":geboortedatum", $geboortedatum->naarDatabaseWaarde());
			$dataPDO->bindParam(":beschrijving", $beschrijving);
			$dataPDO->bindParam(":profielfoto", $profielfoto);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			throw new Exeption($e);
		}
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
			throw new Exeption($e);
		}
	}
	
	function getProfielfoto()
	{
		return $profielfoto;
	}
	
	function setProfielfoto($profielfotoInput)
	{
		if(is_string($profielfotoInput))
			if($profielfotoInput == "")
				$profielfoto = "generic-profile.png";
			else
				$profielfoto = $profielfotoInput;
		else
			throw new Exception("De waarde \$profielfotoInput mag alleen maar een string zijn.");
	}
	
	function updatePatient()
	{
		Patient();
	}
	
	function getListViewData()
	{
		return "<div style=\"width: 100%; height: 4em; position: relative; \">
					<div style=\"color: black; position: absolute; top: 1.5em;\">
						<a style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\" href=\"/patienten_info.php?id=" . $berichtText['id'] . "\">
							" . $achternaam . ", " . $voornaam . "
						</a>
					</div>
					<div style=\"color: black; position: absolute; top: 0; right: 0;\">
						<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $profielfoto . "\">
					</div>
				</div><hr>"
	}

	static function getLijstPatienten()
	{
		try
		{
			static $pdo;
		
			$query = "SELECT id FROM patients WHERE 1";
		
			$queryPDO = $pdo->query($query);
			return $queryPDO->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e)
		{
			throw new Exeption($e);
		}
	}
}

?>