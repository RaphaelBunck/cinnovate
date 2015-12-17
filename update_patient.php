<?php

include_once "./database/database.php";

$error = "Es ist etwas schief gelaufen! <a href=\"./patienten.php\">Gehe zurück zum Ubersicht</a>";

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['description']))
{
	if(is_null($_POST['firstname']) and is_null($_POST['lastname']) and is_null($_POST['age']) and is_null($_POST['description']))
		echo $error;
	elseif(is_numeric($_POST['age']) and is_numeric($_GET['id']))
	{
		$voornaam = $_POST['firstname'];
		$achternaam = $_POST['lastname'];
		$leeftijd = $_POST['age'];
		$beschrijving = $_POST['description'];
		$id = $_GET['id'];
		
		$query = "UPDATE patients SET fName = :fName, lName = :lName, age = :age, description = :description WHERE Patient_ID = :id";
		
		$dataPDO = $pdo->prepare($query);
		
		$dataPDO->bindValue(":fName", $voornaam);
		$dataPDO->bindValue(":lName", $achternaam);
		$dataPDO->bindValue(":age", $leeftijd);
		$dataPDO->bindValue(":description", $beschrijving);
		$dataPDO->bindValue(":id", $id);
		
		$dataPDO->execute();
		
		header("Location: ./patienten.php");
	} else
		echo $error;
} else
	echo $error;
?>