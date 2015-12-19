<?php

include_once "../include/hulpoproep.php";

if(isset($_GET['patient']))
{
	$patient = $_GET['patient'];
	$tijd = time();
	if(is_int($patient))
	{
		$hulpoproep = new Hulpoproep($patient, $tijd);
		$hulpoproep->hulpoproepOpslaanDatabase();
	} else
		echo "Fout: de waarde is geen integer!";
}


?>