<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');

$title = "Modifica Soccorritore";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $indirizzo = $_POST["indirizzo"];
    $comune = $_POST["codiceComune"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $tipologia = $_POST["tipologia"];

    $query = "UPDATE soccorritore SET 
    Nome = '$nome',
    Cognome = '$cognome',
    Indirizzo = '$indirizzo',
    Codice_Comune = '$comune',
    Telefono = '$telefono',
    Email = '$email',
    Codice_Tip_Soccorritore = '$tipologia'
    WHERE Codice_Soccorritore = '$id'";


    if ($connection->query($query) === TRUE) {
        header('Location: /wildlife/controllers/dashboard/soccorritori/index.php');
    } else {
        echo "Errore nell'aggiornamento del record: " . $connection->error;
    }
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
    include_once($root . 'views/dashboard/pages/soccorritori/update.view.php');
} else {
    echo "C'è stato un errore improvviso";
}

echo "<br>";
echo "<a href='index.php'>Torna alla lista</a>";
echo "</br>";


