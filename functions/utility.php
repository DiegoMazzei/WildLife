<?php

function uploadImage(string $targetDir, $imageData, $fileName = "") {

    $correctUpload = 1;
    $validFile = 1;

    $currentTimestamp = date('Y-m-d H:i:s');
    $imagePath = $imageData['tmp_name'];
    $fileType = strtolower(pathinfo($imageData['name'], PATHINFO_EXTENSION));

    if ($fileName === "") {
        $fileName = $imageData['name'];
    }
    $targetFile = $targetDir . $fileName . '.' . $fileType;

    // Si controlla che il file sia un'immagine o che non sia già presente
    if (!getimagesize($imagePath) || file_exists($targetFile)) {
        $validFile = 0;
    }

    // Controllo dimensione del file
    if (filesize($imagePath) > 2000000) {
        die("File troppo grande, dimensione massima: 2M");
    }

    // Controllo estensione immagine. Formati validi: png, jpg, jpeg, webp
    if ($fileType != 'png' || $fileType != 'jpg' || $fileType != 'jpeg' || $fileType != 'webp') {
        $validFile = 0;
    }

    if (!$validFile && !move_uploaded_file($imagePath, $targetFile)) {
        $correctUpload = 0;
    }

    if (!$correctUpload) {
        die("Errore caricamento immagine");
    }

    return $correctUpload;

}

function replaceImage ($targetDir, $imageData, $oldName, $oldExtension, $newName) {

    $correctReplacement = 0;
    $validFile = 1;
    $oldFileValid = 1;

    $imagePath = $imageData['tmp_name'];
    $fileType = strtolower(pathinfo($imageData['name'], PATHINFO_EXTENSION));

    if ($newName === "") {
        $newName = $imageData['name'];
    }
    $oldTarget = $targetDir . $oldName . '.' . $oldExtension;
    $targetFile = $targetDir . $newName . '.' . $fileType;

    // Si controlla che il file sia un'immagine
    if (!getimagesize($imagePath)) {
        $validFile = 0;
    }

    // Controllo vecchio file
    if (!file_exists($oldTarget) || !is_writable($oldTarget)) {
       $oldFileValid = 0; 
    }

    if ($validFile && $oldFileValid) {
        $deleteStatus = unlink($oldTarget); // Eliminazione immagine precedente
        if ($deleteStatus) {
            $uploadStatus = move_uploaded_file($imagePath, $targetFile);
            $correctReplacement = 1;
        } else {
            $correctReplacement = 0;
        }

    }

    return $correctReplacement;


}

// Ritorna un record sottoforma di array associativo
function queryOneAssoc(string $query, $connection) {
    $queryResult = $connection -> query($query);
    $data = [];
    if ($queryResult && $queryResult -> num_rows === 1) {
        $data = $queryResult -> fetch_assoc(); 
    }

    return $data;
}

// Ritorna un record sottoforma di array con indice numerico
function queryOneNum(string $query, $connection) { 
    $queryResult = $connection -> query($query);
    $data = [];
    if ($queryResult && $queryResult -> num_rows === 1) {
        $data = $queryResult -> fetch_row();
    }

    return $data;
}

// Ritorna i records, in cui ogni record di array con indici associativi
function queryAllAssoc(string $query, $connection) { 
    $queryResult = $connection -> query($query);
    $data = [];
    if ($queryResult) {
        $data = $queryResult -> fetch_all(MYSQLI_ASSOC);
    }

    return $data;
}

// Ritorna i records, in cui ogni record di array con indici numerici
function queryAllNum(string $query, $connection) {
    $queryResult = $connection -> query($query);
    $data = [];
    if ($queryResult) {
        $data = $queryResult -> fetch_all(MYSQLI_NUM);
    }

    return $data;
}
