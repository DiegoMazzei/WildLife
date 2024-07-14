<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Aggiorna una terapia";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

	// Variabili POST
	date_default_timezone_set("Europe/Rome");
	$codiceTerapia = $_POST['codiceTerapia'];
	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$descrizione = $_POST["descrizione"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$currentTimestamp = date('Y_m_d_H_i_s');

	// Query Tipologie Terapie
	$tipologieQuery = "SELECT TT.Descrizione 
	    FROM terapia AS T
	    JOIN tipologia_terapia AS TT ON T.Cod_Tipologia_Terapia = TT.Codice_Terapia
	    WHERE T.Codice_Terapia = " . $codiceTerapia;
	$tipologieData = queryOneAssoc($tipologieQuery, $connection);
	$tipologia = $tipologieData['Descrizione'];

	// Query inserimento terapia
	$queryTerapia = "UPDATE terapia 
			SET Codice_Diagnosi = $codiceDiagnosi, 
			Descrizione = '$descrizione', 
			Codice_Operatore = $codiceOperatore
			WHERE Codice_Terapia = $codiceTerapia";
	$terapiaQueryResult = $connection -> query($queryTerapia);

	if ($terapiaQueryResult) {
	    $terapiaChirurgica = null;
	    $terapiaRiabilitativa = null;
	    $terapiaFarmacologica = null;

	    // Creazione tabella, in base alla tipologia selezionata
	    switch ($tipologia) {
		case 'Farmacologica/Medicale':
		    
		    $codiceFarmaco = $_POST['codiceFarmaco'];
		    $posologia = $_POST['posologia'];
		    $frequenza = $_POST['frequenza'];
		    $durata = $_POST['durata'];
		    $note = $_POST['note'];
		    $dataInizio = $_POST['dataInizio'];

		    $queryFarmacologica = "UPDATE terapia_farmacologica
					    SET Data_Inizio = '$dataInizio',
						Codice_Farmaco = $codiceFarmaco,
						Posologia = '$posologia',
						Frequenza = '$frequenza',
						Durata = '$durata',
						Note = '$note'
						WHERE Codice_Terapia = $codiceTerapia";
		    $terapiaFarmacologica = $connection -> query($queryFarmacologica);

		    break;
		case 'Chirurgica':
		    
		    $descrizioneChirurgica = $_POST['descrizioneChirurgica'];
		    $stato = $_POST['stato'];
		    $durata = $_POST['durata'];
		    $dataOperazione = $_POST['dataOperazione'];
		    $esito = $_POST['esito'];
		    $note = $_POST['noteChirurgica'];

		    $queryChirurgica = "UPDATE terapia_chirurgica
					    SET Descrizione = '$descrizioneChirurgica',
						Stato = $stato,
						Durata_Intervento = '$durata',
						Data_Intervento = '$dataOperazione',
						Esito_Operazione = '$esito',
						Note = '$note'
						WHERE Codice_Terapia = $codiceTerapia";
		    $terapiaChirurgica = $connection -> query($queryChirurgica);

		    break;
		case 'Riabilitativa':
		    $descrizioneRiabilitativa = $_POST['descrizioneRiabilitativa'];
		    $frequenza = $_POST['frequenza'];
		    $durata = $_POST['durata'];

		    $queryRiabilitativa = "UPDATE  terapia_riabilitativa
					    SET Descrizione = '$descrizioneRiabilitativa',
						Frequenza = '$frequenza',
						Durata = '$durata'
						WHERE Codice_Terapia = '$codiceTerapia'";
		    $terapiaRiabilitativa = $connection -> query($queryRiabilitativa);
		    break;
	    }

	    if ($terapiaChirurgica || $terapiaRiabilitativa || $terapiaFarmacologica) {
		header('Location: ' . '/wildlife/controllers/dashboard/terapie/index.php');
	    }
	} else {
	    die("Errore nell'inserimento della terapia: " . $connection->error);
	}




	break;

    case "GET":

	$terapiaData = [];
	if (isset($_GET['id'])) {
	    $terapiaId = $_GET['id'];
	    $terapiaQuery = "SELECT T.*, TT.Descrizione AS Tipologia 
			     FROM terapia AS T
			     JOIN tipologia_terapia AS TT ON TT.Codice_terapia = T.Cod_tipologia_terapia
			     WHERE T.Codice_Terapia = $terapiaId";
	    $terapiaData = queryOneAssoc($terapiaQuery, $connection);
	    $tipologia = $terapiaData['Tipologia'];

	    $terapiaChirurgica = [];
	    $terapiaRiabilitativa = [];
	    $terapiaFarmacologica = [];
	    switch ($tipologia) {
		case 'Farmacologica/Medicale':

		    $queryFarmacologica = "SELECT Posologia, Frequenza, Durata, Data_Inizio, Note, MEDICINALE_VETERINARIO 
					    FROM terapia_farmacologica AS TF
	    				    JOIN farmaci AS F on TF.Codice_Farmaco = F.Codice_farmaco
					    WHERE Codice_Terapia = $terapiaId";
		    $terapiaFarmacologica = queryOneAssoc($queryFarmacologica, $connection);
		    if (!count($terapiaFarmacologica)) {
			die("Errore DB Terapia Farmacologica. Errore: " . $connection -> error);
		    }

		    break;

		case 'Chirurgica':

		    $queryChirurgica = "SELECT Descrizione, Stato, Durata_Intervento, Data_Intervento, Esito_operazione, Note 
					FROM terapia_chirurgica AS TC
					WHERE Codice_Terapia = $terapiaId";
		    $terapiaChirurgica = queryOneAssoc($queryChirurgica, $connection);
		    if (!count($terapiaChirurgica)) {
			die("Errore DB Terapia Chirurgica. Errore: " . $connection -> error);
		    }

		    break;

		case 'Riabilitativa':
		    $queryRiabilitativa = "SELECT Descrizione, Frequenza, Durata
					    FROM terapia_riabilitativa AS TR
					    WHERE Codice_Terapia = $terapiaId";
		    $terapiaRiabilitativa = queryOneAssoc($queryRiabilitativa, $connection);
		    if (!count($terapiaRiabilitativa)) {
			die("Errore DB Terapia Riabilitativa. Errore: " . $connection -> error);
		    }

		    break;
	    }

	    $queryOperatori = "SELECT DISTINCT Codice_utente AS Codice_operatore, Nome, Cognome FROM utenti AS U
			       JOIN tipologia_ruolo AS T ON T.Codice_Ruolo = U.Codice_Ruolo 
			       WHERE T.Denominazione IN ('Veterinario', 'Primario', 'Assistente')
			       ORDER BY 1 ASC;";
	    $operatoriData = queryAllAssoc($queryOperatori, $connection);

	    $queryDiagnosi = "SELECT DISTINCT Codice_Diagnosi FROM diagnosi ORDER BY 1 ASC";
	    $diagnosiData = queryAllAssoc($queryDiagnosi, $connection);
	}

	require $root . 'views/dashboard/pages/terapie/update.view.php';
}

?>
