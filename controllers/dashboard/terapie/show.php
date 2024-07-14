<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = 'Visualizzazione Terapia';

$terapiaData = [];
if (isset($_GET['id'])) {
	$idTerapia = $_GET['id'];

	$terapiaQuery = "SELECT T.Codice_Terapia, Codice_Diagnosi, TT.Descrizione AS Tipologia, T.Descrizione AS Descrizione, Data_compilazione, CONCAT(Nome, ' ', Cognome) AS Operatore
				     FROM terapia AS T
		  		     JOIN utenti on T.Codice_Operatore = utenti.Codice_Utente
		  		     JOIN tipologia_terapia AS TT on TT.Codice_terapia = T.Cod_Tipologia_Terapia
		  		     WHERE T.Codice_Terapia = $idTerapia";
	$terapiaData = queryOneAssoc($terapiaQuery, $connection);
	$tipologia = $terapiaData['Tipologia'];

	// Visualizzazione dati relativi a una specifica categoria di terapia
	$terapiaChirurgica = [];
	$terapiaRiabilitativa = [];
	$terapiaFarmacologica = [];
	switch ($tipologia) {
		case 'Farmacologica/Medicale':

			$queryFarmacologica = "SELECT Posologia, Frequenza, Durata, Data_Inizio, Note, MEDICINALE_VETERINARIO 
									FROM terapia_farmacologica AS TF
									JOIN farmaci AS F ON F.Codice_Farmaco = TF.Codice_Farmaco
									WHERE Codice_Terapia = $idTerapia";
			$terapiaFarmacologica = queryOneAssoc($queryFarmacologica, $connection);
			if (!count($terapiaFarmacologica)) {
				die("Errore DB Terapia Farmacologica. Errore: " . $connection -> error);
			}

		break;
		case 'Chirurgica':

			$queryChirurgica = "SELECT Descrizione, Stato, Durata_Intervento, Data_Intervento, Esito_operazione, Note 
								FROM terapia_chirurgica AS TC
								WHERE Codice_Terapia = $idTerapia";
			$terapiaChirurgica = queryOneAssoc($queryChirurgica, $connection);
			if (!count($terapiaChirurgica)) {
				die("Errore DB Terapia Chirurgica. Errore: " . $connection -> error);
			}

		break;
		case 'Riabilitativa':
			$queryRiabilitativa = "SELECT Descrizione, Frequenza, Durata
								   FROM terapia_riabilitativa AS TR
								   WHERE Codice_Terapia = $idTerapia";
			$terapiaRiabilitativa = queryOneAssoc($queryRiabilitativa, $connection);
			if (!count($terapiaRiabilitativa)) {
				die("Errore DB Terapia Riabilitativa. Errore: " . $connection -> error);
			}

		break;
	}
}

require (__DIR__  . '/../../../views/dashboard/pages/terapie/show.view.php');
