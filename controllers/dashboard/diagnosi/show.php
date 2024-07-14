<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = 'Visualizzazione Diagnosi';

$diagnosiId = [];
if (isset($_GET['id'])) {
	$diagnosiId = $_GET['id'];
	
	$diagnosiQuery = "SELECT Codice_Diagnosi, Codice_Scheda, E.Descrizione AS Stato_Epidermico, S.Descrizione AS Stato_Sensorio, Temperatura_Corporeaa AS Temperatura, Codice_Operatore, CONCAT(Nome, ' ', Cognome) AS Operatore, Note
					  FROM diagnosi AS D
					  JOIN stato_epidermico AS E ON E.Codice_Epidermico = D.Codice_Epidermico
					  JOIN stato_sensorio AS S ON S.Codice_Stato = D.Codice_Sensorio
					  JOIN utenti AS U ON U.Codice_Utente = D.Codice_Operatore
					  WHERE Codice_Diagnosi = $diagnosiId";
	$diagnosiData = queryOneAssoc($diagnosiQuery, $connection);

}

require (__DIR__  . '/../../../views/dashboard/pages/diagnosi/show.view.php');
