<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Terapie';

$query = "SELECT T.Codice_Terapia, T.Codice_Diagnosi, TT.Descrizione, T.Descrizione, Data_compilazione, CONCAT(Nome, ' ', Cognome) AS Operatore, T.Codice_Terapia, T.Codice_Terapia
		  FROM terapia AS T
		  JOIN utenti AS U on T.Codice_Operatore = U.Codice_Utente
		  JOIN tipologia_terapia AS TT on TT.Codice_terapia = T.Cod_Tipologia_Terapia
		  ORDER BY 1 ASC";
$result = $connection -> query($query);

if ($result) {
	$data =  $result -> fetch_all();
	$table_data = [
		"columns" =>	  ['Terapia',      'Diagnosi',     'Tipologia Terapia', 'Descrizione', 'Data Prescrizione', 'Operatore', 'Modifica', 'Elimina'],
		"columns_type" => ['terapia_link', 'diagnosi_link','text',              'text',        'text',              'text',	  'terapia_edit', 'terapie_delete'],
	];

	include_once($root . '/views/dashboard/pages/terapie/index.view.php');
} else {
	echo "Errore SQL";
}
