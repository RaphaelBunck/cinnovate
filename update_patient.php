<?php

include_once "./database/database.php";
var_dump($_POST);

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['description']))
{
	echo 1;
	if(is_null($_POST['firstname']) and is_null($_POST['lastname']) and is_null($_POST['age']) and is_null($_POST['description']))
		echo "2 Es ist etwas schief gelaufen!";
	elseif(is_numeric($_POST['age']) and is_numeric($_GET['id']))
	{
		echo 3;
		$voornaam = $_POST['firstname'];
		$achternaam = $_POST['lastname'];
		$leeftijd = $_POST['age'];
		$beschrijving = $_POST['description'];
		$id = $_GET['id'];
		
		$query = "UPDATE patients SET fName = '" . $voornaam . "', lName = '" . $achternaam . "', age = '" . $leeftijd . "', description = '" . $beschrijving . "' WHERE Patient_ID = " . $leeftijd;
		
		$dataPDO = $pdo->query($query);
		
	} else
		echo "3Es ist etwas schief gelaufen!";
} else
	echo "4Es ist etwas schief gelaufen!";
?>