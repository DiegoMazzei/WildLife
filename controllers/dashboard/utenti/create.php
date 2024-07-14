<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/wildlife/';
require($root . 'database.php');
require($root . 'functions/utility.php');

$title = "Crea un utente";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $indirizzo = $_POST["indirizzo"];
    $comune = $_POST["codiceComune"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $codiceCentro = $_POST["codiceCentro"];
    $codiceRuolo = $_POST["codiceRuolo"];

    // Password criptata con Hash MD5, in modo da non tenere le password in plaintext
    $hashedPassword = md5($password); 
    $query = "INSERT INTO utenti (Codice_Utente, Cognome, Codice_comune, Indirizzo, Telefono, Nome, Email, User, Password, Codice_Ruolo, Codice_Centro)
              VALUES (NULL, '$cognome', '$comune', '$indirizzo', '$telefono', '$nome', '$email', '$username', '$hashedPassword', '$codiceRuolo', '$codiceCentro')";

    if ($connection->query($query)) {
        header('Location: ' . '/wildlife/controllers/dashboard/utenti/index.php');
    } else {
        echo "Errore nell'inserimento del veterinario: " . $connection->error;
    }
} else {

    $queryRegioni = "SELECT DISTINCT Regione FROM regprovcomune ORDER BY 1 ASC;";
    $regioniData = queryAllAssoc($queryRegioni, $connection);

    require $root . 'views/dashboard/pages/utenti/create.view.php';
}

?>
