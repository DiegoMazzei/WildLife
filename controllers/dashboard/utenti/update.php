<?php

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Modifica utente";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $indirizzo = $_POST["indirizzo"];
    $comune = $_POST["codiceComune"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $codiceCentro = $_POST["codiceCentro"];
    $id = $_POST["id"];
    $codiceRuolo = $_POST["codiceRuolo"];



    $query = "UPDATE utenti 
          SET Cognome = '$cognome', 
              Codice_comune = '$comune', 
              Indirizzo = '$indirizzo', 
              Telefono = '$telefono', 
              Nome = '$nome', 
              Email = '$email', 
              Password = '$password', 
              Codice_Centro = '$codiceCentro', 
              Codice_Ruolo = '$codiceRuolo'      
          WHERE Codice_Utente = '$id'";



    if ($connection->query($query) === TRUE) {
        header('Location: /wildlife/controllers/dashboard/utenti/index.php');
    } else {
        echo "Errore nell'aggiornamento del record: " . $connection->error;
    }
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {

    $queryRegioni = "SELECT DISTINCT Regione FROM regprovcomune ORDER BY 1 ASC;";
    $regioniData = queryAllAssoc($queryRegioni, $connection);

    include_once($root . 'views/dashboard/pages/utenti/update.view.php');
} else {
    echo "C'è stato un errore improvviso";
}
