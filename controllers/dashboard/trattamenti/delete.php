<?php

	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/database.php");
	
	if (isset($_GET['id'])) {

		$idTrattamento = $_GET['id'];

		$query = "DELETE FROM trattamento WHERE Codice_Trattamento = $idTrattamento;";
	
		$result = $connection -> query($query);
		
		if ($result) {
			
			header ("Location:" . "/wildlife/controllers/dashboard/trattamenti/index.php");
			
		}
		
		else {
			
			die ("Errore, query non eseguita");
			
		}

	}

	else {

		echo "Non è stata richiesta una scheda";

	}

?>