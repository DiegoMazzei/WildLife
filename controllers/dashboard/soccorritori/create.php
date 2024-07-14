<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Crea un soccorritore";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $indirizzo = $_POST["indirizzo"];
    $comune = $_POST["comune"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $tipologia = $_POST["tipologia"];

    $query = "INSERT INTO soccorritore (Cognome, Nome, Codice_Tip_Soccorritore , Telefono, Email, Codice_Comune, Indirizzo)
              VALUES ('$cognome', '$nome', '$tipologia', '$telefono', '$email', '$comune', '$indirizzo')";

    if ($connection->query($query)) {
        header('Location: ' . '/wildlife/controllers/dashboard/soccorritori/index.php');
    } else {
        echo "Errore nell'inserimento del soccorritore: " . $connection->error;
    }
} else {
    require $root . 'views/dashboard/pages/soccorritori/create.view.php';
}
?>
