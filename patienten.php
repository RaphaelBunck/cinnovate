<?php

include_once "./include/hulpoproep.php";
include_once "./include/verzorger.php";
include_once "./include/hulpoproep.php";

if(isset($_GET['id']))
{	
	if(is_int($_GET['id']))
	{
		$id = $_GET['id'];
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
			<div>
				<h3>
					Hulpoproepen
				</h3>
				<?php
				$hulpoproepen = Hulpoproep::getLijstHulpoproepen();
				foreach($hulpoproepen as $hulpoproep)
				{
					$hulpoproepObject = new Hulpoproep((int) $hulpoproep['id']);
					if(isset($id))
					{
						$verzorger = new Verzorger($id);
						$patienten = $verzorger->getLijstPatienten();
						
						foreach($patienten as $patient)
						{
							if($hulpoproepObject->getPatient()->getID() == $patient->getID())
								echo $hulpoproepObject->getListViewData();
						}
					} else
					{
						echo $hulpoproepObject->getListViewData();
					}
				
				}
				?>
			</div>
			<div>
				<h3>
					Patienten:
				</h3>
				<?php
				if(isset($id))
				{	
					$verzorger = new Verzorger($id);
					$patienten = $verzorger->getLijstPatienten();
				} else
				{
					$patienten = Patient::getLijstPatienten();
				}
				
				foreach($patienten as $patient)
				{
					$patient = new Patient($patient['id']);
					echo $patient->getListViewData();
				}
				?>
			</div>
		</div>
	</body>
</html>