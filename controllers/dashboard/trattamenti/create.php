<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Crea un trattamento";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    $codOperatore = $_POST["codOperatore"];
    $codTerapia = $_POST["codTerapia"];
    $descrizione = $_POST["descrizione"];
    date_default_timezone_set("Europe/Rome");
    $dataTrattamento = date("Y_m_d_H_i_s", strtotime($_POST["dataTrattamento"]));   	


    $query = "INSERT INTO trattamento (Cod_Tipologia_Terapia, Cod_Operatore , Data_Trattamento, Note)
              VALUES ('$codTerapia', '$codOperatore', '$dataTrattamento', '$descrizione')";

    if ($connection->query($query)) {
        header('Location: ' . '/wildlife/controllers/dashboard/trattamenti/index.php');
    } else {
        echo "Errore nell'inserimento del soccorritore: " . $connection->error;
    }
} else {
    require $root . 'views/dashboard/pages/trattamenti/create.view.php';
}
?>
