<?php

//'text', 'file', 'config', 'foto' 'vet_link', 'scheda_link', 'esame_link', 'diagnosi_link', 'terapia_link'

function createTable($table_data, $data) {
    echo "<table border='1'>";

    // Table headers
    echo "<tr>";
    foreach ($table_data["columns"] as $col) {
        echo "<th>$col</th>";
    }
    echo "</tr>";

    for ($i = 0; $i < count($data); $i++) {
        $row = $data[$i];

        echo "<tr>";
        
        for ($j = 0; $j < count($row); $j++) {
          
            $element = "";

            switch ($table_data["columns_type"][$j]) {
                case 'text':
                    $element = $row[$j];
                    break;
                case 'scheda_link':
                    $element = "<a href='/wildlife/controllers/dashboard/schede/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'vet_link':
                    $element = "<a href='/wildlife/controllers/dashboard/veterinari/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'esame_link':
                    $element = "<a href='/wildlife/controllers/dashboard/esami/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'diagnosi_link':
                    $element = "<a href='/wildlife/controllers/dashboard/diagnosi/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'terapia_link':
                    $element = "<a href='/wildlife/controllers/dashboard/terapie/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'centro_link':
                    $element = "<a href='/wildlife/controllers/dashboard/centri/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
                case 'socc_link':
                    $element = "<a href='/wildlife/controllers/dashboard/soccorritori/show.php?id=$row[$j]'>$row[$j]</a>";
                    break;
               case 'socc_edit':
                     $element = "<a href='/wildlife/controllers/dashboard/soccorritori/update.php?id=$row[$j]'>Modifica</a>";
                    break;
                case 'vet_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/veterinari/update.php?id=$row[$j]'>Modifica</a>";
                    break;
                case 'scheda_edit':
                    $element = "<a href='/wildlife/controllers/dashboard/schede/update.php?id=$row[$j]'>Modifica</a>";
                    break;
            }

            echo "<td>" . $element . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
}
