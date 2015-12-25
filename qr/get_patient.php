<?php
	include_once "../include/patient.php";
	include_once "../include/verzorger.php";
	
	try
	{
		if(isset($_POST['patient'], $_POST['master']))
		{
			if(is_numeric($_POST['patient']) and is_numeric($_POST['master']))
			{
				$patient = new Patient((int) $_POST['patient']);
				$master = new Verzorger((int) $_POST['master']);
			
				$patient->linkPatientAanVerzorger($master);
			
				echo "U bent in de database gezet!";
			} else
			{
				Throw new Exception("De gegevens zijn geen Integer.");
			}
		} else
		{
			Throw new Exception("De juiste gegevens zijn niet opgegeven.");
		}
		
	} catch (Exception $e)
	{
		echo $e;
	}
?>