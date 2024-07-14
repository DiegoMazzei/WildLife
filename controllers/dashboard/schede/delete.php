<?php

	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/database.php");
	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/functions/utility.php");
	
	if (isset($_GET['id'])) {

		$idScheda = $_GET['id'];

		$schedaQuery = "SELECT * FROM scheda_arrivo WHERE Codice_Accettazione = $idScheda;";
		$schedaData = queryOneAssoc($schedaQuery, $connection);

		$terapiaQuery = "SELECT T.Codice_Terapia, TT.Descrizione FROM terapia AS T 
		JOIN tipologia_terapia AS TT ON T.Cod_Tipologia_Terapia = TT.Codice_Terapia
		JOIN diagnosi AS D ON D.Codice_Diagnosi = T.Codice_Diagnosi
		WHERE Codice_Scheda = $idScheda";
		$terapiaData = queryAllAssoc($terapiaQuery, $connection);

	if (count($terapiaData) !== 0) {

		foreach ($terapiaData AS $terapia) {

			$idTerapia = $terapia['Codice_Terapia'];

			switch ($terapia['Descrizione']) {
				case 'Farmacologica/Medicale':
					$queryTrattamenti = "SELECT Codice_Trattamento FROM trattamento AS T
										JOIN terapia_farmacologica AS TF ON T.Cod_Tipologia_Terapia = TF.Cod_Terapia_Farmacologica
										WHERE TF.Codice_Terapia = $idTerapia";
					$trattamentiData = queryAllAssoc($queryTrattamenti, $connection);

					foreach ($trattamentiData AS $trattamento) {
						$trattamentoQuery = "DELETE FROM trattamento WHERE Codice_Trattamento = " . $trattamento['Codice_Trattamento'];
						$trattamentoDelete = $connection -> query($trattamentoQuery);
					}

					$queryFarmacologica = "DELETE FROM terapia_farmacologica WHERE Codice_Terapia = '$idTerapia';";
					$resultFarmacologica = $connection -> query($queryFarmacologica);
					break;

				case 'Chirurgica':
					$queryChirurgica = "DELETE FROM terapia_chirurgica WHERE Codice_Terapia = '$idTerapia';";
					$resultChirurgica = $connection -> query($queryChirurgica);
					break;
				case 'Riabilitativa':
					$queryRiabilitativa = "DELETE FROM terapia_riabilitativa WHERE Codice_Terapia = '$idTerapia';";
					$resultRiabilitativa = $connection -> query($queryRiabilitativa);
					break;
			}

			$queryTerapia = "DELETE FROM terapia WHERE Codice_Terapia = $idTerapia";
			$terapiaDelete = $connection -> query($queryTerapia);

		}

	}

		$queryScheda = "DELETE FROM scheda_arrivo WHERE Codice_Accettazione = $idScheda;";
		$queryEntity = "DELETE FROM entity_documento WHERE Data_Inserimento = '" . $schedaData['Data_arrivo'] . "';";
		$queryDocumenti = "DELETE FROM documenti WHERE time_stamp = '" . $schedaData['Data_arrivo'] . "';";
		$queryDiagnosi = "DELETE FROM diagnosi WHERE Codice_Scheda = '$idScheda';";
	
		$resultDiagnosi = $connection -> query($queryDiagnosi);
		$resultScheda = $connection -> query($queryScheda);
		$resultDocumenti = $connection -> query($queryDocumenti);
		$resultEntity = $connection -> query($queryEntity);
		
		if ($resultEntity && $resultScheda) {
			
			header ("Location:" . "/wildlife/controllers/dashboard/schede/index.php");
			
		}
		
		else {
			
			die ("Errore, query non eseguita");
			
		}

	}

	else {

		echo "Non è stata richiesta una scheda";

	}

?>
