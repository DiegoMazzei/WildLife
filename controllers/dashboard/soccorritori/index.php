<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Soccorritori';
$description = "Schede Soccorritori della clinica veterinaria Wild Life";
$keywords = 'dashboard wildlife animals rescue Soccorritori';

$query = "SELECT Codice_Soccorritore, Cognome, Nome, Descrizione, Telefono, Email, Comune, Indirizzo, Codice_Soccorritore
		  FROM soccorritore JOIN regprovcomune ON soccorritore.Codice_Comune = regprovcomune.Codice_Comune
		  JOIN tipologia_soccorritore ON soccorritore.Codice_Tip_Soccorritore = tipologia_soccorritore.Codice_Tip_Soccorritore
		  ORDER BY 1;";
$result = $connection -> query($query);
if ($result) {
	$data = $result -> fetch_all();
	
	$table_data = [
		"columns" => ['Soccorritore', 'Cognome', 'Nome', 'Descrizione', 'Telefono', 'Email', 'Comune', 'Indirizzo', 'Modifica'],
		"columns_type" => ['socc_link', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'socc_edit'],
	];

	include_once($root . '/views/dashboard/pages/soccorritori/index.view.php');
} else {
	echo "Errore query SQL";
}

