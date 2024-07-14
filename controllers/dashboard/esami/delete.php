<?php

	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/database.php");
	
	if (isset($_GET['id'])) {

		$idEsame = $_GET['id'];

		$query = "DELETE FROM prescrizione_esame WHERE Codice_prescrizione = $idEsame;";
	
		$result = $connection -> query($query);
		
		if ($result) {
			
			header ("Location:" . "/wildlife/controllers/dashboard/esami/index.php");
			
		}
		
		else {
			
			die ("Errore, query non eseguita");
			
		}

	}

	else {

		echo "Non è stata richiesta una scheda";

	}

?>