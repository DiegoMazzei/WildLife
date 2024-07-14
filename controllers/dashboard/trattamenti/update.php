<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Aggiorna un trattamento";

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
		// Variabili POST
		date_default_timezone_set("Europe/Rome");
		$codiceTrattamento = $_POST['codiceTrattamento'];
		$codiceTerapia = $_POST["codiceTerapia"];
		$codiceOperatore = $_POST["codiceOperatore"];
		$dataTrattamento = $_POST['dataTrattamento'];
		$note = $_POST['noteTrattamento'];

		// Query inserimento trattamento
		$queryTrattamento = "UPDATE trattamento 
							SET Cod_Tipologia_Terapia = $codiceTerapia, 
							Cod_Operatore = $codiceOperatore,
							Data_Trattamento = '$dataTrattamento',
							Note = '$note'
							WHERE Codice_Trattamento = $codiceTrattamento";
		$trattamentoQueryResult = $connection -> query($queryTrattamento);

		if ($trattamentoQueryResult) {
		header('Location: ' . '/wildlife/controllers/dashboard/trattamenti/index.php');
		} else {
			die("Errore nell'inserimento del trattamento: " . $connection->error);
		}
		break;

    case "GET":
		$trattamentoData = [];
		if (isset($_GET['id'])) {
			$trattamentoId = $_GET['id'];
			$trattamentoQuery = "SELECT T.*
								 FROM trattamento AS T
								 WHERE T.Codice_Trattamento = $trattamentoId";
			$trattamentoData = queryOneAssoc($trattamentoQuery, $connection);
			$dataTrattamento = date("Y-m-d", strtotime($trattamentoData['Data_Trattamento']));
			
			$query_utente = "SELECT DISTINCT Codice_Utente, Nome, Cognome FROM utenti AS U
					   JOIN tipologia_ruolo AS T ON T.Codice_Ruolo = U.Codice_Ruolo 
					   WHERE T.Denominazione IN ('Veterinario', 'Primario', 'Assistente')
					   ORDER BY 1 ASC;";
			$operatoriData = queryAllAssoc($query_utente, $connection);

			$queryTerapia = "SELECT DISTINCT Cod_Terapia_Farmacologica FROM terapia_farmacologica ORDER BY 1 ASC";
			$terapiaData = queryAllAssoc($queryTerapia, $connection);
		}

		require $root . 'views/dashboard/pages/trattamenti/update.view.php';
}

?>
