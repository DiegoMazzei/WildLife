<?php $path = $root . '/views/dashboard/partials/';?>
<?php include_once($path . 'head.php'); ?>
<?php include_once($path . 'sidebar.php'); ?>
<?php include_once($path . 'header.php'); ?>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
let responseFile = "/wildlife/controllers/dashboard/terapiaResponse.php";
$(document).ready(function() {
    $('#tipologia').on('change', function() {
        let tipologia = $(this).val();
        console.log(tipologia);
        $.ajax({
                method: "POST",
                url: responseFile,
                data: {
                    tipologia: tipologia
                },
                datatype: "html",
                success: function (data) {
                    $(".terapiaResponseData").html(data);
                }
            })
        });
});
</script>

<script>

    function controllo() {

        let diagnosi = document.forms["myform"]["diagnosi"].value;

        let tipologia = document.forms["myform"]["tipologia"].value;

        let operatore = document.forms["myform"]["operatore"].value;

        if (diagnosi == "") {

            window.alert("Inserisci la diagnosi");

            return false;

        }

        if (tipologia == "") {

            window.alert("Inserisci la tipologia");

            return false;

        }

        if (operatore == "") {

            window.alert("Inserisci l'operatore");

            return false;


        }

    }

</script>

<main>
    <form action="" method="post" name="myform" enctype="multipart/form-data" onsubmit = "return controllo()">

        <label for="diagnosi">Diagnosi</label>
        <select class="form-select" name="codiceDiagnosi" id="diagnosi">
            <option value=""> Seleziona il codice della diagnosi </option>
            <?php foreach ($diagnosiData as $record) : ?>
                <option value="<?php echo $record['Codice_Diagnosi']; ?>"><?= $record['Codice_Diagnosi'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="tipologia">Tipologia tipologia</label>
        <select class="form-select" name="codiceTipologia" id="tipologia">
            <option value=""> Seleziona il codice della tipologia </option>
            <?php foreach ($tipologieData as $record) : ?>
                <option value="<?php echo $record['Codice_Terapia']; ?>"><?= $record['Descrizione'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="operatore">Operatore</label>
        <select class="form-select" name="codiceOperatore" id="operatore">
            <option value=""> Seleziona il codice del operatore di operatore </option>
            <?php foreach ($operatoriData as $record) : ?>
                <option value="<?php echo $record['Codice_operatore']; ?>"><?= $record['Nome'] ?> <?= $record['Cognome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="descrizione">Descrizione:</label><br>
        <textarea id="descrizione" name="descrizione" required></textarea><br><br>

        <!-- Dati specifici, relativi a una tipologia di terapia (Chirurgica / Farmacologica / Riabilitativa) -->
        <div class="terapiaResponseData">
        </div>

        <input type="submit" value="Invia">
        <button type = "reset"> Reset </button>
    </form>
</main>

<?php include_once($path . 'foot.php'); ?>
