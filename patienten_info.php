<?php

include_once "./database/database.php";
$bericht;
$fout = false;

if(isset($_GET['id']))
{
	if(is_numeric($_GET['id']))
	{
		
	} else
	{
		$fout = true;
	}
} else
{
	$fout = true;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>
			<meta name="viewport" content="width=device-width, user-scalable=no" />
			<title>	
				Patiënten informatie <?php if(isset($naam)) echo " - " . $naam;?>
			</title>
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
				<img src="./profile_picture/<?=$profielfoto?>">
				<form action="update_patient.php" method="post">
					<fieldset>
						<legend>Naam:</legend>
						Voornaam: 
						<input type="text" name="lastname" value="<?=$voornaam?>">
						<br>
					
						Achternaam: 
						<input type="text" name="firstname" value="<?=$achternaam?>">
					</fieldset>
					
					<fieldset>
						<legend>Overige informatie:</legend>
						Leeftijd: 
						<input type="number" name="age" value="<?=$leeftijd?>">
						<br>
						
						Beschrijving:
						<br>
						<textarea name="description">
							<?=$beschrijving?>
						</textarea>
					</fieldset>
					
					<input type="submit" value="Opslaan">
				</form>
			</div>
			<?php } else echo "Er is iets fout gegaan bij het ophalen van de gegevens!";?>
		</div>
	</body>
</html>