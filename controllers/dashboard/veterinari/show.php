<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = "Scheda Veterinario";

$vetData = [];
$terapieData = [];
$trattamentiData = [];
$diagnosiData = [];
$esamiData = [];
if (isset($_GET['id'])) {

	$idVeterinario = $_GET['id'];

	$queryVeterinario = "SELECT Nome, Cognome, U.Telefono AS Telefono, Co.Comune AS Comune, Ce.Denominazione AS Centro
						 FROM utenti AS U
						 JOIN regprovcomune AS Co ON Co.Codice_Comune = U.Codice_Comune
						 JOIN anagrafica_centro AS Ce ON Ce.Codice_Centro = U.Codice_Centro
						 JOIN tipologia_ruolo AS R ON R.Codice_Ruolo = U.Codice_Ruolo
						 WHERE R.Denominazione = 'Veterinario' AND Codice_Utente = $idVeterinario";
	$vetData = queryOneAssoc($queryVeterinario, $connection);


	$queryDiagnosi = "SELECT D.Codice_Diagnosi, D.Codice_Scheda, D.Note
					  FROM diagnosi AS D
					  WHERE D.Codice_Operatore = $idVeterinario";
	$diagnosiData = queryAllNum($queryDiagnosi, $connection);
	$diagnosiFormat = [
		'columns' => ['Diagnosi', 'Scheda', 'Note'],
		'columns_type' => ['diagnosi_link',   'scheda_link', 'text'],
	];

	$queryTrattamenti = "SELECT T.Codice_Trattamento, T.Data_Trattamento, T.Note, F.MEDICINALE_VETERINARIO
					     FROM trattamento AS T JOIN terapia_farmacologica AS TF ON T.Cod_Tipologia_Terapia = TF.Cod_Terapia_Farmacologica
						 JOIN farmaci AS F on TF.Codice_Farmaco = F.Codice_farmaco
					     WHERE T.Cod_Operatore = $idVeterinario";
	$trattamentiData = queryAllNum($queryTrattamenti, $connection);
	$trattamentiFormat = [
		'columns' => ['Trattamento', 'Data Trattamento', 'Note', 'Medicinale'],
		'columns_type' => ['trattamento_link',   'text', 'text', 'text'	     ],
	];

	$queryTerapie = "SELECT T.Codice_Terapia, Data_Compilazione, T.Descrizione, TT.Descrizione AS Tipologia_Terapia
					 FROM terapia AS T
					 JOIN tipologia_terapia AS TT ON T.Cod_Tipologia_Terapia = TT.Codice_Terapia
					 WHERE T.Codice_Operatore = $idVeterinario";
	$terapieData = queryAllNum($queryTerapie, $connection);
	$terapieFormat = [
		'columns' => ['Terapia', 'Data Compilazione', 'Descrizione', 'Tipologia Terapia'],
		'columns_type' => ['terapia_link',   'text',              'text',        'text'	          ],
	];

	$queryEsami =        "SELECT P.Codice_Prescrizione, P.Codice_Diagnosi, P.Descrizione, P.Data_prescrizione, P.Sintesi_Esito
					     FROM prescrizione_esame AS P
						 JOIN utenti AS U on U.Codice_Utente = P.Codice_Operatore
					     WHERE P.Codice_Operatore = $idVeterinario";
	$esamiData = queryAllNum($queryEsami, $connection);
	$esamiFormat = [
		'columns' => ['Esame', 'Diagnosi', 'Descrizione',   'Data Prescrizione', 'Sintesi Esito'],
		'columns_type' => ['esame_link',   'diagnosi_link', 'text',  'text', 'text'	          ],
	];
}

require (__DIR__  . '/../../../views/dashboard/pages/veterinari/show.view.php');
