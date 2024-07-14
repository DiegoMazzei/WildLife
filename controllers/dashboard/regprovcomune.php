<?php

include ('../../database.php');

$regione = $_POST['regione'];
$provincia = $_POST['provincia'];
$records = [];

if (isset($regione) && !isset($provincia)) {

	$query = "SELECT DISTINCT SiglaPR, Provincia FROM regprovcomune WHERE Regione='$regione' ORDER BY 1 ASC;";
	$result = $connection -> query($query);
	
	if ($result) {
		$records = $result -> fetch_all(MYSQLI_ASSOC);
		echo "<option value='' name='regione'>Seleziona la provincia</option>";
		foreach ($records as $record) {
			echo "<option value='{$record['SiglaPR']}'>{$record['Provincia']}</option>";
		}
	}

} elseif (isset($provincia) && !isset($regione)) {

	$query = "SELECT DISTINCT Comune, Codice_Comune FROM regprovcomune WHERE SiglaPR='$provincia' ORDER BY 1 ASC;";
	$result = $connection -> query($query);
	if ($result) {
		$records = $result -> fetch_all(MYSQLI_ASSOC);
	}

	if ($records) {
		echo "<option value='' name='regione'>Seleziona il comune</option>";
		foreach ($records as $record) {
			echo "<option name='comune' value='{$record['Codice_Comune']}'>{$record['Comune']}</option>";
		}
	}
}
