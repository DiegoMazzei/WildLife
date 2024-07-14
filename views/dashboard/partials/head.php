<?php
session_start(); 
if (!isset($_SESSION['id'])){

    $url = '/wildlife/controllers/dashboard/login/login.php';
    header('Location: ' . $url);
    
} else {
    $queryUtente = "SELECT Stato FROM utenti WHERE Codice_Utente = " . $_SESSION['id'];
    $utenteData = $connection -> query($queryUtente) -> fetch_assoc();
    // var_dump($utenteData);
    // die();

    // Fa il logout se lo stato è cambiato nel mentre che l'utente è loggato
    if ($_SESSION['Stato'] !== $utenteData['Stato']) {
        $url = '/wildlife/controllers/dashboard/login/logout.php';
        header('Location: ' . $url);
        die();
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta name="description" content="Descrizione">
        <meta name="keywords" content="dashboard animali schede clinica">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/wildlife/views/dashboard/icons/favicon.svg" rel="icon">

        <style>
            <?php include $root . '/views/dashboard/styles/main.css'; ?>
        </style>

        

    </head>
    <body>
