<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = "Scheda Soccorritori";

$socData = [];
$schedeData = [];

if (isset($_GET['id'])) {
	$idSoccorritore = $_GET['id'];
	$querySoccorritore = "SELECT Codice_Soccorritore, Cognome, Nome, Descrizione, Telefono, Email, Comune, Indirizzo
	FROM soccorritore JOIN regprovcomune ON soccorritore.Codice_Comune = regprovcomune.Codice_Comune
	JOIN tipologia_soccorritore ON soccorritore.Codice_Tip_Soccorritore = tipologia_soccorritore.Codice_Tip_Soccorritore
	WHERE soccorritore.Codice_Soccorritore = $idSoccorritore;";

	$socData = queryOneAssoc($querySoccorritore, $connection);

	$querySchede = "SELECT Codice_Accettazione, Data_Arrivo
	FROM scheda_arrivo 
	JOIN soccorritore ON soccorritore.Codice_Soccorritore = scheda_arrivo.Codice_Soccorritore;";


	$SchedeData = queryAllNum($querySchede, $connection);
	$table_data = [
		"columns" => ['Accettazione', 'Data di arrivo'],
		"columns_type" => ['scheda_link',    'text'],
	];
}

require (__DIR__  . '/../../../views/dashboard/pages/soccorritori/show.view.php');
