<?php

include_once "./include/database.php";

$bericht = "";
$error = false;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	
	if (is_numeric($id)) {
        $query = "SELECT 
	pillnotifications.Notif_ID AS \"Notif_ID\",
	master.voornaam AS \"master_id\",
    patients.achternaam AS \"patient_name\",
    pills.Pill_Name AS \"Pill_name\",
    pillnotifications.Time_ID AS \"Time\"
FROM 
	pillnotifications
JOIN master ON
	pillnotifications.Master_ID = master.id
JOIN pills ON
	pillnotifications.Pill_ID = pills.Pill_ID
JOIN patients ON
	pillnotifications.Patient_ID = patients.id
WHERE
	pillnotifications.Patient_ID = " . $id;
    } else {
        $error = true;
        $bericht = "<div style=\"width: 100%; height: 4em; font-size: 30px;\">Fout met ophalen van gegevens uit de database.</div>";
    }
} else
{
	$query = "SELECT 
	pillnotifications.Notif_ID AS \"Notif_ID\",
	master.voornaam AS \"master_id\",
    patients.achternaam AS \"patient_name\",
    pills.Pill_Name AS \"Pill_name\",
    pillnotifications.Time_ID AS \"Time\"
FROM 
	pillnotifications
JOIN master ON
	pillnotifications.Master_ID = master.id
JOIN pills ON
	pillnotifications.Pill_ID = pills.Pill_ID
JOIN patients ON
	pillnotifications.Patient_ID = patients.id
WHERE 1";
}

if(!$error)
{
	$selectPDO = $pdo->query($query);
	$selectData = $selectPDO->fetchAll(PDO::FETCH_ASSOC);
	foreach($selectData as $berichtText)
	{
            if (is_null($berichtText['profile_picture'])) {
            $profilepicture = "generic-profile.png";
        } else {
            $profilepicture = $berichtText['profile_picture'];
        }
		

        $bericht = $bericht . 
					"<div style=\"width: 100%; height: 4em; position: relative; \">
						<div style=\"color: black; position: absolute; top: 1.5em;\">
							<a style=\"color: black; font-family: Arial, sans-serif; text-decoration: none;\" href=\"/pillagenda.php?id=" . $berichtText['Patient_ID'] . "\">
								" . "Notificatie Nummer: " . $berichtText['Notif_ID'] . " | Pill: " .   $berichtText['Pill_name'] . " | Patient:  " . $berichtText['patient_name'] . " | Verzorger: " . $berichtText['master_id'] . " | Tijdcode: ". $berichtText['Time'] . "
							</a>
						
							</div>
					</div><hr>";
	}
}

?>


<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		<title>
			Pillagenda
		</title>
	</head>
	<body>
		<?= $bericht?>
	</body>
</html>