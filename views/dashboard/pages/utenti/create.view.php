<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php require 'permit.php';?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>

let responseFile = "/wildlife/controllers/dashboard/regprovcomune.php";
$(document).ready(function() {
    $('#regione').on('change', function() {
        let regione = $(this).val();
    $.ajax({
            method: "POST",
            url: responseFile,
            data: {
                regione: regione
            },
            datatype: "html",
            success: function (data) {
                $("#provincia").html(data);
                $("#comune").html("<option value=''>Seleziona Comune</option>")
            }
        })
    });
});

$(document).ready(function() {
    $('#provincia').on('change', function() {
        let provincia = $(this).val();
    $.ajax({
            method: "POST",
            url: responseFile,
            data: {
                provincia: provincia
            },
            datatype: "html",
            success: function (data) {
                $("#comune").html(data);
            }
        })
    });
});
</script>

<script>

    function controllo () {

        let regione = document.forms["myform"]["regione"].value;

        let provincia = document.forms["myform"]["provincia"].value;

        let comune = document.forms["myform"]["comune"].value;

        let centro = document.forms["myform"]["centro"].value;

        let ruolo = document.forms["myform"]["ruolo"].value;

        if (regione == "") {

            window.alert("Inserisci la regione");

            return false;

        }

        if (provincia == "") {

            window.alert("Inserisci la provincia");

            return false;

        }

        if (comune == "") {

            window.alert("Inserisci il comune");

            return false;

        }

        if (centro == "") {

            window.alert("Inserisci il centro");

            return false;

        }

        if (ruolo == "") {

            window.alert("Inserisci il ruolo");

            return false;

        }

    }

</script>

<main>
    <form action="/wildlife/controllers/dashboard/utenti/create.php" method="post" name="myform" onsubmit = "return controllo()">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" required><br><br>

        <label for="indirizzo">Indirizzo:</label><br>
        <input type="text" id="indirizzo" name="indirizzo" required><br><br>

        <label for="regione"> Regione</label>
        <select class="form-select" id="regione">
            <option  value=""> Seleziona la regione dell'utente</option>
            <?php foreach ($regioniData as $record) : ?>
                <option value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="provincia"> Provincia</label>
        <select class="form-select" id="provincia">
        </select><br><br>

        <label for="comune"> Comune</label>
        <select class="form-select" name="codiceComune" id="comune">
        </select><br><br>

        <label for="telefono">Telefono:</label><br>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="Centro"> Centro</label>
        <select class="form-select" name="codiceCentro" id="centro">
            <option name="codiceCentro" value=""> Seleziona il Centro di Appartenenza dell'Utente </option>
            <?php
            $query = "SELECT DISTINCT Codice_Centro, Denominazione FROM anagrafica_centro ORDER BY Codice_comune ASC;";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    ?>
                    <option name="codiceCentro" value="<?php echo $row['Codice_Centro']; ?>"><?php echo $row['Denominazione']; ?></option>
                    <?php
                }
            }
            ?>
        </select><br><br>
                    
                    <label for="Ruolo"> Ruolo</label>
        <select class="form-select" name="codiceRuolo" id="ruolo">
            <option name="codiceRuolo" value=""> Seleziona il Ruolo dell'Utente </option>
            <?php
            $query = "SELECT DISTINCT Codice_Ruolo, Denominazione FROM tipologia_ruolo ORDER BY Codice_Ruolo ASC;";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)){
            ?>
            <option name="codiceRuolo" value="<?php echo $row['Codice_Ruolo']; ?>"><?php echo $row['Denominazione']; ?></option>
            <?php
            }
            }
            ?>
        </select><br><br>

        <input type="submit" value="Invia">
        <button type = "reset"> Reset </button>
    </form>
</main>


<?php include_once($path . 'foot.php'); ?>
