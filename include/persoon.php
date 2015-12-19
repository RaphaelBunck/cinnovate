<?php

include_once "../database/database.php";

class Persoon
{
	private $voornaam, 
			$achternaam, 
			$id, 
			$beschrijving,
			$geboortedatum;

	function getVoornaam()
	{
		return $voornaam;
	}
	
	function setVoornaam($voornaamInput)
	{
		if(is_string($voornaamInput))
			$voornaam = $voornaamInput;
		else
			throw new Exception("De waarde \$voornaamInput mag alleen maar een string zijn.");
	}
	
	function getAchternaam()
	{
		return $achternaam;
	}
	
	function setAchternaam($achternaamInput)
	{
		if(is_string($achternaamInput))
			$achternaam = $achternaamInput;
		else
			throw new Exception("De waarde \$achternaamInput mag alleen maar een string zijn.");
	}
	
	function getID()
	{
		return $id;
	}
	
	function setID($idInput)
	{
		if(is_int($id))
			$id = $idInput;
		else
			throw new Exception("De waarde \$idInput mag alleen maar een integerer zijn.");
	}
	
	function getBeschrijving()
	{
		return $beschrijving;
	}
	
	function setBeschrijving($beschrijvingInput)
	{
		if(is_string($beschrijvingInput))
			$beschrijving = $beschrijvingInput;
		else
			throw new Exception("De waarde \$beschrijvingInput mag alleen maar een string zijn.");
	}
	
	function getGeboortedatum()
	{
		return $geboortedatum;
	}
	
	function setGeboortedatum($dag, $maand, $jaar)
	{
		if(is_int($dag) and is_int($maand) and is_int($jaar))
		{
			$geboortedatum = new Datum($dag, $maand, $jaar);
		} else
			throw new Exception("De ingevoerde waardes zijn geen geldige getallen.");
	}
}

class Datum
{
	private $dag, $maand, $jaar;
	
	function Datum($dagInput, $maandInput, $jaarInput)
	{
		if(is_int($dagInput) and is_int($maandInput) and is_int($jaarInput))
		{
			try
			{
				$dag = setDag($dagInput);
				$maand = setMaand($maandInput);
				$jaar = setJaar($jaarInput);
			} catch($e)
			{
				echo $e;
			}
		} else
			throw new Exception("De ingevulde waardes zijn geen integers, gebruik voor de dagen, maanden en jaren alstublieft gehele getallen");
	}
	
	function getDag()
	{
		return $dag;
	}
	
	function setDag($dagInput)
	{
		if(is_int($dagInput))
			if($dagInput <= 31 && $dagInput > 0)
			{
				$dag = $dagInput;
			} else
				throw new Exception("De waarde \$dagInput mag niet hoger zijn dan 31 en niet lager dan 1.");
		else
			throw new Exception("De waarde \$dagInput moet een integer zijn.");
	}
	
	function getMaand()
	{
		return $maand;
	}
	
	function setMaand($maandInput)
	{
		if(is_int($maandInput))
			if($maandInput <= 12 && $maandInput > 0)
			{
				$maand = $maandInput;
			} else
				throw new Exception("De waarde \$maandInput mag niet hoger zijn dan 12 en niet lager dan 1.");
		else
			throw new Exception("De waarde \$maandInput moet een integer zijn.");
	}
	
	function getJaar()
	{
		return $jaar;
	}
	
	function setJaar($jaarInput)
	{
		if(is_int($jaarInput))
			if($jaarInput > 1900)
			{
				$jaar = $jaarInput;
			} else
				throw new Exception("De waarde \$maandInput mag niet lager zijn dan 1900.");
		else
			throw new Exception("De waarde \$jaarInput moet een integer zijn.");
	}
	
	function naarDatabaseWaarde()
	{
		$maandDagen = 0;
		switch ($maand)
		{
			case 1:
				$maandDagen = 0;
				break;
			case 2:
				$maandDagen = 31;
				break;
			case 3:
				$maandDagen = 59;
				break;
			case 4:
				$maandDagen = 90;
				break;
			case 5:
				$maandDagen = 120;
				break;
			case 6:
				$maandDagen = 151;
				break;
			case 7:
				$maandDagen = 181;
				break;
			case 8:
				$maandDagen = 212;
				break;
			case 9:
				$maandDagen = 243;
				break;
			case 10:
				$maandDagen = 273;
				break;
			case 11:
				$maandDagen = 304;
				break;
			case 12:
				$maandDagen = 334;
				break;
		}
		return $dag + $maandDagen + ($jaar - 1900) * 365;
	}
	
	static function getDatabaseWaarde($databaseValue)
	{
		if(is_int($databaseValue))
		{
			$jaarTijdelijk = $databaseValue / 365 + 1900;
			$rest = $databaseValue % 365;
			$maandTijdelijk = rest % 30;
		
			switch ($maand)
			{
				case 1:
					$rest -= 0;
					break;
				case 2:
					$rest -= 31;
					break;
				case 3:
					$rest -= 59;
					break;
				case 4:
					$rest -= 90;
					break;
				case 5:
					$rest -= 120;
					break;
				case 6:
					$rest -= 151;
					break;
				case 7:
					$rest -= 181;
					break;
				case 8:
					$rest -= 212;
					break;
				case 9:
					$rest -= 243;
					break;
				case 10:
					$rest -= 273;
					break;
				case 11:
					$rest -= 304;
					break;
				case 12:
					$rest -= 334;
					break;
			}
			
			$dagTijdelijk = $rest;
			
			return new Datum($dagTijdelijk, $maandTijdelijk, $jaarTijdelijk);
		} else
			throw new Exception("De ingevulde datadase waarde is niet geldig.");
	}
}
?>
