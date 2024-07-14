<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Schede';
$description = "Dashboard della clinica veterinaria Wild Life";
$keywords = 'dashboard wildlife animals rescue';

$query = "SELECT Codice_Accettazione, Data_Arrivo, Latitudine, Longitudine, Nome_taxon, CONCAT(Nome, ' ', Cognome) AS Operatore, Codice_Accettazione, Codice_Accettazione
		  FROM scheda_arrivo
		  JOIN utenti on scheda_arrivo.Codice_Operatore = utenti.Codice_Utente
		  JOIN specie_animali ON scheda_arrivo.Codice_animale = specie_animali.Codice_animale
		  ORDER BY 1 ASC";
$result = $connection -> query($query);

if ($result) {
	$data =  $result -> fetch_all();
	$table_data = [
		"columns" => ['Accettazione', 'Data di arrivo', 'Latitudine', 'Longitudine', 'Animale', 'Operatore', 'Modifica', 'Elimina'],
		"columns_type" => ['scheda_link',    'text',           'text',       'text',        'text',   'text',       'scheda_edit', 'scheda_delete'],
	];

	include_once($root . '/views/dashboard/pages/schede/index.view.php');
} else {
	echo "Errore SQL";
}
