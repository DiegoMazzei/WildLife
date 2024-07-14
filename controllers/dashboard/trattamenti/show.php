<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require ($root . 'functions/table.php');
require ($root . 'functions/utility.php');
require ($root . 'database.php');

$title = "Scheda Trattamenti";

$trattData = [];
if (isset($_GET['id'])) {
	$idTrattamento = $_GET['id'];
	$queryTrattamento = "SELECT Codice_Trattamento, Cod_Tipologia_Terapia, Cod_Operatore , Data_Trattamento, Note
						 FROM trattamento
						 WHERE Codice_Trattamento = $idTrattamento";

	$trattData = queryOneAssoc($queryTrattamento, $connection);

}

require (__DIR__  . '/../../../views/dashboard/pages/trattamenti/show.view.php');
