<?php

include_once "./include/patient.php";

$error = "Es ist etwas schief gelaufen! <a href=\"./patienten.php\">Gehe zurück zum Ubersicht</a>";

if(isset($_POST['voornaam'], $_POST['achternaam'], $_POST['ageDag'], $_POST['ageMaand'], $_POST['ageJaar'], $_POST['beschrijving']))
{
	if(is_null($_POST['voornaam']) and is_null($_POST['achternaam']) and is_null($_POST['ageDag']) and is_null($_POST['ageMaand']) and is_null($_POST['ageJaar']) and is_null($_POST['beschrijving']))
		echo $error;
	elseif(is_int($_POST['ageDag']) and is_int($_POST['ageMaand']) and is_int($_POST['ageJaar']) and is_int($_GET['id']))
	{
		$voornaam = $_POST['voornaam'];
		$achternaam = $_POST['achternaam'];
		$beschrijving = $_POST['beschrijving'];
		$id = $_GET['id'];
		
		$patient = new Patient($id);
		$patient->setVoornaam($voornaam);
		$patient->setAchternaam($achternaam);
		$patient->setGeboortedatum($_POST['ageDag'], $_POST['ageMaand'], $_POST['ageJaar']);
		$patient->setBeschrijving($beschrijving);
		$patient->updatePatient();
		
		header("Location: ./patienten.php");
	} else
		echo $error;
} else
	echo $error;
?>