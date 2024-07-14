<?php
    
    $root = $_SERVER['DOCUMENT_ROOT']. '/wildlife/';

    include_once($root . "database.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $codSchede = $_POST['codSchede'];
        $st_epidermico = $_POST['st_epidermico'];
        $st_sensorio = $_POST['st_sensorio'];
        $temperatura = $_POST['temperatura'];
        $operatore = $_POST['operatore'];
        if ($_POST['note'] == '') {

            $note = '';

        }

        else {

            $note = $_POST['note'];

        }

        $query = "INSERT INTO diagnosi
                  VALUES (NULL, $codSchede, $st_epidermico, $st_sensorio, $temperatura, $operatore, '$note')";

        $result = $connection -> query($query);

        if ($result) {

            header ("Location: /wildlife/controllers/dashboard/diagnosi/index.php");

        }

        else {

            die ("Errore nell'esecuzione della query");

        }

    }

    else {

        include_once($_SERVER['DOCUMENT_ROOT'] . "/wildlife/views/dashboard/pages/diagnosi/create.view.php");

    }

?>
