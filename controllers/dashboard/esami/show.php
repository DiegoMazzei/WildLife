<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = 'Visualizzazione Esame';

$esameData = [];
if (isset($_GET['id'])) {
	$idEsame = $_GET['id'];

	$esameQuery = "SELECT pe.*, E.Tipologia AS Tipologia_esame, CONCAT(Nome, ' ', Cognome) AS Operatore
				   FROM prescrizione_esame AS pe
				   JOIN utenti on pe.Codice_Operatore = utenti.Codice_Utente
				   JOIN esami_diagnostici AS E on E.Codice_esame = pe.Codice_esame
				   WHERE pe.Codice_Prescrizione = '$idEsame';";
	$esameData = queryOneAssoc($esameQuery, $connection);

	/* // Image Data
	$imageTimestamp = date("Y_m_d_H_i_s", strtotime($esameData['Data_arrivo']));
	$imageQuery = "SELECT * FROM documenti WHERE time_stamp = '$imageTimestamp'";
	$imageResult = queryOneAssoc($imageQuery, $connection);
	$imageFiletype = $imageResult['Estensione']; */

}

require (__DIR__  . '/../../../views/dashboard/pages/esami/show.view.php');
