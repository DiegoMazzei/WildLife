<?php

	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/database.php");
	
	if (isset($_GET['id'])) {

		$idDiagnosi = $_GET['id'];

		$query = "DELETE FROM diagnosi WHERE Codice_Diagnosi = $idDiagnosi;";
	
		$result = $connection -> query($query);
		
		if ($result) {
			
			header ("Location:" . "/wildlife/controllers/dashboard/diagnosi/index.php");
			
		}
		
		else {
			
			die ("Errore, query non eseguita");
			
		}

	}

	else {

		echo "Non è stata richiesta una scheda";

	}

?>