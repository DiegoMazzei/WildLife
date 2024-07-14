<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Crea una scheda";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

	$note = $_POST["note"];
	$latitudine = $_POST["latitudine"];
	$longitudine = $_POST["longitudine"];
	$codiceComune = $_POST["codiceComune"];
	$codiceCentro = $_POST["codiceCentro"];
	$codiceAnimale = $_POST["codiceAnimale"];
	$codiceTriage = $_POST["codiceTriage"];
	$codiceSoccorritore = $_POST["codiceSoccorritore"];
	$codiceSviluppo = $_POST["codiceSviluppo"];
	$codiceRicovero = $_POST["codiceRicovero"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$immagine= $_FILES['immagine'];

	date_default_timezone_set("Europe/Rome");
	$currentTimestamp = date('Y_m_d_H_i_s');
	$targetDir = $root . 'uploads/schede/';
	$fileType = pathinfo($immagine['name'])['extension'];
	$correctUpload = uploadImage($targetDir, $immagine, $currentTimestamp);

	$imageDatabaseUpload = true;
	if ($correctUpload) {

	    // Query Inserimento Documento nel DB
	    $queryEntityDocumento = "INSERT INTO entity_documento VALUES ('$currentTimestamp')";
	    $entityQueryResult = $connection -> query($queryEntityDocumento);

	    $queryTipologiaDocumento = "SELECT Codice_Tip_documento AS Codice FROM tipologia_documento WHERE Descrizione = 'fotografia'";
	    $tipologiaResult = queryOneAssoc($queryTipologiaDocumento, $connection);
	    $codiceTipologia = $tipologiaResult['Codice'];

	    $queryDocumento = "INSERT INTO documenti(Tipologia, Estensione, Descrizione, time_stamp) VALUES ($codiceTipologia, '$fileType', '', '$currentTimestamp')";
	    $entityQueryResult = $connection -> query($queryDocumento);
	    if (!$entityQueryResult || empty($tipologiaResult) || !$entityQueryResult) {
		echo "Errore nell'inserimento dell'immagine nel DB : " . $connection->error;
		$imageDatabaseUpload = false;
		die();
	    }

	} else {
	    echo "Errore nell'caricamento dell'immagine";
	    die();
	}

	$schedaQueryResult = null;
	if ($imageDatabaseUpload) {
	    $queryScheda = "INSERT INTO scheda_arrivo (Codice_Centro, Codice_Animale, Codice_Comune, Codice_Sviluppo, Codice_Ricovero, Codice_Triage, Codice_Operatore, Codice_Soccorritore, Note, Latitudine, Longitudine, Data_arrivo) 
	    VALUES ('$codiceCentro', '$codiceAnimale', '$codiceComune', '$codiceSviluppo', '$codiceRicovero', '$codiceTriage', '$codiceOperatore', '$codiceSoccorritore', '$note', '$latitudine', '$longitudine', '$currentTimestamp')";
	    $schedaQueryResult = $connection -> query($queryScheda);
	}

	if ($schedaQueryResult) {
	    header('Location: ' . '/wildlife/controllers/dashboard/schede/index.php');
	} else {
	    die("Errore nell'inserimento del veterinario: " . $connection->error);
	}

	break;

    case "GET":

	$queryRegioni = "SELECT DISTINCT Regione FROM regprovcomune ORDER BY 1 ASC;";
	$regioniData = queryAllAssoc($queryRegioni, $connection);

	$queryCentri = "SELECT DISTINCT Codice_centro, Denominazione FROM anagrafica_centro ORDER BY 1 ASC;";
	$centriData = queryAllAssoc($queryCentri, $connection);

	$queryTriage = "SELECT DISTINCT Codice_triage, Descrizione FROM triage ORDER BY 1 ASC;";
	$triageData = queryAllAssoc($queryTriage, $connection);

	$querySoccorritori = "SELECT DISTINCT Codice_soccorritore, Nome, Cognome FROM soccorritore ORDER BY 1 ASC;";
	$soccorritoriData = queryAllAssoc($querySoccorritori, $connection);

	$queryAnimali = "SELECT DISTINCT Codice_animale, Nome_taxon FROM specie_animali ORDER BY 1 ASC;";
	$animaliData = queryAllAssoc($queryAnimali, $connection);

	$querySviluppo = "SELECT DISTINCT Codice_fase, Descrizione FROM fase_sviluppo ORDER BY 1 ASC;";
	$sviluppoData = queryAllAssoc($querySviluppo, $connection);

	$queryRicoveri = "SELECT DISTINCT Codice_ricovero, Descrizione FROM causa_ricovero ORDER BY 1 ASC;";
	$ricoveriData = queryAllAssoc($queryRicoveri, $connection);

	$queryOperatori = "SELECT DISTINCT Codice_utente AS Codice_operatore, Nome, Cognome FROM utenti ORDER BY 1 ASC;";
	$operatoriData = queryAllAssoc($queryOperatori, $connection);

	require $root . 'views/dashboard/pages/schede/create.view.php';
}

?>
