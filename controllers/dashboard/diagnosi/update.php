<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Modifica una diagnosi";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":

	$codiceDiagnosi = $_POST["codiceDiagnosi"];
	$codiceScheda = $_POST["codiceScheda"];
	$codiceEpidermico = $_POST["codiceEpidermico"];
	$codiceSensorio = $_POST["codiceSensorio"];
	$temperatura= $_POST["temperatura"];
	$codiceOperatore = $_POST["codiceOperatore"];
	$note = $_POST["note"];

	$queryDiagnosi = "UPDATE diagnosi 
			   SET Codice_Diagnosi = $codiceDiagnosi, 
			       Codice_Scheda = $codiceScheda,
			       Codice_Epidermico = $codiceEpidermico,
			       Codice_Sensorio = $codiceSensorio,
			       Temperatura_Corporeaa = $temperatura,
			       Codice_Operatore = $codiceOperatore, 
			       Note = '$note'
			       WHERE Codice_diagnosi = $codiceDiagnosi";
	$diagnosiQueryResult = $connection -> query($queryDiagnosi);

	if ($diagnosiQueryResult) {
	    header('Location: ' . '/wildlife/controllers/dashboard/diagnosi/index.php');
	} else {
	    die("Errore nell'aggiornamento del esame" . $connection->error);
	}

	break;

    case "GET":

	if (isset($_GET['id']))	{
	    $diagnosiId = $_GET['id'];

	    $queryDiagnosi = "SELECT * FROM diagnosi WHERE Codice_Diagnosi = $diagnosiId";
	    $diagnosiData = queryOneAssoc($queryDiagnosi, $connection);

	    $querySchede = "SELECT DISTINCT Codice_Accettazione FROM scheda_arrivo ORDER BY 1 ASC";
	    $schedeData = queryAllAssoc($querySchede, $connection);

	    $queryEpidermico = "SELECT DISTINCT Codice_Epidermico, Descrizione FROM stato_epidermico ORDER BY 1 ASC";
	    $epidermicoData = queryAllAssoc($queryEpidermico, $connection);

	    $querySensorio = "SELECT DISTINCT Codice_Stato, Descrizione FROM stato_sensorio ORDER BY 1 ASC";
	    $sensorioData = queryAllAssoc($querySensorio, $connection);

	    $queryOperatori = "SELECT DISTINCT Codice_Utente AS Codice_operatore, Nome, Cognome
			       FROM utenti AS U
			       JOIN tipologia_ruolo AS R ON R.Codice_Ruolo = U.Codice_Ruolo
			       WHERE R.Denominazione = 'Veterinario'
                               ORDER BY Codice_Utente ASC;";
	    $operatoriData = queryAllAssoc($queryOperatori, $connection);

	    require $root . 'views/dashboard/pages/diagnosi/update.view.php';
	}
}

?>
