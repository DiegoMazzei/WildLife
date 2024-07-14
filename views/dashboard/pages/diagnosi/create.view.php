<?php

    $title = 'Creazione diagnosi';

    $path = $_SERVER['DOCUMENT_ROOT'] . "/wildlife/views/dashboard/partials/";

    include_once($path . "head.php");

    include_once($path . "header.php");

    include_once($path . "sidebar.php");

?>

<script>

    function controllo() {

        let codSchede = document.forms["diagnosi"]["codSchede"].value;

        let st_epidermico = document.forms["diagnosi"]["st_epidermico"].value;

        let st_sensorio = document.forms["diagnosi"]["st_sensorio"].value;

        let operatore = document.forms["diagnosi"]["operatore"].value;

        if (codSchede == "") {

            window.alert("Inserisci il codice della scheda");

            return false;

        }

        if (st_epidermico == "") {
           
            window.alert("Inserisci lo stato epidermico");

            return false;
            
        }

        if (st_sensorio == "") {

            window.alert("Inserisci lo stato sensorio");

            return false;

        }

        if (operatore == "") {

            window.alert("Inserisci l'operatore");

            return false;

        }

    }

</script>

<main>

    <form name = "diagnosi" action = "create.php" onsubmit="return controllo()" method = "POST">

        <label for = "codSchede"> Codice Scheda</label>
        
        <select class = "form-select" name = "codSchede" id = "codSchede">

            <option value = ""> Seleziona il codice della scheda </option>

            <?php

                $query = "SELECT Codice_Accettazione 
                         FROM scheda_arrivo
                         ORDER BY Codice_Accettazione ASC;";

                $result = $connection -> query($query);

                if ($result) {

                    $data = $result -> fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $d) {

                        echo "<option value ='" . $d['Codice_Accettazione'] . "'>" . $d['Codice_Accettazione'] . "</option>";
        
                    }

                }

                else {

                    die ("Errore nell'esecuzione della query");

                }

            ?>

        </select>

        <br> <br>

        <label for = "st_epidermico"> Stato Epidermico</label>

        <select class = "form-select" name = "st_epidermico" id = "st_epidermico">

            <option value = ""> Seleziona lo stato epidermico </option>

            <?php
            
                $query = "SELECT DISTINCT(Descrizione), codice_epidermico
                          FROM stato_epidermico
                          ORDER BY Descrizione ASC;";

                $result = $connection -> query($query);

                if ($result) {

                    $data = $result -> fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $d) {

                        echo "<option value ='" . $d['codice_epidermico'] . "'>" . $d['Descrizione'] . "</option>";

                    }

                }

                else {

                    die ("Errore nell'esecuzione della query");

                }

            ?>

        </select>

        <br> <br>

        <label for = "st_sensorio"> Stato sensorio</label>

        <select name = "st_sensorio" id = "st_sensorio" class = "form-select">

            <option value = ""> Seleziona lo stato sensorio </option>

            <?php

                $query = "SELECT DISTINCT(Descrizione), Codice_stato
                          FROM stato_sensorio
                          ORDER BY Descrizione ASC;";

                $result = $connection -> query($query);

                if ($result) {

                    $data = $result -> fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $d) {

                        echo "<option value ='" . $d['Codice_stato']. "'>" . $d['Descrizione'] . "</option>";

                    }

                }

                else {

                    die ("Errore nell'esecuzione della query");

                }

            ?>

        </select>
        
        <br> <br>

        <label for = "temperatura">Temperatura dell'animale*</label>

        <input name = "temperatura" id = "temperatura" type = "text" placeholder = "Scrivi la temperatura" required>

        <br> <br>

        <label for = "operatore"> Operatore </label>

        <select name = "operatore" id = "operatore" class = "form-select">

            <option value = ""> Seleziona l'operatore </option>

            <?php

                $query = "SELECT Codice_Utente, CONCAT(Nome, ' ', Cognome) AS Operatore
                          FROM utenti AS U
						  JOIN tipologia_ruolo AS R ON R.Codice_Ruolo = U.Codice_Ruolo
						  WHERE R.Denominazione = 'Veterinario'
                          ORDER BY Codice_Utente ASC;";

                $result = $connection -> query($query);

                if ($result) {

                    $data = $result -> fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $d) {

                        echo "<option value ='" . $d['Codice_Utente']. "'>" . $d['Operatore'] . "</option>";

                    }

                }

                else {

                    die ("Errore nell'esecuzione della query");
                    
                }

            ?>

        </select>

        <br> <br>

        <label for = "note"> Note </label>

        <br>

        <textarea name = "note" id = "note" rows = '4' columns = '50' placeholder = "scrivi le tue note"></textarea>
        
        <br><br>

        <button type = "sumbit"> Invia </button>
        <button type = "reset"> Reset </button>

    </form>

</main>

<?php

	include_once ($path . 'foot.php');

?>
