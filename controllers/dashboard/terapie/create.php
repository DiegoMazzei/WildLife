<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Crea una terapia";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

	// Variabili POST
	date_default_timezone_set("Europe/Rome");
	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$tipologiaTerapia = $_POST["codiceTipologia"];
	$descrizione = $_POST["descrizione"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$currentTimestamp = date('Y_m_d_H_i_s');

	// Query Tipologie Terapie
	$tipologieQuery = "SELECT Descrizione FROM tipologia_terapia WHERE Codice_Terapia = " . $tipologiaTerapia;
	$tipologieData = queryOneAssoc($tipologieQuery, $connection);
	$tipologia = $tipologieData['Descrizione'];

	// Query inserimento terapia
	$queryTerapia = "INSERT INTO terapia (Codice_Diagnosi, Cod_Tipologia_Terapia, Descrizione, Data_Compilazione, Codice_Operatore)
			 VALUES ($codiceDiagnosi, $tipologiaTerapia, '$descrizione', '$currentTimestamp', $codiceOperatore)";
	$terapiaQueryResult = $connection -> query($queryTerapia);
	$terapiaId = $connection -> insert_id;

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

		    $queryFarmacologica = "INSERT INTO terapia_farmacologica (Data_Compilazione, Codice_Terapia, Codice_Farmaco, Posologia, Frequenza, Durata, Data_inizio, Note)
					VALUES ('$currentTimestamp', $terapiaId, $codiceFarmaco, '$posologia', '$frequenza', '$durata', '$dataInizio', '$note')";
		    $terapiaFarmacologica = $connection -> query($queryFarmacologica);

		    break;
		case 'Chirurgica':
		    
		    $descrizioneChirurgica = $_POST['descrizioneChirurgica'];
		    $stato = $_POST['stato'];
		    $durata = $_POST['durata'];
		    $dataOperazione = $_POST['dataOperazione'];
		    $esito = $_POST['esito'];
		    $note = $_POST['note'];

		    $queryChirurgica = "INSERT INTO terapia_chirurgica (Codice_Terapia, Data_Compilazione, Descrizione, Stato, Data_Intervento, Cod_Operatore, Durata_intervento, Esito_operazione, Note)
					VALUES ($terapiaId, '$currentTimestamp', '$descrizioneChirurgica', '$stato', '$dataOperazione', '$codiceOperatore', '$durata', '$esito', '$note')";
		    $terapiaChirurgica = $connection -> query($queryChirurgica);

		    break;
		case 'Riabilitativa':
		    $descrizioneRiabilitativa = $_POST['descrizioneRiabilitativa'];
		    $frequenza = $_POST['frequenza'];
		    $durata = $_POST['durata'];

		    $queryRiabilitativa = "INSERT INTO terapia_riabilitativa (Codice_Terapia, Descrizione, Frequenza, Durata, Data_Compilazione)
					VALUES ($terapiaId, '$descrizioneRiabilitativa', '$frequenza', '$durata', '$currentTimestamp')";
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

	$queryOperatori = "SELECT DISTINCT Codice_utente AS Codice_operatore, Nome, Cognome FROM utenti AS U
			   JOIN tipologia_ruolo AS T ON T.Codice_Ruolo = U.Codice_Ruolo 
			   WHERE T.Denominazione IN ('Veterinario', 'Primario', 'Assistente')
			   ORDER BY 1 ASC;";
	$operatoriData = queryAllAssoc($queryOperatori, $connection);

	$queryDiagnosi = "SELECT DISTINCT Codice_Diagnosi FROM diagnosi ORDER BY 1 ASC";
	$diagnosiData = queryAllAssoc($queryDiagnosi, $connection);

	$queryTipologie = "SELECT DISTINCT Codice_Terapia, Descrizione FROM tipologia_terapia ORDER BY 1 ASC";
	$tipologieData = queryAllAssoc($queryTipologie, $connection);

	require $root . 'views/dashboard/pages/terapie/create.view.php';
}

?>
