<?php

/*
Controllo username e password per l'accesso alla dashboard
*/
session_start();

$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require $root . '/database.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {

    // Lettura email e password dal POST del form
    $username = htmlspecialchars($_POST['username']);
    $password = md5(htmlspecialchars($_POST['password']));

    // Interrogazione al DB
    $query = "SELECT utenti.*, tipologia_ruolo.Denominazione FROM utenti JOIN tipologia_ruolo ON tipologia_ruolo.Codice_Ruolo = utenti.Codice_Ruolo WHERE user = '{$username}';";
    $result = $connection -> query($query);
    $record = $result -> fetch_assoc();

    // Si verifica che nel DB ci sia una corrispondenza
    if ($result -> num_rows === 1) {
        $dbPassword = $record['Password'];
        if ($dbPassword === $password) {
            if ($record['Stato']) {
                $_SESSION['id'] = $record['Codice_Utente'];
                $_SESSION['Stato'] = $record['Stato'];;
                $_SESSION['Ruolo'] = $record['Denominazione'];
                $url = '/wildlife/controllers/dashboard/';
                header('Location: ' . $url); // Reindirizzamento sulla dashboard
            } else {
                die('Account disattivato');
            }
        } else {
            echo "La password è errata";
            die();
        }
    } else {
        echo "L'account non esiste";
        die();
    }
}
