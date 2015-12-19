<?php
	include_once "../include/paptient.php";
	include_once "../include/verzorger.php";
	
	try
	{
		if(isset($_POST['patient'], $_POST['master']))
		{
			if(is_int($_POST['patient']) and is_int($_POST['master']))
			{
				$patient = new Patient($_POST['patient']);
				$master = new Verzorger($_POST['master']);
			
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
		
	} catch ($e)
	{
		echo $e;
	}
?>