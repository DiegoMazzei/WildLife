<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inserisci Soccorritore</title>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Diego Mazzei">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/wildlife/views/dashboard/styles/main.css">


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

    function controllo() {

        let regione = document.forms["myform"]["regione"].value;

        let provincia = document.forms["myform"]["provincia"].value;

        let comune = document.forms["myform"]["comune"].value;

        let tipologia = document.forms["myform"]["tipologia"].value;

        if (regione == "") {

            window.alert("Inserisci la regione");

            return false;

        }

        if (provincia == "") {

            window.alert("Inserisci provincia");

            return false;

        }

        if (comune == "") {

            window.alert("Inserisci il comune");

            return false;

        }

        if (tipologia == "") {

            window.alert("Inserisci la tipologia");

            return false;

        }

    }

</script>

    </head>
    <body>
        <main>
        <h2>Inserimento Soccorritore</h2>

        <form action="/wildlife/controllers/dashboard/soccorritori/create.php" method="post" name="myform" onsubmit = "return controllo()">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="cognome">Cognome:</label><br>
            <input type="text" id="cognome" name="cognome" required><br><br>

            <label for="indirizzo">Indirizzo:</label><br>
            <input type="text" id="indirizzo" name="indirizzo" required><br><br>

            <?php
        $queryRegioni = "SELECT DISTINCT Regione FROM regprovcomune ORDER BY 1 ASC;";
        $regioniData = queryAllAssoc($queryRegioni, $connection);
        ?>

        <label for="regione"> Regione</label>
        <select class="form-select" name="codiceRegione" id="regione">
            <option  value=""> Seleziona il codice della regione del ritrovamento</option>
            <?php foreach ($regioniData as $record) : ?>
                <option value="<?php echo $record['Regione']; ?>"> <?= $record['Regione'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="provincia"> Provincia</label>
        <select class="form-select" name="codiceProvincia" id="provincia">
        </select><br><br>

        <label for="comune"> Comune</label>
        <select class="form-select" name="comune" id="comune">
        </select><br><br>

            <label for="telefono">Telefono:</label><br>
            <input type="tel" id="telefono" name="telefono" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="Tipologia"> Tipologia</label>
            <select class="form-select" name="tipologia" id="tipologia">
                <option name="tipologia" value=""> Seleziona la tipologia </option>
                <?php
                $query = "SELECT DISTINCT Codice_Tip_Soccorritore, Descrizione FROM tipologia_soccorritore ORDER BY Codice_Tip_Soccorritore ASC;";
                $result = $connection->query($query);
                if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                ?>
                <option name="tipologia" value="<?php echo $row['Codice_Tip_Soccorritore']; ?>"><?php echo $row['Descrizione']; ?></option>
                <?php
                }
                }
                ?>
            </select><br><br>

            <input type="submit" value="Invia">
        </form>
    </main></body>  
</html>


<?php include_once($path . 'foot.php'); ?>
