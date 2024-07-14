<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Esami';

$query = "SELECT Codice_Prescrizione, Codice_Diagnosi, E.Tipologia, Data_prescrizione, CONCAT(Nome, ' ', Cognome) AS Operatore, Codice_Prescrizione, Codice_Prescrizione
		  FROM prescrizione_esame AS P
		  JOIN utenti on P.Codice_Operatore = utenti.Codice_Utente
		  JOIN esami_diagnostici AS E on E.Codice_esame = P.Codice_esame
		  ORDER BY 1 ASC";
$result = $connection -> query($query);

if ($result) {
	$data =  $result -> fetch_all();
	$table_data = [
		"columns" => ['Prescrizione', 'Diagnosi', 'Tipologia Esame', 'Data Prescrizione', 'Operatore', 'Modifica', 'Elimina'],
		"columns_type" => ['prescrizione_link', 'diagnosi_link','text',            'text',              'text',		 'esame_edit',   'esami_delete'],
	];

	include_once($root . '/views/dashboard/pages/esami/index.view.php');
} else {
	echo "Errore SQL";
}
