<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = "Scheda Utente";

$opData = [];
if (isset($_GET['id'])) {
	$idOperatore = $_GET['id'];
	$queryOperatore = "SELECT U.*, Co.Comune AS Comune, R.Denominazione, Stato
						 FROM utenti AS U
						 JOIN regprovcomune AS Co ON Co.Codice_Comune = U.Codice_Comune
						 JOIN anagrafica_centro AS Ce ON Ce.Codice_Centro = U.Codice_Centro
						 JOIN tipologia_ruolo AS R ON R.Codice_Ruolo = U.Codice_Ruolo
						 WHERE Codice_Utente = $idOperatore";


	$opData = queryOneAssoc($queryOperatore, $connection);
}

require (__DIR__  . '/../../../views/dashboard/pages/utenti/show.view.php');
