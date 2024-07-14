<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Trattamenti';

$query = "SELECT  Codice_Trattamento, Codice_Terapia, CONCAT(Nome, ' ', Cognome) AS Operatore, Data_Trattamento, TR.Note, Codice_Trattamento, Codice_Trattamento
		  FROM (trattamento AS TR JOIN terapia_farmacologica AS TF ON Cod_Tipologia_Terapia = Cod_Terapia_Farmacologica)
		  JOIN utenti AS U on Cod_Operatore = Codice_Utente
		  ORDER BY 1 ASC";
$result = $connection -> query($query);

if ($result) {
	$data =  $result -> fetch_all();
	$table_data = [
		"columns" =>	  ['Codice Trattamento', 'Codice Terapia', 'Operatore', 'Data Trattamento', 'Note', 'Modifica', 'Elimina'],
		"columns_type" => ['trattamento_link', 'terapia_link', 'text', 'text', 'text', 'trattamento_edit', 'trattamento_delete'],
	];

	include_once($root . '/views/dashboard/pages/trattamenti/index.view.php');
} else {
	echo "Errore SQL";
}