<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Modifica un esame";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

	$codicePrescrizione = $_POST["codicePrescrizione"];
	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$codiceEsame = $_POST["codiceEsame"];
	$descrizione = $_POST["descrizione"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$stato = $_POST["stato"];
	$sintesiEsito = $_POST["sintesiEsito"];
	$timestamp = date('Y_m_d_H_i_s', strtotime($_POST["timestamp"]));
	// $immagine= $_FILES['immagine'];

	date_default_timezone_set("Europe/Rome");
	$currentTimestamp = date('Y_m_d_H_i_s');

	/* $targetDir = $root . 'uploads/esami/';
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
	} */
	
	$queryEsame = "UPDATE prescrizione_esame 
		       SET Codice_Diagnosi = $codiceDiagnosi, 
			   Codice_Esame = $codiceEsame, 
		       	   Descrizione = '$descrizione', 
		       	   Codice_Operatore = $codiceOperatore, 
		       	   Stato = $stato, 
		       	   Sintesi_Esito = '$sintesiEsito',
			   Data_Referto = '$timestamp'
		       WHERE Codice_prescrizione = $codicePrescrizione";
	$esameQueryResult = $connection -> query($queryEsame);

	if ($esameQueryResult) {
	    header('Location: ' . '/wildlife/controllers/dashboard/esami/index.php');
	} else {
	    die("Errore nell'aggiornamento del esame" . $connection->error);
	}


	break;

    case "GET":

	if (isset($_GET['id']))	{
	    $esameId = $_GET['id'];

	    $esameQuery = "SELECT * FROM prescrizione_esame WHERE Codice_prescrizione = $esameId";
	    $esameData = queryOneAssoc($esameQuery, $connection);

	    $queryOperatori = "SELECT DISTINCT Codice_utente AS Codice_operatore, Nome, Cognome FROM utenti AS U
			       JOIN tipologia_ruolo AS T ON T.Codice_Ruolo = U.Codice_Ruolo 
			       WHERE T.Denominazione IN ('Veterinario', 'Primario', 'Assistente')
			       ORDER BY 1 ASC;";
	    $operatoriData = queryAllAssoc($queryOperatori, $connection);

	    $queryEsami = "SELECT DISTINCT Codice_Esame, Tipologia FROM esami_diagnostici ORDER BY 1 ASC";
	    $esamiData = queryAllAssoc($queryEsami, $connection);

	    $queryDiagnosi = "SELECT DISTINCT Codice_Diagnosi FROM diagnosi ORDER BY 1 ASC";
	    $diagnosiData = queryAllAssoc($queryDiagnosi, $connection);

	    require $root . 'views/dashboard/pages/esami/update.view.php';
	}
}

?>
