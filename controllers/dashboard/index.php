<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'database.php');
require ($root . 'functions/utility.php');

$title = 'Dashboard';

// Query
/*$queryAnimaliRicoverati = "SELECT COUNT(*) AS n_ricoverati FROM scheda_arrivo
						   WHERE Data_Esito_Finale IS NULL";
$queryTerapie = "SELECT COUNT(*) AS n_terapie FROM terapia";
$queryDiagnosi = "SELECT COUNT(*) AS n_diagnosi FROM diagnosi";
$queryEsami = "SELECT COUNT(*) AS n_esami FROM prescrizione_esame";

$joinTriage = "JOIN triage AS T ON S.Codice_Triage = T.Codice_Triage";
$queryBianchi = "SELECT COUNT(*) AS nBianchi FROM scheda_arrivo AS S
				$joinTriage
				WHERE T.Descrizione = 'Bianco'";

$queryRossi = "SELECT COUNT(*) AS nRossi FROM scheda_arrivo AS S
				$joinTriage
				WHERE T.Descrizione = 'Rosso'";
$queryVerdi = "SELECT COUNT(*) AS nVerdi FROM scheda_arrivo AS S
				$joinTriage
				WHERE T.Descrizione = 'Verde'";
$queryNeri = "SELECT COUNT(*) AS nNeri FROM scheda_arrivo AS S
				$joinTriage
				WHERE T.Descrizione = 'Nero'";
$queryGrigi = "SELECT COUNT(*) AS nGrigi FROM scheda_arrivo AS S
				$joinTriage
				WHERE T.Descrizione = 'Grigio'";

// Dati
*/
$queryAnimaliRicoverati = "SELECT COUNT(*) AS n_ricoverati FROM scheda_arrivo
						   WHERE Data_Esito_Finale IS NULL";
$queryTerapie = "SELECT COUNT(*) AS n_terapie FROM terapia";
$queryDiagnosi = "SELECT COUNT(*) AS n_diagnosi FROM diagnosi";
$queryEsami = "SELECT COUNT(*) AS n_esami FROM prescrizione_esame";

$animaliRicoverati = queryOneAssoc($queryAnimaliRicoverati, $connection)['n_ricoverati'];
$numDiagnosi = queryOneAssoc($queryDiagnosi, $connection)['n_diagnosi'];
$numTerapie = queryOneAssoc($queryTerapie, $connection)['n_terapie'];
$numEsami = queryOneAssoc($queryEsami, $connection)['n_esami'];
$numOperazioni = $numDiagnosi + $numTerapie + $numEsami;
/*
$nRossi = queryOneAssoc($queryRossi, $connection)['nRossi'];
$nBianchi = queryOneAssoc($queryBianchi, $connection)['nBianchi'];
$nVerdi = queryOneAssoc($queryVerdi, $connection)['nVerdi'];
$nGrigi = queryOneAssoc($queryGrigi, $connection)['nGrigi'];
$nNeri = queryOneAssoc($queryNeri, $connection)['nNeri'];

*/
include_once($root . 'views/dashboard/pages/dashboard.view.php');
