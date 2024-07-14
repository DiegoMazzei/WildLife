<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');

if (isset($_GET["id"]) && isset($_GET['stato'])) {

    $idUtente = $_GET['id'];

    $Stato = null;
    switch ($_GET['stato']) {
        case "1":
            $Stato = 0;
            break;
        case "0":
            $Stato = 1;
            break;
    }

    $query = "UPDATE utenti SET Stato='$Stato' WHERE Codice_Utente='$idUtente'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header('Location: /wildlife/controllers/dashboard/utenti/index.php');
        exit();
    } else {
        echo "Errore nell'aggiornamento dello stato dell'utente: " . mysqli_error($connection);
    }
}
?>
