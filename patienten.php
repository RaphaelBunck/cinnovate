<?php

include_once "./database/database.php";

$bericht = "";
$error = false;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	if(is_numeric($id))
		$query = "
			SELECT 
				patients.fName AS 'voornaam',
				patients.lName AS 'achternaam',
				patients.Patient_ID AS 'id',
				patients.insertion,
				patients.profile_picture AS 'profielfoto'
			FROM 
				links 

			JOIN patients ON 
				links.patient = patients.Patient_ID 
			WHERE 
				links.master = " . $id;
	else
	{
		$error = true;
		$bericht = "<div style=\"width: 100%; height: 4em; font-size: 30px;\">Fout met ophalen van gegevens uit de database.</div>";
	}
} else
{
	$query = "SELECT fName AS 'voornaam', lName AS 'achternaam', Patient_ID As 'id', insertion, profile_picture AS 'profielfoto' FROM patients";
}

if(!$error)
{
	$selectPDO = $pdo->query($query);
	$selectData = $selectPDO->fetchAll(PDO::FETCH_ASSOC);
	foreach($selectData as $berichtText)
	{
		if(is_null($berichtText['profielfoto']))
			$profilepicture = "generic-profile.png";
		else
			$profilepicture = $berichtText['profielfoto'];
		
		$bericht = $bericht . 
					"<div style=\"width: 100%; height: 4em; position: relative; \">
						<div style=\"color: black; position: absolute; top: 1.5em;\">
							<a style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\" href=\"/patienten_info.php?id=" . $berichtText['id'] . "\">
								" . $berichtText['achternaam'] . ", " . $berichtText['voornaam'] . $berichtText['insertion'] . "
							</a>
						</div>
						<div style=\"color: black; position: absolute; top: 0; right: 0;\">
							<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $profilepicture . "\">
						</div>
					</div><hr>";
	}
}

$hulpoproepen = "";

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	if(is_numeric($id))
		$query = "
			SELECT 
				patients.fName AS 'voornaam',
				patients.lName AS 'achternaam',
				patients.profile_picture AS 'profielfoto',
				helpcalls.id_time AS 'tijd'
			FROM 
				links 
			JOIN patients ON 
				links.patient = patients.Patient_ID
			JOIN helpcalls ON
				links.patient = helpcalls.id_patient
			WHERE 
				links.master = " . $id;
	else
	{
		$error = true;
		$hulpoproepen = "<div style=\"width: 100%; height: 4em; font-size: 30px;\">Fout met ophalen van gegevens uit de database.</div>";
	}
} else
{
	$query = "SELECT 
	helpcalls.id_time AS \"tijd\", 
    patients.fName AS \"voornaam\", 
    patients.lName AS \"achternaam\",
	patients.profile_picture AS \"profielfoto\"
FROM 
	helpcalls 
JOIN patients ON 
	helpcalls.id_patient = patients.Patient_ID  
WHERE 1";
}

if(!$error)
{
	$selectPDO = $pdo->query($query);
	$selectData = $selectPDO->fetchAll(PDO::FETCH_ASSOC);
	foreach($selectData as $berichtText)
	{
		if(is_null($berichtText['profielfoto']))
			$profilepicture = "generic-profile.png";
		else
			$profilepicture = $berichtText['profielfoto'];
		
		$hulpoproepen = $hulpoproepen . 
					"<div style=\"width: 100%; height: 4em; position: relative; \">
						<div style=\"color: black; position: absolute; top: 1.5em;\">
							<div style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\">
								" . $berichtText['achternaam'] . ", " . $berichtText['voornaam'] . "
							</div>
							<small>Hulp geroepen op: " . date("D j F Y g:i", $berichtText['tijd']) . "</small>
						</div>
						<div style=\"color: black; position: absolute; top: 0; right: 0;\">
							<img style=\"height: 4em; width: 4em;\" src=\"./profile_picture/" . $profilepicture . "\">
						</div>
					</div><hr>";
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		 <meta charset="utf-8">
		<title>
			Patienten
		</title>
	</head>
	<body>
		<div>
			<?php if($hulpoproepen != ""){?>
			<div>
				<h3>
					Hulpoproepen
				</h3>
				<?= $hulpoproepen?>
			</div>
			<?php }?>
			<div>
				<h3>
					Patienten:
				</h3>
				<?= $bericht?>
			</div>
		</div>
	</body>
</html>