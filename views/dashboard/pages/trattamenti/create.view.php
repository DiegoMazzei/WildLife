<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<script>
            
    function controllo() {

        let codTerapia = document.forms["myform"]["codTerapia"].value;

        let codOperatore = document.forms["myform"]["codOperatore"].value;

        if (codTerapia == "") {

            window.alert("Inserisci la terapia");

            return false;

        }

        if (codOperatore == "") {

            window.alert("Inserisci l'operatore");

            return false;

        }

    }

</script>

        <main>
        <form action="/wildlife/controllers/dashboard/trattamenti/create.php" method="post" name="myform" onsubmit = "return controllo()">

        <label for="Cod_Terapia"> Codice della Terapia</label>
            <select class="form-select" name="codTerapia" id="codTerapia">
                <option name="codTerapia" value=""> Seleziona la terapia </option>
                <?php
                $query_terapia = "SELECT DISTINCT Cod_Terapia_Farmacologica
                FROM terapia_farmacologica;";
                $result = $connection->query($query_terapia);
                if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                ?>
                <option name="codTerapia" value="<?php echo $row['Cod_Terapia_Farmacologica']; ?>"><?php echo $row['Cod_Terapia_Farmacologica']; ?></option>
                <?php
                }
                }
                ?>
            </select><br><br>

            <label for="Cod_Operatore">Operatore</label>
            <select class="form-select" name="codOperatore" id="codOperatore">
                <option name="codOperatore" value=""> Seleziona l'operatore </option>
                <?php
                $query_utente = "SELECT DISTINCT Codice_Utente, Nome, Cognome FROM utenti AS U
                                   JOIN tipologia_ruolo AS T ON T.Codice_Ruolo = U.Codice_Ruolo 
                                   WHERE T.Denominazione IN ('Veterinario', 'Primario', 'Assistente')
                                   ORDER BY 1 ASC;";
                $result = $connection->query($query_utente);
                if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                ?>
                <option name="codOperatore" value="<?php echo $row['Codice_Utente']; ?>"><?php echo $row['Nome'] . ' ' . $row['Cognome']; ?></option>
                <?php
                }
                }
                ?>
            </select><br><br>
 
        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" required></textarea><br><br>

        <label for="dataTrattamento">Data del trattamento:</label><br>
		<input type="date" id="dataTrattamento" name="dataTrattamento" required></input><br><br>

            <input type="submit" value="Invia">
            <button type = "reset"> Reset </button>
        </form>
    </main>

<?php include_once($path . 'foot.php'); ?>
