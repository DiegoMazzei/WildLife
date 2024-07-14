<?php

//'text', 'file', 'config', 'foto' 'vet_link', 'scheda_link', 'esame_link', 'diagnosi_link', 'terapia_link'

/*
Funzione che crea automaticamente una tabella, in base ai dati passati e al formato definito

table_data deve essere un array con il seguente formato:

$table_data = [
    ['columns'] => ['Col1', 'Col2', 'Col3'],
    ['columns_type'] => ['tipo1', 'tipo2', 'tipo3']
];

in cui "columns" definisce i nomi di ogni colonna (che corrispondono ai risultati della query, passati nella variabile $data)
e "columns_type" definisce la tipologia di ogni colonna (link che porta ad un veterinario, testo, immagine, ecc). Per la lista
di tipologie, guardare lo switch sotto riportato
*/
function createTable($table_data, $data) {

    // Import delle funzioni di filtraggio della tabella
    echo "<script src='/wildlife/views/dashboard/javascript/tabelle.js'></script>";

    echo "<table border='1' id='tabella'>";

    // Table headers
    echo "<tr>";
    for($i = 0; $i < count($table_data["columns"]); $i++) {
        $type = $table_data["columns_type"][$i];
        if (strpos($type, "link") || strpos($type, "edit") || strpos($type, "state") || strpos($type, "delete")) {
            echo "<th>" . $table_data["columns"][$i] . "</th>";
            continue;
        }
        echo "<th class='riordinabile' onClick='riordinacampo($i)'>" . $table_data["columns"][$i] . " &#9660;</th>";
    }
    echo "</tr>";
    
    echo "<tr>";
    for($i = 0; $i < count($table_data["columns"]); $i++) {
        $type = $table_data["columns_type"][$i];
        if (strpos($type, "link") || strpos($type, "edit") || strpos($type, "state") || strpos($type, "delete")) {
            echo "<td></td>";
        } else {
            echo "<td><input class='ricerca' type='text' id='input$i' onkeyup='filtrotabella($i)'<td>";
        }
    }
    echo "</tr>";


    for ($i = 0; $i < count($data); $i++) {
        $row = $data[$i];

        echo "<tr>";
        
        for ($j = 0; $j < count($row); $j++) {
          
            $element = "";
            $glassIcon = "<svg fill='#000000' viewBox='0 0 32 32' version='1.1' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M31.707 30.282l-9.717-9.776c1.811-2.169 2.902-4.96 2.902-8.007 0-6.904-5.596-12.5-12.5-12.5s-12.5 5.596-12.5 12.5 5.596 12.5 12.5 12.5c3.136 0 6.002-1.158 8.197-3.067l9.703 9.764c0.39 0.39 1.024 0.39 1.415 0s0.39-1.023 0-1.415zM12.393 23.016c-5.808 0-10.517-4.709-10.517-10.517s4.708-10.517 10.517-10.517c5.808 0 10.516 4.708 10.516 10.517s-4.709 10.517-10.517 10.517z'></path> </g></svg>";
            $pencil = "<svg viewBox='0 0 192 192' xmlns='http://www.w3.org/2000/svg' xml:space='preserve' fill='none'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'><path d='m104.175 90.97-4.252 38.384 38.383-4.252L247.923 15.427V2.497L226.78-18.646h-12.93zm98.164-96.96 31.671 31.67' class='cls-1' style='fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:none;stroke-opacity:1' transform='translate(-77.923 40.646)'></path><path d='m195.656 33.271-52.882 52.882' style='fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:5;stroke-dasharray:none;stroke-opacity:1' transform='translate(-77.923 40.646)'></path></g></svg>";
            $cancel = "<svg viewBox='0 0 32 32' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:sketch='http://www.bohemiancoding.com/sketch/ns' fill='#000000'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <title>cross-circle</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id='Page-1' stroke='none' stroke-width='1' fill='none' fill-rule='evenodd' sketch:type='MSPage'> <g id='Icon-Set' sketch:type='MSLayerGroup' transform='translate(-568.000000, -1087.000000)' fill='#000000'> <path d='M584,1117 C576.268,1117 570,1110.73 570,1103 C570,1095.27 576.268,1089 584,1089 C591.732,1089 598,1095.27 598,1103 C598,1110.73 591.732,1117 584,1117 L584,1117 Z M584,1087 C575.163,1087 568,1094.16 568,1103 C568,1111.84 575.163,1119 584,1119 C592.837,1119 600,1111.84 600,1103 C600,1094.16 592.837,1087 584,1087 L584,1087 Z M589.717,1097.28 C589.323,1096.89 588.686,1096.89 588.292,1097.28 L583.994,1101.58 L579.758,1097.34 C579.367,1096.95 578.733,1096.95 578.344,1097.34 C577.953,1097.73 577.953,1098.37 578.344,1098.76 L582.58,1102.99 L578.314,1107.26 C577.921,1107.65 577.921,1108.29 578.314,1108.69 C578.708,1109.08 579.346,1109.08 579.74,1108.69 L584.006,1104.42 L588.242,1108.66 C588.633,1109.05 589.267,1109.05 589.657,1108.66 C590.048,1108.27 590.048,1107.63 589.657,1107.24 L585.42,1103.01 L589.717,1098.71 C590.11,1098.31 590.11,1097.68 589.717,1097.28 L589.717,1097.28 Z' id='cross-circle' sketch:type='MSShapeGroup'> </path> </g> </g> </g></svg>";

            switch ($table_data["columns_type"][$j]) {
                case 'text':
                    $element = $row[$j];
                    break;
                case 'scheda_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/schede/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'vet_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/veterinari/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'esame_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/esami/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'diagnosi_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/diagnosi/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'terapia_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/terapie/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'trattamento_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a class='tableLink' href='/wildlife/controllers/dashboard/trattamenti/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'centro_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a href='/wildlife/controllers/dashboard/centri/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'socc_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a href='/wildlife/controllers/dashboard/soccorritori/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'prescrizione_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a href='/wildlife/controllers/dashboard/esami/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;
                case 'user_link':
                    $element = "<div class='openview'><p>$row[$j]</p><a href='/wildlife/controllers/dashboard/utenti/show.php?id=$row[$j]'>$glassIcon</a></div>";
                    break;


                case 'socc_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/soccorritori/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'vet_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/veterinari/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'user_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/utenti/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'user_state':
                    $statoText = ($row[$j] == 1) ? "Attivo" : "Non Attivo";
                    $statoCode = $row[$j];
                    $element = "<a href='/wildlife/controllers/dashboard/utenti/update.state.php?id=$row[0]&stato=$statoCode'>$statoText</a>";
                    break;
                case 'scheda_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/schede/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'esame_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/esami/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'terapia_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/terapie/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'trattamento_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/trattamenti/update.php?id=$row[$j]'>$pencil</a>";
                    break;
                case 'diagnosi_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/diagnosi/update.php?id=$row[$j]'>$pencil</a>";
                    break;

                case 'scheda_delete':
                    $element = "<a href = '/wildlife/controllers/dashboard/schede/delete.php?id=$row[$j]'>$cancel</a>";
                    break;

                case 'diagnosi_delete':
                    $element = "<a href = '/wildlife/controllers/dashboard/diagnosi/delete.php?id=$row[$j]'>$cancel</a>";
                    break;

                case 'terapie_delete':
                    $element = "<a href = '/wildlife/controllers/dashboard/terapie/delete.php?id=$row[$j]'>$cancel</a>";
                    break;

                case 'esami_delete':
                    $element = "<a href = '/wildlife/controllers/dashboard/esami/delete.php?id=$row[$j]'>$cancel</a>";
                    break;

                case 'trattamento_delete':
                    $element = "<a href = '/wildlife/controllers/dashboard/trattamenti/delete.php?id=$row[$j]'>$cancel</a>";
                    break;

            }

            echo "<td>" . $element . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}
