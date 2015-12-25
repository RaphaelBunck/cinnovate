<?php

include_once "./include/patient.php";

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	if(is_numeric($id))
	{
		$patient = new Patient((int) $id);
		$geboortedatum = $patient->getGeboortedatum();
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
			Patiënten informatie <?php if(isset($patient)) echo " - " . $patient->getAchternaam() . ", " . $patient->getVoornaam();?>
		</title>
	</head>
	<body>
		<div>
			<div>
				<h3>
					Patientinformatie
				</h3>
			</div>
			<?php if(!isset($error)){?>
			<div>
				<div>
					<form action="update_patient.php?id=<?=$id?>" method="post">
						<fieldset>
							<legend>Naam:</legend>
							Voornaam: 
							<input type="text" name="voornaam" value="<?=$patient->getVoornaam()?>">
							<br>
						
							Achternaam: 
							<input type="text" name="achternaam" value="<?=$patient->getAchternaam()?>">
						</fieldset>
						
						<fieldset>
							<legend>Overige informatie:</legend>
							<fieldset>
								<legend>Geboortedatum:</legend>
								<input type="number" name="ageDag" value="<?=$geboortedatum->getDag()?>">
								<input type="number" name="ageMaand" value="<?=$geboortedatum->getMaand()?>">
								<input type="number" name="ageJaar" value="<?=$geboortedatum->getJaar()?>">
							</fieldset>
							Beschrijving:
							<br>
							<textarea name="beschrijving"><?=$patient->getBeschrijving()?></textarea>
						</fieldset>
					
						<input type="submit" value="Opslaan">
					</form>
				</div>
				<div>
					<img src="./profile_picture/<?=$patient->getProfielfoto()?>" height="200px" width="200px">
				</div>
			</div>
			<?php } else echo "Er is iets fout gegaan bij het ophalen van de gegevens!";?>
		</div>
	</body>
</html>