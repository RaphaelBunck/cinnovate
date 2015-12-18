<?php

include_once "../database/database.php";

class Persoon
{
	private $voornaam, 
			$achternaam, 
			$id, 
			$beschrijving;

	function getVoornaam()
	{
		return $voornaam;
	}
	
	function getAchternaam()}
	{
		return $achternaam;
	}
	
	function getID()
	{
		return $id;
	}
	
	function getBeschrijving()
	{
		return $beschrijving;
	}
}

?>
