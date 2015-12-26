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
			$masterResultaat = $queryPDO->fetch(PDO::FETCH_ASSOC);
			
			$geboortedatum = Datum::getDatabaseWaarde((int) $masterResultaat['geboortedatum']);			
			
			parent::setVoornaam($masterResultaat['voornaam']);
			parent::setAchternaam($masterResultaat['achternaam']);
			parent::setGeboortedatum($geboortedatum->getDag(), $geboortedatum->getMaand(), $geboortedatum->getJaar());
			parent::setBeschrijving($masterResultaat['beschrijving']);
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
				master
			SET 
				voornaam = " . parent::getVoornaam() . ", 
				achternaam = " . parent::getAchternaam() . ", 
				geboortedatum = " . parent::getGeboortedatum()->naarDatabaseWaarde() . ", 
				beschrijving = " . parent::getBeschrijving() . ",
			WHERE 
				id = " . $this->getID() . ";";
		
			$dataPDO = $pdo->prepare($query);
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