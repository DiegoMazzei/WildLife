<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'database.php');

$title = 'Utenti';
$description = "Storico delle operazioni della clinica veterinaria Wild Life";
$keywords = 'dashboard wildlife animals rescue';

$query = "SELECT Codice_Utente, Cognome, Nome, t.Denominazione AS Ruolo, u.Telefono, u.Email, rpc.Comune, u.Indirizzo, ac.Denominazione, u.Stato, u.Codice_Utente
		  FROM (utenti AS u JOIN tipologia_ruolo AS t ON u.Codice_Ruolo = t.Codice_Ruolo) 
		  JOIN regprovcomune AS rpc ON u.Codice_comune = rpc.Codice_comune
		  JOIN anagrafica_centro AS ac ON ac.Codice_Centro = u.Codice_Centro";
$result = $connection -> query($query);
if ($result) {
	$data = $result -> fetch_all();
	
	$table_data = [
		"columns" => ['Utente', 'Cognome', 'Nome', 'Ruolo', 'Telefono', 'Email', 'Comune', 'Indirizzo', 'Centro', 'Stato', 'Modifica'],
		"columns_type" => ['user_link', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'text', 'user_state','user_edit'],
	];

include_once($root .'/views/dashboard/pages/utenti/index.view.php');
} else {
	echo "Errore query SQL";
}

