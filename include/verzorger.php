<?php

include_once "persoon.php";

class Verzorger extends Persoon
{	
	function Verzorger($verzorgerID)
	{
		if(is_numeric($verzorgerID))
		{
			$id = $verzorgerID;
			gegevensOphalenUitDatabase();
		} else
			Verzorger();
	}
	
	function Verzorger()
	{
		if($id >= 0)
		{
			gegevensOphalenUitDatabase();
		} else
		{
			throw new Exeption("De variabele \$id heeft geen geldige waarde, roep eerst de functie setID() aan om de waarde in te stellen. Of gebruik de constructor met als argument het id van de verzorger ");
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
			FROM 
				masters 
			WHERE 
				id = " . $id . " LIMIT 1;";
		
			$queryPDO = $pdo->query($query);
			$verzorgerResultaat = $queryPDO->fetch(PDO::FETCH_ASSOC);
		
			$voornaam = $verzorgerResultaat['voornaam'];
			$achternaam = $verzorgerResultaat['achternaam'];
			$geboortedatum = Datum.getDatabaseWaarde($verzorgerResultaat['geboortedatum']);
			$beschrijving = $verzorgerResultaat['beschrijving'];
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
				masters 
			SET 
				voornaam = :voornaam, 
				achternaam = :achternaam, 
				geboortedatum = :geboortedatum, 
				beschrijving = :beschrijving,
			WHERE 
				id = " . $id . ";";
		
			$dataPDO = $pdo->prepare($query);
			$dataPDO->bindParam(":voornaam", $voornaam);
			$dataPDO->bindParam(":achternaam", $achternaam);
			$dataPDO->bindParam(":geboortedatum", $geboortedatum->naarDatabaseWaarde());
			$dataPDO->bindParam(":beschrijving", $beschrijving);
			$dataPDO->execute();
		} catch (PDOException $e)
		{
			throw new Exeption($e);
		}
	}
	
	function updateVerzorger()
	{
		Verzorger();
	}
	
	function getLijstPatienten()
	{
		try
		{
			global $pdo;
			
			$query = "
			SELECT 
				links.patient AS 'id'
			FROM 
				links 
			WHERE 
				links.master = " . $id;
			
			$queryPDO = $pdo->query($query);
			
			return $queryPDO->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e)
		{
			throw new Exeption($e);
		}
	}
}

?>