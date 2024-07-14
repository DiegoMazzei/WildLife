<?php

	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/database.php");
	include_once ($_SERVER['DOCUMENT_ROOT'] . "/wildlife/functions/utility.php");
	
	if (isset($_GET['id'])) {

		$idTerapia = $_GET['id'];

		$terapiaQuery = "SELECT T.Codice_Terapia, T.Cod_Tipologia_Terapia, TT.Descrizione FROM terapia AS T
		JOIN tipologia_terapia AS TT ON T.Cod_Tipologia_Terapia = TT.Codice_Terapia 
		WHERE T.Codice_Terapia = $idTerapia;";
		
		$terapiaData = queryOneAssoc($terapiaQuery, $connection);
		
		switch ($terapiaData['Descrizione']) {
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
		
		if ($terapiaDelete) {
			
			header ("Location:" . "/wildlife/controllers/dashboard/terapie/index.php");
			
		}
		
		else {
			
			die ("Errore, query non eseguita");
			
		}

	}

	else {

		echo "Non è stata richiesta una terapia";

	}

?>
