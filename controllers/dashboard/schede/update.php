<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Modifica una scheda";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedaId = $_POST['schedaId'];
    $codiceComune = $_POST["codiceComune"];
    $codiceCentro = $_POST["codiceCentro"];
    $codiceAnimale = $_POST["codiceAnimale"];
    $codiceTriage = $_POST["codiceTriage"];
    $codiceSoccorritore = $_POST["codiceSoccorritore"];
    $codiceSviluppo = $_POST["codiceSviluppo"];
    $codiceRicovero = $_POST["codiceRicovero"];
    $codiceOperatore = $_POST["codiceOperatore"];
    $note = $_POST["note"];
    $latitudine = $_POST["latitudine"];
    $longitudine = $_POST["longitudine"];
    $immagine = $_FILES['immagine'];

    // Query Scheda Precedente
    $oldScheda = queryOneAssoc("SELECT * FROM scheda_arrivo WHERE Codice_Accettazione = '$schedaId'", $connection);
    $oldTimestamp = $oldScheda['Data_arrivo'];
    $oldTimestampFormat = date("Y_m_d_H_i_s", strtotime($oldScheda['Data_arrivo']));
    $oldImage = queryOneAssoc("SELECT * FROM documenti WHERE time_stamp = '$oldTimestamp'", $connection);

    // Si verifica se l'utente ha inserito una nuova immagine, da inserire al posto della precedente
    $correctReplacement = 1;
    if ($immagine['name'] != "") {
        $targetDir = $root . 'uploads/schede/';
        $fileType = pathinfo($immagine['name'], PATHINFO_EXTENSION);
        $correctReplacement = replaceImage($targetDir, $immagine, $oldTimestampFormat, $oldImage['Estensione'], $oldTimestampFormat);

        $queryAggiornamentoDoc = "UPDATE documenti SET Estensione = '$fileType' WHERE time_stamp = '$oldTimestamp';";
        $status = $connection -> query($queryAggiornamentoDoc);
        if (!$status) {
            die("Errore aggiornamento DB: " . $connection -> error);
        }
    }

    if (!$correctReplacement) {
        die("Errore aggiornamento immagine");
    }


    // Query Aggiornamento Scheda
    $queryScheda = "UPDATE scheda_arrivo
		    SET Codice_Centro = '$codiceCentro',
                        Codice_Animale = '$codiceAnimale',
                        Codice_Triage = '$codiceTriage',
                        Codice_Soccorritore = '$codiceSoccorritore',
                        Codice_Sviluppo = '$codiceSviluppo',
                        Codice_Ricovero = '$codiceRicovero',
                        Codice_Operatore = '$codiceOperatore',
                        Codice_Comune = '$codiceComune',
                        Note = '$note',
                        Latitudine = '$latitudine',
                        Longitudine = '$longitudine',
                        Data_Arrivo = '$oldTimestamp'
                    WHERE Codice_Accettazione = '$schedaId'";
    $schedaQueryResult = $connection -> query($queryScheda);

    // Update Esito e Data Esito
    if ($_POST['codiceEsito'] != "" && $_POST['dataEsito'] != "") {
        $codiceEsito = $_POST["codiceEsito"];
        $dataEsito = date("Y_m_d_H_i_s", strtotime($_POST["dataEsito"])); // Format del timestamp
        $queryEsito = "UPDATE scheda_arrivo
                        SET Cod_Esito_Finale = '$codiceEsito',
                            Data_Esito_Finale = '$dataEsito',
                            Data_Arrivo = '$oldTimestamp'
                        WHERE Codice_Accettazione = $schedaId";
        $esitoUpdateResult = $connection -> query($queryEsito);
    }

    if ($schedaQueryResult) {
	header('Location: ' . '/wildlife/controllers/dashboard/schede/index.php');
    } else {
	echo "Errore nell'inserimento del veterinario: " . $connection->error;
    }

} else if (isset($_GET['id'])){

    $schedaId = $_GET['id'];

    $queryScheda = "SELECT S.*, C.SiglaPR, C.Regione, C.Provincia, C.Comune FROM scheda_arrivo AS S
                    JOIN regprovcomune AS C ON C.Codice_comune = S.Codice_Comune 
                    WHERE Codice_accettazione = $schedaId";
    $schedaData = queryOneAssoc($queryScheda, $connection);

    $queryRegioni = "SELECT DISTINCT Codice_comune, Regione FROM regprovcomune ORDER BY 1 ASC;";
    $regioniData = queryAllAssoc($queryRegioni, $connection);


    $queryProvince = "SELECT DISTINCT Provincia, SiglaPR FROM regprovcomune 
                      WHERE Regione = '" . $schedaData['Regione'] . "'
                      ORDER BY 1 ASC;";
    $provinceData = queryAllAssoc($queryProvince, $connection);


    $queryComuni = "SELECT DISTINCT Codice_Comune, Comune FROM regprovcomune 
                      WHERE SiglaPR = '" . $schedaData['SiglaPR'] . "'
                      ORDER BY 1 ASC;";
    $comuniData = queryAllAssoc($queryComuni, $connection);

    $queryCentri = "SELECT DISTINCT Codice_centro, Denominazione FROM anagrafica_centro ORDER BY 1 ASC;";
    $centriData = queryAllAssoc($queryCentri, $connection);

    $queryAnimali = "SELECT DISTINCT Codice_animale, Nome_Taxon FROM specie_animali ORDER BY 1 ASC;";
    $animaliData = queryAllAssoc($queryAnimali, $connection);

    $querySviluppo = "SELECT DISTINCT Codice_fase, Descrizione FROM fase_sviluppo ORDER BY 1 ASC;";
    $sviluppoData = queryAllAssoc($querySviluppo, $connection);

    $querySoccorritori = "SELECT DISTINCT Codice_soccorritore, Nome, Cognome FROM soccorritore ORDER BY 1 ASC;";
    $soccorritoriData = queryAllAssoc($querySoccorritori, $connection);

    $queryTriage = "SELECT DISTINCT Codice_triage, Descrizione FROM triage ORDER BY 1 ASC;";
    $triageData = queryAllAssoc($queryTriage, $connection);

    $queryRicoveri = "SELECT DISTINCT Codice_ricovero, Descrizione FROM causa_ricovero ORDER BY 1 ASC;";
    $ricoveriData = queryAllAssoc($queryRicoveri, $connection);

    $queryOperatori = "SELECT DISTINCT Codice_utente AS Codice_operatore, Nome, Cognome FROM utenti ORDER BY 1 ASC;";
    $operatoriData = queryAllAssoc($queryOperatori, $connection);

    $queryEsiti = "SELECT DISTINCT Codice_Esito, Descrizione FROM esito ORDER BY 1 ASC";
    $esitiData = queryAllAssoc($queryEsiti, $connection);

}

require $root . 'views/dashboard/pages/schede/update.view.php';

?>
