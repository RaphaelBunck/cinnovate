<?php

var_dump($_POST);

if(isset($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['description']))
{
	if(is_null($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['description']))
		echo "Es ist etwas schief gelaufen!";
	elseif(is_numeric($_POST['age']))
	{
		$voornaam = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$age = $_POST['age'];
		$description = $_POST['description'];
		
		$query = "
			UPDATE 
				patients 
			SET 
				fName = 'Jasper',
				lName = 'van der Linden',
				age = 16,
				description = 'Is gewoon knettergek'
			WHERE 
				Patient_ID = 2";
		
		$dataPDO = $pdo->query($query);
		
	} else
		echo "Es ist etwas schief gelaufen!";
} echo
	echo "Es ist etwas schief gelaufen!";
?>