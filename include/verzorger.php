<?php

include_once "persoon.php";

class Verzorger extends Persoon
{	
	function Verzorger($verzorgerID = -1)
	{
		if($verzorgerID == -1)
		{
			VerzorgerUpdaten();
		} else
		{
			if(is_numeric($verzorgerID))
			{
				$this->setID($verzorgerID);
				$this->getDatabaseWaarde();
			} else
				$this->VerzorgerUpdaten();
		}
	}
	
	function VerzorgerUpdaten()
	{
		if($this->getID() >= 0)
		{
			$this->getDatabaseWaarde();
		} else
		{
			throw new Exception("De variabele \$id heeft geen geldige waarde, roep eerst de functie setID() aan om de waarde in te stellen. Of gebruik de constructor met als argument het id van de verzorger ");
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
				beschrijving
			FROM 
				master 
			WHERE 
				id = " . (int) $this->getID();
		
			$queryPDO = $pdo->query($query);
			$verzorgerResultaat = $queryPDO->fetch(PDO::FETCH_ASSOC);
		
			$this->voornaam = $verzorgerResultaat['voornaam'];
			$this->achternaam = $verzorgerResultaat['achternaam'];
			$this->geboortedatum = Datum::getDatabaseWaarde((int) $verzorgerResultaat['geboortedatum']);
			$this->beschrijving = $verzorgerResultaat['beschrijving'];
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
				masters 
			SET 
				voornaam = :voornaam, 
				achternaam = :achternaam, 
				geboortedatum = :geboortedatum, 
				beschrijving = :beschrijving,
			WHERE 
				id = " . $this->getID() . ";";
		
			$dataPDO = $pdo->prepare($query);
			$dataPDO->bindParam(":voornaam", $this->voornaam);
			$dataPDO->bindParam(":achternaam", $this->achternaam);
			$dataPDO->bindParam(":geboortedatum", $this->getGeboortedatum()->naarDatabaseWaarde());
			$dataPDO->bindParam(":beschrijving", $this->beschrijving);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			throw new Exception($e);
		}
	}
	
	function updateVerzorger()
	{
		$this->Verzorger();
	}
	
	function getLijstPatienten()
	{
		try
		{
			global $pdo;
			
			$query = "
			SELECT 
				patient AS 'id'
			FROM 
				links 
			WHERE 
				master = " . $this->getID();
			
			$queryPDO = $pdo->query($query);
			
			return $queryPDO->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e)
		{
			throw new Exception($e);
		}
	}
}

?>