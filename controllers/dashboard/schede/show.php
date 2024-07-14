<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = 'Visualizzazione Scheda';

$schedaData = [];
if (isset($_GET['id'])) {
	$idScheda = $_GET['id'];

	$schedaQuery = "SELECT sa.*, sp.Classe_italiano AS Animale, Comune, ac.Denominazione AS Centro, E.Descrizione AS Esito,
					fs.Descrizione AS Fase_sviluppo, CONCAT(socc.Nome, ' ', socc.Cognome) AS Soccorritore, CONCAT(u.Nome, ' ', u.Cognome) AS Operatore,
					triage.Descrizione AS Triage, cr.Descrizione AS Ricovero, Data_arrivo
					FROM scheda_arrivo AS sa
					LEFT JOIN esito AS E ON E.Codice_Esito = sa.Cod_Esito_Finale
					JOIN soccorritore AS socc ON socc.Codice_Soccorritore = sa.Codice_Soccorritore
					JOIN utenti AS u ON u.Codice_Utente = sa.Codice_Operatore
					JOIN specie_animali AS sp ON sp.Codice_animale = sa.Codice_animale
					JOIN regprovcomune AS rpc ON rpc.Codice_comune = sa.Codice_comune
					JOIN anagrafica_centro AS ac ON ac.Codice_centro = sa.Codice_centro
					JOIN fase_sviluppo AS fs ON fs.Codice_fase = sa.Codice_Sviluppo
					JOIN triage ON triage.Codice_triage = sa.Codice_triage
					JOIN causa_ricovero AS cr ON cr.Codice_ricovero = sa.Codice_ricovero
					WHERE sa.Codice_accettazione = '$idScheda';";

	$schedaData = queryOneAssoc($schedaQuery, $connection);

	// Image Data
	$imageTimestamp = date("Y_m_d_H_i_s", strtotime($schedaData['Data_arrivo']));
	$imageQuery = "SELECT * FROM documenti WHERE time_stamp = '$imageTimestamp'";
	$imageResult = queryOneAssoc($imageQuery, $connection);
	$imageFiletype = $imageResult['Estensione'];

}

require (__DIR__  . '/../../../views/dashboard/pages/schede/show.view.php');
