<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Veterinari';
$description = "Schede operatori della clinica veterinaria Wild Life";
$keywords = 'dashboard wildlife animals rescue operatori operators veterinari vet';

$query = "SELECT Codice_Utente, Nome, Cognome, a.Denominazione
		  FROM utenti AS u JOIN tipologia_ruolo AS t ON u.Codice_Ruolo = t.Codice_Ruolo
		  JOIN anagrafica_centro AS a ON u.Codice_Centro = a.Codice_Centro
		  WHERE t.Denominazione = 'Veterinario';";
$result = $connection -> query($query);
if ($result) {
	$data = $result -> fetch_all();
	
	$table_data = [
		"columns" => ['Veterinario', 'Nome', 'Cognome', 'Centro'],
		"columns_type" => ['vet_link', 'text', 'text', 'text'],
	];

	include_once($root . '/views/dashboard/pages/veterinari/index.view.php');
} else {
	echo "Errore query SQL";
}

