<?php

include_once "./database/database.php";
$bericht;
$error = false;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	if(is_numeric($id))
	{
		
		$query = "
			SELECT 
				fName AS \"voornaam\", 
				lName AS \"achternaam\",
				age AS \"leeftijd\",
				description AS \"beschrijving\",
				profile_picture AS \"profielfoto\"
			FROM
				patients
			WHERE
				Patient_ID = " . $id;
			
		$patientPDO = $pdo->query($query);
		$patientData = $patientPDO->fetchAll(PDO::FETCH_ASSOC);
		$patient = $patientData[0];
		
		if(is_null($patient['profielfoto']))
			$profielfoto = "generic-profile.png";
		else
			$profielfoto = $berichtText['profielfoto'];
		
	} else
		$error = true;
} else
	$error = true;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		 <meta charset="utf-8">
		<title>	
			Patiënten informatie <?php if(isset($patient['voornaam'])) echo " - " . $patient['achternaam'] . ", " . $patient['voornaam'];?>
		</title>
	</head>
	<body>
		<div>
			<div>
				<a href="./patienten.php">
					<= Vorige Pagina
				</a>
			</div>
			<?php if(!$error){?>
			<div>
				<div>
					<form action="update_patient.php?id=<?=$_GET['id']?>" method="post">
						<fieldset>
							<legend>Naam:</legend>
							Voornaam: 
							<input type="text" name="lastname" value="<?=$patient['voornaam']?>">
							<br>
						
							Achternaam: 
							<input type="text" name="firstname" value="<?=$patient['achternaam']?>">
						</fieldset>
						
						<fieldset>
							<legend>Overige informatie:</legend>
							Leeftijd: 
							<input type="number" name="age" value="<?=$patient['leeftijd']?>">
							<br>
							
							Beschrijving:
							<br>
							<textarea name="description"><?=$patient['beschrijving']?></textarea>
						</fieldset>
					
						<input type="submit" value="Opslaan">
					</form>
				</div>
				<div>
					<img src="./profile_picture/<?=$profielfoto?>" height="200px" width="200px">
				</div>
			</div>
			<?php } else echo "Er is iets fout gegaan bij het ophalen van de gegevens!";?>
		</div>
	</body>
</html>