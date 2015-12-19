<?php

include_once "./include/hulpoproep.php";
include_once "./include/verzorger.php";

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
				$hulpoproepen = Hulpoproepen->getLijstHulpoproepen();
				foreach($hulpoproepen as $hulpoproep)
				{
					if(isset($id))
					{
						$verzorger = new Verzorger($id);
						$patienten = $verzorger->getLijstPatienten();
						
						foreach($patienten as $patient)
						{
							if($hulpoproep->getPatient()->getID() == $patient->getID())
								echo $hulpoproep->getListViewData();
						}
					} else
					{
						echo $hulpoproep->getListViewData();
					}
				
				}
				?>
			</div>
			<div>
				<h3>
					Patienten:
				</h3>
				<?php
				if($id)
				{	
					$verzorger = new Verzorger($id);
					$patienten = $verzorger->getLijstPatienten();
				} else
				{
					$patienten = Patient->getLijstPatienten();
				}
				
				foreach($patienten as $patient)
				{
					$patient = new Patient($patienten['id']);
					echo $patient->getListViewData();
				}
				?>
			</div>
		</div>
	</body>
</html>